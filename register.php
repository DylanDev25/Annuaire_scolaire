<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - GIOIA ASBL</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="icon" href="gioia_asbl.png" type="image/x-icon"> <!-- Favicon -->
</head>
<body>

    <div class="register-container">
        <h2>Créer mon compte</h2>
        <form class="register-form" method="post" action="">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <i id="togglePasswordIcon" class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="adresse" placeholder="Adresse postale" required>
            
            <div class="telephone-container">
                <select name="indicatif_pays" required>
                    <option value="+32" selected>(+32)</option>
                    <option value="+33">(+33)</option>
                </select>
                <input type="tel" name="telephone" placeholder="Numéro de téléphone" required>
            </div>
            
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="text" name="grade" placeholder="Grade au sein de l'ASBL" required>
            <button type="submit">Créer mon compte</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'Erreur') === false ? 'success' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePasswordIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
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
