<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : item
 * Description : information on a vehicle and modal for confirmation of location.
 */
session_start();

require_once('..\php\fonctionsBD_select.php');
$vehicle = getVehicleInfosReservation($_GET['vehicleId'], $_GET['date']);
if ($vehicle == null) {
  $vehicle = getVehicleInfos($_GET['vehicleId'])[0];
}else{
  $vehicle = $vehicle[0];
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

    <title>Liste des véhicules - RedLoca</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">

  </head>

  <body>
   <!-- Navigation -->
<?php 
  require_once('nav.php');
?>
  <section id="recentlyAdded" class="bg-light">
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
        <img id="vehicleImageShow" src="../mediaUser/<?=$vehicle['image']?>"/>
        </div>
        <div class="col-sm-12 col-md-4 vehicleInfos">
        <table>
        <tr>
          <th>Marque : </th>
          <td><?=$vehicle['marque']?></td>
        </tr>
        <tr>
          <th>Modèl : </th>
          <td><?=$vehicle['model']?></td>
        </tr>
        <tr>
          <th>Nombre de places : </th>
          <td><?=$vehicle['nbPlace']?> Place(s)</td>
        </tr>
        <tr>
          <th>couleur : </th>
          <td><?=$vehicle['couleur']?></td>
        </tr>
        <tr>
          <th>catégorie : </th>
          <td><?=$vehicle['nomCategorie']?></td>
        </tr>
        <tr>
          <th>prix du véhicule par jour : </th>
          <td><div id="price"><?=$vehicle['prixCategorie']?></div> Chfs.-</td>
        </tr>
        <tr>
          <th><label class="control-label requiredField" for="start">Location du </label></th>
          <td><input type="date" disabled class="form-control" id="start" name="start" value="<?=$_GET['date']?>"/></td>
        </tr>
        <?php
          if(isset($_SESSION['userId'])){
            echo'
              <tr>
                <th><label class="control-label requiredField" for="end">jusqu\'au </label></th>
                <td><input type="date" class="form-control" id="end" name="end" min="'.$_GET['date'].'" max="'.$vehicle['finDisponibilite'].'"/></td>
              </tr>
              <tr>
                <td>
                  <button id="rent" type="button" disabled="true" class="btn btn-warning" data-toggle="modal" data-target="#confirmation">Louer le véhicule</button>
                </td>
                <td class="totalRent"></td>        
              </tr>
            ';
          }
        ?>
        </table>
        </div>
    </div>
  </div>
</section>

    <!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
  <p class="m-0 text-center text-white">RedLoca CFPT-I 2018</p>
  </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <form action="../php/reservation.php" method="POST">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmation">Confirmation de la location</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" value="<?=$_GET['vehicleId']?>" name="vehicleId"/>
          <input type="hidden" value="<?=$_GET['date']?>" name="startDate"/>
          <input id="endDateForm" type="hidden" value="" name="endDate"/>
          <table>
            <tr>
              <th>Marque : </th>
              <td><?=$vehicle['marque']?></td>
            </tr>
            <tr>
              <th>Modèl : </th>
              <td><?=$vehicle['model']?></td>
            </tr>
            <tr>
              <th>Nombre de places : </th>
              <td><?=$vehicle['nbPlace']?> Place(s)</td>
            </tr>
            <tr>
              <th>couleur : </th>
              <td><?=$vehicle['couleur']?></td>
            </tr>
            <tr>
              <th>catégorie : </th>
              <td><?=$vehicle['nomCategorie']?></td>
            </tr>
            <tr>
              <th>prix du véhicule par jour : </th>
              <td><div id="price"><?=$vehicle['prixCategorie']?></div> Chfs.-</td>
            </tr>
            <tr>
              <th>Location du :</th>
              <td><?=$_GET['date']?></td>
            </tr>
            <tr>
              <th>jusqu'au :</th>
              <td id="endDate"></td>
            </tr>
            <tr>
              <th>Prix de la location</th>
              <td class="totalRent"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <input type="submit" class="btn btn-warning" value="Confirmer la réservation" name="submit"/>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="../js/scrolling-nav.js"></script>
  <script>
    $("#end").change(function() {
      var T = $("#end").val();
      if ( $("#end").val()=="" ) {
        $("#rent").prop({
          "disabled" : true
        });
        $('.totalRent').text('')
      }else{
        $("#rent").prop({
          "disabled" : false
        });       
        $('.totalRent').text('Prix total de la location '+ 
        locationPrice() + 
        ' chf.-');
        $('#endDate').text($("#end").val());
        $("#endDateForm").attr({
          "value" : $("#end").val()
        });
      } 
    });

    function locationPrice() {
      var parts =$("#end").val().split('-');
      var EndDate = new Date(parts[0], parts[1] - 1, parts[2]);
      var parts =$("#start").val().split('-');
      var StartDate = new Date(parts[0], parts[1] - 1, parts[2]);
      var nbDays = (    
        Date.UTC(EndDate.getFullYear(), EndDate.getMonth(), EndDate.getDate()) -
        Date.UTC(StartDate.getFullYear(), StartDate.getMonth(), StartDate.getDate())
      ) / 86400000;
      var price = $('#price').text();
      var result = price * (nbDays + 1);
      return result;
    }
  </script>
  </body>

</html>
