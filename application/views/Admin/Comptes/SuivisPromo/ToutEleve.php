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
  var eleve = [ <?php foreach ($LesEntreprises as $UneEntreprise) {
    echo '{ "label" : "'.$UneEntreprise['nom'].' '.$UneEntreprise['prenom'].'", "desc" : "'.$UneEntreprise['num'].'"},';
  } ?> ];
  $('#eleve').autocomplete({
  source : eleve,

  select : function(event, ui){ // lors de la sélection d'une proposition
      $('#noEleve').val( ui.item.desc ); // on ajoute la description de l'objet dans un bloc
  }
});
} );
</script>
<style>
.oblig {
  color: Tomato;
}
</style>
<?php echo form_open('Admin/rechercheEleve');?>
<input type="hidden" name="num" value="1">
<div class="ui-widget">
<label for="entreprise">Recherche par élèves :</label> <br>
<input placeholder="Par nom d'élèves" name="txtEntreprise" id="eleve" size="26" required>
<input type="hidden" name="noEleve" id='noEleve'>
<input type="submit" name="" value="Valider">
</div>
</form>
