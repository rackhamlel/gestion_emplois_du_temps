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
    
    
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $action = $_POST['action'];
        if ($action == "Valider") {
        // Récupérer la date sélectionnée
        $jourSemaine = $_POST['jourSemaine'];
        $id_utilisateur = $_POST['userId'];
        // Récupérer les heures de début et de fin sélectionnées
        $heureDebut = $_POST['dateHeureEmbauche'];
        $heureFin = $_POST['dateHeureDebauche'];

        // Convertir la journée de la semaine en numéro de jour (Lundi = 1, Mardi = 2, ...)
        $numeroJour = array(
            'Lundi' => 1,
            'Mardi' => 2,
            'Mercredi' => 3,
            'Jeudi' => 4,
            'Vendredi' => 5
        );

        // Calculer la date de début (aujourd'hui + différence de jours)
        $dateDebut = new DateTime();
        $diffJours = $numeroJour[$jourSemaine] - $dateDebut->format('N'); // Jour de la semaine - jour actuel de la semaine
        if ($diffJours < 0) {
            $diffJours += 7;
        }
        $dateDebut->modify("+$diffJours day"); // Ajouter la différence de jours
        
        // Formater la date de début au format DATETIME (en combinant avec l'heure de début)
        $dateHeureEmbauche = $dateDebut->format('Y-m-d') . ' ' . $heureDebut;

        // Formater la date de fin au format DATETIME (en combinant avec l'heure de fin)
        $dateHeureDebauche = $dateDebut->format('Y-m-d') . ' ' . $heureFin;
        // Préparer la requête d'insertion
        $requete = $connexion->prepare("INSERT INTO EmploiDuTemps (DateHeureEmbauche, DateHeureDebauche, id_utilisateur) VALUES (:dateHeureEmbauche, :dateHeureDebauche, :id_utilisateur)");

        // Liaison des paramètres
        $requete->bindParam(':dateHeureEmbauche', $dateHeureEmbauche);
        $requete->bindParam(':dateHeureDebauche', $dateHeureDebauche);
        $requete->bindParam(':id_utilisateur', $id_utilisateur);

        // Exécution de la requête
        $requete->execute();
        header('location:../S0/emploi_temps.php');
        }elseif ($action == "Supprimer") {
            $jourSemaine = $_POST['jourSemaine'];
            $id_utilisateur = $_POST['userId'];

            // Convertir le nom du jour en numéro de jour
            $numeroJour = array(
                'Lundi' => 2,
                'Mardi' => 3,
                'Mercredi' => 4,
                'Jeudi' => 5,
                'Vendredi' => 6
            );

            // Vérifier si le nom du jour de la semaine existe dans le tableau
            if (array_key_exists($jourSemaine, $numeroJour)) {
                // Récupérer le numéro de jour correspondant
                $jourSemaineNumero = $numeroJour[$jourSemaine];

                // Préparer la requête de suppression
                $requete_suppression = $connexion->prepare("DELETE FROM EmploiDuTemps WHERE id_utilisateur = :id_utilisateur AND DAYOFWEEK(DateHeureEmbauche) = :jourSemaine");

                // Liaison des paramètres
                $requete_suppression->bindParam(':id_utilisateur', $id_utilisateur);
                $requete_suppression->bindParam(':jourSemaine', $jourSemaineNumero);

                // Exécution de la requête de suppression
                $requete_suppression->execute();
                header('location:../S0/emploi_temps.php'); 
            } else {
                echo "Jour de la semaine invalide.";
            }
        }

    }
} catch(PDOException $e) {
    // Gérer les erreurs PDO
    die("Erreur : " . $e->getMessage());
}
?>
