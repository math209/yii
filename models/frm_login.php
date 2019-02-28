<?php

namespace app\models;

use Yii;
use yii\base\Model;

class frm_login extends Model
{
    public $name;
    public $pass;

    private $_user = false;

	public function rules(){
		return[
			[['name', 'pass'], 'required', 'message' => 'Не заполнено поле']
		];
	}
}
