<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['REFERENCEEVALUATION']))
		$RefEval=$_GET['REFERENCEEVALUATION'];
	else
		$RefEval="ALL";
	
	if(isset($_GET['CODEUNITEENSEIGNEMENT']))
		$CodeUnit=$_GET['CODEUNITEENSEIGNEMENT'];
	else
		$CodeUnit="ALL";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($RefEval=="ALL"){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT LE.IDLIGNEEVALUATION, ETD.MATRICULEETUDIANT, ETD.NOMPRENOMETUDIANT, UE.LIBELLEUNITEENSEIGNEMENT, EV.LIBELLEEVALUATION, LE.NOTEEVALUATIONETUDIANT
								FROM ETUDIANT ETD, LIGNEEVALUATION LE, UNITEENSEIGNEMENT UE, EVALUATION EV
								WHERE ETD.MATRICULEETUDIANT = LE.MATRICULEETUDIANT
								AND LE.CODEUNITEENSEIGNEMENT = UE.CODEUNITEENSEIGNEMENT
								AND LE.REFERENCEEVALUATION = EV.REFERENCEEVALUATION
								AND (ETD.MATRICULEETUDIANT LIKE '%$mc%' OR ETD.NOMPRENOMETUDIANT LIKE '%$mc%')
								AND LE.CODEUNITEENSEIGNEMENT = '$CodeUnit'
								ORDER BY LE.IDLIGNEEVALUATION
								LIMIT $size
								OFFSET $offset");
								
		$resultat2 = $con->query("SELECT COUNT(*) AS nbrREC
								FROM LIGNEEVALUATION 
								WHERE MATRICULEETUDIANT LIKE '%$mc%'
								AND CODEUNITEENSEIGNEMENT = '$CodeUnit'");
	}
	else{
		$resultat = $con->query("SELECT LE.IDLIGNEEVALUATION, ETD.MATRICULEETUDIANT, ETD.NOMPRENOMETUDIANT, UE.LIBELLEUNITEENSEIGNEMENT, EV.LIBELLEEVALUATION, LE.NOTEEVALUATIONETUDIANT
								FROM ETUDIANT ETD, LIGNEEVALUATION LE, UNITEENSEIGNEMENT UE, EVALUATION EV
								WHERE ETD.MATRICULEETUDIANT = LE.MATRICULEETUDIANT
								AND LE.CODEUNITEENSEIGNEMENT = UE.CODEUNITEENSEIGNEMENT
								AND LE.REFERENCEEVALUATION = EV.REFERENCEEVALUATION
								AND (ETD.MATRICULEETUDIANT LIKE '%$mc%' OR ETD.NOMPRENOMETUDIANT LIKE '%$mc%')
								AND LE.CODEUNITEENSEIGNEMENT = '$CodeUnit'
								AND LE.REFERENCEEVALUATION = '$RefEval'
								ORDER BY LE.IDLIGNEEVALUATION");
								
		$resultat2 = $con->query("SELECT COUNT(*) AS nbrREC
								FROM LIGNEEVALUATION 
								WHERE MATRICULEETUDIANT LIKE '%$mc%'
								AND CODEUNITEENSEIGNEMENT = '$CodeUnit'
								AND REFERENCEEVALUATION = '$RefEval'");
	
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
										
	$RequeteEVALUATION = "SELECT * FROM EVALUATION";
	$ResultatEVALUATION = $con->query($RequeteEVALUATION);
	
	$RequeteUNITEENSEIGNEMENT = "SELECT * FROM UNITEENSEIGNEMENT";
	$ResultatUNITEENSEIGNEMENT = $con->query($RequeteUNITEENSEIGNEMENT);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Etudiants de L'IPES</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		 <div id="wrapper">
			<?php include('EnteteUser.php');?>
			<div class="container"><br>
				<div class="panel panel-primary espace60">
					<div class="panel-heading">Page Gestion des Etudiants de L'IPES</div>
					<div class="panel-body">
						<form method="get" action="ListingNotes.php" class="form-inline">
						<div class="form-group">						
								<select name="REFERENCEEVALUATION" id="REFERENCEEVALUATION" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Les Notes Par Evaluations</option>
									<?php while($ListeEVALUATION = $ResultatEVALUATION->fetch()){ ?>
										<option value="<?php echo $ListeEVALUATION['REFERENCEEVALUATION']?>" 
											<?php echo $RefEval==$ListeEVALUATION['REFERENCEEVALUATION']?"selected":"" ?>>
											<?php echo $ListeEVALUATION['LIBELLEEVALUATION']?>
										</option>									
									<?php } ?>
								</select>
								
								<select name="CODEUNITEENSEIGNEMENT" id="CODEUNITEENSEIGNEMENT" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Les Notes Par UE</option>
									<?php while($ListeUNITEENSEIGNEMENT = $ResultatUNITEENSEIGNEMENT->fetch()){ ?>
										<option value="<?php echo $ListeUNITEENSEIGNEMENT['CODEUNITEENSEIGNEMENT']?>" 
											<?php echo $CodeUnit==$ListeUNITEENSEIGNEMENT['CODEUNITEENSEIGNEMENT']?"selected":"" ?>>
											<?php echo $ListeUNITEENSEIGNEMENT['LIBELLEUNITEENSEIGNEMENT']?>
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
									Rechercher
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="Administration") {?>
									<a class="btn btn-success btn-lg" href="AjouterNote.php">Ajouter Nouvelle Note</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Etudiants Enregistrés dans La Base de Donners de L'IPES
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>EVALUATION</th>
									<th>UNITE ENSEIGNEMENT</th>
									<th>MATRICULE</th>
									<th>ETUDIANT</th>
									<th>NOTE EVALUATION</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDLIGNEEVALUATION'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEEVALUATION'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEUNITEENSEIGNEMENT'] ?></td>
										<td><?php echo $STAGIAIRE['MATRICULEETUDIANT'] ?></td>	
										<td><?php echo $STAGIAIRE['NOMPRENOMETUDIANT'] ?></td>												
										<td><?php echo $STAGIAIRE['NOTEEVALUATIONETUDIANT'] ?></td>												
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="CODEFILIERE" 
												value="<?php echo $RefEval ?>">
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
											<a href="ListingNotes.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEFILIERE=<?php echo $RefEval ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>							
						</div>					
					</div>				
				</div>
					<?php if($_SESSION['utilisateur']['ROLE']=="Administration") {?>
									<a class="btn btn-primary btn-lg btn-block" href="AjouterNote.php">Enregistrer Une Nouvelle Note Pour L'UE En Relation Avec L'Evaluation</a>
								<?php } ?>	
			</div>									
		</div>
	</body>
</html>