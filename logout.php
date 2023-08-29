<?php
require_once "global.php";

connected_only();

session_destroy();
Header("Location: index.php");
exit();
?>