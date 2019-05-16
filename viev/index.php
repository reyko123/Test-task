<! DOCTYPE html>
<?php

include_once "./controller/DbController.php";
include_once "./controller/TriggerController.php";
include_once "./controller/IndexController.php";
include_once "./controller/HistoryController.php";
include_once './controller/MainController.php';

$history = new HistoryController;
$pub_db = new DbController;
$trigger = new TriggerController;
$ind_contrl = new IndexController;

?>
<html>
<head>
<meta charest="utf-8" />
<link rel="stylesheet" href="styles/stylefor5.css">
<title>Блог Тест php</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
<style type="text/css">
    body {
		color: #fff;
	}
</style>
</head>
<body>
<div class="container"> <br>
	<form method="post">
		Название файла<br>
		<input type="text" name="title" placeholder="Название писать сюда" value="<?=DbController::SelectNewsById()['title']?>"><br>
		Содержимое файла<br>
		<textarea name="content" placeholder="Новость писать сюда"><?=DbController::SelectNewsById()['content']?></textarea><br>

        <br>
		<input type="submit" name="init_add" value="Сохранить">
		<input type="submit" name="init_edit" value="Редактировать">
	</form>
</div>

<div>
	<form method="post">
		Удалить запись
		<input type="submit" name="init_dell" value="Удалить"><br>
	</form>
</div>

<?php
// выполнение запросов
$pub_db->SetId_Post();
$pub_db->AddNews();
$pub_db->DeleteNews();
$pub_db->edit();

// Вывод новостей
$ind_contrl->InitNews();
$ind_contrl->PrintErrors();

//$trigger -> test1('name_column', 'content_column');
?>

</body>
</html>
