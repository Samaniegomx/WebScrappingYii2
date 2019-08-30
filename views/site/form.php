<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Categoria scrapping';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ingrese el enlace de la categoria que desea obtener los datos del producto:</p>

    <?php $form = ActiveForm::begin([
            'method' => 'POST',
            'action' => ['scrapping'],
        ]);
    ?>

        <div class="form-group">
            <?= $form->field($model, 'urlCategory')->textInput()->hint('Please enter category link')->label('Categoria') ?>
        </div>

    
        <div class="form-group">
            <?= Html::submitButton('obtener datos', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <div style="color:#999;">
        <p>Para hacer obtener los productos de una categoria de <strong>"MercadoLibre"</strong>, ingrese a la páginia de mercadolibre, ingrese a una categoria deseada, copie el enlace y peguelo en el recuadro de arriba, posteriormente presione el boton de obtener datos.</p>
        <p>Por ejemplo</p>
        <p><code>https://computacion.mercadolibre.com.mx/almacenamiento/</code></p>
        <p><code>https://deportes.mercadolibre.com.mx/futbol/</code></p>
        <p><code>https://ropa.mercadolibre.com.mx/playeras/hombre_Tienda_all</code></p>


    </div>
</div>
