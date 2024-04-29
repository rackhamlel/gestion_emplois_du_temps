<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps</title>
    <link rel="stylesheet" href="../css/emploi_temps.css">
</head>
<body>
    <a href="../loggin.php"><button>déconnexion</button></a>
    <a href="gestion_utilisateur.php"><button>Voir utilisateur</button></a>
    <a href="emploi_temps.php"><button>S</button></a>
    <a href="emploi_temps_+1.php"><button>S+1</button></a>
    <a href="emploi_temps_+2.php"><button>S+2</button></a>
    <a href="emploi_temps_+3.php"><button>S+3</button></a>
    
    <h2>Emploi du temps</h2>
    <table>
        <tr>
            <th>Heure</th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
        </tr>
        <?php
        // Création de lignes pour chaque heure de la journée
        for ($i = 8; $i <= 18; $i++) {
            echo "<tr>";
            echo "<td>$i:00 - " . ($i + 1) . ":00</td>";
            for ($j = 1; $j <= 5; $j++) {
                // Cellules vides à remplir
                echo "<td></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
