<?php session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
require_once('..\php\fonctionsBD_select.php');
try{
  if (isset($_POST['submit'])) {
    if ((!empty($_POST['numberPlate'])) && (!empty($_POST['mark'])) && (!empty($_POST['model'])) && (!empty($_POST['class'])) && (!empty($_POST['nbPlaces'])) && (!empty($_POST['color'])) && (!empty($_POST['start']))) {
      $numberPlate = filter_input(INPUT_POST, 'numberPlate', FILTER_SANITIZE_STRING);
      $mark = filter_input(INPUT_POST, 'mark', FILTER_SANITIZE_STRING);
      $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
      $class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT);
      $nbPlaces = filter_input(INPUT_POST, 'nbPlaces', FILTER_SANITIZE_NUMBER_INT);
      $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
      $image = filterImage();
      $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
      if($_POST['end'] !== ""){
        $end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
      }else{
        $end = NULL;
      }
      require_once('..\php\fonctionsBD_insert.php');
      addVehicle($numberPlate, $mark, $model, $class, $nbPlaces, $color, $image, $start, $end, $_SESSION['userId']);
    } else {
      throw new Exception("Veuillez remplir tous les champs");
    }
  }
}catch(Exception $e){
  echo $e;
}

function filterImage(){
  try{
    if(!empty($_FILES["image"])){
      if(getimagesize($_FILES["image"]["tmp_name"])==0){
        throw new Exception("ce fichier n'est pas une image");
        exit();
      }
      $pieces = explode(".", $_FILES["image"]['name']);
      $imgName = (uniqid() . "." . end($pieces));
      if (!move_uploaded_file($_FILES["image"]['tmp_name'], "../mediaUser/".$imgName)) {
        throw new Exception("le fichier n'as pas pu être transféré.");
        exit();
      }
    }
  }
  catch(Exception $e){
    throw($e);
  }
  return $imgName;
}
$class = getClass();
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
    <form id="addVehicle" action="add.php" enctype="multipart/form-data" method="POST">
     <div class="form-group ">
      <label class="control-label requiredField" for="numberPlate">Immatriculation</label>
      <input type="text" class="form-control" id="numberPlate" name="numberPlate" placeholder="GE 123 123"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mark">Marque</label>
      <input type="text" class="form-control" id="mark" name="mark"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="model">Modèle</label>
      <input type="text" class="form-control" id="model" name="model"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="class">catégorie</label>
      <select class="selectpicker" id="class" name="class">
        <?php
          echo"<optgroup label='voiture'>";
          foreach ($class as $key => $value) {
            if ($value['nomTypeCategorie'] == "voiture") {
              echo"<option value='".$value['idCategorie']."'>".$value['nomCategorie']."</option>";
            }
          }
          echo"<optgroup label='moto'>";
          foreach ($class as $key => $value) {
            if ($value['nomTypeCategorie'] == "moto") {
              echo"<option value='".$value['idCategorie']."'>".$value['nomCategorie']."</option>";
            }
          }
        ?>
      </select>

     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="nbPlaces">Nombre de place</label>
      <input type="text" class="form-control" id="nbPlaces" name="nbPlaces"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="color">couleur</label>
      <input type="text" class="form-control" id="color" name="color"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="image">image</label>
      <input enctype="multipart/form-data" type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpeg"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="start">date de début de disponibilité</label>
      <input type="date" class="form-control" id="start" name="start" min="<?= date('Y-m-d');?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="end">date de fin de disponibilité</label>
      <input type="date" class="form-control" id="end" name="end" min="<?= date ( 'Y-m-j', strtotime('+1 day' , strtotime($date)));?>"/>
     </div>
     <div class="form-group">
      <div>
        <input class="btn btn-warning " name="submit" type="submit" value="Ajouter véhicule">
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

  <script src="../js/validate-addVehicle.js"></script>

</body>

</html>