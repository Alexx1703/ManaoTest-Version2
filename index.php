<?php

include 'include/header.php';
include 'model.php';

?>

<div class="container mt-4 col-4">
		<div class="col"> 
			<div id="result_form"></div> 
			<form action="" id="reg" name="reg" method="POST" style="display:none">
				<h1>Регистрация</h1></br>
				<input type="text" class="form-control" name="login" id="login"  placeholder="Введите ваш логин (мин.6 символов)" minlength="6" pattern="^\w\S+$" required ></br>					
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите ваше пароль (мин.6 букв или цифр)" pattern="^[A-Za-zА-Яа-яЁё0-9]\S*$" minlength="6" required></br>
				<input type="password" class="form-control" name="conf_pass" id="conf_pass" placeholder="Подтвердите ваш пароль (пароли должны совпадать)" pattern="^[A-Za-zА-Яа-яЁё0-9]*$" minlength="6" required></br>
				<input type="email" class="form-control" name="email" id="email" placeholder="Введите ваш email" required></br>
				<input type="text" class="form-control" name="name" id="name" placeholder="Введите ваше имя (только 2 буквы)" pattern="^[A-Za-zА-Яа-яЁё]+$" minlength="2" maxlength="2" required></br>
				<p><a href="enter.php">Уже зарегистрированы?</a></p>
				<button type="submit" class="btn btn-success mb-2" value='submit' id="regist" name="regist">Зарегистрироваться</button>				
			</form>
		</div>	
</div>

<script>
  document.getElementById( "reg" ).style.display = "block"; //форма открывается при помощи js. А если он выключен в браузере, то формы нет на странице
</script>
<noscript><h1>Включите JavaScript в Вашем браузере!Без включения отправка формы будет невозможна!</h1></noscript>  <!-- //выводим сообщение пользователю,что бы включил js --> 
	
<?php
include 'include/footer.php';
?>	

