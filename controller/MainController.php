<?php

include_once "./library/DbConnect.php";


/**
 * Самое главное лежит тут
 */
class MainController extends DbConnect
{

  public static $title;
	public static $content;
	public static $id_post;
	public static $id_news_GET;

	function __construct()
	{
		if (count($_POST) > 0) {
			self::$title = isset($_POST['title']) ? $_POST['title'] : '';
			self::$content = isset($_POST['content']) ? $_POST['content'] : '';
			self::$id_post = isset($_POST['id']) ? $_POST['id'] : '';
		}
		if (count ($_GET) > 0) {
			self::$id_news_GET = ($_GET['id']);
		}
	}
}
