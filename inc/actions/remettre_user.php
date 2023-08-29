<?php
include("../../global.php"); 

$requete = $bdd->prepare("UPDATE utilisateurs SET archive = '0' WHERE id = :id");
$requete->bindValue('id', $_GET['id']);

if (!$_GET['id']) {
	header('location: ../../accueil.php');
    exit;
}

if ($requete->execute()) {
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Suppression', 'A remis un compte', '$today')");
    $bdd->exec($req_logs);
}

?>