<h4 align='center'>Export Des Mots De Passes Des Promotions</h4> <br>
<form  action="<?php site_url('Admin/ModifierDesComptes/2')?>" method="post">
<input type="hidden" name="num" value="1">
  <tr>
    <td colspan="3">
      <table class="table table-Info table-hover">
        <th>Nom :</th> <th>Année :</th> <th>Option :</th><th>Promotion :</th>
          <?php foreach ($LesGroupes as $UnGroupe) {
            echo "<tr><td>".$UnGroupe['nom']."</td><td>".$UnGroupe['annee']."</td><td>".$UnGroupe['nomenclature']."</td><td>".anchor('professeur/ExportMdp/'.$UnGroupe['nom'].'/'.$UnGroupe['numGroupe'],'Optenir le MDP des élèves')."</td></tr>";
          } ?>
      </table>
    </td>
  </tr>
</form>
