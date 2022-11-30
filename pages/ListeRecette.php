<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEMODEPAIEMENT']))
		$idf=$_GET['CODEMODEPAIEMENT'];
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
		$resultat = $con->query("SELECT REC.IDRECETTE, MP.LIBELLEMODEPAIEMENT, P.DESIGNATIONPRODUIT, REC.DATERECETTE, REC.HEUREENREGRECETTE, REC.QTERECETTE
								FROM recette REC, MODEPAIEMENT MP, PRODUIT P
								WHERE MP.CODEMODEPAIEMENT = REC.CODEMODEPAIEMENT
								AND REC.REFERENCEPRODUIT = P.REFERENCEPRODUIT
								AND (REC.IDRECETTE like '%$mc%' OR P.DESIGNATIONPRODUIT like '%$mc%')
								ORDER BY REC.IDRECETTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrREC
								from RECETTE 
								where IDRECETTE like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT REC.IDRECETTE, MP.LIBELLEMODEPAIEMENT, P.DESIGNATIONPRODUIT, REC.DATERECETTE, REC.HEUREENREGRECETTE, REC.QTERECETTE
								FROM recette REC, MODEPAIEMENT MP, PRODUIT P
								WHERE MP.CODEMODEPAIEMENT = REC.CODEMODEPAIEMENT
								AND REC.REFERENCEPRODUIT = P.REFERENCEPRODUIT
								AND (REC.IDRECETTE like '%$mc%' OR P.DESIGNATIONPRODUIT like '%$mc%')
								And MP.CODEMODEPAIEMENT='$idf'
								ORDER BY REC.IDRECETTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrREC 
								from RECETTE 
								where (IDRECETTE like '%$mc%')
								And CODEMODEPAIEMENT='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrREC'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from MODEPAIEMENT";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Recettes Journalières</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Recette Journalière</div>
					<div class="panel-body">
						<form method="get" action="ListeRecette.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEMODEPAIEMENT" id="CODEMODEPAIEMENT" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Par Mode de Paiement</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEMODEPAIEMENT']?>" 
											<?php echo $idf==$filiere['CODEMODEPAIEMENT']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEMODEPAIEMENT']?>
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
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="NouvelleRecette.php">Nouvelle Recette Journalière</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Recettes Journalières (<?php echo $nbrPro ?>&nbspRecette(s) Journalières) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID Recette</th>
									<th>Paiement</th>
									<th>Le Produit</th>
									<th>Date de La Recette</th>
									<th>Heure de La Recette</th>
									<th>Quantité de La Recette</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDRECETTE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEMODEPAIEMENT'] ?></td>
										<td><?php echo $STAGIAIRE['DESIGNATIONPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['DATERECETTE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREENREGRECETTE'] ?></td>		
										<td><?php echo $STAGIAIRE['QTERECETTE'] ?></td>		
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerRecette.php?IDRECETTE=<?php echo $STAGIAIRE['IDRECETTE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												&nbsp &nbsp
												<a href="ImprimerRecette.php?IDRECETTE=<?php echo $STAGIAIRE['IDRECETTE'] ?>">
													<span class="glyphicon glyphicon-print"></span>
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
											<input type="hidden" name="CODEMODEPAIEMENT" 
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
											<a href="ListeRecette.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEMODEPAIEMENT=<?php echo $idf ?>
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