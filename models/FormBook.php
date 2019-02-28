<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FormBook extends Model
{
    public $book_sel;
    public $book_avtor;
    public $book_name;
    public $book_year;
    public $book_genre;
    public $book_page;
    public $book_file;


	public function rules(){
		return[
			[['book_sel'], 'required', 'message' => 'Не выбрано действие'],
			[['book_avtor', 'book_name', 'book_year', 'book_genre', 'book_page'], 'required', 'message' => 'Не заполнено поле'],
			[['book_file'],'file', 'extensions' => 'jpg,png,gif'],
			[['book_year', 'book_page'],'number', 'message' => 'Поле должно содержать только цифры']
		];
	}
}
?>