<?php
require('global.php');

connected_only();

$pageinfo = "Publier un document";
$pageactive = "ADD";

include('templates/meta.php');

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si un fichier a été sélectionné
    if (isset($_FILES["document"]) && $_FILES["document"]["error"] == UPLOAD_ERR_OK) {
        // Récupération des informations sur le fichier
        $nomDocument = $_FILES["document"]["name"];
        $nomTemporaire = $_FILES["document"]["tmp_name"];
        $typeFichier = $_FILES["document"]["type"];
        $note = $_POST['note'];
        $titre = $_POST['titre'];

        $titre = utf8_encode(htmlentities($titre, ENT_QUOTES, 'UTF-8'));
        $note = utf8_encode(htmlentities($note, ENT_QUOTES, 'UTF-8'));

        // Vérification si le fichier est d'un format autorisé
        $formatsAcceptes = array(
            "application/pdf",
            "image/png",
            "image/jpeg",
            "image/gif",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document", // .docx
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // .xlsx
            "application/vnd.openxmlformats-officedocument.presentationml.presentation", // .pptx
            "application/msword", // .doc
            "application/vnd.ms-powerpoint", // .ppt
            "application/vnd.ms-excel", // .xls
            "text/plain" // .txt
        );

        // Modification du nom du document
        $nomDocument = str_replace(array('é', 'è', 'ê'), 'e', $nomDocument);
        $nomDocument = str_replace(' ', '_', $nomDocument);

        if (in_array($typeFichier, $formatsAcceptes)) {
            // Détermination du dossier de destination en fonction du type de document
            if (in_array($typeFichier, array("image/jpeg", "image/jpg", "image/png", "image/gif"))) {
                $dossierDestination = "imports/images/";
            } elseif ($typeFichier === "text/plain") {
                $dossierDestination = "imports/textes/";
            } else {
                $dossierDestination = "imports/documents/";
            }

            // Chemin local vers le dossier de destination
            $cheminDestination = $dossierDestination . $nomDocument;

            if (move_uploaded_file($nomTemporaire, $cheminDestination)) {
                try {
                    $typeFichierBdd = substr($typeFichier, strpos($typeFichier, '/') + 1);

                    $requeteInsertion = "INSERT INTO site_documents (nom_doc, titre, note, type_doc) VALUES (:nomDocument, :titre, :note, :typeDoc)";
                    $stmtInsertion = $bdd->prepare($requeteInsertion);
                    $stmtInsertion->bindParam(':nomDocument', $nomDocument);
                    $stmtInsertion->bindParam(':titre', $titre);
                    $stmtInsertion->bindParam(':note', $note);
                    $stmtInsertion->bindParam(':typeDoc', $typeFichierBdd);
                    $stmtInsertion->execute();

                    Header('Location: ajouter_document.php?action=ok');
                    exit();
                } catch (PDOException $e) {
                    // Gérer les erreurs de connexion à la base de données
                    echo "Erreur de connexion à la base de données : " . $e->getMessage();
                }
            } else {
                Header('Location: ajouter_document.php?action=dossier');
                exit();
            }
        } else {
            Header('Location: ajouter_document.php?action=format');
            exit();
        }
    } else {
        Header('Location: ajouter_document.php?action=erreur');
        exit();
    }
}
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
                                    <h5 class="m-b-10">
                                        Publier un document
                                    </h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href=""><i class="feather icon-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:">Site web</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:">Publier sur le site web</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Publication</h5>
                                        <p>Remplissez le formulaire ci-dessous afin de publier un nouveau document sur le site web.</p>
                                    </div>
                                    <div class="card-body">
                                        <hr><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="post" action="" enctype="multipart/form-data">
                                                    <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre du document :</label>
                                                    <input class="form-control" type="text" name="titre" id="titre" placeholder="Insérez un titre"></input><br>

                                                    <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Note sur le document :</label>
                                                    <input class="form-control" type="text" name="note" id="note" placeholder="Insérez une note"></input><br>

                                                    <label for="document" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Joindre le fichier :</label>
                                                    <input class="form-control" type="file" name="document" id="document" accept=".pdf, .png, .jpeg, .jpg, .gif, .docx, .xlsx, .pptx, .doc, .xls, .ppt, .txt"></input><br>

                                                    <input type="submit" value="Importer le document" class="btn btn-primary" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

<div class="modal fade" id="ok" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="tbmodal">
            <h3 style="color:white;">Le document vient d'être publié.</h3>
        </div>
    </div>
</div>
<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="tbmodal">
            <h3 style="color:white;">Merci de remplir tous les champs.</h3>
        </div>
    </div>
</div>
<div class="modal fade" id="format" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="tbmodal">
            <h3 style="color:white;">Seuls les fichiers de type PDF, PNG, JPEG, GIF, Word, Excel, PowerPoint et Texte sont acceptés.</h3>
        </div>
    </div>
</div>
<div class="modal fade" id="dossier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="tbmodal">
            <h3 style="color:white;">Erreur, le dossier de destination des fichiers est introuvable.</h3>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    $errlogin = htmlspecialchars($_GET['action']);

    switch ($errlogin) {
    case 'ok':
        ?>
        <script>
            $(document).ready(function () {
                $("#ok").modal('show');
            });
        </script>
    <?php
    break;

    case 'erreur':
    ?>
        <script>
            $(document).ready(function () {
                $("#erreur").modal('show');
            });
        </script>
    <?php
    break;

    case 'dossier':
    ?>
        <script>
            $(document).ready(function () {
                $("#dossier").modal('show');
            });
        </script>
    <?php
    break;

    case 'format':
    ?>
        <script>
            $(document).ready(function () {
                $("#format").modal('show');
            });
        </script>
        <?php
        break;
    }
}
?>

</body>

</html>
