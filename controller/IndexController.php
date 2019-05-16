<?php





//include_once "./library/SQLQvery.php";

/**
 *
 */
class IndexController extends DbController
{


	public function __construct()
	{
		parent::__construct();
	}

// Выводит ссылками новости
	public function InitNews()
	{
		foreach ($this->GetId() as $links) {
			echo "<a href=index.php?id=" . $links . ">Новость" . $links . "</a>  <br>";
		}
	}

// выводит 1 новость из списка
	public function PrintNewsById()
	{
		if ($this->SelectNewsById()) {
			echo ' Название новости:  '. parent::SelectNewsById()['title'] . "<br>";
			echo ' Текст новости:  '. parent::SelectNewsById()['content'] . "<br>";
			echo ' ID новости:  '. parent::SelectNewsById()['id'] . "<br>";
		}
	}

	// Принт всех новостей
	public function PrintDb()
	{
	 	foreach ($this->SelectAllNews() as $keys) {
			foreach ($keys as $key => $value) {
				echo $key . " --> " . $value . "<br>";
			}
 		}
	}

	// выводит ошибки при заполнениии
	public function PrintErrors()
	{
		if ($this->Validate()) {
			foreach ($this->Validate() as $key => $value) {
				echo $value . "<br>";
			}
		}
	}

}
