<header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="accueil.php" class="b-brand">
                   <div class="b-bg">
                       <i class="feather icon-trending-up"></i>
                   </div>
                   <span class="b-title"><?php echo $nomsite; ?></span>
               </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li class="nav-item dropdown">
                    <b><?php echo $prenomnom." - ".$fonction_encours; ?></b>
                </li>
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" style="width: 100px;" placeholder="Rechercher...">
                            <a href="javascript:" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>

                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">Dernières notifications</p>
                                </li>
                                <?php 
                                    $requete = ("SELECT 
                                                        N.id        as 'id_notif',
                                                        N.user_id   as 'user_id',
                                                        N.message   as 'message',
                                                        N.grade     as 'grade',
                                                        N.send_date as 'date',
                                                        U.id        as 'id_user',
                                                        U.nom       as 'nom_user',
                                                        U.prenom    as 'prenom_user',
                                                        U.sexe      as 'sexe'
                                                FROM notifications     N 
                                                LEFT JOIN utilisateurs U ON U.id = N.user_id
                                                ORDER BY N.id desc");

                                        $reqnotif = $bdd->prepare($requete);
                                        $reqnotif->execute();
                                                        
                                        $resultat = $reqnotif->fetchAll();
                                                if (!empty($resultat)) {
                                                    foreach($resultat as $notification)  { 
                                ?>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?php echo $url; ?>/assets/images/user/avatar-<?php if ($notification['sexe'] == '1') { echo "1"; } else { echo "0"; } ?>.jpg?<?php echo rand(1, 758); ?>" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong><?php echo $notification['nom_user']." ".$notification['prenom_user'];?></strong><!--<span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span>--></p>
                                            <p><?php echo $notification['message'];?></p>
                                        </div>
                                    </div>
                                </li>
                                    <?php } } 
                                             else {
                                                    echo "Aucune notification."; } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo $prenomnom; ?></span>
                                <a href="logout.php" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="tb_medecin.php" class="dropdown-item"><i class="feather icon-user"></i> Les médecins</a></li>
                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-settings"></i> Paramètres</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>