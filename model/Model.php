<?php
//require_once dirname(__DIR__) . '/index.php';
$arr = array('config','conf.php');
require_once File::build_path($arr);
class Model {
  public static $pdo;
  public static function Init() {
    try{
      $login = Conf::getLogin();
      $hostname = Conf::getHostname();
      $database_name = Conf::getDatabase();
      $password = Conf::getPassword();
      self::$pdo = new PDO("mysql:host=" . $hostname . ";dbname=" . $database_name,$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function selectAll() {
    try {
      $table_name = static::$object;
      $class_name = "Model" . ucfirst($table_name);
      if($table_name=="p_offers"){
        if(isset($_SESSION["login"])) { 
          $rep = self::$pdo->query("SELECT * FROM $table_name WHERE quantite>0 AND user_id!=" . $_SESSION['login']);
        }else {
          $rep = self::$pdo->query("SELECT * FROM $table_name WHERE quantite>0");
        }
      }else {
        $rep = self::$pdo->query("SELECT * FROM $table_name");
      }
      $rep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
      $tab_voit = $rep->fetchAll();
      $tab = array();
      foreach ($tab_voit as $voit) {
        $tab[]=$voit;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function select($primary_value) {
    try {
      $table_name = static::$object;
      $class_name = "Model" . ucfirst($table_name);
      $primary_key = static::$primary;
      $sql = "SELECT * from $table_name WHERE $primary_key=:nom_tag";
      // Préparation de la requête
      $req_prep = self::$pdo->prepare($sql);

      $values = array(
         "nom_tag" => $primary_value,
        //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
      $tab = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab)) {
        return false;
      }
      return $tab[0];
    } catch(PDOException $e) {
      die();
    }
  }

  public static function isAdmin() {
    $b = false;
    if(isset($_SESSION["login"]) && isset($_SESSION["admin"]) && $_SESSION["admin"]=='1') {
      $b =true;
    }
    return $b;
  }

  public static function del($primary_value) {
    try {
      $table_name = static::$object;
      if(self::isAdmin() OR ($table_name=="p_offers" AND static::isMyOffer($primary_value))) {
        $class_name = "Model" . ucfirst(strtolower($table_name));
        $primary_key = static::$primary;
        $req = self::$pdo->prepare("DELETE FROM $table_name WHERE $primary_key=:value");
        $req->execute(array(
          'value' => $primary_value));
      }
    } catch(PDOException $e) {
      die();
    }
  }

  /*public static function update($data) {
    try {
      $table_name = static::$object;
      $class_name = "Model" . ucfirst(strtolower($table_name));
      $primary_key = static::$primary;
      $setters = "";
      $val = "";
      if(array_key_exists("offer_id",$data)){
        $val = "\"value\" => '" . $data["offer_id"] . "',";
        unset($data["offer_id"]);
      }
      foreach ($data as $cle => $valeur) {
        $setters = $setters . "$cle=:$cle,";
        $val = $val . " \"$cle\" => '$valeur',";
      }
      $set = rtrim($setters,",");
      $arr = rtrim($val,",");
      $req = Model::$pdo->prepare("UPDATE $table_name SET $set WHERE $primary_key=:value");
      $req->execute(array($arr));
    } catch(PDOException $e) {
      die();
    }
  }*/

  /*public static function save($data) {
    try {
      $table_name = static::$object;
      $class_name = "Model" . ucfirst(strtolower($table_name));
      $primary_key = static::$primary;
      $setters = "";
      $val = "";
      foreach ($data as $cle => $valeur) {
        $setters += ":$cle,";
        $val += "'$cle' => $valeur,";
      }
      $set = rtrim($setters,",");
      $arr = rtrim($val,",");
      $req = Model::$pdo->prepare("INSERT INTO $table_name VALUES($setters)");
      $req->execute(array($arr));
    } catch(PDOException $e) {
      die();
    }
  }*/

  public static function nbStats($b) {
    try{
      $nb = 0;
      if($b==1) {
        $rep = Model::$pdo->query("SELECT COUNT(DISTINCT id_produit) FROM p_contient");
      }
      else if($b==2) {
        /*$lundi = new DateTime();
        $lundi->setTimestamp(strtotime('last Monday',time()));
        $lundi = date_format($lundi, 'Y-m-d H:i:s');
        $dimanche = new DateTime();
        $dimanche->setTimestamp(strtotime('this Sunday',time()));
        $dimanche = date_format($dimanche, 'Y-m-d H:i:s');*/

        $rep = Model::$pdo->query("SELECT COUNT(DISTINCT id_produit) FROM p_contient c JOIN p_commande p ON c.id_commande=p.id_commande WHERE DATEDIFF(NOW(),date_commande) < 7");
      }else if($b==3) {
        $rep = Model::$pdo->query("SELECT SUM(prix) FROM p_offers o JOIN p_contient c ON o.offer_id=c.id_produit");
      }
      else {
        $rep = Model::$pdo->query("SELECT COUNT(*) FROM p_users");
      }
      $arr = $rep->fetch();
      $nb = $arr[0];
    }catch(PDOException $e) {
      die();
    }
    return $nb;
  }

  public static function stats($b) {
    try{
      if($b==1) {
        $rep = Model::$pdo->query("UPDATE p_stats SET o_modif=o_modif+1");
      }
      else if($b==2) {
        $rep = Model::$pdo->query("UPDATE p_stats SET o_delete=o_delete+1");
      }
      else {
        $rep = Model::$pdo->query("UPDATE p_stats SET o_create=o_create+1");
      }
    }catch(PDOException $e) {
      die();
    }
  }

  public static function search($val) {
    try {
      $table_name = static::$object;
      $class_name = "Model" . ucfirst(strtolower($table_name));
      $search = static::$search;
      $like = "";
      foreach ($search as $valeur) {
        $like = $like . " $valeur LIKE '%" . $val . "%' OR";
      }
      $arr = rtrim($like,"OR");
      $rep = self::$pdo->query("SELECT * FROM $table_name WHERE $arr");
      $rep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
      $tab_voit = $rep->fetchAll();
      $tab = array();
      foreach ($tab_voit as $voit) {
        $tab[]=$voit;
      }
      return $tab;
    }catch(PDOException $e) {
      die();
    }
  }

}
Model::Init();
?>