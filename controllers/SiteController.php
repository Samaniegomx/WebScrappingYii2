<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Productos;
use app\models\Producto;
use Goutte\Client;
use yii\data\SqlDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Muestra pagina de productos.
     *
     * @return Response|string
     */
    public function actionProductos()
    {
        // $total = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tblProductos')->queryScalar();

        $sql = 'SELECT * FROM tblProductos';

        $sqlProvider = new SqlDataProvider([
            'sql' => $sql,
        ]);

        return $this->render('productos', [
            'sqlProvider' => $sqlProvider
        ]);
    }

    /**
     * Muestra pagina de productos.
     *
     * @return Response|string
     */
    public function actionCategory()
    {
        $model = new Producto();

        return $this->render('form', ['model' => $model]);
    }

    public function actionScrapping()
    {

        echo 'scrapping'.'<br>';

        $url1 = Yii::$app->request->post('Producto');
        
        $url = $url1['urlCategory'];
        // die;
        // $url = "https://computacion.mercadolibre.com.mx/accesorios/";

        // $url = $urlCategory;

        $client = new Client();
        $crawler = $client->request('GET', $url);

        $products = $crawler->filter('li.results-item')->each(function ($product){
            
            $idProducto = $product->filter('div.rowItem')->attr('id');
            $title = $product->filter('span.main-title')->first()->text();    
            $nombre = $title;
            
            $price = $product->filter('span.price__fraction')->first();
            $precio = $price->text();
            $link = $product->filter('h2.item__title a')->first();
            $prodDetail = new Client();
            $links = $link->attr('href');
            
            $crawDetail = $prodDetail->request('GET', $links);
            $detail = $crawDetail->filter('.item-description__text')->first();
            $descripcion = $detail->text();
            $model = Producto::find()->where(['idProducto' => $idProducto])->one();

            if($model){
                $model->precio = $precio;
                $model->update();
            } else {
                $model = new Producto();
                $model->idProducto = $idProducto;
                $model->nombre = $nombre;
                $model->precio = $precio;
                $model->descripcion = $descripcion;
                $model->save(false);
            }
            // print_r($model->save());
        });

        return $this->redirect(['productos']);
    }
}
