<?php
$DS = DIRECTORY_SEPARATOR;
require_once dirname(__DIR__) . $DS . 'lib' . $DS . 'File.php';
$arr = array('model','Model.php');
require_once File::build_path($arr);

if(!isset($_GET['log']) OR !isset($_GET['cle']) OR empty($_GET['log']) OR empty($_GET['cle'])) {
  header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=11");
  exit();
}else {
  // Récupération des variables nécessaires à l'activation
  $login = $_GET['log'];
  $cle = $_GET['cle'];
 
  // Récupération de la clé correspondant au $login dans la base de données
  try{
    $stmt = Model::$pdo->prepare("SELECT cle,actif FROM p_users WHERE email LIKE :mail ");
    if($stmt->execute(array(':mail' => $login)) && $row = $stmt->fetch())
    {
      $clebdd = $row['cle'];    // Récupération de la clé
      $actif = $row['actif']; // $actif contiendra alors 0 ou 1
    }
 
    // On teste la valeur de la variable $actif récupérée dans la BDD
    if($actif == '1') // Si le compte est déjà actif on prévient
    {
      header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&success=2");
      exit();
    }
    else // Si ce n'est pas le cas on passe aux comparaisons
    {
      if($cle == $clebdd) // On compare nos deux clés
      {
        // Si elles correspondent on active le compte !    
        try {
        // La requête qui va passer notre champ actif de 0 à 1
        $stmt = Model::$pdo->prepare("UPDATE p_users SET actif = 1 WHERE email like :mail ");
        $stmt->bindParam(':mail', $login);
        $stmt->execute();
        }catch(PDOException $e) {
          die();
        }

        header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&success=3");
        exit();
      }
      else // Si les deux clés sont différentes on provoque une erreur...
      {
        header("Location: .." . $DS . "index.php?controller=utilisateur&action=login&error=11");
        exit();
      }
    }
  }catch(PDOException $e) {
    die();
  }
}
?>