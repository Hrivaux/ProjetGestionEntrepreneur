<?php 
// Nombre de médecins rattachés
$nbmed = $bdd->query("SELECT count(*) as nb FROM medecins WHERE visiteur_id = $id_encours");
$data = $nbmed->fetch();
$nbmedecins = $data['nb'];

// Nombre d'utilisateurs totaux
$nbusers = $bdd->query("SELECT count(*) as nb FROM utilisateurs");
$data = $nbusers->fetch();
$nbutilisateurs = $data['nb'];

/* Nombre de personnes qui ont mon grade
$nbgrade = $bdd->query("SELECT count(*) as nb, G.libelle_grade as 'nom_grade'
FROM utilisateurs   U
LEFT JOIN grade     G ON U.grade = G.id_grade
WHERE U.grade = $grade_encours");
$data = $nbgrade->fetch();
$nbutilisateursgrade = $data['nb'];
$nomgrade = $data['nom_grade'];
if ($nbutilisateursgrade > 1) { $nomgrade = $nomgrade."s"; }
*/

// Nombre de comptes-rendus à saisir
$nbCR1 = $bdd->query("SELECT count(*) as nb from comptesrendus WHERE etat = '0' AND id_visiteur = $id_encours");
$data = $nbCR1->fetch();
$nbcomptesrendusencours = $data['nb'];

// Nombre de comptes-rendus terminés
$nbCR = $bdd->query("SELECT count(*) as nb from comptesrendus WHERE etat = '1' AND id_visiteur = $id_encours");
$data = $nbCR->fetch();
$nbcomptesrendustermines = $data['nb'];
?>