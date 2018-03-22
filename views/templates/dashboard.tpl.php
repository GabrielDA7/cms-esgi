<!DOCTYPE html>
<html>

    <head>
      <title>Uteach-Dashboard</title>
      <meta charset="UTF-8">
      <meta name="description" content="Cours 1 integration">
      <meta name="keywords" content="CMS,Formation">
      <meta name="author" content="Gabriel Daoud">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="public/css/main.css" type="text/css" rel="stylesheet">
      <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <header>
          <nav class="container-fluid">
              <div class="left-nav">
                  <img id="logo-nav" src="public/img/logoOrange.svg" alt="logo" title="logo">
                  <p>Tableau de bord</p>
              </div>

              <div class="right-nav">
                  <a class="" href="">Se connecter</a>
                  <a class="" href="">S'inscrire</a>
                  <div class="wrapper">
                      <i class="fas fa-search"></i>
                      <input class="" type="text">
                  </div>
              </div>
          </nav>
        </header>

        <main>
            <section id="left-menu" class="container">
                <div class="container-fluid">
                      <nav>
                          <ul>
                             <li><i class="fas fa-chart-area"></i><a href="#">Statistiques</a></li>
                             <li><a href="news.asp">News</a></li>
                             <li><a href="contact.asp">Contact</a></li>
                             <li><a href="about.asp">About</a></li>
                          </ul>
                      </nav>
                </div>
            </section>

            <section id="content" class="container">
                <div class="row">
                    <?php include "views/".$this->v; ?>
                </div>
            </section>
        </main>

    </body>
</html>
