<br><br>
<?php echo form_open('professeur/modifierSituation/5');?>
<?php
echo form_label("Laisser un commentaire à l'élève sur sa situation : ","txtCommentaire");
$data = array(
     'type'  => 'textarea',
     'name'  => "txtCommentaire",
     'value' => $LeCommentaire['commentaire'],
     'class' => 'form-control',
     'rows' => '3',
     'placeholder' => ""
   );
echo form_textarea($data);
echo "<p align='center'> Date de modification : ".$LeCommentaire['datecommentaire'].'</p>';
 ?>
 <input type="hidden" name="num" value="1">
<br><p align='center'><input type="submit" name="Envoyer" class="btn btn-outline-primary btn-sm" value="Ajouter / modifier"></p>
