<?php echo form_open('etudiant/NouvelleSituation/4');?>
<?php
foreach ($LesActivites as $UneActivite) {
  foreach ($LesActivitesCitee as $UneActiviteCitee) {
    if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
      echo '<br><br><h4>'.$UneActivite['nomenclature'].'. '.$UneActivite['libcourt'].'</h4><br>';
    foreach ($LesCompétences as $UneCompétence) {
      if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
        if ($UneCompétence['idActivite'] == $UneActivite['id']) {
        echo $UneCompétence['nomenclature'].'. '.$UneCompétence['libelle'].'<br><br>';
        }
      }
    }
    echo form_label("Votre reformulation de cette activité : ","txtreformu[".$UneActivite['id']."]");
    $data = array(
         'type'  => 'textarea',
         'name'  => "txtreformu[".$UneActivite['id']."]",
         'value' => $UneActiviteCitee['commentaire'],
         'class' => 'form-control',
         'rows' => '2',
         'placeholder' => "",
       );
    echo form_textarea($data);
  }
}}
 ?>
<br><p align='center'><input type="submit" name="Envoyer" class="btn btn-outline-primary btn-sm" value="Valider"></p>
