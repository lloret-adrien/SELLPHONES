<?php
  	session_start();

  	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2700)) {
    	// last request was more than 45 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
	}else {
		$_SESSION['LAST_ACTIVITY'] = time();
	}

	if(!isset($_SESSION["panier"])) {
		$_SESSION["panier"]=array();
	}

	setcookie(session_name(),session_id(),time()+2700);

	$DS = DIRECTORY_SEPARATOR;
	require_once __DIR__ . $DS . 'lib' . $DS . 'File.php';
	$arr = array('controller','routeur.php');
	require_once File::build_path($arr);
?>