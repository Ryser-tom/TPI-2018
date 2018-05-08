<?php
require_once('bd.php');
/* fonction permettant de récuperer la liste des véhicules récement ajouter */
function getRecentVehicle(){
    $connexion = getConnexion();
    $request = $connexion->prepare("");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de récuperer la liste de tous les véhicules disponible trié par ordre chronologique de disponibilité. */ 
function getAllVehicle(){
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.vehicules WHERE dateFinDisponibilite > current_date() OR dateFinDisponibilite IS null ORDER BY dateDebutDisponibilite;");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de vérifier que l'utilisateur existe.  */
function login($email, $Mdp)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("SELECT * FROM redloca.utilisateurs where Email = ':Email' AND Mdp = ':Mdp'; )");
    $request->bindParam(':Email', $Email, PDO::PARAM_STR);
    $request->bindParam(':Mdp', sha1($Mdp), PDO::PARAM_STR);
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

?>
