<?php
require_once 'global.php';

connected_only();

$pageinfo = "Supprimer un médecin";
$pageactive = "AM";

include('templates/meta.php');
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
											Notifications
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">SAISIES & CONSULTATIONS</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Supprimer un médecin</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<?php
					if (isset($_POST['id'])) {
					    $id_medecin = $_POST['id'];
					    
					    $stmt = $bdd->prepare("DELETE FROM medecins WHERE id = ?");
					    $stmt->execute([$id_medecin]);
					    echo '<div class="alert alert-success">Le médecin a été supprimé.</div>';
					}
					?>

					<form method="post" action="">
					    <br>
					    <label for="id">Sélectionner un médecin à supprimer :</label>
					    <select id="id" name="id" class="form-control" required>
					        <option selected disabled>Veuillez choisir un médecin</option>
					        <?php
					        $reponse = $bdd->query('SELECT id, prenom FROM medecins');
					        while ($donnees = $reponse->fetch()) {
					            echo '<option value="' . $donnees['id'] . '">' . $donnees['prenom'] . '</option>';
					        }
					        $reponse->closeCursor();
					        ?>
					    </select>
					    <br><br>
					    <input class="btn btn-primary" type="submit" name="submit" value="Supprimer">
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/pcoded.min.js"></script>
</body>

</html>
