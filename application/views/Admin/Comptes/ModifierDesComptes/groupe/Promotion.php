<br><h4 align='center'>Modification D'une Promotion</h4> <br>
<form  action="<?php site_url('Admin/ModifierDesComptes/2')?>" method="post">
<input type="hidden" name="num" value="1">
  <tr>
    <td colspan="3">
      <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
        <th>Nom :</th> <th>Année :</th> <th>Option :</th><th>Promotion :</th>
          <?php foreach ($LesGroupes as $UnGroupe) {
            echo "<tr><td>".$UnGroupe['nom']."</td><td>".$UnGroupe['annee']."</td><td>".$UnGroupe['nomenclature']."</td><td>".anchor('Admin/ModifierDesComptes/1/'.$UnGroupe['num'],'Modifier')."</td></tr>";
          } ?>
      </table>
    </td>
  </tr>
</form>
