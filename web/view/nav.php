  <?php
    $url=explode("/", $_SERVER['HTTP_REFERER']);
    $url = end($url);
    if(strpos($url, '?') !== false) {
        $url=explode("?", $url);
        $url=$url[0];
       }
    $date = date('Y-m-d');
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php if ($url == "index.php") {echo"#page-top";}else{echo"index.php";}?>">
            <img border="0" alt="RedLoca" src="img/logo_RedLoca.png" width="150" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php if ($url == "index.php") {echo"#page-top";}else{echo"index.php";}?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php if ($url == "add.php") {echo"#page-top";}else{echo"add.php";}?>">Ajouter un véhicule</a>
                </li>
                <li class="nav-item">
                <?php
                if (isset($_SESSION['lastName'])) {
                    echo"<a class=\"nav-link\" href=\"user.php\">".$_SESSION['lastName'].$_SESSION['firstName']."</a>";
                }else{
                    echo"<a class=\"nav-link\" href=\"login.php\">connexion / inscription</a>";
                }  
                ?>
                </li>
                <li class="nav-item">
                    <label for="search" class="nav-link" >Louer un véhicule à partir du :</label>
                </li>
                <li class="nav-item">
                    <form action="items.php" method="GET">
                        <input type="date" class="form-control" name="search" id="search" min="<?= $date ?>" value="<?= $date ?>">
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  
  