<?php
      // On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
      $page = $_SERVER['REQUEST_URI'];
      $page = str_replace("/siteyetistudio/", "",$page);
?>
    
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="<?php echo $url; ?>/accueil.php" class="b-brand">
                    <div class="b-bg">
                        <i class="feather icon-trending-up"></i>
                    </div>
                    <span class="b-title">GSB</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li data-username="Accueil" <?php if ($pageactive == "Accueil") {  ?> class="nav-item active" <?php } ?>>
                        <a href="accueil.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Accueil</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>VISITES</label>
                    </li>
                    <li data-username="Saisie & consultations" <?php if ($pageactive == "RDV1") {  ?> class="nav-item active" <?php } ?>>
                        <a href="prendre_rdv.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-calendar"></i></span><span class="pcoded-mtext">Organiser une visite</span></a>
                    </li>
                    <li data-username="Visites à venir" <?php if ($pageactive == "RDV2") {  ?> class="nav-item active" <?php } ?>>
                        <a href="<?php echo $url; ?>/mes_visites.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clock"></i></span><span class="pcoded-mtext">Visites à venir et à rédiger</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Saisies & consultations</label>
                    </li>
                    <li data-username="Liste des comptes-rendus" <?php if ($pageactive == "CR") {  ?> class="nav-item active" <?php } ?>>
                        <a href="<?php echo $url; ?>/liste_cr.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Liste des comptes rendus</span></a>
                    </li>
                    <li data-username="Liste des clients" <?php if ($pageactive == "LM") {  ?> class="nav-item active" <?php } ?>>
                        <a href="<?php echo $url; ?>/liste_clients.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Liste des clients</span></a>
                    </li>
                    <li data-username="Ajouter un médecin" <?php if ($pageactive == "AM") {  ?> class="nav-item active" <?php } ?>>
                        <a href="<?php echo $url; ?>/add_medecins.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-plus-circle"></i></span><span class="pcoded-mtext">Ajouter un médecin</span></a>
                    </li>
                    <li data-username="Ajouter un document" <?php if ($pageactive == "ADD") {  ?> class="nav-item active" <?php } ?>>
                        <a href="<?php echo $url; ?>/ajouter_document.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-plus-document"></i></span><span class="pcoded-mtext">Ajouter un document</span></a>
                    </li>
					
                    <?php if ($grade_encours >= 3) { ?>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Administration</label>
                    </li>
					
					<!-- <li data-username="Gérer les grades" <?php if ($pageactive == "GRROL") {  ?> class="nav-item active" <?php } ?>><a href="<?php echo $url; ?>/gerer_roles.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Gérer les grades</span></a></li> -->
                    <li data-username="Paramètres du site" <?php if ($pageactive == "PARAMS") {  ?> class="nav-item active" <?php } ?>><a href="<?php echo $url; ?>/site_settings.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Paramètres du site</span></a></li>
                    <li data-username="Notifications" <?php if ($pageactive == "NOTIFS") {  ?> class="nav-item active" <?php } ?>><a href="<?php echo $url; ?>/notifications.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-bell"></i></span><span class="pcoded-mtext">Notifications</span></a></li>
                    <li data-username="Création de compte"><a href="<?php echo $url; ?>/inscription.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-plus-circle"></i></span><span class="pcoded-mtext">Création de compte</span></a></li>
                    <li data-username="Historique (logs)" <?php if ($pageactive == "LOGS") {  ?> class="nav-item active" <?php } ?>><a href="<?php echo $url; ?>/logs.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Historique (logs)</span></a></li>
                    <?php } ?>

                    <li class="nav-item pcoded-menu-caption">
                        <label>Mon compte</label>
                    </li>
                    <!-- <li data-username="" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="auth-signup.html" class="" target="_blank">S'enregistrer</a></li>
                            <li class=""><a href="auth-signin.html" class="" target="_blank">Connexion</a></li>
                        </ul>
                    </li>
                    <li data-username="Sample Page" class="nav-item"><a href="sample-page.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li> -->
                    <li data-username="Déconnexion" class="nav-item"><a href="<?php echo $url; ?>/logout.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Déconnexion</span></a></li>
                </ul>
            </div>
        </div>
    </nav>