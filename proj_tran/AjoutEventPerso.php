<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "projtrans_agenda";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $pwd, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Vérifier si le formulaire de création d'événement a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nomEvent = $_POST['nom_event'];
    $debutEvent = $_POST['debut_event'];
    $finEvent = $_POST['fin_event'];
    $description = $_POST['description'];
    $lieux = $_POST['lieux'];

    // Vérifier si un autre événement existant chevauche le laps de temps de l'événement créé par l'utilisateur
    $requeteChevauchement = "SELECT * FROM evenement WHERE id_users = ? AND (debut_event <= ? AND fin_event >= ?)";
    $stmtChevauchement = $conn->prepare($requeteChevauchement);
    $stmtChevauchement->bind_param("sss", $idUtilisateur, $finEvent, $debutEvent);
    $stmtChevauchement->execute();
    $resultatChevauchement = $stmtChevauchement->get_result();

    // Si un chevauchement est trouvé, afficher un message d'erreur à l'utilisateur
    if ($resultatChevauchement->num_rows > 0) {
        echo "Un autre événement est déjà prévu pendant cette période.";
    } else {
        // Créer l'événement dans la base de données
        $requeteCount = "SELECT COUNT(id_event) FROM evenement";
        $resultatCount = $conn->query($requeteCount);
        if ($resultatCount) {
            $count = $resultatCount->fetch_row()[0];
            $newIdEvent = $count + 1;
        
            $requeteCreation = "INSERT INTO evenement (id_event, nom_event, debut_event, fin_event, description, lieux, intervenant, id_users) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtCreation = $conn->prepare($requeteCreation);
            $stmtCreation->bind_param("issssssi", $newIdEvent, $nomEvent, $debutEvent, $finEvent, $description, $lieux, $intervenant, $idUtilisateur);
            $stmtCreation->execute();
            header('Location: index.php');
        } else {
            echo "Une erreur s'est produite";
        }
    }
}

// Fermer la connexion à la base de données
$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un evenement personnel</title>
    <link rel="stylesheet" type="text/css" href="style-login.css">
</head>
<body>
<!-- Formulaire de création d'événement -->
<form method="POST" action="">
    <label for="nom_event">Nom de l'événement:</label>
    <input type="text" name="nom_event" id="nom_event" required>

    <label for="debut_event">Début de l'événement:</label>
    <input type="datetime-local" name="debut_event" id="debut_event" required>

    <label for="fin_event">Fin de l'événement:</label>
    <input type="datetime-local" name="fin_event" id="fin_event" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" ></textarea>

    <label for="lieux">Lieux:</label>
    <input type="text" name="lieux" id="lieux">

    <button type="submit">Créer l'événement</button>
</form>
