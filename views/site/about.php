<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
<div>
  <?php
  echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      'id',

      [
      'attribute' => 'price',
      'filter' => '<input class="form-control" name="filter_price" value="'. $searchModel['price'] .'" type="text">',
      'value' => 'price',
      ],
      [
      'attribute' => 'hidden',
      'filter' => '<input class="form-control" name="filter_hidden" value="'. $searchModel['hidden'] .'" type="text">',
      'value' => 'hidden',
      ],
      [
      "attribute" => "category",
      'filter' => '<input class="form-control" name="filter_cat" value="'. $searchModel['category'] .'" type="text">',
      'value' => 'category',
      ]
    ]
  ]);
  ?>
</div>