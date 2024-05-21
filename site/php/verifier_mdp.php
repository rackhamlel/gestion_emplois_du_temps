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
} catch(PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Vérification des informations de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    // Requête préparée pour vérifier si l'utilisateur existe dans la base de données
    $requete = "SELECT * FROM Utilisateur WHERE Nom = :username AND MotDePasse = :password";
    $statement = $connexion->prepare($requete);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);
    $statement->execute();

    $resultat = $statement->fetch(PDO::FETCH_ASSOC);

    if ($resultat) {
        // Authentification réussie
        $_SESSION['admin'] = $resultat['admin'];
        $_SESSION['id'] = $resultat['id_utilisateur'];
        $_SESSION['pw'] = $hashedPassword;
        header('location:../admin/php/S0/emploi_temps.php');
        exit;
    } else {
        // Authentification échouée
        header('location:../index.php');
    }
}


?>