<?php
require('global.php');

connected_only();


// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

// On détermine le nombre de logs total
$logscompte = 'SELECT COUNT(*) AS nb FROM `users_grades`;';

// On prépare la requête
$query = $bdd->prepare($logscompte);

// On exécute
$query->execute();

// On récupère le nombre de logs
$result = $query->fetch();
$nbRoles = (int) $result['nb'];

// On détermine le nombre de logs par page
$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbRoles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


$pageinfo = "Gérer les grades";
$pageactive = "GRROL";

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
											Gérer les grades des utilisateurs
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:">SAISIES & CONSULTATIONS</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Gérer les grades des utilisateurs</a></li>
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
										<div class="card-body">
											<div class="row">
												<div class="col-md-6" style="margin-left: 380px;margin-top: 50px;">
													<form method="post" action="inc/actions/form_grade_ajouter.php" enctype="multipart/form-data">
														<div class="form-group">
															<label for="exampleInputEmail1">Utilisateur</label>
															<select id="utilisateur" name="utilisateur" class="form-control" required>
																<option selected>Veuillez choisir un utilisateur</option>
																<?php $reponse = $bdd->query('SELECT id, nom, prenom FROM utilisateurs');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom']." ".$donnees['prenom']; ?></option>
				                                                <?php } ?>
															</select>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Grade</label>
															<select id="grade" name="grade" class="form-control" required>
																<option selected>Veuillez choisir un grade à attribuer</option>
																<?php $reponse = $bdd->query('SELECT id_grade, libelle_grade FROM grade');
                                                                     while ($donnees = $reponse->fetch())
									                                        { ?>
				        	                                                <option value="<?php echo $donnees['id_grade']; ?>"><?php echo $donnees['libelle_grade']; ?></option>
				                                                <?php } ?>
															</select>
															</div>
												</div>
												<br>
											</div>
											<input type="submit" value="Attribuer le grade" class="btn btn-primary" />
											</form>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												Liste des grades attribués
											</h5>
										</div>
										<div class="card-block table-border-style">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>
																Utilisateur
															</th>
															<th>
																Grade
															</th>
															<th>
																Supprimer
															</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$requete = ("
														SELECT 
															UR.id			as 'id_UR',
															UR.user_id 		as 'user_idUR',
															UR.grade_id 	as 'grade_idUR',
															U.nom			as 'nom_U',
															U.prenom		as 'prenom_U',
															G.libelle_grade	as 'libelle_grade'
														FROM 
															users_grades UR
															LEFT JOIN utilisateurs U on U.id = UR.user_id
															LEFT JOIN grade G on G.id_grade = UR.grade_id
														ORDER BY 
															id_UR DESC LIMIT :premier, :parpage;");
														
														$reqroles = $bdd->prepare($requete);
														$reqroles->bindValue(':premier', $premier, PDO::PARAM_INT);
														$reqroles->bindValue(':parpage', $parPage, PDO::PARAM_INT);
														
														$reqroles->execute();
														
														$resultat = $reqroles->fetchAll();
														if (!empty($resultat))
														{
															foreach ($resultat as $userRole)
															{
														?>
														
														<tr>
														
																<td>
																	<h6 class="m-0">
																		<?php echo $userRole['nom_U']." ".$userRole['prenom_U'];?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																		<?php echo $userRole['libelle_grade'];?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																		<center><a href="inc/actions/delete_role.php?id=<?php echo $userRole['id_UR'];?>"><img src="img/delete.png" style="width: 25px; height: 38px;"></a></center>
																	</h6>
																</td>
															</tr>
														
															<?php
														}
														}
														else
														{
															echo "Aucun médecin n'a été créé";
														}
														?>

                                                    </tbody>
                                                </table>
												<nav aria-label="Page navigation example">
													<ul class="pagination">
														<li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">	
															<a class="page-link" href="<?php echo $url;?>/gerer_roles.php?page=<?= $currentPage - 1 ?>" aria-label="Précédent"><span aria-hidden="true">&laquo;</span><span class="sr-only">Précédent</span></a>
														</li>
														<?php for($page = 1; $page <= $pages; $page++): ?>
															<li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
																<a class="page-link" href="<?php echo $url;?>/gerer_roles.php?page=<?= $page ?>"><?= $page ?></a>
															</li>
														<?php endfor ?>
														<li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
															<a class="page-link" href="<?php echo $url;?>/gerer_roles.php?page=<?= $currentPage + 1 ?>" aria-label="Suivant"><span aria-hidden="true">&raquo;</span><span class="sr-only">Suivant</span></a>
														</li>
													</ul>
												</nav>
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

<div class="modal fade" id="erreur" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Une erreur est survenue, veuillez vérifier que tous les champs aient bien été remplis.</h3>
		</div>
	</div>
</div>

<?php
	if(isset($_GET['action'])) 
	{
		$errlogin = htmlspecialchars($_GET['action']);
		
		switch($errlogin)
		{
			case 'erreur':
?>
<script>
    $(document).ready(function()
    {
        $("#erreur").modal('show');
    });
</script>
<?php break; } } ?>	

<div class="modal fade" id="successdech" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le grade a bien été supprimé.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['delete'])) {
		$errlogin = htmlspecialchars($_GET['delete']);
		
		switch($errlogin)
		{
			case 'successdech':
?>
<script>
$(document).ready(function(){
    $("#successdech").modal('show');
});
</script>
<?php break; } } ?>

<div class="modal fade" id="successech" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="tbmodal">
			<h3 style="color:white;">Le grade a bien été attribué.</h3>
		</div>
	</div>
</div>
<?php
	if(isset($_GET['actionno'])) {
		$errlogin = htmlspecialchars($_GET['actionno']);
		
		switch($errlogin)
		{
			case 'successech':
?>
<script>
$(document).ready(function(){
    $("#successech").modal('show');
});
</script>
<?php break; } } ?>	

</body>

</html>