<?php
$nom = 'CHOANIER Thomas';
$Parcours = 'SLAM';
$numCandidat = '01';
define('FPDF_FONTPATH',$this->config->item('fonts_path'));
$this->load->library('fpdf');
$pdf = new CI_FPDF('L','mm','A3');
$pdf->AddPage();
    // Police Arial gras 15
    $pdf->SetFont('Times','B',15);
    // Décalage à droite
    $pdf->Cell(90);
    // Titre
    $pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "BTS SERVICES INFORMATIQUE AUX ORGANISATION - TABLEAU DE SYNTHSÈSE"));
    // Saut de ligne
    $pdf->Ln(15);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(50);
	 	$pdf->Cell(110,10,iconv("UTF-8", "ISO-8859-1", "Nom et prénom du candidat : ".$nom));
		$pdf->Cell(50);
		$pdf->Cell(40,10,iconv("UTF-8", "ISO-8859-1", "Parcours : ".$Parcours));
		$pdf->Cell(50);
		$pdf->Cell(40,10,iconv("UTF-8", "ISO-8859-1", "Numéro du candidat : ".$numCandidat));
		$pdf->Ln(15);
		$pdf->SetFont('Times','B',8);
		$pdf->Cell(31,15,iconv("UTF-8", "ISO-8859-1", "Situation obligatoire"),1,0,'C');
		$pdf->MultiCell(40,8,iconv("UTF-8", "ISO-8859-1", "Situation professionnelle (intitulé et liste des documents et productions associés)"),0,'C');
		$pdf->Ln(-24);
		$pdf->Cell(71);
		$pdf->cell(80,15,iconv("UTF-8", "ISO-8859-1", "P1 Production de services"),1,0,'C');
		$pdf->cell(50,15,iconv("UTF-8", "ISO-8859-1", "P2 Fourniture de services"),1,0,'C');
		$pdf->cell(30,15,iconv("UTF-8", "ISO-8859-1", "P3"),1,0,'C');
		$pdf->cell(90,15,iconv("UTF-8", "ISO-8859-1", "P4 Conception et mainntenance de solutions applicatives"),1,0,'C');
		$pdf->cell(60,15,iconv("UTF-8", "ISO-8859-1", "P5 Gestion de patrimoine informatique"),1,0,'C');
		$pdf->Ln(15);
		$pdf->cell(6,70,"",1,0,'C');
		$pdf->cell(6,70,"",1,0,'C');
		$pdf->cell(6,70,"",1,0,'C');
		$pdf->cell(6,70,"",1,0,'C');
		$pdf->TourneTexte(90,13,123,iconv("UTF-8", "ISO-8859-1","Production d'une solution logicielle et d'infrastructure"));
		$pdf->TourneTexte(90,19,123,iconv("UTF-8", "ISO-8859-1","Prise en charge d'incidents et de demandes d'assistance"));
		$pdf->TourneTexte(90,25,123,iconv("UTF-8", "ISO-8859-1","Élaboration de documents relatifs à la production"));
		$pdf->TourneTexte(90,31,123,iconv("UTF-8", "ISO-8859-1","Mise en place d'un dispositif de vieille technologique"));
    $pdf->Ln(15);
    foreach ($LesSituations as $UneSituation) {
      $pdf->cell(6,70,"$UneSituation['libcourt']",1,0,'C');
    }
    foreach ($LesActivites as $UneActivite) {

    }
		$pdf->Output();
?>
