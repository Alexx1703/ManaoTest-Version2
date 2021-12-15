<?php

include 'model.php'; 

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){ //проверка на Ajax запрос.если не соответствует,то код далее не выполняется
  json_encode($_POST, JSON_UNESCAPED_UNICODE);
    $result = array(   //Формируем массив для JSON ответа
      'login' => $_POST["login"],
      'pass' => $_POST["pass"],
      'conf_pass' => $_POST["conf_pass"],
      'email' => $_POST["email"],
      'name' => $_POST["name"],
    ); 

if (isset($_POST["login"]) && isset($_POST["pass"]) && isset($_POST["conf_pass"]) && isset($_POST["email"]) && isset($_POST["name"])) { 

if (!empty($_POST)){
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $conf_pass = filter_var(trim($_POST['conf_pass']),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);

    if (mb_strlen($login) <5 ) {  
	    header('location: index.php');
    }     
    if (mb_strlen($pass) <5) {
      header('location: index.php');
    } 
    if (($conf_pass)!==($pass))  {  //проверка на одинаковые строки пароля,если не одинаковые,регистрация не проходит
      header('location: index.php');
    }
      if (filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            header('location: index.php');
    } 
    if (mb_strlen($name)!==2){
      header('location: index.php');
     }

    if (!empty($login) && !empty($pass) && !empty($conf_pass) && !empty($email) && !empty($name)) {

      $connectDb = new Model('include/model.json'); // подключение к БД

      if ($pass == $conf_pass) {

          $unicLogin = $connectDb->selectField("login", $login); // поиск в бд логина
          $unicEmail = $connectDb->selectField("email", $email); // поиск в бд email

          if ($unicLogin == false && $unicEmail == false) { //уникальность логина и пароля

              $sdd= md5($pass ."gbphj3654"); //пароль+соль
                   
              $newUser = ["login" => "$login", "pass" => "$sdd", "email" => "$email", "name" => "$name"];

              $res = $connectDb->createTable($login, $newUser);  //внесение данных в бд
                
                if ($res == true) {
                    header('location: welcome.php');            
                  }else{
                    header('location: index.php');                        
                }
          }
        }
      }
    }
  }
}

?>

