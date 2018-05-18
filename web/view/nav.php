  <?php
    $url=$_SERVER['PHP_SELF'];
    $break = Explode('/', $url);
    $file = $break[count($break) - 1];
    $date = date('Y-m-d');
    if(!isset($_GET['search'])){
        $search = $date;
    }else{
        $search = $_GET['search'];
    }
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php if ($file == "index.php") {echo"#page-top";}else{echo"index.php";}?>">
            <img border="0" alt="RedLoca" src="img/logo_RedLoca.png" width="150" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php if ($file == "index.php") {echo"#page-top";}else{echo"index.php";}?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php if ($file == "add.php") {echo"#page-top";}else{echo"add.php";}?>">Ajouter un véhicule</a>
                </li>
                <li class="nav-item">
                <?php
                if (isset($_SESSION['userId'])) {
                    echo"
                        <li class=\"nav-item dropdown\">
                            <a class=\"nav-link dropdown-toggle\" href=\"user.php\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                            ". $_SESSION['lastName']." ".$_SESSION['firstName'] ."
                            </a>
                            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                            <a class=\"dropdown-item\" href=\"user.php\">profil</a>
                        ";
                        if($_SESSION['type'] == 1){
                            echo "<div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"adminUsers.php\">Administration utilisateurs</a>
                                <a class=\"dropdown-item\" href=\"adminVehicles.php\">Administration vehicules</a>";
                        }
                        echo"
                        <div class=\"dropdown-divider\"></div>
                            <a class=\"dropdown-item\" href=\"../php/logout.php\">Déconnexion</a>
                            </div>
                        </li>
                    ";
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
                        <input type="date" class="form-control" name="search" id="search" min="<?= $date ?>" value="<?= $search ?>">
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Chercher</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  
  