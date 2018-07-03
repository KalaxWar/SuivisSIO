<?php
$pdf = new CI_FPDF('L','mm','A3');
$pdf->AddPage();
    // Police Arial gras 15
    $pdf->SetFont('Times','B',15);
    // Décalage à droite
    $pdf->Cell(90);
    // Titre
    $pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "BTS SERVICES INFORMATIQUE AUX ORGANISATION - TABLEAU DE SYNTHÈSE"));
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
		$pdf->SetFont('Times','B',7);
		$pdf->Cell(24,15,iconv("UTF-8", "ISO-8859-1", "Situation obligatoire"),1,0,'C');
		$pdf->MultiCell(35,8,iconv("UTF-8", "ISO-8859-1", "Situation professionnelle (intitulé et liste des documents et productions associés)"),0,'C');
		$pdf->Ln(-24);
		$pdf->Cell(60);
		$pdf->cell(90,15,iconv("UTF-8", "ISO-8859-1", "P1 Production de services"),1,0,'C');
		$pdf->cell(42,15,iconv("UTF-8", "ISO-8859-1", "P2 Fourniture de services"),1,0,'C');
		$pdf->cell(24,15,iconv("UTF-8", "ISO-8859-1", "P3"),1,0,'C');
		$pdf->cell(84,15,iconv("UTF-8", "ISO-8859-1", "P4 Conception et mainntenance de solutions applicatives"),1,0,'C');
		$pdf->cell(60,15,iconv("UTF-8", "ISO-8859-1", "P5 Gestion de patrimoine informatique"),1,0,'C');
		$pdf->Ln(15);
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->TourneTexte(90,13,128,iconv("UTF-8", "ISO-8859-1","Production d'une solution logicielle et d'infrastructure"));
		$pdf->TourneTexte(90,19,128,iconv("UTF-8", "ISO-8859-1","Prise en charge d'incidents et de demandes d'assistance"));
		$pdf->TourneTexte(90,25,128,iconv("UTF-8", "ISO-8859-1","Élaboration de documents relatifs à la production"));
		$pdf->TourneTexte(90,31,128,iconv("UTF-8", "ISO-8859-1","Mise en place d'un dispositif de vieille technologique"));
    $i = 75;
      $pdf->Cell(36);
    foreach ($LesActivites as $UneActivite) {
      $pdf->TourneTexte(90,$i,128,$UneActivite['nomenclature']." ".iconv("UTF-8", "ISO-8859-1//TRANSLIT",$UneActivite['libcourt']));
      $i = $i + 6;
      $pdf->cell(6,75,"",1,0,'C');
    }
    $pdf->Ln(75);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetDrawColor(200,200,200);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    for ($i=0; $i <4 ; $i++) {
      $pdf->cell(6,146,"",1,0,'C');
    }
    $pdf->Cell(36);
    for ($i=0; $i <50 ; $i++) {
      $pdf->cell(6,146,"",1,0,'C');
    }
    $pdf->Ln(10);

    $pdf->SetDrawColor(0,0,0);
    if (!(empty($LesSituationsForma))) {
    $pdf->Cell(130);
    $pdf->SetFont('Times','B',14);
    $pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "SITUATIONS VÉCUS EN FORMATION"));
    $pdf->SetFont('Times','B',7);
    $pdf->Ln(10);
    foreach ($LesSituationsForma as $UneSituation) { //chaque ligne (situations vécu en formation)
      $Esttypo['LesActivites'] = $this->ModeleUtilisateur->getEstTypoWhereSituation($UneSituation['ref']);

      foreach ($Esttypo['LesActivites'] as $UneLigne) { //situation oblig (croix)
        if (!($UneLigne['codeTypologie'] == ""))
        {
          $pdf->cell(6,8,"X",1,0,'C');
        }
        else {
          $pdf->cell(6,8,"",1,0,'C');
        }
      }
      //------------------------------------------------------------------------------
}
      $Y1 = $pdf->getY();
      $pdf->MultiCell(36,4,iconv("UTF-8", "ISO-8859-1",$UneSituation['libcourt'])." \n ".$UneSituation['datedebut']." ".$UneSituation['datefin'],1,'C');
      $Y2 = $pdf->getY();
      $pdf->Ln(0);
      $pdf->Cell(60);
      $donnéeAInjecter['CroixSituation'] = $this->ModeleUtilisateur->getCroixSLAM($numEtudiant = array('ref' => $UneSituation['ref']));
      foreach ($donnéeAInjecter['CroixSituation'] as $UneLigne) {
          if ($UneLigne['refSituation']) {
            $pdf->cell(6,$Y1-$Y2,"X",1,0,'C');
          }
          else {
            $pdf->cell(6,$Y1-$Y2,"",1,0,'C');
          }
        }
    $pdf->Ln(0);
  }
  //---------------------------------------------------------

  if (!(empty($LesSituationsPremiere))) {
  $pdf->Cell(90);
  $pdf->SetFont('Times','B',14);
  $pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "SITUATIONS VÉCUS EN STAGE DE PREMIÈRE ANNÉE DANS L'ORGANISATION"));
  $pdf->SetFont('Times','B',7);
  $pdf->Ln(10);
  foreach ($LesSituationsPremiere as $UneSituation) { //chaque ligne (situations vécu en formation)
    $Esttypo['LesActivites'] = $this->ModeleUtilisateur->getEstTypoWhereSituation($UneSituation['ref']);
    foreach ($Esttypo['LesActivites'] as $UneLigne) {
      if (!($UneLigne['codeTypologie'] == ""))
      {
        $pdf->cell(6,8,"X",1,0,'C');
      }
      else {
        $pdf->cell(6,8,"",1,0,'C');
      }
    }
    $Y1 = $pdf->getY();
    $pdf->MultiCell(36,4,iconv("UTF-8", "ISO-8859-1",$UneSituation['libcourt'])." \n ".$UneSituation['datedebut']." ".$UneSituation['datefin'],1,'C');
    $Y2 = $pdf->getY();
    $pdf->Ln(0);
    $pdf->Cell(60);
    $donnéeAInjecter['CroixSituation'] = $this->ModeleUtilisateur->getCroixSLAM($numEtudiant = array('ref' => $UneSituation['ref']));
    $test = 0;
    foreach ($donnéeAInjecter['CroixSituation'] as $UneLigne) {
        if ($UneLigne['refSituation']) {
          $pdf->cell(6,$Y1-$Y2,"X",1,0,'C');
        }
        else {
          $pdf->cell(6,$Y1-$Y2,"",1,0,'C');
        }
      }
    $pdf->Ln(0);
  }
}
//----------------------------------------------------------------
if (!(empty($LesSituationsDeuxieme))) {
$pdf->Cell(90);
$pdf->SetFont('Times','B',14);
$pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "SITUATIONS VÉCUS EN STAGE DE   DEUXIÈME ANNÉE DANS L'ORGANISATION"));
$pdf->SetFont('Times','B',7);
$pdf->Ln(10);
foreach ($LesSituationsDeuxieme as $UneSituation) { //chaque ligne (situations vécu en formation)
  $Esttypo['LesActivites'] = $this->ModeleUtilisateur->getEstTypoWhereSituation($UneSituation['ref']);
  foreach ($Esttypo['LesActivites'] as $UneLigne) {
    if (!($UneLigne['codeTypologie'] == ""))
    {
      $pdf->cell(6,8,"X",1,0,'C');
    }
    else {
      $pdf->cell(6,8,"",1,0,'C');
    }
  }
  $Y1 = $pdf->getY();
  $pdf->MultiCell(36,4,iconv("UTF-8", "ISO-8859-1",$UneSituation['libcourt'])." \n ".$UneSituation['datedebut']." ".$UneSituation['datefin'],1,'C');
  $Y2 = $pdf->getY();
  $pdf->Ln(0);
  $pdf->Cell(60);
  $donnéeAInjecter['CroixSituation'] = $this->ModeleUtilisateur->getCroixSLAM($numEtudiant = array('ref' => $UneSituation['ref']));
  $test = 0;
  foreach ($donnéeAInjecter['CroixSituation'] as $UneLigne) {
      if ($UneLigne['refSituation']) {
        $pdf->cell(6,$Y1-$Y2,"X",1,0,'C');
      }
      else {
        $pdf->cell(6,$Y1-$Y2,"",1,0,'C');
      }
    }
  $pdf->Ln(0);
}
}
		$pdf->Output();
?>
