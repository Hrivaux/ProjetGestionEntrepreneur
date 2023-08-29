<?php
	session_start();
	require_once '../sql.php';
	
	if(isset($_POST['email']) && isset($_POST['password']))
	{
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		
		$check = $bdd->prepare('SELECT email, mot_de_passe, prenom FROM utilisateurs WHERE email = ?');
		$check->execute(array($email));
		$data = $check->fetch();
		$row = $check->rowCount();
		if($row == 1)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$pass_hash=$data['mot_de_passe'];
				if (password_verify($_POST['password'], $pass_hash))
				{				
					$_SESSION['user'] = $data['email'];
					header('Location: ../../accueil.php');
					
				}else header('Location: ../../index.php?login_err=password');
			}else header('Location: ../../index.php?login_err=email');
		}else header('Location: ../../index.php?login_err=email');
		
	} else header('Location: ../../index.php?login_err=champs');

?>

