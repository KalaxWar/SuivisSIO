<br><br>
<?php echo form_open('professeur/modifierSituation/5');?>
<?php
foreach ($LeCommentaire as $UnCommentaire) {
echo form_label("Commentaire laissé par le professeur ".$UnCommentaire['nom']." : ","txtCommentaire");
$data = array(
     'type'  => 'textarea',
     'name'  => "txtCommentaire",
     'value' => $UnCommentaire['commentaire'],
     'class' => 'form-control',
     'rows' => '3',
     'placeholder' => "",
     'disabled' =>'disabled'
   );
echo form_textarea($data);
echo "<p align='center'> Date de modification : ".$UnCommentaire['datecommentaire'].'</p>';
}
 ?>
