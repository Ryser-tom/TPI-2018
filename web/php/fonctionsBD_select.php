<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : fonctionBD_select
 * Description : contains all data selection functions in the database.
 */
require_once('bd.php');

/* This function allows you to retrieve the list of users that correspond to the Email and password entered in parameters.  */
function login($email, $password){
    $password = sha1($password);
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs` WHERE email = :email AND mdp = :password;");
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of user information whose id has been passed as parameter.  */
function getUser($userId){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs` WHERE idUtilisateur = :userId;");
    $request->bindParam(':userId', $userId, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of users.  */
function getAllUsers(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM `utilisateurs`");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of vehicles.  */
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

/* This function allows you to retrieve the list of available vehicles from the date passed in parameter..  */
function getAllVehiclesAvaible($dateResearch){
    $dateResearch = strtotime($dateResearch);
    $dateResearch = date('Y-m-d H:i:s', $dateResearch);

    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT idVehicule, marque, model, nbPlace, couleur, image, vehicules.dateDebutDisponibilite, vehicules.dateDebutDisponibilite, categories.nomCategorie AS categorie, reservation.dateDebut, reservation.dateFin
	FROM redloca.vehicules
	INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
	LEFT JOIN reservation ON reservation.vehicules_idVehicule = vehicules.idVehicule
    WHERE dateDebutDisponibilite <= :dateResearch
	AND (dateFinDisponibilite >= :dateResearch
	OR dateFinDisponibilite  is NULL)
    AND (
        (reservation.dateDebut < :dateResearch AND reservation.dateFin < :dateResearch)
	    OR reservation.dateDebut > :dateResearch
        OR (reservation.dateDebut IS NULL AND reservation.dateFin IS NULL)
    )
	GROUP BY vehicules.idVehicule
	ORDER BY categories.nomCategorie ASC;");
    $request->bindParam(':dateResearch', $dateResearch, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of the 6 most recently available vehicles from today.  */
function getRecentVehicleAvaible(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT idVehicule, marque, model, nbPlace, couleur, image, 
        vehicules.dateDebutDisponibilite, vehicules.dateDebutDisponibilite, categories.nomCategorie AS categorie, 
        reservation.dateDebut, reservation.dateFin
    FROM redloca.vehicules
    INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
    LEFT JOIN reservation ON reservation.vehicules_idVehicule = vehicules.idVehicule
    WHERE dateDebutDisponibilite <= current_date()+1
    AND (dateFinDisponibilite >= current_date()+1
        OR dateFinDisponibilite  is NULL)
    AND ((reservation.dateDebut < current_date()+1 AND reservation.dateFin < current_date()+1)
        OR reservation.dateDebut > current_date()+1
        OR (reservation.dateDebut IS NULL AND reservation.dateFin IS NULL))
    GROUP BY vehicules.idVehicule
    ORDER BY dateDebutDisponibilite DESC
    LIMIT 6;");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows to retrieve the list of vehicles belonging to a user thanks to the id of the user passed in parameter.  */
function getVehicleOf($userId){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.vehicules 
    WHERE utilisateurs_idutilisateur = :userId AND dateFinDisponibilite > current_date() 
    OR utilisateurs_idutilisateur = :userId AND dateFinDisponibilite IS null ORDER BY dateDebutDisponibilite;");
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of vehicle information to create a new location.  */
function getVehicleInfosReservation($idVehicule, $reservationDate)
{
    $reservationDate = strtotime($reservationDate);
    $reservationDate = date('Y-m-d', $reservationDate);
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT categories.nomCategorie, categories.prixCategorie, vehicules.image, vehicules.marque, vehicules.model, vehicules.nbPlace, vehicules.couleur, reservation.dateDebut AS finDisponibilite
    FROM redloca.vehicules
    INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
    INNER JOIN reservation ON vehicules.categories_idcategorie = reservation.vehicules_idVehicule
    WHERE idVehicule = :idVehicule 
    AND reservation.dateFin > :reservationDate
    ORDER BY reservation.dateFin ASC;");
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->bindParam(':reservationDate', $reservationDate, PDO::PARAM_STR);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve a vehicle's list of information.  */
function getVehicleInfos($idVehicule)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT categories.nomCategorie, categories.prixCategorie, vehicules.immatriculation, vehicules.image, vehicules.marque, vehicules.model, vehicules.nbPlace, vehicules.couleur, vehicules.dateDebutDisponibilite AS debutDisponibilite, vehicules.dateFinDisponibilite AS finDisponibilite
    FROM redloca.vehicules
    INNER JOIN categories ON vehicules.categories_idcategorie = categories.idcategorie
    WHERE idVehicule = :idVehicule;");
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of categories and their information.  */
function getClass()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT idCategorie, nomCategorie, prixCategorie, nomTypeCategorie FROM redloca.categories
      INNER JOIN type_categories ON type_categories.idTypeCategorie = categories.type_categories_idTypeCategorie;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of reservations.  */
function getAllReservations()
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT dateDebut, dateFin, utilisateurs.nom, utilisateurs.prenom, vehicules.immatriculation, vehicules.idVehicule 
        FROM redloca.reservation
        INNER JOIN utilisateurs ON utilisateurs.idUtilisateur = reservation.utilisateurs_idutilisateur
        INNER JOIN vehicules ON vehicules.idVehicule = reservation.Vehicules_idVehicule;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* This function allows you to retrieve the list of reservations for a user.   */
function getReservationOf($idUtilisateur)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT immatriculation, dateDebut, dateFin, vehicules.marque, vehicules.model, vehicules.idVehicule 
        FROM redloca.reservation
        INNER JOIN utilisateurs ON reservation.utilisateurs_idutilisateur = utilisateurs.idutilisateur
        INNER JOIN vehicules ON reservation.Vehicules_idVehicule = vehicules.idVehicule
        WHERE utilisateurs.idutilisateur = :idUtilisateur;");
    $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

?>
