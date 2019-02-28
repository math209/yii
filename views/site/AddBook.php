<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Редактирование базы данных';
//$this->params['breadcrumbs'][] = $this->title;
?>
<p>Вы зашли как: <b><?=$session?></b>&nbsp;&nbsp;
	<?php if($session!='Гость'){ ?>
		<a href="<?=Yii::$app->urlManager->createUrl(['site/logout']) ?>">Выход</a>
	<?php } ?>
</p>
<div>
	<h3><?= Html::encode($this->title) ?></h3>
	<div id="div_left"><!--																							form avtor	-->
		<h4 id="ttl_avtor">Добавить автора</h4>
		<?php
			$params_sel = ['prompt' => 'выберите действие','id'=>'avtor_sel','class'=>'edit_field'];
			$avtor_sel=['add'=> 'добавить','редактировать'=>ArrayHelper::map($avtors, 'id','name')];
	
			$frm_avtor=ActiveForm::begin([]);
		?>
		<?=$frm_avtor->field($form_avtor, 'avtor_sel', ['template' => '{label}{input}{error}'])
			->label('Действие',['class' => 'edit_label'])
			->dropDownList($avtor_sel,$params_sel)
		?>
		<?=$frm_avtor->field($form_avtor, 'avtor_name', ['template' => '{label}{input}{error}'])
			->label('Имя автора',['class' => 'edit_label'])
			->input('text',['value'=>'','class'=>'edit_field'])
		?>
		<?= Html::submitButton('добавить',['class'=>'button_rt','id'=>'btn_avtor']); ?>
		<?php ActiveForm::end(); ?>
	</div>
	<div id="div_right"><!--																						form book	-->
		<div id="div_form">
			<h4 id="ttl_book">Добавить книгу</h4>
			<?php
				$avtorb_sel=ArrayHelper::map($avtors, 'id','name');
				
				if($re) $params_book = ['prompt' => 'выберите действие','options'=>[$re=>['selected'=>true]] ,'id'=>'book_sel','class'=>'edit_field'];
				else $params_book = ['prompt' => 'выберите действие','id'=>'book_sel','class'=>'edit_field'];
			
				$params_avtor = ['prompt' => 'выберите автора','id'=>'book_avtor','class'=>'edit_field'];
	
				$allin=['add'=>'добавить'];
				foreach($avtors as $item_a){
					$allin[$item_a['name']]=[];
					foreach($books as $item_b) 
						if($item_a['id']==$item_b['avtor']) 
					$allin[$item_a['name']][$item_b['id']]=$item_b['name'];
				}
	
			$frm_book=ActiveForm::begin(['id' => 'book_edt', 'options'=>['enctype'=>'multipart/form-data']]);
			?>
			<?=$frm_book->field($form_book, 'book_sel', ['template' => '{label}{input}{error}'])
				->label('Книга',['class' => 'edit_label'])
				->dropDownList($allin,$params_book)
			?>
			<?=$frm_book->field($form_book, 'book_avtor', ['template' => '{label}{input}{error}'])
				->label('Автор',['class' => 'edit_label'])
				->dropDownList($avtorb_sel,$params_avtor)
			?>
			<?=$frm_book->field($form_book, 'book_name', ['template' => '{label}{input}{error}'])
				->label('Наименования',['class' => 'edit_label'])
				->input('text',['value'=>'','class'=>'edit_field','id'=>'book_name'])
			?>
			<?=$frm_book->field($form_book, 'book_year', ['template' => '{label}{input}{error}'])
				->label('Год издания',['class' => 'edit_label'])
				->input('text',['value'=>'','class'=>'edit_field','id'=>'book_year'])
			?>
			<?=$frm_book->field($form_book, 'book_genre', ['template' => '{label}{input}{error}'])
				->label('Жанр',['class' => 'edit_label'])
				->input('text',['value'=>'','class'=>'edit_field','id'=>'book_genre'])
			?>
			<?=$frm_book->field($form_book, 'book_page', ['template' => '{label}{input}{error}'])
				->label('Кол-во страниц',['class' => 'edit_label'])
				->input('text',['value'=>'','class'=>'edit_field','id'=>'book_page'])
			?>
			<?=$frm_book->field($form_book, 'book_file', ['template' => '{label}{input}{error}'])
				->label('Картинка',['class' => 'edit_label'])
				->fileInput(['style'=>'width:200px; display:inline;','id'=>'book_file'])
			?>
			<?= Html::submitButton('добавить',['class'=>'button_rt','id'=>'btn_book']); ?>
			<?php ActiveForm::end(); ?>	
		</div><br><br>
		<div id="div_img"><img id="book_img" width="100%" height="100%" />
		</div>
	</div>
</div>