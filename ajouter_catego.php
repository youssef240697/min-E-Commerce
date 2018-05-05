<?php
session_start();
if(!isset($_SESSION['nom']) or !isset($_SESSION['prenom'])){
	header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="">
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>iris</title>
	<style>
		div{
			background-color: red;
			font-size: 20px;
			font-weight: bold;
			display: inline-block;
		}
		textarea{
			width: 550px;
		}
		#green{
			background-color: greenyellow;
			font-size: 20px;
			font-weight: bold;
			display: inline-block;
			
		}
	</style>
</head>

<body>
	<form action="ajouter_catego.php" method="post" enctype="multipart/form-data">
                    <fieldset><h3 style=" margin:35px; text-align: center;">ajout d'une catégorie</h3></fieldset>
                        <table style="margin: auto;">
                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Nom </label></td>
							<td><input type='text' name="nom" required></td>
							</tr>
						<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Description </label></td>
								<td><textarea type="text" name="description" required ></textarea></td></tr>
                   		
                        <tr><td></td><td><input type="submit" name="envoyer" value="ajouter"></td></tr>
                        </table>
                </form>
				
</body>

	<?php
	if(isset($_POST['envoyer'])){
	include("connexion.php");
	
		$nom = addslashes($_POST['nom']);
	$description = addslashes($_POST['description']);
	
	//check si le categorie deja dans base	
	$sql ="select * from categorie where nom = '$nom' and description= '$description'";	
	$resultat = mysqli_query($link,$sql);
	if(mysqli_num_rows($resultat) == 0){
		$sql = "insert into categorie(nom,description) VALUES('$nom','$description')";
		$resultat = mysqli_query($link,$sql);
		if($resultat) echo "<br><div id='green'>catégorie ajouter avec succes</div><br>";
		else echo "erreur";
		}
	else{
			echo "<br><div>catégorie deja dans la base</div>";
		}
		}

	?>
</html>
