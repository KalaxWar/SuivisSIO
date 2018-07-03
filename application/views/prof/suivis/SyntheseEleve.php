<br>
<table class="table table-Info table-hover" border="0" cellspacing="2" width="70%" align='center'>
  <?php
    echo '<h4 align="center">Synthèses des élèves</h4> <br>
          <tr>
            <th width="60%">Nom prénom :</th><th width="40%">Synthèses</th>
          </tr>';
    foreach ($LesEtudiants as $UnEtudiant) {
      echo '<tr><td>'.$UnEtudiant['nom']." ".$UnEtudiant['prenom'].'</td><td>'.anchor('Synthese/SyntheseEleve/'.$UnEtudiant['num'],'Voir')."</td></tr>";
    }

 ?>
</table>
