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
	<body background="Img18.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Une Nouvelle Catégorie de Produit</div>
				<div class="panel-body">
					<form method="post" action="InsertCategorie.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="LIBELLECATEGORIE" class="control-label">LIBELLE DE LA CATEGORIE DU PRODUIT</label>
							<input type="text" name="LIBELLECATEGORIE" id="LIBELLECATEGORIE" class="form-control"/>
						</div>
					
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeCategories.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>