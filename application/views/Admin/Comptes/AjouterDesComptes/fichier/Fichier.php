<form action="<?php site_url('Admin/AjouterDesComptes/4')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<table width="80%" border="0" cellspacing="0" align='center'>
  <input type="hidden" name="num" value="1">
  <tr>
        <td>
          <br>
          <p align='center'>Rappel : le type d'encodage du document CSV : << utf-8 >> </p>
          <p align='center'>Uniquement les fichiers de type CSV sont accepté</p>
          <p align='center'>nom;prénom;adresse_mail</p>
          <hr>
        </td>
      </tr>
      <tr>
        <td>
          <div class="centrer">Promotion :
            <select name="groupe">
              <option value="0" selected="">-- CHOISIR --</option>
              <?php
               foreach ($LesGroupes as $UnGroupe) {
                echo "<option value=".$UnGroupe['num'].">".$UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '.$UnGroupe['nomenclature']."</option>";
              } ?>
            </select>
        </td>
      </tr><tr>
        <td width="65%" class="normal">
          <div class="centrer">
            Fichier à téléverser :
              <input type="file" size="20" name="file" id='file' required>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="centrer">
            <input type="submit" name="envoi" value="Enregistrer">
          </div>
        </td>
      </tr></table>
    </form>
