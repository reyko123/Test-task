<?php



/**

Вывод истории изменений (пока что с sql)
  */
class HistoryController extends MainController
{

	function __construct()
	{
		parent::__construct();
	}

	public function getHistory()
	{
		$sql = "SELECT *
				FROM update_ttss
				WHERE id_back =:id_back
				ORDER BY id DESC
				LIMIT  5";

		$params = ['id_back' => self::$id_news_GET];
		$stmt =parent::_initDb()->prepare($sql);
		$stmt->execute($params);
		$res = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $res;
	}

  public function PrintHistory()
	{
   	foreach ($this->getHistory() as $key) {
			foreach ($key as $value => $as) {
				echo "$value". '=>' ."$as" . "<br>";
		}
		echo "<hr>";
		}

		foreach ($this->getHistory() as $key) {
			echo  $key['date_update'];
		}
  }
  // Доделать рабочий вариант
  public function getOldNews() {
      $sql = " SELECT DISTINCT update_ttss.content_column,  update_ttss_2.`content_column`AS 'sdasd' FROM `update_ttss`
      JOIN `update_ttss`  AS `update_ttss_2`
      ON  update_ttss.`name_column` = ''Имя'' ANd update_ttss_2.`name_column` = ''Контент'' ";
      $params = ['id_back' => self::$id_news_GET];
      $stmt = parent::_initDb()->prepare($sql);
      $stmt->execute($params);
      $res = $stmt->fetch(PDO::FETCH_LAZY);
      return $res;
  }

  public function test1() {

     // $this->getOldNews();
      print_r( $this->getOldNews()['name_column']);
      echo "<br />";
      print_r($this->getOldNews()['content_column']) ;
      echo "<br />";
      print_r($this->getOldNews()['id']) ;
  }
}
