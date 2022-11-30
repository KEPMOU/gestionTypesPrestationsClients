<?php
	require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=gestionquincallerie','root','');
	
	class MyPDF extends FPDF{
		function header(){
			//$this->Image('gestionLogo.png',5,15);
			$this->SetFont('Arial','B',30);
			$this->Cell(276,25,'GESTION QUINCAILLERIE',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',20);
			$this->Cell(276,5,'SITUATION DU MATERIEL EN STOCK',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',16);
			$this->Cell(45,10,'REFERENCE',1,0,'C');
			$this->Cell(75,10,'TYPE',1,0,'C');
			$this->Cell(75,10,'DESIGNATION',1,0,'C');
			$this->Cell(35,10,'PRIX UNIT.',1,0,'C');
			$this->Cell(35,10,'STOCK',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT MAT.REFERENCEMATERIEL, TM.LIBELLETYPEMATERIEL, MAT.DESIGNATIONMATERIEL, MAT.PRIXUNITAIREMATERIEL, MAT.QTESTOCKMATERIEL, MAT.QTESEUILMATERIEL, MAT.QTEALERTEMATERIEL
								FROM TYPEMATERIEL TM, MATERIEL MAT
									WHERE TM.CODETYPEMATERIEL = MAT.CODETYPEMATERIEL');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(45,10,$data->REFERENCEMATERIEL,1,0,'C');
				$this->Cell(75,10,$data->LIBELLETYPEMATERIEL,1,0,'C');
				$this->Cell(75,10,$data->DESIGNATIONMATERIEL,1,0,'C');
				$this->Cell(35,10,$data->PRIXUNITAIREMATERIEL,1,0,'C');
				$this->Cell(35,10,$data->QTESTOCKMATERIEL,1,0,'C');
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
