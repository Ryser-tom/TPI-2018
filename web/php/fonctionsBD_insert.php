<?php
require_once('bd.php');

/* Fonction permettant de s'enregistrer.  */
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
}

/* fonction permettant d'ajouter un vehicule à la base de donnée */
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
}

/* fonction permettant d'ajouter un type de catégorie à la base de donnée */
function addTypeCategory($type)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`type_categories` (`nomTypeCategorie`) 
    VALUES (:type);");
  $request->bindParam(':type', $type, PDO::PARAM_STR);
  $request->execute();
}

/* fonction permettant d'ajouter une catégorie à la base de donnée */
function addCategory($nomCategorie, $PrixCategory, $typeCategorie)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`categories` (`nomCategorie`, `prixCategorie`, `type_categories_idTypeCategorie`) 
    VALUES (:nomCategorie, :PrixCategory, :typeCategorie);");
  $request->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
  $request->bindParam(':PrixCategory', $PrixCategory, PDO::PARAM_INT);
  $request->bindParam(':typeCategorie', $typeCategorie, PDO::PARAM_INT);
  $request->execute();
}

/* fonction permettant d'ajouter une catégorie à la base de donnée */
function addReservation($dateDebut, $dateFin, $idVehicule, $idUtilisateur)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`reservation` (`dateDebut`, `dateFin`, `Vehicules_idVehicule`, `utilisateurs_idUtilisateur`) 
    VALUES (:dateDebut, :dateFin, :idVehicule, :idUtilisateur);");
  $request->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
  $request->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
  $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
  $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
  $request->execute();
}

?>


