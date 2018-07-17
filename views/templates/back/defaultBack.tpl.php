<!DOCTYPE html>
<html>
    <head>
        <title>Uteach-Dashboard</title>
        <meta charset="UTF-8">
        <meta name="description" content="Cours 1 integration">
        <meta name="keywords" content="CMS,Formation">
        <meta name="author" content="Gabriel Daoud">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= DIRNAME.CSS_PATH;?>" type="text/css" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" type="text/css" rel="stylesheet">
    </head>

    <body>
      <section class="container-fluid">
        <nav id="dashboard-nav" class="top-menu">
            <div class="left-nav">
                <img class="logo-nav" src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
                <p>Dashboard</p>
            </div>

            <div class="right-nav">
                <div class="icon-bar">
                    <a class="active" href="<?= DIRNAME;?>"><i class="fas fa-home"></i></a>
                    <a href="<?= DIRNAME.USER_EDIT_BACK_LINK;?>"><i class="fas fa-user-circle"></i></a>
                    <a href="#"><i class="far fa-bell"></i></a>
                    <a href="<?= DIRNAME.USER_DISCONNECT_LINK;?>"><i class="fas fa-power-off"></i></a>
                </div>
            </div>
        </nav>

        <nav id="dashboard-left-menu">
              <a href="<?= DIRNAME.STATISTIC_INDEX_BACK_LINK;?>" class="menu-item"><i class="fas fa-chart-area"></i>Statistics</a>
              <a href="" class="menu-item"><i class="fas fa-columns"></i>Pages</a>
              <a href="javascript:void(0);" class="menu-item expand-div"><i class="fas fa-graduation-cap"></i>Chapters<i class="fas fa-chevron-down"></i></a>
              <div class="content-hidden sub-items">
                <a href="<?= DIRNAME . CHAPTER_LIST_BACK_LINK; ?>" class="menu-sub-item">Liste des cours</a>
                <a href="<?= DIRNAME . CHAPTER_ADD_BACK_LINK; ?>" class="menu-sub-item">Ajouter un cours</a>
              </div>
              <a href="javascript:void(0);" class="menu-item expand-div"><i class="fas fa-graduation-cap"></i>Formations<i class="fas fa-chevron-down"></i></a>
              <div class="content-hidden sub-items">
                <a href="<?= DIRNAME . TRAINNING_LIST_BACK_LINK; ?>" class="menu-sub-item">Liste des formations</a>
                <a href="<?= DIRNAME . TRAINNING_ADD_BACK_LINK; ?>" class="menu-sub-item">Ajouter une formation</a>
              </div>
              <a href="javascript:void(0);" class="menu-item expand-div"><i class="fas fa-graduation-cap"></i>Videos<i class="fas fa-chevron-down"></i></a>
              <div class="content-hidden sub-items">
                <a href="<?= DIRNAME.VIDEO_LIST_BACK_LINK;?>" class="menu-sub-item">Video list</a>
                <a href="<?= DIRNAME.VIDEO_ADD_BACK_LINK;?>" class="menu-sub-item">Add video</a>
              </div>
              <a href="<?= DIRNAME.COMMENT_REPORT_BACK_LINK;?>" class="menu-item"><i class="fas fa-comments"></i>Comments<i id="number-comments-signaled"></i></a>
              <a href="" class="menu-item"><i class="fas fa-gem"></i>Premium</a>
              <a href="javascript:void(0);" class="menu-item expand-div"><i class="fas fa-users"></i>Users<i class="fas fa-chevron-down"></i></a>
              <div class="content-hidden sub-items">
                <a href="<?= DIRNAME.USER_LIST_BACK_LINK;?>" class="menu-sub-item">Users list</a>
              </div>
              <a href="javascript:void(0);" class="menu-item expand-div"><i class="fas fa-cogs"></i>Parameters<i class="fas fa-chevron-down"></i></a>
              <div class="content-hidden sub-items">
                <a href="#" class="menu-sub-item">General parameters</a>
                <a href="#" class="menu-sub-item">Appearance</a>
              </div>
          </nav>

          <section id="dashboard-content">
              <div class="viewport">
                <?php include $viewPath; ?>
              </div>
          </section>
        </section>
      </section>

        <!-- Javascript -->
        <?php $this->addScript(0, "node_modules/jquery/dist/jquery.min.js", null); ?>
        <?php $this->addScript(1, "public/js/framework.js", ["dirname" => DIRNAME]); ?>
        <?php $this->addScript(2, "public/js/tinymce/js/tinymce/tinymce.min.js", null); ?>

        <!-- <script src="<?= DIRNAME;?>node_modules/jquery/dist/jquery.min.js"></script>
        <script src="<?= DIRNAME;?>node_modules/chart.js/dist/Chart.min.js"></script>
        <script type="text/javascript">var dirname = '<?= DIRNAME; ?>';</script>
        <script type="text/javascript" src="<?= DIRNAME;?>public/js/framework.js"></script>
        <script src="<?= DIRNAME;?>public/js/tinymce/js/tinymce/tinymce.min.js"></script> -->
    </body>
</html>
