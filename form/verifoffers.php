<?php
	//https://openclassrooms.com/forum/sujet/garder-champs-formulaire-si-erreur-de-saisie-74240
	session_start();
	if(!isset($_SESSION["login"])){
		//return accueil
	}
	$_SESSION["erreur"]=$_POST;//var session qui stocke les données des champs du formulaire
	$errors = array();

    $couleur = array("cyan","bleu","orange","rouge","beige","noir","gris");
    $nb = 0;
    foreach ($_POST as $key => $value) {
    	if(in_array($key, $couleur)) {
    		$nb++;
    	}
    }
    if(isset($_POST["marque"]) && isset($_POST["modele"]) && isset($_POST["prix"]) && isset($_POST["description"]) && isset($_POST["stockage"]) && isset($_POST["etat"]) && !empty($_POST["marque"]) && !empty($_POST["modele"]) && !empty($_POST["prix"]) && !empty($_POST["description"]) && !empty($_POST["stockage"]) && !empty($_POST["etat"])) {

            if($nb!=1) {
            	$errors[] = "Une seule couleur doit être cochée (obligatoire)";
            }

            if(!is_numeric($_POST["prix"]) OR (is_numeric($_POST["prix"]) && $_POST["prix"]<10)) {
            	$errors[] = "Le prix doit être une valeur numérique supérieure à 10 euros";
            }

            $marque = array("Apple","Samsung","Huawei","Wiko","Autre");
            if(!in_array($_POST["marque"], $marque)) {
            	$errors[] = "La marque doit faire partie la liste";
            }

            $etat = array("Abîmé","Bon état","Comme neuf");
            if(!in_array($_POST["etat"], $etat)) {
            	$errors[] = "L'état doit faire partie de la liste.";
            }

            if(!is_numeric($_POST["stockage"]) OR (is_numeric($_POST["stockage"]) AND $_POST["stockage"]>1000)) {
            	$errors[] = "Le stockage doit être une valeur numérique inférieure à 1 To";
            }

            if(strlen($_POST["modele"])>30) {
            	$errors[] = "Le nom du modèle est trop long (max 30 carac)";
            }

            if(strlen($_POST["description"])>300){
            	$errors[] = "La description est trop longue (max 300 carac)";
            }
    }else {
        $errors[] = "Veuillez remplir tous les champs";
    }

    $DS = DIRECTORY_SEPARATOR;
	if($errors === array()){
		//on valide
		$_SESSION["create"]=$_SESSION["erreur"];
		unset($_SESSION["erreur"]);
		$_SESSION["create"]["user_id"]=$_SESSION["login"];
		foreach ($_SESSION["create"] as $key => $value) {
			if(in_array($key, $couleur)) {
				$c=$key;//on récupère la couleur
				unset($_SESSION["create"][$key]);
				$_SESSION["create"]["couleur"] = $c;
			}
		}
		if($_POST["action"]=="updated" OR $_POST["action"]=="created") {
			header("Location: .." . $DS . "index.php?action=" . $_POST["action"]);
		}else {
			unset($_SESSION["create"]);
			header("Location: .." . $DS . "index.php");
		}
		exit();
		//print_r($_SESSION["create"]);
	}else {
		//retour formulaire
		$_SESSION["array_error"]=$errors;
		if($_POST["action"]=="updated") {
			$p = "?action=update&offre_id=" . $_POST["offer_id"];
		}else if ($_POST["action"]!="created") {
			header("Location: .." . $DS . "index.php");
			exit();
		}else {
			$p = "?action=create";
		}
		header("Location: .." . $DS . "index.php" . $p);
		exit();
	}
?>