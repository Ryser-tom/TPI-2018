<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content=" Site de E-commerce">
  <meta name="author" content="Tom Ryser">

  <title>E-commerce</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="../css/style.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">E-commerce</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="items.php">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">inscription</a>
          </li>
          <li class="nav-item">
            <form action="items.php" method="GET">
              <label for="search" class="sr-only">Recherche</label>
              <input type="text" class="form-control" name="search" id="search" placeholder="Recherche">
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
            <form action="items.php" method="GET">
                <div>
                    <label for="firstName">Nom</label>
                    <input type="text" id="firstName" name="user_firstName" required />
                <div>
                <div>
                    <label for="name">Prénom</label>
                    <input type="text" id="name" name="user_name" required />
                <div>
                <div>
                    <label for="mail">E-mail</label>
                    <input type="mail" id="mail" name="user_mail" required />
                <div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="user_password" required />
                <div>
                <div>
                    <label for="password2">confirmation mot de passe</label>
                    <input type="password" id="password2" name="user_confirmationPassword" required />
                <div>
            </form>
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