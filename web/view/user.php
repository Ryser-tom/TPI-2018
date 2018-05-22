<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : user
 * Description : contain all the information of the profile, all vehicle and all locations
 */
session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
require_once('..\php\fonctionsBD_select.php');
require_once('..\php\fonctionsBD_delete.php');
if (isset($_GET['vehicleId']))cancelReservation($_GET['vehicleId'], $_SESSION['userId'], $_GET['startDate'], $_GET['endDate']);
$userReservation = getReservationOf($_SESSION['userId']);
$userVehicle = getVehicleOf($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

  <title>Profil - RedLoca</title>

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
        <?php
            echo"
                <table>
                <tr>
                    <th id=\"tableLabel\">Nom : </th>
                    <td>".$_SESSION['lastName']."</td>
                </tr>
                <tr>
                    <th id=\"tableLabel\">Prénom : </th>
                    <td>".$_SESSION['firstName']."</td>
                </tr>
                <tr>
                    <th id=\"tableLabel\">Email : </th>
                    <td>".$_SESSION['email']."</td>
                </tr>
                <tr>
                    <th id=\"tableLabel\">Téléphone : </th>
                    <td>".$_SESSION['mobile']."</td>
                </tr>
                <tr>
                    <th id=\"tableLabel\">Date de naissance : </th>
                    <td>".$_SESSION['birthDate']."</td>
                </tr>
                </table>
            ";
        ?>
        <a href="updateUser.php"><button class="btn btn-warning " name="submit" type="submit">Modifier les informations</button></a>
        <a href="changePassword.php"><button class="btn btn-warning " name="submit" type="submit">Modifier le mot de passe</button></a>
        <HR/>
        <?php
            echo"
            <table class=\"table\">
            <thead class=\"thead-dark\">
              <tr>
                <th scope=\"col\">immatriculation</th>
                <th scope=\"col\">Marque</th>
                <th scope=\"col\">Model</th>
                <th scope=\"col\">Periode de disponibilité</th>
              </tr>
            </thead>
            <tbody>
              ";
                foreach ($userVehicle as &$value) {
                    echo"
                        <tr>
                            <td><a href=\"editVehicle?vehicleId=".$value['idVehicule']."\">".$value['immatriculation']."<a></td>
                            <td>".$value['marque']."</td>
                            <td>".$value['model']."</td>
                            <td>".$value['dateDebutDisponibilite']." à ".$value['dateDebutDisponibilite']."</td>
                        </tr>
                    ";    
                }
              echo"
            </tbody>
          </table>
            ";
                //Creation of table for reservation.
            echo"
            <table class=\"table\">
            <thead class=\"thead-dark\">
              <tr>
                <th scope=\"col\">immatriculation</th>
                <th scope=\"col\">Marque</th>
                <th scope=\"col\">Model</th>
                <th scope=\"col\">Periode de disponibilité</th>
                <th scope=\"col\"></th>
              </tr>
            </thead>
            <tbody>
              ";
                foreach ($userReservation as &$value) {
                    echo"
                        <tr>
                            <td><a href=\"editVehicle?vehicleId=".$value['idVehicule']."\">".$value['immatriculation']."<a></td>
                            <td>".$value['marque']."</td>
                            <td>".$value['model']."</td>
                            <td>".$value['dateDebut']." à ".$value['dateFin']."</td>
                            <td><button type=\"button\" class=\"btn btn-warning\" onclick=\"window.location.href='user.php?vehicleId=".$value['idVehicule']."&startDate=".$value['dateDebut']."&endDate=".$value['dateFin']."'\">annuler</button></td>
                        </tr>
                    ";    
                }
              echo"
            </tbody>
          </table>
            ";
        ?>
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
  <script src="../js/validate-register.js"></script>
</body>

</html>