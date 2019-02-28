<?php
namespace app\models;

use Yii;
use yii\base\Model;

class filter extends Model
{
	public $inp_filter;
	public $sel_filter;
	public $sel_type;
	public $sel_sort;
	public function rules(){
		return[
			[['inp_filter','sel_filter','sel_type','sel_sort'], 'required']
		];
	}
}

?>