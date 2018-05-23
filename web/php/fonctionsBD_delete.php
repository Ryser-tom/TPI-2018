<?php
require_once('bd.php');

/* Fonction permettant de mettre à jour un type de catégorie */
function deleteVehicle($idVehicle)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `vehicules` WHERE `vehicules`.`idVehicule` = :idVehicle ");
    $request->bindParam(':idVehicle', $idVehicle, PDO::PARAM_INT);
    $request->execute();
    return true;
}

/* Fonction permettant de mettre à jour un type de catégorie */
function cancelReservation($vehicleId, $userId)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `reservation` 
        WHERE `reservation`.`vehicules_idVehicule` = :vehicleId 
        AND `reservation`.`utilisateurs_idUtilisateur` = :userId ");
    $request->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->execute();
    return true;
}

/* Fonction permettant de mettre à jour un type de catégorie */
function adminCancelReservation($vehicleId, $startDate, $endDate)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `reservation` 
        WHERE `reservation`.`vehicules_idVehicule` = :vehicleId 
        AND `reservation`.`dateDebut` = :startDate
        AND `reservation`.`dateFin` = :endDate");
    $request->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
    $request->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $request->bindParam(':endDate', $endDate, PDO::PARAM_STR);
    $request->execute();
    return true;
}
?>
