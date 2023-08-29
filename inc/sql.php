<?php
try
      {
          $bdd = new PDO('mysql:host=mysql-hubin.alwaysdata.net;dbname=hubin_gestion', 'hubin', 'HubinSQL2022!');
       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $bdd->exec("SET CHARACTER SET utf8");
      }
    catch(Exception $e)
     {
      die('Erreur : '.$e->getMessage());
     }
?>