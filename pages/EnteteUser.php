<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header"> 
			<a href="accueil.php" class="navbar-brand">ePrestations</a>
		</div>
		<ul class="nav navbar-nav">
			<?php if($_SESSION['utilisateur']['ROLE']=="Administrateur") {?>
				<li><a href="ListeTypesPrestations.php">Types Prestations</a></li>
				<li><a href="ListeClients.php">Clients Entreprise</a></li>
				<li><a href="ListingPrestations.php">Prestations Entreprise</a></li>
				<li><a href="ListingReglements.php">Règlements Prestations</a></li>
				<li><a href="Stats.php">Statistiques</a></li>
				<li><a href="ListeComptesUsers.php">Comptes Utilisateurs</a></li>
				<?php } 
			?>
			
			<?php if($_SESSION['utilisateur']['ROLE']=="Secretaire") {?>
				<li><a href="ListeClients.php">Clients Entreprise</a></li>
				<li><a href="ListingPrestations.php">Prestations Entreprise</a></li>
				<li><a href="ListingReglements.php">Règlements Prestations</a></li>
				<?php } 
			?>
			
			<?php if($_SESSION['utilisateur']['ROLE']=="Etudiant") {?>
				
				
				<?php } 
			?>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="editerUtilisateur.php?id=<?php echo $_SESSION['utilisateur']['ID'];?>">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $_SESSION['utilisateur']['LOGIN'];?>
					</a>
				</li>
				<li>
					<a href="SeDeconnecter.php">
						<span class="glyphicon glyphicon-log-out"></span>
						Se Deconnecter
					</a>
				</li>
			</ul>
	</div>
</nav>