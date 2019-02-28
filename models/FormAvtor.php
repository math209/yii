<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FormAvtor extends Model
{
	public $avtor_sel;
    public $avtor_name;

	public function rules(){
		return[
			[['avtor_sel'], 'required', 'message' => 'Не выбрано действие'],
			[['avtor_name'], 'required', 'message' => 'Не заполнено поле']
		];
	}
}
?>