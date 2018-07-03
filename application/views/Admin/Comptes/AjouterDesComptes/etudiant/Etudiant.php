  <form action="<?php site_url('Admin/AjouterDesComptes/3')?>" method="post">
<input type="hidden" name="num" value="1">

	<table width="80%" border="0" cellspacing="3" align="center">
<tr>
        <td colspan="2">
          <h4>Création d'un étudiant</h4>
					<p> <span class="oblig">*</span> = champ obligatoire </p>
          <p>Pour affecter un étudiant à une promotion, vous devez préalablement
            créée la promotion.<br></p>
        </td>
      </tr>


      <tr>
        <td colspan="2">
          <hr>
        </td>
      </tr>
      <tr>
        <td width="54%">Nom <span class="oblig">*</span> :
          <input type="text" name="nom" size="20" maxlength="32" pattern="^[a-zA-Zéèêëçàâôù üûïî']*$" title="Des lettres Uniquement" required>        </td>
        <td width="46%">Prénom <span class="oblig">*</span> :
          <input type="text" name="prenom" size="20" maxlength="32" pattern="^[a-zA-Zéèêëçàâôù üûïî']*$" title="Des lettres Uniquement" required>        </td>
      </tr>
            <tr>
        <td width="54%">Adresse mél <span class="oblig">*</span> :
          <input type="text" name="mel" size="32" maxlength="64" pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' title="Mettre une adresse mail valide" required>       </td>
        <td width="46%">Promotion :
          <select name="groupe">
            <option value="0" selected="">-- aucun --</option>
            <?php
             foreach ($LesGroupes as $UnGroupe) {
              echo "<option value=".$UnGroupe['num'].">".$UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '.$UnGroupe['nomenclature']."</option>";
            } ?>
          </select>
        </td>
      </tr>


	  <tr><td colspan="2"><br><hr></td></tr>

      <tr>
        <td colspan="2">
            <input type="submit" name="envoi" value="Enregistrer">
                      </div>
        </td>
      </tr></table>
      </form>
