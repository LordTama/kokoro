<?php
$global_vars = array(
	'MSG_ERROR'		=>	'ERROR',
	'MSG_INFO'		=>	'INFO',
	'MSG_FORM'		=>	'FORM',
);

// Mise en constante globale
foreach($global_vars as $key => $value) define($key, $value);
?>