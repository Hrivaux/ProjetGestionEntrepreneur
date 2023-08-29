<?php
require ('global.php');

connected_only();

if ($grade_encours < 3) {
	Header('location: accueil.php');
}

$pageinfo = "Paramètres du site";
$pageactive = "PARAMS";

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
											<li class="breadcrumb-item"><a href="javascript:">Administration</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Paramètres du site</a></li>
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
													Paramètres du site
												</h5>
												<hr>
												<?php 

												?>
												<div class="row">
													<div class="col-md-6" style="margin-left: 380px;">
														<form method="post" action="inc/actions/form_sitesettings.php">
															<div class="form-group">
																<label for="exampleInputEmail1">Nom du site</label>
																<input type="text" class="form-control" name="nomsite" id="nomsite" aria-describedby="emailHelp" value="<?php echo $nomsite; ?>">
															</div>
															<div class="form-group">
																<label for="exampleInputEmail1">URL</label>
																<input type="text" class="form-control" name="urlsite" id="urlsite" aria-describedby="emailHelp" value="<?php echo $url; ?>">
															</div>
															<div class="form-group">
																<label for="exampleInputEmail1">Version</label>
																<input type="text" class="form-control" name="versionsite" id="versionsite" aria-describedby="emailHelp" value="<?php echo $version; ?>">
															</div>
													</div>
												</div>
													<input type="submit" value="Mettre à jour" class="btn btn-primary"/>
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

<div class="modal fade" id="success_update_site" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
	<div class="tbmodal">
		<h3 style="color:white;">Les paramètres du site ont bien été mis à jour.</h3>
	</div>
</div>
</div>
<div class="modal fade" id="error_update_site" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
	<div class="tbmodal">
		<h3 style="color:white;">Une erreur est survenue. Les paramètres n'ont pas été mis à jour.</h3>
	</div>
</div>
</div>
<?php
	if(isset($_GET['action'])) {
		$errlogin = htmlspecialchars($_GET['action']);
		
		switch($errlogin)
		{
			case 'success_update_site':
?>
<script>
$(document).ready(function(){
    $("#success_update_site").modal('show');
});
</script>
<?php
			break;
			
			case 'error_update_site';
			?>
<script>
$(document).ready(function(){
    $("#error_update_site").modal('show');
});
</script>
<?php break; } } ?>	

</body>
</html>
