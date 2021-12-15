<?php

include 'model.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){  //проверка на Ajax запрос.если не соответствует,то код далее не выполняется
    json_encode($_POST, JSON_UNESCAPED_UNICODE); 
     $result = array(  //Формируем массив для JSON ответа
      'login' => $_POST["login"],
      'pass' => $_POST["pass"],
  );

if((!empty($_POST['login'])) && (!empty($_POST['pass']))) {

	$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

		if (mb_strlen($login)<5) {  //дополнительная защита
			header ('Location: enter.php');
		} 
		if (mb_strlen($pass)<5) {
   			header ('Location: enter.php');
		}

        if (!empty($login) && !empty($pass)){

		$connectDb = new Model("include/model.json"); //подключение к бд

		$res = $connectDb->selectTable($login); // поиск в базе данных по полю Логин
			
            if ($res !== false) {
            	while ($row = $res) { 
                	$loginDb = $row['login'];
                	$passDb = $row['pass'];
                break;
            	}

     			$sdd2= md5($pass ."gbphj3654");   
     			
     			if ($login == $loginDb && $sdd2 == $passDb) { // проверка совпадения логина и пароля в бд	
                	header('location: welcome.php');
            		} else {
            		header('location: enter.php');
            		}
    		}else{ 
            	header('location: enter.php');
        	}
	}else {
        header('location: index.php');
    }
  }  
}

?>
