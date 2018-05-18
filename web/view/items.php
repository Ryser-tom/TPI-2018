<?php session_start();

require_once('..\php\fonctionsBD_select.php');
$vehicle = getAllVehiclesAvaible($_GET['search']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=" Site de E-commerce">
  <meta name="author" content="Tom Ryser">

    <title>Liste des véhicules</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">

  </head>

  <body>
   <!-- Navigation -->
<?php 
  require_once('nav.php');
?>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Page Heading
        <small>Secondary Text</small>
      </h1>
      <?php
      $i = 0;
      foreach ($vehicle as $key => $value) {
        if($i==0)echo'<div class="row">';
        if($i%3 == 0)echo'</div><div class="row">';
        echo'
            <div class="col-lg-4 col-sm-6 portfolio-item">
              <div class="card h-100">
                <a href="item.php?vehicleId='.$value['idVehicule'].'"><img class="card-img-top" src="../mediaUser/'.$value['image'].'" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="item.php?vehicleId='.$value['idVehicule'].'">'.$value['marque'].' '.$value['model'].'</a>
                  </h4>
                  <p class="card-text">
                    places: '.$value['nbPlace'].'
                  </p>
                  <p class="card-text">
                    couleur: '.$value['couleur'].'
                  </p>
                  <p class="card-text">
                    catégorie: '.$value['categorie'].'
                  </p>
                </div>
              </div>
            </div>
        ';$i++;}
      ?>
      </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; E-commerce 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="../jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom JavaScript for this theme -->
  <script src="../js/scrolling-nav.js"></script>
  </body>

</html>
