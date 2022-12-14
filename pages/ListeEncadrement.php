<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['MATRICULEENCADREUR']))
		$idf=$_GET['MATRICULEENCADREUR'];
	else
		$idf=0;
		
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
		$resultat = $con->query("SELECT AFF.IDAFFECTATION, ENC.NOMENCADREUR, STG.NOMSTAGIAIRE, AFF.DATEAFFECTATION, AFF.HEUREAFFECTATION 
								FROM STAGIAIRE STG, AFFECTATION AFF, ENCADREUR ENC
								WHERE STG.IDSTAGIAIRE = AFF.IDSTAGIAIRE
								AND AFF.MATRICULEENCADREUR = ENC.MATRICULEENCADREUR
								AND (ENC.NOMENCADREUR like '%$mc%' OR STG.NOMSTAGIAIRE like '%$mc%')
								ORDER BY AFF.IDAFFECTATION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrAFFECTATION 
								from AFFECTATION 
								where IDAFFECTATION like '%$mc%' OR MATRICULEENCADREUR like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT G.LIBELLEGENRE, STG.NOMSTAGIAIRE, STG.TELSTAGIAIRE, FORM.LIBELLEFORMATION, TST.LIBELLETYPESTAGE, ST.DATEDEBUTSTAGE, ST.DATEFINSTAGE
								FROM GENRE G,STAGIAIRE STG,FORMATION FORM,TYPESTAGE TST,STAGE ST
								WHERE G.CODEGENRE = STG.CODEGENRE
								AND FORM.CODEFORMATION = STG.CODEFORMATION
								AND STG.IDSTAGIAIRE = ST.IDSTAGIAIRE
								AND ST.CODETYPESTAGE = TST.CODETYPESTAGE
								AND ST.CODETYPESTAGE = TST.CODETYPESTAGE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR FORM.LIBELLEFORMATION like '%$mc%')
								And STG.CODEFORMATION=$idf
								ORDER BY STG.NOMSTAGIAIRE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrAFFECTATION 
								from STAGIAIRE 
								where (NOM like '%$mc%' OR PRENOM like '%$mc%')
								And ID_FILIERE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrAFFECTATION'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie enti??re d'un nombre 
										// decimale
										
	$requetef="select * from ENCADREUR";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Affectation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Affectations Encadrement</div>
					<div class="panel-body">
						<form method="get" action="ListeStage.php" class="form-inline">
						<div class="form-group">						
								<select name="MATRICULEENCADREUR" id="MATRICULEENCADREUR" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >S??lection Encadreur</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['MATRICULEENCADREUR']?>" 
											<?php echo $idf==$filiere['MATRICULEENCADREUR']?"selected":"" ?>>
											<?php echo $filiere['NOMENCADREUR']?>
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
									Lancer La Recherche . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="NouveauStagiaire.php">Nouveau Stagiaire</a>
									<a class="btn btn-success" href="NouveauStage.php">Nouveau Stage</a>
									<a class="btn btn-success" href="NewEncadrement.php">Encadrement</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Affectations (<?php echo $nbrPro ?>&nbspAffectation) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID AFFECTATION</th>
									<th>NOM ENCADREUR</th>
									<th>NOM DU STAGIAIRE</th>
									<th>DATE AFFECTATION</th>
									<th>HEURE AFF.</th>
									
								
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDAFFECTATION'] ?></td>
										<td><?php echo $STAGIAIRE['NOMENCADREUR'] ?></td>
										<td><?php echo $STAGIAIRE['NOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['DATEAFFECTATION'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREAFFECTATION'] ?></td>	
											
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?IDAFFECTATION=<?php echo $STAGIAIRE['IDAFFECTATION'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?IDAFFECTATION=<?php echo $STAGIAIRE['IDAFFECTATION'] ?>">
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
											<label>Nombre de Stagiaire Par Page </label>
											<input type="hidden" name="MATRICULEENCADREUR" 
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
											<a href="stagiaires.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&MATRICULEENCADREUR=<?php echo $idf ?>
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