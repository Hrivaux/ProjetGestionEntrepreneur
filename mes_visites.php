<?php
require ('global.php');

connected_only();

$pageinfo = "Listes des visites";
$pageactive = "RDV2";

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
                                        <h5 class="m-b-10">Liste des visites</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accueil.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a>VISITES</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Listes des visites</a></li>
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
                                            <h5>Visites à rédiger</h5>
                                            <p>Ci-dessous, les visites pour lesquelles vous devez désormais saisir le compte rendu.</p>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Saisir le compte rendu</th>
                                                            <th>Médecin</th>
                                                            <th>Date</th>
                                                            <th>Échantillon</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                	$requete = ("SELECT 
																	V.id 				as 'visite_id',
																	V.medecin_id 		as 'visite_medecin',
																	V.visiteur_id 		as 'visite_visiteur',
																	V.echantillon_id 	as 'visite_echantillon',
																	V.date_visite		as 'visite_date',
																	V.statut_visite		as 'statue_visite',
																	M.id				as 'medecin_id',
																	M.nom				as 'medecin_nom',
																	M.prenom			as 'medecin_prenom',
																	E.nom_medicament	as 'medicament_nom',
                                                                    E.id                as 'medicament_id'
																FROM visites V
																LEFT JOIN medecins M ON V.medecin_id = M.id
																LEFT JOIN echantillons E ON V.echantillon_id = E.id
																WHERE V.visiteur_id = $id_encours AND V.statut_visite = '0'
													");
                                                    $reqv = $bdd->prepare($requete);
                                                    $reqv->execute();
                                                        
                                                    $resultat = $reqv->fetchAll();
                                                        if (!empty($resultat)) 
                                                        {
                                                            foreach($resultat as $visite)  { 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="redact_cr.php?med=<?php echo $visite['medecin_id'];?>&echantillon=<?php echo $visite['medicament_id']; ?>">Rédiger un compte rendu</a>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><a href="profilmedecins.php?id=<?php echo $visite['medecin_id'];?>"><?php echo $visite['medecin_prenom']." ".$visite['medecin_nom']; ?></a></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple"><?php echo strftime('%d-%m-%Y',strtotime($visite['visite_date']))?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $visite['medicament_nom']; ?></h6>
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
									 <!-- <div class="card">
                                        <div class="card-header">
                                            <h5>Visites à rédiger</h5>
                                            <p>Ci-dessous, les visites pour lesquelles les visites ont été terminées.</p>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Saisir le compte rendu</th>
                                                            <th>Médecin</th>
                                                            <th>Date</th>
                                                            <th>Échantillon</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                	$requete = ("SELECT 
																	V.id 				as 'visite_id',
																	V.medecin_id 		as 'visite_medecin',
																	V.visiteur_id 		as 'visite_visiteur',
																	V.echantillon_id 	as 'visite_echantillon',
																	V.date_visite		as 'visite_date',
																	V.statut_visite		as 'statue_visite',
																	M.id				as 'medecin_id',
																	M.nom				as 'medecin_nom',
																	M.prenom			as 'medecin_prenom',
																	E.nom_medicament	as 'medicament_nom',
                                                                    E.id                as 'medicament_id'
																FROM visites V
																LEFT JOIN medecins M ON V.medecin_id = M.id
																LEFT JOIN echantillons E ON V.echantillon_id = E.id
																WHERE V.visiteur_id = $id_encours AND V.statut_visite = '1'
													");
                                                    $reqv = $bdd->prepare($requete);
                                                    $reqv->execute();
                                                        
                                                    $resultat = $reqv->fetchAll();
                                                        if (!empty($resultat)) 
                                                        {
                                                            foreach($resultat as $visite)  { 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="redact_cr.php?med=<?php echo $visite['medecin_id'];?>&echantillon=<?php echo $visite['medicament_id']; ?>">Rédiger un compte rendu</a>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><a href="profilmedecins.php?id=<?php echo $visite['medecin_id'];?>"><?php echo $visite['medecin_prenom']." ".$visite['medecin_nom']; ?></a></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple"><?php echo strftime('%d-%m-%Y',strtotime($visite['visite_date']))?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $visite['medicament_nom']; ?></h6>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                } 
                                                 } 
                                                else
                                                {
                                                    echo "Aucn compte-rendu n'est encore terminé.";
                                                }
                                               ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>-->
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
    <div class="modal fade" id="successcr" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le compte rendu a bien été créé.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['actioncr'])) {
		$errlogin = htmlspecialchars($_GET['actioncr']);
		
		switch($errlogin)
		{
			case 'successcr':
?>
<script>
$(document).ready(function(){
    $("#successcr").modal('show');
});
</script>
<?php break; } } ?>




<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Une erreur est survenue, votre compte rendu n'a pas été modifié.</h3>
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



<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <div class="modal fade" id="successcr" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le compte rendu a bien été modifié.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['actioncr'])) {
		$errlogin = htmlspecialchars($_GET['actioncr']);
		
		switch($errlogin)
		{
			case 'successcr':
?>
<script>
$(document).ready(function(){
    $("#successcr").modal('show');
});
</script>
<?php break; } } ?>

<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <div class="modal fade" id="successcrmodif" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le compte rendu a bien été modifié.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['actioncrmodif'])) {
		$errlogin = htmlspecialchars($_GET['actioncrmodif']);
		
		switch($errlogin)
		{
			case 'successcrmodif':
?>
<script>
$(document).ready(function(){
    $("#successcrmodif").modal('show');
});
</script>
<?php break; } } ?>
<div class="modal fade" id="pbvisite" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Vous devez saisir une date de nouvelle visite.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['action'])) {
		$errlogin = htmlspecialchars($_GET['action']);
		
		switch($errlogin)
		{
			case 'pbvisite':
?>
<script>
$(document).ready(function(){
    $("#pbvisite").modal('show');
});
</script>
<?php break; } } ?>	


</body>
</html>
