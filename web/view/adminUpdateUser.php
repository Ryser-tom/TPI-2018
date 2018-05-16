<?php session_start();
require_once('..\php\fonctionsBD_update.php');
require_once('..\php\fonctionsBD_select.php');
$user = getUser($_GET['userId'])[0];
if (isset($_POST['submit'])) {
  if ((!empty($_POST['lastName'])) && (!empty($_POST['firstName'])) && (!empty($_POST['email'])) && (!empty($_POST['mobile'])) && (!empty($_POST['birthDate'])) && (!empty($_POST['password']))) {
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
    $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        adminUpdateUser($lastName, $firstName, $birthDate, $mobile, $email, $password, $_GET['userId'], $user['mdp']);
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

  <title>modification des informations</title>

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
    <form id="adminUpdateUserForm" action="updateUser.php" method="POST">
     <div class="form-group ">
      <label class="control-label requiredField" for="lastName">
       Nom
      </label>
      <input type="text" class="form-control" id="lastName" name="lastName" value ="<?= $user['nom'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="firstName">
       Pr&eacute;nom
      </label>
      <input type="text" class="form-control" id="firstName" name="firstName" value ="<?= $user['prenom'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
      </label>
      <input type="email" class="form-control" id="email" name="email" value ="<?= $user['email'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mobile">
       natel
      </label>
      <input type="tel" class="form-control" id="mobile" name="mobile" value ="<?= $user['natel'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="birthDate">
       Date de naissance
      </label>
      <input type="date" class="form-control" id="birthDate" name="birthDate" max="<?= date ( 'Y-m-j', strtotime('-18 year' , strtotime($date)));?>" value ="<?= $user['dateNaissance'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="password">
       Mot de passe
      </label>
      <input type="password" class="form-control" id="password" name="password"/>
     </div>
     <div class="form-group">
      <div>
        <input class="btn btn-warning " name="submit" type="submit" value="enregistrer les modifications">
        <input class="btn btn-danger " name="reset" type="reset" value="annuler les changements">
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

  <script src="../js/validate-adminUpdateUser.js"></script>
</body>

</html>