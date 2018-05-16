<?php session_start();

require_once('..\php\fonctionsBD_update.php');
try{
  if (isset($_POST['submit'])) {
    if ((!empty($_POST['actualPassword'])) && (!empty($_POST['newPassword']))&& (!empty($_POST['confirmPassword']))) {
      $actualPassword = filter_input(INPUT_POST, 'actualPassword', FILTER_SANITIZE_STRING);
      $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
      $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
      if ($newPassword == $confirmPassword) {
        updatePassword($newPassword, $actualPassword, $_SESSION['userId']);
      }else{
        throw new Exception('erreur dans la base de donées');
      }
      header("location: index.php");
    } else {
        throw new Exception('vous devez remplir tout les champs');
    }
  }
}
catch(exception $e){
  echo $e->getMessage();
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
    <form id="updatePasswordForm" action="changePassword.php" method="POST">
     <div class="form-group ">
      <label class="control-label requiredField" for="actualPassword">
       Mot de passe actuel
      </label>
      <input type="password" class="form-control" id="actualPassword" name="actualPassword"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="newPassword">
       Nouveau mot de passe
      </label>
      <input type="password" class="form-control" id="newPassword" name="newPassword"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="confirmPassword">
       confirmation
      </label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"/>
     </div>
     
     <div class="form-group">
      <div>
       <input class="btn btn-warning " name="submit" type="submit" value="changer le mot de passe"/>
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

  <script src="../js/validate-password.js"></script>
</body>

</html>