<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
		$resultat = $con->query("SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE
								FROM UTILISATEUR U, PHARMACIE P, QUARTIER Q
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND P.ID = U.ID
								AND U.ID = $user");

		
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer Les Informations Sur Ma Pharmacie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Editer Les Informations Sur Ma Pharmacie</div>
					<div class="panel-body">
						<p><font size="10.5em"> <font weight="10px"><center>Editer Les Informations Sur Ma Pharmacie</center></font></font></p><hr>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Editer Les Informations Sur Ma Pharmacie
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Ref.</th>
									<th>Quartier</th>
									<th>Pharmacie</th>
									<th>Contacts</th>
									<th>Ouverture</th>
									<th>Fermeture</th>
									
									<?php if($_SESSION['utilisateur']['ROLE']=="AdminPharm") {?> 
										<th>Actions</th>
									<?php } ?>
									
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMQUARTIER'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['CONTACTSPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREOUVRTUREPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREFERMETUREPHARMACIE'] ?></td>
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="AdminPharm") {?>
												<!--  Action Editer un stagiaire -->
												
												<a class="btn btn-success btn-sm" href="EditerMaPharmacie.php?REFERENCEPHARMACIE=<?php echo $STAGIAIRE['REFERENCEPHARMACIE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span> Editer
												</a>									
											<?php } ?>
											
										</td>
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