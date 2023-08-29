<?php
require('global.php');

connected_only();

$pageinfo = "Ajouter un médecin";
$pageactive = "AM";

include('templates/meta.php');
?>

<body>
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<?php include('templates/menu.php'); ?>
	<?php include('templates/header.php'); ?>
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="page-header">
						<div class="page-block">
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="page-header-title">
										<h5 class="m-b-10">
											Ajout de médecin
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">SAISIES & CONSULTATIONS</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Ajouter un médecin</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="main-body">
						<div class="page-wrapper">
							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-body">
											<h5>
												Ajouter un médecin
											</h5>
											<hr>
											<div class="row">
												<div class="col-md-6">
													<form method="post" action="inc/actions/form_medecins.php" enctype="multipart/form-data">
														<div class="form-group">
															<label for="exampleInputEmail1">Nom</label>
															<input type="text" class="form-control" name="nom" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom du médecin" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Prénom</label>
															<input type="text" class="form-control" name="prenom" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Prénom du médecin" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Photo de profil</label>
															<input type="text" id="get_image" name="get_image" class="form-control" accept="image/png, image/jpeg; image/jpg; image/gif" placeholder="URL de la photo de profil du médecin">
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Siret</label>
															<input type="number" class="form-control" name="siret" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="N° du SIRET" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Adresse mail</label>
															<input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Adresse mail du médecin" required>
														</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
															<label for="exampleInputEmail1">Adresse</label>
															<input type="text" class="form-control" name="adresse" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Adresse du médecin" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Ville</label>
															<input type="text" class="form-control" name="ville" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ville du médecin" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Code postal</label>
															<input type="number" class="form-control" name="codepostal" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Code postal du médecin" required>
														</div>
												</div>
												<br>
												<div class="col-md-12">
												<label for="p_rattache" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personne rattachée :</label>
															<select id="p_rattache" name="p_rattache" class="form-control" required>
																<option selected>Veuillez choisir une personne à rattacher à ce médecin</option>
																<?php $reponse = $bdd->query('SELECT id, nom, prenom FROM utilisateurs');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom']." ".$donnees['prenom']; ?></option>
				                                                <?php } ?>
															</select><br>
												</div>
											</div>
											<input type="submit" value="Ajouter" class="btn btn-primary" />
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/pcoded.min.js"></script>

<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Une erreur est survenue, veuillez vérifier que tous les champs aient bien été remplis.</h3>
		</div>
	</div>
</div>

<?php
	if(isset($_GET['action'])) 
	{
		$errlogin = htmlspecialchars($_GET['action']);
		
		switch($errlogin)
		{
			case 'erreur':
?>
<script>
    $(document).ready(function()
    {
        $("#erreur").modal('show');
    });
</script>
<?php break; } } ?>	

</body>

</html>