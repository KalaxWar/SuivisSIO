<style>
.ui-autocomplete {
  max-height: 100px;
  overflow-y: auto;
  /* prevent horizontal scrollbar */
  overflow-x: hidden;
}
/* IE 6 doesn't support max-height
 * we use height instead, but this forces the menu to always be this tall
 */
* html .ui-autocomplete {
  height: 100px;
}
</style>
<script>
$( function() {
$( "#datepicker1" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#datepicker2" ).datepicker({dateFormat: "yy-mm-dd"});
} );
function bouton() {
if(document.getElementById('o').checked) {
node = document.getElementById('situationOblig');
  // Contenu caché, le montrer
  node.style.visibility = "visible";
  node.style.height = "auto";			// Optionnel rétablir la hauteur
}
if(document.getElementById('n').checked) {
node = document.getElementById('situationOblig');
// Contenu caché, le montrer
node.style.visibility = "hidden";
node.style.height = "0";			// Optionnel rétablir la hauteur
}
}
</script>
<div class='col-sm-12' style="background-color:#6BD1FF;">
<br><br><h3 align='center'>Modification de la situation</h3>
<?php
if (isset($SituationSelect)) {
foreach ($SituationSelect as $UneSituation) {
$Libelle = $UneSituation['libcourt'];
$Description = $UneSituation['descriptif'];
$contexte = $UneSituation['contexte'];
$datedebut = $UneSituation['datedebut'];
$datefin = $UneSituation['datefin'];
$codeLocalisation = $UneSituation['codeLocalisation'];
$codeSource = $UneSituation['codeSource'];
$codeType = $UneSituation['codeType'];
$codeCadre = $UneSituation['codeCadre'];
$environnement = $UneSituation['environnement'];
$moyen = $UneSituation['moyen'];
$commentaire = $UneSituation['commentaire'];
}
}
else {
  $Libelle = null;
  $Description = null;
  $contexte = null;
  $datedebut = null;
  $datefin = null;
  $codeLocalisation = null;
  $codeSource = null;
  $codeType = null;
  $codeCadre = null;
  $environnement = null;
  $moyen = null;
  $commentaire = null;
}
echo form_open('professeur/modifierSituation');
echo form_hidden('num','1');
echo form_label("Libellé court : <span class=oblig>*</span>","txtLibelle");
$data = array(
   'type'  => 'text',
   'name'  => 'txtLibelle',
   'value' => $Libelle,
   'class' => 'form-control',
   'placeholder' => "Nom de la situation",
   'required' =>'required',
   'disabled' =>'disabled'
 );
echo form_input($data);

echo form_label("Description : <span class=oblig>*</span>","txtdescription");
$data = array(
   'type'  => 'textarea',
   'name'  => 'txtdescription',
   'value' => $Description,
   'class' => 'form-control',
   'rows' => '3',
   'placeholder' => "",
   'required' =>'required',
   'disabled' =>'disabled'
 );
echo form_textarea($data);

echo form_label("Contexte :","txtcontexte");
$data = array(
   'type'  => 'text',
   'name'  => 'txtcontexte',
   'value' => $contexte,
   'class' => 'form-control',
   'placeholder' => "",
   'disabled' =>'disabled'
 );
echo form_input($data);
echo '<br>';
echo '<div class="form-inline">';
echo '<p><b>Date de début : <span class=oblig>*</span></b> <input type="text" name="txtdatedebut" id="datepicker1" class="form-control" required placeholder="Cliquez pour séléctioner" value='.$datedebut.' disabled></p>';
echo '<p><b>Date de fin : <span class=oblig>*</span> </b> <input type="text" name="txtdatefin" id="datepicker2" class="form-control" required placeholder="Cliquez pour séléctioner" value='.$datefin.' disabled></p>';
echo '</div>';
echo '<table width=100%>
<tr>
  <td align="center">';

echo form_label("Localisation : <span class=oblig>*</span>","lstLocalisation");
echo '<select class="btn btn-info btn-sm" name="lstLocalisation" disabled>';
foreach ($Localisation as $UneLocalisation) {
echo "<option value='".$UneLocalisation['code']."'";
if ($UneLocalisation['code'] == $codeLocalisation) {
  echo "selected";
}
echo ">".$UneLocalisation['libelle']."</option>";
}
echo '</select></td>
  <hr>
    <td align="center">';

echo form_label("Cadre : <span class=oblig>*</span>","lstCadre");
echo '<select class="btn btn-info btn-sm" name="lstCadre" disabled>';
foreach ($Cadre as $UnCadre) {
echo "<option value='".$UnCadre['code']."'";
if ($UnCadre['code'] == $codeCadre) {
  echo "selected";
}
echo ">".$UnCadre['libelle']."</option>";
}
echo '</td>
      </select>
    <td align="center">';

echo form_label("Type : <span class=oblig>*</span>","lstType");
echo '<select class="btn btn-info btn-sm" name="lstType" disabled>';
foreach ($Type as $UnType) {
echo "<option value='".$UnType['code']."'";
if ($UnType['code'] == $codeType) {
  echo "selected";
}
echo ">".$UnType['libelle']."</option>";
}
echo '</select>';
echo' </td>
  </tr>
</table>
<hr>';

echo form_label("Environement technologique : ","txtEnvirTechno");
$data = array(
   'type'  => 'textarea',
   'name'  => 'txtEnvirTechno',
   'value' => $environnement,
   'class' => 'form-control',
   'rows' => '2',
   'placeholder' => "Avec quel logiciel ?",
   'disabled' =>'disabled'
 );
echo form_textarea($data);
echo form_label("Environnement matériel:","txtmoyen");
$data = array(
   'type'  => 'text',
   'name'  => 'txtmoyen',
   'value' => $moyen,
   'class' => 'form-control',
   'placeholder' => "Ordinateur perso/Ordinateur de l'entreprise/Chez l'habitant/Dans une société client...",
   'disabled' =>'disabled'
 );
echo form_input($data);
echo form_label("Commentaire :","txtcommentaire");
$data = array(
   'type'  => 'text',
   'name'  => $commentaire,
   'value' => set_value('txtcommentaire'),
   'class' => 'form-control',
   'rows' => '2',
   'placeholder' => "Ce champs sert a vous rappeler de votre situation lors de l'évaluation oral, dévrivez donc au mieux votre situation ici",
   'disabled' =>'disabled'
 );
echo form_textarea($data);
?>
<br><p align='center'>Est-ce une situation obligatoire ?
<label for="oui">Oui</label> <input type="radio" name="obligatoire" id="o" value="oui" onclick="bouton()" disabled <?php if (!(empty($typoSelect))) {
echo 'checked';
} ?>/>
<label for="non">Non</label> <input type="radio" name="obligatoire" id="n" value="non" onclick="bouton()" disabled <?php if (empty($typoSelect)) {
echo 'checked';
} ?>/></p>
<div class="" id='situationOblig' style=<?php if (empty($typoSelect)) {
echo '"visibility:hidden;">';
} ?>
<?php foreach ($LesTypologie as $UneTypologie) {
echo "<p><input type='checkbox' name='typologie[]'' disabled value='".$UneTypologie['code']."'";
if (isset($typoSelect)) {
foreach ($typoSelect as $UneTypo) {
  if ($UneTypologie['code'] == $UneTypo['codeTypologie']) {
    echo 'checked';
  }
}
}
echo ">".$UneTypologie['libelle'];
};
?>
</div>

</div></div>
