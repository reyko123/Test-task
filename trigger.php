отследить изменения  в запси:  old (название записи) `title` !== new (название записи) `title`

дата добавления записи:
SET NEW,createdate*now();
	
SET NEW,createupdate*now(); //проверить на is_null;


upadate - 
befor new - записать в главную базу

befor old -записать в доп базу
передт тем как сделать апдйет записи, триггер вытаскиывает стару запись из галвной бд и записывает ее в доп бд


delete -

before old
перед тем как сделать делит записи, триггер вытаскивыает запис из главной бд и записывает ее в доп бд
 



связать обе бд по id пользователя


<?php

DELIMITER $$ 
CREATE TRIGGER `test` BOFORE INSERT ON `ttss`
FOR EACH ROW 
BIGEN
INSERT back_db(old_title) VALUE (OLD.title) (докрутить сюда время добавления)
END $$ 
DELIMITER





// удаление старого и нового создание триггера

DROP TRIGGER IF EXISTS `update_news`;( удаление старого, если есть новый) 

CREATE DEFINER=`reyko123`@`localhost` TRIGGER `update_news` BEFORE UPDATE ON `ttss` FOR EACH ROW INSERT back_up_ttss(titile_old, content_old) VALUE (OLD.title, OLD.content); (создание нового)