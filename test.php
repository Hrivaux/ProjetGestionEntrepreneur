<?php
require('global.php');

connected_only();

$requete = $bdd->prepare("SELECT * FROM utilisateurs_dossiers WHERE user_id = :user_id");
$requete->bindParam(':user_id', $id_encours);
$requete->execute();
$dossiers = $requete->fetchAll(PDO::FETCH_ASSOC); // Utiliser FETCH_ASSOC pour obtenir un tableau associatif

// Charger les documents du premier dossier par défaut
$idDossier = !empty($dossiers) ? $dossiers[0]['id'] : null;
$documents = [];

if ($idDossier) {
    $requeteDocuments = $bdd->prepare("SELECT * FROM dossiers_documents WHERE dossier_id = :id_dossier");
    $requeteDocuments->bindParam(':id_dossier', $idDossier);
    $requeteDocuments->execute();
    $documents = $requeteDocuments->fetchAll(PDO::FETCH_ASSOC);
}
?>
<html lang="fr"><head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Web site created using create-react-app">
    <link rel="apple-touch-icon" href="assets/logo192.png">
    <link rel="manifest" href="assets/manifest.json">
    <title>Gestion de mes documents</title>
    <link href="assets/static/css/main.15c655ba.chunk.css" rel="stylesheet">

    <style>
        .window-container {
            display: none;
        }
    </style>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="root">
    <section id="desktop-screen">
        <div class="desktop-icons">
            <?php foreach ($dossiers as $dossier) {
                $nomDossier = htmlspecialchars($dossier['libelle_dossier']);
                $idDossier = $dossier['id'];
                ?>
                <div class="item-style-icon" data-id-dossier="<?php echo $idDossier; ?>" title="<?php echo $nomDossier; ?>" aria-label="<?php echo $nomDossier; ?>" tabindex="1" onclick="openWindow('<?php echo $nomDossier; ?>', <?php echo $idDossier; ?>)">
                    <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                    <p class="icon-name"><?php echo $nomDossier; ?></p>
                </div>
            <?php } ?>
        </div>
    </section>

    <div class="window-container" id="window-container">
        <div class="window" tabindex="0" style="max-height: 400px; max-width: 500px; min-width: 500px; min-height: 400px; top: 25%; left: 25%; z-index: 1000;">
            <div class="resizing-container"><div class="t-side"></div>
                <div class="l-side"></div>
                <div class="r-side"></div>
                <div class="b-side"></div>
                <div class="tl-corner"></div>
                <div class="tr-corner"></div>
                <div class="bl-corner"></div>
                <div class="br-corner"></div>
            </div>
            <div class="frame br-b br-t br-r br-l br-r-tl br-r-tr">
                <div class="title-bar">
                    <div class="window-actions">
                        <div class="close" title="Close" aria-label="Close">
                            <div class="button-text" onclick="closeWindow()">
                                <img alt="close-icon" src="./assets/icons/close.png">
                            </div>
                        </div>
                        <div class="minimize" title="Minimize" aria-label="Minimize">
                            <div class="button-text">
                                <img alt="minimize-icon" src="./assets/icons/minimize.png">
                            </div>
                        </div>
                        <div class="maximize" title="Maximize" aria-label="Maximize">
                            <div class="button-text">
                                <img alt="full-screen-icon" src="./assets/icons/full-screen.png">
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <img alt="generic-folder" src="./assets/icons/generic-folder.png">
                        <p id="folderTitle" class="ellipsis" title="Dossier" aria-label="Dossier">xxx</p>
                    </div>
                </div>
                <div class="tool-bar">
                    <div class="window-actions" title="See folders that you've viewed before" aria-label="See folders that you've viewed before">
                        <div class="back-button disabled">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240.823 240.823">
                                <path id="Chevron_Right" d="M57.633,129.007L165.93,237.268c4.752,4.74,12.451,4.74,17.215,0c4.752-4.74,4.752-12.439,0-17.179
 l-99.707-99.671l99.695-99.671c4.752-4.74,4.752-12.439,0-17.191c-4.752-4.74-12.463-4.74-17.215,0L57.621,111.816
 C52.942,116.507,52.942,124.327,57.633,129.007z"></path>
                            </svg>
                        </div>
                        <div class="forward-button disabled">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240.823 240.823" style="transform: rotate(180deg);">
                                <path id="Chevron_Right" d="M57.633,129.007L165.93,237.268c4.752,4.74,12.451,4.74,17.215,0c4.752-4.74,4.752-12.439,0-17.179
 l-99.707-99.671l99.695-99.671c4.752-4.74,4.752-12.439,0-17.191c-4.752-4.74-12.463-4.74-17.215,0L57.621,111.816
 C52.942,116.507,52.942,124.327,57.633,129.007z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="container-size">
                        <div class="body-actions">
                            <div class="left">
                                <div class="icon-type-list" title="Show items as icons, in a list, or in columns" aria-label="Show items as icons, in a list, or in columns">
                                    <div class="icon-type-icon-size active br-r-tl br-r-bl ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
                                            <path id="svg_2" d="m12.35241,35.359" opacity="0.5" stroke-width="1.5"></path>
                                            <rect rx="4" id="svg_5" height="20.63208" width="21.3325" y="8.8331" x="7.70542" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                            <rect rx="4" id="svg_13" height="20.74307" width="21.22151" y="40.16384" x="7.59443" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                            <rect rx="4" id="svg_14" height="20.78579" width="20.89345" y="8.94409" x="40.88846" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                            <rect rx="4" id="svg_15" height="20.96504" width="21.44348" y="40.20186" x="40.96208" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                        </svg>
                                    </div>
                                    <div class="list-size   clip-l clip- r">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" viewBox="0 0 60 60">
                                            <path d="" id="a4LPYj6orX"></path><path d="M55.77 7.12C56.66 7.12 57.38 7.84 57.38 8.73C57.38 9.46 57.38 10.07 57.38 10.8C57.38 11.69 56.66 12.4 55.77 12.4C45.14 12.41 14.86 12.41 4.23 12.4C3.34 12.4 2.63 11.69 2.63 10.8C2.63 10.07 2.63 9.46 2.63 8.73C2.63 7.84 3.34 7.12 4.23 7.12C14.86 7.12 45.14 7.12 55.77 7.12Z" id="aLBD0I4be"></path><path d="M55.77 20.23C56.66 20.23 57.37 20.95 57.37 21.84C57.37 22.57 57.37 23.18 57.37 23.91C57.37 24.8 56.66 25.52 55.77 25.52C45.14 25.52 14.86 25.52 4.23 25.52C3.34 25.52 2.62 24.8 2.62 23.91C2.62 23.18 2.62 22.57 2.62 21.84C2.62 20.95 3.34 20.23 4.23 20.23C14.86 20.24 45.14 20.24 55.77 20.23Z" id="b2gwNPWFnX"></path><path d="M55.77 34.16C56.66 34.16 57.37 34.87 57.37 35.76C57.37 36.49 57.37 37.1 57.37 37.83C57.37 38.72 56.66 39.44 55.77 39.44C45.14 39.44 14.86 39.44 4.23 39.44C3.34 39.44 2.62 38.72 2.62 37.83C2.62 37.1 2.62 36.49 2.62 35.76C2.62 34.87 3.34 34.16 4.23 34.16C14.86 34.16 45.14 34.16 55.77 34.16Z" id="e2gIkJW7PK"></path>
                                            <path d="M55.77 47.6C56.66 47.6 57.37 48.31 57.37 49.2C57.37 49.93 57.37 50.54 57.37 51.27C57.37 52.16 56.66 52.88 55.77 52.88C45.14 52.88 14.86 52.88 4.23 52.88C3.34 52.88 2.62 52.16 2.62 51.27C2.62 50.54 2.62 49.93 2.62 49.2C2.62 48.31 3.34 47.6 4.23 47.6C14.86 47.6 45.14 47.6 55.77 47.6Z" id="ctXYLCPAl"></path>
                                        </svg>
                                    </div>
                                    <div class="window-size   clip-l br-r-tr br-r-br">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" viewBox="0 0 70 70">
                                            <rect rx="3" id="svg_18" height="37.08042" width="62.26415" y="16.47951" x="3.86793" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                            <rect id="svg_19" height="37.08042" width="22.53052" y="16.44007" x="23.73474" fill-opacity="null" stroke-opacity="null" stroke-width="4" fill="transparent"></rect>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="search-bar">
                                    <div class="search-icon">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612.01 612.01">
                                            <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
 C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
 l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
 c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
 S377.82,467.8,257.493,467.8z"></path>
                                        </svg>
                                    </div>
                                    <div class="search-input">
                                        <input type="text" name="search" placeholder="Search" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body br-r br-l" style="max-height: 297px;">
                <div class="panel br-r">
                    <ul class="panel-list">
                        <li class="panel-list-item">
                            <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                            <p class="ellipsis">Recent Links</p>
                        </li>
                        <li class="panel-list-item">
                            <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                            <p class="ellipsis">Bookmarks</p>
                        </li>
                        <li class="panel-list-item">
                            <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                            <p class="ellipsis">Blogs</p>
                        </li>
                        <li class="panel-list-item">
                            <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                            <p class="ellipsis">Social Links</p>
                        </li>
                        <li class="panel-list-item">
                            <img alt="icon-logo" src="./assets/icons/generic-folder.png">
                            <p class="ellipsis">Desktop</p>
                        </li>
                    </ul>
                </div>
                <div class="container-tab" id="container-tab">

                </div>
            </div>
            <div class="frame br-b br-t br-r br-l br-r-bl br-r-br">
                <div class="status-bar">
                    <p>0 items</p></div>
            </div>
        </div>
    </div>
</div>

<script>

    function openWindow(nomDossier, idDossier) {
        var windowContainer = document.getElementById('window-container');
        windowContainer.style.display = 'block';

        var folderTitle = document.getElementById('folderTitle');
        folderTitle.innerText = nomDossier;

        // Fetch documents for the selected dossier
        fetchDocuments(idDossier);
    }

    function fetchDocuments(idDossier) {
        var containerTab = document.getElementById('container-tab');
        containerTab.innerHTML = ''; // Clear the previous documents

        // Fetch documents for the selected dossier
        fetch('fetch_documents.php?id_dossier=' + idDossier)
            .then(response => response.text())
            .then(data => {
                // Append the new documents to the container-tab
                containerTab.innerHTML = data;
            })
            .catch(error => console.error('Error fetching documents:', error));
    }

    function closeWindow() {
        var windowContainer = document.getElementById('window-container');
        windowContainer.style.display = 'none';
    }

</script>

<!--
<script>
    !function(e){function r(r){for(var n,i,a=r[0],c=r[1],l=r[2],s=0,p=[];s<a.length;s++)i=a[s],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&p.push(o[i][0]),o[i]=0;for(n in c)Object.prototype.hasOwnProperty.call(c,n)&&(e[n]=c[n]);for(f&&f(r);p.length;)p.shift()();return u.push.apply(u,l||[]),t()}function t(){for(var e,r=0;r<u.length;r++){for(var t=u[r],n=!0,a=1;a<t.length;a++){var c=t[a];0!==o[c]&&(n=!1)}n&&(u.splice(r--,1),e=i(i.s=t[0]))}return e}var n={},o={1:0},u=[];function i(r){if(n[r])return n[r].exports;var t=n[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,i),t.l=!0,t.exports}i.e=function(e){var r=[],t=o[e];if(0!==t)if(t)r.push(t[2]);else{var n=new Promise((function(r,n){t=o[e]=[r,n]}));r.push(t[2]=n);var u,a=document.createElement("script");a.charset="utf-8",a.timeout=120,i.nc&&a.setAttribute("nonce",i.nc),a.src=function(e){return i.p+"static/js/"+({}[e]||e)+"."+{3:"97ce0975"}[e]+".chunk.js"}(e);var c=new Error;u=function(r){a.onerror=a.onload=null,clearTimeout(l);var t=o[e];if(0!==t){if(t){var n=r&&("load"===r.type?"missing":r.type),u=r&&r.target&&r.target.src;c.message="Loading chunk "+e+" failed.\n("+n+": "+u+")",c.name="ChunkLoadError",c.type=n,c.request=u,t[1](c)}o[e]=void 0}};var l=setTimeout((function(){u({type:"timeout",target:a})}),12e4);a.onerror=a.onload=u,document.head.appendChild(a)}return Promise.all(r)},i.m=e,i.c=n,i.d=function(e,r,t){i.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,r){if(1&r&&(e=i(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(i.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)i.d(t,n,function(r){return e[r]}.bind(null,n));return t},i.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(r,"a",r),r},i.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},i.p="/extOS/",i.oe=function(e){throw console.error(e),e};var a=this["webpackJsonpmac-os-ui"]=this["webpackJsonpmac-os-ui"]||[],c=a.push.bind(a);a.push=r,a=a.slice();for(var l=0;l<a.length;l++)r(a[l]);var f=c;t()}([])
</script>
-->

<script src="assets/static/js/2.86dda7a6.chunk.js"></script>
<script src="assets/static/js/main.86323628.chunk.js"></script>


</body>
</html>