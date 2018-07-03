  <form action="<?php site_url('Admin/ModifierDesComptes/3')?>" method="post">

<table width="80%" border="0" cellspacing="3" align="center">
<input type="hidden" name="num" value="1">
<tr>
        <td colspan="2" align='center'>
          <br> <h4>Modification D'un Etudiant</h4>
        </td>
      </tr>
      <tr>
        <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
          <th>Nom :</th> <th>Prenom :</th> <th>Mail :</th> <th>Etudiant :</th>
            <?php foreach ($LesEtudiants as $UnEtudiant) {
              echo "<tr><td>".$UnEtudiant['nom']."</td><td>".$UnEtudiant['prenom']."</td><td>".$UnEtudiant['mel']."</td><td>".anchor('Admin/ModifierDesComptes/3/'.$UnEtudiant['num'],'Modifier')."</td></tr>";
            } ?>
        </table>
      </tr></table>
    </form>
