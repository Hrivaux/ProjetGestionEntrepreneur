<?php
require ('global.php');

connected_only();
    
$pageinfo = "Saisie de compte rendu";
$pageactive = "";

include('templates/meta.php');

$medecinvisite = $_GET['med'];
$echantillonvisite = $_GET['echantillon'];

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
                                        <h5 class="m-b-10">Compte rendu</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accueil.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a>SAISIES & CONSULTATIONS</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Rédiger un compte rendu</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <section class="form-compter card-body"> 
                    <div class="card-body">
                        <div class="page-wrapper">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5>Écrivez votre compte rendu</h5>
                                        </div>
                                        <div class="card-body">
                                            <h5>Compte rendu de M. <?php echo $prenomnom; ?></h5>
                                            <hr>
                                            <div class="card-body">
                                                <div class="">
                                                <form action="inc/actions/form_compterendu.php" method="POST" class="text-center">
                                                        <div class="text-center">
                                                        <h5 class="text-center">Nom du médecin</h5>
                                                            <hr>
                                                              <br><br>
                                                              <select name="id_medecin" class="form-control text-center" required>
		                                                    	<?php $reponse = $bdd->query("SELECT id, nom, prenom FROM medecins WHERE id = $medecinvisite");
                                                                     while ($donnees = $reponse->fetch())
									                                        {
									                                            ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>" selected><?php echo $donnees['prenom']." ".$donnees['nom']; ?></option>
				                                                        	<?php } ?>
	                                                                    	</select>
                                                        </div>

                                                        <div class="form-group">
                                                        <h5 class="mt-5">Date du compte rendu</h5>
                                                        <hr>    
                                                            <input name="date" type="date" class="form-control text-center" value="<?php echo $today;?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <h5 class="mt-5">Échantillon testé</h5>
                                                            <hr>
                                                             <br><br>
                                                             <select name="id_echantillon" class="form-control text-center" required>
                                                                <?php $reponse = $bdd->query("SELECT id, nom_medicament, fournisseur FROM echantillons WHERE id = $echantillonvisite");
                                                                     while ($donnees_e = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees_e['id']; ?>" selected><?php echo $donnees_e['nom_medicament']; ?></option>
				                                                        	<?php } ?>
	                                                                    	</select>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <h5 class="mt-5">Motif de la visite</h5>
                                                            <hr>
                                                            
														<select id="id_motif" name="id_motif" class="form-control text-center" required>
															<?php $reponse = $bdd->query('SELECT * FROM motif_visite');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['libelle_motif']; ?></option>
				                                            <?php } ?>
														</select>
                                                        </div>



                                                        <div class="">
                                                <div class="text-center">
                                                    <h5 class="mt-5">Avis</h5>
                                                    <br>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="bien_passer" name="avis" class="custom-control-input" value="3">
                                                        <label class="custom-control-label" for="bien_passer">Bien passée </label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="mal_passer" name="avis" class="custom-control-input" value="2">
                                                        <label class="custom-control-label" for="mal_passer">Mal passée</label>
                                                    </div>
												</div>
                                                    <hr>
                                                    <div class="text-center">
														<h5 class="mt-5">État</h5>
														<br>
															<div class="custom-control custom-radio">
																<input type="radio" id="1" name="etat" class="custom-control-input" value="1">
																<label class="custom-control-label" for="1">Terminé</label>
															</div>
														<div class="custom-control custom-radio">
															<input type="radio" id="0" name="etat" class="custom-control-input" value="0">
															<label class="custom-control-label" for="0">À terminer</label>
														</div>
													</div>
                                                    <hr>
													<div class="text-center">
														<h5 class="mt-5">Revoir ?</h5>
														<br>
															<div class="custom-control custom-radio">
																<input type="radio" id="oui" name="revoir" class="custom-control-input" value="1">
																<label class="custom-control-label" for="oui">Oui</label>
															</div>
														<div class="custom-control custom-radio">
															<input type="radio" id="non" name="revoir" class="custom-control-input" value="0">
															<label class="custom-control-label" for="non">Non</label>
														</div>
													</div>
                                                    <hr>                                                    
                                                    <div class="form-group">
                                                        <h5 class="mt-5">Nouvelle visite</h5>
                                                        <p>(Si besoin)</p>
                                                        <br>    
                                                            <input name="nouvelle_visite" type="date" class="form-control text-center" placeholder="Date">
                                                    </div> 
                                                    <div>                 
                                                        <h5 class="mt-5">Commentaire : </h5>                                     
                                                       <br> 
                                                            <textarea type="text" name="compterendu" cols="40" rows="10" class="form-control height: 300px;"  size="50" id="compterendu" rows="5"></textarea>
                                                            <br><br>
                                                      <input type="submit" value="Envoyer"class="btn btn-primary"/>  
                                                    </div>
                                         </form>
                                    </div>
                                                            
   
<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

 <!-- Modal box erreurs -->
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

<div class="modal fade" id="successcr" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le compte rendu a bien été créé.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['action'])) {
		$errlogin = htmlspecialchars($_GET['action']);
		
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
</body>
</html>
