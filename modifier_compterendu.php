<?php
require('global.php');

connected_only();

$idCR = htmlentities(trim($_GET['id']));
$idCR = (int) $idCR;

if (is_int($idCR))
{
	$requete = $bdd->prepare("SELECT CR.id               as 'id_compterendu',
    CR.id_visiteur      as 'id_visiteur',
    CR.id_medecin       as 'id_medecin',
    CR.date             as 'date',
    CR.id_echantillon   as 'id_echantillon',
    CR.avis             as 'avis',
    CR.etat             as 'etat',
    CR.nouvelle_visite  as 'nouvelle_visite',
    CR.compterendu      as 'compterendu',
    CR.id_motif         as 'id_motif',
    MV.libelle_motif    as 'libelle_motif',
    M.id                as 'Mid_medecin',
    M.nom               as 'nom_medecin',
    M.prenom            as 'prenom_medecin',
    E.nom_medicament    as 'nom_medoc',
    E.id                as 'id_medoc'
FROM comptesrendus  CR
LEFT JOIN medecins  M ON M.id = id_medecin
LEFT JOIN motif_visite MV ON MV.id = CR.id_motif
LEFT JOIN echantillons E ON E.id = CR.id_echantillon
WHERE CR.id = $idCR
ORDER BY id_compterendu DESC"); 
    $requete->execute();
    $compterendu = $requete->fetch();
        
    if (!$compterendu) {
        header('location: liste_cr.php');
         exit; }     
}

$pageinfo = "Saisie des comptes rendus";
$pageactive = "";

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
                                        <h5 class="m-b-10">Compte rendue</h5>
                                    </div>
                                   

                                    <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="accueil.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a>SAISIES & CONSULTATIONS</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Listes des comptes rendus</a></li>
                                        <li class="breadcrumb-item"><a>Modifier le compte rendue du médecin <?php echo $compterendu['prenom_medecin']." ".$compterendu['nom_medecin']; ?> datant du  <?php echo strftime('%d-%m-%Y',strtotime($compterendu['date']));?></a></li>
                                        
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
                                                <h5>Modifer votre compte rendu</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                <form action="inc/actions/form_compterendu_modif.php?id=<?php echo $idCR; ?>" method="POST" class="text-center">
                                                        <div class="text-center">
                                                        <h5 class="text-center">Nom du médecin</h5>
                                                           <hr>   
                                                           <br>
                                                            <?php echo $compterendu['prenom_medecin']." ".$compterendu['nom_medecin']; ?>                                    
                                                        </div>
                                                        <div class="form-group">

                                                                <h5 class="mt-5">Date</h5>
                                                                <hr>

                                                                
                                                                <br><br>
                                                                <h6><mark> Votre changement si besoin</mark></h6>
                                                                <br>
                                                                <input name="date" type="date" class="form-control text-center" value="<?php echo strftime('%d-%m-%Y',strtotime($compterendu['date']));?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <h5 class="mt-5">Echantillon testé</h5>
                                                                <hr>
                                                                             
                                                                <br><br>
                                                                <h6><mark> Votre changement si besoin</mark></h6>
                                                                <br>
                                                                <select name="id_echantillon" id="id_echantillon" class="form-control text-center" required>
                                                                <option value="<?php echo $compterendu['id_medoc']; ?>" selected ><?php echo $compterendu['nom_medoc']?></option>
                                                                    <?php $reponse = $bdd->query('SELECT id, nom_medicament, fournisseur FROM echantillons');
                                                                    while ($donnees = $reponse->fetch()) { ?>
                                                                        <option value="<?php echo $donnees['id']; ?>">
                                                                            <?php echo $donnees['nom_medicament']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <div class="form-group">
                                                                     <h5 class="mt-5">Motif de la visiste</h5>
                                                                     <hr>
                                                            <br><br>
                                                                <h6><mark> Votre changement si besoin</mark></h6>
                                                                <br>
														<select id="id_motif" name="id_motif" class="form-control text-center" required >
															<option value="<?php echo $compterendu['id_motif']; ?>" selected><?php echo $compterendu['libelle_motif']?></option>
															<?php $reponse = $bdd->query('SELECT * FROM motif_visite');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['libelle_motif']; ?></option>
				                                                      <?php } ?>
														</select>


                                                      
                                                                </div>

                                                                <div class="form-group">
                                                                    <h5 class="mt-5">Avis</h5>
                                                                    <hr>

                                                                   
                                                                    <br><br>
                                                                    <h6><mark> Votre changement si besoin</mark></h6>
                                                                    <br>
                                                                
                                                                        <div class="custom-control custom-radio">
                                                                        <input type="radio" id="3" name="avis" class="custom-control-input" value="3"<?php if($compterendu['avis']==3) { echo 'checked="checked"'; } ?>>
                                                                        <label class="custom-control-label" for="3">Bien passé </label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio">
                                                                        <input type="radio" id="2" name="avis" class="custom-control-input" value="2"<?php if($compterendu['avis']==2) { echo 'checked="checked"'; } ?>>
                                                                        <label class="custom-control-label" for="2">Mal passé</label>
                                                                        </div>
                                                                            </div>
                                                                

                                                                
                                                 <div class="form-group">
                                                        <h5 class="mt-5">Etat</h5>
                                                        <hr>  
                                                        
                                                        
                                                        <br><br>
                                                            <h6><mark> Votre changement si besoin</mark></h6>
                                                            <br>
                                                            <div class="custom-control custom-radio">
                                                            <input type="radio" id="1" name="etat" class="custom-control-input" value="1" <?php if($compterendu['etat']==1) { echo 'checked="checked"'; } ?>>
                                                            <label class="custom-control-label" for="1">Terminé</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                            <input type="radio" id="0" name="etat" class="custom-control-input" value="0"<?php if($compterendu['etat']==0) { echo 'checked="checked"'; } ?>>
                                                            <label class="custom-control-label" for="0">A terminer</label>
                                                            </div>
                                                                            </div>
                                                        <div class="form-group">
                                                        <h5 class="mt-5">Nouvelle visite</h5>
                                                        <hr>    
                                                        </div>
                                                            
                                                            <h6><mark> Votre changement si besoin</mark></h6>
                                                            <br> 
                                                          
                                                            <input name="nouvelle_visite" type="date" class="form-control text-center" placeholder="Date" value="<?php if ($compterendu['nouvelle_visite'] == NULL) { echo "Pas de nouvelle visite"; } else {echo $compterendu['nouvelle_visite'];}; ?>">
                                                    </div> 
                                                    <div>
                                                        <h5 class="mt-5">Commentaire</h5>                                      
                                                       <hr> 
                                                            <br><br>
                                                            <h6><mark> Votre changement si besoin</mark></h6>
                                                            <br>  
                                                            <textarea type="text" name="compterendu" cols="40" rows="10" class="form-control height: 300px;"  size="50" id="compterendu" rows="5"><?php echo $compterendu['compterendu']; ?> </textarea>
                                                            <br><br>
                                                      <input type="submit" value="Envoyer"class="btn btn-primary"/> 
                                                    </div>
                                                </form>
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