<?php

$servername = "localhost"; // Adresse du serveur MariaDB
$username = "agent_BDD"; // Nom d'utilisateur de la base de données
$password = "^WfXrpd%GJFt*g9Q*99Jam"; // Mot de passe de la base de données
$database = "E5"; // Nom de la base de données à laquelle se connecter

// Création de la connexion
$connection = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($connection->connect_error) {
    die("Connexion échouée : " . $connection->connect_error);
}

echo "Connexion réussie !";


$connection->close();
?>
