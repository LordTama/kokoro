<?php
/**
* Divers fonctions utiles concernant le temps
*/

/**
* Retourne une date sous la forme JJ/MM/AAAA HH:MM:SS à partir d'un datetime
*/
function dateFr($datetime) {
	return date('d/m/Y H:i:s', strtotime($datetime));
}

/**
* Retourne une date sous la forme française compléte à partir d'un datetime
*/
function dateFrLong($datetime) {
	setlocale (LC_TIME, 'french');
	return strftime('%A %d %B %Y, %H:%M:%S', strtotime($datetime));
}
/**
* Retourne une date sous la forme française à partir d'un datetime
*/
function dateFrCourt($datetime) {
	setlocale (LC_TIME, 'french');
	return strftime('%A %d %B', strtotime($datetime));
}

/**
* Retourne une date sous la forme française par une comprise par SQL
*/
function date2SQL($date) {
	$retour = sscanf($date, '%d/%d/%d %d:%d:%d', $jour, $mois, $annee, $heure, $minute, $seconde);
	
	if($retour == 3 || $retour == 6) return date('Y-m-d H:i:s', mktime($heure, $minute, $seconde, $mois, $jour, $annee));
	else return false;
}
?>