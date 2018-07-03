      <div class="container sections-wrapper">
        <div class="row">
        <div class="primary col-sm-3" style="">
<section class="about section">
  <div class="section-inner" style="background-color:#B9B9B9;padding-left:10px;">
    <?php
          echo '<p>'.$this->session->prenom.' '.$this->session->nom.'</p>';
          echo '<a href='.site_url('Visiteur/seDeconnecter').'>Se Déconnecter</a>';
          ?>
  </div>
</section>
<section>
  <div class="section-inner" style="background-color:#B9B9B9;padding:20px;">
    <?php
  echo '<h4><a href='.site_url('Professeur').'>Espace Professeur</a></h4>';
?>
  </div>
</section>
<section>
  <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
    <h3 class="heading">Suivis</h3>
    <div class="content">
      <ul>
        <li ><?php echo anchor('professeur/situation/1',"Situations des élèves")?></li>
        <li ><?php echo anchor('professeur/SyntheseEleve/',"Synthèses des élèves")?></li>
      </ul>
    </div>
  </div>
</section>
<section>
  <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
    <h3 class="heading">Code D'Accès</h3>
    <div class="content">
      <ul>
        <li ><?php echo anchor('professeur/ExportMdp/',"Export mot de passe des élèves")?></li>
      </ul>
    </div>
  </div>
</section>
</div>
  <div class='col-sm-9' style="background-color:#6BD1FF;">
