<?php

namespace app\models;

class Producto extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tblProductos';
    }

    public $urlCategory; // defining virtual attribute

    public function rules()
    {
        return [
            // other rules ...
            [['urlCategory'], 'safe'],
        ];
    }

}