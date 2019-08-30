<?php

namespace app\models;

use yii\base\Model;

class Productos extends Model
{

    public $id;
    public $nombre;
    public $idProducto;
    public $precio;
    public $descripcion;

    public static function tableName(){
        return 'tblProductos';
    }

    public function rules(){
        return [
            [['nombre', 'descripcion'], 'string'],
        ];
    }

}