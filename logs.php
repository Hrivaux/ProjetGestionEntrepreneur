<?php
require ('global.php');

connected_only();

// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

// On détermine le nombre de logs total
$logscompte = 'SELECT COUNT(*) AS nb FROM `logs`;';

// On prépare la requête
$query = $bdd->prepare($logscompte);

// On exécute
$query->execute();

// On récupère le nombre de logs
$result = $query->fetch();
$nbLogs = (int) $result['nb'];

// On détermine le nombre de logs par page
$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbLogs / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


$pageinfo = "Logs des utilisateurs";
$pageactive = "LOGS";

include('templates/meta.php');

if ($grade_encours <= 2) 
{
    Header('location: accueil.php');
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
	<section class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="page-header">
						<div class="page-block">
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="page-header-title">
										<h5 class="m-b-10">
											Logs
										</h5>
									</div>
									<ul class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html"><i class="feather icon-home"></i></a>
										</li>
										<li class="breadcrumb-item"><a href="#!">Administration</a></li>
										<li class="breadcrumb-item"><a href="javascript:">Logs</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="main-body">
						<div class="page-wrapper">
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header">
											<h5>
												Liste des médecins
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
																Type d'action
															</th>
															<th>
																Logs
															</th>
															<th>
																Date
															</th>
														</tr>
													</thead>
													<tbody>
														<?php $requete = ("SELECT 
																		L.id	as 'log_id',
																		L.type_log	as 'type',
																		L.action	as 'action',
																		L.date	as 'date',
																		U.id,
																		U.nom	as 'nom',
																		U.prenom as 'prenom'
																	FROM 
																		logs 				L
																	INNER JOIN utilisateurs U ON L.user_id = U.id
																	ORDER BY L.id DESC LIMIT :premier, :parpage;");
														
														$reqlogs = $bdd->prepare($requete);
														$reqlogs->bindValue(':premier', $premier, PDO::PARAM_INT);
														$reqlogs->bindValue(':parpage', $parPage, PDO::PARAM_INT);
														
														$reqlogs->execute();
														
														$resultat = $reqlogs->fetchAll(PDO::FETCH_ASSOC);
														if (!empty($resultat))
														{
															foreach ($resultat as $logs)
															{ ?>
														<tr>
															<td>
																<h6 class="m-0">
																	<b><?php echo $logs['nom']." ".$logs['prenom']; ?></b>
																</h6>
																<td>
																	<h6 class="m-0">
																		<?php echo $logs['type']; ?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																		<?php echo $logs['action']; ?>
																	</h6>
																</td>
																<td>
																	<h6 class="m-0">
																		<?php echo strftime('%d-%m-%Y',strtotime($logs['date'])); ?>
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
															<a class="page-link" href="<?php echo $url;?>/logs.php?page=<?= $currentPage - 1 ?>" aria-label="Précédent"><span aria-hidden="true">&laquo;</span><span class="sr-only">Précédent</span></a>
														</li>
														<?php for($page = 1; $page <= $pages; $page++): ?>
															<li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
																<a class="page-link" href="<?php echo $url;?>/logs.php?page=<?= $page ?>"><?= $page ?></a>
															</li>
														<?php endfor ?>
														<li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
															<a class="page-link" href="<?php echo $url;?>/logs.php?page=<?= $currentPage + 1 ?>" aria-label="Suivant"><span aria-hidden="true">&raquo;</span><span class="sr-only">Suivant</span></a>
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
    </section>

<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>
</html>
