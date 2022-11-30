<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODETYPECOMPTE']))
		$idf=$_GET['CODETYPECOMPTE'];
	else
		$idf="ALL";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($idf==0){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT TC.LIBELLETYPECOMPTE, C.NUMEROCOMPTE, G.NOMGESTIONNAIRE, CL.NOMCLIENT, C.SOLDEDEPARTCOMPTE, C.SOLDEACTUELLECOMPTE
								FROM TYPECOMPTE TC, COMPTE C, GESTIONNAIRE G, CLIENT CL, UTILISATEUR U
								WHERE TC.CODETYPECOMPTE = C.CODETYPECOMPTE
								AND C.MATRICULEGESTIONNAIRE = G.MATRICULEGESTIONNAIRE
								AND C.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND (C.NUMEROCOMPTE like '%$mc%')
								ORDER BY C.NUMEROCOMPTE
								LIMIT $size
								OFFSET $offset");

	}
	
	$requetef="SELECT * FROM TYPECOMPTE";
	$resultatf = $con->query($requetef);
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Listing de Mes Comptes Bancaires</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Les Informations Sur Un Compte</div>
					<div class="panel-body">
						<form method="get" action="MesComptes.php" class="form-inline">
						<div class="form-group">						
								<select name="CODETYPECOMPTE" id="CODETYPECOMPTE" class="form-control"
									onChange="this.form.submit();">
									<option value="0">Afficher Mes Comptes Par Type</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODETYPECOMPTE']?>" 
											<?php echo $idf==$filiere['CODETYPECOMPTE']?"selected":"" ?>>
											<?php echo $filiere['LIBELLETYPECOMPTE']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Un Mot Clé"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Rechercher . . .
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste de Mes Différents Comptes A La CCA BANK
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Numéri du Compte</th>
									<th>Type de Compte</th>
									<th>Le Gestionnaire</th>
									<th>Solde de Départ</th>
									<th>Solde Actuelle</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['NUMEROCOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPECOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMGESTIONNAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['SOLDEDEPARTCOMPTE'] ?></td>	
										<td><?php echo $STAGIAIRE['SOLDEACTUELLECOMPTE'] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>