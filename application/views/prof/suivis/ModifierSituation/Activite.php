<?php echo form_open('etudiant/NouvelleSituation/3');?>
  <script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
  });
   $( function() {
     $( "#selectable" ).selectable({
       stop: function() {
         var resultActiv = $( "#select-result-activite" ).empty();
         var resultCompt = $( "#select-result-compt" ).empty();
         $( ".ui-selected", this ).each(function() {
           var index = $( "#selectable li" ).index( this );
           var data = $(this).text();
           resultActiv.append(data+"<br>"+"<input type='hidden' name='send[]' value="+$(this).attr('id')+">");
           var competence = $(this).attr('value');
           var sautLigne = "---------------------------------------------------- <br>";
           resultCompt.append(competence+sautLigne);
         });
       }
     });
   }
);
   </script>
    <style>
  #feedback { font-size: 1em; }
  #selectable .ui-selecting { background: #FECA40; }
  #selectable .ui-selected { background: #F39814; color: white; }
  #selectable { list-style-type: none; margin 0; padding:0; }
  #selectable li { margin: 3px; padding: 0.4em; font-size: 0.9em; height: 40px; }
  </style>
    <br>
<p>La ou les activitée(s) que l'élève a séléctioné :</p>
<div id="cadre" style="height: 150px; overflow:auto; background-color:white;">
  <p align='center'>
<span id="select-result-activite">
  <?php $data = '';
  foreach ($LesActivites as $UneActivite) {
    foreach ($LesActivitesCitee as $UneActiviteCitee) {
  if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
  echo $UneActivite['nomenclature'].'. '.$UneActivite['libelle'].'<br>';
  }
  }
  }
   ?>
  </span>
</p>
</div>
<br>
<p>Les compétences correspondante au activitées séléctioné :</p>
<div id="cadre" style="height: 150px; overflow:auto;background-color:white;">
<p align='center'>
</span><span id="select-result-compt">
  <?php $data = '';
  foreach ($LesActivites as $UneActivite) {
    foreach ($LesActivitesCitee as $UneActiviteCitee) {
      foreach ($LesCompétences as $UneCompétence) {
        if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
          if ($UneCompétence['idActivite'] == $UneActivite['id']) {
          echo $UneCompétence['nomenclature'].'. '.$UneCompétence['libelle'].'<br>';
          }
        }
      }
      if ($UneActiviteCitee['idActivite'] == $UneActivite['id']) {
        echo "---------------------------------------------------- <br>";
      }
    }
  }
   ?>
</span>
</p>
</div>

<br>
</form>
  </body>
</html>
