<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : editVehicle
 * Description : Contains a form to edit a vehicle informations.
 */

session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
if(!isset($_GET['vehicleId']))header("location: index.php");
require_once('..\php\fonctionsBD_select.php');
$vehicle = getVehicleInfos($_GET['vehicleId'])['0'];
try{
  if (isset($_POST['submit'])) {
    if ((!empty($_POST['numberPlate'])) && (!empty($_POST['mark'])) && (!empty($_POST['model'])) && (!empty($_POST['class'])) && (!empty($_POST['nbPlaces'])) && (!empty($_POST['color'])) && (!empty($_POST['start']))) {
      $numberPlate = filter_input(INPUT_POST, 'numberPlate', FILTER_SANITIZE_STRING);
      $mark = filter_input(INPUT_POST, 'mark', FILTER_SANITIZE_STRING);
      $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
      $class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT);
      $nbPlaces = filter_input(INPUT_POST, 'nbPlaces', FILTER_SANITIZE_NUMBER_INT);
      $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
      $image = filterImage($vehicle['image']);
      $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
      if($_POST['end'] !== ""){
        $end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
      }else{
        $end = NULL;
      }
      require_once('..\php\fonctionsBD_update.php');
      if(updateVehicle($_GET['vehicleId'], $numberPlate, $mark, $model, $class, $nbPlaces, $color, $image, $start, $end, $_SESSION['userId'], $_SESSION['type'])){
        $info = '<div class="alert alert-success" role="alert">Votre véhicule a été mis à jour avec succès</div>';
        $vehicle = getVehicleInfos($_GET['vehicleId'])['0'];
      }else{
        throw new Exception('une erreur est survenue.');
      }
    } else {
      throw new Exception('Veuillez remplir tous les champs');
    }
  }
}catch(Exception $e){
  if(!isset($info)){
  $info = '<div class="alert alert-warning" role="alert">'.$e.'</div>';
  }else{
    $info = $e;
  }
}

function filterImage($imgOld){
  try{
    if($_FILES['image']['tmp_name'] != null){
      if(!empty($_FILES["image"])){
        if(getimagesize($_FILES["image"]["tmp_name"])==0){
          throw new Exception('ce fichier n\'est pas une image');
          exit();
        }
        $pieces = explode(".", $_FILES["image"]['name']);
        $imgName = (uniqid() . "." . end($pieces));
        if (!move_uploaded_file($_FILES["image"]['tmp_name'], "../mediaUser/".$imgName)) {
          
          exit();
        }
      }
    }else{
      $imgName=$imgOld;
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
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

  <title>ajouter un véhicule - RedLoca</title>

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
    <form id="updateVehicle" action="updateVehicle.php?vehicleId=<?=$_GET['vehicleId']?>" enctype="multipart/form-data" method="POST">
     <div class="form-group ">
     <?php
        if(isset($info)){
          echo$info;
        }
      ?>
      <label class="control-label requiredField" for="numberPlate">Immatriculation</label>
      <input type="text" class="form-control" id="numberPlate" name="numberPlate" placeholder="GE 123 123" value="<?=$vehicle['immatriculation']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mark">Marque</label>
      <input type="text" class="form-control" id="mark" name="mark" value="<?=$vehicle['marque']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="model">Modèle</label>
      <input type="text" class="form-control" id="model" name="model" value="<?=$vehicle['model']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="class">catégorie</label>
      <select class="selectpicker" id="class" name="class" >
        <?php
          echo"<optgroup label='voiture'>";
          foreach ($class as $key => $value) {
            if ($value['nomTypeCategorie'] == "voiture") {
              if($vehicle['nomCategorie']==$value['nomCategorie']){
                echo"<option value='".$value['idCategorie']." selected'>".$value['nomCategorie']."</option>";
              }else{
                echo"<option value='".$value['idCategorie']."'>".$value['nomCategorie']."</option>";
              }
              
            }
          }
          echo"<optgroup label='moto'>";
          foreach ($class as $key => $value) {
            if ($value['nomTypeCategorie'] == "moto") {
              if($vehicle['nomCategorie']==$value['nomCategorie']){
                echo"<option value='".$value['idCategorie']."' selected'>".$value['nomCategorie']."</option>";
              }else{
              echo"<option value='".$value['idCategorie']."'>".$value['nomCategorie']."</option>";
              }
            }
          }
        ?>
      </select>

     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="nbPlaces">Nombre de place</label>
      <input type="text" class="form-control" id="nbPlaces" name="nbPlaces" value="<?=$vehicle['nbPlace']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="color">couleur</label>
      <input type="text" class="form-control" id="color" name="color" value="<?=$vehicle['couleur']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="image">image (ne choississez une image que si vous voulez changer l'ancienne)</label>
      <input enctype="multipart/form-data" type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpeg"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="start">date de début de disponibilité</label>
      <input type="date" class="form-control" id="start" name="start" min="" value="<?=$vehicle['debutDisponibilite']?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="end">date de fin de disponibilité</label>
      <input type="date" class="form-control" id="end" name="end" min="" value="<?=$vehicle['finDisponibilite']?>"/>
     </div>
     <div class="form-group">
      <div>
        <input class="btn btn-warning " name="submit" type="submit" value="Modifier">
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
  
  <!-- plugin jQuery : jquery-validation -->
  <script src="../jquery/jquery-validation-1.17.0/dist/jquery.validate.js"></script>
  <script src="../js/validate-updateVehicle.js"></script>

</body>

</html>