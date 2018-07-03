<br>
<div class="dropdown" align='center'>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      <?php
      if (isset($option)) {

      }
      else {
        echo "Choisiser l'option du stage";
      } ?>
    </button>
    <div class="dropdown-menu">
      <?php  echo '<a class="dropdown-item" href='.site_url('Etudiant/AfficherEntreprise/SLAM').'>SLAM</a>'; ?>
      <?php  echo '<a class="dropdown-item" href='.site_url('Etudiant/AfficherEntreprise/SISR').'>SISR</a>'; ?>
    </div>
  </div>
