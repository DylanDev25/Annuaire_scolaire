<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>École Ajoutée avec Succès</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
    </div>

    <div class="container">
    <div class="success-message">
        <h2>École Ajoutée avec Succès !</h2>
        <p>Vous avez ajouté une nouvelle école avec succès à l'annuaire.</p>
        <p>Retournez à l'<a href="admin.php">accueil</a> pour continuer.</p>
    </div>
    </div>

    <footer>
        &copy; 2024 ASBL. Tous droits réservés.
    </footer>
</body>
</html>
