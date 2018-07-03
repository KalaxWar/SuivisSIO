<script type="text/javascript">
function dernierechance()
  {
        valide = confirm("Voulez vous vraiment supprimer ? :");
        return valide;
  }
</script>
  <form  action="<?php site_url('prof/SupprimerDesComptes/2')?>" method="POST" onsubmit="return dernierechance()">
    <table width="100%" border="0" cellspacing="3" align="center">
      <input type="hidden" name="num" value="1">
      <tr>
        <td colspan="2" align='center'>
          <br> <h4>Suppression D'un Professeur</h4>
        </td>
      </tr>
      <tr>
        <td> <br> <p>La suppression d'un professeur entraine : </p>
          <ol>
            <li class="oblig">La destruction du compte et ses appartenances à des promotions</li>
            <li>Le déréférencement de ses validations et appréciations. Elles sont conservées mais elles deviennent 'anonyme'.</li>
            <li class="oblig"> La suppression est définitive et irréversible !</li>
          </ol>
        </td>
      </tr>
      <tr>
        <td>
          <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
            <th>Nom :</th> <th>Prenom :</th> <th>Mail :</th> <th>Commentaire</th> <th>Professeur :</th>
              <?php foreach ($LesProfesseurs as $UnProfesseur) {
                echo "<tr><td>".$UnProfesseur['nom']."</td><td>".$UnProfesseur['prenom']."</td><td>".$UnProfesseur['mel']."</td><td>".$UnProfesseur['nombre']."</td><td> <input type='radio' name='numero[]' value=".$UnProfesseur['num']."></td></tr>";
              } ?>
          </table>
        </td>
      </tr>
    </table>
    <p align='center'> <input type="submit" name="submit" value="Supprimer"> </p>
  </form>
