<?php

namespace app\models;

use Yii;
use yii\base\Model;

class XmlDataModel extends Model
{
  /**
   * @var string имя XML-файла продуктов для чтения
   */
  public $productsFile;

  /**
   * @var string имя XML-файла категорий для чтения
   */
  public $categoriesFile;


  //подготовка массива данных
  protected function prepareData($productsFile, $categoriesFile)
  {
    // загрузка данных из XML-файлов в массив
    $prod_obj = simplexml_load_file($productsFile);
    $prod_json = json_encode($prod_obj);
    $products = json_decode($prod_json, true)['item'];

    $cat_obj = simplexml_load_file($categoriesFile);
    $cat_json = json_encode($cat_obj);
    $categories = json_decode($cat_json, true)['item'];

    //собираем данные в 1 общий массив
    for ($i = 0; $i < count($products); $i++){
      $cat_name = $categories[array_search($products[$i]['categoryId'], array_column($categories, 'id'))]['name'];
      $products[$i]['category'] = $cat_name;
      unset($products[$i]['categoryId']);
    }

    return $products;
  }

  //фильтрующая функция
  private function filter ($item)
  {
    $price = $this->prefilter($item, 'filter_price', 'price');
    $hidden = $this->prefilter($item, 'filter_hidden', 'hidden');
    $cat = $this->prefilter($item, 'filter_cat', 'category');

    if ($price === false || $hidden === false || $cat === false)
      return false;
    return true;
  }

  private function prefilter($item, $param, $field)
  {
    $param_filter = $this->getParam($param);
    if (strlen($param_filter) != 0) {
      if ($item[$field] != $param_filter)
        return false;
    }
    return true;
  }

  private function getParam($param)
  {
    return Yii::$app->request->getQueryParam($param, '');
  }

  //запускает фильтрацию и возвращает итоговый массив
  public function getData($productsFile, $categoriesFile)
  {
    $products = $this->prepareData($productsFile, $categoriesFile);

    $data = array_filter($products, [$this, 'filter']);

    return $data;
  }

  //возвращаем поисковую модель в контроллер
  public function getModel()
  {
    $price_filter = $this->getParam('filter_price');
    $hidden_filter = $this->getParam('filter_hidden');
    $cat_filter = $this->getParam('filter_cat');

    $searchModel = ['id' => null, 'price' => $price_filter, 'hidden' => $hidden_filter, 'category' => $cat_filter];

    return $searchModel;
  }
}