<?php
include("inc/sql.php");

function connected_only()
{
	if(!isset($_SESSION['user'])) {
		Header("Location: index.php");
		exit();
									}
}

function already_connected()
{
	if(isset($_SESSION['user'])) {
		Header("Location: accueil.php");
		exit();
								}
}

?>