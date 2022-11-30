<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
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
		$resultat = $con->query("SELECT C.NUMEROCOMPTE, TC.LIBELLETYPECOMPTE, CL.NOMCLIENT, C.DATECREATIONCOMPTE, C.HEURECREATIONCOMPTE, C.SOLDEDEPARTCOMPTE, C.SOLDEACTUELLECOMPTE
								FROM TYPECOMPTE TC, COMPTE C, CLIENT CL
								WHERE TC.CODETYPECOMPTE = C.CODETYPECOMPTE
								AND C.REFERENCECLIENT = CL.REFERENCECLIENT
								AND (C.NUMEROCOMPTE like '%$mc%')
								ORDER BY C.NUMEROCOMPTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDemandeC 
								from COMPTE 
								where NUMEROCOMPTE like '%$mc%'");
	}
	else{
		$resultat = $con->query("C.NUMEROCOMPTE, TC.LIBELLETYPECOMPTE, CL.NOMCLIENT, C.DATECREATIONCOMPTE, C.HEURECREATIONCOMPTE, C.SOLDEDEPARTCOMPTE, C.SOLDEACTUELLECOMPTE
								FROM TYPECOMPTE TC, COMPTE C, CLIENT CL
								WHERE TC.CODETYPECOMPTE = C.CODETYPECOMPTE
								AND C.REFERENCECLIENT = CL.REFERENCECLIENT
								AND (C.NUMEROCOMPTE like '%$mc%')
								And C.CODETYPECOMPTE='$idf'
								ORDER BY C.NUMEROCOMPTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDemandeC 
								from COMPTE 
								where (NUMEROCOMPTE like '%$mc%')
								And CODETYPECOMPTE='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrDemandeC'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="SELECT * FROM TYPECOMPTE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page de Gestion des Comptes des Clients de La Banque</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Les Informations Sur Un Compte de La Banque</div>
					<div class="panel-body">
						<form method="get" action="ListingComptesClient.php" class="form-inline">
						<div class="form-group">						
								<select name="CODETYPECOMPTE" id="CODETYPECOMPTE" class="form-control"
									onChange="this.form.submit();">
									<option value="0">Liste Par Type de Compte</option>
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
								&nbsp&nbsp&nbsp	
								<?php if($_SESSION['utilisateur']['ROLE']=="GestionnaireCompe") {?>
									<a class="btn btn-success" href="NouveauCompteClient.php">Ajouter Un Nouveau Compte Client</a>
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="Imprimer_ListeComptesClient.php">
					<button type="submit" id="pdf" name="ListeComptesClient"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Comptes Client</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Comptes des Clients de La Banque
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>COMPTE</th>
									<th>TYPE COMPTE</th>
									<th>LE CLIENT</th>
									<th>DATE CREATION</th>
									<th>HEURE</th>
									<th>DEPART</th>
									<th>SOLDE</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['NUMEROCOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPECOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMCLIENT'] ?></td>
										<td><?php echo $STAGIAIRE['DATECREATIONCOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['HEURECREATIONCOMPTE'] ?></td>	
										<td><?php echo $STAGIAIRE['SOLDEDEPARTCOMPTE'] ?></td>
										<td><?php echo $STAGIAIRE['SOLDEACTUELLECOMPTE'] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="CODETYPECOMPTE" 
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
											<a href="ListingComptesClient.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODETYPECOMPTE=<?php echo $idf ?>
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