<h3 align='center'>Modification d'un stage</h3>
<br><br>
<p>Liste de vos stages que vous pouvez modifier :</p>
<?php
foreach ($LesStages as $UnStage) {
echo '<a href='.site_url('etudiant/modifierStage/'.$UnStage['nostage'].'/').'><p>'.$UnStage['nom'].' '.$UnStage['ville'].'</p></a>';
}
 ?>
