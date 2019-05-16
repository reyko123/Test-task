<?php

include_once 'MainController.php';



/**
 *
 */
class DbController extends MainController
{

	public $init_dell = NULL;
	public static $init_add = NULL;
	public $init_edit = NULL;
	public  $test_trig = NULL;

	public function __construct()
	{
		parent:: __construct();
		if (count($_POST) > 0) {
			$this->init_dell = isset($_POST['init_dell']) ? $_POST['init_dell']: ''; // активирует удаление
			self::$init_add = isset($_POST['init_add']) ? $_POST['init_add']: ''; // активирует добавление
			$this->init_edit = isset($_POST['init_edit']) ? $_POST['init_edit']: ''; // активирует изменение
		}

	}

	// Валидация полей, поиск ошибок (довести до ума)
	protected function validate()
	{
		$error = [];

		if (self::$title and self::$content) {
			self::$title = trim (self::$title);
			self::$content = trim (self::$content);

			self::$title = htmlspecialchars (self::$title);
			self::$content = htmlspecialchars (self::$content);

      if (self::$title == '') {
          $error['title'] = 'Название файла не должно быть пустым!';
      } elseif (mb_strlen(self::$title) < 3) {
        	$error['title']  = 'Слишком короткое название новости!';
      } elseif (mb_strlen(self::$title) > 150) {
        	$error['title'] = 'Содержимое файла не должно превышать 150 символов!';
    	}

      if (self::$content == '' ) {
        $error['content'] = 'Содержимое файла не должно быть пустым!';
      } elseif (mb_strlen(self::$content) < 3) {
        $error['content']  = 'Минимальная длина текста новости - 3 символов!';
      } elseif (mb_strlen(self::$content) > 65535) {
        $error['content'] = 'Текст не должен превышать 65535 символов!';
      }

      return $error;
		}
  }

	// вывод новости по id (sql запрос)
	public static function selectNewsById()
	{
		$sql = "SELECT * FROM ttss WHERE id =:id";
		$params = ['id' => self::$id_news_GET];
		$stmt = parent::_initDb()->prepare($sql);
		$stmt->execute($params);
		$res = $stmt->fetch(PDO::FETCH_LAZY);

		/*if($stmt->errorCode() != PDO::ERR_NONE)
    	{
	    	$info = $stmt->errorInfo();
	    	echo implode('<br>', $info);
	    	exit();
		}	*/

		return $res;
	}

	// Запрос всех ID (sql запрос)
	public function getId()
	{
		$sql = "SELECT `id_new` FROM new_ttss";
		$stmt = parent::_initDb()->prepare($sql);
		$stmt->execute();
		$res = $stmt->fetchall(PDO::FETCH_COLUMN);

		if($stmt->errorCode() != PDO::ERR_NONE) {
    	$info = $stmt->errorInfo();
    	echo implode('<br>', $info);
    	exit();
		}

		return $res;
	}

	// Добавление новости (сунуть в библиотеку)(sql запрос)
	public function addNews()
	{
		if (self::$title && !$this->Validate() && self::$init_add) {
			$sql_add = "INSERT INTO `ttss`(`title`, `content`) VALUES (:title, :content)";
			$params = ['title' => self::$title,'content' => self::$content];
	    $query =  parent::_initDb()->prepare($sql_add);
	    $res = $query->execute($params);

			if($query->errorCode() != PDO::ERR_NONE) {
			    $info = $query->errorInfo();
			    echo implode('<br>', $info);
			    exit();
			}
		}
	}

	// Удаление новости (сунуть в библиотеку)(sql запрос)
	public function deleteNews()
	{
		if ($this->init_dell) {
			$sql_delete = "DELETE FROM `ttss` WHERE `id` = :id";
			$params = ['id' =>self::$id_post];
			$query =  parent::_initDb()->prepare($sql_delete);
			$res = $query->execute($params);
		}

	}

	// Редактирование новости (сунуть в библиотеку)(sql запрос)
	public function edit()
	{
		if (count($_POST) > 0 && !$this->Validate() && $this->init_edit) {
			$rows =
			[
				'title' => self::$title,
				'content' => self::$content
			];
			foreach ($rows as  $row_name => $values) {
				TriggerController::TriggerUpdate();
				$sql_update = "UPDATE `ttss` SET `$row_name`= :$row_name WHERE id= :id";
				$params = [$row_name => $values,'id' => self::$id_post];
				$stmt = parent::_initDb()->prepare($sql_update);
				$stmt->execute($params);
			}
		}
	}

	//помещает Id из GET в POST
	public function setId_Post()
	{
		if(self::$id_news_GET) {
			self::$id_post =  self::$id_news_GET;
			return self::$id_post;
		}
	}

}
