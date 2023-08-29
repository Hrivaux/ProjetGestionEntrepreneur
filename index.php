<?php
include ("global.php");

already_connected();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
		<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
		<meta name="author" content="CodedThemes"/>
		<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/fa-icons/css/font-awesome.min.css">
	</head>
	<body>
		<div class="auth-wrapper">
			<div class="auth-content">
				<div class="auth-bg">
					<span class="r"></span>
					<span class="r s"></span>
					<span class="r s"></span>
					<span class="r"></span>
				</div>
				<div class="card">
					<form class="card-body text-center" action="inc/actions/login.php" method="post">
						<div class="mb-4">
							<i class="feather icon-unlock auth-icon"></i>
						</div>
						<h3 class="mb-4">Se connecter</h3>
						<div class="input-group mb-3">
							<input type="email" name="email" class="form-control" placeholder="Adresse mail">
						</div>
						<div class="input-group mb-4">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe">
						</div>
						<div class="form-group text-left">
							<div class="checkbox checkbox-fill d-inline">
								<input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
								<label for="checkbox-fill-a1" class="cr">Se souvenir de mes informations</label>
							</div>
						</div>
						<button class="btn btn-primary shadow-2 mb-4" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i>SE CONNECTER</button>
						<p class="mb-2 text-muted">
							<a href="auth-reset-password.html">Mot de passe oublié ?</a>
						</p>
					</form>
				</div>
			</div>
		</div>
		<script src="assets/js/vendor-all.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le mot de passe saisi est incorrect.</h3>
		</div>
	</div>
</div>
<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">L'adresse, mail saisie n'existe pas ou est incorrecte.</h3>
		</div>
	</div>
</div>
<div class="modal fade" id="champs" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Merci de remplir la totalité des champs.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['login_err'])) {
		$errlogin = htmlspecialchars($_GET['login_err']);
		
		switch($errlogin)
		{
			case 'password':
?>
<script>
$(document).ready(function(){
    $("#password").modal('show');
});
</script>
<?php }
switch($errlogin)
{
	case 'email':
?>
<script>
$(document).ready(function(){
    $("#email").modal('show');
});
</script>
<?php }
switch($errlogin)
{
	case 'champs':
?>
<script>
$(document).ready(function(){
    $("#champs").modal('show');
});
</script>
<?php break; } } ?>	
	</body>
</html>
