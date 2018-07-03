<?php echo "<br><h4 align='center'><span style='color: #C40000;'>Situation en cours : <b>".$Situation." </span></b>"; ?>
<script type="text/javascript">
  function dernierechance()
    {
          valide = confirm("Voulez vous vraiment invalider la situation ? Sachant que vous l'avez au paravant déjà validé");
          return valide;
    }
</script>
<?php
if (!($Valide == 'V')) {
 echo "<a href=".site_url('professeur/ValiderSituation/')."><button type='submit' name='ah' class='btn btn-success'>Valider la situation</button></a>";
 }?>
<?php echo "<a href=".site_url('professeur/InvaliderSituation/')."><button type='submit' name='ah' class='btn btn-danger'";
if ($Valide == 'V') {
  echo "onclick='return dernierechance()'";
}
echo "> Invalider la situation</button></a></h4>"; ?>
<ul class="nav nav-tabs nav-justified">
<li class="nav-item"><?php $action="2"; echo anchor("professeur/modifierSituation/".$action,"Description");?></li>
  <li class="nav-item"><?php $action="3"; echo anchor("professeur/modifierSituation/".$action,"Activité");?></li>
  <li class="nav-item"><?php $action="4"; echo anchor("professeur/modifierSituation/".$action,"Reformulation");?></li>
  <li class="nav-item"><?php $action="5"; echo anchor("professeur/modifierSituation/".$action,"Commentaire prof");?></li>
</ul>
