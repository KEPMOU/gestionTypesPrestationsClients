<?php
	require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=gestionquincallerie','root','');
	
	class MyPDF extends FPDF{
		function header(){
			//$this->Image('gestionLogo.png',5,15);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,25,'Gestion des Activites dans La Quincallerie',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',20);
			$this->Cell(276,5,'Liste Types de Materiel de La Quincaillerie',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',20);
			$this->Cell(125,10,'Code du Type',1,0,'C');
			$this->Cell(135,10,'Libelle du Type',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT CODETYPEMATERIEL, LIBELLETYPEMATERIEL FROM TYPEMATERIEL');
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(125,10,$data->CODETYPEMATERIEL,1,0,'C');
				$this->Cell(135,10,$data->LIBELLETYPEMATERIEL,1,0,'L');
				$this->Ln();
				
			}
		}
	}
	$pdf = new MyPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Cell(50,5,"Revenir",1,1,'C',false,'ListeTypeMateriels.php');	
	$pdf->Output();
?>
