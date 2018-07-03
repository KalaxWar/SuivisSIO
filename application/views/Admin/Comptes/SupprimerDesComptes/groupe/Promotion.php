<script type="text/javascript">
function dernierechance()
  {
        valide = confirm("Voulez vous vraiment supprimer ? :");
        return valide;
  }
</script><br><h4 align='center'>Suppression D'une Promotion</h4> <br>
<form  action="<?php site_url('prof/SupprimerDesComptes/1')?>" method="POST" onsubmit="return dernierechance()">
<input type="hidden" name="num" value="1">
<p> La suppression d'une promotion déréférence tous les élèves et professeurs concernés, mais sans les supprimer ni altérer leurs données</p>
      <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
        <th>Nom :</th> <th>Année :</th> <th>Option :</th><th>Promotion :</th>
          <?php foreach ($LesGroupes as $UnGroupe) {
            echo "<tr><td>".$UnGroupe['nom']."</td><td>".$UnGroupe['annee']."</td><td>".$UnGroupe['nomenclature']."</td><td> <input type='radio' name='numero[]' value=".$UnGroupe['num']."></td></tr>";
          } ?>
      </table>
      <p align='center'> <input type="submit" name="submit" value="Supprimer"> </p>
</form>
