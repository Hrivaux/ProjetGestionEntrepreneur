<?php
require ('global.php');

connected_only();

$pageinfo = "Listes des médecins";
$pageactive = "LM";

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
	<section class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="page-header">
						<div class="page-block">
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="page-header-title">
										<h5 class="m-b-10">
											Tables Médecin
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
										<a href="accueil.php"><i class="feather icon-home"></i></a></li>
										<li class="breadcrumb-item"><a>SAISIES & CONSULTATIONS</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Liste des médecins</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="main-body">
						<div class="page-wrapper">
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header">
											<h5>
												Liste des médecins
											</h5>
										</div>
										<div class="card-block table-border-style">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>
																Profil
															</th>
															<th>
																Photo
															</th>
															<th>
																Nom
															</th>
															<th>
																N°siret
															</th>
															<th>
																Adresse
															</th>
															<?php if ($grade_encours > 2) { ?>
															<th>
																Supprimer
															</th>
															<?php } ?>
														</tr>
													</thead>
													<tbody>

<?php
$requete = ("SELECT * FROM medecins ORDER BY id DESC");

$reqmedecins = $bdd->prepare($requete);
$reqmedecins->execute();

$resultat = $reqmedecins->fetchAll();
if (!empty($resultat))
{
    foreach ($resultat as $medecins)
    {
?>

<tr>
	<td>
		<center><a href="profilmedecins.php?id=<?php echo $medecins['id'];?>"><img src="img/button.png"></a></center>
	</td>

	<td>
		<center><h6 class="m-0">
			<img class="rounded-circle  m-r-10" style=" height:40px; width:40px;" src="img/<?php echo $medecins['img'];?>" alt="Photo de profil">
		</h6></center>
	</td>

	<td>
		<h6 class="m-0">
		<?php echo $medecins['nom']." ".$medecins['prenom']; ?>
		</h6>		
	</td>

	<td>
			<h6 class="m-0">
			<?php echo $medecins['siret']; ?>
			</h6>
		</td>

		<td>
			<h6 class="m-0 text-c-purple">
			<?php echo $medecins['adresse']." ".$medecins['ville']." - ".$medecins['code_postal'];?>
			</h6>
		</td>
		
	<?php if ($grade_encours > 2) { ?>
		<td>
			<center><a href="inc/actions/delete_med.php?id=<?php echo $medecins['id'];?>"><img src="img/delete.png" style="width: 25px; height: 38px;"></a></center>
		</td>
	<?php } ?>
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
    </section>
<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>
</html>
