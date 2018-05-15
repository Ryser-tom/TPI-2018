<?php session_start();

require_once('..\php\fonctionsBD_select.php');
echo"zone de test";
if (isset($_POST['submit'])) {
  if ((!empty($_POST['email'])) && (!empty($_POST['password']))) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $login = login($email, $password);
    if (count($login)==1) {
      
    }else{
      echo"erreur dans la base de données";
    }
    header("location: index.php");
  } else {
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content=" Site de E-commerce">
  <meta name="author" content="Tom Ryser">

  <title>Connexion</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="../css/style.css" rel="stylesheet">

</head>

<body id="page-top">

   <!-- Navigation -->
<?php 
  require_once('nav.php');
?>

  <section id="services" class="bg-light">
    <div class="container">
    <div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
    <form id="signupForm" action="login.php" method="POST">
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
      </label>
      <input type="email" class="form-control" id="email" name="email"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="password">
       Mot de passe
      </label>
      <input type="password" class="form-control" id="password" name="password"/>
     </div>
     
     <div class="form-group">
      <div>
       <input class="btn btn-warning " name="submit" type="submit" value="connexion"/>
       <label><a href="register.php">Déja inscrit ?<br> Connectez vous</a></label>
      </div>
     </div>
    </form>
   </div>
  </div>
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

  <!-- plugin jQuery : jquery-validation -->
  <script src="../jquery-validation-1.17.0/dist/jquery.validate.js"></script>

  <script src="../js/validate-login.js"></script>
</body>

</html>