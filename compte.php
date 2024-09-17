<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php'; // Inclure la connexion à la base de données
session_start();



// Vérifier si l'utilisateur est administrateur
if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die("Accès refusé.");
}

// Gérer l'approbation ou le rejet d'une demande
if (isset($_GET['action']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status = 'approved';
        $sql = "SELECT username, email, password FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Mettre à jour le statut de l'utilisateur
            $sql = "UPDATE users SET status=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $status, $user_id);
            $stmt->execute();
            
            echo "L'utilisateur a été approuvé.";
        }
    } elseif ($action === 'reject') {
        $status = 'rejected';
        $sql = "SELECT email FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            // Supprimer l'utilisateur de la base de données
            $sql = "DELETE FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            
            echo "L'utilisateur a été rejeté.";
        }
    } else {
        die("Action invalide.");
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();

    // Redirection après l'action
    header("Location: approve_users.php?success=1");
    exit();
}

// Afficher les demandes en attente
$sql = "SELECT id, username, nom, prenom, adresse, telephone, email, grade FROM users WHERE status='pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Approbation des Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <img src="gioia_asbl.png" alt="Logo ASBL">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="approve_users.php">Approbation des Utilisateurs</a></li>
            <!-- Ajoutez d'autres liens nécessaires -->
            <li><a href="deconnexion.php">Se déconnecter</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Demandes en attente</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                echo "Nom: " . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prenom']) . "<br>";
                echo "Adresse: " . htmlspecialchars($row['adresse']) . "<br>";
                echo "Téléphone: " . htmlspecialchars($row['telephone']) . "<br>";
                echo "Email: " . htmlspecialchars($row['email']) . "<br>";
                echo "Grade: " . htmlspecialchars($row['grade']) . "<br>";
                echo "<a href='approve_users.php?action=approve&user_id=" . $row['id'] . "'>Approuver</a> | ";
                echo "<a href='approve_users.php?action=reject&user_id=" . $row['id'] . "'>Rejeter</a>";
                echo "</p>";
            }
        } else {
            echo "<p>Aucune demande en attente.</p>";
        }
        ?>
    </div>
</body>
</html>
