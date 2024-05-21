<?php
session_start(); // Démarrer la session

require_once'../BDD/connection_BDD.php';

// Récupérer les données du formulaire
$titre = $_POST['title'];
$contenu = $_POST['content'];
$id_utilisateur = $_SESSION['id'];
$date_actuelle = date('Y-m-d H:i:s'); // Formater la date actuelle
$date_plus_7_jours = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date_actuelle)));

try {
  
    // Préparer la requête d'insertion
    $sql = "INSERT INTO Notes (DateNote, contenuNote, id_utilisateur) VALUES (:dateNote, :contenuNote, :id_utilisateur)";
    $stmt = $connexion->prepare($sql);

    // Lier les paramètres
    $contenuNote = "Titre: " . $titre . "\nContenu: " . $contenu;
    $stmt->bindParam(':dateNote', $date_plus_7_jours);
    $stmt->bindParam(':contenuNote', $contenuNote);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();
    
    header('location:../S1/emploi_temps_+1.php');
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
