<div class='col-sm-8' style="background-color:#6BD1FF;height:680px;"><br>

 <h4 align='center'>Export Des Mots De Passes Des Promotions</h4> <br>
<form  action="<?php site_url('Admin/ModifierDesComptes/2')?>" method="post">
<input type="hidden" name="num" value="1">
  <tr>
    <td colspan="3">
      <table class="table table-Info table-hover">
        <th>Nom :</th> <th>Année :</th> <th>Option :</th><th>Promotion :</th>
          <?php foreach ($LesGroupes as $UnGroupe) {
            echo "<tr><td>".$UnGroupe['nom']."</td><td>".$UnGroupe['annee']."</td><td>".$UnGroupe['nomenclature']."</td><td>".anchor('Admin/ExportMdp/'.$UnGroupe['nom'].'/'.$UnGroupe['num'],'Optenir le MDP des élèves')."</td></tr>";
          } ?>
      </table>
    </td>
  </tr>
</form>
