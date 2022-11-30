<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEFOURNISSEUR']))
		$idf=$_GET['CODEFOURNISSEUR'];
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
		$resultat = $con->query("SELECT L.REFERENCELIVRAISON, M.DESIGNATIONMATERIEL, F.NOMFOURNISSEUR, L.DATELIVRAISON, L.QTELIVRAISON
								FROM LIVRAISON L, MATERIEL M, FOURNISSEUR F
								WHERE M.REFERENCEMATERIEL = L.REFERENCEMATERIEL
								AND L.CODEFOURNISSEUR = F.CODEFOURNISSEUR
								AND (L.REFERENCELIVRAISON like '%$mc%' OR M.DESIGNATIONMATERIEL like '%$mc%')
								ORDER BY L.REFERENCELIVRAISON
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPDT 
								from LIVRAISON 
								where REFERENCELIVRAISON like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT L.REFERENCELIVRAISON, M.DESIGNATIONMATERIEL, F.NOMFOURNISSEUR, L.DATELIVRAISON, L.QTELIVRAISON
								FROM LIVRAISON L, MATERIEL M, FOURNISSEUR F
								WHERE M.REFERENCEMATERIEL = L.REFERENCEMATERIEL
								AND L.CODEFOURNISSEUR = F.CODEFOURNISSEUR
								AND (L.REFERENCELIVRAISON like '%$mc%' OR M.DESIGNATIONMATERIEL like '%$mc%')
								And L.CODEFOURNISSEUR='$idf'
								ORDER BY M.REFERENCEMATERIEL
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPDT 
								from LIVRAISON 
								where (REFERENCELIVRAISON like '%$mc%')
								And CODEFOURNISSEUR='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrPDT'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="SELECT * FROM FOURNISSEUR";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion de Livraison de Matériel En Stock</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Livraison</div>
					<div class="panel-body">
						<form method="get" action="ListeLivraisonsF.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEFOURNISSEUR" id="CODEFOURNISSEUR" class="form-control"
									onChange="this.form.submit();">
									<option value="0">Afficher Par Fournisseur</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEFOURNISSEUR']?>" 
											<?php echo $idf==$filiere['CODEFOURNISSEUR']?"selected":"" ?>>
											<?php echo $filiere['NOMFOURNISSEUR']?>
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
									<a class="btn btn-success" href="NouvelleLivraisonF.php">Ajouter Une Nouvelle Livraison de Matériel</a>&nbsp
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="Imprimer_ListeLivraisons.php">
					<button type="submit" id="pdf" name="ListeLivraisons"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Livraisons Enregistrées</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste de Livraisons En Stock (<?php echo $nbrPro ?>&nbspLivraison (s) ) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Référence</th>
									<th>Le Matériel</th>
									<th>Le Fournisseur</th>
									<th>Date Livraison</th>
									<th>Qte Livraison</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS A EFFECTUER</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCELIVRAISON'] ?></td>
										<td><?php echo $STAGIAIRE['DESIGNATIONMATERIEL'] ?></td>
										<td><?php echo $STAGIAIRE['NOMFOURNISSEUR'] ?></td>
										<td><?php echo $STAGIAIRE['DATELIVRAISON'] ?></td>	
										<td><?php echo $STAGIAIRE['QTELIVRAISON'] ?></td>
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerLivraison.php?REFERENCELIVRAISON=<?php echo $STAGIAIRE['REFERENCELIVRAISON'] ?>">
													<span class="glyphicon glyphicon-pencil"></span> Editer
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE LIVRAISON ?')" 
													href="SupprimerLivraison.php?REFERENCELIVRAISON=<?php echo $STAGIAIRE['REFERENCELIVRAISON'] ?>">
													<span class="glyphicon glyphicon-trash"></span> Supprimer
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
											<input type="hidden" name="CODEFOURNISSEUR" 
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
											<a href="ListeLivraisonsF.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEFOURNISSEUR=<?php echo $idf ?>
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