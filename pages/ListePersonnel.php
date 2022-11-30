<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODETYPESTAGE']))
		$idf=$_GET['CODETYPESTAGE'];
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
		$resultat = $con->query("SELECT ST.IDSTAGE, STG.NOMSTAGIAIRE, STG.PRENOMSTAGIAIRE, STG.TELSTAGIAIRE, ST.DATEDEBUTSTAGE, ST.DATEFINSTAGE, TST.LIBELLETYPESTAGE
								FROM STAGIAIRE STG,STAGE ST, TYPESTAGE TST
								WHERE STG.IDSTAGIAIRE = ST.IDSTAGIAIRE
								AND ST.CODETYPESTAGE = TST.CODETYPESTAGE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR TST.LIBELLETYPESTAGE like '%$mc%')
								ORDER BY STG.NOMSTAGIAIRE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrSTAGAIRE 
								from STAGE 
								where CODETYPESTAGE like '%$mc%' OR IDSTAGIAIRE like '%$mc%'");
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

		$resultat2 = $con->query("select count(*) as nbrSTAGAIRE 
								from STAGIAIRE 
								where (NOM like '%$mc%' OR PRENOM like '%$mc%')
								And ID_FILIERE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrSTAGAIRE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from TYPESTAGE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Stages</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Stages</div>
					<div class="panel-body">
						<form method="get" action="ListeStage.php" class="form-inline">
						<div class="form-group">						
								<select name="CODETYPESTAGE" id="CODETYPESTAGE" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Types de Stages</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODETYPESTAGE']?>" 
											<?php echo $idf==$filiere['CODETYPESTAGE']?"selected":"" ?>>
											<?php echo $filiere['LIBELLETYPESTAGE']?>
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
					
					Liste des Stagiaires (<?php echo $nbrPro ?>&nbspStagiaire) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID STAGE</th>
									<th>NOM STAGIAIRE</th>
									<th>PRENOM</th>
									<th>TELEPHONE</th>
									<th>DATE DEBUT</th>
									<th>FIN STAGE</th>
									<th>TYPE STAGE</th>
								
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDSTAGE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['PRENOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['TELSTAGIAIRE'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEDEBUTSTAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEFINSTAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['LIBELLETYPESTAGE'] ?></td>	
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?IDSTAGE=<?php echo $STAGIAIRE['IDSTAGE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?IDSTAGE=<?php echo $STAGIAIRE['IDSTAGE'] ?>">
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
											<input type="hidden" name="CODEFORMATION" 
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
											&CODEFORMATION=<?php echo $idf ?>
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