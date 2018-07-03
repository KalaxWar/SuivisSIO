<tr>
  <td colspan="5">
    Promotion(s) où intervient le professeur :
    <table width="100%" cellspacing="0" border='0'><tr>
        <?php
         foreach ($LesGroupes as $UnGroupe) {
          echo "<tr><td>".$UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '.$UnGroupe['nomenclature']."<input type='checkbox' name='chkGroupe[]' checked value=".$UnGroupe['numGroupe']."></td></tr>";
        }?>
