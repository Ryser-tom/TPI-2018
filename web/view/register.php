<?php session_start();
if(isset($_SESSION['userId']))header("location: index.php");
require_once('..\php\fonctionsBD_insert.php');

if (isset($_POST['submit'])) {
  if ((!empty($_POST['lastName'])) && (!empty($_POST['firstName'])) && (!empty($_POST['email'])) && (!empty($_POST['mobile'])) && (!empty($_POST['birthDate'])) && (!empty($_POST['password'])) && (!empty($_POST['confirmPassword']))) {
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
    $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
    if($password == $confirmPassword){
    register($lastName, $firstName, $birthDate, $mobile, $email, $password);
    echo "Succès";
    //mot de passe pas identique
    }
  } else {
      echo "Veuillez remplir tous les champs";
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

  <title>Inscription</title>

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
    <form id="registerForm" action="register.php" method="POST">
     <div class="form-group ">
      <label class="control-label requiredField" for="lastName">
       Nom
      </label>
      <input type="text" class="form-control" id="lastName" name="lastName"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="firstName">
       Pr&eacute;nom
      </label>
      <input type="text" class="form-control" id="firstName" name="firstName"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
      </label>
      <input type="email" class="form-control" id="email" name="email"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mobile">
       natel
      </label>
      <input type="tel" class="form-control" id="mobile" name="mobile"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="birthDate">
       Date de naissance
      </label>
      <input type="date" class="form-control" id="birthDate" name="birthDate" max="<?= date ( 'Y-m-j', strtotime('-18 year' , strtotime($date)));?>" value="<?= date ( 'Y-m-j', strtotime('-18 year' , strtotime($date)));?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="password">
       Mot de passe
      </label>
      <input type="password" class="form-control" id="password" name="password"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="confirmPassword">
       Confirmation du mot de passe
      </label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"/>
     </div>
     <div class="form-group">
      <div>
        <input class="btn btn-warning " name="submit" type="submit" value="s'enregistrer">
       <label><a href="login.php">Déja inscrit ?<br> Connectez vous</a></label>
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

  <script src="../js/validate-register.js"></script>

</body>

</html>