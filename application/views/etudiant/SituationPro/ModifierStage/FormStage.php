
<style>
  .ui-autocomplete {
    max-height: 250px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
    
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
    width:400px;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Voir tout" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title","Aucune correspondance trouvé" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });
  } );
</script>

<script>
  $( function() {
    $.widget( "custom.combobox2", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox2" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -2 )
          .attr( "title", "")
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox2-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title","" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox2" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox2" ).toggle();
    });
  } );
</script>

<script>
  $( function() {
    $.widget( "custom.combobox3", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox3" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox3-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -2 )
          .attr( "title", "")
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox3-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title","" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox3" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox3" ).toggle();
    });
  } );
</script>

  <style>
.oblig {
    color: Tomato;
}
</style>
<h3 align='center'>Modifier un stage</h3> <br>
<?php echo form_open('etudiant/modifierStage/'.$nostage);?>
  <p><b>Séléctionner une entreprise : <span class=oblig>*</span></b></p>
  <select id="combobox" required name='noEntreprise'>
    <option value="">Selectionne un...</option>
    <?php 
    foreach ($LesEntreprises as $UneEntreprise) {
        echo '<option value="'.$UneEntreprise['noentreprise'].'"';
        if ($numEntrepriseSelect==$UneEntreprise['noentreprise']) {
          echo 'selected';
        }
        echo '>'.$UneEntreprise['nom'].' | '.$UneEntreprise['ville'].'</option>';
    }
    ?>
 </select>
<br>
<?php echo'<a href="'.site_url('etudiant/AjouterUneEntreprise/').'"> <input type="button" class="btn btn-primary btn-sm" name="Répondre "value="Ajouter une entreprise"/></a>'?>
<br><br><input type="hidden" name="num" value="1">

    <p><b> Séléctionner le représentant de l'organisme d'accueil :</b></p>
    <select id="combobox2" name='noContactOrga'>
    <option value="">Selectionne un...</option>
    <?php 
    foreach ($LesContacts as $UnContact) {
        echo '<option value="'.$UnContact['nocontact'].'" ';
        if(isset($NumOrgatuteur))
        {
          if ($NumOrgatuteur==$UnContact['nocontact']) {
            echo 'selected';
          }
        }
        echo '>'.$UnContact['nom'].' | '.$UnContact['entreprise'].'</option>';
    }
    ?>
  </select>
  <br>
  <?php   echo  ' <a href="'.site_url('etudiant/CreeContact/').'"> <input type="button" class="btn btn-primary btn-sm" name="Répondre "value="Ajouter un représentant de l\'organisme d\'accueil"/></a>'?>
  <br><br>




    <p><b>Séléctionner le tuteur :</b></p>
    <select id="combobox3" name='noContactTuteur'>
    <option value="">Selectionne un...</option>
    <?php 
    foreach ($LesContacts as $UnContact) {
        echo '<option value="'.$UnContact['nocontact'].'" ';
        if(isset($Numtuteur))
        {
          if ($Numtuteur==$UnContact['nocontact']) {
            echo 'selected';
          }
        }
        echo '>'.$UnContact['nom'].' | '.$UnContact['entreprise'].'</option>';
    }
    ?>
  </select>
  <br>
  <?php   echo  ' <a href="'.site_url('etudiant/CreeContact/').'"> <input type="button" class="btn btn-primary btn-sm" name="Répondre "value="Ajouter un tuteur"/></a>'?>
  <br><br>
<label for="lstProf">Selectionner le professeur référant : <span class=oblig>*</span></label> <br>
  <select class='btn btn-white dropdown-toggle' name='lstProf' required><option value=''>- - - - cliquez - - - -</option>
  <?php foreach ($LesProfs as $UnProf) {
    echo '<option value="'.$UnProf['num'].'"'; if ($ProfSelect == $UnProf['nom']) { echo 'selected';}
    echo '>'.$UnProf['nom'].'</option>';
  } ?>
</select> <br><br>
<?php
  echo form_label("Description :","txtDescription");
  echo '<input type="text" name="txtDescription" class="form-control" placeholder="Description rapide du stage" value="';
  if (isset($description)) {
    echo $description;
  }
  echo '">';

  echo '<br>';
  echo '<p>Date de début du stage: <span class=oblig>*</span> <input type="date" name="txtdatedebut" class="form-control" required value='.$datedebut.'></p>';
  echo '<p>Date de fin du stage: <span class=oblig>*</span> <input type="date" name="txtdatefin" class="form-control" required value='.$datefin.'></p>';
  echo form_label("Commentaire :","txtcommentaire");

  echo '<input type="text" name="txtcommentaire" class="form-control" placeholder="Stage agréable/Aucune prise en charge du stagiaire ..." value="';
  if (isset($commentaire)) {
    echo $commentaire;
  }
  echo '">';
?>
<br>
<label for="Source">Selectioner L'année du stage <span class=oblig>*</span></label> <br>
<select class='btn btn-white dropdown-toggle' name="Source" required>
  <option selected value=''>- - - - cliquez - - - -</option>
  <option value="2" <?php if ($codeSource == "2"){echo 'selected';} ?>>Stage 1ère année</option>
  <option value="3" <?php if ($codeSource == "3"){echo 'selected';} ?>>Stage 2ème année</option>
</select>
  <p align='center'><input type="submit" name="Envoyer" class="btn btn-outline-primary btn-sm" value="Modifier le stage"></p>
</form>
