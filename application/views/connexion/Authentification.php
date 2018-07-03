  <div class="container">
  <div class="col-sm-3" style="float:left;background-color:#B9B9B9">
<h3>Authentification</h3>


<?php

   echo validation_errors();
   echo form_open('visiteur/home');
   echo form_label("Login :","txtLogin");
   echo form_input('txtLogin','','class=form-control');
   echo form_label('Code :','txtMdp');
   echo form_password('txtMdp','','class=form-control');
   echo form_submit('submit', 'Envoi');
   echo form_close();
?>
</div>
</body>

</html>
