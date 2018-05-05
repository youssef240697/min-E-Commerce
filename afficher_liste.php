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
				<title></title>
	<style>
		table,tr,td{
			border: 1px solid;
			border-color: cornflowerblue;
			border-collapse: collapse;
		}
		table{
			margin: 0px auto;
		}
		#head{
			font-size: 20px;
			font-weight: bold;
			background-color: cornflowerblue;
			
		}
		td{
			padding: 20px;
			text-align: center;
			font-size: 20px;
		}
	
	
	</style>
</head>

<body>
				<?php
	include("connexion.php");
	$sql = "select * from categorie";
	$resultat = mysqli_query($link,$sql);
	echo "<table>";
	echo "<tr id='head'>";
	echo "<td>id categorie : </td>";
	echo "<td>Nom : </td>";
	echo "<td>description : </td>";
	while($data=mysqli_fetch_assoc($resultat)){
		echo "<tr>";
		echo "<td>".$data['id_categorie']."</td>";
		echo "<td>".$data['nom']."</td>";
		echo "<td>".$data['description']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	?>
</body>
</html>
