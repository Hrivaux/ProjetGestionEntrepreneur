<?php
session_start();

require_once '../../global.php';

// On récupère les valeurs du formulaire:
$echantillon = $_POST['echantillon'];


if (isset($echantillon)) {

    $reponse = $bdd->prepare("INSERT INTO echantillons(nom_medicament) VALUES (?)");

    $reponse->execute(array($echantillon));

    //Logs
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Insertion', 'A ajouté un échantillon : $echantillon', '$today')");
    $bdd->exec($req_logs);
    header ('Location: ../../add_echantillons.php?actionno=successech');
} 
else 
{
    Header('location: ../../add_echantillon.php?action=erreur');
}

?>