<?php
	require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=gestioncredit_ccabank','root','');
	
	class MyPDF extends FPDF{
		function header(){
			//$this->Image('gestionLogo.png',5,15);
			$this->SetFont('Arial','B',30);
			$this->Cell(276,25,'GESTION ET SUIVI DES CREDITS A LA CCA - BANK',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',20);
			$this->Cell(276,5,'LISTING DES CLIENTS DE LA BANQUE',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(55,10,'REFERENCE',1,0,'C');
			$this->Cell(55,10,'NOM',1,0,'C');
			$this->Cell(55,10,'PRENOM',1,0,'C');
			$this->Cell(55,10,'ADRESSE',1,0,'C');
			$this->Cell(55,10,'TELEPHONES',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT CL.REFERENCECLIENT, CL.NOMCLIENT, CL.PRENOMCLIENT, CL.ADRESSECLIENT, CL.TELEPHONECLIENT, U.ID
								FROM CLIENT CL, UTILISATEUR U
								WHERE CL.ID = U.ID');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(55,10,$data->REFERENCECLIENT,1,0,'');
				$this->Cell(55,10,$data->NOMCLIENT,1,0,'');
				$this->Cell(55,10,$data->PRENOMCLIENT,1,0,'');
				$this->Cell(55,10,$data->ADRESSECLIENT,1,0,'');
				$this->Cell(55,10,$data->TELEPHONECLIENT,1,0,'C');
				$this->Ln();
				
			}
		}
	}
	$pdf = new MyPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	//$pdf->Cell(50,5,"Revenir",1,1,'C',false,'PageClasse.php');	
	$pdf->Output();
?>
