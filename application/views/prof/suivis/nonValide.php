<br>

  <?php

if ($LesSituationsNonValide==null) {
  echo "<h4 align='center'> Aucune Situation en attente d'être validé </h4>";
}
else {
  echo '<h4 align="center">Situation qui reste à valider</h4> <br>
  <table class="table table-Info table-hover" border="0" cellspacing="2" width="70%" align="center">
    <tr>
      <th width="25%">Nom prénom :</th><th width="25%">Classe :</th><th width="25%">Libellé de la situation :</th><th width="25%">Valide :</th>
    </tr>';
    foreach ($LesSituationsNonValide as $UneSituation) {
      echo '<tr><td>'.$UneSituation['nom']." ".$UneSituation['prenom'].'</td><td>BTS SIO '.$UneSituation['annee'].'</td><td>'.anchor('professeur/modifierSituation/0/'.$UneSituation['ref'],$UneSituation['libcourt'])."</td>";
      if ($UneSituation['valide'] == "V") {
        echo "<td style='color: #009909;'>Validé</td></tr>";
      }
      if ($UneSituation['valide'] == "I") {
        echo "<td class='oblig'>Non Valide</td></tr>";
      }
      if ($UneSituation['valide'] == "N") {
        echo "<td style='color: #954848;'>En attente</td></tr>";
      }
    }
}

  ?>
</table>
