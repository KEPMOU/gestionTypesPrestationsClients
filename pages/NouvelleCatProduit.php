<?php
	require_once('session.php');
	
	require_once('connexion.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Une Nouvelle Catégorie de Produit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">	
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Une Nouvelle Catégorie de Produit</div>
				<div class="panel-body">
					<form method="post" action="InserCatProduit.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODECATEGORIEPRODUIT" class="control-label">CODE DE LA CATEGORIE DU PRODUIT</label>
							<input type="text" name="CODECATEGORIEPRODUIT" id="CODECATEGORIEPRODUIT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLECATEGORIEPRODUIT" class="control-label">LIBELLE DE LA CATEGORIE DU PRODUIT</label>
							<input type="text" name="LIBELLECATEGORIEPRODUIT" id="LIBELLECATEGORIEPRODUIT" class="form-control"/>
						</div>
					
												
						<button type="submit" class="btn btn-primary">VALIDER NOUVELLE CATEGORIE</button>
						<a class="btn btn-warning" href="ListeCatProduit.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>