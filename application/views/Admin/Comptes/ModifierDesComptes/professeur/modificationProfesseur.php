<form  action="<?php site_url('Admin/ModifierDesComptes/2')?>" method="post">
<input type="hidden" name="num" value="1">
<table border="0" cellspacing="3" width="95%" align='center'>
  <tr>
  <td colspan="5">
    <hr>
  </td>
  </tr>
  <tr>
    <td>
      <p>
        Nom <span class="oblig">*</span>:<input type="text" name="nom" size="5" maxlength="15" pattern="^[a-zA-Z]+$" required title="Des lettres Uniquement" value="<?php foreach ($UnProf as $UnProfesseur) {
          echo $UnProfesseur['nom'];
        } ?>">
      </p>
    </td>
    <td>
        <p>Prénom <span class="oblig">*</span> :<input type="text" name="prenom" size="5" pattern="^[a-zA-Z]+$" required title="Des lettres Uniquement" value="<?php foreach ($UnProf as $UnProfesseur) {
          echo $UnProfesseur['prenom'];
        } ?>">
        </p>
    </td>
    <td>
      <p>
        Adresse Mail <span class="oblig">*</span>:<input type="text" name="mel" size="17" maxlength="32" pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' title="Mettre une adresse mail valide" required value="<?php foreach ($UnProf as $UnProfesseur) {
          echo $UnProfesseur['mel'];
        } ?>">
      </p>
    </td>
    <td>
      <p>
        Mot de passe <span class="oblig">*</span>:<input type="password" name="mdp" size="10" maxlength="12"  required title="" value="<?php foreach ($UnProf as $UnProfesseur) {
          echo $UnProfesseur['mdp'];
        } ?>">
      </p>
    </td>
    <td align='top'>
      <p> Niveau :
        <?php foreach ($UnProf as $UnProfesseur) {
          $valeur = $UnProfesseur['niveau'];
        } ?>
        <select name="niveau">
          <option value="1" <?php if ($valeur == 1) {
          echo "Selected='Selected'";
        } ?>>Professeur</option>
          <option value="2" <?php if ($valeur == 2) {
          echo "Selected='Selected'";}?>>Lecteur</option>
        </select>
      </p>
    </td>
  </tr>
