<?php  
	<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
			
			header('location:pages/Accueil_Admin.php');
			
			<?php } 
				
				else {{?>
						
						header('location:pages/Accueil_Apprenant.php');
				<?php } }
			
			?>
    
?>