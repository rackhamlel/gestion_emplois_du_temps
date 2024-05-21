document.addEventListener('DOMContentLoaded', function() {
    var today = new Date(); // Récupérer la date d'aujourd'hui
    var nextWeek = new Date(today); // Créer une copie de la date d'aujourd'hui
    nextWeek.setDate(nextWeek.getDate() + (1 + 14 - nextWeek.getDay())); // Avancer de deux semaine à partir du lundi suivant

    var twoWeeksLater = new Date(nextWeek); // Créer une copie de la date de la semaine suivante
    twoWeeksLater.setDate(twoWeeksLater.getDate() + 7); // Avancer d'une semaine à partir du lundi suivant

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

        html += '</ul>';
        return html;
    }

    // Afficher seulement la semaine suivante, en excluant les samedis et dimanches
    calendar.innerHTML = '<h2>Calendrier</h2>' + '<div class="week">' + displayWeek(nextWeek) + '</div>';
    var editButtons = document.querySelectorAll('.editBtn');

    // Ajoutez un gestionnaire d'événements à chaque bouton
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Récupérez l'ID de l'utilisateur à partir de l'attribut data-id
            var userId = this.getAttribute('data-id');

            // Affichez le formulaire d'édition lorsque le bouton est cliqué
            document.getElementById('editForm').style.display = 'block';

            // Assurez-vous que l'ID de l'utilisateur est inclus dans le formulaire
            document.getElementById('userIdInput').value = userId;
        });
    });
});
