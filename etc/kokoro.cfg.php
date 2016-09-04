<?php
# Parametrage des classes
# -----------------------

// Définition du nom des tables Kokoro
$kok_app_nom					=	'kokoro_app';
$kok_log_nom					=	'kokoro_log';
$kok_right_nom					=	'kokoro_right';
$kok_role_nom					=	'kokoro_role';
$kok_user_nom					=	'kokoro_user';

// Définition des champs des tables Kokoro
$kok_app_champs					=	array('app_id', 'app_name', 'app_dir', 'app_description', 'app_version', 'app_date');
$kok_log_champs					=	array('log_id', 'log_user_id', 'log_app_id', 'log_date', 'log_text');
$kok_right_champs				=	array('rgt_id', 'rgt_user_id', 'rgt_role_id');
$kok_role_champs				=	array('rol_id', 'rol_app_id', 'rol_slug', 'rol_short', 'rol_description');
$kok_user_champs				=	array('usr_id', 'usr_first_name', 'usr_last_name', 'usr_mail', 'usr_login', 'usr_passwd', 'usr_salt', 'usr_init', 'usr_status');

// Définition des clés primaires
$kok_app_id						=	array('app_id');
$kok_log_id						=	array('log_id');
$kok_right_id					=	array('rgt_id');
$kok_role_id					=	array('rol_id');
$kok_user_id					=	array('usr_id');

// Déclaration des variables globales
$global_vars = array(
	// Nom des tables
	'KOK_APP_TABLE'				=>	$kok_app_nom,
	'KOK_LOG_TABLE'				=>	$kok_log_nom,
	'KOK_RIGHT_TABLE'        	=>  $kok_right_nom,
	'KOK_ROLE_TABLE'            =>  $kok_role_nom,
	'KOK_USER_TABLE'			=>	$kok_user_nom,
	
	// Structure des tables Kokoro
	'KOK_APP_STRUCTURE'			=>	serialize(array(
		$kok_app_nom			=>	$kok_app_champs,
	)),
	'KOK_LOG_STRUCTURE'			=>	serialize(array(
		$kok_log_nom			=>	$kok_log_champs,
	)),
	'KOK_RIGHT_STRUCTURE'		=>	serialize(array(
		$kok_right_nom			=>	$kok_right_champs,
		$kok_role_nom			=>	$kok_role_champs,
	)),
	'KOK_ROLE_STRUCTURE'		=>	serialize(array(
		$kok_role_nom			=>	$kok_role_champs,		
	)),
	'KOK_USER_STRUCTURE'		=>	serialize(array(
		$kok_user_nom			=>	$kok_user_champs,
		$kok_right_nom			=>	$kok_right_champs,
		$kok_role_nom			=>	$kok_role_champs,
	)),
	
	// Clé primaire des tables
	'KOK_APP_CHAMP_ID'			=>	serialize(array(
		$kok_app_nom			=>	$kok_app_id,
	)),
	'KOK_LOG_CHAMP_ID'			=>	serialize(array(
		$kok_log_nom			=>	$kok_log_id,
	)),
	'KOK_RIGHT_CHAMP_ID'		=>	serialize(array(
		$kok_right_nom			=>	$kok_right_id,
	)),
	'KOK_ROLE_CHAMP_ID'			=>	serialize(array(
		$kok_role_nom			=>	$kok_role_id,
	)),
	'KOK_USER_CHAMP_ID'			=>	serialize(array(
		$kok_user_nom			=>	$kok_user_id,
	)),
	
	// Jointures entre les tables
	'KOK_APP_JOINTURES'			=>	serialize(array(
		// Pas de jointure
	)),
	'KOK_LOG_JOINTURES'			=>	serialize(array(
		// Pas de jointure
	)),
	'KOK_RIGHT_JOINTURES'		=>	serialize(array(
	 	$kok_right_nom.'.rgt_role_id'	=>	$kok_role_nom.'.rol_id',
	 	$kok_right_nom.'.rgt_user_id'	=>	$kok_user_nom.'.usr_id',
	)),
	'KOK_ROLE_JOINTURES'		=>	serialize(array(
		// Pas de jointure
	)),
	'KOK_USER_JOINTURES'		=>	serialize(array(
	  	$kok_user_nom.'.usr_id'			=>	$kok_right_nom.'.rgt_user_id',
	)),

);

// Mise en constante globale
foreach($global_vars as $key => $value) define($key, $value);
?>