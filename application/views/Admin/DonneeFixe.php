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
        echo '<h4><a href='.site_url('Admin').'>Espace Administrateur</a></h4>';
      ?>
        </div>
      </section>
    <section>
      <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
        <h3 class="heading">Comptes</h3>
        <div class="content">
          <ul>
            <li ><?php $action='1'; echo anchor('Admin/AjouterDesComptes/'.$action,"Ajouter Des Comptes")?></li>
            <li ><?php $action='1'; echo anchor('Admin/ModifierDesComptes/'.$action,"Modifier Des Comptes")?></li>
            <li ><?php $action='1'; echo anchor('Admin/SupprimerDesComptes/'.$action,"Supprimer Des Comptes")?></li>
            <li ><?php echo anchor('Admin/SuivisDesPromotions/',"Suivis Des Promotions")?></li>
          </ul>
        </div>
      </div>
    </section>
    <section>
      <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
        <h3 class="heading">Code D'Accès</h3>
        <div class="content">
          <ul>
            <li ><?php echo anchor('Admin/ExportMdp/',"Export Mot De Passe")?></li>
          </ul>
        </div>
      </div>
    </section>
    <section>
      <div class="section-inner" style="background-color:#B9B9B9;padding:20px;margin-top:10px">
        <h3 class="heading">Sauvegarde</h3>
        <div class="content">
          <ul>
            <li ><?php echo anchor('Admin/Sauvegarde/',"Sauvegarde Base")?></li>
          </ul>
        </div>
      </div>
    </section>
  </div>

</body>
