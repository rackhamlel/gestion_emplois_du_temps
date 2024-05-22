<?php
session_start();
require_once'connection_BDD.php';
// Récupération des données de la table EmploiDuTemps
$requeteEmploi = "SELECT id_utilisateur, DateHeureEmbauche, DateHeureDebauche
FROM EmploiDuTemps
WHERE YEARWEEK(DateHeureEmbauche, 1) >= YEARWEEK(DATE_SUB(NOW(), INTERVAL 7 DAY), 1);";
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
// ajoute les données au tableau associatif 
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
