document.addEventListener('DOMContentLoaded', function() {
    // Récupérer la date actuelle
var currentDate = new Date();

// Obtenir le jour, le mois et l'année
var day = currentDate.getDate();
var month = currentDate.getMonth() + 1; // Les mois sont indexés à partir de 0, donc on ajoute 1
var year = currentDate.getFullYear();

// Formater la date au format souhaité (par exemple, jj/mm/aaaa)
var formattedDate = day + '/' + month + '/' + year;

// Mettre à jour le contenu de la balise div avec l'identifiant "current-date"
document.getElementById('current-date').innerHTML = formattedDate;

// Récupérer les références des div cliquables
var previousDayButton = document.getElementById('previous');
var nextDayButton = document.getElementById('next');

// Ajouter des écouteurs d'événements pour les clics sur les div
previousDayButton.addEventListener('click', navigatePreviousWeek);
nextDayButton.addEventListener('click', navigateNextWeek);

// Fonction de navigation vers le jour précédent
function navigatePrevious() {
  // Décrémenter la date actuelle d'un jour
  currentDate.setDate(currentDate.getDate() - 1);

  // Mettre à jour l'affichage de la date
  updateDate();
}
function navigateNextWeek() {

    currentDate.setDate(currentDate.getDate() + 5);
  
    // Mettre à jour la date actuelle
    updateDate();
  }
function navigatePreviousWeek() {

    currentDate.setDate(currentDate.getDate() - 5);
  
    // Mettre à jour la date actuelle
    updateDate();
  }


// Fonction de navigation vers le jour suivant
function navigateNext() {
  // Incrémenter la date actuelle d'un jour
  currentDate.setDate(currentDate.getDate() + 1);

  // Mettre à jour l'affichage de la date
  updateDate();
}

// Fonction pour mettre à jour l'affichage de la date
function updateDate() {
  // Obtenir le jour, le mois et l'année
  var day = currentDate.getDate();
  var month = currentDate.getMonth() + 1; // Les mois sont indexés à partir de 0, donc on ajoute 1
  var year = currentDate.getFullYear();

  // Formater la date au format souhaité (par exemple, jj/mm/aaaa)
  var formattedDate = day + '/' + month + '/' + year;

  // Mettre à jour le contenu de la balise div avec l'identifiant "current-date"
  document.getElementById('current-date').innerHTML = formattedDate;
}

  });
  