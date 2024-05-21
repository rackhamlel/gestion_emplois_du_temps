<?php
session_start();
// Connexion à la base de données 
$serveur = "database";
$utilisateur = "maxime";
$motdepasse = "FND-FND";
$base_de_donnees = "GESTION_PLANNING";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $motdepasse);
    // Définir le mode d'erreur PDO à exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
?>