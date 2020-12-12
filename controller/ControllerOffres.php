<?php
$arr = array('model','ModelP_offers.php');
require_once File::build_path($arr);
class ControllerOffres{
    public static function readAll() {
        $offres = ModelP_offers::selectAll();
        $arr = array('view','view.php');
        $controller='offres';
        $view='product';
        $pagetitle='SellPhones - Shop';
        require_once File::build_path($arr);
    }
    public static function readMarque() {
        if(isset($_GET["marque"]) && !empty($_GET["marque"])) {
            $m = array('marque'=>$_GET["marque"]);
            $offres = ModelP_offers::getBy($m);
            $arr = array('view','view.php');
            $controller='offres';
            $view='product';
            $pagetitle='Boutique';
            require_once File::build_path($arr);
        }
        else {
            static::readAll();
        }
    }

    public static function readPrix() {
        if(isset($_GET["min"]) && is_numeric($_GET["min"])) {
            $min = $_GET["min"];
        }else {
            $min = 0;
        }
        if(isset($_GET["max"]) && is_numeric($_GET["max"])) {
            $max = $_GET["max"];
        }else {
            $max = 9999;
        }
        $prix = array("prix"=>array($min,$max));      
        $offres = ModelP_offers::getBy($prix);
        $arr = array('view','view.php');
        $controller='offres';
        $view='product';
        $pagetitle='Boutique';
        require_once File::build_path($arr);
    }

    public static function readColor() {
        if(isset($_GET["couleur"]) && !empty($_GET["couleur"])) {
            $color = array('couleur'=>$_GET["couleur"]);
            $offres = ModelP_offers::getBy($color);
            $arr = array('view','view.php');
            $controller='offres';
            $view='product';
            $pagetitle='Boutique';
            require_once File::build_path($arr);
        }
        else {
            static::readAll();
        }
    }
    public static function myoffres() {
        if(isset($_SESSION["login"])) {
            $l = array("user_id"=>$_SESSION["login"]);
            $offres = ModelP_offers::getBy($l);
            $arr = array('view','view.php');
            $controller='utilisateur';
            $view='mesoffres';
            $pagetitle='Mes Offres';
            require_once File::build_path($arr);
        }else {
            static::readAll();
        }
    }
    public static function read() {
        if(isset($_GET["offre_id"])) {
            $o = ModelP_offers::select($_GET["offre_id"]);
            //vérifié si le login existe
            if($o==false) {
                static::readAll();
            }else {
                $controller='offres';
                $arr = array('view','view.php');
                $pagetitle='Détail';
                $view='product-detail';
                require_once File::build_path($arr);
            }
        }else {
            static::readAll();
        }
    }
    public static function deleteMyOffer() {
        try {
            if(isset($_SESSION["login"]) AND isset($_GET["offre_id"]) AND !empty($_GET["offre_id"])) {
                $o = ModelP_offers::select($_GET["offre_id"]);
                if($o!=false && (ModelP_offers::isMyOffer($_GET["offre_id"]) OR isset($_SESSION["admin"])) && ModelP_offers::isValid($_GET["offre_id"])) {
                    ModelP_offers::del($_GET["offre_id"]);
                    ModelP_offers::stats(2);
                    $_SESSION["retirer"]=1;
                }
                static::myoffres();
            }else {
                static::readAll();
            }
        }catch(PDOException $e){
            die();
        }
    }
    public static function create() {
        if(isset($_SESSION["login"])) {
            $arr = array('view','view.php');
            $controller='offres';
            $view='update';
            $pagetitle='Nouvelle Offre';
            $o = new ModelP_offers();
            require_once File::build_path($arr);
        }else {
            static::readAll();
        }
    }
    public static function created() {
        if(isset($_SESSION["login"])) {
            if(isset($_SESSION["create"])) {
                $o = new ModelP_offers();
                unset($_SESSION["create"]["controller"]);
                unset($_SESSION["create"]["action"]);
                $o->save($_SESSION["create"]);
                unset($_SESSION["create"]);
                ModelP_offers::stats(0);
                $_SESSION["creer"]=1;
            }
            static::myoffres();
        }else {
            static::readAll();
        }
    }
    public static function update() {
        if(isset($_SESSION["login"]) && isset($_GET["offre_id"]) && !empty($_GET["offre_id"])){
            $o = ModelP_offers::select($_GET["offre_id"]);
            if($o==false OR (ModelP_offers::isMyOffer($_GET["offre_id"])==false && !isset($_SESSION["admin"])) OR !ModelP_offers::isValid($_GET["offre_id"])){
                static::readAll();
            }else {
                $arr = array('view','view.php');
                $controller='offres';
                $view='update';
                $pagetitle='Modifications';
                require_once File::build_path($arr);
            }
        }else {
            static::readAll();
        }
    }
    public static function updated() {
        if(isset($_SESSION["login"]) && isset($_SESSION["create"])) {
            $o = ModelP_offers::select($_SESSION["create"]["offer_id"]);
            unset($_SESSION["create"]["user_id"]);
            unset($_SESSION["create"]["controller"]);
            unset($_SESSION["create"]["action"]);
            $o->update($_SESSION["create"]);
            $o = ModelP_offers::select($_SESSION["create"]["offer_id"]);
            unset($_SESSION["create"]);
            ModelP_offers::stats(1);
            $arr = array('view','view.php');
            $view='updated';
            $pagetitle='Mise à jour';
            $controller='offres';
            require_once File::build_path($arr);
        }else {
            static::readAll();
        }
    }

    public static function readPanier() {
        $panier = ModelP_offers::getPanier();
        $prixPanier = ModelP_offers::prixPanier();
        $arr = array('view','view.php');
        $controller='utilisateur';
        $view='panier';
        $pagetitle='Panier';
        require_once File::build_path($arr);
    }

    public static function addPanier() {
        if(isset($_GET["offre_id"]) && !empty($_GET["offre_id"])) {
            if(ModelP_offers::isMyOffer($_GET["offre_id"])==true) {
                //ne peut pas ajouté une de ses offres dans son panier
                $_SESSION["add_panier"]=2;
            }else {
                $o = ModelP_offers::select($_GET["offre_id"]);
                if($o!==false && ModelP_offers::contains($o->get("offer_id"))==false) {
                    if(ModelP_offers::isValid($o->get("offer_id"))) {
                        //si l'offre existe et que le panier ne la contient pas on l'ajoute
                        $_SESSION["panier"][] = $o->get("offer_id");
                        $_SESSION["add_panier"]=1;
                    }else {
                        //stock épuisé
                        $_SESSION["stockExhausted"]=true;
                    }
                }
            }
        }
        static::readPanier();
    }

    public static function removePanier() {
        if(isset($_GET["offre_id"]) && !empty($_GET["offre_id"])) {
            if(ModelP_offers::contains($_GET["offre_id"])) {
                unset($_SESSION["panier"][array_search($_GET["offre_id"], $_SESSION["panier"])]);
                sort($_SESSION["panier"]);
                $_SESSION["retire_panier"]=1;
            }
        }
        static::readPanier();
    }

    public static function deletePanier() {
        if(!isset($_SESSION["buy_complete"])){
            if($_SESSION["panier"]!=array()) {
                $_SESSION["vidé"]=1;
            }else {
                $_SESSION["deja_vide"]=1;
            }
        }
        $_SESSION["panier"]=array();
        static::readPanier();
    }


    public static function buyPanier() {
        //achats que si le panier n'est pas vide et que la personne est connecté
        //sinon on lui retourne un massage d'erreur
        $nb = count($_SESSION["panier"]);
        if ($nb > 0 && isset($_SESSION["login"])){
            try {
                $sql = Model::$pdo->query("SELECT COUNT(*) FROM `p_offers` WHERE `offer_id` IN (".implode(',',$_SESSION["panier"]).") AND quantite>0");
                $rep = $sql->fetch();
                if($nb != $rep[0]){//vérifie si les offres sont toujours disponible
                    static::readPanier();
                }else {
                    //on récupère les offres
                    $sql = Model::$pdo->query("SELECT * FROM `p_offers` WHERE `offer_id` IN (".implode(',',$_SESSION["panier"]).")");

                    while($rep = $sql->fetch()) {//on enlève les offres qui appartienent au client
                        if(in_array($rep[1],$_SESSION['panier'])) {
                            unset($_SESSION["panier"][array_search($rep[1], $_SESSION["panier"])]);
                            $_SESSION["buyError"]=true;
                        }
                    }

                    if(!isset($_SESSION["buyError"])) {
                        //on récupère encore les offres
                        $sql = Model::$pdo->query("SELECT * FROM `p_offers` WHERE `offer_id` IN (".implode(',',$_SESSION['panier']).")");
                        //on diminue la quantite de stock de chaques offres
                        $req = Model::$pdo->query("UPDATE `p_offers` SET quantite=quantite-1 WHERE `offer_id` IN (".implode(',',$_SESSION['panier']).")");
                        //ajouter la commande
                        $req = Model::$pdo->prepare("INSERT INTO `p_commande` (`id_commande`, `id_client`,`date_commande`) VALUES ('',:id,NOW())");
                        $req->execute(array("id"=>$_SESSION["login"]));
                        //récupérer l'id de la commande
                        $req = Model::$pdo->prepare("SELECT `id_commande` FROM `p_commande` WHERE `id_client`=:id ORDER BY `date_commande` LIMIT 1");
                        $req->execute(array("id"=>$_SESSION["login"]));
                        $id_c = $req->fetch();
                        //boucle pour ajouter chaque produit dans la commande
                        while($rep = $sql->fetch()){
                            $req = Model::$pdo->prepare("INSERT INTO `p_contient` (`id_commande`,`id_produit`,`quantite`) VALUES (:idc,:idp,:qte)");
                            $values = array(
                                "idc" => $id_c[0],
                                "idp" => $rep[0],
                                "qte" => '1'
                            );
                            $req->execute($values);
                        }
                        //vider le panier
                        $_SESSION["buy_complete"]=true;
                        static::deletePanier();
                    }else {
                        static::readPanier();
                    }
                }
            } catch(PDOException $e) {
                die();
            }
        }else {
            if(!isset($_SESSION["login"])){
                $_SESSION["not_connected"]=true;
            }
            static::readPanier();
        }
    }

    public static function admin() {
        if(isset($_SESSION["login"]) && isset($_SESSION["admin"]) && $_SESSION["admin"]=="1") {
            $apple = ModelP_offers::nbByMarque("Apple");
            $samsung = ModelP_offers::nbByMarque("Samsung");
            $huawei = ModelP_offers::nbByMarque("Huawei");
            $wiko = ModelP_offers::nbByMarque("Wiko");
            $autre = ModelP_offers::nbByMarque("Autre");
            $inscrit = ModelP_offers::nbStats(0);
            $vendu = ModelP_offers::nbStats(1);
            $thisweek = ModelP_offers::nbStats(2);
            $total = ModelP_offers::nbStats(3);
            $sales = ModelP_offers::getHistoSales();
            $top = ModelP_offers::getTopSellers();

            $arr = array('view','view.php');
            $controller='utilisateur';
            $view='admin';
            $pagetitle='Administration';
            require_once File::build_path($arr);
        }else {
            static::readAll();
        }
    }

    public static function search() {
        if(isset($_GET["search"]) && !empty($_GET["search"])) {
            if(htmlspecialchars($_GET["search"]) != $_GET["search"] OR stristr($_GET["search"], "'")) {
                $_SESSION["search_error"]=1;
                static::readAll();
            }else {
                $offres = ModelP_offers::search($_GET["search"]);
                $arr = array('view','view.php');
                $controller='offres';
                $view='product';
                $pagetitle='Boutique';
                require_once File::build_path($arr);
            }
        }else {
            static::readAll();
        }
    }
}
?>