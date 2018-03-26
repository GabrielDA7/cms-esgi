<!DOCTYPE html>
<html>

  <head>
    <title>Uteach-Dashboard</title>
    <meta charset="UTF-8">
    <meta name="description" content="Login dashboard">
    <meta name="keywords" content="CMS, Formation">
    <meta name="author" content="Gabriel Daoud">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="public/css/main.css" type="text/css" rel="stylesheet">
  </head>

  <body>
      <section id="dashboard-login">
          <div class="container">
              <?php include "views/".$this->v; ?>
          </div>
      </section>


      <!-- Javascript -->
      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="public/js/framework.js"></script>
  </body>

</html>
