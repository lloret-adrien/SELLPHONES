<?php 
	$DS = DIRECTORY_SEPARATOR;
	if(isset($_SESSION["login"]) AND !empty($_SESSION["login"])) {
		session_unset();
		session_destroy();
		header("Location: ." . $DS . "index.php");
		exit();
	}
?>