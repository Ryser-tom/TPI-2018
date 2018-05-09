<?php
require_once('bd.php');

/* Fonction permettant de mettre à jour un type de catégorie */
function deleteVehicule($idVehicule)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `redloca`.`vehicules` WHERE `idVehicule`=':idVehicule';");
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de mettre à jour un type de catégorie */
function deleteCategory($idcategorie)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `redloca`.`categories` WHERE `idcategorie`=':idcategorie';");
    $request->bindParam(':idcategorie', $idcategorie, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
/* Fonction permettant de mettre à jour un type de catégorie */
function deleteTypeCategory($idTypeCategorie)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `redloca`.`type_categories` WHERE `idTypeCategorie`=':idTypeCategorie';");
    $request->bindParam(':idTypeCategorie', $idTypeCategorie, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
/* Fonction permettant de mettre à jour un type de catégorie */
function deleteReservation($idUtilisateur, $idVehicule)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("DELETE FROM `redloca`.`reservation` 
      WHERE `utilisateurs_idutilisateur`=':idUtilisateur' and`Vehicules_idVehicule`=':idVehicule';");
    $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
?>
