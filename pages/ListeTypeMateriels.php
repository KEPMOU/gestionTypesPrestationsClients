<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	
		$resultat = $con->query("SELECT * FROM TYPEMATERIEL
								WHERE (CODETYPEMATERIEL like '%$mc%' OR LIBELLETYPEMATERIEL like '%$mc%')
								ORDER BY CODETYPEMATERIEL
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(CODETYPEMATERIEL) AS nbrCLASSE
								FROM TYPEMATERIEL 
								WHERE CODETYPEMATERIEL like '%$mc%'");
	
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrCLASSE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Types de Matériel de La Quincaillerie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Un Types de Matériel de La Quincaillerie</div>
					<div class="panel-body">
						<form method="get" action="ListeTypeMateriels.php" class="form-inline">
						<div class="form-group">						
								<input type="type" name="motCle" 
										placeholder="Libellé Type"
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
									<a class="btn btn-success" href="NouveauTypeMateriels.php">Ajouter Un Nouveau Type de Matériel</a>
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="Imprimer_ListeTypeMateriel.php">
					<button type="submit" id="pdf" name="ListeTypeMateriel"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste de Type de Matériel</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Types de Matériel de La Quincaillerie (<?php echo $nbrPro ?>&nbspType (s) de Matériel) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Code du Type de Matériel</th>
									<th>Libellé du Type de Matériel</th>
									
									<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS A EFFECTUER</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['CODETYPEMATERIEL'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPEMATERIEL'] ?></td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerTypeMateriels.php?CODETYPEMATERIEL=<?php echo $STAGIAIRE['CODETYPEMATERIEL'] ?>">
													<span class="glyphicon glyphicon-pencil"></span> Editer
												</a>
												&nbsp &nbsp
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes - Vous Sur de Vouloir Supprimer Ce Type de Matériel ?')" 
													href="SupprimerTypeMateriels.php?CODETYPEMATERIEL=<?php echo $STAGIAIRE['CODETYPEMATERIEL'] ?>">
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
											<a href="ListeTypeMateriels.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
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