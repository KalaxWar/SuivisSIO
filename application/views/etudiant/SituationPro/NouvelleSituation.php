<script>
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
<?php
if (isset($SituationSelect)) {
echo "<br><br><h3 align='center'>Modification de la situation</h3>";
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
  echo "<br><br><h3 align='center'>Ajouter une situation</h3>";
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
echo form_open('etudiant/NouvelleSituation/');
echo form_hidden('num','1');
echo form_label("Libellé court : <span class=oblig>*</span>","txtLibelle");
$data = array(
   'type'  => 'text',
   'name'  => 'txtLibelle',
   'value' => $Libelle,
   'class' => 'form-control',
   'placeholder' => "Nom de la situation",
   'required' =>'required'
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
   'required' =>'required'
 );
echo form_textarea($data);

echo form_label("Contexte :","txtcontexte");
$data = array(
   'type'  => 'text',
   'name'  => 'txtcontexte',
   'value' => $contexte,
   'class' => 'form-control',
   'placeholder' => ""
 );
echo form_input($data);
echo '<br>';
echo '<div class="form-inline">';
echo '<p>Date de début du stage: <span class=oblig>*</span> <input type="date" name="txtdatedebut" class="form-control" required value='.$datedebut.'></p>';
echo '<p>Date de fin du stage: <span class=oblig>*</span> <input type="date" name="txtdatefin" class="form-control" required value='.$datefin.'></p>';
echo '</div>';
echo '<table width=100%>
<tr>
  <td align="center">';

echo form_label("Localisation : <span class=oblig>*</span>","lstLocalisation");
echo '<select class="btn btn-info btn-sm" name="lstLocalisation">';
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
echo '<select class="btn btn-info btn-sm" name="lstCadre">';
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
echo '<select class="btn btn-info btn-sm" name="lstType">';
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
 );
echo form_textarea($data);
echo form_label("Environnement matériel:","txtmoyen");
$data = array(
   'type'  => 'text',
   'name'  => 'txtmoyen',
   'value' => $moyen,
   'class' => 'form-control',
   'placeholder' => "Ordinateur perso/Ordinateur de l'entreprise/Chez l'habitant/Dans une société client..."
 );
echo form_input($data);
echo form_label("Commentaire :","txtcommentaire");
$data = array(
   'type'  => 'text',
   'name'  => 'txtcommentaire',
   'value' => $commentaire,
   'class' => 'form-control',
   'rows' => '2',
   'placeholder' => "Ce champs sert a vous rappeler de votre situation lors de l'évaluation oral, dévrivez donc au mieux votre situation ici"
 );
echo form_textarea($data);
?>
<br><p align='center'>Est-ce une situation obligatoire ?
<label for="oui">Oui</label> <input type="radio" name="obligatoire" id="o" value="oui" onclick="bouton()" <?php if (!(empty($typoSelect))) {
echo 'checked';
} ?>/>
<label for="non">Non</label> <input type="radio" name="obligatoire" id="n" value="non" onclick="bouton()" <?php if (empty($typoSelect)) {
echo 'checked';
} ?>/></p>
<div class="" id='situationOblig' style=<?php if (empty($typoSelect)) {
echo '"visibility:hidden;">';
} ?>
<?php foreach ($LesTypologie as $UneTypologie) {
echo "<p><input type='checkbox' name='typologie[]'' value='".$UneTypologie['code']."'";
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

<br><p align='center'><input type="submit" name="Envoyer" class="btn btn-outline-primary btn-sm" value="Ajouter la situation"></p>
</div></div>
