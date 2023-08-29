<?php
require ('global.php');

connected_only();

$pageinfo = "Envoyer une notification";
$pageactive = "NOTIFS";

include('templates/meta.php');
if ($grade_encours <= 2) 
{
    Header('location: accueil.php');
}
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
										<li class="breadcrumb-item"><a href="javascript:">Administration</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Envoie notification</a></li>
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
												Envoyer une notification
											</h5>
											<hr>
											<div class="row">
												<div class="col-md-6">
													<form method="post" action="inc/actions/form_notification.php">
														<div class="form-group">
															<label for="exampleInputEmail1">Objet</label>
															<input type="text" class="form-control" name="objet" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Objet de votre notification" required  >
														</div>
														<label for="pet-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A qui envoyer? :</label>
														<select id="urgence" name="urgence" class="form-control"  placeholder="Grade visé ?" required >
															<option selected>Grade visé?</option>
															<?php $reponse = $bdd->query('SELECT * FROM grade');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id_grade']; ?>"><?php echo $donnees['libelle_grade']; ?></option>
				                                            <?php } ?>
														</select>
														<br>
														<br>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Message</label>
															<textarea name="message" class="form-control" placeholder="Quelle notification voulez-vous envoyer?"rows="4" cols="33" ></textarea>
														</div>
													</div>
												</div>
												<center>
													<input type="submit" value="Envoyer" class="btn btn-primary"/>
												</center>
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
