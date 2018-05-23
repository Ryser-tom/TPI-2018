<?php
require_once('bd.php');

/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateUser($lastName, $firstName, $birthDate, $mobile, $email, $password, $userId)
{
    $password = sha1($password);
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
        SET `nom` = :lastName, `prenom` = :firstName, `dateNaissance` = :birthDate, `natel` = :mobile, `Email` = :email 
        WHERE `idUtilisateur` = :userId AND `mdp`= :password;");
    $request->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $request->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $request->bindParam(':birthDate', $birthDate, PDO::PARAM_STR);
    $request->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':userId', $userId, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    if($request->rowCount()>0){
        return $request;
    }else{
        throw new exception("Une erreur est survenue, les informations n'ont pas été changée");
    }

}
/* Fonction permettant de mettre à jour les informations d'un vehicule */
function adminUpdateUser($lastName, $firstName, $birthDate, $mobile, $email, $password, $userId, $actualPassword)
{
    if ($password=="") {
        $password=$actualPassword;
    }else{
        $password = sha1($password);
    }
    
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
        SET `nom`=:lastName, `prenom`=:firstName, `dateNaissance`=:birthDate, `natel`=:mobile, `email`=:email, `mdp`=:password  
        WHERE `idUtilisateur`= :userId;");
    $request->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $request->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $request->bindParam(':birthDate', $birthDate, PDO::PARAM_STR);
    $request->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    return $request;
}

/* Fonction permettant de mettre à jour le mot de passe */
function updatePassword($newPassword, $oldPassword, $userId)
{
    $newPassword = sha1($newPassword);
    $oldPassword = sha1($oldPassword);
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
        SET `mdp`= :newPassword 
        WHERE `idUtilisateur`= :userId AND `mdp`= :oldPassword;");
    $request->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
    $request->bindParam(':oldPassword', $oldPassword, PDO::PARAM_STR);
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->execute();
    if($request->rowCount()>0){
        return $request;
    }else{
        throw new exception('<div class="alert alert-warning">le mot de passe actuel est incorrect</div>');
    }
}
/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateUserType($idUser, $actualType)
{
    if ($actualType == 1) {
        $newType = 0;
    }else{
        $newType = 1;
    }
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `utilisateurs` SET `type` = :newType WHERE `utilisateurs`.`idUtilisateur` = :idUser;");
    $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $request->bindParam(':newType', $newType, PDO::PARAM_INT);
    $request->execute();
    return $request;
}
/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateVehicle($vehicleId, $numberPlate, $mark, $model, $class, $nbPlaces, $color, $image, $start, $end, $userId, $type)
{
    $connexion = getConnexion();
    if($type==1){
        $request = $connexion->prepare("UPDATE `redloca`.`vehicules` 
            SET `immatriculation`=:numberPlate, `marque`=:mark, `model`=:model, `couleur`=:color, `image`=:image, `nbPlace`=:nbPlaces,
                `dateDebutDisponibilite`=:start, `dateFinDisponibilite`=:end, `categories_idcategorie`=:class
            WHERE `idVehicule`=:vehicleId");
    }else{
        $request = $connexion->prepare("UPDATE `redloca`.`vehicules` 
            SET `immatriculation`=:numberPlate, `marque`=:mark, `model`=:model, `couleur`=:color, `image`=:image, `nbPlace`=:nbPlaces,
                `dateDebutDisponibilite`=:start, `dateFinDisponibilite`=:end, `categories_idcategorie`=:class
            WHERE `idVehicule`=:vehicleId AND `utilisateurs_idutilisateur`=:userId;");
    }
    $request->bindParam(':numberPlate', $numberPlate, PDO::PARAM_STR);
    $request->bindParam(':mark', $mark, PDO::PARAM_STR);
    $request->bindParam(':model', $model, PDO::PARAM_STR);
    $request->bindParam(':class', $class, PDO::PARAM_INT);
    $request->bindParam(':nbPlaces', $nbPlaces, PDO::PARAM_INT);
    $request->bindParam(':color', $color, PDO::PARAM_STR);
    $request->bindParam(':image', $image, PDO::PARAM_STR);
    $request->bindParam(':start', $start, PDO::PARAM_STR);
    $request->bindParam(':end', $end, PDO::PARAM_STR);
    if($type==0)$request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
    $request->execute();
    if($request->rowCount()>0){
        return $request;
    }else{
        throw new exception('FALSE');
    }
}
?>
