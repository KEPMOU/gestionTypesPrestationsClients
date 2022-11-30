<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['MATRICULEAGENT']))
		$idf=$_GET['MATRICULEAGENT'];
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
	
	if($idf=="ALL"){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT COL.IDCOLLECTE, AG.MATRICULEAGENT, AG.NOMAGENT, AG.TELAGENT, COL.DATECOLLECTE, VIL.NOMVILLE, PO.NOMUSERPOSTECOLLECTE, PO.VERSIONOSPOSTECOLLECTE, PO.ETATDOMAINEPOSTECOLLECTE
								FROM AGENT AG, COLLECTE COL, VILLE VIL, POSTECOLLECTE PO
								WHERE COL.MATRICULEAGENT = AG.MATRICULEAGENT
								AND   COL.CODEVILLE = VIL.CODEVILLE
								AND	  COL.IDPOSTECOLLECTE = PO.IDPOSTECOLLECTE
								AND (VIL.NOMVILLE like '%$mc%' OR PO.NOMUSERPOSTECOLLECTE like '%$mc%')
								ORDER BY COL.DATECOLLECTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrCOLLECTE 
								from COLLECTE 
								where MATRICULEAGENT like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT AG.NOMAGENT, AG.TELAGENT, COL.DATECOLLECTE, VIL.NOMVILLE, PO.NOMUSERPOSTECOLLECTE, PO.VERSIONOSPOSTECOLLECTE, PO.ETATDOMAINEPOSTECOLLECTE, PO.NOMUSERPOSTECOLLECTE
								FROM AGENT AG, COLLECTE COL, VILLE VIL, POSTECOLLECTE PO
								WHERE COL.MATRICULEAGENT = AG.MATRICULEAGENT
								AND   COL.CODEVILLE = AG.CODEVILLE
								AND	  COL.IDPOSTECOLLECTE = PO.IDPOSTECOLLECTE
								AND (VIL.NOMVILLE like '%$mc%' OR PO.NOMUSERPOSTECOLLECTE like '%$mc%')
								And AG.NOMAGENT=$idf
								ORDER BY COL.DATECOLLECTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrCOLLECTE 
								from ARRIVEE 
								where (MATRICULEENSEIGNANT like '%$mc%')
								And DATEARRIVEE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrCOLLECTE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from AGENT";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Collectes d'Informations</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="logoelvire.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Collecte d'Informations</div>
					<div class="panel-body">
						<form method="get" action="ListingCollecte.php" class="form-inline">
						<div class="form-group">						
								<select name="MATRICULEAGENT" id="MATRICULEAGENT" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Choix de L'Agent de Collecte</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['MATRICULEAGENT']?>" 
											<?php echo $idf==$filiere['MATRICULEAGENT']?"selected":"" ?>>
											<?php echo $filiere['NOMAGENT']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Indiquer Nom Agent"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Rechercher . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="NouvelleInfos.php">Nouvelle Collecte</a>
									<a class="btn btn-success" href="#">Formulaire Agent</a>
									<a class="btn btn-success" href="#">Formulaire Poste</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Collectes d'Informations (<?php echo $nbrPro ?>&nbspCollecte(s)) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>MAT. AGT</th>
									<th>NOM AGENT</th>
									<th>TELEPHONE</th>
									<th>DATE COLLECTE</th>
									<th>VILLE</th>
									<th>NOM UTILISATEUR</th>
									<th>VERSION OS</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDCOLLECTE'] ?></td>
										<td><?php echo $STAGIAIRE['MATRICULEAGENT'] ?></td>
										<td><?php echo $STAGIAIRE['NOMAGENT'] ?></td>
										<td><?php echo $STAGIAIRE['TELAGENT'] ?></td>	
										<td><?php echo $STAGIAIRE['DATECOLLECTE'] ?></td>		
										<td><?php echo $STAGIAIRE['NOMVILLE'] ?></td>		
										<td><?php echo $STAGIAIRE['NOMUSERPOSTECOLLECTE'] ?></td>		
										<td><?php echo $STAGIAIRE['VERSIONOSPOSTECOLLECTE'] ?></td>		
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerPresence.php?IDCOLLECTE=<?php echo $STAGIAIRE['IDCOLLECTE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE COLLECTE?')" 
													href="SupprimerPresence.php?IDCOLLECTE=<?php echo $STAGIAIRE['IDCOLLECTE'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
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
											<input type="hidden" name="MATRICULEAGENT" 
												value="<?php echo $idf ?>">
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
											<a href="Inscriptions.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&MATRICULEAGENT=<?php echo $idf ?>
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