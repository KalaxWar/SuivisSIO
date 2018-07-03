<br>
<div class="dropdown" align='center'>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      <?php
      if (isset($option)) {

      }
      else {
        echo "Choisiser l'option du stage";
      } ?>
    </button>
    <div class="dropdown-menu">
      <?php  echo '<a class="dropdown-item" href='.site_url('Etudiant/AfficherEntreprise/SLAM').'>SLAM</a>'; ?>
      <?php  echo '<a class="dropdown-item" href='.site_url('Etudiant/AfficherEntreprise/SISR').'>SISR</a>'; ?>
    </div>
  </div>
  <br><br>
<table class="table table-Info table-hover">
  <th>Nom de l'entreprise</th><th>Ville</th><th>Orientation du stage</th><th>Métier de l'entreprise</th><th></th>
  <?php
  $nomEntreprise = "";
  $option ="";
foreach ($LesEntreprises as $UneEntreprise) {
  if (!($UneEntreprise['nom'] == $nomEntreprise)) {
    $nomEntreprise = $UneEntreprise['nom'];
    $option = $UneEntreprise['nomenclature'];
    $connaissance = "";
    echo '<tr><td><a href='.site_url('Etudiant/FicheEntreprise/'.$UneEntreprise['noentreprise']).'>'.$UneEntreprise['nom'].'</a></td><td>'.$UneEntreprise['ville'].'</td><td>'.$UneEntreprise['nomenclature'].'</td>';
    foreach ($LesConnaissances as $UneConnaissance) {
      if ($UneConnaissance['nostage'] == $UneEntreprise['nostage']) {
        $connaissance .= $UneConnaissance['libelle'].' | ';
      }
    }
    echo '<td>'.$connaissance.'</td>';
  }
  }

   ?>
</table>
