<?php

namespace app\models;
use yii\db\ActiveRecord;

class Books extends ActiveRecord
{
	public function getAvtors(){
		return $this->hasOne(Avtors::className(), ['id' => 'avtor']);
	}
	
}

?>