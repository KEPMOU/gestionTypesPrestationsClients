<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODETYPEPERMIS']))
		$idf=$_GET['CODETYPEPERMIS'];
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
		$resultat = $con->query("SELECT INS.IDINSCRIPTION, TP.LIBELLETYPEPERMIS, ETINS.LIBELLEETATINSCRIPTION, INS.DATEINSCRIPTION, INS.NOMCANDIDATINSCRIPTION, INS.TELCANDIDATINSCRIPTION, INS.IMAGEPHOTOCANDIDATINSCRIPTION
								FROM INSCRIPTION INS, TYPEPERMIS TP, ETATINSCRIPTION ETINS
								WHERE TP.CODETYPEPERMIS = INS.CODETYPEPERMIS
								AND INS.IDETATINSCRIPTION = ETINS.IDETATINSCRIPTION
								AND (TP.CODETYPEPERMIS like '%$mc%' OR INS.NOMCANDIDATINSCRIPTION like '%$mc%')
								ORDER BY INS.IDINSCRIPTION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrARRIV 
								from INSCRIPTION 
								where CODETYPEPERMIS like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT INS.IDINSCRIPTION, TP.LIBELLETYPEPERMIS, ETINS.IDETATINSCRIPTION, INS.DATEINSCRIPTION, INS.NOMCANDIDATINSCRIPTION, INS.TELCANDIDATINSCRIPTION, INS.IMAGEPHOTOCANDIDATINSCRIPTION
								FROM INSCRIPTION INS, TYPEPERMIS TP, ETATINSCRIPTION ETINS
								WHERE TP.CODETYPEPERMIS = INS.CODETYPEPERMIS
								AND INS.IDETATINSCRIPTION = ETINS.IDETATINSCRIPTION
								AND TP.CODETYPEPERMIS=$idf
								ORDER BY ARR.HEUREARRIVEE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrARRIV 
								from INSCRIPTION 
								where (CODETYPEPERMIS like '%$mc%')
								And CODETYPEPERMIS=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrARRIV'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from TYPEPERMIS";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Inscriptions Envoyées</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Auto3.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Gestion des Inscriptions Envoyées - Rechercher Une Inscription</div>
					<div class="panel-body">
						<form method="get" action="ListeInscription.php" class="form-inline">
						<div class="form-group">						
								<select name="CODETYPEPERMIS" id="CODETYPEPERMIS" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Liste Inscriptions Par Type de Permis</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODETYPEPERMIS']?>" 
											<?php echo $idf==$filiere['CODETYPEPERMIS']?"selected":"" ?>>
											<?php echo $filiere['LIBELLETYPEPERMIS']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Un Mot Clé SVP"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Lancer La Recherche . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Inscriptions Au Permis de Conduire (<?php echo $nbrPro ?>&nbspInscription(s) Dans Le Centre de Formation) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr> 
									<th>N° Inscription</th>
									<th>Type Permis</th>
									<th>Etat Inscription</th>
									<th>Le Candidat</th>
									<th>Son Contact</th>
									<th>Photo</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDINSCRIPTION'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPEPERMIS'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEETATINSCRIPTION'] ?></td>
										<td><?php echo $STAGIAIRE['NOMCANDIDATINSCRIPTION'] ?></td>	
										<td><?php echo $STAGIAIRE['TELCANDIDATINSCRIPTION'] ?></td>	
										<td>
											<img src="../images/<?php echo $STAGIAIRE['IMAGEPHOTOCANDIDATINSCRIPTION']?>" 
												class="img-thumbnail"  width="50" height="40" >
										</td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="ValiderInscription.php?IDINSCRIPTION=<?php echo $STAGIAIRE['IDINSCRIPTION']?>">
													<span>Traiter Inscription</span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE INSCRIPTION ?')" 
													href="SupprimerInscription.php?IDINSCRIPTION=<?php echo $STAGIAIRE['IDINSCRIPTION']?>">
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
											<input type="hidden" name="CODETYPEPERMIS" 
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
											<a href="ListeInscription.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODETYPEPERMIS=<?php echo $idf ?>
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