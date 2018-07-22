<!DOCTYPE html>
<html>

  <head>
    <title><?= (isset($infos)) ? $infos->getSiteName() : '' ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="Cours 1 integration">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Louis Decultot">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= DIRNAME.CSS_PATH;?>">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  </head>

  <body class="front-template-content">
      <header>
              <nav class="container-fluid" id="front-topnav">
                  <div class="left-nav">
                    <img class="logo-nav" src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
                    <?php foreach ($pages as $page) : ?>
                      <a href="<?= DIRNAME . $page->getUrl();?>" class="active"><?= $page->getTitle() ?></a>
                    <?php endforeach; ?>
                  </div>

                  <div class="right-nav">
                    <?php if(isset($_SESSION['userName'])) { ?>
                      <a class="btn-small btn-filled-orange btn" href="<?= DIRNAME.USER_EDIT_BACK_LINK."?id=".$_SESSION['userId'];?>"><?= $_SESSION['userName']; ?></a>
                      <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.USER_DISCONNECT_LINK;?>">Logout</a>
                    <?php } else { ?>
                    <a class="btn-small btn-filled-orange btn" href="<?= DIRNAME.USER_LOGIN_FRONT_LINK;?>">Sign in</a>
                    <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.USER_ADD_FRONT_LINK;?>">Sign up</a>
                    <?php } ?>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) { ?>
                      <a class="btn-extra-small btn-light-grey btn" href="<?= DIRNAME.STATISTIC_INDEX_BACK_LINK;?>">Back Office</a>
                    <?php } ?>
                    <div class="wrapper-icon">
                        <i class="fas fa-search icon-left"></i>
                        <input id="global-search" class="input-medium input-icon" type="text" value="<?= isset($_GET['str']) ? $_GET['str'] : '' ?>">
                    </div>
                  </div>
              </nav>
      </header>
      <main class="front-main-content">
        <?php include $viewPath; ?>
      </main>

      <footer>
        <section class="container-fluid">
          <div id="footer" class="row">
            <div class="M8">
              <div class="footer-wrapper">
                <p class="footer-title"><?= (isset($infos)) ? $infos->getSiteName() : '' ?></p>
                <p class="footer-content">
                  <?= (isset($infos)) ? $infos->getSiteDescription() : '' ?>
                </p>
              </div>
            </div>

            <div class="M4">
              <div class="footer-wrapper">
                <p class="footer-title">Contact</p>
                <ul id="footer-network">
                      <li>
                        <figure>
                          <a href="<?= (isset($infos)) ? $infos->getFacebook() : '' ?>"><i class="fab fa-facebook"></i></a>
                          <figcaption>Facebook</figcaption>
                        </figure>
                      </li>

                      <li>
                        <figure>
                          <a href="<?= (isset($infos)) ? $infos->getTwitter() : '' ?>"><i class="fab fa-twitter-square"></i></a>
                          <figcaption>Twitter</figcaption>
                        </figure>
                      </li>

                      <li>
                        <figure>
                          <a href="<?= (isset($infos)) ? $infos->getLinkedin() : '' ?>"><i class="fab fa-linkedin"></i></a>
                          <figcaption>Linkedin</figcaption>
                        </figure>
                      </li>

                      <li>
                        <figure>
                          <a href="<?= (isset($infos)) ? $infos->getEmail() : '' ?>"><i class="fas fa-envelope"></i></a>
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
    <?php $this->addScript(0, DIRNAME.JQUERY_PATH); ?>
    <?php $this->addScript(1, DIRNAME.FRAMEWORD_JS_PATH, ["dirname" => DIRNAME, "isLogged" => json_encode(isLogged()), "isPremium"=>(isset($_SESSION['premium']) ? json_encode($_SESSION['premium']) : 0), "isAdmin"=>(isset($_SESSION["admin"]) ? json_encode($_SESSION["admin"]) : 0)]); ?>
  </body>
</html>
