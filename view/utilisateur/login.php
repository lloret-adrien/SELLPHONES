	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<form method="post" action="./form/login.php">
						<h4 class="m-text26 p-b-36 p-t-15">
							Déjà inscris ? Connecte-toi
							<p class="error">
								<?php
									if(isset($_GET["error"]) AND !empty($_GET["error"])) {
										if ($_GET["error"]=='1') {
											echo 'Adresse email ou mot de passe incorrect';
										}else if ($_GET["error"]=='2') {
											echo 'Veuillez remplir tous les champs';
										}else if($_GET["error"]=='3') {
											echo 'Vous devez activer votre compte par mail';
										}
									}
								?>
							</p>
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse email" id="email" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe" id="password" required>
						</div>

						<div class="w-size25">
							<!-- Button -->
							<input type="submit" id="loginButton" value="Se connecter" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
						</div>
					</form>
				</div>

				<div class="col-md-6 p-b-30">
					<form method="post" action="./form/register.php">
						<h4 class="m-text26 p-b-36 p-t-15">
							Inscris-toi
								<?php
									if(isset($_GET["error"]) AND !empty($_GET["error"])) {
										echo '<p class="error">';
										if ($_GET["error"]=='4') {
											echo 'Veuillez remplir tous les champs';
										}else if ($_GET["error"]=='5') {
											echo 'Le nom et le prénom doit être compris entre 3 et 10 caractères';
										}else if($_GET["error"]=='6') {
											echo 'Seuls les lettres et les chiffres sont autorisées pour le nom et le prénom';
										}else if($_GET["error"]=='7') {
											echo 'Adresse email invalide';
										}else if($_GET["error"]=='8') {
											echo 'Adresse email déjà utilisée';
										}else if($_GET["error"]=='9') {
											echo 'Mot de passe trop court (min 6 caractères)';
										}else if($_GET["error"]=='10') {
											echo 'Les mots de passe ne correspondent pas';
										}else if($_GET["error"]=='11') {
											echo "Une erreur est survenue lors de l'activation de votre compte, veuillez nous contacter si cela persiste";
										}
										echo '</p>';
									}else if(isset($_GET["success"]) AND !empty($_GET["success"])) {
										echo '<p class="success">';
										if ($_GET["success"]=='1') {
											echo 'Vous avez reçu un lien par email pour valider votre compte';
										}else if ($_GET["success"]=='2') {
											echo "Votre compte est déjà actif !";
										}else if($_GET["success"]=='3') {
											echo "Votre compte a bien été activé !";
										}
										echo '</p>';
									}
								?>
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="last_name" placeholder="Votre nom" id="last_name" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="first_name" placeholder="Votre prénom" id="first_name" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email2" placeholder="Votre adresse email" id="email2" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password2" placeholder="Mot de passe" id="password2" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password_confirm" placeholder="Confirmez le mot de passe" id="password_confirm" required>
						</div>

						<div class="w-size25">
							<!-- Button -->
							<input type="submit" value="S'inscrire" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>