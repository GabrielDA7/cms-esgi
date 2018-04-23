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


        <nav id="dashboard-nav" class="container-fluid top-menu">
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

        <section id="dashboard-left-menu">
            <div class="container-fluid">
                  <nav>
                      <ul id="main-left-menu">
                         <li><a href="<?= DIRNAME.STATISTIC_INDEX_BACK_LINK;?>"><i class="fas fa-chart-area"></i>Statistics</a></li>
                         <li><a href=""><i class="fas fa-columns"></i>Pages</a></li>
                         <li><a href=""><i class="fas fa-graduation-cap"></i>Courses</a></li>
                         <li class="sub-menu">
                           <a href="">
                             <i class="fas fa-graduation-cap"></i>Formations<i class="fas fa-chevron-down"></i>
                           </a>
                           <ul class="submenu-item">
                             <li><a href="<?= DIRNAME . TRAINNING_LIST_BACK_LINK; ?>">Liste des formations</a></li>
                             <li><a href="#">Ajouter une formation</a></li>
                           </ul>
                         </li>
                         <li><a href=""><i class="fas fa-film"></i>Videos</a></li>
                         <li><a href=""><i class="fas fa-comments"></i>Comments</a></li>
                         <li><a href=""><i class="fas fa-gem"></i>Premium</a></li>
                         <li class="sub-menu">
                           <a href="<?= DIRNAME.USER_LIST_BACK_LINK;?>">
                             <i class="fas fa-users"></i>Users<i class="fas fa-chevron-down"></i>
                           </a>
                           <ul class="submenu-item">
                             <li><a href="#">Role management</a></li>
                           </ul>
                         </li>
                         <li class="sub-menu">
                           <a href="">
                             <i class="fas fa-cogs"></i>Parameters<i class="fas fa-chevron-down"></i>
                           </a>
                           <ul class="submenu-item">
                             <li><a href="#">General parameters</a></li>
                             <li><a href="#">Appearance</a></li>
                           </ul>
                         </li>
                      </ul>
                  </nav>
            </div>
        </section>

        <section id="dashboard-content">
            <section class="container">
                <?php include $viewPath; ?>
            </section>
        </section>

        <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="node_modules/chart.js/dist/Chart.min.js"></script>
        <script type="text/javascript" src="public/js/framework.js"></script>
    </body>
</html>
