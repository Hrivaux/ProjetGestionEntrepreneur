<?php
session_start();

require_once '../../global.php';

$objet = $_POST['objet'];
$msg = $_POST['message'];
$grade = $_POST['urgence'];
$date = date('d-m-y');

if (!empty($objet) && !empty($msg) && !empty($grade)) {

    $reponse = $bdd->prepare("INSERT INTO notifications(user_id,grade,objet,message,send_date) VALUES (?,?,?,?,?)");

    $reponse->execute(array($id_encours, $grade, $objet, $msg, $date));

    //Logs
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Insertion', 'A envoyé une notification ($msg)', '$today')");
    $bdd->exec($req_logs);
    header ('Location: ../../accueil.php?actionno=successno');
} 
else 
{
    Header('location: ../../notifications.php?action=erreur');
}
?>
