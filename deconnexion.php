<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Si vous utilisez des cookies de session, les supprimer également
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Déconnexion</title>
</head>
<body>
    <h1>Déconnexion réussie</h1>
    <p>Vous avez été déconnecté avec succès.</p>
    <a href="index.php">Se reconnecter</a>
</body>
</html>

