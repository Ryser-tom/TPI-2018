<?php session_start();
if(!isset($_SESSION['userId']))header("location: login.php");
if($_SESSION['type'] != 1)header("location: index.php");
require_once('..\php\fonctionsBD_select.php');
require_once('..\php\fonctionsBD_Update.php');
if (isset($_GET['idUser']))updateUserType($_GET['idUser'], $_GET['actualType']);
$users = getAllUsers();
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
                <th scope=\"col\">Nom</th>
                <th scope=\"col\">Prénom</th>
                <th scope=\"col\">Date de naissance</th>
                <th scope=\"col\">Numéro de natel</th>
                <th scope=\"col\">Email</th>
                <th scope=\"col\">Status</th>
              </tr>
            </thead>
            <tbody>
              ";
                foreach ($users as &$value) {
                    echo"
                        <tr>
                            <td><a href=\"adminUpdateUser?userId=".$value['idUtilisateur']."\">".$value['nom']."<a></td>
                            <td>".$value['prenom']."</td>
                            <td>".$value['dateNaissance']."</td>
                            <td>".$value['natel']."</td>
                            <td>".$value['email']."</td>
                    ";
                    if ($value['type'] == 1) {
                        echo"<td><button type=\"button\" class=\"btn btn-warning\" onclick=\"window.location.href='adminUsers.php?idUser=".$value['idUtilisateur']."&actualType=".$value['type']."'\">Administrateur</button></td>";
                    }else{
                        echo"<td><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location.href='adminUsers.php?idUser=".$value['idUtilisateur']."&actualType=".$value['type']."'\">Utilisateur</button></td>";
                    }
                    echo"</tr>";    
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