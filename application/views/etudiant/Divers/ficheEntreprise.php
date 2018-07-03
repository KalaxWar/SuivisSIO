<br>
<h2 align='center'><?php echo $UneEntreprise['nom'];?></h2>
<br>
<h4>Informations <b>connu</b> sur l'entreprise :</h4>
<p>- Adresse postale de l'entreprise : <?php echo $UneEntreprise['adresse'].' '.$UneEntreprise['cp'].' '.$UneEntreprise['ville']; ?></p>
<?php if (!($UneEntreprise['email'] == null)) {
  echo "<p>- Email de l'entreprise : ".$UneEntreprise['email'];
} ?>
<?php if (!($UneEntreprise['telephone'] == null)) {
  echo "<p>- Numéro de téléphone de l'entreprise : ".$UneEntreprise['telephone'];
} ?>
<?php if (!($UneEntreprise['noimmatriculation'] == null)) {
  echo "<p>- Numéro de SIRET de l'entreprise : ".$UneEntreprise['noimmatriculation'];
} ?>
<?php if (!($UneEntreprise['fax'] == null)) {
  echo "<p>- Numéro de FAX de l'entreprise : ".$UneEntreprise['fax'];
} ?>
<p>- Secteur d'activité de l'entreprise : <?php echo $Secteur['nom']; ?> </p>
<br><br>
<h4>Les Stages Effectué dans cette entreprise :</h4>
<table class="table table-Info table-hover">
  <th>Date du stage</th><th>Etudiant</th><th>Orientation</th><th>Année de bts</th><th>Contact :</th>
  <?php foreach ($LesStages as $UnStage) {
    echo '<tr><td>'.$UnStage['datedebut'].'</td><td>'.$UnStage['nom'].' '.$UnStage['prenom'].'</td><td>'.$UnStage['nomenclature'].'</td>';
    if ($UnStage['codeSource'] == '2') {echo '<td>Première année</td>';}
    if ($UnStage['codeSource'] == '3') {echo '<td>Deuxième année</td>';}
    echo '<td>';
    foreach ($LesContacts as $UnContact) {
      if ($UnStage['nocontact'] == $UnContact['nocontact']) {
echo '<p>Représentant : <a data-toggle="modal" data-target="#'.$UnContact['nocontact'].'"><span style="color:#337ab7;text-decoration: underline;">'.$UnContact['nom'].'</span></a></p>';
      }
      if ($UnStage['nocontact_tuteur'] == $UnContact['nocontact']) {
echo '<p>Tuteur : <a data-toggle="modal" data-target="#'.$UnContact['nocontact'].'"><span style="color:#337ab7;text-decoration: underline;">'.$UnContact['nom'].'</span></a></p>';
      }
      echo '<div class="modal fade" id="'.$UnContact['nocontact'].'" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Informations sur le contact <b><u>'.$UnContact['nom'].'</u></b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p> email  : '.$UnContact['email'].'</p>
              <p> Telephone portable : '.$UnContact['telportable'].'</p>
              <p> Telephone fixe : '.$UnContact['telfixe'].'</p>
              <p> Fonction  : '.$UnContact['fonction'].'</p>
              <p> diplôme obtenu : '.$UnContact['diplome'].'</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </div>

        </div>
      </div>';
    }
    echo '</td>';
  } ?>
</table>
