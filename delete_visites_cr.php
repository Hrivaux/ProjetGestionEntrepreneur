<?php
require('global.php');

connected_only();

$pageinfo = "Ajouter un médecin";
$pageactive = "SUPVISITCR";

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
											Supprimer les visites / CR
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">SAISIES & CONSULTATIONS</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Supprimer les visites / CR</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="main-body">
						<div class="page-wrapper">
							<div class="row">
								<div class="col-sm-12">
									<!-- 
											NE FONCTIONNE PAS CAR DANS inc/actions/delete_cr.php ON NE SUPPRIME PAS LES DONNÉES QUI SONT LIEES AVEC UNE CLE ETRANGERE DANS D'AUTRES TABLES.
									
									<div class="card">
										<div class="card-header">
											<h5>
												Liste des visites
											</h5>
										</div>
										<div class="card-block table-border-style">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>
																Visiteur
															</th>
															<th>
																Médecin
															</th>
															<th>
																Échantillon
															</th>
															<th>
																Supprimer
															</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$requete = ("SELECT V.id as 'id_visite',  U.nom as 'nom', U.prenom as 'prenom', M.nom as 'nom_medecin', M.prenom as 'prenom_medecin', E.nom_medicament as 'medicament'
																	FROM visites V
																	LEFT JOIN utilisateurs U on U.id = V.visiteur_id
																	LEFT JOIN medecins M on M.id = V.medecin_id
																	LEFT JOIN echantillons E on E.id = V.echantillon_id
																	ORDER BY id_visite DESC");
														
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
																	<?php echo $ech['nom']." ".$ech["prenom"];?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																	<?php echo $ech['nom_medecin']." ".$ech["prenom_medecin"];?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																	<?php echo $ech['medicament'];?>
																	</h6>
																</td>
																
																<td>
																	<center><a href="inc/actions/delete_cr.php?id=<?php echo $ech['id_visite'];?>"><img src="img/delete.png" style="width: 25px; height: 38px;"></a></center>
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
                                    </div> -->
									<div class="card">
                                        <div class="card-header">
                                            <h5>Liste des comptes rendus</h5>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Compte-rendu</th>
                                                            <th>Médecin</th>
                                                            <th>Date</th>
                                                            <th>Échantillon</th>
                                                            <th>Supprimer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php 
                                                	$requete = ("SELECT CR.id               as 'id_compterendu',
                                                                        CR.id_visiteur      as 'id_visiteur',
                                                                        CR.id_medecin       as 'id_medecin',
                                                                        CR.date             as 'date',
                                                                        CR.id_echantillon   as 'id_echantillon',
                                                                        CR.avis             as 'avis',
                                                                        M.id                as 'Mid_medecin',
                                                                        M.nom               as 'nom_medecin',
                                                                        M.prenom            as 'prenom_medecin',
                                                                        E.id                as 'echantillon',
                                                                        E.nom_medicament    as 'nom_medicament'
                                                    FROM comptesrendus  CR
                                                    LEFT JOIN medecins  M ON M.id = CR.id_medecin
                                                    LEFT JOIN echantillons  E ON E.id = CR.id_echantillon
                                                    LEFT JOIN utilisateurs U ON U.id = CR.id_visiteur
                                                    WHERE (id_visiteur = $id_encours)
                                                    ORDER BY CR.id DESC");

                                                    $reqcr = $bdd->prepare($requete);
                                                    $reqcr->execute();
                                                        
                                                    $resultat = $reqcr->fetchAll();
                                                        if (!empty($resultat)) 
                                                        {
                                                            foreach($resultat as $cr)  { 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="consulter_compterendu.php?id=<?php echo $cr['id_compterendu'];?>">Ouvrir</a>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><a href="profilmedecins.php?id=<?php echo $cr['id_medecin'];?>"><?php echo $cr['prenom_medecin']." ".$cr['nom_medecin']; ?></a></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple"><?php echo $cr['date']?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $cr['nom_medicament']; ?></h6>
                                                        </td>
                                                        <td>
															<center><a href="inc/actions/delete_cr.php?id=<?php echo $cr['id_compterendu'];?>"><img src="img/delete.png" style="width: 25px; height: 38px;"></a></center>
														</td>
                                                    </tr>
                                            <?php 
                                                } 
                                                 } 
                                                else
                                                {
                                                    echo "Aucn compte-rendu ne vous a été rattaché";
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

<div class="modal fade" id="successdelvisite" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">La visite a bien été supprimée.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['delete'])) {
		$errlogin = htmlspecialchars($_GET['delete']);
		
		switch($errlogin)
		{
			case 'successdelvisite':
?>
<script>
$(document).ready(function(){
    $("#successdelvisite").modal('show');
});
</script>
<?php break; } } ?>

<div class="modal fade" id="successdelcr" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le compte-rendu a bien été supprimé</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['delete'])) {
		$errlogin = htmlspecialchars($_GET['delete']);
		
		switch($errlogin)
		{
			case 'successdelcr':
?>
<script>
$(document).ready(function(){
    $("#successdelcr").modal('show');
});
</script>
<?php break; } } ?>	

</body>

</html>