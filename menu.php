<?php
session_start();
if(!isset($_SESSION['nom']) or !isset($_SESSION['prenom'])){
	header("Location: admin.php");
}
?>
		
<!DOCTYPE html>
<html lang="fr">
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<style>
					div{
						background-color:azure;
						display: block;
						border: 1px solid black;
						font-size: 100px;
						margin: auto;
						width: 50%;
						
					}
					a{
						text-decoration:none;
						color: black;
					}
					a:hover{
						color:aqua;
					}
				</style>
				<title></title>
</head>

<body>
				

<?php
echo "<h3>admin connecté(e) :  <h1>".$_SESSION['prenom']." ".$_SESSION['nom']."</h1></h3>";
echo '<a href="logout.php">déconnecter</a>';
echo "<div><a href='ajouter_produit.php'>ajouter un produit</a></div><br>";
echo "<div><a href='modif_produit.php'>modifier un produit</a></div><br>";
echo "<div><a href='afficher_liste.php'>afficher la liste des catégories</a></div><br>";
echo "<div><a href='ajouter_catego.php'>ajouter une catégorie</a></div><br>";
echo "<div><a href='modifier_catego.php'>modifier une catégorie</a></div><br>";
echo "<a style='font-weight:bold;' href='logout.php'>Déconnecter</a>";

?>
	
	</body>
</html>
		
</body>
</html>
