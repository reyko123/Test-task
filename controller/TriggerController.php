<?php



 /*

Отвечает за тиггеры, выдющие историю измений справоченика

 */
class TriggerController extends MainController
{
	public $test = NULL;

	function __construct()
	{
		parent:: __construct();
	}

	// sql для новой новсти
	public function getNewNews()
	{
		$sql = "SELECT * FROM new_ttss WHERE id_new = :id_new";
		$params = ['id_new' => parent::$id_news_GET];
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

	// sql для удаляемой новости
	public function getDelNews()
	{
		$sql = "SELECT * FROM delete_ttss WHERE id_del = :id_del";
		$params = ['id_del' => parent::$id_news_GET];
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

	public static function triggerUpdate()
	{
		$sql_trigg =
		"DROP TRIGGER IF EXISTS  `update_news`;

			CREATE TRIGGER `update_news` BEFORE UPDATE ON `ttss`
			FOR EACH ROW

			IF OLD.content != NEW.content
			    THEN
			        INSERT INTO update_ttss
			            (
			                id_back, content_column, name_column
			            )
			        VALUES
			            (
			                OLD.id, OLD.content, :name_column
			            );

			ELSEIF OLD.title != NEW.title
			    THEN
			        INSERT INTO update_ttss
			            (
			                id_back, content_column, name_column
			            )
			        VALUES
			            (
			                OLD.id, OLD.title, :name_column
			            );
			END IF
		";

		$params = ['name_column' => self::GetColumnName()];
		$stmt = parent::_initDb()->prepare($sql_trigg);
		$stmt->execute($params);
	}

	public static function getColumnName()
	{
		if (count($_POST) > 0) {
			if ($_POST ['title'] !== DbController::SelectNewsById()['title']) {
				$column_name = 'Имя';
			} elseif ($_POST ['content'] !== DbController::SelectNewsById()['content']) {
				$column_name = 'Контент';
			}

			return isset($column_name) ? $column_name: '';
		}
	}

}
