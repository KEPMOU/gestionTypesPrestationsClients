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
	
	
		$resultat = $con->query("SELECT LIBELLETYPEPERMIS, LIMITEAGETYPEPERMIS, COUTFORMATIONTYPEPERMIS FROM typepermis
								WHERE (LIBELLETYPEPERMIS like '%$mc%' OR LIMITEAGETYPEPERMIS like '%$mc%')
								ORDER BY LIBELLETYPEPERMIS
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrARRIV 
								from typepermis 
								where LIBELLETYPEPERMIS like '%$mc%'");
	
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrARRIV'];
	
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
		<title>Liste des Types de Permis</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Auto3.JPG">
		 <div id="wrapper">
			<?php include('entete2.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Les Types de Permis</div>
					<div class="panel-body">
						<form method="get" action="ListeTypeP.php" class="form-inline">
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
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Types de Permis du Centre (<?php echo $nbrPro ?>&nbspType(s) de Permis Disponibles Au Centre) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Libellé du Type de Permis</th>
									<th>Limite d'Age</th>
									<th>Cout de La Formation</th>
								
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['LIBELLETYPEPERMIS'] ?></td>
										<td><?php echo $STAGIAIRE['LIMITEAGETYPEPERMIS'] ?></td>
										<td><?php echo $STAGIAIRE['COUTFORMATIONTYPEPERMIS'] ?></td>
											
									
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
											<a href="ListeTypeP.php?page=<?php echo $i ?>
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