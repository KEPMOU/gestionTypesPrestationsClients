<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['IDINSCRIPTION'];
	$Lib2=$_POST['IDETATINSCRIPTION'];
	$Lib3=$_POST['NOMCANDIDATINSCRIPTION'];
	$Lib4=$_POST['PRENOMCANDIDATINSCRIPTION'];
	$Lib5=$_POST['NUMCNICANDIDATINSCRIPTION'];
	
	$requete="UPDATE INSCRIPTION SET IDETATINSCRIPTION=? WHERE IDINSCRIPTION=?";
	$param=array($Lib2,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	if($Lib2==2) 
		{
			$stmt = $con->prepare('INSERT INTO UTILISATEUR(login, pwd,role, email,etat)
										VALUES (:pLogin,:pPwd,:pRole, :pEmail,:pEtat)');
										
				$stmt->execute(array(
				
						'pLogin' 	=> $Lib3,
						'pPwd' 		=> md5(123),
						'pRole'		=>'APPRENANT',
						'pEmail' 	=> 'email_apprenant@gmail.com',
						'pEtat'		=>1)
						);
			}
	
	header("location:ListeInscription.php");

?>