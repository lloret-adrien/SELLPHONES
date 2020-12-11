<?php
//require_once dirname(__DIR__) . '/index.php';
$arr = array('model','Model.php');
require_once File::build_path($arr);
$arr2 = array('model','ModelP_offers.php');
require_once File::build_path($arr2);

class ModelP_users extends Model {
   
  protected static $object = 'p_users';
  protected static $primary='id';
  protected static $search = array("id","nom","prenom","email");

  private $id;
  private $nom;
  private $prenom;
  private $email;
  private $password;
  private $admin;
  private $cle;
  private $actif;

  public function get($nom_attribut) {
    return $this->$nom_attribut;
  }

  public function set($nom_attribut,$valeur) {
    $this->$nom_attribut = $valeur;
  }

  public function __construct($data=NULL)  {
    if (!is_null($data)) {
      $this->id = print_r($data['id']);
      $this->nom = print_r($data['nom']);
      $this->prenom = print_r($data['prenom']);
      $this->email = print_r($data['email']);
      $this->password = print_r($data['password']);
      $this->admin = print_r($data['admin']);
      $this->cle = print_r($data['cle']);
      $this->actif = print_r($data['actif']);
    }
  }

  public static function haveRight($u) {
    $b = false;
    if(ModelP_users::isAdmin() OR (isset($_SESSION["login"]) && $_SESSION["login"]==$u)) {
      $b = true;
    }
    return $b;
  }

  public static function getMyOrders($u) {
    try {
      $sql = Model::$pdo->prepare("SELECT * FROM p_commande p JOIN p_contient c ON p.id_commande=c.id_commande JOIN p_offers o ON o.offer_id=c.id_produit WHERE `id_client`=:id GROUP BY c.id_commande,id_produit");
      $sql->execute(array("id"=>$u->get('id')));
      return $sql;
    } catch(PDOException $e) {
      die();
    }
  }
}
?>