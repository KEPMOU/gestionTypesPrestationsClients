<?php
    require_once ('connexion.php');
    
    $erreur="";
    
    $msg="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']))
        
        $email = $_POST['email'];
    
    else
        
        $email = "";

    $requete1 = "select * from utilisateur where EMAIL='$email'";
    
    $resultat1 = $con->query($requete1);

    if ($user = $resultat1->fetch()) {
        $id = $user['ID'];
        $pwd = "0000";
        $requete = "update utilisateur set pwd=MD5(?) where id=?";
        $param = array($pwd,$id);
        $resultat = $con->prepare($requete);
        $resultat->execute($param);

        $to = $user['EMAIL'];
        
        $subject = "INITIALISATION DE MOT DE PASSE (Poste HP)";
        
        $txt = "Votre nouveau mot de passe de gesStag est :$pwd";
        
        $headers = "From: GesStag" . "\r\n" . "CC: lahcenabousalih@gmail.com";
        
        mail($to, $subject, $txt, $headers);

        $erreur = "non";
        
        $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";
    
    } else {
        $erreur = "oui";
        
        $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        
    }
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Formulaire Mot de Passe Oublié  - Initiliser Votre Mot de Passe</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">

</head>
<body>
	<div class="container col-md-6 col-md-offset-3"><br><br><br><br><br>
		<div class="panel panel-primary ">
			<div class="panel-heading">Formulaire Mot de Passe Oublié  - Initiliser Votre Mot de Passe</div>
			<div class="panel-body">

				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form">

					<div class="form-group">
						<label for="email" class="control-label">
							Veuillez Saisir Votre
							Email de Récuperation
						</label>
						
						 <input 
						 	type="email" 
						 	name="email"
							id="email" 
							class="form-control" />

					</div>

					<button 
						type="submit" 
						class="btn btn-primary btn-lg btn-block">
							Initialiser Le Mot de Passe
					</button>
					<br>
					<a class="btn btn-danger btn-lg btn-block" href="login.php">Annuler - Revenir Sur La Page de Login</a></form>

				</form>

				
			</div>
			
		</div>
		
		<div class="the-errors text-center">
			 
        			<?php

                        if ($erreur == "oui") {
            
                            echo '<div class="msg error">' . $msg . '</div>';
            
                            header("refresh:3;url=initialiserPwd.php");
            
                            exit();
                        } 
                        else if($erreur == "non")  {
            
                            echo '<div class="msg succes">' . $msg . '</div>';
            
                            header("refresh:3;url=login.php");
            
                            exit();
                        }
    
                    ?>
				
				</div>
	</div>

</body>
</html>



