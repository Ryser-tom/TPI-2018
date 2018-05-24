<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : fonctionBD_insert
 * Description : contains all the functions for adding data to the database.
 */
require_once('bd.php');

/* This function allows to insert the information of a user in the database  */
function register($lastName, $firstName, $birthDate, $mobile, $Email, $password)
{
  $password = sha1($password);
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `natel`, `email`, `mdp`, `type`) 
    VALUES (NULL, :nom, :Prenom, :dateNaissance, :natel, :email, :mdp, '0');");
  $request->bindParam(':nom', $lastName, PDO::PARAM_STR);
  $request->bindParam(':Prenom', $firstName, PDO::PARAM_STR);
  $request->bindParam(':dateNaissance', $birthDate, PDO::PARAM_STR);
  $request->bindParam(':natel', $mobile, PDO::PARAM_STR);
  $request->bindParam(':email', $Email, PDO::PARAM_STR);
  $request->bindParam(':mdp', $password, PDO::PARAM_STR);
  $request->execute();
  return $request;
}

/* This function allows to insert a new vehicle in the database */
function addVehicle($numberPlate, $mark, $model, $class, $nbPlaces, $color, $image, $start, $end, $userId)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`vehicules` (`immatriculation`, `marque`, `model`, `nbPlace`, `couleur`, `image`, `dateDebutDisponibilite`, `dateFinDisponibilite`, `categories_idcategorie`, `utilisateurs_idutilisateur`) 
    VALUES (:numberPlate, :mark, :model, :nbPlaces, :color, :image, :start, :end, :class, :userId);");
  $request->bindParam(':numberPlate', $numberPlate, PDO::PARAM_STR);
  $request->bindParam(':mark', $mark, PDO::PARAM_STR);
  $request->bindParam(':model', $model, PDO::PARAM_STR);
  $request->bindParam(':class', $class, PDO::PARAM_INT);
  $request->bindParam(':nbPlaces', $nbPlaces, PDO::PARAM_INT);
  $request->bindParam(':color', $color, PDO::PARAM_STR);
  $request->bindParam(':image', $image, PDO::PARAM_STR);
  $request->bindParam(':start', $start, PDO::PARAM_STR);
  $request->bindParam(':end', $end, PDO::PARAM_STR);
  $request->bindParam(':userId', $userId, PDO::PARAM_INT);
  $request->execute();
  return $request;
}

/* This function allows to insert a new location in the database */
function addReservation($userId, $vehicleId, $startDate, $endDate)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`reservation` (`dateDebut`, `dateFin`, `Vehicules_idVehicule`, `utilisateurs_idUtilisateur`) 
    VALUES (:startDate, :endDate, :vehicleId, :userId);");
  $request->bindParam(':startDate', $startDate, PDO::PARAM_STR);
  $request->bindParam(':endDate', $endDate, PDO::PARAM_STR);
  $request->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
  $request->bindParam(':userId', $userId, PDO::PARAM_INT);
  $request->execute();
  return $request;
}

?>