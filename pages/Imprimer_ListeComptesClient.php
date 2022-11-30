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
			$this->Cell(276,5,'LISTING DES COMPTES DES CLIENTS',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(35,10,'COMPTE',1,0,'C');
			$this->Cell(55,10,'TYPE COMPTE',1,0,'C');
			$this->Cell(55,10,'CLIENT',1,0,'C');
			$this->Cell(45,10,'CREATION',1,0,'C');
			$this->Cell(45,10,'DEPART',1,0,'C');
			$this->Cell(45,10,'SOLDE',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT C.NUMEROCOMPTE, TC.LIBELLETYPECOMPTE, CL.NOMCLIENT, C.DATECREATIONCOMPTE, C.HEURECREATIONCOMPTE, C.SOLDEDEPARTCOMPTE, C.SOLDEACTUELLECOMPTE
								FROM TYPECOMPTE TC, COMPTE C, CLIENT CL
								WHERE TC.CODETYPECOMPTE = C.CODETYPECOMPTE
								AND C.REFERENCECLIENT = CL.REFERENCECLIENT');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(35,10,$data->NUMEROCOMPTE,1,0,'');
				$this->Cell(55,10,$data->LIBELLETYPECOMPTE,1,0,'');
				$this->Cell(55,10,$data->NOMCLIENT,1,0,'');
				$this->Cell(45,10,$data->DATECREATIONCOMPTE,1,0,'C');
				$this->Cell(45,10,$data->SOLDEDEPARTCOMPTE,1,0,'C');
				$this->Cell(45,10,$data->SOLDEACTUELLECOMPTE,1,0,'C');
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
