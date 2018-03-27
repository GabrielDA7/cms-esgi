
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Uteach">
    <meta name="author" content="Louis Decultot">
  </head>

  <body>

    <nav>
      <div id="navbars">
        <ul>
          <li>
            <a href="<?= DIRNAME;?>">Home</a>
          </li>
          <li>
            <a href="<?= DIRNAME.USER_ADD_LINK;?>">inscription</a>
          </li>
          <li>
            <a href="<?= DIRNAME.USER_LIST_LINK;?>">list</a>
          </li>
          <li>
            <a href="<?= DIRNAME.USER_LOGIN_LINK;?>">connexion</a>
          </li>
          <li>
            <a href="<?= DIRNAME.USER_DISCONNECT_LINK;?>">deconnexion</a>
          </li>
          <li>
            <a>
              <?php 
              if(isset($_SESSION['userName'])) { 
                echo $_SESSION['userName']. "-".$_SESSION['premium'];
              } 
              ?>
          </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      	<?php include $viewPath; ?>
    </main>

    <footer>
      <p>&copy; Uteach 2018</p>
    </footer>
    
  </body>
</html>
