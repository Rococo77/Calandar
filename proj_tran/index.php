<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title> Agenda </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>

</head>
<body>
    <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "projtrans_agenda";
            
            // Création de la connexion
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Échec de la connexion à la base de données : " . $conn->connect_error);
            }?>

    <header>
        <div class="header-1">
            <div class="header-1-1">
                <div class="header-1-1-1">
                    <img src="image/logo_epsi.png" alt="LOGO">
                </div>
            </div>
            <div class="header-1-2">
                Bienvenue !
            </div>
            <div class="header-1-3">
                <div class="header-1-3-1">
                    <img src="image/logo_pdp.png" alt="logo-pdp">
                </div>
            </div>
        </div>
        <div class="header-2">

            <div class="header-2-1">
                Aujourd'hui
            </div>
            
            <div class="header-2-2">
                <div class="header-2-2-1" id="previous">
                    &lt;
                </div>
                <div class="header-2-2-2" id="current-date">
                </div>
                <div class="header-2-2-3" id="next">
                    &gt;
                </div>
            </div>
            <script src='date.js'></script>

            <div class="header-2-3">
                Semaine <
            </div>
            
            <div class="header-2-4">
                <div class="header-2-4-1"></div>
                <div class="header-2-4-1"></div>
                <div class="header-2-4-1"></div>
            </div>

        </div>
    </header>

    <main>
        <div class="main-1">
            <div class="main-1-1">
            
                <div class="main-1-1-1">
                    Horaires
                </div>

                <div class="main-1-1-2">
                    Lundi
                </div>


                <div class="main-1-1-3">
                    Mardi
                </div>


                <div class="main-1-1-4">
                    Mercredi
                </div>


                <div class="main-1-1-5">
                    Jeudi
                </div>


                <div class="main-1-1-6">
                    Vendredi
                </div>


                <div class="main-1-1-7">
                    Samedi
                </div>


                <div class="main-1-1-8">
                    Dimanche
                </div>

            </div>
            
            <div class="main-1-2"> 
            
                <div class="main-1-2-1"></div>
                
                <div class="main-1-2-2"></div>
                
                <div class="main-1-2-3"></div>
                
                <div class="main-1-2-4"></div>
                
                <div class="main-1-2-5"></div>
                
                <div class="main-1-2-6"></div>
                
                <div class="main-1-2-7"></div>
                
                <div class="main-1-2-8"></div>
            </div>
            <div class="main-1-3"> 
                <div class="main-1-3-1">
                    <?php
      // Affichage des plages horaires
      $heureDebut = 7;
      $minuteDebut = 30;
      $heureFin = 22;
      $minuteFin = 30;

      for ($heure = $heureDebut; $heure <= $heureFin; $heure++) {
        for ($minute = $minuteDebut; $minute <= $minuteFin; $minute += 30) {
          $horaire = sprintf('%02d:%02d', $heure, $minute);
          echo '<div class="horaire">' . $horaire . '</div>';
        }
      }
      ?>
      </div>
            <?php

            
             // Récupération de l'ID utilisateur depuis la variable $_GET
            $id_utilisateur = $_GET['id'];

            // Préparation de la requête SQL avec un paramètre
            $requeteSQL = "
                SELECT evenement.nom_event, evenement.description, evenement.lieux, evenement.intervenant, evenement.visio
                FROM evenement
                INNER JOIN r_event ON evenement.id_revent = r_event.id_revent
                INNER JOIN usergroup ON r_event.id_groupe = usergroup.id_groupe
                INNER JOIN groupe ON r_event.id_groupe = groupe.id_groupe
                WHERE DATE(evenement.debut_event) = ? AND usergroup.id_users = ?
                ";

                $stmt = $conn->prepare($requeteSQL);
                $stmt->bind_param("ss", $dateFormatted, $id_utilisateur);
                $stmt->execute();
                
                // Récupération des résultats
                $resultat = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            ?>
            <div class="main-1-3-2">
            <?php
            // Affichage des événements pour le lundi
            foreach ($evenements['Lundi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>

                </div>
                
                <div class="main-1-3-3">
            <?php
            // Affichage des événements pour le Mardi
            foreach ($evenements['Mardi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>
                </div>
                
                <div class="main-1-3-4">
                <?php
            // Affichage des événements pour le Mercredi
            foreach ($evenements['Mercredi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>
                </div>
                
                <div class="main-1-3-5">
                <?php
            // Affichage des événements pour le Jeudi
            foreach ($evenements['Jeudi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>

                </div>
                
                <div class="main-1-3-6">
            <?php
            // Affichage des événements pour le Vendredi
            foreach ($evenements['Vendredi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>

                </div>
                
                <div class="main-1-3-7">
            <?php
            // Affichage des événements pour le Samedi
            foreach ($evenements['Samedi'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>
                </div>
                
                <div class="main-1-3-8">
                <?php
            // Affichage des événements pour le Dimanche
            foreach ($evenements['Dimanche'] as $evenement) {
                echo '<div class="evenement">';
                echo '<h4>' . $evenement['nom_event'] . '</h4>';
                echo '<p>' . $evenement['description'] . '</p>';
                echo '<p>Lieu: ' . $evenement['lieux'] . '</p>';
                echo '<p>Intervenant: ' . $evenement['intervenant'] . '</p>';
                echo '<p>Groupe: ' . $evenement['nom'] . '</p>';
                echo '<p>Visio: ' . $evenement['visio'] . '</p>';
                echo '</div>';
            }
            ?>
                </div>
            </div>
        </div>
        <div class="main-2" id ="main-2">
            <div class="main-2-1">
                <?php
// Récupérer la date actuelle
$today = new DateTime();

// Obtenir le numéro du mois et de l'année
$month = $today->format('n');
$year = $today->format('Y');

// Nombre de jours dans le mois en cours
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Premier jour du mois en cours
$firstDayOfMonth = new DateTime("$year-$month-01");
$firstDayOfWeek = $firstDayOfMonth->format('N');

// Tableau des noms de jours de la semaine
$daysOfWeek = array('L', 'Ma', 'Me', 'J', 'V', 'S', 'D');

// Affichage du calendrier
echo "<table>";
echo "<caption>Calendrier du mois </caption>";
echo "<tr>";

// En-tête des jours de la semaine
foreach ($daysOfWeek as $dayOfWeek) {
    echo "<th>$dayOfWeek</th>";
}

echo "</tr><tr>";

// Espacement pour le premier jour du mois
for ($i = 1; $i < $firstDayOfWeek; $i++) {
    echo "<td></td>";
}

// Jours du mois
$currentDay = 1;
while ($currentDay <= $daysInMonth) {
    // Nouvelle ligne après chaque semaine complète
    if ($firstDayOfWeek > 7) {
        echo "</tr><tr>";
        $firstDayOfWeek = 1;
    }

    // Affichage du jour
    echo "<td>$currentDay</td>";

    $currentDay++;
    $firstDayOfWeek++;
}

// Espacement pour les jours restants du mois
while ($firstDayOfWeek <= 7) {
    echo "<td></td>";
    $firstDayOfWeek++;
}

echo "</tr>";
echo "</table>";
?>

            </div>
            <div class="main-2-2" style="font-size: 12px;">
                Prochain devoir
            </div>
            <div class="main-2-3" style="font-size: 12px;">
                Agenda 1
            </div>
            <div class="main-2-4" style="font-size: 12px;">
                Agenda 2
            </div>
            <div class="main-2-5" style="font-size: 12px;">
                Agenda 3
            </div>
            <div class="main-2-6" style="font-size: 12px;">
                Agenda 4
            </div>

        </div>
    </main>

    <footer>

    </footer>
</body>
</html>