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
  $disallow = (isset($_POST['disallow'])) ?? 'Empty';
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
<div class="row">
    <h3><?= Html::encode($mes) ?></h3>
    <div class="col-lg-5">

        <?= Html::beginForm(['/web/save'], 'post', ['id' => 'robots-form']) ?>

        <?= Html::cssFile('@web/css/robots.css') ?>

        <?= Html::label('Директива Disallow', 'disallow', []) ?>
        <?= Html::textarea('Disallow', $robots['Disallow'], ['rows' => 5, 'class' => 'robots-input']) ?>

        <?= Html::label('Директива Allow', 'allow', []) ?>
        <?= Html::textarea('Allow', $robots['Allow'], ['rows' => 3, 'class' => 'robots-input']) ?>

        <?= Html::label('Директива Clean-param', 'clean-param', []) ?>
        <?= Html::textarea('Clean-param', $robots['Clean-param'], ['rows' => 3, 'class' => 'robots-input']) ?>

        <?= Html::label('Директива Crawl-delay', 'crawl-delay', []) ?>
        <?= Html::input('number', 'Crawl-delay', $robots['Crawl-delay'], ['min' => 0, 'max' => 2, 'step' => 0.1, 'class' => 'robots-input']) ?>

        <?= Html::submitButton('Сохранить', ['class' => 'submit']) ?>

        <?= Html::endForm(); ?>

    </div>
</div>