
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
            <a href="<?= DIRNAME;?>user/add">inscription</a>
          </li>
          <li>
            <a href="<?= DIRNAME;?>user/list">list</a>
          </li>
          <li>
            <a href="<?= DIRNAME;?>user/login">connexion</a>
          </li>
          <li>
            <a href="<?= DIRNAME;?>user/disconnect">deconnexion</a>
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
      	<?php include "views/".$this->v; ?>
    </main>

    <footer>
      <p>&copy; Uteach 2018</p>
    </footer>
    
  </body>
</html>
