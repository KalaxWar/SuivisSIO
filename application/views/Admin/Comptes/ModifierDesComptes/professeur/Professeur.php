<form action="<?php site_url('Admin/ModifierDesComptes/2')?>" method="post">

<table width="80%" border="0" cellspacing="3" align="center">
<input type="hidden" name="num" value="1">
<tbody><tr>
        <td colspan="2" align='center'>
          <br> <h4>Modification D'un Professeur</h4>
        </td>
      </tr>
      <tr>
        <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
          <th>Nom :</th> <th>Prenom :</th> <th>Mail :</th> <th>Niveau</th> <th>Professeur :</th>
            <?php foreach ($LesProfesseurs as $UnProfesseur) {
              echo "<tr><td>".$UnProfesseur['nom']."</td><td>".$UnProfesseur['prenom']."</td><td>".$UnProfesseur['mel']."</td><td>".$UnProfesseur['niveau']."</td><td>".anchor('Admin/ModifierDesComptes/2/'.$UnProfesseur['num'],'Modifier')."</td></tr>";
            } ?>
        </table>
      </tr></table>
    </form>
