<?php
	require_once('session.php');
?>
<?php
	require_once('connexion.php');							
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>PlateForme de Gestion Et Suivi des Prestations</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>	
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>		
			<br><br>
<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Tableau de Bord de La Solution Web<br><br></h1><br>
    <div class="row">
	
        <div class="col-md-4">
            <button type="submit" class="btn btn-success btn-lg btn-block">Types de Prestations</button>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-danger btn-lg btn-block">Les Clients de L'Entreprise</button>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-warning btn-lg btn-block">Les Prestations de L'Entreprise</button>
        </div>
		
    </div>
	
	<hr>
	
	<div class="row">
	
        <div class="col-md-4">
            <button type="submit" class="btn btn-info btn-lg btn-block">Les Règlements des Prestations</button>
        </div>
		
    </div>
	
	<h1 class="text-center text-danger">Profil En Ligne : <?php if($_SESSION['utilisateur']['ROLE']=="Administrateur")
							
									echo $_SESSION['utilisateur']['ROLE']; ;
	
						?>
	</h1>
	
</div>
	</body>
</html>