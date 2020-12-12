<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background: linear-gradient(#e66465, #9198e5);">
		<h2 class="l-text2 t-center">
			Téléphonie mobile
		</h2>
		<p class="m-text13 t-center">
			La meilleure offre sur le marché !
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">

						<h4 class="m-text14 p-b-7">
							Marque
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="index.php" class="s-text13 active1">
									Toutes
								</a>
							</li>

							<li class="p-t-4">
								<a href="?action=readMarque&marque=Apple" class="s-text13">
									Apple
								</a>
							</li>

							<li class="p-t-4">
								<a href="?action=readMarque&marque=Samsung" class="s-text13">
									Samsung
								</a>
							</li>

							<li class="p-t-4">
								<a href="index.php?action=readMarque&marque=Huawei" class="s-text13">
									Huawei
								</a>
							</li>

							<li class="p-t-4">
								<a href="index.php?action=readMarque&marque=Wiko" class="s-text13">
									Wiko
								</a>
							</li>
						</ul>

						<h4 class="m-text14 p-b-32">
							Filtres
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Prix
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<button id="price" class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filtrer
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Tranche : €<span id="value-lower">610</span> - €<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						<div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Couleur
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="cyan" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="cyan"){echo "checked";}?>>
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="bleu" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="bleu"){echo "checked";}?>>
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="orange" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="orange"){echo "checked";}?>>
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="rouge" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="rouge"){echo "checked";}?>>
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="beige" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="beige"){echo "checked";}?>>
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="noir" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="noir"){echo "checked";}?>>
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="gris" <?php if(isset($_GET["couleur"])&& $_GET["couleur"]=="gris"){echo "checked";}?>>
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
						</div>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Rechercher..." id="text_search">

							<button id="search" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
							<?php
							if(isset($_SESSION["search_error"])) {
								echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Erreur</span>
											Caractères spéciaux interdits !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
								unset($_SESSION["search_error"]);
							}
						?>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Par default</option>
									<option>Anciennes</option>
									<option>Récentes</option>
									<option>Prix croissant</option>
									<option>Prix décroissant</option>
								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							<?php
							$nb = count($offres);
							if ($nb == 0) {
								echo "Aucun résultat";
							}else if ($nb == 1) {
								echo "1 résultat";
							}else {
								echo $nb . " résultats";
							}
							?>
						</span>
					</div>

					<!-- Product -->
					<div class="row">
					<?php 
					foreach ($offres as $o) {

						$date_publication = $o->get("date");
						$date = new DateTime($date_publication);
						$now = new DateTime();
						if ($date->diff($now)->format("%d") > 0) {
							$d = "";
						}else {
							$d = "block2-labelnew";
						}
						echo '<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ' . $d . '">
									<img src="images/iphone2.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>';
						if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin']==1){
							echo 	'<a href="index.php?action=deleteMyOffer&offre_id=' . $o->get("offer_id") .'" class="delete">
											<svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  											<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  											<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
											</svg>
										</a>';
						}

						echo 	'<div class="block2-btn-addcart w-size1 trans-0-4" id="'. $o->get("offer_id") . '">
									<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Ajouter panier
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="index.php?action=read&offre_id=' . $o->get("offer_id") . '" class="block2-name dis-block s-text3 p-b-5">'
										. htmlspecialchars($o->get("modele")) .
									'</a>

									<span class="block2-price m-text6 p-r-5">€'
										. htmlspecialchars($o->get("prix")) .
									'</span>
								</div>
							</div>
						</div>';
					}?>
					</div>

					<!-- Pagination -->
					<?php /*echo '<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>'*/?>
				</div>
			</div>
		</div>
	</section>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-1").select2({minimumResultsForSearch:20,dropdownParent:$('#dropDownSelect1')});
		$(".selection-2").select2({minimumResultsForSearch:20,dropdownParent:$('#dropDownSelect2')});
	</script>
	
  
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <script src="vendor/daterangepicker/moment.min.js"></script>


  	<!-- Tranche de prix -->
	<script src="vendor/noui/nouislider.min.js"></script>
	<script src="vendor/noui/nouislider.js"></script>
	<script>
		var filterBar=document.getElementById('filter-bar');
		noUiSlider.create(filterBar,{start:[10,999],connect:true,range:{'min':10,'max':999}});
		var skipValues=[document.getElementById('value-lower'),document.getElementById('value-upper')];
		filterBar.noUiSlider.on('update',function(values,handle){
			skipValues[handle].innerHTML=Math.round(values[handle]);});
	</script>

	<script>
		$(".m-r-10 input").click(function () {
			const color = $(this).attr('name');
  			document.location.href="index.php?action=readColor&couleur=" + color;
		});

		$("#search").click(function () {
			var input = $(this).parent().children().first();
			var text = input.val();
  			if(text!="") {
  				document.location.href="index.php?action=search&search=" + encodeURIComponent(text);
  			}
		});

		$("#price").click(function () {
			var min = $('#value-lower').html();
			var max = $('#value-upper').html();
  			document.location.href="index.php?action=readPrix&min="+min+"&max="+max;
		});
	</script>

	<script type="text/javascript">
	var content = $(".header-cart");
	var panier = [<?php echo '"'.implode('","', $_SESSION["panier"]).'"' ?>];
    var nbProduct = parseInt($('.header-icons-noti').html());
    $('.block2-btn-addcart').each(function(){
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      var prix = $(this).parent().parent().parent().find('.block2-price').html();
      $(this).on('click', function(){
      	var offer_id = $(this).attr('id');
      	if(panier.indexOf(offer_id)>-1) {
    		swal(nameProduct, "se trouve déjà dans votre panier !", "error");
    	}else {
    		nbProduct++;
        	$('.header-icons-noti').html(nbProduct);
        	swal(nameProduct, "a été ajouter au panier !", "success");  		
			content.prepend('<li class="header-cart-item"><div class="header-cart-item-img" id="'+ offer_id +'"><img src="images/iphone2.jpg" alt="IMG"></div><div class="header-cart-item-txt"><a href="index.php?action=read&offre_id=' + offer_id + '" class="header-cart-item-name">' + nameProduct +'</a><span class="header-cart-item-info">'+prix+'</span></div></li>');
    	}
      });
    });

    $('.block2-btn-addwishlist').each(function(){
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");
      });
    });
  </script>