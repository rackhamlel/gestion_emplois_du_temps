document.addEventListener('DOMContentLoaded', function() {
    var today = new Date(); // Récupérer la date d'aujourd'hui
    var calendar = document.getElementById('calendar');

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

    // Fonction pour afficher une semaine de dates en français
    function displayWeek(startDate) {
        var currentDate = new Date(startDate); // Convertir la date de départ en objet Date
        var html = '<ul>';

        // Remonter au lundi de la semaine en cours
        currentDate.setDate(currentDate.getDate() - currentDate.getDay() + 1);

        // Boucle pour afficher les dates pour chaque jour de la semaine
        for (var i = 0; i < 7; i++) {
            html += '<tr>' + getFrenchDayName(currentDate) + ' ' + currentDate.getDate() + ' ' + getFrenchMonthName(currentDate) + '</th>'; // Ajouter la date à la liste
            currentDate.setDate(currentDate.getDate() + 1); // Passer à la prochaine date
        }

        html += '</tr>';
        return html;
    }

    // Fonction pour afficher les trois semaines en français
    function displayThreeWeeks(startDate) {
        var html = '<h2>Calendrier</h2>';

        // Boucle pour afficher les trois prochaines semaines
        for (var i = 0; i < 4; i++) {
            html += '<div class="week">' + displayWeek(startDate) + '</div>'; // Ajouter une semaine au calendrier
            startDate.setDate(startDate.getDate() + 7); // Passer à la prochaine semaine
        }

        calendar.innerHTML = html; // Afficher le calendrier dans l'élément avec l'ID 'calendar'
    }

    displayThreeWeeks(today); // Afficher les trois prochaines semaines à partir de la date d'aujourd'hui
});
