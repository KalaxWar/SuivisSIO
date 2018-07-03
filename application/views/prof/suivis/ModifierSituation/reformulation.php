<?php
foreach ($LesActivites as $UneActivite) {
  foreach ($LesActivitesCitee as $UneActiviteCitee) {
    if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
      echo '<br><br><h4>'.$UneActivite['nomenclature'].'. '.$UneActivite['libelle'].'</h4><br>';
    foreach ($LesCompétences as $UneCompétence) {
      if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
        if ($UneCompétence['idActivite'] == $UneActivite['id']) {
        echo $UneCompétence['nomenclature'].'. '.$UneCompétence['libelle'].'<br><br>';
        }
      }
    }
    echo form_label("Reformulation de l'étudiant : ","txtreformu[".$UneActivite['id']."]");
    $data = array(
         'type'  => 'textarea',
         'name'  => "txtreformu[".$UneActivite['id']."]",
         'value' => $UneActiviteCitee['commentaire'],
         'class' => 'form-control',
         'rows' => '2',
         'placeholder' => "",
         'disabled'=>'disabled'
       );
    echo form_textarea($data);
  }
}}
 ?>
<br>
