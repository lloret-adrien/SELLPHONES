<?php
try {
	if($_SESSION["panier"]!==array()) {
    	$sql = Model::$pdo->query("SELECT * FROM `p_offers` WHERE `offer_id` IN (".implode(',',$_SESSION["panier"]).")");
    	$sql2 = Model::$pdo->query("SELECT SUM(prix) FROM `p_offers` WHERE `offer_id` IN (".implode(',',$_SESSION["panier"]).")");
    	$prixPanier = $sql2->fetch();
  	}
} catch(PDOException $e) {
  die();
}
?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background: linear-gradient(#3633ca, #9286d0);">
		<h2 class="l-text2 t-center">
			Mon Panier
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<?php
			if(isset($_SESSION["retire_panier"])) {
				echo '<div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
											<span class="badge badge-pill badge-secondary">Success</span>
											L\'offre a bien été retirer de votre panier.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				unset($_SESSION["retire_panier"]);
			}else if(isset($_SESSION["add_panier"])) {
				if($_SESSION["add_panier"]==1) {
				echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
											<span class="badge badge-pill badge-success">Success</span>
											L\'offre a bien été ajouter a votre panier !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				}else if($_SESSION["add_panier"]==2){
					echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Erreur</span>
											Vous ne pouvez ajouter à votre panier une offre qui vous appartient..
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				}
				unset($_SESSION["add_panier"]);
			}else if (isset($_SESSION["not_connected"])) {
				echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Erreur</span>
											Vous devez être connecté pour finaliser vos achats
											<a href="?controller=utilisateur&action=login" class="alert-link"> connectez-vous</a>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				unset($_SESSION["not_connected"]);
			}else if(isset($_SESSION["buy_complete"])) {
				echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
											<span class="badge badge-pill badge-success">Success</span>
											Merci à vous !
											<a href="#" class="alert-link"> suivre mes commandes</a>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				unset($_SESSION["buy_complete"]);
			}else if (isset($_SESSION["buyError"])) {
				echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Erreur</span>
											Vous ne pouvez pas acheter vos propres offres
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
				unset($_SESSION["buyError"]);
			}

			if($_SESSION["panier"]!==array()) {
				echo '
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Produit</th>
							<th class="column-3">Prix</th>
							<th class="column-7">Couleur</th>
							<th class="column-4" style="text-align: center;">Quantité</th>
							<th class="column-6">Actions</th>
						</tr>';
						
						while ($rep = $sql->fetch()) {
							$c = strtolower($rep[4]);
							if($c =="cyan") {
								$c = "1";
							}else if($c=="bleu") {
								$c = "2";
							}else if($c=="orange") {
								$c = "3";
							}else if($c=="rouge") {
								$c = "4";
							}else if($c=="beige") {
								$c = "5";
							}else if($c=="noir") {
								$c = "6";
							}else if($c=="gris") {
								$c = "7";
							}else {
								$c ="";
							}

						echo '<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden" id="' . $rep[0] .'">
									<img src="images/iphone.jpg" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">' . htmlspecialchars($rep[3]) . '</td>
							<td class="column-3">€'. htmlspecialchars($rep[5]).'</td>
							<td class="column-7">
								<p style="text-align: center;">
									<li class="m-r-10">
										<input class="checkbox-color-filter" id="color-filter' . $c .'" type="checkbox" name="cyan">
										<label style ="margin-left: 15px;" class="color-filter color-filter' . $c .'" for="color-filter' . $c .'"></label>
									</li>
								</p>
							</td>
							<td class="column-4">
								<p style="text-align: center;">1</p>
							</td>
						
							<td class="column-6"><a href="index.php?action=removePanier&offre_id=' . $rep[0] .'"> Retirer</a>
							</td>
						</tr>';
						}

						echo '</table>
						</div>
					</div>
				</div>

				<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Code Promo">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Appliquer
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<a href="index.php?action=deletePanier">
						Vider le panier
					</a>
				</div>
			</div>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					TOTAL
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Sous-total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						€' . $prixPanier[0] . '
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Livraison :
					</span>

					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							Les frais d\'expédition s\'élève à 2% du sous-total
						</p>

						<!--<span class="s-text19">
							Calculate Shipping
						</span>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="country">
								<option>Select a country...</option>
								<option>US</option>
								<option>UK</option>
								<option>Japan</option>
							</select>
						</div>

						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
						</div>

						<div class="size14 trans-0-4 m-b-10">
							
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Update Totals
							</button>
						</div>-->
					</div>
				</div>

				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						€' . intval($prixPanier[0]+$prixPanier[0]*0.02) . '
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="buy">
						Procéder au paiement
					</button>
				</div>
			</div>
		';
					}else {
						if(isset($_SESSION["vidé"])){
							echo '<div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
											<span class="badge badge-pill badge-secondary">Success</span>
											Vote panier a bien été vidé !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
							unset($_SESSION["vidé"]);
						}else if (isset($_SESSION["deja_vide"])) {
							echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Erreur</span>
											Votre panier était déjà vide.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
							unset($_SESSION["deja_vide"]);
						}
						echo '<div class="alert alert-warning" role="alert">
											Vous n\'avez aucun article dans votre panier
											rendez-vous sur la
											<a href="index.php" class="alert-link"> boutique</a> pour en rajouter.
										</div>';
					}
					?>
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

	<script type="text/javascript">
    $(".cart-img-product").click(function () {
      const id = $(this).attr('id');
        document.location.href="index.php?action=removePanier&offre_id=" + id;
    });

    $("#buy").click(function () {
        document.location.href="index.php?action=buyPanier";
    });
  </script>