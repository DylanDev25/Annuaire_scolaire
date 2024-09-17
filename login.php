<?php
session_start();
include 'db_connect.php';

$message = ""; // Pour les messages d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer et exécuter la requête
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Vérifier le statut et le rôle de l'utilisateur
            if ($user['status'] === 'approved') {
                $_SESSION['username'] = $username;
                $_SESSION['is_admin'] = ($user['is_admin'] == 1); // Assurez-vous que 1 est le bon grade pour un administrateur

                // Redirection en fonction du rôle
                if ($_SESSION['is_admin']) {
                    header("Location: admin.php");
                } else {
                    header("Location: user_dashboard.php"); // Page pour les utilisateurs non administrateurs
                }
                exit();
            } else {
                $message = "Votre compte n'est pas encore approuvé.";
            }
        } else {
            $message = "Identifiant ou mot de passe incorrect.";
        }
    } else {
        $message = "Identifiant ou mot de passe incorrect.";
    }

    $stmt->close();
    $conn->close(); // Fermer la connexion à la base de données
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - GIOIA ASBL</title>
	<link rel="icon" href="gioia_asbl.png" type="image/x-icon"> <!-- Favicon -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Espace de connexion</h2>
        <form class="login-form" method="post" action="">
            <input class="input-field" type="text" name="username" placeholder="Identifiant" required><br>
            <input class="input-field" type="password" id="password" name="password" placeholder="Mot de passe" required>

            <button class="submit-button" type="submit">Se connecter</button>
        </form>
        <?php if (!empty($message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
	
	<footer class="footer">
        <p>
            © <?php 
                $startYear = 2024; // Année de création de l'entreprise
                $currentYear = date('Y'); // Année actuelle
                echo $startYear . (($currentYear > $startYear) ? " - " . $currentYear : "");
            ?> Annuaire Scolaire. 
        </p>
    </footer>
</body>
</html>
