<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : updateUser
 * Description : contain a form with all the information of the user, so he can modify it.
 */
session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
require_once('..\php\fonctionsBD_update.php');

try{
  if (isset($_POST['submit'])) {
    if ((!empty($_POST['lastName'])) && (!empty($_POST['firstName'])) && (!empty($_POST['email'])) && (!empty($_POST['mobile'])) && (!empty($_POST['birthDate'])) && (!empty($_POST['password']))) {
      $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
      $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
      $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
          if(updateUser($lastName, $firstName, $birthDate, $mobile, $email, $password, $_SESSION['userId'])){
            throw new exception("TRUE");
          }else{
            throw new exception("FALSE");
          }
    } else {
        throw new exception("Veuillez remplir tous les champs");
    }
  }
}
catch(exception $e){
  if($e->getMessage() == "TRUE"){
    $info = '<div class="alert alert-success">Vos modification ont été enregistrée avec succès.</div>';
    $_SESSION['lastName'] = $lastName;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['email'] = $email;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['birthDate'] = $birthDate;
  }elseif($e->getMessage() == "FALSE"){
    $info = '<div class="alert alert-warning">une erreur est survenue.</div>';
  }else{
    $info = '<div class="alert alert-warning">'.$e->getMessage().'</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

  <title>modification du profil - RedLoca</title>

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
    <form id="updateUserForm" action="updateUser.php" method="POST">
     <div class="form-group ">
     <?php
        if(isset($info)){
            echo $info;
        }?>
      <label class="control-label requiredField" for="lastName">
       Nom
      </label>
      <input type="text" class="form-control" id="lastName" name="lastName" value ="<?= $_SESSION['lastName'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="firstName">
       Pr&eacute;nom
      </label>
      <input type="text" class="form-control" id="firstName" name="firstName" value ="<?= $_SESSION['firstName'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
      </label>
      <input type="email" class="form-control" id="email" name="email" value ="<?= $_SESSION['email'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mobile">
       natel
      </label>
      <input type="tel" class="form-control" id="mobile" name="mobile" value ="<?= $_SESSION['mobile'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="birthDate">
       Date de naissance
      </label>
      <input type="date" class="form-control" id="birthDate" name="birthDate" max="<?= date ( 'Y-m-j', strtotime('-18 year' , strtotime($date)));?>" value ="<?= $_SESSION['birthDate'] ?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="password">
       Mot de passe actuel
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
  <script src="../js/validate-updateUser.js"></script>
</body>

</html>