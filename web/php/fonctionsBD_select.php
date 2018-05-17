<?php
require_once('bd.php');

/* Fonction permettant de vérifier que l'utilisateur existe.  */
function login($email, $password)
{
    $password = sha1($password);
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs` WHERE email = :email AND mdp = :password");
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
function getUser($userId)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs` WHERE idUtilisateur = :userId");
    $request->bindParam(':userId', $userId, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
/* Fonction permettant de vérifier que l'utilisateur existe.  */
function getAllUsers()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs`");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* fonction permettant de récuperer la liste des véhicules récement ajouter */
function getRecentVehicle(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT vehicules.*, categories.nomCategorie FROM redloca.vehicules 
    INNER JOIN categories ON categories.idcategorie = vehicules.categories_idcategorie
    WHERE dateFinDisponibilite > current_date() 
    OR dateFinDisponibilite IS null 
    AND dateDebutDisponibilite < current_date() 
    ORDER BY dateDebutDisponibilite;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer la liste de tous les véhicules disponible trié par ordre chronologique de disponibilité. */ 
function getAllVehicles(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT idVehicule, immatriculation, marque, model, nbPlace, 
    couleur, image, dateDebutDisponibilite, dateFinDisponibilite, utilisateurs.nom, utilisateurs.prenom, categories.nomCategorie
    FROM redloca.vehicules
    INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
    INNER JOIN utilisateurs ON vehicules.utilisateurs_idutilisateur = utilisateurs.idUtilisateur");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer la liste de tous les véhicules disponible trié par ordre chronologique de disponibilité. */ 
function getAllVehiclesAvaible(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.vehicules 
        WHERE dateFinDisponibilite > current_date() OR dateFinDisponibilite IS null ORDER BY dateDebutDisponibilite;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer la liste de tous les véhicules disponible trié par ordre chronologique de disponibilité. */ 
function getVehicleOf($userId){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.vehicules 
    WHERE utilisateurs_idutilisateur = :userId AND dateFinDisponibilite > current_date() 
    OR utilisateurs_idutilisateur = :userId AND dateFinDisponibilite IS null ORDER BY dateDebutDisponibilite;");
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer la liste des véhicules disponible à une date choisi et trié par catégorie */ 
function getAllVehicleAvailable(){
  $connexion = getConnexion();
  $request = $connexion->prepare("SELECT vehicules.idVehicule, vehicules.marque, vehicules.modele, vehicules.nbPlace, vehicules.couleur, vehicules.dateDebutDisponibilite, categories.nomCategorie
    FROM redloca.vehicules
    INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
    WHERE NOT EXISTS(
      SELECT 1 FROM redloca.reservation
      WHERE reservation.Vehicules_idVehicule = vehicules.idVehicule
        AND reservation.dateDebut < current_date()
        AND reservation.dateFin > current_date()) 
    AND dateDebutDisponibilite < current_date()
    ORDER BY categories.nomCategorie;");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* fonction permettant de récuperer les information sur le vehicule */
function getCarInfos($idVehicule)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT categories.prixCategorie, vehicules.image, vehicules.marque, vehicules.modele, vehicules.nbPlace
      FROM redloca.vehicules
      INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
      WHERE idVehicule = ':idVehicule';");
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer les données pour afficher un résumé avant confirmation.  */
function getResume($dateDebut, $dateFin, $idVehicule)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT (DATEDIFF(':dateFin', ':dateDebut') * categories.prixCategorie) AS 'prixLocation', 
      vehicules.image, vehicules.couleur, vehicules.marque, vehicules.modele, vehicules.nbPlace
      FROM redloca.vehicules 
      INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
      WHERE vehicules.idVehicule = ':idVehicule';");
    $request->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $request->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer les catégories avec le nom du type de catégorie  */
function getClass()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT idCategorie, nomCategorie, prixCategorie, nomTypeCategorie FROM redloca.categories
      INNER JOIN type_categories ON type_categories.idTypeCategorie = categories.type_categories_idTypeCategorie;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer les types de catégories  */
function getTypeCategory()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.type_categories;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer les réservation  */
function getAllReservation()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.reservation;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer les réservation d'un utilisateur */
function getReservationOf($idUtilisateur)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT immatriculation, dateDebut, dateFin, vehicules.marque, vehicules.model, vehicules.idVehicule FROM redloca.reservation
      INNER JOIN utilisateurs ON reservation.utilisateurs_idutilisateur = utilisateurs.idutilisateur
      INNER JOIN vehicules ON reservation.Vehicules_idVehicule = vehicules.idVehicule
      WHERE utilisateurs.idutilisateur = :idUtilisateur;");
    $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

?>
