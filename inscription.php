<?php
require ('global.php');

connected_only();

$pageinfo = "Ouverture d'un compte";

include('templates/meta.php');

if ($grade_encours <= 2) 
{
    Header('location: accueil.php');
}
else {
?>

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
				<div class="card-body text-center">
					<form method="post" action="inc/actions/inscription.php">
						<div class="mb-4">
							<i class="feather icon-user-plus auth-icon"></i>
						</div>
						<h3 class="mb-4">Création de compte</h3>
						<div class="input-group mb-3">
							<input type="text" name="nom" class="form-control" placeholder="Nom">
						</div>
						<div class="input-group mb-3">
							<input type="text" name="prenom" class="form-control" placeholder="Prenom">
						</div>
						<div class="input-group mb-3">
							<select name="grade" class="form-control" id="grade">
								<option value="1">Visiteur</option>
								<option value="2">Délégué</option>
								<option value="3">Responsable</option>
							</select>
						</div>
						<div class="input-group mb-3">
							<input type="email" name="email" class="form-control" placeholder="Adresse mail">
						</div>
						<div class="input-group mb-4">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe à définir">
						</div>
						<div class="input-group mb-3">
							<input type="text" name="ville" class="form-control" placeholder="Ville">
						</div>
						<div class="input-group mb-3">
							<input type="text" name="adresse" class="form-control" placeholder="Adresse">
						</div>
						<div class="input-group mb-3">
							<input id="zip" name="codepostal" type="text" pattern="[0-9]*" class="form-control"placeholder="Code postal">
						</div>
						<input type="submit" value="Ouvrir le compte" class="btn btn-primary shadow-2 mb-4"/>
						<a class="text-white btn btn-primary shadow-2 mb-4" href="index.php">Retour</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="tbmodal">
				<h3 style="color:white;">Une erreur est survenue, veuillez vérifier que tous les champs aient bien été remplis.</h3>
			</div>
		</div>
	</div>
	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="tbmodal">
				<h3 style="color:white;">Votre notification a bien été envoyée</h3>
			</div>
		</div>
	</div>

<?php

if (isset($_GET['action']))
{
    $errlogin = htmlspecialchars($_GET['action']);

    switch ($errlogin)
    {
        case 'erreur':
?>

<script>
    $(document).ready(function()
    {
        $("#erreur").modal('show');
    });

</script>


<?php
}
switch ($errlogin)
{
    case 'sucess':
?>


<script>
    $(document).ready(function()
    {
        $("#success").modal('show');
    });
</script>
<?php break; } } ?>	
</body>
</html>
<?php 
}
?>