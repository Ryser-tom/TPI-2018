<?php
require_once('bd.php');

/* Fonction permettant de s'enregistrer.  */
function register($nom, $prenom, $dateNaissnace, $natel, $Email, $Mdp)
{
  $connexion = getConnexion();
  $request = $connexion->prepare("INSERT INTO `redloca`.`utilisateurs` (`nom`, `prenom`, `dateNaissance`, `natel`, `Email`, `Mdp`) 
    VALUES (:nom, :prenom, :dateNaissance, :natel, :Email, :Mdp)");
  $request->bindParam(':nom', $nom, PDO::PARAM_STR);
  $request->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
  $request->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
  $request->bindParam(':natel', $natel, PDO::PARAM_STR);
  $request->bindParam(':Email', $Email, PDO::PARAM_STR);
  $request->bindParam(':Mdp', sha1($Mdp), PDO::PARAM_STR);
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


