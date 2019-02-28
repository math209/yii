<?php
namespace app\controllers;
 
 

use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

use app\models\Books;
use app\models\Avtors;
 
 
class DataController extends Controller
{
    public function beforeAction($action)
    {
        # Указываем формат ответа
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
    public function actionGet_book($bid=null) {
		//$books = Books::findOne($bid);
		//$books -> delete();
		//$books = books::find()->all();
		//return $books;
		
		$books = Books::findOne($bid);
		return $books;


		//return ArrayHelper::index($customers, 'id');
/**/
		
		//var_dump ($books);
		//return ArrayHelper::map($books, 'id','avtor','name','year','genre','page');
		//return ArrayHelper::map($books, 'id','name');
		
        //$avtors = Avtors::find()->all();
		//return $avtors;
		//return ArrayHelper::map($avtors, 'id', 'name');
		/*
        return $this->render('view',[
			'ret'=>$ret
		]);
		*/
    }
 
/*
    public function actionRegions($cid = null) {
        $regions = Regions::find()->select(['id', 'name'])->where(['country_id' => intval($cid)])->asArray()->all();
        return ArrayHelper::map($regions, 'id', 'name');
    }
    public function actionCities($rid = null) {
        $cities = Cities::find()->select(['id', 'name'])->where(['region_id' => intval($rid)])->asArray()->all();
        return ArrayHelper::map($cities, 'id', 'name');
    }
	
4
сказка о рыбаке и рыбке
1835
сказка
300

INSERT INTO `tbl_books`(`id`, `avtor`, `name`, `year`, `genre`, `page`) VALUES (null,4,'сказка о рыбаке и рыбке',1835,'сказка',300)
*/
}