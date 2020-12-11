<?php
$DS = DIRECTORY_SEPARATOR;
require_once dirname(__DIR__) . $DS . 'lib' . $DS . 'File.php';
$arr = array('model','Model.php');
require_once File::build_path($arr);


if(empty($_POST['email']) OR empty($_POST['password'])) {
	header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=2");
	exit();
} else {
	try{
    	$rep = Model::$pdo->prepare("SELECT * FROM p_users WHERE email=:mail LIMIT 1");
    	$values = array(
    		"mail" => $_POST['email']
    	);
    	$rep->execute($values);
    	$result = $rep->fetch(PDO::FETCH_ASSOC);
    	if(!empty($result))
		{
			if($result["actif"]=='0'){
				header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=3");
				exit();
				//doit activer son compte
			}else {
      			$password = $result["password"];
				$isPasswordCorrect = password_verify($_POST['password'],$password);
				if($isPasswordCorrect) {
					//setCookies ou session
					session_start();
					$_SESSION["login"]=$result["id"];
					$_SESSION["admin"]=$result["admin"];
					header("Location: .." . $DS . "index.php");
					exit();
				} else {
					header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=1");
					exit();
				}
			}
		}else {
			header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=1");
			exit();
		}

    } catch(PDOException $e) {
      die();
    }
}
?>