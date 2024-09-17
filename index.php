<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire Scolaire - GIOIA ASBL</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Font Awesome -->
    <link rel="icon" href="gioia_asbl.png" type="image/x-icon"> <!-- Favicon -->
</head>
<body>
    <div class="container">
        <img src="gioia_asbl.png" alt="Logo Annuaire Scolaire" class="logo">
        <h1 class="title"><i class="fa fa-graduation-cap"></i> Annuaire Scolaire - GIOIA ASBL</h1>
        <p class="description">Accédez facilement à notre annuaire scolaire en vous connectant ou en vous inscrivant.</p>
        <a href="login.php" class="button"><i class="fa fa-sign-in"></i> Se Connecter</a>
        <a href="register.php" class="button"><i class="fa fa-user-plus"></i> S'Inscrire</a>
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
