<?php
session_start();

if(!isset($_SESSION['nom']) or !isset($_SESSION['prenom'])){
	header("Location: admin.php");
}
else{
	session_destroy();
	echo "Déconnecter avec succes";
	header("Location: index.php");
}