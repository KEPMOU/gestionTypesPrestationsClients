<?php
	
	if (version_compare(phpversion(), '5.4.0', '<')) {
		 if(session_id() == '') {
			session_start();
		 }
	 }
	 else
	 {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	 }
	if(isset($_SESSION['erreurLogin'])){
		$erreurLogin=$_SESSION['erreurLogin'];
		//$_SESSION['erreurLogin']="";
	}else{
		$erreurLogin="";
	}
	session_destroy();
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>PlateForme de Gestion Et Suivi des Prestations</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<body>		
		<div class="container"><br><br>
			<center><h1><div class="text-danger">Gestion Et Suivi des Types Et Prestations</div></h1></center>
			<div class="panel panel-primary espace60">
			
				<div class="panel-heading">PlateForme de Gestion Et Suivi des Prestations - Page Login</div>
				<div class="panel-body">
					<form method="post" action="seConnecter.php" class="form">
						<?php
								if($erreurLogin!=""){?>			
									<div class="alert alert-primary alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<?php echo $erreurLogin ?>
									</div>			
						<?php 	}	?>
						
						<div class="form-group">
							<label for="LOGIN" class="control-label">Votre Login Profil Compte Utilisateur</label>
							<input type="text" name="LOGIN" id="LOGIN" placeholder = "Votre Login Profil Compte Pharmacie" class="form-control"/>
						</div><hr>
						
						<div class="form-group">
							<label for="PWD" class="control-label">Le Mot de Passe du Compte Utilisateur</label>
							<input type="password" name="PWD" id="PWD" placeholder = "Le Mot de Passe du Compte Utilisateur" class="form-control"/>
						</div><hr>
							
						<button type="submit" class="btn btn-primary btn-lg btn-block">Lancer La Page Tableau de BORD de La Solution Web</button><hr>
						
						<a class="btn btn-primary btn-lg" href="InitialiserPwd.php">Mot de Passe Oublié ?</a>
						
					</form>
				</div>
			</div>			
		</div>
	</body>
</html>