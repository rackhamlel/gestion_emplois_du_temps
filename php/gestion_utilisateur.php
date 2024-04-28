<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création</title>
    <link rel="stylesheet" href="../css/gestion_utilisateur.css">
</head>
<body>
    <a href="emploi_temps.php"><button>Retour</button></a>
    
    <div class="container">
        <div class="form-container">
            <h2>Création</h2>
            <form action="php/enregistrement.php" method="post">
                <input type="text" name="Nom" placeholder="Nom" required>
                <br>
                <input type="text" name="Prénom" placeholder="Prénom" required>
                <br>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <br>
                <input type="text" name="email" placeholder="email" required>
                <br>
                
                <select id="userType">
                    <option value="admin">Admin</option>
                    <option value="employee">Employé</option>
                </select>
               
                <input type="submit" value="Valider">
            </form>
        </div>
        <div class="table-container">
            <h2>Liste des Utilisateurs</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Modifier</th>
                    <th>Rénitialiser mdp</th>
                    <th>Supprimé</th>
                </tr>
                <?php
                require_once "connexion.php";

                // Récupérer tous les utilisateurs
                $sql = "SELECT id_utilisateur, Nom, Prenom, Email, admin FROM Utilisateur";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch()) {
                    $tableContent .= '<tr>';
                    $tableContent .= '<td>' . $row['Nom'] . '</td>';
                    $tableContent .= '<td>' . $row['Prenom'] . '</td>';
                    $tableContent .= '<td>' . $row['Email'] . '</td>';
                    $tableContent .= '<td>' . ($row['admin'] == 1 ? 'Admin' : 'Employé') . '</td>';
                    $tableContent .= '<td><a href="modifier.php?id=' . $row['id_utilisateur'] . '">Modifier</a></td>';
                    $tableContent .= '<td><a href="reinitialiser_mdp.php?id=' . $row['id_utilisateur'] . '">Réinitialiser mdp</a></td>';
                    $tableContent .= '<td><a href="supprimer.php?id=' . $row['id_utilisateur'] . '">Supprimer</a></td>';
                    $tableContent .= '</tr>';
                }
                echo $tableContent;?>
            </table>
        </div>
    </div>
</body>
</html>