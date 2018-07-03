  <style>
  .selectioné {
      color: #C40000;
  }
  </style>
        <div class="container sections-wrapper">
          <div class="row">
          <div class="col-sm-3" style="">
  <section class="about section">
    <div class="section-inner" style="background-color:#B9B9B9;padding-left:10px;">
      <?php
            echo $this->session->prenom.' '.$this->session->nom.'<BR>';
            echo $this->session->nomGroup.'-'.$this->session->anneeGroup.'<br><br>';
            echo "<p align=center> Récapitulatif des situations </p>";
            if (isset($Valide)) {
            if (!($Valide['Nombre'] == '0')) {
              echo "<span style='color: #009909;'>- Situation(s) Validée(s) : ". $Valide['Nombre'].'<br></span>';
            }
          }
          if (isset($Invalide)) {
            if (!($Invalide['Nombre'] == '0')){
              echo "<span class=oblig>- Situation(s) Invalidée(s) : ". $Invalide['Nombre'].'<br></span>';
            }
          }
          if (isset($EnAttente)) {
            if (!($EnAttente['Nombre'] == '0')) {
              echo "<span style='color: #954848;'>- Situation(s) en attente(s) de(s) validation(s) : ". $EnAttente['Nombre'].'<br></span>';
            }
          }
            echo "<br><br>";
            $stageSelectioné = $this->session->StageSelectioné;
            if (isset($stageSelectioné)) {
              echo '<span class=selectioné> Action selectionnée :<br>';
              echo $stageSelectioné.'</span><br>';
            }
              echo '<div class="dropdown">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                selectionner une action
              </button>
              <div class="dropdown-menu">';
              if (isset($LesStages)) {
               foreach ($LesStages as $UnStage) {
                echo '<a class="dropdown-item" href='.site_url('Etudiant/selectionerUnStage/'.$UnStage['nostage']).'>';
                if ($UnStage['codeSource'] == '2') {echo 'Première année :';}
                if ($UnStage['codeSource'] == '3') {echo 'Deuxième année :';}
                echo ' | '.$UnStage['nom'].'</a>';
}
              }
              echo '<a class="dropdown-item" href='.site_url('Etudiant/selectionerUnStage/').'>PPE / TP</a>';
              echo '
              </div>
            </div><br>';
            echo '<a href='.site_url('Visiteur/seDeconnecter').'>Déconnecter</a><br><BR>';
            echo '<h3><a href='.site_url('Etudiant').'>Espace Élève</a></h3><BR>';
      ?>
    </div>
  </section>
  <section>
    <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
      <h3 class="heading">Situation Professionnelle</h3>
      <div class="content">
        <ul>
          <li><?php echo anchor('Etudiant/AjoutStage/',"Ajouter un stage")?></li>
          <li><?php echo anchor('Etudiant/modifierStage/',"Modifier un stage")?></li>
          <li><?php echo anchor('Etudiant/Modifier_Entreprise/',"Modifier une entreprise")?></li>
          <li><?php echo anchor('Etudiant/Modifier_Contact/',"Modifier un contact")?></li>
          <li><?php echo anchor('Etudiant/NouvelleSituation/1',"Ajouter une situation")?></li>
          <li><?php echo anchor('Etudiant/modifierUneSituation/',"Modifier des situations")?></li>
        </ul>
      </div>
    </div>
  </section>
  <section>
    <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
      <h3 class="heading">Synthèse</h3>
      <div class="content">
        <ul>
          <li ><?php echo anchor('Synthese',"Tableau de synthèse")?></li>
        </ul>
      </div>
    </div>
  </section>
  <section>
    <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
      <h3 class="heading">Divers</h3>
      <div class="content">
        <ul>
          <li ><?php echo anchor('Etudiant/AfficherEntreprise/',"Annuaire des entreprises")?></li>
          <li ><?php echo anchor('Etudiant/Modifier_Mdp/',"Modifier mon mot de passe")?></li>
        </ul>
      </div>
    </div>
  </section>
  </div>
  <div class='col-sm-9' style="background-color:#6BD1FF;">
