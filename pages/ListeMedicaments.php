<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEFAMILLEMEDICAMENT']))
		$idf=$_GET['CODEFAMILLEMEDICAMENT'];
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
		$resultat = $con->query("SELECT M.REFERENCEMEDICAMENT, FA.LIBELLEFAMILLEMEDICAMENT, FO.LIBELLEFORMEMEDICAMENT, M.LIBELLEMEDICAMENT, M.PRIXVENTEMEDICAMENT
								FROM FAMILLEMEDICAMENT FA, MEDICAMENT M, FORMEMEDICAMENT FO
								WHERE FA.CODEFAMILLEMEDICAMENT = M.CODEFAMILLEMEDICAMENT
								AND M.CODEFORMEMEDICAMENT = FO.CODEFORMEMEDICAMENT
								AND (M.REFERENCEMEDICAMENT LIKE '%$mc%' OR M.LIBELLEMEDICAMENT LIKE '%$mc%')
								ORDER BY M.REFERENCEMEDICAMENT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrMED
								FROM MEDICAMENT 
								WHERE REFERENCEMEDICAMENT LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT M.REFERENCEMEDICAMENT, FA.LIBELLEFAMILLEMEDICAMENT, FO.LIBELLEFORMEMEDICAMENT, M.LIBELLEMEDICAMENT, M.PRIXVENTEMEDICAMENT
								FROM FAMILLEMEDICAMENT FA, MEDICAMENT M, FORMEMEDICAMENT FO
								WHERE FA.CODEFAMILLEMEDICAMENT = M.CODEFAMILLEMEDICAMENT
								AND M.CODEFORMEMEDICAMENT = FO.CODEFORMEMEDICAMENT
								AND (M.REFERENCEMEDICAMENT LIKE '%$mc%' OR M.LIBELLEMEDICAMENT LIKE '%$mc%')
								AND M.CODEFAMILLEMEDICAMENT='$idf'
								ORDER BY M.REFERENCEMEDICAMENT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrMED 
								FROM MEDICAMENT 
								WHERE (REFERENCEMEDICAMENT LIKE '%$mc%')
								AND CODEFAMILLEMEDICAMENT='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrMED'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="SELECT * FROM FAMILLEMEDICAMENT";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Listing des Médicaments A L'Echelle Nationnale</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Listing des Médicaments A L'Echelle Nationnale</div>
					<div class="panel-body">
						<form method="get" action="ListeMedicaments.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEFAMILLEMEDICAMENT" id="CODEFAMILLEMEDICAMENT" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Les Médicaments Par Familles</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEFAMILLEMEDICAMENT']?>" 
											<?php echo $idf==$filiere['CODEFAMILLEMEDICAMENT']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEFAMILLEMEDICAMENT']?>
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
				
				<form class="form-inline" method="post" action="Imprimer_ListeMedicaments.php">
					<button type="submit" id="pdf" name="ListeMedicaments"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Médicaments Enregistrées dans La Base de Données</button>
				</form><br>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Médicaments A L'Echelle Nationnale (<?php echo $nbrPro ?>&nbspMédicaments A L'Echelle Nationnale) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>REFERENCE</th>
									<th>FAMILLE</th>
									<th>FORME</th>
									<th>LIBELLE MEDICAMENT</th>
									<th>PRIX VENTE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEFAMILLEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEFORMEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEMEDICAMENT'] ?></td>	
										<td><?php echo $STAGIAIRE['PRIXVENTEMEDICAMENT'] ?></td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
												<!--  Action Editer un stagiaire -->
												<a class="btn btn-success btn-sm" href="EditerMedicament.php?REFERENCEMEDICAMENT=<?php echo $STAGIAIRE['REFERENCEMEDICAMENT'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a class="btn btn-danger btn-sm" Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CE MEDICAMENT ?')" 
													href="SupprimerMedicament.php?REFERENCEMEDICAMENT=<?php echo $STAGIAIRE['REFERENCEMEDICAMENT'] ?>">
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
											<input type="hidden" name="CODEFAMILLEMEDICAMENT" 
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
											<a href="ListeMedicaments.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEFAMILLEMEDICAMENT=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>

				<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
									<a class="btn btn-success btn-lg btn-block" href="NouveauMedicament.php">Ajouter Un Nouveau Médicament dans La Base de Données</a>
								<?php } ?>	
				
			</div>
		</div>
	</body>
</html>