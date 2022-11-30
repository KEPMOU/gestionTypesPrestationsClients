<?php
	require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=gestionstockvente_simro','root','');
	
	class MyPDF extends FPDF{
		function header(){
			//$this->Image('gestionLogo.png',5,15);
			$this->SetFont('Arial','B',30);
			$this->Cell(276,25,'GESTION DE LA QUINCAILLERIE',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',20);
			$this->Cell(276,5,'LISTING DES VENTES DE MATERIEL',0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',16);
			$this->Cell(25,10,'VENTE',1,0,'C');
			$this->Cell(65,10,'MATERIEL',1,0,'C');
			$this->Cell(35,10,'CLIENT',1,0,'C');
			$this->Cell(35,10,'DATE',1,0,'C');
			$this->Cell(35,10,'UNITAIRE',1,0,'C');
			$this->Cell(35,10,'QUANTITE',1,0,'C');
			$this->Cell(55,10,'REGLEMENT',1,0,'C');
			$this->Ln();
			
		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$stmt = $db->query('SELECT V.REFERENCEVENTE, M.DESIGNATIONMATERIEL, C.NOMCLIENT, V.DATEVENTE, M.PRIXUNITAIREMATERIEL, V.QTEVENTE, (M.PRIXUNITAIREMATERIEL * V.QTEVENTE) AS MONTANT
								FROM VENTE V, MATERIEL M, CLIENT C
									WHERE M.REFERENCEMATERIEL = V.REFERENCEMATERIEL
										AND V.IDCLIENT = C.IDCLIENT');
										
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(25,10,$data->REFERENCEVENTE,1,0,'C');
				$this->Cell(65,10,$data->DESIGNATIONMATERIEL,1,0,'C');
				$this->Cell(35,10,$data->NOMCLIENT,1,0,'C');
				$this->Cell(35,10,$data->DATEVENTE,1,0,'C');
				$this->Cell(35,10,$data->PRIXUNITAIREMATERIEL,1,0,'C');
				$this->Cell(35,10,$data->QTEVENTE,1,0,'C');
				$this->Cell(55,10,$data->MONTANT,1,0,'C');
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
