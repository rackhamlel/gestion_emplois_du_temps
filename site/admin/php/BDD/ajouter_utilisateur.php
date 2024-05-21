<?php
session_start();
// Connexion à la base de données (à remplacer par vos propres informations de connexion)
$serveur = "database";
$utilisateur = "maxime";
$motdepasse = "FND-FND";
$base_de_donnees = "GESTION_PLANNING";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $motdepasse);
    // Définir le mode d'erreur PDO à exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $requete = $connexion->prepare("INSERT INTO Utilisateur (Nom, Prenom, MotDePasse, Email, admin) VALUES (:nom, :prenom, :password, :email, :admin)");

    // Liaison des paramètres
    $requete->bindParam(':nom', $_POST['Nom']);
    $requete->bindParam(':prenom', $_POST['Prénom']);
    $requete->bindParam(':password', $_POST['password']);
    $requete->bindParam(':email', $_POST['email']);
    
    // Convertir la valeur de 'userType' en booléen
    $adminValue = ($_POST['userType'] == '1') ? 1 : 0;

    // Liaison de la valeur à la requête
    $requete->bindParam(':admin', $adminValue, PDO::PARAM_INT);


    // Exécution de la requête
    $requete->execute();

    header('location:gestion_utilisateur.php');

} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>
