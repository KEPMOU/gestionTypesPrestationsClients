<?php
	require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=projet_gestionpharmacie','root','');
	
	class MyPDF extends FPDF{
		function header(){
			//$this->Image('gestionLogo.png',5,15);
			$this->SetFont('Arial','B',25);
			$this->Cell(276,25,'GESTION DES PHARMACIES DE LA VILLE DE YAOUNDE',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',20);
			$this->Cell(276,5,'PAGE LISTE DES FOURNISSEURS ENREGISTRES',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',15);
			$this->Cell(55,10,'REFERENCE',1,0,'C');
			$this->Cell(90,10,'FOURNISSEUR',1,0,'C');
			$this->Cell(75,10,'ADRESSE',1,0,'C');
			$this->Cell(55,10,'TELEPHONES',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT REFERENCEFOURNISSEUR, NOMFOURNISSEUR, ADRESSEFOURNISSEUR, CONTACTFOURNISSEUR FROM FOURNISSEUR');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(55,10,$data->REFERENCEFOURNISSEUR,1,0,'C');
				$this->Cell(90,10,$data->NOMFOURNISSEUR,1,0,'');
				$this->Cell(75,10,$data->ADRESSEFOURNISSEUR,1,0,'');
				$this->Cell(55,10,$data->CONTACTFOURNISSEUR,1,0,'C');
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
