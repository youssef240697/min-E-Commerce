<?php
session_start();
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
	</style>
</head>

<body>
	<form action="admin.php" method="post" enctype="multipart/form-data">
                    <fieldset><h3 style=" margin:35px; text-align: center;">login administrateur</h3></fieldset>
                        <table style="margin: auto;">
                        <tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;">login</label></td>
                        <td><input type="text" name="login" required></td></tr>
						<tr><td style="padding: 15px;"><label style="display: inline-block; width: 300px;">Mot de Passe</label></td>
                        <td><input type="text" name="pass" required></td></tr>
                   
                        <tr><td></td><td><input type="submit" name="envoyer" value="login"></td></tr>
                        </table>
                </form>
				
</body>
	<?php
	if(isset($_POST['envoyer'])){
	include("connexion.php");
	$login = addslashes($_POST['login']);
	$pass = addslashes($_POST['pass']);
	$sql ="select * from user where login = '$login' and pass= '$pass'";
	$resultat = mysqli_query($link,$sql);
	if(mysqli_num_rows($resultat)){
		$data = mysqli_fetch_assoc($resultat);
		$_SESSION['nom'] = $data['nom'];
		$_SESSION['prenom'] = $data['prenom'];
		header("Location: menu.php");
	}
	else{
		echo "<div>mot de passe ou login incorrect</div>";
	}
	}
	?>
</html>
