<?php
session_start();
include 'db_connect.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: index.php"); // Redirige vers la page de connexion ou autre page appropriée
    exit();
}

$userName = $_SESSION['username'];

// Vérifiez si un message de succès est présent
$success_message = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Nouvelle école ajoutée avec succès !";
}

$sql = "SELECT * FROM schools";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annuaire des Écoles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

  <nav>
            <div class="navbar-container">
                <a href="index.php" class="logo">
                    <img src="logo.png" alt="Logo">
                </a>
                <button class="hamburger-menu" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul id="navbar-menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="add_school.php">Ajouter une école</a></li>
                    <li><a href="view_school.php">Voir l'annuaire des écoles</a></li>
                    <li><a href="primary.php">Écoles primaires</a></li>
                    <li><a href="secondary.php">Écoles secondaires</a></li>
                    <li><a href="search.php">Rechercher une école</a></li>
                    <li><a href="add_user.php">Ajouter un utilisateur</a></li>
                    <li><a href="deconnexion.php">Se déconnecter</a></li>
                </ul>
            </div>
        </nav>


    <script src="script.js"></script>

    <div class="container">
        <h2>Bonjour <?php echo htmlspecialchars($userName); ?>, bienvenue dans l'annuaire scolaire de GIOIA ASBL</h2>
        
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>
        
        <p>Ici, vous pouvez gérer les écoles, ajouter de nouvelles écoles, et consulter l'annuaire existant.</p>
        <p>Utilisez les liens ci-dessus pour naviguer dans l'espace d'administration.</p>
    </div>
</body>
</html>
