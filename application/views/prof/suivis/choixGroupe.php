<br>
<div class="dropdown" align='center'>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      <?php
      if (isset($option)) {

      }
      else {
        echo "Choisisser la classe (par année d'obtention du BTS)";
      } ?>
    </button>
    <div class="dropdown-menu">
      <?php foreach ($LesGroupes as $UnGroupe) {
        echo '<a class="dropdown-item" href='.site_url('professeur/SyntheseEleve/'.$UnGroupe['num']).'>BTS SIO '.$UnGroupe['annee'].' '.$UnGroupe['nomenclature'].'</a>';
      } ?>
    </div>
  </div>
