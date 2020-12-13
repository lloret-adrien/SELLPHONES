<div class="wrapper">
    <div class="picture">
      <img id='profil' src="./images/icons/incognito.png" alt="pdp">
      <?php
      if($right==true){
      	echo'
      <a href="#" class="">
        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMjAwJyBoZWlnaHQ9JzIwMCcgZmlsbD0iI2ZmZmZmZiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxwYXRoIGQ9Ik00NDgsMTEyaC0zMmwtNjQtOTZIMjI0bC02NCw5NmgtMzJjMC0zNS4zNDQtMjguNjU2LTY0LTY0LTY0UzAsNzYuNjU2LDAsMTEydjY0djI1NmMwLDM1LjM0NCwyOC42NTYsNjQsNjQsNjRoMzg0ICBjMzUuMzQ0LDAsNjQtMjguNjU2LDY0LTY0VjE3NkM1MTIsMTQwLjY1Niw0ODMuMzQ0LDExMiw0NDgsMTEyeiBNODAsMjI0SDQ4Yy04Ljg0NCwwLTE2LTcuMTU2LTE2LTE2czcuMTU2LTE2LDE2LTE2aDMyICBjOC44NDQsMCwxNiw3LjE1NiwxNiwxNlM4OC44NDQsMjI0LDgwLDIyNHogTTY0LDE0NGMtMTcuNjcyLDAtMzItMTQuMzEzLTMyLTMyczE0LjMyOC0zMiwzMi0zMnMzMiwxNC4zMTMsMzIsMzJTODEuNjcyLDE0NCw2NCwxNDR6ICAgTTI4OCw0MzJjLTc5LjQwNiwwLTE0NC02NC41OTQtMTQ0LTE0NHM2NC41OTQtMTQ0LDE0NC0xNDRzMTQ0LDY0LjU5NCwxNDQsMTQ0UzM2Ny40MDYsNDMyLDI4OCw0MzJ6IE0zNjgsMjg4ICBjMCw0NC4xODgtMzUuODEzLDgwLTgwLDgwcy04MC0zNS44MTMtODAtODBzMzUuODEzLTgwLDgwLTgwUzM2OCwyNDMuODEzLDM2OCwyODh6Ij48L3BhdGg+PC9zdmc+">
      </a>';}
      ?>
    </div>
  
  <p>
  	<?php if($right==true){ echo '<i id="settings_profile" class="zmdi zmdi-settings"></i>';}?>
  	<strong><?php echo $u->get("prenom") . ' ' . $u->get("nom");?></strong>
  </p>
  
  </div>
</div>
<?php if($right==true){
	echo'<section id="change_profile" class="bgwhite p-t-66 p-b-60" style="display: none;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<form method="post" action="#">
						<h4 class="m-text26 p-b-36 p-t-15">
							Changez mon identifiant
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="firstname" placeholder="Prénom" id="firstname" required value="' . $u->get("prenom") .'">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="lastname" placeholder="Nom" id="lastname" required value="' . $u->get("nom") .'">
						</div>

						<div class="w-size25">
							<!-- Button -->
							<input type="submit" id="loginButton" value="Modifier" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
						</div>
					</form>
				</div>

				<div class="col-md-6 p-b-30">
					<form method="post" action="#">
						<h4 class="m-text26 p-b-36 p-t-15">
							Changez mon mot de passe
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password2" placeholder="Mot de passe actuel" id="password2" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password3" placeholder="Votre nouveau mot de passe" id="password3" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password_confirm" placeholder="Confirmez votre nouveau mot de passe" id="password_confirm" required>
						</div>

						<div class="w-size25">
							<!-- Button -->
							<input type="submit" value="Modifier" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
						</div>
					</form>
			</div>
		</div>
	</div>
</section>';


echo '<!-- Suivi des commandes -->
<div class="container_commandes m-4">
	<h1 class="mb-2">Mes commandes</h1>
	<div class="commandes">';
	if($orders->rowCount()>0){
		$idc = null;
		$total_price = 0;
		$close_ul = false;
		while($rep = $orders->fetch()) {
			$article_name = $rep[9] . ' ' .$rep[10] . ' ' . $rep[15] . 'Go ' . $rep[11];
			if($rep[0]!=$idc) {
                if($close_ul) {
                	echo '<li class="m-2">
                  		<p>Total</p>
                  		<span>€'. $total_price .'</span>
                		</li>
        				</ul>
        			</div>';
        			$total_price = 0;
                }
                echo '<div>
					<h5 class="p-3">Commande n°'. $rep[0] .'</h5>
					<ul class="offer_li flex-w" style="display: none;">
                	<li class="m-2">
                  	<p>'. $article_name .'</p>
                  	<span>€'. $rep[12] .'</span>
                	</li>';
                	$total_price = $rep[12];
                	$close_ul = true;
        	}else {
        		echo ' <li class="m-2">
                  <p>'. $article_name .'</p>
                  <span>€'. $rep[12] .'</span>
                </li>';
                $total_price += $rep[12];
        	}
        	$idc = $rep[0];
    	}
    	if($close_ul) {
            echo '<li class="m-2">
                <p>Total</p>
                <span>€'. $total_price .'</span>
                </li>
        		</ul>
        	</div>';
        	$total_price = 0;
        }
    }else {
		echo '<p>Cet utilisateur n\'a fait aucune commande</p>';
	}
echo '</div>
</div>';
}
?>

<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$('#settings_profile').click(function(){
    $('#change_profile').stop().slideToggle('slow');
});

$('.commandes div h5').click(function(){
    $(this).parent().find('ul').stop().slideToggle('slow');
});
</script>