<form action="<?php site_url('Admin/ModifierDesComptes/3')?>" method="post">

<table width="80%" border="0" cellspacing="4" align="center">
<input type="hidden" name="num" value="1">
<tbody><tr>
        <td colspan="2" align='center'>
          <br> <h4>Liste élèves :</h4>
        </td>
      </tr>
      <tr>
        <table class="table table-Info table-hover">
          <th>Nom :</th> <th>Prénom :</th> <th>Mail :</th>
            <?php foreach ($LesEtudiants as $UnEtudiant) {
              echo "<tr><td>".$UnEtudiant['nom']."</td><td>".$UnEtudiant['prenom']."</td><td>".$UnEtudiant['mel']."</td></tr>";
            } ?>
        </table>
      </tr></table>
    </form>
