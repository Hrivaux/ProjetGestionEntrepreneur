<?php

require_once('../../global.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idCR = (int)$_GET['id'];
} else {
    header('location: ../../liste_cr.php?action=erreur');
    exit();
}

$id_echantillon = $_POST["id_echantillon"];
$compterendu = $_POST["compterendu"];
$avis = $_POST['avis'];
$etat = $_POST['etat'];
$nouvelle_visite = $_POST['nouvelle_visite'];
$id_motif = $_POST["id_motif"];

// Récupération de la date actuelle en cas de modification du champ
if (!empty($_POST["date"])) {
    $date = $_POST["date"];
} else {
    $req = "SELECT date FROM comptesrendus WHERE id=?";
    $stmt = $bdd->prepare($req);
    $stmt->execute([$idCR]);
    $date = $stmt->fetchColumn();
}

// Récupération de l'id medecin actuel en cas de modification du champ
$req_id_medecin = "SELECT id_medecin FROM comptesrendus WHERE id=?";
$stmt_id_medecin = $bdd->prepare($req_id_medecin);
$stmt_id_medecin->execute([$idCR]);
$id_medecin = $stmt_id_medecin->fetchColumn();

$req = "UPDATE comptesrendus SET id_echantillon=?, date=?, compterendu=?, avis=?, etat=?, nouvelle_visite=?, id_motif=? WHERE id=?";
$stmt = $bdd->prepare($req);
$stmt->execute([$id_echantillon, $date, $compterendu, $avis, $etat, $nouvelle_visite, $id_motif, $idCR]);

if ($stmt->rowCount() > 0) {
    //Logs
    $req_logs = "INSERT INTO logs(user_id,type_log,action, date) VALUES (?, ?, ?, ?)";
    $stmt_logs = $bdd->prepare($req_logs);
    $type_log = "Modification";
    $action_log = "A modifié le compte rendu ($idCR)";
    $date_log = date('Y-m-d H:i:s');
    $stmt_logs->execute([$id_encours, $type_log, $action_log, $date_log]);

    header('location: ../../liste_cr.php?actioncrmodif=successcrmodif');
    exit();
} else {
    header('location: ../../liste_cr.php?action=erreur');
    exit();
}

?>
