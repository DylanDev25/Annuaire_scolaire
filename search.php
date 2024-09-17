<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$search_result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];
    $sql = "SELECT * FROM schools WHERE school_name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $search_result .= "Nom de l'école: " . $row['school_name'] . "<br>";
            $search_result .= "Nom de la direction: " . $row['director_name'] . "<br>";
            $search_result .= "Adresse: " . $row['address'] . "<br>";
            $search_result .= "Email: " . $row['email'] . "<br>";
            $search_result .= "Téléphone: " . $row['phone'] . "<br>";
            $search_result .= "------------------------<br>";
        }
    } else {
        $search_result = "Aucun résultat trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher une école</title>
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
    
    <h2>Rechercher une école</h2>
    <div class="form_bis">
    <form method="post" action="search.php">
        <input type="text" name="search_query" placeholder="Entrez le nom de l'école" required><br>
        <button type="submit">Rechercher</button>
    </form>
    </div>
    <div>
        <?php echo $search_result; ?>
    </div>
</body>
</html>
