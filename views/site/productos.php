<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $columns[]=['class' => 'yii\grid\ActionColumn'];?>
    <?= GridView::widget([
        'dataProvider' => $sqlProvider,
    ]); ?>

</div>
