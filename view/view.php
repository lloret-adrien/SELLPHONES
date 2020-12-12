<?php
$arr = array('model','Model.php');
require_once File::build_path($arr);


try {
  if(!isset($_SESSION['login'])) {
    $l = "login";
  }
  else
  {
    $l = "getProfil&controller=utilisateur&user_id=" . $_SESSION["login"];
    $rep = Model::$pdo->prepare("SELECT * FROM p_users WHERE id=:id LIMIT 1");
    $values = array(
      "id" => $_SESSION["login"]
    );
    $rep->execute($values);
    $result = $rep->fetch(PDO::FETCH_ASSOC);
  }

  $products = array();
  if($_SESSION["panier"]!==array()) {
    $sql = Model::getPanier();
    $prixPanier = Model::prixPanier();
    while ($rep = $sql->fetch()) {
                    $products[]='<li class="header-cart-item">
                          <div class="header-cart-item-img" id="' . $rep[0] .'">
                            <img src="images/iphone2.jpg" alt="IMG">
                          </div>

                          <div class="header-cart-item-txt">
                            <a href="index.php?action=read&offre_id=' . $rep[0] . '" class="header-cart-item-name">
                              ' . $rep[3] . ' - ' . $rep[8] . '
                            Go</a>

                            <span class="header-cart-item-info">
                              €' . $rep[5] . '
                            </span>
                          </div>
                          </li>';
    }

  }

} catch(PDOException $e) {
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $pagetitle; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--TEST-->
  <?php 
  if($pagetitle=="Administration" OR $pagetitle=="Utilisateurs") { 
    echo '<link href="css/theme.css" rel="stylesheet" media="all">
          <link href="vendor/wow/animate.css" rel="stylesheet" media="all">';
  }elseif ($pagetitle=="Profil") {
    echo '<link href="css/profil.css" rel="stylesheet" media="all">';
  }?>
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">


  <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.css">
  <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

  <!-- Header -->
  <header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
      <div class="topbar">
        <div class="topbar-social">
          <a href="#" class="topbar-social-item fa fa-facebook"></a>
          <a href="#" class="topbar-social-item fa fa-instagram"></a>
          <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
          <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
          <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
        </div>

        <span class="topbar-child1">
          Livraison gratuite pour les commandes supérieure à 100€
        </span>

        <div class="topbar-child2">
          <span class="topbar-email">
            sell_contact@gmail.com
          </span>
        </div>
      </div>

      <div class="wrap_header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <img src="images/icons/logogif.gif" alt="IMG-LOGO">
          <img src="images/icons/logotext.png" alt="IMG-LOGO">
        </a>

        <!-- Menu -->
        <div class="wrap_menu">
          <nav class="menu">
            <ul class="main_menu">
              <li>
                <a href="index.php">Boutique</a>
              </li>
<?php /*
              <li  class="sale-noti" >
                <a href="product.html">Sale</a>
              </li>
      */
?>
              <li>
                <a href="index.php?action=readPanier">Panier</a>
              </li>
<?php
  if(!empty($result)) {
        echo  '<li>
                <a href="index.php?action=myoffres&controller=offres">Mes Offres</a>
              </li>';
      if($result["admin"]=="1") {
         echo  '<li>
                <a href="index.php?action=admin">Administration</a>
              </li>';
      }
  }
?>
              <li>
                <a href="index.php?action=contact&controller=utilisateur">Contact</a>
              </li>
            </ul>
          </nav>
        </div>

        <!-- Header Icon -->
        <div class="header-icons">
          <a href="index.php?controller=utilisateur&action=<?php echo $l;?>" class="header-wrapicon1 dis-block">
            <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            <?php 
              if(!empty($result)) {
                echo $result["prenom"] . " " . $result["nom"];
              }else {
                echo "Se connecter";
              }
            ?>
          </a>
        <?php if(!empty($result)) {
          echo '<span class="linedivide1"></span>

          <a href="index.php?controller=utilisateur&action=logout" class="header-wrapicon1 dis-block"><span class="zmdi zmdi-power-setting"></span></a>';
        }
        ?>
          <span class="linedivide1"></span>

          <div class="header-wrapicon2">
            <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">
            <?php 
            $nb = 0;
            if($_SESSION["panier"]!==array()) {
              foreach ($_SESSION["panier"] as $value) {
                $nb++;
              }
            }
            echo $nb;
            ?>
            </span>
            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
              <ul class="header-cart-wrapitem">
                <?php 
                if($products!==array()) {
                  foreach ($products as $value) {
                    echo $value;
                  }
                }else {
                  echo "Aucun article dans votre panier";
                }
                ?>
                
              </ul>

              <div class="header-cart-total">
                Total: €<?php 
                if($_SESSION["panier"]!==array()) {
                  echo $prixPanier[0];
                }else {
                  echo 0;
                }
                ?>
              </div>

              <?php /*<div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    View Cart
                  </a>
                </div>

                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Check Out
                  </a>
                </div>*/?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
      <!-- Logo moblie -->
      <a href="index.php" class="logo-mobile">
        <img src="images/icons/logogif.gif" alt="IMG-LOGO">
        <img src="images/icons/logotext.png" alt="IMG-LOGO">
      </a>

      <!-- Button show menu -->
      <div class="btn-show-menu">
        <!-- Header Icon mobile -->
        <div class="header-icons-mobile">
          <a href="index.php?controller=utilisateur&action=<?php echo $l;?>" class="header-wrapicon1 dis-block">
            <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            <?php 
              if(!empty($result)) {
                echo $result["prenom"] . " " . $result["nom"];
              }else {
                echo "Se connecter";
              }
            ?>
          </a>

        <?php 
          if(!empty($result)) {
            echo '<span class="linedivide2"></span>

            <a href="index.php?controller=utilisateur&action=logout" class="header-wrapicon1 dis-block"><span class="zmdi zmdi-power-setting"></span></a>';
          }
        ?>

          <span class="linedivide2"></span>

          <div class="header-wrapicon2">
            <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">
            <?php
              echo $nb;
            ?>
            </span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
              <ul class="header-cart-wrapitem">

                <?php 
                if($_SESSION["panier"]!==array()) {
                  foreach ($products as $value) {
                    echo $value;
                  }
                }else {
                  echo "Aucun article dans votre panier";
                }
                ?>
              </ul>

              <div class="header-cart-total">
                Total: €<?php 
                if($_SESSION["panier"]!==array()) {
                  echo $prixPanier[0];
                }else {
                  echo 0;
                }
                ?>
              </div>
              <?php /*
              <div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    View Cart
                  </a>
                </div>

                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Check Out
                  </a>
                </div>
              </div>*/?>
            </div>
          </div>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
      <nav class="side-menu">
        <ul class="main-menu">
          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <span class="topbar-child1">
              Livraison gratuite pour les commandes supérieure à 100€            
            </span>
          </li>

          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <div class="topbar-child2-mobile">
              <span class="topbar-email">
                sell_contact@gmail.com
              </span>
            </div>
          </li>

          <li class="item-topbar-mobile p-l-10">
            <div class="topbar-social-mobile">
              <a href="#" class="topbar-social-item fa fa-facebook"></a>
              <a href="#" class="topbar-social-item fa fa-instagram"></a>
              <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
              <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
              <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>
          </li>

          <li class="item-menu-mobile">
            <a href="index.php">Boutique</a>
          </li>

          <li class="item-menu-mobile">
            <a href="index.php?action=readPanier">Panier</a>
          </li>
<?php
  if(!empty($result)) {
        echo  '<li class="item-menu-mobile">
                <a href="index.php?action=myoffres&controller=offres">Mes Offres</a>
              </li>';
      if($result["admin"]=="1") {
         echo  '<li class="item-menu-mobile">
                <a href="index.php?action=admin">Administration</a>
              </li>';
      }
  }
?>
          <li class="item-menu-mobile">
            <a href="index.php?action=contact&controller=utilisateur">Contact</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>





<?php
// Si €controleur='voiture' et €view='list',
// alors €filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>






  <!-- Footer -->
  <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
      <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
        <h4 class="s-text12 p-b-30">
          ENTRER EN CONTACT
        </h4>

        <div>
          <p class="s-text7 w-size27">
            Des questions ? Faites le nous savoir, 7 Avenue d'Iéna, 75116 Paris, ou appelez-nous au (+1) 96716 6879
          </p>

          <div class="flex-m p-t-30">
            <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
            <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
            <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
            <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
            <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
          </div>
        </div>
      </div>

      <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
        <h4 class="s-text12 p-b-30">
          Marque
        </h4>

        <ul>
          <li class="p-b-9">
            <a href="index.php?action=readMarque&marque=Apple" class="s-text7">
              Apple
            </a>
          </li>

          <li class="p-b-9">
            <a href="index.php?action=readMarque&marque=Samsung" class="s-text7">
              Samsung
            </a>
          </li>

          <li class="p-b-9">
            <a href="index.php?action=readMarque&marque=Huawei" class="s-text7">
              Huawei
            </a>
          </li>

          <li class="p-b-9">
            <a href="index.php?action=readMarque&marque=Wiko" class="s-text7">
              Wiko
            </a>
          </li>
        </ul>
      </div>

      <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
        <h4 class="s-text12 p-b-30">
          Liens
        </h4>

        <ul>
          <li class="p-b-9">
            <a href="index.php#text_search" class="s-text7">
              Recherche
            </a>
          </li>

          <li class="p-b-9">
            <a href="#" class="s-text7">
              A propos
            </a>
          </li>

          <li class="p-b-9">
            <a href="index.php?action=contact&controller=utilisateur" class="s-text7">
              Contact
            </a>
          </li>

          <li class="p-b-9">
            <a href="#" class="s-text7">
              Retour
            </a>
          </li>
        </ul>
      </div>

      <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
        <h4 class="s-text12 p-b-30">
          Aide
        </h4>

        <ul>
          <li class="p-b-9">
            <a href="#" class="s-text7">
              Suivi de commande
            </a>
          </li>

          <li class="p-b-9">
            <a href="#" class="s-text7">
              Retour
            </a>
          </li>

          <li class="p-b-9">
            <a href="#" class="s-text7">
              Livraison
            </a>
          </li>

          <li class="p-b-9">
            <a href="#" class="s-text7">
              FAQs
            </a>
          </li>
        </ul>
      </div>

      <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
        <h4 class="s-text12 p-b-30">
          Newsletter
        </h4>

        <form>
          <div class="effect1 w-size9">
            <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
            <span class="effect1-line"></span>
          </div>

          <div class="w-size2 p-t-20">
            <!-- Button -->
            <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
              Suivre
            </button>
          </div>

        </form>
      </div>
    </div>

    <div class="t-center p-l-15 p-r-15">
      <a href="#">
        <img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
      </a>

      <a href="#">
        <img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
      </a>

      <a href="#">
        <img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
      </a>

      <a href="#">
        <img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
      </a>

      <a href="#">
        <img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
      </a>

      <div class="t-center s-text8 p-t-20">
        Copyright © 2018 Tous droits réservés. | Ce modèle est fait avec <i class="fa fa-heart-o" aria-hidden="true"></i> par <a href="https://colorlib.com" target="_blank">Colorlib</a>
      </div>
    </div>
  </footer>



  <!-- Back to top -->
  <div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
      <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
  </div>

  <!-- Container Selection1 -->
  <div id="dropDownSelect1"></div>
  <div id="dropDownSelect2"></div>



<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
  <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/select2/select2.min.js"></script>
  <script type="text/javascript">
    $(".selection-1").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect1')
    });
  </script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
  <script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
 

  <script type="text/javascript">
    $(".header-cart-item-img").click(function () {
      const id = $(this).attr('id');
        document.location.href="index.php?action=removePanier&offre_id=" + id;
    });
  </script>

<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>