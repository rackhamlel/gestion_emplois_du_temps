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
            <form action="creation_utilisateur.php" method="post">
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
            </table>
        </div>
    </div>
</body>
</html>