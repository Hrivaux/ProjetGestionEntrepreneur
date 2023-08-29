<?php
require ('global.php');

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
    E.nom_medicament    as 'nom_medoc'
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
else
{
    Header('location: accueil.php');
}

    $pageinfo = "Saisie des comptes rendus";

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
                                        <h5 class="m-b-10">Compte rendu</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accueil.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a>SAISIES & CONSULTATIONS</a></li>
                                        <li class="breadcrumb-item"><a href="liste_cr.php">Listes des comptes rendus</a></li>
                                        <li class="breadcrumb-item"><a>Consulter le compte rendue du médecin <?php echo $compterendu['prenom_medecin']." ".$compterendu['nom_medecin']; ?> datant du  <?php echo strftime('%d-%m-%Y',strtotime($compterendu['date']));?></a></li>
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
                                            <h5>Consultez votre compte rendu</h5>
                                        </div>
                                        <div class="card-body">
                                        <h4>Compte rendu de M. <?php echo $prenomnom; ?></h4>
                                            <hr>
                                            <div class="card-body">
                                                <div class="">
                                                        <div class="text-center">
                                                        <h5 class="text-center">Nom du médecin</h5>
                                                      <hr> 
                                                      <br>
                                                      <?php echo $compterendu['prenom_medecin']." ".$compterendu['nom_medecin']; ?> 
                                                        <div class="form-group">
                                                        <h5 class="mt-5">Date</h5>
                                                        <hr>   
                                                        <br> 
                                                        <?php echo strftime('%d-%m-%Y',strtotime($compterendu['date']));?> 
                                                        </div>

                                                        <div class="text-center">
                                                            <h5 class="mt-5">Échantillon testé</h5>
                                                            <hr>
                                                            <br>
                                                            <?php if ($compterendu['nom_medoc'] == NULL) {
                                                                echo "Pas de médicament lié à ce compte rendu.";
                                                            } else {
                                                                echo $compterendu['nom_medoc'];
                                                            }; ?>
                                                        </div>

                                                        <div class="text-center">
                                                            <h5 class="mt-5">Avis</h5>
                                                            <hr>
                                                            <br>
                                                            <?php if ($compterendu['avis'] == 3) {
                                                                echo "Bien passée";
                                                            } else {
                                                                echo "Mal passée";
                                                            }; ?>
                                                        </div>

                                                        <div class="text-center">
                                                            <h5 class="mt-5">Etat</h5>
                                                            <hr>
                                                            <br>
                                                            <?php if ($compterendu['etat'] == 1) {
                                                                echo "Terminé";
                                                            } else {
                                                                echo "À terminer";
                                                            }; ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <h5 class="mt-5">Motif de la visite</h5>
                                                            <hr>
                                                            <br>
                                                            <?php if ($compterendu['libelle_motif'] == NULL) {
                                                                echo "Pas de motif attitré";
                                                            } else {
                                                                echo $compterendu['libelle_motif'];
                                                            }; ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <h5 class="mt-5">Nouvelle visite</h5>
                                                            <hr>
                                                            <br>
                                                            <?php if ($compterendu['nouvelle_visite'] == NULL) {
                                                                echo "Pas de nouvelle visite";
                                                            } else {
                                                                echo strftime('%d-%m-%Y',strtotime($compterendu['nouvelle_visite']));
                                                            }; ?>
                                                        </div>


                                                        <div>
                                                            <h5 class="mt-5">Commentaire</h5>
                                                            <hr>
                                                            <br>
                                                            <?php echo $compterendu['compterendu']; ?>
                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                                </div>
    <script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>