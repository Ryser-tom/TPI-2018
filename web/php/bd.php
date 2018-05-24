<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : bd
 * Description : contains the database login function and login information.
 */
define('DB_HOST', "127.0.0.1"); //ip address of the database
define('DB_NAME', "redLoca"); //name of the database.
define('DB_USER', "redLoca"); //user.
define('DB_PASS', "oIilPyhSwCufiriv"); //password.
//root password = kFaWJQhZJSJJk9jC

/* This function is used to initialize the connection to the database.  */
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