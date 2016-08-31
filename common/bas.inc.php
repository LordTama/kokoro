<?php
// On arrête le chrono de temps de génération de la page et on le parse
$script_time = round((getmicrotime() - $start_script_time), 3);
$xtpl->assign('propulsion', $script_time);

// On affiche la page
$xtpl->parse('main.HEADER');
$xtpl->parse('main.FOOTER');
$xtpl->parse('main.CONTENT');
$xtpl->parse('main.RIGHT_TOOLBAR');

$xtpl->parse('main');
$xtpl->out('main');
?>