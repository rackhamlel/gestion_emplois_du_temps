<?php
session_start();
$message = '';
if (isset($_SESSION['redirect_message'])) {
    $message = $_SESSION['redirect_message'];
    unset($_SESSION['redirect_message']); // Réinitialiser la variable pour éviter l'affichage répété du message
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps</title>
    <link rel="stylesheet" href="../../../css/emploi_temps.css">
</head>
<body>
    <?php if ($message): ?>
            <div class="message-popup">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <?php endif; ?>
    <nav id="nav-1">
        <a class="link-1" href="../../../index.php">déconnexion</a>
        <a  class="link-1" href="../BDD/gestion_utilisateur.php">Voir utilisateur</a>
        <a class="link-1" href="emploi_temps.php">S</a>
        <a  class="link-1"href="../S1/emploi_temps_+1.php">S+1</a>
        <a class="link-1" href="../S2/emploi_temps_+2.php">S+2</a>
        <a class="link-1" href="../S3/emploi_temps_+3.php">S+3</a>
    </nav>
   
    <div class="edit-buttons-container">
    <?php
    if ($message):
        $popup= '<div class="message-popup">
        <?php echo htmlspecialchars($message); ?>
        </div>';
    endif;
    require_once "../BDD/connection_BDD.php";
    try {
        // Requête SQL pour sélectionner tous les utilisateurs
        $requete = "SELECT Utilisateur.Nom, Utilisateur.id_utilisateur, 
                   IFNULL(SUM(TIMESTAMPDIFF(HOUR, EmploiDuTemps.DateHeureEmbauche, EmploiDuTemps.DateHeureDebauche)), 0) AS NombreHeures
            FROM Utilisateur
            LEFT JOIN EmploiDuTemps 
            ON Utilisateur.id_utilisateur = EmploiDuTemps.id_utilisateur 
            AND WEEK(EmploiDuTemps.DateHeureEmbauche) = WEEK(NOW())
            GROUP BY Utilisateur.id_utilisateur";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Exécution de la requête
        $statement->execute();
        $resultats = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if ($_SESSION['admin']==1){
            // Affichage des utilisateurs sous forme de boutons
            $afficherUtilisateur = '';
            foreach ($resultats as $row) {
                $afficherUtilisateur .= "<li class='user-list-item'>
                                            <button class='editBtn' data-id='" . htmlspecialchars($row["id_utilisateur"]) . "'>" . htmlspecialchars($row["Nom"]) . "</button>
                                            <p>Heures affectées : " . htmlspecialchars($row["NombreHeures"]) . "</p>
                                        </li>";
            }
        }else{
            
        }

        echo $afficherUtilisateur;
    } catch(PDOException $e) {
        // Gérer les erreurs PDO
        echo "Erreur : " . $e->getMessage();
    }
    ?>
    
    <form action="../BDD/inserer_heure.php" method="post" id="editForm" style="display:none;">
    <input type="hidden" name="userId" id="userIdInput" value="">
    <select name="jourSemaine" id="jourSemaine">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
    </select>
    <input type="submit" name="action" value="Supprimer">
    <br>
    <select name="dateHeureEmbauche">
        <?php
        for ($heure = 8; $heure <= 20; $heure++) {
            echo "<option value=\"$heure:00\">$heure:00</option>";
        }
        ?>
    </select>
    <select name="dateHeureDebauche">
        <?php
        for ($heure = 8; $heure <= 20; $heure++) {
            echo "<option value=\"$heure:00\">$heure:00</option>";
        }
        ?>
    </select>
    <input type="submit" name="action" value="Valider">
    </form>
    <h1>Emploi du temps</h1>
    <table>
        <tr id="joursSemaine">
            <th>Heure</th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
        </tr>
        <?php
        require_once '../BDD/utilisateur_travail.php';
        // Création de lignes pour chaque heure de la journée
        // Boucle pour chaque heure de la journée
        for ($i = 8; $i <= 19; $i++) {
            echo "<tr>";
            echo "<td>$i:00 - " . ($i + 1) . ":00</td>";
        
            // Boucle pour chaque jour de la semaine
            foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $jour) {
                echo "<td>";
                
                // Vérification si des données d'emploi du temps existent pour cette heure et ce jour de la semaine
                foreach ($emploiDuTemps[$jour] as $plageHoraire) {
                    // Vérification si l'heure actuelle est comprise entre DateHeureEmbauche et DateHeureDebauche
                    if ($i >= (int)substr($plageHoraire['DateHeureEmbauche'], 11, 2) && $i < (int)substr($plageHoraire['DateHeureDebauche'], 11, 2)) {
                        // Affichage du nom de l'utilisateur en utilisant la fonction getUserName
                        echo getUserName($connexion, $plageHoraire['id_utilisateur']);
                        echo "<br>"; // Séparateur si plusieurs utilisateurs ont des plages horaires à cette heure
                    }
                }
        
                echo "</td>";
            }
        
            echo "</tr>";
        }
        ?>
    </table>
    <script src="/js/emploi_0.js"></script>
</body>
</html>
