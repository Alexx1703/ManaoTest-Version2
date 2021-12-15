<?php

session_start();

if(!isset($_SESSION["name_session"])):  //направляем для входа для создания сессии
    header("location: enter.php");
else:
	
include 'include/header.php';	
?>

	<div class="jumbotron">
  		<h1 class="display-5">Приветствуем Вас на нашем сайте,<?php echo $_SESSION['name_session'];?>!</h1> 
  		<p class="display-7">Благодарим Вас за регистрацию на нашем сайте! Для выхода наждите <a href="away.php">здесь</a>.</p>
  		<hr class="my-6">
	</div>

<?php
include 'include/footer.php';
?>

<?php 
endif;
?> 

