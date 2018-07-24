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
                    <a id="hamburger" class="hamburger__logo" href="#"></a>
                    <img class="logo-nav" src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
                    <div class="right-left-nav">
                      <div class="left-nav">
                        <?php foreach ($pages as $page) : ?>
                          <a href="<?= DIRNAME . $page->getUrl();?>" class="active"><?= $page->getTitle() ?></a>
                        <?php endforeach; ?>
                      </div>

                      <div class="right-nav">
                        <?php if(isset($_SESSION['userName'])) { ?>
                          <a class="btn-filled-orange btn" href="<?= DIRNAME.USER_EDIT_BACK_LINK?>"><?= $_SESSION['userName']; ?></a>
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
                    </div>
                </nav>
        </header>
        <main class="front-main-content">
          <?php include $viewPath; ?>
        </main>

        <footer>
          <section class="container-fluid">
            <div id="footer" class="row">
              <div class="M8 X12">
                <div class="footer-wrapper">
                  <p class="footer-title"><?= (isset($infos)) ? $infos->getSiteName() : '' ?></p>
                  <p class="footer-content">
                    <?= (isset($infos)) ? $infos->getSiteDescription() : '' ?>
                  </p>
                </div>
              </div>

              <div class="M4 X12">
                <div class="footer-wrapper">
                  <p class="footer-title">Contact</p>
                  <ul id="footer-network">
                    <?php if(isset($infos)):?>
                      <?php if( $infos->getFacebook() != null):?>
                        <li>
                          <figure>
                            <a href="<?= $infos->getFacebook() ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                            <figcaption>Facebook</figcaption>
                          </figure>
                        </li>
                      <?php endif; ?>
                      <?php if($infos->getTwitter() != null):?>
                        <li>
                          <figure>
                            <a href="<?= $infos->getTwitter() ?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
                            <figcaption>Twitter</figcaption>
                          </figure>
                        </li>
                      <?php endif; ?>
                      <?php if( $infos->getLinkedin() != null ):?>
                        <li>
                          <figure>
                            <a href="<?= $infos->getLinkedin() ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <figcaption>Linkedin</figcaption>
                          </figure>
                        </li>
                      <?php endif; ?>
                      <?php if( $infos->getInstagram() != null ):?>
                        <li>
                          <figure>
                            <a href="<?= $infos->getInstagram() ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <figcaption>Instagram</figcaption>
                          </figure>
                        </li>
                      <?php endif; ?>
                      <?php if( $infos->getEmail() != null ):?>
                        <li>
                          <figure>
                            <a href="mailto:<?= $infos->getEmail() ?>" target="_blank"><i class="fas fa-envelope"></i></a>
                            <figcaption>Email</figcaption>
                          </figure>
                        </li>
                      <?php endif; ?>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </footer>

    <!-- Javascript -->
    <?php $this->addScript(0, DIRNAME.JQUERY_PATH); ?>
    <?php $isPremium = (isset($_SESSION['premium']) ? $_SESSION['premium'] : false); ?>
    <?php $isAdmin = (isset($_SESSION['admin']) ? $_SESSION['admin'] : false); ?>
    <?php $this->addScript(1, DIRNAME.FRAMEWORD_JS_PATH, ["dirname" => DIRNAME, "isLogged" => json_encode(isLogged()), "isPremium"=>json_encode($isPremium), "isAdmin"=>json_encode($isAdmin)]); ?>
  </body>
</html>
