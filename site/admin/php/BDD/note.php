<?php
session_start(); // Démarrer la session

require_once'connection_BDD.php';

// Récupérer les données du formulaire
$titre = $_POST['title'];
$contenu = $_POST['content'];
$id_utilisateur = $_SESSION['id'];
$date_actuelle = date('Y-m-d H:i:s'); // Formater la date actuelle

try {
  
    // Préparer la requête d'insertion
    $sql = "INSERT INTO Notes (DateNote, contenuNote, id_utilisateur) VALUES (:dateNote, :contenuNote, :id_utilisateur)";
    $stmt = $connexion->prepare($sql);

    // Lier les paramètres
    $contenuNote = "Titre: " . $titre . "\nContenu: " . $contenu;
    $stmt->bindParam(':dateNote', $date_actuelle);
    $stmt->bindParam(':contenuNote', $contenuNote);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();
    
    header('location:../S0/emploi_temps.php');
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
