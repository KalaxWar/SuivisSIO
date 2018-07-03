<script type="text/javascript">
function dernierechance()
  {
        valide = confirm("Voulez vous vraiment supprimer ? cela entrainera la perte définitive de la situation !! :");
        return valide;
  }
</script>
<h3 align='center'>Modification d'une Situation</h3>
<br><br>
</td>
</tr>
<tr>
<table class="table table-Info table-hover" border="0" width="70%" align='center'>
 <th>Nom situation :</th> <th>Date debut :</th> <th>Date fin :</th> <th>Modification possible :</th><th> Validation :</th>
   <?php foreach ($LesSituations as $UneSituation) {
     echo "<tr><td>".$UneSituation['libcourt']."</td><td>".$UneSituation['datedebut']."</td><td>".$UneSituation['datefin']."</td><td>
     <a href=".site_url('etudiant/NouvelleSituation/0/'.$UneSituation['ref'].'/')."><button type='submit' name='ah' class='btn btn-success'>Modifier</button></a>
     <a href=".site_url('etudiant/SupprimerSituation/'.$UneSituation['ref'].'/')."><button type='submit' name='ah' class='btn btn-danger' onclick='return dernierechance()'>Supprimer</button></a></td>";
     if ($UneSituation['valide'] == "V") {
       echo "<td style='color: #009909;'>Validé</td></tr>";
     }
     if ($UneSituation['valide'] == "I") {
       echo "<td class='oblig'>Non Valide</td></tr>";
     }
     if ($UneSituation['valide'] == "N") {
       echo "<td style='color: #954848;'>En attente</td></tr>";
     }
   } ?>
   <p></p>
</table>
