<?php
include("../../global.php"); 

$requete = $bdd->prepare('DELETE FROM visites WHERE id = :id');
$requete->bindValue('id', $_GET['id']);

if (!$_GET['id']) {
	header('location: ../../accueil.php');
    exit;
}

if ($requete->execute()) {
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Suppression', 'A supprimé une visite', '$today')");
    $bdd->exec($req_logs);
    Header('Location: ../../delete_visites_cr.php?delete=successdelvisite');
}

?>