<?php

include 'model.php'; 

session_start();

if(isset($_SESSION["name_session"])){  // если сессия открыта,перенаправляем на страницу welcom.php
    header("Location: welcome.php");
    exit();
}

 if(!empty($_POST['login'])) {  // открытие новой сессии и установка cookies

     $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);

     $connectDb = new Model('include/model.json'); 
     $select = $connectDb->selectTable($login); 

     while ($row = $select) { 
         $userDb = $row['name'];
         break;
    }
     $_SESSION['name_session'] = $userDb;

     setcookie("user", $_SESSION["name_session"],time()+3600, "/");
     
     header("Location: welcome.php");
    }

include 'include/header.php';

?>

<div class="container mt-4 col-4">
	<div class="col">
		<form action="" id="auth" name="auth" method="post" style="display:none">
			<h1>Авторизация</h1></br>
			<input type="text" class="form-control" name="login" id="login"  placeholder="Введите ваш логин (мин.6 символов)" minlength="6" pattern="^\w\S+$" required ></br>                    
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Введите ваше пароль (мин.6 букв или цифр)" pattern="^[A-Za-zА-Яа-яЁё0-9]\S*$" minlength="6" required></br>
			<p><a href="index.php">Еще не зарегистрированы?</a></p>
			<button type="submit" class="btn btn-success mb-5" id="auth_user" name="auth_user">Войти</button>
		</form>
	</div>
</div>

<script>
  document.getElementById( "auth" ).style.display = "block"; //форма открывается при помощи js. А если он выключен в браузере, то формы нет на странице
</script>
<noscript><h1>Включите JavaScript в Вашем браузере!Без включения отправка формы будет невозможна!</h1></noscript>  <!-- //выводим сообщение пользователю,что бы включил js --> 

<?php
include 'include/footer.php';
?>	

