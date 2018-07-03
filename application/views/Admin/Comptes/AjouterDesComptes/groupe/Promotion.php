<form  action="<?php site_url('Admin/AjouterDesComptes/1')?>" method="post">
<input type="hidden" name="num" value="1">
<table border="0" cellspacing="3" width="80%" align='center'>
  <tr>
    <td colspan="3">
      <h4>Création d'une promotion</h4>
      <p> <span class="oblig">*</span> = champ obligatoire </p>
      <p> Une promotion correspond à un ensemble d'étudiants suivis par un ensemble de professeurs. Typiquement, il s'agit d'une promotion.
      Un étudiant ne peut appartenir qu'à une seule promotion (mais peut en changer) ; un professeur peut intervenir dans plusieurs promotions.
      </p>
    </td>
  </tr>
  <td colspan="3">
    <hr>
  </td>
  </tr>
  <tr>
    <td>
        <p>Année d'optention du BTS de la promotion <span class="oblig">*</span> :<input type="text" required name="annee" size="4" pattern="^\d{4}$" title="exemple : 2018"><br>
        </p>
    </td>
  </tr>
  <tr>
  <td colspan="3">
    <hr>
  </td>
  </tr>
  <tr>
    <td colspan="3">
        <input type="submit" name="envoi" value="Enregistrer">
    </td>
  </tr>
</table>
</form>
