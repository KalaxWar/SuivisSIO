<form  action="<?php site_url('Admin/ModifierDesComptes/1')?>" method="post">
<input type="hidden" name="num" value="1">
<table border="0" cellspacing="3" width="80%" align='center'>
  <tr>
  <td colspan="3">
    <hr>
  </td>
  </tr>
  <tr>
    <td>
        <p> <br><br> Année de la promotion <span class="oblig">*</span> : <br><input required type="text" name="annee" size="5" pattern="^\d{4}$" title="Exemple : 2018" value="<?php foreach ($LesGroupes as $UnGroupe) {
          echo $UnGroupe['annee'];
        } ?>"><br>
            (Exemple 2012)
        </p>
    </td>
    <td align='top'>
      <p> Parcours :
        <?php foreach ($LesGroupes as $UnGroupe) {
          $valeur = $UnGroupe['idParcours'];
        } ?>
        <select name="parcours">
          <option value="0" <?php if ($valeur == 0) {
          echo "Selected='Selected'";
          } ?>>Indifférencié</option>
          <option value="1" <?php if ($valeur == 1) {
          echo "Selected='Selected'";}?>>SISR</option>
          <option value="2" <?php if ($valeur == 2) {
          echo "Selected='Selected'";}?>>SLAM</option>
        </select>
      </p>
    </td>
  </tr>
  <tr>
  <td colspan="3">
    <hr>
  </td>
  </tr>
  <tr>
    <td align='center' colspan="3">
        <input  type="submit" name="envoi" value="Modifier">
    </td>
  </tr>
</table>
</form>
</div>
</div>
</div>
