<?php
$DS = DIRECTORY_SEPARATOR;
require_once dirname(__DIR__) . $DS . 'lib' . $DS . 'File.php';
$arr = array('model','Model.php');
require_once File::build_path($arr);

	if(empty($_POST['first_name']) OR empty($_POST['last_name']) OR empty($_POST['email2']) OR empty($_POST['password2']) OR empty($_POST['password_confirm']))
	{
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=4");
		exit();
	}
	
	if(strlen($_POST['first_name']) < 3) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=5");
		exit();
	}
	
	if(strlen($_POST['first_name']) > 10) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=5");
		exit();
	}
	
	if(!ctype_alnum($_POST['first_name'])) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=6");
		exit();
		//ne contient pas que des lettres ou des chiffres
	}
		
	if(strlen($_POST['last_name']) < 3) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=5");
		exit();
	}
	
	if(strlen($_POST['last_name']) > 10) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=5");
		exit();
	}
	
	if(!ctype_alnum($_POST['last_name'])) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=6");
		exit();
		//ne contient pas que des lettres ou des chiffres
	}
	
	if(!filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=7");
		exit();
		//email non valide
	}

	try{
    	$check_email = Model::$pdo->prepare("SELECT COUNT(*) AS nb FROM p_users WHERE email=:mail LIMIT 1");
    	$values = array(
    		"mail" => $_POST['email2']
    	);
    	$check_email->execute($values);
    	$result = $check_email->fetch(PDO::FETCH_ASSOC);
    	if($result["nb"]=='1')
		{
			header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=8");
			exit();
			//email déjà utilisé
		}
    
		if(strlen($_POST['password2']) < 6) {
			header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=9");
			exit();
			//mdp trop court
		}

		if($_POST['password2'] != $_POST['password_confirm']) {
			header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=10");
			exit();
			//les mdp ne correspondent pas
		}

		/* Générer la clé de validation par email */
		$cle = md5(microtime(TRUE)*100000);

		/* Insérer dans la db l'utilisateur */
		$pass_hache = password_hash($_POST['password2'], PASSWORD_DEFAULT);

		//on aurait peut-être dû utilisé les fonctions du mvc
		$user = Model::$pdo->prepare("INSERT INTO p_users (`nom`, `prenom`, `email`, `password`, `cle`) VALUES (:nom,:prenom,:mail,:mdp,:cle)");
    	$values = array(
    		"nom" => $_POST['last_name'],
    		"prenom" => $_POST['first_name'],
    		"mail" => $_POST['email2'],
    		"mdp" => $pass_hache,
    		"cle" => $cle
    	);
    	$user->execute($values);
    	
		$destinataire = $_POST["email2"];
		$sujet = "Activer votre compte";
		$entete = "De: sell_contact@yopmail.com";
 
		// Le lien d'activation est composé du login(log) et de la clé(cle)
		$message = 'Bienvenue sur Sell Phones,
 
		Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
		ou copier/coller dans votre navigateur Internet.
 
		https://webinfo.iutmontp.univ-montp2.fr/~lloreta/SELLPHONES_code/form/validation.php?log='.urlencode($_POST["email2"]).'&cle='.urlencode($cle).'


		---------------------------------------------------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';
		mail($destinataire, $sujet, $message, $entete);//envoie du mail

    	/* Redirection avec notif */
		header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&success=1");
		exit();
		//indique que l'inscription est prise en compte mais qu'il doit l'activé par mail
	} catch(PDOException $e) {
    	die();
	}
?>