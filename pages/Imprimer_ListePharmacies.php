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
			$this->Cell(276,5,'PAGE LISTING DES PHARMACIES DE LA BASE DE DONNEES',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',12);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(35,10,'REFERENCE',1,0,'C');
			$this->Cell(45,10,'QUARTIER',1,0,'C');
			$this->Cell(75,10,'NOM PHARMACIE',1,0,'C');
			$this->Cell(35,10,'TELEPHONES',1,0,'C');
			$this->Cell(35,10,'OUVERTURE',1,0,'C');
			$this->Cell(35,10,'FERMETURE',1,0,'C');
			$this->Cell(20,10,'ID USER',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',10);
			$stmt = $db->query('SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE, UT.ID
								FROM QUARTIER Q, PHARMACIE P, UTILISATEUR UT
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND P.ID = UT.ID');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(35,10,$data->REFERENCEPHARMACIE,1,0,'C');
				$this->Cell(45,10,$data->NOMQUARTIER,1,0,'');
				$this->Cell(75,10,$data->NOMPHARMACIE,1,0,'');
				$this->Cell(35,10,$data->CONTACTSPHARMACIE,1,0,'');
				$this->Cell(35,10,$data->HEUREOUVRTUREPHARMACIE,1,0,'C');
				$this->Cell(35,10,$data->HEUREFERMETUREPHARMACIE,1,0,'C');
				$this->Cell(20,10,$data->ID,1,0,'C');
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
