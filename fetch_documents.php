<?php
// fetch_documents.php

require('global.php');

// Récupérez l'id_dossier envoyé depuis la requête AJAX
$idDossier = $_GET['id_dossier'];

try {
    // Utilisez $bdd (défini dans global.php) pour accéder à la base de données

    // Récupération des documents associés au dossier spécifié
    $requeteDocuments = $bdd->prepare("SELECT * FROM dossiers_documents WHERE dossier_id = :id_dossier");
    $requeteDocuments->bindParam(':id_dossier', $idDossier);
    $requeteDocuments->execute();
    $documents = $requeteDocuments->fetchAll(PDO::FETCH_ASSOC);

    // Génération du contenu HTML avec les libellés des documents
    $result = '';
    foreach ($documents as $document) {
        $result .= '<p>' . htmlspecialchars($document['type_doc'] . ' - ' . $document['libelle_document']) . '</p>';

    }

    // Renvoie du résultat
    echo $result;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
