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

}
