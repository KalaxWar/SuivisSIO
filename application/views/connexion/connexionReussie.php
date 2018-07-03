
<html>
    <head>
       <title>Blog simple</title>
    </head>
    <body>
    <?php if ($this->session->profil == 'administrateur') : ?>
       <?php redirect('administrateur/index') ?>&nbsp;&nbsp;
    <?php elseif ($this->session->profil == 'client') : ?>
      <?php redirect('client/index') ?>&nbsp;&nbsp;
    <?php endif; ?>
