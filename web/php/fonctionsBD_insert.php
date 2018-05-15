<?php
require_once('bd.php');

/* Fonction permettant de s'enregistrer.  */
function register($lastName, $firstName, $birthDate, $mobile, $Email, $password)
{
  $password = sha1($password);
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `utilisateurs` (`idutilisateur`, `nom`, `prenom`, `dateNaissance`, `natel`, `email`, `mdp`, `type`) 
  VALUES (NULL, :nom, :prenom, :dateNaissance, :natel, :email, :mdp, 0);");
  $request->bindParam(':nom', $lastName, PDO::PARAM_STR);
  $request->bindParam(':Prenom', $firstName, PDO::PARAM_STR);
  $request->bindParam(':dateNaissance', $birthDate, PDO::PARAM_STR);
  $request->bindParam(':natel', $mobile, PDO::PARAM_STR);
  $request->bindParam(':email', $Email, PDO::PARAM_STR);
  $request->bindParam(':mdp', $password, PDO::PARAM_STR);
  $request->execute();
}

/* fonction permettant d'ajouter un vehicule à la base de donnée */
function addVehicle($immatriculation, $marque, $modele, $nbPlace, $couleur, $image, $dateDebutDisponibilite, $categories_idcategorie, $utilisateurs_idutilisateur)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`vehicules` (`immatriculation`, `marque`, `modele`, `nbPlace`, `couleur`, `image`, `dateDebutDisponibilite`, `categories_idcategorie`, `utilisateurs_idutilisateur`) 
    VALUES (':immatriculation', ':marque', ':modele', ':nbPlace', 'Orange', ':image', 'dateDebutDisponibilite', ':categories_idcategorie', ':utilisateurs_idutilisateur');");
  $request->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
  $request->bindParam(':marque', $marque, PDO::PARAM_STR);
  $request->bindParam(':modele', $modele, PDO::PARAM_STR);
  $request->bindParam(':nbPlace', $nbPlace, PDO::PARAM_INT);
  $request->bindParam(':couleur', $couleur, PDO::PARAM_STR);
  $request->bindParam(':image', $image, PDO::PARAM_STR);
  $request->bindParam(':dateDebutDisponibilite', $dateDebutDisponibilite, PDO::PARAM_STR);
  $request->bindParam(':categories_idcategorie', $categories_idcategorie, PDO::PARAM_INT);
  $request->bindParam(':utilisateurs_idutilisateur', $utilisateurs_idutilisateur, PDO::PARAM_INT);
  $request->execute();
}

/* fonction permettant d'ajouter un type de catégorie à la base de donnée */
function addTypeCategory($type)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`type_categories` (`nomTypeCategorie`) 
    VALUES (':type');");
  $request->bindParam(':type', $type, PDO::PARAM_STR);
  $request->execute();
}

/* fonction permettant d'ajouter une catégorie à la base de donnée */
function addCategory($nomCategorie, $PrixCategory, $typeCategorie)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`categories` (`nomCategorie`, `prixCategorie`, `type_categories_idTypeCategorie1`) 
    VALUES (':nomCategorie', ':PrixCategory', ':typeCategorie');");
  $request->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
  $request->bindParam(':PrixCategory', $PrixCategory, PDO::PARAM_INT);
  $request->bindParam(':typeCategorie', $typeCategorie, PDO::PARAM_INT);
  $request->execute();
}

/* fonction permettant d'ajouter une catégorie à la base de donnée */
function addReservation($dateDebut, $dateFin, $idVehicule, $idUtilisateur)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`reservation` (`dateDebut`, `dateFin`, `Vehicules_idVehicule`, `utilisateurs_idutilisateur`) 
    VALUES ('2018-05-20', '2018-54-64', '1', '2');");
  $request->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
  $request->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
  $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
  $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
  $request->execute();
}

?>


