<?php
session_start();

require_once '../../global.php';

// On récupère les valeurs du formulaire:
$utilisateur = $_POST['utilisateur'];
$grade = $_POST['grade'];


if (isset($utilisateur) && isset($grade)) {

    $reponse = $bdd->prepare("INSERT INTO users_grades(user_id, grade_id) VALUES (?,?)");

    $reponse->execute(array($utilisateur, $grade));

    //Logs
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Insertion', 'A attribué un grade à $utilisateur', '$today')");
    $bdd->exec($req_logs);
    header ('Location: ../../gerer_roles.php?actionno=successech');
} 
else 
{
    Header('location: ../../gerer_roles.php?action=erreur');
}

?>