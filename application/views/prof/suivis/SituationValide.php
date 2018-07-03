<br>
<table class="table table-Info table-hover" border="0" cellspacing="2" width="70%" align='center'>
  <?php
  if ($LesSituationsValide == null) {
    echo "<h4 align='center'>Aucune situation de validé</h4>";
  }
  else {
    echo '<h4 align="center">Situation qui sont déjà validé</h4> <br>
          <tr>
            <th width="33%">Nom prénom :</th><th width="33%">Classe :</th><th width="33%">Libellé de la situation :</th>
          </tr>';
    foreach ($LesSituationsValide as $UneSituation) {
      echo '<tr><td>'.$UneSituation['nom']." ".$UneSituation['prenom'].'</td><td>BTS SIO '.$UneSituation['annee'].'</td><td>'.anchor('professeur/modifierSituation/0/'.$UneSituation['ref'],$UneSituation['libcourt'])."</td></tr>";
    }
  }

 ?>
</table>
