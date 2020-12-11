<?php
require_once dirname(__DIR__) . '/index.php';
$arr = array('model','Model.php');
require_once File::build_path($arr);
$arr2 = array('model','ModelP_users.php');
require_once File::build_path($arr2);
class ModelP_offers extends Model{
   
  protected static $object = 'p_offers';
  protected static $primary='offer_id';
  protected static $search = array("marque","modele","couleur","description","etat");

  private $offer_id;
  private $user_id;
  private $marque;
  private $modele;
  private $couleur;
  private $prix;
  private $description;
  private $photo;
  private $stockage;
  private $etat;
  private $date;
  private $quantite;

  public function get($nom_attribut) {
    return $this->$nom_attribut;
  }

  public function set($nom_attribut,$valeur) {
    $this->$nom_attribut = $valeur;
  }

  public function __construct($data=NULL)  {
    if (!is_null($data)) {
      $this->offer_id = print_r($data['offer_id']);
      $this->user_id = print_r($data['user_id']);
      $this->marque = print_r($data['marque']);
      $this->modele = print_r($data['modele']);
      $this->couleur = print_r($data['couleur']);
      $this->prix = print_r($data['prix']);
      $this->description = print_r($data['description']);
      $this->photo = print_r($data['photo']);
      $this->stockage = print_r($data['stockage']);
      $this->etat = print_r($data['etat']);
      $this->date = print_r($data['date']);
      $this->quantite = print_r($data['quantite']);
    }
  }

  public static function getByMarque($m) {
    try{
      $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq");
      $values = array(
        "marq" => $m
      );
      $rep->execute($values);
      $offers = $rep->fetchAll(PDO::FETCH_OBJ);
      $tab = array();
      foreach ($offers as $o) {
        $tr = new ModelP_offers();
        $tr->set("offer_id",$o->offer_id);
        $tr->set("user_id",$o->user_id);
        $tr->set("marque",$o->marque);
        $tr->set("modele",$o->modele);
        $tr->set("couleur",$o->couleur);
        $tr->set("prix",$o->prix);
        $tr->set("description",$o->description);
        $tr->set("photo",$o->photo);
        $tr->set("stockage",$o->stockage);
        $tr->set("etat",$o->etat);
        $tr->set("date",$o->date);
        $tab[]=$tr;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function getByColor($c) {
    try{
      $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE couleur=:cl");
      $values = array(
        "cl" => $c
      );
      $rep->execute($values);
      $offers = $rep->fetchAll(PDO::FETCH_OBJ);
      $tab = array();
      foreach ($offers as $o) {
        $tr = new ModelP_offers();
        $tr->set("offer_id",$o->offer_id);
        $tr->set("user_id",$o->user_id);
        $tr->set("marque",$o->marque);
        $tr->set("modele",$o->modele);
        $tr->set("couleur",$o->couleur);
        $tr->set("prix",$o->prix);
        $tr->set("description",$o->description);
        $tr->set("photo",$o->photo);
        $tr->set("stockage",$o->stockage);
        $tr->set("etat",$o->etat);
        $tr->set("date",$o->date);
        $tab[]=$tr;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function getMyOffers($login) {
    try{
      $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE user_id=:user");
      $values = array(
        "user" => $login
      );
      $rep->execute($values);
      $offers = $rep->fetchAll(PDO::FETCH_OBJ);
      $tab = array();
      foreach ($offers as $o) {
        $tr = new ModelP_offers();
        $tr->set("offer_id",$o->offer_id);
        $tr->set("user_id",$o->user_id);
        $tr->set("marque",$o->marque);
        $tr->set("modele",$o->modele);
        $tr->set("couleur",$o->couleur);
        $tr->set("prix",$o->prix);
        $tr->set("description",$o->description);
        $tr->set("photo",$o->photo);
        $tr->set("stockage",$o->stockage);
        $tr->set("etat",$o->etat);
        $tr->set("date",$o->date);
        $tab[]=$tr;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function getByPrice($d,$f) {
    try{
      $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE prix>=:min AND prix<:max");
      $values = array(
        "min" => $d,
        "max" => $f
      );
      $rep->execute($values);
      $offers = $rep->fetchAll(PDO::FETCH_OBJ);
      $tab = array();
      foreach ($offers as $o) {
        $tr = new ModelP_offers();
        $tr->set("offer_id",$o->offer_id);
        $tr->set("user_id",$o->user_id);
        $tr->set("marque",$o->marque);
        $tr->set("modele",$o->modele);
        $tr->set("couleur",$o->couleur);
        $tr->set("prix",$o->prix);
        $tr->set("description",$o->description);
        $tr->set("photo",$o->photo);
        $tr->set("stockage",$o->stockage);
        $tr->set("etat",$o->etat);
        $tr->set("date",$o->date);
        $tab[]=$tr;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function getBySelection($m,$c,$min,$max) {
    try{
      if($m=='null' && $c=='null' && $min!=0 && $max!=0){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE prix>=:min AND prix<:max");
        $values = array(
        "min" => $min,
        "max" => $max
      );
      } elseif($c=='null' && $min==0 && $max==999999 && $m != 'null'){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq");
        $values = array(
        "marq" => $m
      );
      } elseif ($m=='null' && $min==0 && $max==999999 && $c != 'null'){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE couleur=:cl");
        $values = array(
        "cl" => $c
      );
      }elseif ($m=='null' && $c=='null' && $min!=0 && $max==999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE prix>=:min");
        $values = array(
        "min" => $min
      );
      }elseif ($m=='null' && $c=='null' && $min==0 && $max!=999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE prix<:max");
        $values = array(
        "max" => $max
      );
      }elseif ($m!='null' && $c!='null' && $min==0 && $max==999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq AND couleur=:cl");
        $values = array(
        "cl" => $c,
        "marq" => $m
      );
      }elseif ($m!='null' && $c=='null' && $min!=0 && $max!=999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq AND prix>=:min AND prix<:max");
        $values = array(
        "marq" => $m,
        "min" => $min,
        "max" => $max
      );
      }elseif ($m=='null' && $c!='null' && $min!=0 && $max!=999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE couleur=:cl AND prix>=:min AND prix<:max");
        $values = array(
        "cl" => $c,
        "min" => $min,
        "max" => $max
      );
      }elseif ($m=='null' && $c!='null' && $min!=0 && $max==999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE couleur=:cl AND prix>=:min");
        $values = array(
        "cl" => $c,
        "min" => $min,
      );
      }elseif ($m=='null' && $c!='null' && $min==0 && $max!=999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE couleur=:cl AND prix<:max");
        $values = array(
        "cl" => $c,
        "max" => $max
      );
      }elseif ($m!='null' && $c=='null' && $min==0 && $max!=999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq AND prix<:max");
        $values = array(
        "marq" => $m,
        "max" => $max
      );
      }elseif ($m!='null' && $c=='null' && $min!=0 && $max==999999){
        $rep = Model::$pdo->prepare("SELECT * FROM p_offers WHERE marque=:marq AND prix>=:min");
        $values = array(
        "marq" => $m,
        "min" => $min
      );
      }
      $rep->execute($values);
      $offers = $rep->fetchAll(PDO::FETCH_OBJ);
      $tab = array();
      foreach ($offers as $o) {
        $tr = new ModelP_offers();
        $tr->set("offer_id",$o->offer_id);
        $tr->set("user_id",$o->user_id);
        $tr->set("marque",$o->marque);
        $tr->set("modele",$o->modele);
        $tr->set("couleur",$o->couleur);
        $tr->set("prix",$o->prix);
        $tr->set("description",$o->description);
        $tr->set("photo",$o->photo);
        $tr->set("stockage",$o->stockage);
        $tr->set("etat",$o->etat);
        $tr->set("date",$o->date);
        $tab[]=$tr;
      }
      return $tab;
    } catch(PDOException $e) {
      die();
    }
  }

  public static function nbByMarque($marque) {
    $nb = 0;
    try{
      $rep = Model::$pdo->prepare("SELECT COUNT(*) FROM p_offers WHERE marque=:m");
      $values = array(
        "m" => $marque
      );
      $rep->execute($values);
      $arr = $rep->fetch();
      $nb = $arr[0];
    }catch(PDOException $e) {
      die();
    }
    return $nb;
  }

  public static function contains($ref_article)
  {
    $present = false;
    if(count($_SESSION['panier']) > 0 && in_array($ref_article,$_SESSION['panier']) !== false)
    {
      $present = true;
    }
    return $present;
  }

  public static function isMyOffer($id) {
    $b = false;
    if(isset($_SESSION["login"])) {
      try {
        $req = self::$pdo->prepare("SELECT user_id FROM p_offers WHERE offer_id=:id");
        $req->execute(array(
          'id' => $id));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)) {
          if($result["user_id"]==$_SESSION["login"]) {
            $b = true;
          }
        }
      }catch(PDOException $e) {
        die();
      }
    }
    return $b;
  }

  public static function isValid($offer_id) {
    $b = false;
    try {
        $req = self::$pdo->prepare("SELECT quantite FROM p_offers WHERE offer_id=:id");
        $req->execute(array(
          'id' => $offer_id));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if($result>0){
          $b = true;
        }
    }catch(PDOException $e) {
      die();
    }
    return $b;
  }

  public static function save($data) {
    try {
      $req = Model::$pdo->prepare("INSERT INTO p_offers VALUES('',:u,:marq,:mod,:c,:p,:d,null,:s,:e,NOW(),1)");
      $req->execute(array(
          'u' => $data["user_id"],
          'marq' => $data["marque"],
          'mod' => $data["modele"],
          'c' => $data["couleur"],
          'p' => $data["prix"],
          'd' => $data["description"],
          's' => $data["stockage"],
          'e' => $data["etat"]
        ));
    } catch(PDOException $e) {
      die();
    }
  }

  public static function update($data) {
    try {
      $req = Model::$pdo->prepare("UPDATE p_offers SET marque=:marq,modele=:mod,couleur=:c,prix=:p,description=:d,stockage=:s,etat=:e WHERE offer_id=:value");
      $req->execute(array(
        'value' => $data["offer_id"],
        'marq' => $data["marque"],
        'mod' => $data["modele"],
        'c' => $data["couleur"],
        'p' => $data["prix"],
        'd' => $data["description"],
        's' => $data["stockage"],
        'e' => $data["etat"]
      ));
    } catch(PDOException $e) {
      die();
    }
  }

  public static function getHistoSales() {
    try {
      $sql = Model::$pdo->query("SELECT * FROM `p_contient` c JOIN `p_commande` p ON c.id_commande=p.id_commande JOIN `p_offers` o ON o.offer_id=c.id_produit ORDER BY `date_commande` DESC LIMIT 10");
      return $sql;
    } catch(PDOException $e) {
      die();
    }
  }


  public static function getTopSellers() {
    try {
      $top = Model::$pdo->query("SELECT sum(prix) AS total,id_client,nom,prenom FROM `p_contient` c JOIN `p_commande` p ON c.id_commande=p.id_commande JOIN `p_offers` o ON o.offer_id=c.id_produit JOIN `p_users` u ON u.id=p.id_client GROUP BY id_client ORDER BY total DESC LIMIT 10");
      return $top;
    } catch(PDOException $e) {
      die();
    }
  }
}
?>