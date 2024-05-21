<?php
session_start();
// Connexion à la base de données 
require_once'connection_BDD.php';


if(isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer depuis la requête GET
    $id_utilisateur = $_GET['id'];

    try {
        $sql = "DELETE FROM EmploiDuTemps WHERE id_utilisateur = :id";
        $stmt = $connexion->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id_utilisateur, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        $sql = "DELETE FROM Notes WHERE id_utilisateur = :id";
        $stmt = $connexion->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id_utilisateur, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        $sql = "DELETE FROM Logs WHERE id_utilisateur = :id";
        $stmt = $connexion->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id_utilisateur, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        // Préparer la requête SQL pour supprimer l'utilisateur avec l'ID spécifié
        $sql = "DELETE FROM Utilisateur WHERE id_utilisateur = :id";
        $stmt = $connexion->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id_utilisateur, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Afficher un message de succès
        header('location:gestion_utilisateur.php');
    } catch(PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
} 
?>
