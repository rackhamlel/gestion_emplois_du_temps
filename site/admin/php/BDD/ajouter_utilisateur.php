<?php
session_start();
require_once'connection_BDD.php';

// requête d'insertion
$requete = $connexion->prepare("INSERT INTO Utilisateur (Nom, Prenom, MotDePasse, Email, admin) VALUES (:nom, :prenom, :password, :email, :admin)");
// Liaison des paramètres
$requete->bindParam(':nom', $_POST['Nom']);
$requete->bindParam(':prenom', $_POST['Prénom']);
$hashedPassword = hash('sha256', $_POST['password']);// Hachage du mot de passe avec SHA-256
$requete->bindParam(':password', $hashedPassword);
$requete->bindParam(':email', $_POST['email']);

// Convertir la valeur de 'userType' en booléen
$adminValue = ($_POST['userType'] == '1') ? 1 : 0;
// Liaison de la valeur à la requête
$requete->bindParam(':admin', $adminValue, PDO::PARAM_INT);
// Exécution de la requête
$requete->execute();
header('location:gestion_utilisateur.php');



?>
