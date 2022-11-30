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
			$this->Cell(276,5,'PAGE LISTING DES MEDICAMENTS ENREGISTRES',0,0,'C');
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
			$this->Cell(55,10,'FAMILLE',1,0,'C');
			$this->Cell(45,10,'FORME',1,0,'C');
			$this->Cell(100,10,'LIBELLE MEDICAMENT',1,0,'C');
			$this->Cell(45,10,'PRIX VENTE',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',10);
			$stmt = $db->query('SELECT M.REFERENCEMEDICAMENT, FA.LIBELLEFAMILLEMEDICAMENT, FO.LIBELLEFORMEMEDICAMENT, M.LIBELLEMEDICAMENT, M.PRIXVENTEMEDICAMENT
								FROM FAMILLEMEDICAMENT FA, MEDICAMENT M, FORMEMEDICAMENT FO
								WHERE FA.CODEFAMILLEMEDICAMENT = M.CODEFAMILLEMEDICAMENT
								AND M.CODEFORMEMEDICAMENT = FO.CODEFORMEMEDICAMENT');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(35,10,$data->REFERENCEMEDICAMENT,1,0,'C');
				$this->Cell(55,10,$data->LIBELLEFAMILLEMEDICAMENT,1,0,'');
				$this->Cell(45,10,$data->LIBELLEFORMEMEDICAMENT,1,0,'');
				$this->Cell(100,10,$data->LIBELLEMEDICAMENT,1,0,'');
				$this->Cell(45,10,$data->PRIXVENTEMEDICAMENT,1,0,'C');
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
