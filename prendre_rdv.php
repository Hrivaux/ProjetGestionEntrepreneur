<?php
require('global.php');

connected_only();

$pageinfo = "Organiser une visite";
$pageactive = "RDV1";

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
											Notifications
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">VISITES</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Organiser une visite</a></li>
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
												
												Organiser une visite
												
											</h5>
											<hr><br>
											<div class="row">
												<div class="col-md-12">
													<form method="post" action="inc/actions/visite.php" enctype="multipart/form-data">
													<label for="medecin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Médecin :</label>
															<select id="medecin" name="medecin" class="form-control" required>
																<option selected>Veuillez choisir un médecin</option>
																<?php $reponse = $bdd->query("SELECT id, nom, prenom, visiteur_id FROM medecins WHERE visiteur_id = $id_encours");
                                                                     while ($donnees_med = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees_med['id']; ?>"><?php echo $donnees_med['nom']." ".$donnees_med['prenom']; ?></option>
				                                                <?php } ?>
															</select><br>
														<div class="form-group">
															<label for="exampleInputEmail1">Date de la visite</label>
															<input type="date" id="date" name="date" class="form-control">
														</div>
														<label for="echantillon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type d'échantillon à faire essayer :</label>
															<select id="echantillon" name="echantillon" class="form-control" required>
																<option selected>Veuillez choisir une option</option>
																<?php $reponse = $bdd->query('SELECT id, nom_medicament FROM echantillons');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom_medicament']; ?></option>
				                                                <?php } ?>
															</select><br>
												</div>
											</div>
											<input type="submit" value="Organiser la visite" class="btn btn-primary" />
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

<div class="modal fade" id="ok" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">La visite a bien été planifiée.</h3>
		</div>
	</div>
</div>
<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Merci de remplir tous les champs.</h3>
		</div>
	</div>
</div>

<?php
	if(isset($_GET['action'])) 
	{
		$errlogin = htmlspecialchars($_GET['action']);
		
		switch($errlogin)
		{
			case 'ok':
?>
<script>
    $(document).ready(function()
    {
        $("#ok").modal('show');
    });
</script>
<?php  }

switch($errlogin) {
		case 'erreur':
			{
?>
<script>
    $(document).ready(function()
    {
        $("#erreur").modal('show');
    });
</script>
<?php break; } } } ?>	

</body>

</html>