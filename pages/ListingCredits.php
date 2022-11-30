<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
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
	
		$resultat = $con->query("SELECT T.LIBELLETYPECREDIT, C.REFERENCECREDIT, CL.NOMCLIENT, D.DATEDEMANDECREDIT, C.DATEOBTENTIONCREDIT, D.MONTANTDEMANDECREDIT, C.MONTANTCREDIT
								FROM CREDIT C, DEMANDECREDIT D, TYPECREDIT T, CLIENT CL
								WHERE C.IDDEMANDECREDIT = D.IDDEMANDECREDIT
								AND D.CODETYPECREDIT = T.CODETYPECREDIT
								AND D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND (C.REFERENCECREDIT like '%$mc%' OR CL.NOMCLIENT like '%$mc%')
								ORDER BY C.REFERENCECREDIT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrCredits 
								from CREDIT 
								where REFERENCECREDIT like '%$mc%'");
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrCredits'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page de Gestion des Crédit Accordés Aux Clients de La Banque</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Crédits Accordés Aux Clients de La Banque</div>
					<div class="panel-body">
						<form method="get" action="ListeCredits.php" class="form-inline">
						<div class="form-group">														
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
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="GestionnaireCompe") {?>
									<a class="btn btn-success" href="NouveauCredit.php">Enregistrer Un Nouveau Crédit Accordé</a>&nbsp
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="Imprimer_ListeCredits.php">
					<button type="submit" id="pdf" name="ListeCredits"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Crédit Accordés Aux Clients de La Banque</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					Liste des Crédits Accordés Aux Clients de La Banque. Vous Etes à : (<?php echo $nbrPro ?>&nbspCrédit (s) Accordé (s)) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Reference</th>
									<th>Type</th>
									<th>Client</th>
									<th>Demande</th>
									<th>Obtention</th>
									<th>Montant</th>
									<th>Obtenu</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="GestionnaireCompe") {?> 
										<th>ACTIONS A EFFECTUER</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['NOMCLIENT'] ?></td>
										<td><?php echo $STAGIAIRE['DATEDEMANDECREDIT'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEOBTENTIONCREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['MONTANTDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['MONTANTCREDIT'] ?></td>
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="GestionnaireCompe") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerCredit.php?REFERENCECREDIT=<?php echo $STAGIAIRE['REFERENCECREDIT'] ?>">
													<span class="glyphicon glyphicon-pencil"></span> Editer
												</a>											
												&nbsp &nbsp
												
												<a href="ListeRemboursements.php?REFERENCECREDIT=<?php echo $STAGIAIRE['REFERENCECREDIT'] ?>">
													<span class="glyphicon glyphicon-list-alt"></span> Remboursements
												</a>
																							
											<?php } ?>
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPage;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="ListeCredits.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>