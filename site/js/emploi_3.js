document.addEventListener('DOMContentLoaded', function() {
    var today = new Date(); // Récupérer la date d'aujourd'hui
    var nextWeekPlusTwo = new Date(today); // Créer une copie de la date d'aujourd'hui
    nextWeekPlusTwo.setDate(nextWeekPlusTwo.getDate() + (1 + 7 - nextWeekPlusTwo.getDay()) + 7 * 2); // Avancer de deux semaines à partir du lundi suivant

    var calendar = document.getElementById('joursSemaine');

    // Fonction pour obtenir le nom du jour en français
    function getFrenchDayName(date) {
        var days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        return days[date.getDay()];
    }

    // Fonction pour obtenir le nom du mois en français
    function getFrenchMonthName(date) {
        var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        return months[date.getMonth()];
    }

    // Fonction pour afficher une semaine de dates en français, excluant les samedis et dimanches
    function displayWeek(startDate) {
        var currentDate = new Date(startDate); // Convertir la date de départ en objet Date
        var html = '<ul>';

        // Boucle pour afficher les dates pour chaque jour de la semaine, en excluant les samedis et dimanches
        for (var i = 0; i < 5; i++) {
            html += '<th>' + getFrenchDayName(currentDate) + ' ' + currentDate.getDate() + ' ' + getFrenchMonthName(currentDate) + '</th>'; // Ajouter la date à la liste
            currentDate.setDate(currentDate.getDate() + 1); // Passer à la prochaine date
        }

        html += '</th>';
        return html;
    }

    // Afficher seulement la semaine +2, en excluant les samedis et dimanches
    calendar.innerHTML = '<h2>Calendrier</h2>' + '<div class="week">' + displayWeek(nextWeekPlusTwo) + '</div>';
});
