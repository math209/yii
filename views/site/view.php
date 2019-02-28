<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Обзор книг';
?>
<p>Вы зашли как: <b><?=$session?></b>&nbsp;&nbsp;
	<?php if($session!='Гость'){ ?>
		<a href="<?=Yii::$app->urlManager->createUrl(['site/logout']) ?>">Выход</a>
	<?php } ?>
</p>
<h3><?= Html::encode($this->title) ?></h3>

<table width="100%">
	<tr>
		<td>
			<?php if($session!='Гость'){ ?>
				<a href="<?=Yii::$app->urlManager->createUrl(['site/edit']) ?>">Добавить автора</a>
			<?php } ?>
		</td>
		<td align="right">
			<?php $frm=ActiveForm::begin([]); ?>
			<table id="filter">
				<tr>
					<td>Фильтр:</td>
					<td>
						<?php
							$i_filt = ['avtors'=> 'автор', 'books'=> 'наименование книги'];
							$i_type = ['ASC'=> 'во возрастанию', 'DESC'=> 'по убыванию'];
							$i_sort = ['1'=> 'автор', '2'=> 'наименование', '3'=> 'год', '4'=> 'жанр', '5'=> 'страниц'];
							$params = ['prompt' => 'выберите тип'];
							print Html::hiddenInput('book_id', '');
							print Html::dropDownList('sel_filter', $sel_filter,$i_filt,$params);
							print '&nbsp;';
							print Html::TextInput('inp_filter',$inp_filter);
						?>
					</td>
					<td><?= Html::submitButton('применить', ['id' => 'submit1']) ?></td>
				</tr>
				<tr>
					<td>Сортировка:</td>
					<td>
						<?php 
							print Html::dropDownList('sel_type', $sel_type,$i_type,$params);
							print '&nbsp;';
							print Html::dropDownList('sel_sort', $sel_sort,$i_sort,$params);
						?>
					</td>
					<td></td>
				</tr>
			</table>
			<?php ActiveForm::end(); ?>
		</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td colspan="2" align="center">
			<table id="book" width="700px">
				<thead><tr><th>Автор</th><th>Название книги</th><th width="100px">Год издания</th><th>Жанр</th><th width="120px">Кол-во страниц</th><?php ($session!='Гость'?print '<th width="70px">Действие</th>':'') ?></tr></thead>
				<tbody id="body_all">
					<?php foreach ($customers as $customer){ ?>
						<tr>
							<td><?=$customer['avtors']['name']?></td>
							<td><?=$customer['name']?></td>
							<td align="center"><?=$customer['year']?></td>
							<td><?=$customer['genre']?></td>
							<td align="center"><?=$customer['page']?></td>
							<?php ($session!='Гость'?print '<td align="center"><img class="pointer" src="art/site/edit.png" data-trigger="edit" data-item="'.$customer['id'].'" alt="Редактировать" />&nbsp&nbsp;<img class="pointer" src="art/site/delete.png" data-trigger="del" data-item="'.$customer['id'].'" alt="Удалить" /></td>':'') ?>
						</tr>
					<?php } ?>
				</tbody> 
			</table>
		</td>
	</tr>
</table>

<?php
//=LinkPager::widget(['pagination'=>$pagination])?>