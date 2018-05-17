<?php
require_once('bd.php');

/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateUser($lastName, $firstName, $birthDate, $mobile, $email, $password, $userId)
{
    $password = sha1($password);
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
        SET `nom`=:lastName, `prenom`=:firstName, `dateNaissance`=:birthDate, `natel`=:mobile, `Email`=:email 
        WHERE `idUtilisateur`= :userId AND `mdp`=:password;");
    $request->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $request->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $request->bindParam(':birthDate', $birthDate, PDO::PARAM_STR);
    $request->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':userId', $userId, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();

}

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

}

/* Fonction permettant de mettre à jour le mot de passe */
function updatePassword($newPassword, $oldPassword, $userId)
{
    $newPassword = sha1($newPassword);
    $oldPassword = sha1($oldPassword);
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
        SET `mdp`= :newPassword 
        WHERE `idUtilisateur`= :userId AND `mdp`= :oldPassword
        ;");
    $request->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
    $request->bindParam(':oldPassword', $oldPassword, PDO::PARAM_STR);
    $request->bindParam(':userId', $userId, PDO::PARAM_INT);
    $request->execute();
}
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
}
/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateVehicle($immatriculation, $marque, $modele, $couleur, $image, $dateDebutDisponibilite, $dateFinDisponibilite, $idCategorie)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`vehicules` 
      SET `immatriculation`=':immatriculation', `marque`=':marque', `modele`=':modele', `couleur`=':couleur', `image`=':image', 
      `dateDebutDisponibilite`=':dateDebutDisponibilite', `dateFinDisponibilite`=':dateFinDisponibilite', `categories_idcategorie`=':idCategorie' 
      WHERE `idVehicule`='4';");
    $request->bindParam(':immatriculation', $immatriculation, PDO::PARAM_INT);
    $request->bindParam(':marque', $marque, PDO::PARAM_STR);
    $request->bindParam(':modele', $modele, PDO::PARAM_STR);
    $request->bindParam(':couleur', $couleur, PDO::PARAM_STR);
    $request->bindParam(':image', $image, PDO::PARAM_STR);
    $request->bindParam(':dateDebutDisponibilite', $dateDebutDisponibilite, PDO::PARAM_STR);
    $request->bindParam(':dateFinDisponibilite', $dateFinDisponibilite, PDO::PARAM_STR);
    $request->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de mettre à jour une catégorie */
function updateCategory($nomCategorie, $prixCategorie, $type_categories_idTypeCategorie)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`categories` 
      SET `nomCategorie`=':nomCategorie', `prixCategorie`=':prixCategorie', `type_categories_idTypeCategorie`=':type_categories_idTypeCategorie' 
      WHERE `idcategorie`='11';");
    $request->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
    $request->bindParam(':prixCategorie', $prixCategorie, PDO::PARAM_INT);
    $request->bindParam(':type_categories_idTypeCategorie1', $type_categories_idTypeCategorie1, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de mettre à jour une réservation */
function updateReservation($dateDebut, $dateFin, $idVehicule, $idUtilisateur)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`reservation` 
      SET `dateDebut`=':dateDebut', `dateFin`=':dateFin', `Vehicules_idVehicule`=':idVehicule' 
      WHERE `utilisateurs_idutilisateur`=':idUtilisateur' and`Vehicules_idVehicule`=':idVehicule';");
    $request->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $request->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
    $request->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT);
    $request->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction permettant de mettre à jour un type de catégorie */
function updateTypeCategory($nomTypeCategorie, $idTypeCategorie)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`type_categories` 
      SET `nomTypeCategorie`=':nomTypeCategorie' 
      WHERE `idTypeCategorie`=':idTypeCategorie';");
    $request->bindParam(':nomTypeCategorie', $nomTypeCategorie, PDO::PARAM_INT);
    $request->bindParam(':idTypeCategorie', $idTypeCategorie, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

?>
