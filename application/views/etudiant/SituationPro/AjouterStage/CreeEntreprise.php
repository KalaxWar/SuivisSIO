
<option value=""></option>

<?php
   echo validation_errors();
   if (isset($UneEntreprise))
   {
    echo form_open('etudiant/Modifier_Entreprise');
   }
   else
   {
    echo form_open('etudiant/AjouterUneEntreprise');
   }
   

   echo form_hidden('num','1');
if (isset($UneEntreprise))
{
  var_dump($UneEntreprise);
  echo "<h3 align='center'>Modification l'entreprise</h3>";
    $noentreprise = $UneEntreprise['noentreprise'];
    $nom = $UneEntreprise['nom'];
    $nosecteur = $UneEntreprise['nosecteur'];
    $noimmatriculation = $UneEntreprise['noimmatriculation'];
    $telephone = $UneEntreprise['telephone'];
    $fax = $UneEntreprise['fax'];
    $email = $UneEntreprise['email'];
    $adresse = $UneEntreprise['adresse'];
    $cp = $UneEntreprise['cp'];
    $ville = $UneEntreprise['ville'];
    $pays = $UneEntreprise['pays'];
    $nomassurance = $UneEntreprise['nomassurance'];
    $nocontratassurance = $UneEntreprise['nocontratassurance'];
}
  else {
    echo "<br><br><h3 align='center'>Ajouter une entreprise</h3>";
    $noentreprise = ""; // 04/06/2018
    $nom = "";
    $nosecteur = "";
    $noimmatriculation = "";
    $telephone = "";
    $fax = "";
    $email = "";
    $adresse = "";
    $cp = "";
    $ville = "";
    $pays = "";
    $nomassurance = "";
    $nocontratassurance = "";
  }
   echo '<input type="hidden" name="noentreprise" value="'.$noentreprise.'">';
   echo form_label("Nom : <span class=oblig>*</span>","txtnom");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtnom',
        'value' => $nom,
        'class' => 'form-control',
        'placeholder' => "Nom de l'entreprise",
        'required' =>'required',

      );
   echo form_input($data);

   echo "<br><p> Secteur d'activité de l'entreprise :</p> <select class='btn btn-white dropdown-toggle' name='lstsecteur'>";
     foreach ($LesSecteurs as $UnSecteur) {
       echo '<option value="'.$UnSecteur['nosecteur'].'"';
       if ($nosecteur == $UnSecteur['nosecteur']) {
         echo 'selected';
       }
       echo '>'.$UnSecteur['nom'].'</option>';
     }
   echo '</select> <br> <br>';

   echo form_label('Numéro de SIRET :','txtimmatriculation');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtimmatriculation',
        'value' => $noimmatriculation,
        'class' => 'form-control',
        'placeholder' => "Le numéro de SIRET de l'entreprise"
      );
   echo form_input($data);

   echo form_label("Téléphone :","txtelephone");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtelephone',
        'value' => $telephone,
        'class' => 'form-control',
        'placeholder' => "Le numéro de téléphone de l'entreprise"
      );
   echo form_input($data);

   echo form_label('Fax :','txtfax');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtfax',
        'value' => $fax,
        'class' => 'form-control',
        'placeholder' => "Le numéro de fax de l'entreprise"
      );
   echo form_input($data);

   echo form_label('Email :','txtemail');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtemail',
        'value' => $email,
        'class' => 'form-control',
        'placeholder' => "Email de l'entreprise"
      );
   echo form_input($data);

   echo form_label('Adresse : <span class=oblig>*</span>','txtadresse');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtadresse',
        'value' => $adresse,
        'class' => 'form-control',
        'placeholder' => "L'adresse de l'entreprise",
        'required' =>'required'
      );
   echo form_input($data);

   echo form_label('Code Postal : <span class=oblig>*</span>','txtcp');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtcp',
        'value' => $cp,
        'class' => 'form-control',
        'placeholder' => "Le code postal de l'entreprise",
        'required' =>'required'
      );
   echo form_input($data);

   echo form_label('Ville : <span class=oblig>*</span>','txtville');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtville',
        'value' => $ville,
        'class' => 'form-control',
        'placeholder' => "La ville de l'entreprise",
        'required' =>'required'
      );
   echo form_input($data);

   echo form_label('Pays : <span class=oblig>*</span>','txtpays');
   $data = array(
        'type'  => 'text',
        'name'  => 'txtpays',
        'value' => $pays,
        'class' => 'form-control',
        'placeholder' => "Le pays de l'entreprise",
        'required' =>'required'
      );
   echo form_input($data);

   echo form_label("Nom de l'assurance :","txtnomassurance");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtnomassurance',
        'value' => $nomassurance,
        'class' => 'form-control',
        'placeholder' => "Le nom de l'assurance de l'entreprise"
      );
   echo form_input($data);

   echo form_label("Numéro du contrat d'assurance :","txtnocontratassurance");
   $data = array(
        'type'  => 'text',
        'name'  => 'txtnocontratassurance',
        'value' => $nocontratassurance,
        'class' => 'form-control',
        'placeholder' => "Le numéro du contrat de l'assurance de l'entreprise"
      );
   echo form_input($data);

   echo '<br>';
    if (isset($UneEntreprise))
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
