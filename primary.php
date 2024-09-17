<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM schools WHERE school_type='primaire'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Écoles Primaires</title>
    <link rel="stylesheet" href="styles.css">
</head>
<div class="navbar">
        <img src="gioia_asbl.png" alt="Logo ASBL">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="add_school.php">Ajouter une école</a></li>
            <li><a href="view_school.php">Voir l'annuaire des écoles</a></li>
            <li><a href="primary.php">Écoles primaires</a></li>
            <li><a href="secondary.php">Écoles secondaires</a></li>
            <li><a href="search.php">Rechercher une école</a></li>
            <li><a href="add_user.php">Ajouter un utilisateur</a></li>
            <li><a href="logout.php">Se déconnecter</a></li>
        </ul>
    </div>
    
<body>
    <h2>Écoles Primaires</h2>
    <table>
    <tr>
            <th class="action_php">Actions</th>
            <th>Nom de l'école</th>
            <th>Nom de la direction</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Moyen de contact</th>
            <th>Type d'école</th>
            <th>Année Globale</th>
            <th>Statut du contact</th>
            <th>Statut du rendez-vous</th>
            <th>Date du rendez-vous</th>
            <th>Heure du rendez-vous</th>
            <th>Notes</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>
                        <a href='edit_school.php?id=" . $row['id'] . "'>Modifier</a> |
                        <a class='delete' href='delete_school.php?id=" . $row['id'] . "'>Supprimer</a>
                      </td>";
                echo "<td>" . htmlspecialchars($row['school_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['director_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contact_method']) . "</td>";
                echo "<td>" . htmlspecialchars($row['school_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['class_years']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contacte']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contacted']) . "</td>";

                // Afficher les informations du rendez-vous uniquement si elles existent
                if ($row['appointment_date'] && $row['appointment_time']) {
                    echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                } else {
                    echo "<td colspan='2'>Pas de rendez-vous</td>";
                }

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>Aucune école trouvée.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
