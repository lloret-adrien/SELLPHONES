<?php 
if($_GET['action']=='update') { 
  $action_value = 'updated';
  $title="Mise à jour";
}else{
  $action_value = 'created';
  $title="Nouvelle Offre";
}

$marque = $o->get("marque");
$couleur = strtolower($o->get("couleur"));
$etat = $o->get("etat");
$prix = $o->get("prix");
$stockage = $o->get("stockage");
$description = $o->get("description");
$modele = $o->get("modele");
if(isset($_SESSION["erreur"])){
  foreach ($_SESSION["erreur"] as $key => $value) {
    $$key=$value;
  }
  unset($_SESSION["erreur"]);
}
?>
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30">
          <img src="images/icons/selllogo.png" alt="ff">
        </div>
        <div class="col-md-6 p-b-30">

  <form method="post" action="./form/verifoffers.php">
      <h4 class="m-text26 p-b-36 p-t-15">
        <?php echo $title;?>
      </h4>
    <?php
      if(isset($_SESSION["array_error"])) {
        foreach ($_SESSION["array_error"] as $value) {
          echo '<p class="error">' . $value . '</p>';
        }
        unset($_SESSION["array_error"]);
      }
    ?>
      <div class="flex-m flex-w m-b-20">
          <div class="s-text15 w-size15 t-center">
              Marque
          </div>
          <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
              <select class="selection-2" name="marque">
                <option <?php if($marque=="Apple"){echo "selected";} ?>>Apple</option>
                <option <?php if($marque=="Samsung"){echo "selected";} ?>>Samsung</option>
                <option <?php if($marque=="Huawei"){echo "selected";} ?>>Huawei</option>
                <option <?php if($marque=="Wiko"){echo "selected";} ?>>Wiko</option>
                <option <?php if($marque==null && $action_value=="updated"){echo "selected";} ?>>Autre</option>
              </select>
          </div>
      </div>

      <div class="bo4 of-hidden size15 m-b-20">
        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Modèle" name="modele" id="modele_id" required value="<?php echo $modele;?>" />
      </div>

      <div class="flex-m flex-w m-b-20">
          <div class="s-text15 w-size15 t-center">
              État
          </div>
          <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
              <select class="selection-2" name="etat">
                <option <?php if($etat=="Abîmé"){echo "selected";} ?>>Abîmé</option>
                <option <?php if($etat=="Bon état"){echo "selected";} ?>>Bon état</option>
                <option <?php if($etat=="Comme neuf"){echo "selected";} ?>>Comme neuf</option>
              </select>
          </div>
      </div>

      <div class="bo4 of-hidden size15 m-b-20">
          <input class="sizefull s-text7 p-l-22 p-r-22" type="number" id="prix" name="prix" placeholder="Prix de vente (€)" min="10" value="<?php echo $prix;?>">
      </div>

      <div class="bo4 of-hidden size15 m-b-20">
          <input class="sizefull s-text7 p-l-22 p-r-22" type="number" id="stockage" name="stockage" placeholder="Capacité de stockage (Go)" min="1" value="<?php echo $stockage;?>">
      </div>

      <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="description" placeholder="Description" maxlength="300"><?php echo $description;?></textarea>

      <div class="filter-color p-t-22 p-b-50 bo3">
              <div class="m-text15 p-b-12">
                Couleur
              </div>

              <ul class="flex-w">
                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="cyan" <?php if($couleur=="cyan"){echo "checked";} ?>>
                  <label class="color-filter color-filter1" for="color-filter1"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="bleu" <?php if($couleur=="bleu"){echo "checked";} ?>>
                  <label class="color-filter color-filter2" for="color-filter2"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="orange" <?php if($couleur=="orange"){echo "checked";} ?>>
                  <label class="color-filter color-filter3" for="color-filter3"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="rouge" <?php if($couleur=="rouge"){echo "checked";} ?>>
                  <label class="color-filter color-filter4" for="color-filter4"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="beige" <?php if($couleur=="beige"){echo "checked";} ?>>
                  <label class="color-filter color-filter5" for="color-filter5"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="noir" <?php if($couleur=="noir"){echo "checked";} ?>>
                  <label class="color-filter color-filter6" for="color-filter6"></label>
                </li>

                <li class="m-r-10">
                  <input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="gris" <?php if($couleur=="gris"){echo "checked";} ?>>
                  <label class="color-filter color-filter7" for="color-filter7"></label>
                </li>
              </ul>
            </div>

      <div class="w-size25">
        <input type='hidden' name='action' value="<?php echo "$action_value"; ?>">
        <input type='hidden' name='controller' value="<?php echo 'offres'; ?>">
        <?php if($action_value=="updated"){ echo "<input type='hidden' name='offer_id' value='" . $o->get("offer_id") . "'\">";} ?>
        <input class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" value="Valider"/>
      </div>
  </form>

      </div>
    </div>
  </div>
</section>

<!-- Container Selection -->
  <div id="dropDownSelect1"></div>
  <div id="dropDownSelect2"></div>


<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect2')
    });
</script>