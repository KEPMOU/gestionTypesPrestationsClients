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
			$this->Cell(276,5,'LISTING DES CREDITS ACCORDES AUX CLIENTS',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(55,10,'TYPE',1,0,'C');
			$this->Cell(45,10,'REFERENCE',1,0,'C');
			$this->Cell(45,10,'CLIENT',1,0,'C');
			$this->Cell(45,10,'DATE',1,0,'C');
			$this->Cell(45,10,'MONTANT',1,0,'C');
			$this->Cell(45,10,'OBTENU',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT T.LIBELLETYPECREDIT, C.REFERENCECREDIT, CL.NOMCLIENT, D.DATEDEMANDECREDIT, C.DATEOBTENTIONCREDIT, D.MONTANTDEMANDECREDIT, C.MONTANTCREDIT
								FROM CREDIT C, DEMANDECREDIT D, TYPECREDIT T, CLIENT CL
								WHERE C.IDDEMANDECREDIT = D.IDDEMANDECREDIT
								AND D.CODETYPECREDIT = T.CODETYPECREDIT
								AND D.REFERENCECLIENT = CL.REFERENCECLIENT');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(55,10,$data->LIBELLETYPECREDIT,1,0,'');
				$this->Cell(45,10,$data->REFERENCECREDIT,1,0,'');
				$this->Cell(45,10,$data->NOMCLIENT,1,0,'');
				$this->Cell(45,10,$data->DATEOBTENTIONCREDIT,1,0,'C');
				$this->Cell(45,10,$data->MONTANTDEMANDECREDIT,1,0,'C');
				$this->Cell(45,10,$data->MONTANTCREDIT,1,0,'C');
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
