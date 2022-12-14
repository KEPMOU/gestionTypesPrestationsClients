
<?php
	require_once('connexion.php');
	
	include '../fonctions/fonctions.php'; 
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$validationErrors = array();
		
		$login = $_POST['login'];
		
		$pwd1 = $_POST['pwd1'];
		
		$pwd2 = $_POST['pwd2'];
		
		$email = $_POST['email'];

			if (isset($login)) {
				
				$filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);
				
				if (strlen($filtredLogin) < 4) {
					
					$validationErrors[] = "Erreur de validation: Le login doit contenir au moins 4 caractères";
				
				}
			}

			if (isset($pwd1) && isset($pwd2)) {
				
				if (empty($pwd1)) {
					
					$validationErrors[] = "Erreur de validation: Le mot ne doit pas être vide!";
				}

				if (md5($pwd1) !== md5($pwd2)) {
					
					$validationErrors[] = "Erreur de validation: Les deux mots de passe ne sont pas identiques";
				}
			}

			if (isset($email)) {
				
				$filtredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
				
				if (filter_var($filtredEmail, FILTER_VALIDATE_EMAIL) != true) {
					
					$validationErrors[] = "Erreur de validation: Email non valid";
					
				}
			}
		

		if (empty($validationErrors)) {
			
			if (findUserByLogin($login) == 0 && findUserByEmail($email) == 0) {
				
				$stmt = $con->prepare('INSERT INTO UTILISATEUR(login, pwd,role, email,etat)
										VALUES (:pLogin,:pPwd,:pRole, :pEmail,:pEtat)');
										
				$stmt->execute(array(
				
						'pLogin' 	=> $login,
						'pPwd' 		=> md5($pwd1),
						'pRole'		=>'VISITEUR',
						'pEmail' 	=> $email,
						'pEtat'		=>0)
				);
				
				$succesMsg = "Félicitation , vous avez créer votre nouveau compte";
				
			} else if(findUserByLogin($login) >0){

				$validationErrors[] = 'Désolé ce login existe déja';
				
			}else if(findUserByEmail($email) >0){

				$validationErrors[] = 'Désolé cet Email existe déja';
			}

		}
	}
	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title>Ajouter Un Compte Utilisateur</title>
		
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
		
		<script src="../js/jquery-3.3.1.js"></script>
		
		<script src="../js/myjs.js"></script>
		
	</head>
	<body background="Img20.JPG">		
		 
		<div class="container user-page">
			<h1 class="text-center">
        		Compte Utilisateur Pour Votre Pharmacie
    		</h1><hr>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">			
										
				<div class="input-container">
					<input
							pattern=".{4,}"
							title="Le Login doit Contenir Au Moins 4 Caractères"
							class="form-control"
							type="text"
							name="login"
							autocomplete="off"
							placeholder="Taper Votre Login"
							required="required">
				</div>
				<div class="input-container">
					<input
							minlength=4
							class="form-control"
							type="password"
							name="pwd1"
							autocomplete="new-password"
							placeholder="Taper Votre Mot de Passe"
							required>
				</div>
				<div class="input-container">
					<input
							minlength=4
							class="form-control"
							type="password"
							name="pwd2"
							autocomplete="new-password"
							placeholder="Retaper Votre Mot de Passe Pour Le Confirmer"
							required>
				</div>
				<div class="input-container">
					<input
							class="form-control"
							type="email"
							name="email"
							placeholder="Taper Votre Adresse Email"
							required>
				</div><hr>
				
				<input
						class="btn btn-primary btn-lg btn-block"
						type="submit"
						value="Valider La Création du Compte Pharmacie">
						<a class="btn btn-danger btn-lg btn-block" href="login.php">Annuler - Revenir Sur La Page de Login</a></form>
			</form>
			
			 <div class="the-errors text-center">
			 
				<?php
				
					if (isset($validationErrors) && !empty($validationErrors)) {
					    
						foreach ($validationErrors as $error) {
						    
							echo '<div class="msg error">' . $error . '</div>';
							
						}
					}

					if (!empty($succesMsg)) {
						
						echo '<div class="msg succes">' . $succesMsg . '</div>';

						header("refresh:3;url=login.php");
						
						exit();
					}

				
				?>
				
			</div>
							
		</div>		
			
	</body>

</html>



