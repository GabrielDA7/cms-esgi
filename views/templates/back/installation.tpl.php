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
    <link href="<?= DIRNAME.CSS_PATH;?>" type="text/css" rel="stylesheet">
  </head>

  <body>
      <section id="installation">
          <div class="container">
							<div class="row X--center M--center">
							    <div class="M3">
							      <img src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
							    </div>
							</div>

							<div class="row X--center M--center">
							    <div class="M3">
							      <h1>Uteach</h1>
							    </div>
							</div>
              <?php include $viewPath; ?>
          </div>
      </section>
  </body>

</html>
