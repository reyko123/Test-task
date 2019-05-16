<?php

/**
 * 
 */
class Login
{
	
	public $_login = NULL;

	function __construct()
	{
		if (count($_POST) > 0) {
			$this->_login = ($_POST ['login']);
		}
		
	}


	public function Login()
	{
    	if(count($_POST) > 0)
    	{
        
	        if($_POST['login'] == 'кубуська' ||  $_POST['login'] == 'Кубуська' ||  $_POST['login'] == 'Зязенька' ||  $_POST['login'] == 'Зязька' ||  $_POST['login'] == 'Зязик' ||  $_POST['login'] == 'Зязечка')
	        {
	            $_SESSION['auth'] = true; // Сессия

	            header('Location: postcard/index.php');
	            exit();
	        } else 
	        {
	        	return false;
	        }
	    }
    }


    public function FailLogin()
    {
    	if (!$this->Login() && count($_POST) > 0)
    	{
    		echo 'Испытание не пройдено. Попробуйте еще раз, Зязенька!';
    	}
    }

    public function Test()
	{
		print_r($this->_login);
	}

}