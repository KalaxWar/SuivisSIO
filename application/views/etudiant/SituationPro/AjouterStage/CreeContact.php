<br>

<?php
   if (isset($UnContact))
   {
   echo form_open('etudiant/Modifier_Contact');
   echo "<h3 align='center'>Modifier un contact dans le carnet d'adresse</h3>";
   echo '<input type="hidden" name="nocontact" value ="'.$UnContact['nocontact'].'">';
   $nom = $UnContact['nom'];
   $telfixe = $UnContact['telfixe'];
   $telportable = $UnContact['telportable'];
   $email = $UnContact['email'];
   $fonction = $UnContact['fonction'];
   $email = $UnContact['email'];
   $diplome = $UnContact['diplome'];
  }
  else
  {
    echo form_open('etudiant/CreeContact');
    echo "<h3 align='center'>Ajouter un contact dans le carnet d'adresse</h3>";
    $nocontact = "";
    $nom = "";
    $telfixe = "";
    $telportable = "";
    $email = "";
    $fonction = "";
    $diplome = "";
    $NumEntreprise = -1;
  }

   echo form_hidden('num','1');

   echo form_label("Nom : <span class=oblig>*</span>","txtnom");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtnom',
        'value' => $nom,
        'class' => 'form-control',
        'placeholder' => "Nom du contact",
        'required' =>'required'
      );
   echo form_input($data);

   echo form_label('Téléphone Fixe :','txtTelFixe');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtTelFixe',
        'value' => $telfixe,
        'class' => 'form-control',
        'placeholder' => "Le téléphone fixe du contact si il en a un"
      );
   echo form_input($data);



?>
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
           .attr( "title", "Voir toutes les entreprises" )
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
           .attr( "title","Aucune entreprise trouvé" )
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
   <br><p> L'entreprise dans laquel est le contact : <span class=oblig>*</span> (Veuillez ajouter l'entreprise si elle n'existe pas dans le carnet d'adresse)</p>
   <select id="combobox" required name='noentreprise'>
     <option value="">Selectionne un...</option>
     <?php
     foreach ($LesEntreprises as $UneEntreprise) {
         echo '<option value="'.$UneEntreprise['noentreprise'].'"'; if ($NumEntreprise == $UneEntreprise['noentreprise']) { echo 'selected';}
         echo '>'.$UneEntreprise['nom'].' | '.$UneEntreprise['ville'].'</option>';
     }
   echo  '</select><br><a href="'.site_url('etudiant/AjouterUneEntreprise/').'"> <input type="button" class="btn btn-outline-primary btn-sm" name="Répondre "value="Ajouter une entreprise"/></a><br> <br>';

   echo form_label("Téléphone Portable :","txtTelPortable");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtTelPortable',
        'value' => $telportable,
        'class' => 'form-control',
        'placeholder' => "Le téléphone portable du contact s'il vous l'a communiqué"
      );
   echo form_input($data);

   echo form_label('Email :','txtEmail');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtEmail',
        'value' => $email,
        'class' => 'form-control',
        'placeholder' => "Email du contact"
      );
   echo form_input($data);

   echo form_label('Fonction dans l\'entreprise :','txtFonction');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtFonction',
        'value' => $fonction,
        'class' => 'form-control',
        'placeholder' => "Fonction du contact dans l'entreprise (Patron/Tuteur...)"
      );
   echo form_input($data);

   echo form_label('Diplôme optenu :','txtDiplome');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtDiplome',
        'value' => $diplome,
        'class' => 'form-control',
        'placeholder' => "Diplôme optenu par votre contact"
      );
   echo form_input($data);

   echo '<br>';
   if (isset($UnContact))
   {
    echo '<p align=center>'.form_submit('SubmitModifier', 'Modifier','class="btn btn-outline-primary btn-sm"');
   }
   else
   {
    echo '<p align=center>'.form_submit('submit', 'Ajouter','class="btn btn-outline-primary btn-sm"');
   }
   echo  ' <a href="'.site_url('etudiant/AjoutStage/').'"> <input type="button" class="btn btn-outline-primary btn-sm" name="Répondre "value="Retour"/></a>';
   echo form_close();
?>

</body>

</html>
