<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php if($users){ ?>
	<?php foreach ($users as $user){ ?>
		<?php if($user->name==$name && $user->pass==$pass){ 
			Yii::$app->session->set('uac_name', $name);
			Yii::$app->response->redirect(['site/books']);
			}
			else {?>
				<?php Yii::$app->session->remove('uac_name'); ?>
				<p style="color:red">Не существует такого пользователя или неверный пароль</p>
		<?php } ?>
	<?php } ?>
<?php } ?>

<div class="site-login">
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Заполните все поля для входа:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

		<?=$form->field($model, 'name')
				->label('Автор')
				->textInput(['autofocus' => true])
			?>
		<?=$form->field($model, 'pass')
				->label('Пароль')
				->passwordInput()
			?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
