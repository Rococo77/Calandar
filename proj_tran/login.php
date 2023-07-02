<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "projtrans_agenda";

// Récupération des données du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pwd);

    // Configuration des attributs PDO pour générer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête avec des paramètres
    $stmt = $conn->prepare("SELECT * FROM users WHERE e_mail = ? AND password = ?");
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $password);

    // Exécution de la requête préparée
    $stmt->execute();

    // Récupération des résultats
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        // L'utilisateur est connecté avec succès, vous pouvez effectuer les actions nécessaires ici
        $row = $result[0];
        $id_utilisateur = $row['id_users'];
        // Par exemple, vous pouvez rediriger l'utilisateur vers une autre page
        header("Location: index.php?id=" . $id_utilisateur);
        exit(); // Important : arrêter l'exécution du script après la redirection
    } else {
        echo "Adresse e-mail ou mot de passe incorrect.";
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion ou d'exécution de la requête
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$conn = null;
?>