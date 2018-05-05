<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title></title>
</head>
	<?php
	if(isset($_POST['previse'])){
		$id = addslashes($_POST['id']);
		include("connexion.php");
		$sql = "select * from categorie where id_categorie = $id";
		$resultat = mysqli_query($link,$sql);
		$dataa = mysqli_fetch_assoc($resultat);
		$_SESSION['id_categorie'] = $id;

	}
	?>

<body>
	<form action="modifier_catego.php" method="post" enctype="multipart/form-data">
                    <fieldset><h3 style=" margin:35px; text-align: center;">modifier d'une catégorie</h3></fieldset>
                        <table style="margin: auto;">
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> id categorie </label></td>
							<td><select name="id" size="1">
							<?php
							
								include("connexion.php");
								$sql = "select id_categorie from categorie";
								$resultat = mysqli_query($link,$sql);
								while($data = mysqli_fetch_assoc($resultat)){
									
									echo "<option value = '".$data['id_categorie']."'";
									if(isset($_SESSION['id_categorie'])){
									if($data['id_categorie'] == $_SESSION['id_categorie']){
									echo "selected";
									}
									
								}
									echo ">".$data['id_categorie'];
									echo "</option>";

								}
								
								
								
							?>
								
						</select>
							 </td>
							</tr>
							
							<tr><td></td><td><input type="submit" formaction="modifier_catego.php" formmethod="post" name="previse" value="visualise"></td></tr>
							
                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Nom </label></td>
							<td><input type='text' name="nom" value="<?php if(isset($_POST['previse'])){echo $dataa['nom'];}?>"></td>
							</tr>
						<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Description </label></td>
								<td><textarea type="text" name="description" ><?php if(isset($_POST['previse'])){echo $dataa['description'];}?></textarea></td></tr>
                   		
                        <tr><td></td><td><input type="submit" name="envoyer" value="modifier"></td></tr>
                        </table>
                </form>
				
</body>
	
	<?php
	if(isset($_POST['envoyer'])){
	include("connexion.php");
	
		$nom = addslashes($_POST['nom']);
		$id = addslashes($_POST['id']);
	$description = addslashes($_POST['description']);
	
	//check si le categorie deja dans base	
	$resultat = mysqli_query($link,$sql);
		$sql = "update categorie set nom='$nom',description='$description' where id_categorie ='$id'";
		$resultat = mysqli_query($link,$sql);
		if($resultat){echo "<br><div id='green'>catégorie modifier avec succes</div><br>";
		}
		else echo "erreur";
		}

	?>
</body>
</html>
