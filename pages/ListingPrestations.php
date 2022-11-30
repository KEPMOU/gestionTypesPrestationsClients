<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODETYPEPRESTATION']))
		$idf=$_GET['CODETYPEPRESTATION'];
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
		$resultat = $con->query("SELECT PRES.CODEPRESTATION, CLT.NOMCLIENT, TP.LIBELLETYPEPRESTATION, EP.LIBELLEETATPRESTATION, PRES.LIBELLEPRESTATION, PRES.MONTANTCOUTPRESTATION
								FROM CLIENT CLT, PRESTATION PRES, TYPEPRESTATION TP, ETATPRESTATION EP
								WHERE CLT.CODECLIENT = PRES.CODECLIENT
								AND PRES.CODETYPEPRESTATION = TP.CODETYPEPRESTATION
								AND PRES.IDETATPRESTATION = EP.IDETATPRESTATION
								AND (PRES.CODEPRESTATION LIKE '%$mc%' OR PRES.LIBELLEPRESTATION LIKE '%$mc%')
								ORDER BY PRES.CODEPRESTATION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrMED
								FROM PRESTATION 
								WHERE CODEPRESTATION LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT PRES.CODEPRESTATION, CLT.NOMCLIENT, TP.LIBELLETYPEPRESTATION, EP.LIBELLEETATPRESTATION, PRES.LIBELLEPRESTATION, PRES.MONTANTCOUTPRESTATION
								FROM CLIENT CLT, PRESTATION PRES, TYPEPRESTATION TP, ETATPRESTATION EP
								WHERE CLT.CODECLIENT = PRES.CODECLIENT
								AND PRES.CODETYPEPRESTATION = TP.CODETYPEPRESTATION
								AND PRES.IDETATPRESTATION = EP.IDETATPRESTATION
								AND (PRES.CODEPRESTATION LIKE '%$mc%' OR PRES.LIBELLEPRESTATION LIKE '%$mc%')
								AND PRES.CODETYPEPRESTATION = '$idf'
								ORDER BY PRES.CODEPRESTATION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrMED 
								FROM PRESTATION 
								WHERE (CODEPRESTATION LIKE '%$mc%')
								AND CODETYPEPRESTATION = '$idf'");
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
										
	$requetef="SELECT * FROM TYPEPRESTATION";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Listing des Prestations de Service des Clients</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Listing des Prestations de Service des Clients</div>
					<div class="panel-body">
						<form method="get" action="ListingPrestations.php" class="form-inline">
						<div class="form-group">						
								<select name="CODETYPEPRESTATION" id="CODETYPEPRESTATION" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Les Prestations Par Types</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODETYPEPRESTATION']?>" 
											<?php echo $idf==$filiere['CODETYPEPRESTATION']?"selected":"" ?>>
											<?php echo $filiere['LIBELLETYPEPRESTATION']?>
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
				
				<form class="form-inline" method="post" action="#">
					<button type="submit" id="pdf" name="ListingPrestations"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Prestations de Services Aux Clients</button>
				</form><br>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Prestations de Services Aux Clients (<?php echo $nbrPro ?>&nbspPrestations de Services Aux Clients) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>CODE</th>
									<th>CLIENT</th>
									<th>ETAT</th>
									<th>TYPE DE LA PRESTATION</th>
									<th>MONTANT</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['CODEPRESTATION'] ?></td>
										<td><?php echo $STAGIAIRE['NOMCLIENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEETATPRESTATION'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPEPRESTATION'] ?></td>	
										<td><?php echo $STAGIAIRE['MONTANTCOUTPRESTATION'] ?></td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="Administrateur") {?>
												<!--  Action Editer un stagiaire -->
												<a class="btn btn-success btn-sm" href="EditerPrestation.php?CODEPRESTATION=<?php echo $STAGIAIRE['CODEPRESTATION'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a class="btn btn-danger btn-sm" Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE PRESTATION ?')" 
													href="SupprimerPrestation.php?CODEPRESTATION=<?php echo $STAGIAIRE['CODEPRESTATION'] ?>">
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
											<input type="hidden" name="CODETYPEPRESTATION" 
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
											<a href="ListingPrestations.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODETYPEPRESTATION=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>
				
				<?php if($_SESSION['utilisateur']['ROLE']=="Administrateur") {?>
									<a class="btn btn-success btn-lg btn-block" href="AjouterPrestation.php">Ajouter Une Nouvelle Prestation du Client</a>
								<?php } ?>
								
			</div>
		</div>
	</body>
</html>