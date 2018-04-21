<!DOCTYPE html>
<html>

  <head>
    <title>Uteach</title>
    <meta charset="UTF-8">
    <meta name="description" content="Cours 1 integration">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Louis Decultot">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= DIRNAME.CSS_PATH;?>">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  </head>

  <body>
    <header>
            <nav class="container-fluid" id="front-topnav">
                <div class="left-nav">
                  <img class="logo-nav" src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
                  <a href="<?= DIRNAME;?>" class="active">Accueil</a>
                  <a href="#cours">Cours</a>
                  <a href="#formations">Formations</a>
                  <a href="#videos">Vidéos</a>
                  <a href="#premium">Premium</a>
                </div>

                <div class="right-nav">
                  <?php if(isset($_SESSION['userName'])) { ?>
                    <a class="btn-small btn-filled-orange btn" href="<?= DIRNAME.USER_EDIT_FRONT_LINK;?>"><?= $_SESSION['userName']; ?></a>
                    <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.USER_DISCONNECT_LINK;?>">Se deconnecter</a>
                  <?php } else { ?>
                  <a class="btn-small btn-filled-orange btn" href="<?= DIRNAME.USER_LOGIN_FRONT_LINK;?>">Se connecter</a>
                  <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.USER_ADD_FRONT_LINK;?>">S'inscrire</a>
                  <?php } ?>
                  <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) { ?>
                    <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.STATISTIC_INDEX_BACK_LINK;?>">Back Office</a>
                  <?php } ?>
                  <div class="wrapper-icon">
                      <i class="fas fa-search"></i>
                      <input class="input-medium input-icon" type="text">
                  </div>
                </div>
            </nav>
    </header>

    <main>
      <?php include $viewPath; ?>
    </main>

    <footer>
      <section class="container-fluid">
        <div id="footer" class="row M--middle">
          <div class="M6">
            <div class="footer-wrapper">
              <p class="footer-title">Uteach</p>
              <p class="footer-content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>

          <div class="M6">
            <div class="footer-wrapper">
              <p class="footer-title">Contact</p>
              <ul id="footer-network">
                    <li>
                      <figure>
                        <a href=""><i class="fab fa-facebook"></i></a>
                        <figcaption>Facebook</figcaption>
                      </figure>
                    </li>

                    <li>
                      <figure>
                        <a href=""><i class="fab fa-twitter-square"></i></a>
                        <figcaption>Twitter</figcaption>
                      </figure>
                    </li>

                    <li>
                      <figure>
                        <a href=""><i class="fab fa-linkedin"></i></a>
                        <figcaption>Linkedin</figcaption>
                      </figure>
                    </li>

                    <li>
                      <figure>
                        <a href=""><i class="fas fa-envelope"></i></a>
                        <figcaption>Email</figcaption>
                      </figure>
                    </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </footer>

    <!-- Javascript -->
    <script src="<?= DIRNAME;?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= DIRNAME;?>node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= DIRNAME;?>public/js/framework.js"></script>
  </body>
</html>
