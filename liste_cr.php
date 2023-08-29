<?php
require ('global.php');

connected_only();

$pageinfo = "Listes des comptes rendus";
$pageactive = "CR";

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
                                        <h5 class="m-b-10">Liste des comptes rendus</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accueil.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a>SAISIES & CONSULTATIONS</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Listes des comptes rendus</a></li>
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
                                            <h5>Comptes rendus terminés</h5>
                                            <p>Cliquez sur "ouvrir" pour les consulter (modifiables uniquement par les délégués)</p>
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
                                                            <th>Avis</th>
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
                                                    WHERE (id_visiteur = $id_encours) AND (etat = '1')
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
                                                            <h6 class="m-0"><?php if ($cr['avis'] == 3) { echo "Bien passée"; } else { echo "Mal passée"; }; ?></h6>
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
                                
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Compte rendu à terminer</h5>
                                            <p>Cliquer dessus pour les modifier</p>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Compte rendu</th>
                                                            <th>Médecin</th>
                                                            <th>Date</th>
                                                            <th>Echantillon</th>
                                                            <th>Avis</th>
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
                                                    WHERE (id_visiteur = $id_encours) AND (etat = '0')
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
                                                            <a href="modifier_compterendu.php?id=<?php echo $cr['id_compterendu'];?>">Ouvrir</a>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><a href="profilmedecins.php?id=<?php echo $cr['id_medecin'];?>"><?php echo $cr['prenom_medecin']." ".$cr['nom_medecin']; ?></a></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple"><?php echo strftime('%d-%m-%Y',strtotime($cr['date']));?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $cr['nom_medicament']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php if ($cr['avis'] == 3) { echo "Bien passée"; } else { echo "Mal passée"; }; ?></h6>
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



</body>
</html>
