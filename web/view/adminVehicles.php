<?php session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
if($_SESSION['type'] != 1)header("location: index.php");
require_once('..\php\fonctionsBD_select.php');
$vehicles = getAllVehicles();
?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content=" Site de E-commerce">
  <meta name="author" content="Tom Ryser">

  <title>administration utilisateurs</title>

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
              </tr>
            </thead>
            <tbody>
              ";
                foreach ($vehicles as &$value) {
                    echo"
                        <tr>
                            <td><a href=\"editVehicle?idVehicle=".$value['idVehicule']."\">".$value['immatriculation']."<a></td>
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