<?php
session_start();
// Connexion à la base de données 
require_once'../BDD/connection_BDD.php';
$requeteEmploi = "SELECT id_utilisateur, DateHeureEmbauche, DateHeureDebauche 
FROM EmploiDuTemps 
WHERE WEEK(DateHeureEmbauche) = WEEK(DATE_ADD(NOW(), INTERVAL 1 WEEK));";
$statementEmploi = $connexion->prepare($requeteEmploi);
$statementEmploi->execute();

// Création d'un tableau associatif pour stocker les données de l'emploi du temps par utilisateur
$emploiDuTemps = array(
    'Monday' => array(),
    'Tuesday' => array(),
    'Wednesday' => array(),
    'Thursday' => array(),
    'Friday' => array()
);
while ($rowEmploi = $statementEmploi->fetch(PDO::FETCH_ASSOC)) {
    $jourSemaine = date('l', strtotime($rowEmploi['DateHeureEmbauche']));
    $emploiDuTemps[$jourSemaine][] = $rowEmploi;
}

function getUserName($connexion, $id_utilisateur) {
    $requeteNomUtilisateur = "SELECT Nom FROM Utilisateur WHERE id_utilisateur = :id_utilisateur";
    $statementNomUtilisateur = $connexion->prepare($requeteNomUtilisateur);
    $statementNomUtilisateur->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $statementNomUtilisateur->execute();
    $rowNomUtilisateur = $statementNomUtilisateur->fetch(PDO::FETCH_ASSOC);
    return $rowNomUtilisateur['Nom'];
}


?>
