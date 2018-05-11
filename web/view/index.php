<?php session_start();

require_once('..\php\fonctionsBD_select.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content=" Site de E-commerce">
  <meta name="author" content="Tom Ryser">

  <title>RedLoca</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="../css/style.css" rel="stylesheet">

</head>

<body id="page-top">

 <!-- Navigation -->
<?php 
  require_once('nav.php');
?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenu sur E-commerce</h1>
      <form action="items.php" method="GET">
        <div>
          <label for="name"></label>
          <input type="text" id="name" name="user_name" />
        <div>
      </form>
    </div>
  </header>

  <section id="recentlyAdded" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <?php
            $vehicle = getRecentVehicle();
          ?>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Contact us</h2>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis,
            id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.</p>
        </div>
      </div>
    </div>
  </section>

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