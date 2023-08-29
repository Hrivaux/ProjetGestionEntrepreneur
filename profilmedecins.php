<?php
require ('global.php');

connected_only();

$requete = $bdd->prepare("SELECT * FROM medecins WHERE id = :id");

$requete->bindValue('id', $_GET['id']);
$requete->execute();
$profilmedecin = $requete->fetch();

$idmedecin = $_GET['id'];


// Nombre de médicaments
$nbMEDOC = $bdd->query("SELECT count(*) as nb from comptesrendus WHERE id_medecin = $idmedecin");
$data = $nbMEDOC->fetch();
$nbmedocs = $data['nb'];

if (!$profilmedecin) {
	header('location: liste_clients.php');
    exit;
}

$prenomnomprofil = $profilmedecin['prenom'] ." " . $profilmedecin['nom'];

$pageinfo = "Profil médecin - $prenomnomprofil";
$pageactive = "";

include ("templates/meta.php");
?>
<style>th, td { border-left: 1px solid #e2e8f0; width: 300px; text-align: center; }</style>
	<body class="content-center">
		<div class="loader-bg">
			<div class="loader-track">
				<div class="loader-fill"></div>
			</div>
		</div>
		<?php include('templates/menu.php'); ?>
		<?php include('templates/header.php'); ?>
					<center>
						<img class="shadow rounded-full h-48 w-96 align-middle border-none" src="img/<?php echo $profilmedecin['img']; ?>">
						<div class="overflow-x-auto relative">
							<table class="border-2 my-3 text-sm text-left text-gray-500 dark:text-gray-400">
								<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
									<tr>
										<th scope="col" class="py-3 px-6">
											Nom / Prénom
										</th>
										<th scope="col" class="py-3 px-6">
											Siret
										</th>
										<th scope="col" class="py-3 px-6">
											Email
										</th>
									</tr>
								</thead>
								
								<tbody>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											<?php echo $prenomnomprofil; ?>
										</th>
										<td class="py-4 px-6">
											<?php echo $profilmedecin['siret']; ?>
										</td>
										<td class="py-4 px-6">
											<?php echo $profilmedecin['email']; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<br>
						<div class="overflow-x-auto relative">
							<table class="border-2 text-sm text-left text-gray-500 dark:text-gray-400">
								<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
									<tr>
										<th scope="col" class="py-3 px-6" style="text-align: center;">
											Adresse
										</th>
										<th scope="col" class="py-3 px-6">
											Nombre de compte<?php if ($nbmedocs > 1) { ?>s <?php } ?> rendu<?php if ($nbmedocs > 1) { ?>s <?php } ?>
										</th>
									</tr>
								</thead>
							<tbody>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											<?php echo $profilmedecin['adresse'].", ".$profilmedecin['ville']." - ".$profilmedecin['code_postal']; ?>
										</th>
										<td class="py-4 px-6">
											<?php echo $nbmedocs; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php if ($grade_encours>2) { ?>
						<a class="btn btn-danger m-2" href="inc/actions/delete_med.php?id=<?php echo $profilmedecin['id']; ?>">Supprimer</a>
						<?php } ?>
						<a class="btn btn-primary m-2" href="liste_clients.php">Retour</a>
</center>

<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>


</body>
</html>
