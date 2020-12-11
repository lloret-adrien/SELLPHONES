<?php
$arr = array('model','ModelP_users.php');
require_once File::build_path($arr);
class ControllerUtilisateur{

    public static function login() {
        if(!isset($_SESSION["login"])) {
            $arr = array('view','view.php');
            $controller='utilisateur';
            $view='login';
            $pagetitle='Connexion';
            require_once File::build_path($arr); 
        }else {
            static::logout();
        }
    }

    public static function logout() {
        if(isset($_SESSION["login"])) {
            $arr = array('form','logout.php');
            require_once File::build_path($arr);
        }else {
            static::login();
        }
    }

    public static function contact() {
        $arr = array('view','view.php');
        $controller='utilisateur';
        $view='contact';
        $pagetitle='Contact';
        require_once File::build_path($arr);
    }

    public static function getProfil() {
        if(isset($_GET["user_id"]) && !empty($_GET["user_id"])){//aller sur la page d'un autre
            $u = ModelP_users::select($_GET["user_id"]);
            if($u != false) {
                $right = ModelP_users::haveRight($_GET["user_id"]);//ai-je le droit sur cet user ?
                $orders = ModelP_users::getMyOrders($u);
                $arr = array('view','view.php');
                $controller='utilisateur';
                $view='profil';
                $pagetitle='Profil';
                require_once File::build_path($arr);
            }else {
                //retourne à l'accueil
                $DS = DIRECTORY_SEPARATOR;
                header('Location: .' . $DS . 'index.php');
                exit();
            }
        }else {
            //retourne à l'accueil
            $DS = DIRECTORY_SEPARATOR;
            header('Location: .' . $DS . 'index.php');
            exit();
        }
    }

    public static function readAll() {
        if(ModelP_users::isAdmin()) {
        $users = ModelP_users::selectAll();
        $arr = array('view', 'view.php');
        $controller='utilisateur';
        $view='list';
        $pagetitle='Utilisateurs';
        require_once File::build_path($arr);
        }else{
            $DS = DIRECTORY_SEPARATOR;
            header("Location: ." . $DS . "index.php");
            exit();
        }
    }

    public static function delete() {
        if(ModelP_users::isAdmin() && isset($_GET["user_id"]) && !empty($_GET["user_id"])) {
            $u = ModelP_users::select($_GET["user_id"]);
            if($u==false) {
                //compte non existant
                $_SESSION["notExist"]=true;
            }else if($u->get("admin")!="1"){
                $u::del($u->get("id"));
                $_SESSION["deleteComplete"]=true;
            }else {
                //ne peut pas supprimer un compte admin
                $_SESSION["deleteAdmin"]=true;
            }
        }
        static::readAll();
    }

    /*public static function read($login) {
    	$u = ModelUtilisateur::select($login);
    	//vérifié si le login existe
    	if($u==false) {
        	$controller='utilisateur';
            $arr = array('view','view.php');
            $view='error';
            $pagetitle='Erreur';
            require_once File::build_path($arr);
    	} else {
        	$controller='utilisateur';
            $arr = array('view','view.php');
            $pagetitle='Détail';
            $view='detail';
            require_once File::build_path($arr);
    	}
    }

    public static function create() {
        $arr = array('view','view.php');
        $controller='utilisateur';
        $view='update';
        $pagetitle='Insertion';
        $u = new ModelUtilisateur();
        require_once File::build_path($arr);
    }
    public static function created($l,$n,$p) {
        $utilisateur = new ModelUtilisateur($l,$n,$p);
        $utilisateur->save();
        $arr = array('view','view.php');
        $view='created';
        $pagetitle='Création';
        $controller='utilisateur';
        $user = ModelUtilisateur::selectAll();
        require_once File::build_path($arr);
    }

    public static function update($login) {
        $arr = array('view','view.php');
        $controller='utilisateur';
        $view='update';
        $pagetitle='Mise à jour';
        $u = ModelUtilisateur::select($login);
        require_once File::build_path($arr);
    }
    public static function updated($l,$n,$p) {
        $u = ModelUtilisateur::select($i);
        $u->update($l,$n,$p);
        $arr = array('view','view.php');
        $view='updated';
        $pagetitle='Mise à jour';
        $controller='utilisateur';
        require_once File::build_path($arr);
    }*/
}
?>