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
		$reference = addslashes($_POST['reference']);
		include("connexion.php");
		$sql = "select * from produit where reference = '$reference'";
		$resultat = mysqli_query($link,$sql);
		$dataa = mysqli_fetch_assoc($resultat);
		$_SESSION['reference'] = $reference;

	}
	?>

<body>
				<form action="modif_produit.php" method="post" enctype="multipart/form-data">
                    <fieldset><h3 style=" margin:35px; text-align: center;">modifier  produit </h3></fieldset>
                        <table style="margin: auto;">
                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> reference </label></td>
							<td><select name="reference" size="1">
							<?php
								include("connexion.php");
								$sql = "select reference from produit";
								$resultat = mysqli_query($link,$sql);
								while($data = mysqli_fetch_assoc($resultat)){
									echo "<option value='".$data['reference']."'";
									if(isset($_SESSION['reference'])){
									if($data['reference'] == $_SESSION['reference']){
										echo "selected";
									}}
									echo ">".$data['reference']."</option>";
								
								}
							?>
								</select></td></tr>
							<tr><td></td><td><input type="submit" formaction="modif_produit.php" formmethod="post" name="previse" value="visualise"></td></tr>

                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Désignation </label></td>
							<td><textarea type="text" name="designation" ><?php if(isset($_POST['previse'])) echo $dataa['designation'];?></textarea></td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> quantité en stock </label></td>
                        <td><input type="number" name="quantite_stock" min="0" value="<?php if(isset($_POST['previse'])) echo $dataa['quantite_stock'];?>"></td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> prix </label></td>
                        <td><input type="number" name="prix" value="<?php if(isset($_POST['previse'])) echo $dataa['prix'];?>" ></td></tr>
						<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;"> Catégorie </label></td>
							<td><select name="categorie" size="1">
							<?php
							
								include("connexion.php");
								$sql = "select id_categorie,nom from categorie";
								$resultat = mysqli_query($link,$sql);
								while($data = mysqli_fetch_assoc($resultat)){
									
									echo "<option value = '".$data['id_categorie']."'";
									if(isset($_POST['previse'])){
									if($data['id_categorie'] == $dataa['categorie']){
										echo "selected";
									}
									}
									echo ">".$data['nom']."</option>";
								}
								
								
							?>
								
						</select>
							 </td></tr>
							<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;">Photo</label></td>
                        <td><input type="file" name="photo"></td></tr>
                   		
                        <tr><td></td><td><input type="submit" name="envoyer" value="modifier"></td></tr>
                        </table>
                </form>
				<?php
	if(isset($_POST['envoyer'])){
	include("connexion.php");
	$designation = addslashes($_POST['designation']);
	$quantite_stock = addslashes($_POST['quantite_stock']);
	$prix = addslashes($_POST['prix']);
	$categorie = addslashes($_POST['categorie']);
	$reference = addslashes($_POST['reference']);
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
		$sql = "update produit set designation ='$designation',quantite_stock='$quantite_stock',prix='$prix',categorie='$categorie',photo='".basename($_FILES["photo"]["name"])."' where reference = '$reference'";
		$resultat = mysqli_query($link,$sql);
		if($resultat) echo "<br><div id='green'>produit modifier avec succes</div><br>";
		else{
			echo "<br><div>erreur lors de la modification</div>";
		}
		}

	?>
</body>
</html>
