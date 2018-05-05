<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title></title>
	<style>
		img{
			float: left;
		}
		span{
			font-size: 20px;
			padding: -10px;
			font-weight: bold;
		}
		#logo{
			float: none;
			display: block;
			margin: 0px auto;
		}
		body{
			font-size: 20px;
		}
		div{
			margin:50px;
			width: 100%;
		}
		#admin,a{
			margin-left: 40%;
		}
		a{
			color: black;
			font-size: 35px;
		}
		a:hover{
			color:aquamarine;
		}
	</style>
</head>

<body>
	<?php
	
	include("connexion.php");
	$requette="SELECT* FROM produit";
		
	echo  '<img id="logo" src="images/logo.jpg" alt="pas d image pour ce profil">' ;
	if(!isset($_SESSION['nom']) or !isset($_SESSION['prenom'])){
	echo '<a href="admin.php">login</a>';
	}
	else{
		echo "<div id='admin'><h3>admin connecté(e) :  <h2>".$_SESSION['prenom']." ".$_SESSION['nom']."</h2></h3>";
		echo '<a href="logout.php">déconnecter</a></div>';

	}
	echo  '<h1>HIGH-tech de grandes marques à petit prix</h1>' ;

                        $resultat=mysqli_query($link,$requette);
                        while ($donnees=mysqli_fetch_assoc($resultat)) {
                            echo '<hr>';
							echo '<br>';
							echo  '<img src="images/'.$donnees['photo'].'" alt="pas d image pour ce profil">' ;
                            echo $donnees['designation'];
							echo "<hr>";
                            echo  '<div><span>Prix :</span>'.$donnees['prix']."</div>";
							echo "<br>";
							echo "<hr>";
                            echo  '<div><span>Quantité en stock :</span>'.$donnees['quantite_stock']."</div>";							
                            echo '<hr>';
                        }
	?>
</body>
</html>
