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
	<form action="ajouter_produit.php" method="post" enctype="multipart/form-data">
                    <fieldset><h3 style=" margin:35px; text-align: center;">ajout d'un produit</h3></fieldset>
                        <table style="margin: auto;">
                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Désignation </label></td>
							<td><textarea type="text" name="designation" required ></textarea></td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> quantité en stock </label></td>
                        <td><input type="number" name="quantite_stock" min="0" required ></td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> prix </label></td>
                        <td><input type="number" name="prix" required></td></tr>
						<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Catégorie </label></td>
							<td><select name="categorie" size="1">
							<?php
							
								include("connexion.php");
								$sql = "select id_categorie,nom from categorie";
								$resultat = mysqli_query($link,$sql);
								while($data = mysqli_fetch_assoc($resultat)){
									
									echo "<option value = '".$data['id_categorie']."'>".$data['nom']."</option>";
								}
								
								
								
							?>
								
						</select>
							 </td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;">Photo</label></td>
                        <td><input type="file" name="photo" required></td></tr>
                   		
                        <tr><td></td><td><input type="submit" name="envoyer" value="ajouter"></td></tr>
                        </table>
                </form>
				
</body>

	<?php
	if(isset($_POST['envoyer'])){
	include("connexion.php");
	$designation = addslashes($_POST['designation']);
	$quantite_stock = addslashes($_POST['quantite_stock']);
	$prix = addslashes($_POST['prix']);
	$categorie = addslashes($_POST['categorie']);
	//image	
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["photo"]["tmp_name"]);
    	if($check !== false) {
			echo "<br>fichier est une image - " . $check["mime"] . ".<br>";
			$uploadOk = 1;
		} else {
			echo "<br>fichier n'est pas une image.<br>";
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "<br>fichier exite deja<br>";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["photo"]["size"] > 500000) {
			echo "<br>fichier volumineux<br>";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		   && $imageFileType != "gif" ) {
			echo "<br>seul JPG, JPEG, PNG & GIF acceptables.<br>";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<br>votre fichier n a pas été uploadé<br>.";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
			} else {
        echo "<br>une erreur lors de l'upload de l'image<br>.";
			}
		
		}
		
		
	//check si le produit deja dans base	
	$sql ="select * from produit where designation = '$designation' and quantite_stock= '$quantite_stock' and prix = '$prix' and categorie='$categorie' and photo ='".$_FILES['photo']['name']."'";	
	$resultat = mysqli_query($link,$sql);
	if(mysqli_num_rows($resultat) == 0){
		$sql = "insert into produit(designation,quantite_stock,prix,categorie,photo) VALUES('$designation','$quantite_stock','$prix','$categorie','".basename($_FILES["photo"]["name"])."')";
		$resultat = mysqli_query($link,$sql);
		if($resultat) echo "<br><div id='green'>produit ajouter avec succes</div><br>";
		}
	else{
			echo "<br><div>produit deja dans la base</div>";
		}
		}

	?>
</html>
