<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require_once "connexion.php";

    
    $nom = $_POST["Nom"];
    $prenom = $_POST["Prénom"];
    $motDePasse = $_POST["password"];
    $email = $_POST["email"];
    $admin = ($_POST["userType"] == "admin") ? 1 : 0; // Si admin est sélectionné, admin = 1 sinon admin = 0

    // Préparer la requête SQL 
    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, MotDePasse, admin) VALUES (:nom, :prenom, :email, :motDePasse, :admin)";

    // Préparer la déclaration
    $stmt = $pdo->prepare($sql);

    // Binder les valeurs
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':motDePasse', $motDePasse);
    $stmt->bindParam(':admin', $admin);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Utilisateur enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de l'utilisateur.";
    }
    header('Location: gestion_utilsateur.php');
}
?>
