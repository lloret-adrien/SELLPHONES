<?php
	echo '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
											<span class="badge badge-pill badge-primary">Success</span>
											L\'offre a bien été mise à jour !
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
	$arr = array('view','offres','product-detail.php');
	require_once File::build_path($arr);
?>