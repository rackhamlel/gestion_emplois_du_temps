<?php
session_start();
// Connexion à la base de données
require_once'../BDD/connection_BDD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    if ($action == "Valider") {
        $jourSemaine = $_POST['jourSemaine'];
        $id_utilisateur = $_POST['userId'];
        $heureDebut = $_POST['dateHeureEmbauche'];
        $heureFin = $_POST['dateHeureDebauche'];
        $numeroJour = array(
            'Lundi' => 1,
            'Mardi' => 2,
            'Mercredi' => 3,
            'Jeudi' => 4,
            'Vendredi' => 5
        );
        $dateDebut = new DateTime();
        $diffJours = $numeroJour[$jourSemaine] - $dateDebut->format('N') + 14;
        $dateDebut->modify("+$diffJours day");
        
        $dateHeureEmbauche = $dateDebut->format('Y-m-d') . ' ' . $heureDebut;
        $dateHeureDebauche = $dateDebut->format('Y-m-d') . ' ' . $heureFin;
        $requete = $connexion->prepare("INSERT INTO EmploiDuTemps (DateHeureEmbauche, DateHeureDebauche, id_utilisateur) VALUES (:dateHeureEmbauche, :dateHeureDebauche, :id_utilisateur)");
        $requete->bindParam(':dateHeureEmbauche', $dateHeureEmbauche);
        $requete->bindParam(':dateHeureDebauche', $dateHeureDebauche);
        $requete->bindParam(':id_utilisateur', $id_utilisateur);
        $requete->execute();
        header('location:emploi_temps_+1.php');
    } elseif ($action == "Supprimer") {
        $jourSemaine = $_POST['jourSemaine'];
        $id_utilisateur = $_POST['userId'];
        $numeroJour = array(
            'Lundi' => 2,
            'Mardi' => 3,
            'Mercredi' => 4,
            'Jeudi' => 5,
            'Vendredi' => 6
        );
        if (array_key_exists($jourSemaine, $numeroJour)) {
            $jourSemaineNumero = $numeroJour[$jourSemaine];
            $requete_suppression = $connexion->prepare("DELETE FROM EmploiDuTemps WHERE id_utilisateur = :id_utilisateur AND 
            WEEK(DateHeureEmbauche) = :jourSemaine AND WEEK(DateHeureEmbauche) = WEEK(NOW()) + 2");
            $requete_suppression->bindParam(':id_utilisateur', $id_utilisateur);
            $requete_suppression->bindParam(':jourSemaine', $jourSemaineNumero);
            $requete_suppression->execute();
                       
            header('location:emploi_temps_+2.php');
        } else {
            echo "Jour de la semaine invalide.";
        }
    }
}

?>
