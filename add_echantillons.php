<?php
require('global.php');

connected_only();

$pageinfo = "Ajouter un médecin";
$pageactive = "AEC";

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
											Gérer les échantillons
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">SAISIES & CONSULTATIONS</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Gérer les échantillons</a></li>
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
											<div class="row">
												<div class="col-md-6" style="margin-left: 380px;margin-top: 50px;">
													<form method="post" action="inc/actions/form_echantillon.php" enctype="multipart/form-data">
														<div class="form-group">
															<label for="exampleInputEmail1">Nom de l'échantillon</label>
															<input type="text" class="form-control" name="echantillon" id="echantillon" aria-describedby="emailHelp" placeholder="ex: Doliprane..." required>
														</div>
												</div>
												<br>
											</div>
											<input type="submit" value="Ajouter" class="btn btn-primary" />
											</form>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												Liste des échantillons
											</h5>
										</div>
										<div class="card-block table-border-style">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>
																Nom
															</th>
															<th>
																Supprimer
															</th>
														</tr>
													</thead>
													<tbody>

<?php
$requete = ("SELECT * FROM echantillons ORDER BY id DESC");

$reqechantillon = $bdd->prepare($requete);
$reqechantillon->execute();

$resultat = $reqechantillon->fetchAll();
if (!empty($resultat))
{
    foreach ($resultat as $ech)
    {
?>

<tr>

		<td>
			<h6 class="m-0">
			<?php echo $ech['nom_medicament'];?>
			</h6>
		</td>
		
		<td>
			<center><a href="inc/actions/delete_ech.php?id=<?php echo $ech['id'];?>"><img src="img/delete.png" style="width: 25px; height: 38px;"></a></center>
		</td>
	</tr>

    <?php
}
}
else
{
    echo "Aucun médecin n'a été créé";
}
?>

                                                    </tbody>
                                                </table>
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

<div class="modal fade" id="successdech" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">L'échantillon a bien été supprimé.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['delete'])) {
		$errlogin = htmlspecialchars($_GET['delete']);
		
		switch($errlogin)
		{
			case 'successdech':
?>
<script>
$(document).ready(function(){
    $("#successdech").modal('show');
});
</script>
<?php break; } } ?>

<div class="modal fade" id="successech" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">L'échantillon a bien été ajouté.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['actionno'])) {
		$errlogin = htmlspecialchars($_GET['actionno']);
		
		switch($errlogin)
		{
			case 'successech':
?>
<script>
$(document).ready(function(){
    $("#successech").modal('show');
});
</script>
<?php break; } } ?>	

</body>

</html>