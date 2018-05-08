<?php
define('DB_HOST', "127.0.0.1"); //adresse ip de la base.
define('DB_NAME', "redLoca"); //nom de la base de donnée.
define('DB_USER', "redLoca"); //utilisateur.
define('DB_PASS', "oIilPyhSwCufiriv"); //mdp.
//root password = kFaWJQhZJSJJk9jC
/* Fonction permettant la connexion à la base de données.  */
function getConnexion() {
  static $dbb = null;
  if ($dbb === null) {
    try {
      $connectionString = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '';
      $dbb = new PDO($connectionString, DB_USER, DB_PASS);
      $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbb->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }
  return $dbb;
}
?>