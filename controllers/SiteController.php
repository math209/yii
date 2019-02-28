<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use yii\data\Pagination;
use app\models\Books;
use app\models\Avtors;
use app\models\Users;
use app\models\frm_login;
use app\models\Filter;
use app\models\FormAvtor;
use app\models\FormBook;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
/*
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
*/
    /**
     * @inheritdoc
     */
    public function actions(){
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
    public function actionIndex(){
		$session=Yii::$app->session->get('uac_name');
		if(!Yii::$app->session->has('uac_name')) $session='Гость';
        return $this->render('index',[
			'session' => $session,
		]);
    }
    public function actionLogin(){
        $model = new frm_login();
	
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			$name = Html::encode($model->name);
			$pass = Html::encode($model->pass);
			
			$users = Users::find()->all();
		}
		else{
			$name='';
			$pass='';
			$users='';
		}

        return $this->render('login', [
            'model' => $model,
			'name' =>$name,
			'pass' =>$pass,
			'users'=>$users
        ]);
    }
    public function actionLogout(){
        //Yii::$app->user->logout();
		Yii::$app->session->remove('uac_name');
        return Yii::$app->response->redirect(['site/index']);
    }
	public function actionBooks(){
		//print __Method__;
		$qq=rand();
		$model = new filter();
		
		if(Yii::$app->request->post()){
			$sel_filter = Yii::$app->request->post('sel_filter');
			$inp_filter = Yii::$app->request->post('inp_filter');
			$sel_type = Yii::$app->request->post('sel_type');
			$sel_sort = Yii::$app->request->post('sel_sort');
			$book_id = Yii::$app->request->post('book_id');
			//var_dump($model);
		}
		else{
			$sel_filter='';
			$inp_filter='';
			$sel_type='';
			$sel_sort='';
			$book_id='';
		}
		
		$session=Yii::$app->session->get('uac_name');
		if(!Yii::$app->session->has('uac_name')) $session='Гость';
		if($book_id!=''){
			$books = Books::findOne($book_id);
			$books -> delete();
			}
		$avtors = Avtors::find()->all();
		$books = Books::find();
	
		//SELECT `tbl_books`.* FROM `tbl_books` LEFT JOIN `tbl_avtors` ON `tbl_books`.`avtor` = `tbl_avtors`.`id` WHERE `name` LIKE '%а%' 
		$customers = Books::find()->joinWith(['avtors']);
			
		if($sel_filter!=''&&$inp_filter!='') $customers = $customers->where(['LIKE', 'tbl_'.$sel_filter.'.name', $inp_filter]);
		
		if($sel_type!=''&&$sel_sort!=''){
			$sort=($sel_sort==5?'page':($sel_sort==4?'genre':($sel_sort==3?'year':($sel_sort==2?'name':'tbl_avtors.name'))));
			$customers =$customers->orderBy($sort.' '.$sel_type);
		}
		$customers = $customers->all();
				
		//var_dump($customers);
/*		
		$pagination = new Pagination([
			'defaultPageSize' => 2,
			'totalCount' => $customers->count()
			]);
			
		$customers=$customers
			->limit($pagination->limit)
			->offset($pagination->offset)
			->all();
/**/
		return $this->render('view',[
			'sel_filter'=>$sel_filter,
			'inp_filter'=>$inp_filter,
			'sel_type'=>$sel_type,
			'sel_sort'=>$sel_sort,
			'qq'=>$qq,
			'model'=>$model,
			'customers'=>$customers,
			//'pagination'=>$pagination,
			'session'=>$session
		]);
	}
	public function actionEdit(){
		$session=Yii::$app->session->get('uac_name');
		if(!Yii::$app->session->has('uac_name')) $session='Гость';
		if($session=='Гость') return Yii::$app->response->redirect(['site/index']);
		
		$form_avtor = new FormAvtor();
		$form_book = new FormBook();
		$avtors = Avtors::find()->orderBy(['name'=>SORT_ASC])->all();
		$books = Books::find()->orderBy(['name'=>SORT_ASC])->all();
		
		if($form_avtor->load(Yii::$app->request->post())){// && $form_avtor->validate()
			$avtor_name = Html::encode($form_avtor->avtor_name);
			$avtor_sel = Html::encode($form_avtor->avtor_sel);
			//print '<script>alert("edit|'.$avtor_sel.'|'.$avtor_name.'|");</script>';
			
			if($avtor_sel=='add') $avtors_new = new Avtors();
			else $avtors_new = Avtors::findOne($avtor_sel);
			$avtors_new->name = $avtor_name;
			$avtors_new->save();
			$avtors = Avtors::find()->orderBy(['name'=>SORT_ASC])->all();
		}
		
		if($form_book->load(Yii::$app->request->post())){
			$book_sel = Html::encode($form_book->book_sel);
			$book_avtor = Html::encode($form_book->book_avtor);
			$book_name = Html::encode($form_book->book_name);
			$book_year = Html::encode($form_book->book_year);
			$book_genre = Html::encode($form_book->book_genre);
			$book_page = Html::encode($form_book->book_page);
			
			$form_book->book_file = UploadedFile::getInstance($form_book, 'book_file');
			//print '<script>alert("edit|'.$form_book->book_file.'|");</script>';
			if($form_book->book_file!=''){
				$form_book->book_file = UploadedFile::getInstance($form_book, 'book_file');
				foreach($avtors as $avtor) if($avtor['id']==$book_avtor){
					$name_b=$book_name.'.'.$form_book->book_file->extension;
					FileHelper::createDirectory('art/book/'.$avtor['name']);
					$form_book->book_file->saveAs('art/book/'.$avtor['name'].'/'.$name_b);
					$book_src = Html::encode($name_b);
				}
			}
			//print '<script>alert("edit|'.$book_sel.'|'.$book_avtor.'|'.$book_name.'|'.$book_year.'|'.$book_genre.'|'.$book_page.'|'.$book_src.'|");</script>';
				
			if($book_sel=='add') $books_new = new Books();
			else $books_new = Books::findOne($book_sel);
			$books_new->avtor = $book_avtor;
			$books_new->name = $book_name;
			$books_new->year = $book_year;
			$books_new->genre = $book_genre;
			$books_new->page = $book_page;
			if($form_book->book_file!='') $books_new->src = $book_src;
			$books_new->save();
			
			$books = Books::find()->orderBy(['name'=>SORT_ASC])->all();
		}
		
		if(Yii::$app->request->get('as')){
			$re=Yii::$app->request->get('as');
			//print '<script>alert("edit|'.$re.'|");</script>';
			$re=Html::encode($re);
		}
		else $re='';
			
		return $this->render('AddBook',[
		're'=> $re,
		'session'=> $session,
		'avtors'=> $avtors,
		'books'=> $books,
		'form_avtor'=> $form_avtor,
		'form_book'=> $form_book
		]);
	}
}
