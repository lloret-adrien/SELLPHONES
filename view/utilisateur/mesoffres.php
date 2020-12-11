<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background: linear-gradient(#dc4646bf, #efd51073);">
		<h2 class="l-text2 t-center">
			Mes Offres
		</h2>
		<p class="m-text13 t-center">
			<?php
			$nb = count($offres);
			if ($nb == 0) {
				echo "Vous n'avez aucune offre";
			}else if ($nb == 1) {
				echo "Vous avez qu'une seule offre sur le marché";
			}else {
				echo "Vous avez " . $nb . " offres disponibles sur le marché";
			}
			?>
		</p>
</section>
<?php 
	if(isset($_SESSION["retirer"])) {
		echo '<div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
											<span class="badge badge-pill badge-secondary">Success</span>
											L\'offre a bien été supprimée !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
		unset($_SESSION["retirer"]);
	}else if (isset($_SESSION["creer"])) {
		echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
											<span class="badge badge-pill badge-success">Success</span>
											L\'offre a bien été créée !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
		unset($_SESSION["creer"]);
	}
?>
<div id="add">
<a id="add" href="index.php?action=create">Ajouter une offre</a>
</div>
<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
				<?php 
				if(count($offres)>0) {
						echo '<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Produit</th>
							<th class="column-3">Prix</th>
							<th class="column-7">Couleur</th>
							<th class="column-4" style="text-align: center;">Quantité</th>
							<th class="column-6">Actions</th>
						</tr>';

						foreach ($offres as $o) {
							$c = strtolower($o->get("couleur"));
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
								<div class="cart-img-product b-rad-4 o-f-hidden" id="' . $o->get("offer_id") .'">
									<img src="images/iphone.jpg" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">
							<a href="index.php?action=read&offre_id=' . $o->get("offer_id") . '" class="block2-name dis-block s-text3 p-b-5">'
										. htmlspecialchars($o->get("modele")) .
									'</a>
							</td>
							<td class="column-3">€'. htmlspecialchars($o->get("prix")).'</td>
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
						
							<td class="column-6"><a href="index.php?action=update&offre_id=' . $o->get("offer_id") .'">Modifier </a><br><a href="index.php?action=deleteMyOffer&offre_id=' . $o->get("offer_id") .'"> Retirer</a>
							</td>
						</tr>';
						}
					echo '</table>';
				}else {
					echo '<div class="alert alert-warning" role="alert">
							Vous n\'avez pas d\'offre sur notre site cliquez sur le bouton <i>ci-dessus</i> pour en faire une. Ou
							<a href="index.php?action=create" class="alert-link"> accéder au formulaire</a> directement.
							</div>';
				}
				?>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		$(".cart-img-product").click(function () {
			const id = $(this).attr('id');
  			document.location.href="index.php?action=deleteMyOffer&offre_id=" + id;
		});
	</script>