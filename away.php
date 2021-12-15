<?php
session_start();

unset($_SESSION['name_session']);
session_destroy();

setcookie("user", $_SESSION["name_session"],time()-3600, "/");

header("location:enter.php");
?>