<?php
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];
$langue = $_POST['langue'];

// Définir la valeur par défaut pour le champ "role"
$role = "user";

// Connexion à la base de données
$servername = "localhost"; // Remplacez par le nom de votre serveur
$username = "root"; // Remplacez par votre nom d'utilisateur de la base de données
$password_db = ""; // Remplacez par votre mot de passe de la base de données
$dbname = "projtrans agenda"; // Remplacez par le nom de votre base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL avec une requête préparée pour insérer les données dans la table "users"
$sql = "INSERT INTO users (nom, prenom, e_mail, password, langue, role) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nom, $prenom, $email, $password, $langue, $role);

if ($stmt->execute()) {
    // Redirection vers la page login.html
    header("Location: login.html");
    exit;
} else {
    echo "Erreur lors de l'inscription : " . $stmt->error;
}

// Fermer les ressources et la connexion à la base de données
$stmt->close();
$conn->close();
?>
