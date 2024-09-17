<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: succes.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_name = $_POST['school_name'];
    $director_name = $_POST['director_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $contact_method = $_POST['contact_method'];
    $school_type = $_POST['school_type'];
    $class_years = $_POST['class_years'];
    $contacted = $_POST['contacted'];
    $contacte = $_POST['contacte'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $notes = $_POST['notes'];

    // Ajout de l'école à la base de données
    $sql = "INSERT INTO schools (school_name, director_name, address, email, phone, contact_method, school_type, class_years, contacted , contacte ,  appointment_date, appointment_time, notes)
            VALUES ('$school_name', '$director_name', '$address', '$email', '$phone', '$contacted', '$school_type', '$class_years','$contacte', '$contact_method', '$appointment_date', '$appointment_time', '$notes')";

    if ($conn->query($sql) === TRUE) {
        // Redirection après ajout réussi
        header("Location: succes.php?message=École ajoutée avec succès");
        exit();
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une école</title>
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

    <h2>Ajouter une école : </h2>
    <div class="form_bis">
    <form action="add_school.php" method="post" enctype="multipart/form-data">
    <input type="text" name="school_name" placeholder="Nom de l'école" required><br>
    <input type="text" name="director_name" placeholder="Nom de la direction" required><br>
    <input type="text" name="address" placeholder="Adresse postale" required><br>
    <input type="email" name="email" placeholder="Adresse email" required><br>
    <input type="tel" name="phone" placeholder="Numéro de téléphone" required><br>
     <input type="text" name="contact_method" placeholder="Moyen de contact"><br>
    <label>Type d'école:</label>
    <select name="school_type" required>
        <option value="primaire">Primaire</option>
        <option value="secondaire">Secondaire</option>
    </select><br>
    <input type="text" name="class_years" placeholder="Année de classe (ex: 1 à 6)"><br>
    <label>Ecole contactée :</label>
    <select id="contacte" name="contacte">
        <option value="non" selected>Non</option>
        <option value="oui">Oui</option>
    </select><br>

    <label>Rendez-vous pris :</label>
    <select id="contacted" name="contacted" required onchange="toggleAppointmentFields()">
        <option value="non" selected>Non</option> 
        <option value="oui">Oui</option>
    </select><br>

    <div id="appointmentFields" style="display: none;">
        <label>Date du rendez-vous:</label>
        <input type="date" name="appointment_date"><br>
        <label>Heure du rendez-vous:</label>
        <input type="time" name="appointment_time"><br>
    </div>

   
    <textarea name="notes" placeholder="Notes supplémentaires"></textarea><br>
    <button type="submit">Ajouter l'école</button>
</form>
</div>
<script>
    function toggleAppointmentFields() {
        const contactedSelect = document.getElementById("contacted");
        const appointmentFields = document.getElementById("appointmentFields");

        // Afficher ou cacher les champs de rendez-vous en fonction de la sélection
        if (contactedSelect.value === "oui") {
            appointmentFields.style.display = "block"; // Affiche les champs de rendez-vous
        } else {
            appointmentFields.style.display = "none"; // Cache les champs de rendez-vous
        }
    }
</script>


</body>
</html>
