<?php
session_start();

require_once 'inc/sql.php';
require_once 'inc/functions.php';

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $prenomnom = $user['prenom'] . " " . $user['nom'];
        $nomprenom = $user['nom'] . " " . $user['prenom'];
        $id_encours = $user['id'];
        $grade_encours = $user['grade'];
        $fonction_encours = $user['fonction'];
    }
}

// Date du jour en PHP
$today = date('Y-m-d');
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR', 'fr', 'fr', 'fra', 'fr_FR@euro');

// Paramètres du site
$stmt = $bdd->query("SELECT * FROM site_settings WHERE id = 1");
$config = $stmt->fetch(PDO::FETCH_ASSOC);
$url = $config['url'];
$nomsite = $config['site_name'];
$version = $config['version'];
$logo = $config['logo'];
?>
