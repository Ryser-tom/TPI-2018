<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : login
 * Description : contain a form to log in.
 */
session_start();
if(isset($_SESSION['userId']))header("location: login.php");
require_once('..\php\fonctionsBD_select.php');
try{
  if (isset($_POST['submit'])) {
    if ((!empty($_POST['email'])) && (!empty($_POST['password']))) {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $login = login($email, $password);
      if (count($login)==1) {
        $_SESSION['userId'] = $login['0']['idUtilisateur'];
        $_SESSION['lastName'] = $login['0']['nom'];
        $_SESSION['firstName'] = $login['0']['prenom'];
        $_SESSION['birthDate'] = $login['0']['dateNaissance'];
        $_SESSION['mobile'] = $login['0']['natel'];
        $_SESSION['email'] = $login['0']['email'];
        $_SESSION['type'] = $login['0']['type'];
      }else{
        throw new Exception("L'email ou le mot de passe ne correspont pas");
      }
      header("location: index.php");
    } else {
      throw new Exception('vous devez remplir tout les champs');
    }
  }
}
catch(exception $e){
  $info = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

  <title>Connexion - RedLoca</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  
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
      <?php
        if(isset($info)){
          echo'<div class="alert alert-warning">'.$info.'.</div>';
        }
      ?>
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
       <label><a href="register.php">pas encore inscrit ?<br> Enregistrez vous</a></label>
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
    <p class="m-0 text-center text-white">RedLoca CFPT-I 2018</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../jquery/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="../js/scrolling-nav.js"></script>

  <!-- plugin jQuery : jquery-validation -->
  <script src="../jquery/jquery-validation-1.17.0/dist/jquery.validate.js"></script>
  <script src="../js/validate-login.js"></script>
</body>

</html>