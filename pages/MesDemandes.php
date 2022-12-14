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
	
	if(isset($_GET['CODEETATDEMANDE']))
		$idf=$_GET['CODEETATDEMANDE'];
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
		$resultat = $con->query("SELECT D.IDDEMANDECREDIT, T.LIBELLETYPECREDIT, E.LIBELLEETATDEMANDE, D.DATEDEMANDECREDIT, D.HEUREDEMANDECREDIT, D.MONTANTDEMANDECREDIT
								FROM CLIENT CL, TYPECREDIT T, DEMANDECREDIT D, ETATDEMANDE E,  UTILISATEUR U
								WHERE T.CODETYPECREDIT = D.CODETYPECREDIT
								AND D.CODEETATDEMANDE = E.CODEETATDEMANDE
								AND D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND (D.IDDEMANDECREDIT like '%$mc%' OR T.LIBELLETYPECREDIT like '%$mc%')
								ORDER BY D.IDDEMANDECREDIT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDemandeC 
								FROM DEMANDECREDIT D, CLIENT CL, UTILISATEUR U
								WHERE D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND IDDEMANDECREDIT LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT D.IDDEMANDECREDIT, T.LIBELLETYPECREDIT, E.LIBELLEETATDEMANDE, D.DATEDEMANDECREDIT, D.HEUREDEMANDECREDIT, D.MONTANTDEMANDECREDIT
								FROM TYPECREDIT T, DEMANDECREDIT D, ETATDEMANDE E, UTILISATEUR U
								WHERE T.CODETYPECREDIT = D.CODETYPECREDIT
								AND D.CODEETATDEMANDE = E.CODEETATDEMANDE
								AND D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND (D.IDDEMANDECREDIT like '%$mc%' OR T.LIBELLETYPECREDIT like '%$mc%')
								AND D.CODEETATDEMANDE='$idf'
								ORDER BY D.IDDEMANDECREDIT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDemandeC 
								FROM DEMANDECREDIT D, CLIENT CL, UTILISATEUR U
								WHERE D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND (IDDEMANDECREDIT like '%$mc%')
								AND CODEETATDEMANDE='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrDemandeC'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie enti??re d'un nombre 
										// decimale
										
	$requetef="SELECT * FROM ETATDEMANDE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page de Gestion de Mes Demandes de Cr??dit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Demande de Cr??dit</div>
					<div class="panel-body">
						<form method="get" action="ListeDemandesClient.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEETATDEMANDE" id="CODEETATDEMANDE" class="form-control"
									onChange="this.form.submit();">
									<option value="0">Demandes Par Situation</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEETATDEMANDE']?>" 
											<?php echo $idf==$filiere['CODEETATDEMANDE']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEETATDEMANDE']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Un Mot Cl??"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Rechercher . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ClientBanque") {?>
									<a class="btn btn-success" href="MaNouvelleDemande.php">Effectuer Une Nouvelle Demande de Cr??dit</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="#">
					<button type="submit" id="pdf" name="ListeDemandesCredit"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste de Mes Demandes de Cr??dit</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste de Mes Demandes de Cr??dit. Vous Etes ?? : (<?php echo $nbrPro ?>&nbspDemandes (s) de Cr??dit) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Type Cr??dit</th>
									<th>Etat Demande</th>
									<th>Montant</th>
									<th>Date Demande</th>
									<th>Heure</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ClientBanque") {?> 
										<th>Pour Les Garanties</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEETATDEMANDE'] ?></td>
										<td><?php echo $STAGIAIRE['MONTANTDEMANDECREDIT'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREDEMANDECREDIT'] ?></td>
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ClientBanque") {?>
												<!--  Action Editer un stagiaire -->
												
												<a href="AjouterGarantie.php?IDDEMANDECREDIT=<?php echo $STAGIAIRE['IDDEMANDECREDIT'] ?>">
													<span class="glyphicon glyphicon-euro"></span> Ajouter
												</a>
												//
												<a href="MesGaranties.php?IDDEMANDECREDIT=<?php echo $STAGIAIRE['IDDEMANDECREDIT'] ?>">
													<span class="glyphicon glyphicon-save"></span> Afficher
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
											<label>Nombre de Ligne de Donn??es Par Page </label>
											<input type="hidden" name="CODEETATDEMANDE" 
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
											<a href="MesDemandes.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEETATDEMANDE=<?php echo $idf ?>
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