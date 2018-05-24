<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : fonctionBD_delete
 * Description : contains all data deleting functions in the database.
 */
require_once('bd.php');

/* This function allows you to delete a vehicle */
function deleteVehicle($idVehicle)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `vehicules` WHERE `vehicules`.`idVehicule` = :idVehicle ");
    $request->bindParam(':idVehicle', $idVehicle, PDO::PARAM_INT);
    $request->execute();
    return true;
}

/* This function allows you to delete a reservation. */
function cancelReservation($vehicleId, $userId, $startDate, $endDate)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `reservation` 
        WHERE `reservation`.`vehicules_idVehicule` = :vehicleId 
        AND `reservation`.`utilisateurs_idUtilisateur` = :userId 
        AND `reservation`.`dateDebut` = :startDate
        AND `reservation`.`dateFin` = :endDate");
    $request->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $request->bindParam(':endDate', $endDate, PDO::PARAM_STR);
    $request->execute();
    return true;
}

/* This function allows you to delete a reservation from an admin account */
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
