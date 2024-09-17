<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM schools WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $school = $result->fetch_assoc();
} else {
    echo "École non trouvée.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_name = $_POST['school_name'];
    $director_name = $_POST['director_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $contacted = $_POST['contacted'];
    $contacte = $_POST['contacte'];
    $contact_method = $_POST['contact_method'];
    $school_type = $_POST['school_type'];
    $class_years = $_POST['class_years'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $notes = $_POST['notes'];

    // Si "Non" est sélectionné pour "contacted", ne pas mettre à jour les champs de rendez-vous
    if ($contacted === 'non') {
        $appointment_date = NULL;
        $appointment_time = NULL;
    }

    $update_sql = "UPDATE schools SET 
        school_name='$school_name', 
        director_name='$director_name', 
        address='$address', 
        email='$email', 
        phone='$phone', 
        contacted='$contacted', 
        contacte='$contacte', 
        contact_method='$contact_method', 
        school_type='$school_type', 
        class_years='$class_years', 
        appointment_date='$appointment_date', 
        appointment_time='$appointment_time', 
        notes='$notes' 
        WHERE id='$id'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: view_school.php");
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'école</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Fonction pour afficher/masquer les champs de rendez-vous
        function toggleAppointmentFields() {
            const contactedSelect = document.querySelector('select[name="contacted"]');
            const appointmentFields = document.getElementById('appointmentFields');
            if (contactedSelect.value === 'oui') {
                appointmentFields.style.display = 'block';
            } else {
                appointmentFields.style.display = 'none';
                // Réinitialiser les valeurs si non sélectionné
                document.querySelector('input[name="appointment_date"]').value = '';
                document.querySelector('input[name="appointment_time"]').value = '';
            }
        }
    </script>
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
    
    <h2>Modifier les informations de l'école</h2>
    <div class="form_bis">
    <form method="post" action="edit_school.php?id=<?php echo $id; ?>">
        <input type="text" name="school_name" value="<?php echo htmlspecialchars($school['school_name']); ?>" placeholder="Nom de l'école" required><br>
        <input type="text" name="director_name" value="<?php echo htmlspecialchars($school['director_name']); ?>" placeholder="Nom de la direction" required><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($school['address']); ?>" placeholder="Adresse postale" required><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($school['email']); ?>" placeholder="Adresse email" required><br>
        <input type="tel" name="phone" value="<?php echo htmlspecialchars($school['phone']); ?>" placeholder="Numéro de téléphone" required><br>
        <input type="text" name="contact_method" value="<?php echo htmlspecialchars($school['contact_method']); ?>" placeholder="Moyen de contact"><br>
        <label>Type d'école:</label>
        <select name="school_type" required>
            <option value="primaire" <?php if ($school['school_type'] == 'primaire') echo 'selected'; ?>>Primaire</option>
            <option value="secondaire" <?php if ($school['school_type'] == 'secondaire') echo 'selected'; ?>>Secondaire</option>
        </select><br>
        <input type="text" name="class_years" value="<?php echo htmlspecialchars($school['class_years']); ?>" placeholder="Année de classe (ex: 1 à 6)"><br>

        <label>Ecole contactée :</label>
        <select name="contacte">
            <option value="oui" <?php if ($school['contacte'] == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if ($school['contacte'] == 'non') echo 'selected'; ?>>Non</option>
        </select><br>


        <label>Rendez-vous pris :</label>
        <select name="contacted" onchange="toggleAppointmentFields()" required>
            <option value="oui" <?php if ($school['contacted'] == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if ($school['contacted'] == 'non') echo 'selected'; ?>>Non</option>
        </select><br>

        
        <div id="appointmentFields" style="display: <?php echo ($school['contacted'] == 'oui') ? 'block' : 'none'; ?>">
            <label>Date du rendez-vous:</label>
            <input type="date" name="appointment_date" value="<?php echo htmlspecialchars($school['appointment_date']); ?>"><br>
            <label>Heure du rendez-vous:</label>
            <input type="time" name="appointment_time" value="<?php echo htmlspecialchars($school['appointment_time']); ?>"><br>
        </div>

        <textarea name="notes" placeholder="Notes supplémentaires"><?php echo htmlspecialchars($school['notes']); ?></textarea><br>
        <button type="submit">Modifier l'école</button>
    </form>
</div>
    <script>
        // Initialiser l'affichage des champs de rendez-vous
        toggleAppointmentFields();
    </script>
</body>
</html>
