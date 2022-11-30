<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEFORMATION']))
		$idf=$_GET['CODEFORMATION'];
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
		$resultat = $con->query("SELECT G.LIBELLEGENRE, STG.IDSTAGIAIRE, STG.NOMSTAGIAIRE, STG.TELSTAGIAIRE, FORM.LIBELLEFORMATION, TST.LIBELLETYPESTAGE, ST.DATEDEBUTSTAGE, ST.DATEFINSTAGE
								FROM GENRE G,STAGIAIRE STG,FORMATION FORM,TYPESTAGE TST,STAGE ST
								WHERE G.CODEGENRE = STG.CODEGENRE
								AND STG.CODEFORMATION = FORM.CODEFORMATION
								AND STG.IDSTAGIAIRE = ST.IDSTAGIAIRE
								AND ST.CODETYPESTAGE = TST.CODETYPESTAGE
								AND ST.CODETYPESTAGE = TST.CODETYPESTAGE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR FORM.LIBELLEFORMATION like '%$mc%')
								ORDER BY STG.NOMSTAGIAIRE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrSTAGAIRE 
								from STAGIAIRE 
								where NOMSTAGIAIRE like '%$mc%' OR CODEFORMATION like '%$mc%'");
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
										
	$requetef="select * from FORMATION";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des stagiaires</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des stagiaires</div>
					<div class="panel-body">
						<form method="get" action="ListeStagiaire.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEFORMATION" id="CODEFORMATION" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Les Stagiaires Par Formation</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEFORMATION']?>" 
											<?php echo $idf==$filiere['CODEFORMATION']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEFORMATION']?>
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
									<th>ID</th>
									<th>GENRE</th>
									<th>NOM</th>
									<th>TELEPHONE</th>
									<th>FORMATION</th>
									<th>TYPE STAGE</th>
									<th>DEBUT</th>
									<th>FIN</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEGENRE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['TELSTAGIAIRE'] ?></td>	
										<td><?php echo $STAGIAIRE['LIBELLEFORMATION'] ?></td>	
										<td><?php echo $STAGIAIRE['LIBELLETYPESTAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEDEBUTSTAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEFINSTAGE'] ?></td>		
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?IDSTAGIAIRE=<?php echo $STAGIAIRE['IDSTAGIAIRE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?IDSTAGIAIRE=<?php echo $STAGIAIRE['IDSTAGIAIRE'] ?>">
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