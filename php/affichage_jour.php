<?php
// Fonction pour obtenir le nom du jour en français
function getFrenchDayName($date) {
    $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    return $days[date('w', strtotime($date))];
}

// Fonction pour obtenir le nom du mois en français
function getFrenchMonthName($date) {
    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    return $months[date('n', strtotime($date)) - 1];
}

// Fonction pour afficher une semaine de dates en français
function displayWeek($startDate) {
    $currentDate = strtotime($startDate); // Convertir la date de départ en timestamp
    $html = '<ul>';

    // Remonter au lundi de la semaine en cours
    $currentDate = strtotime('Monday this week', $currentDate);

    // Boucle pour afficher les dates pour chaque jour de la semaine
    for ($i = 0; $i < 7; $i++) {
        $html .= '<th>' . getFrenchDayName(date('Y-m-d', $currentDate)) . ' ' . date('d', $currentDate) . ' ' . getFrenchMonthName(date('Y-m-d', $currentDate)) . '</th>'; // Ajouter la date à la liste
        $currentDate = strtotime('+1 day', $currentDate); // Passer à la prochaine date
    }

    $html .= '</th>';
    return $html;
}

// Fonction pour afficher les trois semaines en français
function displayThreeWeeks($startDate) {
    $html = '<h2>Calendrier</h2>';

    // Boucle pour afficher les trois prochaines semaines
    for ($i = 0; $i < 4; $i++) {
        $html .= '<div class="week">' . displayWeek(date('Y-m-d', strtotime($startDate))) . '</div>'; // Ajouter une semaine au calendrier
        $startDate = date('Y-m-d', strtotime($startDate . ' +7 days')); // Passer à la prochaine semaine
    }

    echo $html; // Afficher le calendrier dans l'élément avec l'ID 'calendar'
}

// Récupérer la date d'aujourd'hui
$today = date('Y-m-d');

// Afficher les trois prochaines semaines à partir de la date d'aujourd'hui
displayThreeWeeks($today);
?>