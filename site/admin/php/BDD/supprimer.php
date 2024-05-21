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
    } else {
        
    }

} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
