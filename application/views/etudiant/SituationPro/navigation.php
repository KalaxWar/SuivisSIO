<?php if (isset($Situation)): ?>
    <?php echo "<br><h4 align='center'><span style='color: #C40000;'>Situation en cours : <b>".$Situation."</span></b></h4>"; ?>
  <?php endif; ?>
<ul class="nav nav-tabs nav-justified">
<li class="nav-item"><?php $action="2"; echo anchor("Etudiant/NouvelleSituation/".$action,"Description");?></li>
<?php if (isset($Situation)) {?>
  <li class="nav-item"><?php $action="3"; echo anchor("Etudiant/NouvelleSituation/".$action,"Activité");?></li>
  <li class="nav-item"><?php $action="4"; echo anchor("Etudiant/NouvelleSituation/".$action,"Reformulation");?></li>
  <li class="nav-item"><?php $action="5"; echo anchor("Etudiant/NouvelleSituation/".$action,"Commentaire prof");?></li>
 <?php
} else { ?>
  <li class="nav-item disabled "><a href="#">Activité</a></li>
  <li class="nav-item disabled"><a href="#">Reformulation</a></li>
  <li class="nav-item disabled"><a href="#">Production</a></li>
  <li class="nav-item disabled"><a href="#">Commentaire prof</a></li>
<?php }  ?>
</ul>
