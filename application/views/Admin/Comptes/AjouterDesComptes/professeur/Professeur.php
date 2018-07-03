  <form action="<?php site_url('Admin/AjouterDesComptes/2')?>" method="post">
<table width="80%" border="0" cellspacing="3" align="center">
<input type="hidden" name="num" value="1">
<tbody><tr>
        <td colspan="2">
          <h4>Création d'un professeur</h4>
          <p><span class="oblig">*</span> = champ obligatoire</p>
          <p>Pour affecter un professeur à une ou plusieurs promotions, vous devez préalablement créés la/les promotion(s).<br></p>
        </td>
      </tr>


            <tr>
        <td colspan="2">
          <hr>
        </td>
      </tr>
      <tr>
        <td width="54%">Nom <span class="oblig">*</span> :
          <input type="text" name="nom" size="20" maxlength="32" pattern="^[a-zA-Z]+$" title="Des lettres Uniquement" required>        </td>
        <td width="46%">Prénom <span class="oblig">*</span> :
          <input type="text" name="prenom" size="20" maxlength="32" pattern="^[a-zA-Z]+$" title="Des lettres Uniquement" required>        </td>
      </tr>
      <tr>
        <td width="54%">Adresse mél <span class="oblig">*</span> :
          <input type="text" name="mel" size="32" maxlength="64" pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' title="Mettre une adresse mail valide" required>        </td>

        <td width="46%">Niveau :

          <select name="niveau">
              <option value="1">professeur</option>
              <option value="2">lecteur</option>
          </select>
        </td>
        </tr>
      <tr>
        <td colspan="2">
          Promotion(s) où intervient le professeur :
          <table width="100%" cellspacing="0" border='0'>
              <?php
               foreach ($LesGroupes as $UnGroupe) {
                echo "<tr><td>".$UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '.$UnGroupe['nomenclature']."<input type='checkbox' name='chkGroupe[]' value=".$UnGroupe['num']."></td></tr>";
              } ?>
                  </table>
        </td>
      </tr>
      <tr>
        <td colspan="2"><br>
          <hr>

        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="centrer">
            <input type="submit" name="envoi" value="Enregistrer">
                      </div>
        </td>
    </tbody></table>
    </form>
