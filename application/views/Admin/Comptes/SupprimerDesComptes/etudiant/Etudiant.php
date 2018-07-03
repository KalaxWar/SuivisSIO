<script type="text/javascript">
  function dernierechance()
    {
          valide = confirm("Voulez vous vraiment supprimer ? :");
          return valide;
    }
  </script>
<form action="<?php site_url('Admin/ModifierDesComptes/3')?>" method="post" onsubmit="return dernierechance()">

<table width="100%" border="0" cellspacing="3" align="center">
<input type="hidden" name="num" value="1">
<tbody><tr>
        <td colspan="2" align='center'>
          <br> <h4>Suppression D'un Etudiant</h4>
        </td>
      </tr>
      <tr>
        <td> <br> <p >La suppression d'un étudiant entraine la <span class="oblig"> destruction du compte, des productions, des compétences, des appréciations ainsi que les validations </span></p>
            <p class="oblig"> ATTENTION La suppression est définitive et irréversible !</p>
        </td>
      </tr>
      <tr>
        <table class="table table-Info table-hover" border="0" cellspacing="3" width="70%" align='center'>
          <th>Nom :</th> <th>Prenom :</th> <th>Mail :</th> <th>Etudiant :</th>
            <?php foreach ($LesEtudiants as $UnEtudiant) {
              echo "<tr><td>".$UnEtudiant['nom']."</td><td>".$UnEtudiant['prenom']."</td><td>".$UnEtudiant['mel']."</td><td> <input type='radio' name='numero[]' value=".$UnEtudiant['num']."></td></tr>";
            } ?>
        </table>
      </tr></table>
      <p align='center'> <input type="submit" name="submit" value="Supprimer"> </p>
    </form>
