<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : adminVehicles
 * Description : contains the list of all vehicle in the DB.
 */
session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
if($_SESSION['type'] != 1)header("location: index.php");
require_once('..\php\fonctionsBD_select.php');
require_once('..\php\fonctionsBD_Delete.php');
if (isset($_GET['idVehicle'], $_GET['delete']))deleteVehicle($_GET['idVehicle']);
$vehicles = getAllVehicles();
?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RedLoca">
  <meta name="author" content="Tom Ryser">

  <title>administration utilisateurs - RedLoca</title>

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
            <table class=\"table\">
            <thead class=\"thead-dark\">
              <tr>
                <th scope=\"col\">immatriculation</th>
                <th scope=\"col\">marque</th>
                <th scope=\"col\">model</th>
                <th scope=\"col\">nombre de places</th>
                <th scope=\"col\">couleur</th>
                <th scope=\"col\">image</th>
                <th scope=\"col\" class=\"right\">début disponibilité</th>
                <th scope=\"col\">fin disponibilité</th>
                <th scope=\"col\">propriétaire</th>
                <th scope=\"col\">catégorie</th>
                <th scope=\"col\"></th>
              </tr>
            </thead>
            <tbody>
              ";
                foreach ($vehicles as &$value) {
                    echo"
                        <tr>
                            <td><a href=\"updateVehicle?vehicleId=".$value['idVehicule']."\">".$value['immatriculation']."<a></td>
                            <td>".$value['marque']."</td>
                            <td>".$value['model']."</td>
                            <td>".$value['nbPlace']."</td>
                            <td>".$value['couleur']."</td>
                            <td>".$value['image']."</td>
                            <td class=\"right\">".$value['dateDebutDisponibilite']."</td>";
                    if ($value['dateFinDisponibilite'] == null) {
                        echo"<td>non définie</td>";
                    }else{
                        echo"<td>".$value['dateFinDisponibilite']."</td>";
                    }
                            
                    echo"
                            <td>".$value['nom']."  ".$value['prenom']."</td>
                            <td>".$value['nomCategorie']."</td>
                            <td><button type=\"button\" class=\"btn btn-warning\" onclick=\"window.location.href='adminVehicles.php?idVehicle=".$value['idVehicule']."&delete=True'\">Effacer</button></td>
                        </tr>";    
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