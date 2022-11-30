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
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	
		$resultat = $con->query("SELECT LMS.IDLIGNEINVENTAIREMEDICAMENT, M.REFERENCEINTERNEMEDICAMENTINTEGRE, LMS.LIBELLELIGNEINVENTAIREMEDICAMENT, LMS.QTELIGNEINVENTAIREMEDICAMENT
								FROM UTILISATEUR U, PHARMACIE P, MEDICAMENTINTEGRE M, LIGNEINVENTAIREMEDICAMENT LMS
								WHERE U.ID = P.ID
								AND P.REFERENCEPHARMACIE = M.REFERENCEPHARMACIE
								AND M.REFERENCEINTERNEMEDICAMENTINTEGRE = LMS.REFERENCEINTERNEMEDICAMENTINTEGRE
								AND U.ID = $user
								ORDER BY LMS.IDLIGNEINVENTAIREMEDICAMENT
								LIMIT $size
								OFFSET $offset");
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Listing des Mouvements de Stock (Livraisons Et Ventes) de Médicaments de La Pharmacie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Listing des Mouvements de Stock (Livraisons Et Ventes) de Médicaments de La Pharmacie</div>
					<div class="panel-body">
						<p><font size="6.5em"> <font weight="10px"><center>Mouvements de Stock (Livraisons Et Ventes) de Médicaments</center></font></font></p>
					</div>
				</div>
				
				<form class="form-inline" method="post" action="#">
					<button type="submit" id="pdf" name="ListeFournisseurs"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer Les Mouvements de Stock (Livraisons Et Ventes) de Médicaments</button>
				</form><br>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Listing des Mouvements de Stock (Livraisons Et Ventes) de Médicaments 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>REFERENCE MEDICAMENT</th>
									<th>LIBELLE MOUVEMENT</th>
									<th>QUANTITE</th>									
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDLIGNEINVENTAIREMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['REFERENCEINTERNEMEDICAMENTINTEGRE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLELIGNEINVENTAIREMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['QTELIGNEINVENTAIREMEDICAMENT'] ?></td>
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