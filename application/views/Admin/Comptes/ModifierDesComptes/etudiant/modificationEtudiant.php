<form  action="<?php site_url('Admin/ModifierDesComptes/3')?>" method="post">
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
        Nom <span class="oblig">*</span>:<input type="text" name="nom" size="5" maxlength="15" pattern="^[a-zA-Zéèêëçàâôù üûïî']*$" required title="Des lettres Uniquement" value="<?php echo $UnEtudiant['nom'];?>">
      </p>
    </td>
    <td>
        <p>Prénom <span class="oblig">*</span> :<input type="text" name="prenom" size="5" pattern="^[a-zA-Zéèêëçàâôù üûïî']*$" required title="Des lettres Uniquement" value="<?php echo $UnEtudiant['prenom'];?>">
        </p>
    </td>
    <td>
      <p>
        Adresse Mail <span class="oblig">*</span>:<input type="text" name="mel" size="17" maxlength="32" pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' title="Mettre une adresse mail valide" required value="<?php echo $UnEtudiant['mel']; ?>">
      </p>
    </td>
    <td>
      <p>
        Mot de passe <span class="oblig">*</span>:<input type="password" name="mdp" size="10" maxlength="12"  required title="" value="<?php echo $UnEtudiant['mdp']; ?>">
      </p>
    </td>
    <td align='top'>
      <p> Promotion :
        <select name="groupe">
          <option value="null" selected="">-- aucun --</option>
          <?php
           foreach ($LesGroupes as $UnGroupe) {
            echo "<option value='".$UnGroupe['num']."'"; if ($UnEtudiant['numGroupe'] == $UnGroupe['num'] ) {
              echo "Selected";
            } echo '>';
            echo $UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '
            .$UnGroupe['nomenclature']."</option>";
          } ?>
        </select>
      </p>
    </td>
  </tr>
  <tr>
  <td colspan="5">
  <hr>
  </td>
  </tr>
  <tr>
  <td align='center' colspan="5">
  <input  type="submit" name="envoi" value="Modifier">
  </td>
  </tr>
</table>
</form>
