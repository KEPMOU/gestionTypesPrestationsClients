<?php
	require_once('session.php');
	if(isset($_SESSION['erreurEmailExiste'])){
		$erreurEmailExiste=$_SESSION['erreurEmailExiste'];
		$_SESSION['erreurEmailExiste']="";
	}else{
		$erreurEmailExiste="";
		
	}
?>
<?php
	
	$id=$_GET['id'];
	require_once('connexion.php');
	$requete="select * from utilisateur where id=$id";
	$resultat = $con->query($requete);
	$user=$resultat->fetch();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Edition du Profil Utilisateur</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/MonStyle.css">
	</head>
	<body background="Auto3.JPG">		
		<div class="container col-lg-4 col-md-offset-4">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Edition du Profil Utilisateur</div>
				<div class="panel-body">
					<form method="post" action="updateUtilisateur.php" class="form">
					
						<div class="form-group">
							<label for="id" class="control-label" >
								Utilisateur Numéro ID = <?php echo $user['ID']; ?>
							</label>
							<input type="hidden" name="ID" 
									id="ID" class="form-control" 
									value="<?php echo $user['ID']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LOGIN" class="control-label">Mon Login</label>
							<input type="text" name="LOGIN" id="LOGIN" class="form-control"
									value="<?php echo $user['LOGIN']; ?>" readonly="readonly"/>
						</div>
						<div class="form-group">
							<label for="EMAIL" class="control-label">Mon Adresse Email (Peut Modifier)</label>
							<input type="text" name="EMAIL" id="EMAIL" class="form-control"
									value="<?php echo $user['EMAIL']; ?>"/>
						</div>
						<?php
								if($erreurEmailExiste!=""){?>			
									<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<?php echo $erreurEmailExiste ?>
									</div>			
						<?php 	}	?>	
						
							<!---- **************************  -->
						<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
							
							<div class="form-group">
								<label for="ROLE" class="control-label">Role</label>
								<select name="ROLE" id="ROLE" class="form-control">
										<option value="ADMIN" 
											<?php echo $user['ROLE']=="ADMIN"?"selected":"" ?>>									
											ADMIN
										</option>	
										<option value="VISITEUR" 
											<?php echo $user['ROLE']=="VISITEUR"?"selected":"" ?>>									
											VISITEUR
										</option>										

								</select>
							</div>
						<?php } ?>
					<!---- **************************  -->
												
						<input type="submit" class="btn btn-primary" value="Valider Modifications du Profil"/>
							&nbsp &nbsp	&nbsp &nbsp
						<a href="editPwd.php">Changer Votre Mot de Passe</a><hr>
						<a class="btn btn-warning" href="accueil.php">Annuler - Retour Accueil</a></form>						
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



