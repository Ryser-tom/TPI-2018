<?php
require_once('bd.php');

/* Fonction permettant de mettre à jour les informations d'un vehicule */
function updateUser($nom, $prenom, $natel, $Email, $Mdp, $type, $idutilisateur)
{
    $connexion = getConnexion();
    $request = $connexion->prepare("UPDATE `redloca`.`utilisateurs` 
    SET `nom`=':nom', `prenom`=':prenom', `dateNaissance`=':dateNaissance', `natel`=':natel', `Email`=':Email', 
    `Mdp`=':Mdp', `type`=':type' WHERE `idutilisateur`=':idutilisateur';");
    $request->bindParam(':nom', $nom, PDO::PARAM_STR);
    $request->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $request->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $request->bindParam(':natel', $natel, PDO::PARAM_STR);
    $request->bindParam(':Email', $Email, PDO::PARAM_STR);
    $request->bindParam(':Mdp', $Mdp, PDO::PARAM_STR);
    $request->bindParam(':type', $type, PDO::PARAM_INT);
    $request->bindParam(':idutilisateur', $idutilisateur, PDO::PARAM_INT);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
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
