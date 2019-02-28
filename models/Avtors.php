<?php

namespace app\models;
use yii\db\ActiveRecord;

class Avtors extends ActiveRecord
{
	
	public function getBooks(){
		return $this->hasMany(Books::className(), ['avtor' => 'id']);
	}
	
}

?>