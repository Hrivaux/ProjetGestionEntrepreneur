<?php
session_start();

require_once '../../global.php';

// On récupère les valeurs du formulaire:
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$image = $_POST['get_image'];
$siret = $_POST['siret'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$codepostal = $_POST['codepostal'];
$personne_rattachee = $_POST['p_rattache'];

if(isset($_POST['get_image'])) {
    $url=$_POST['get_image'];
    if(empty($url)) {
        $url = 'https://cours-informatique-gratuit.fr/wp-content/uploads/2014/05/compte-utilisateur-1.png';
    }
    $nomfichier = basename($url);
    $data = file_get_contents($url);
    $new = '../../img/'.$nomfichier.''; //nom de fichier
    file_put_contents($new, $data);

} else {
    // Si l'URL de l'image n'est pas fournie, utilisez l'image par défaut
    $url = "https://cours-informatique-gratuit.fr/wp-content/uploads/2014/05/compte-utilisateur-1.png";
    $nomfichier = basename($url);
    $data = file_get_contents($url);
    $new = '../../img/'.$nomfichier.''; //nom de fichier
    file_put_contents($new, $data);
}

if (isset($nom) && isset($prenom) && isset($siret) && isset($email) && isset($adresse) && isset($ville) && isset($codepostal) && isset($personne_rattachee)) {

    $reponse = $bdd->prepare("INSERT INTO medecins(visiteur_id,img,siret,nom,prenom,email,adresse,ville,code_postal) VALUES (?,?,?,?,?,?,?,?,?)");

    $reponse->execute(array($personne_rattachee, $nomfichier, $siret, $nom, $prenom, $email, $adresse, $ville, $codepostal));

    //Logs
    $req_logs = ("INSERT INTO logs(user_id,type_log,action, date) VALUES ($id_encours, 'Insertion', 'A créé le profil du médecin ($email)', '$today')");
    $bdd->exec($req_logs);
    header ('Location: ../../accueil.php?actionno=successmed');
} 
else 
{
    Header('location: ../../add_medecins.php?action=erreur');
}
?>
