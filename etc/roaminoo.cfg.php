<?php
# Parametrage des classes
# -----------------------

// Définition du nom des tables principales ROAMINOO
$roa_app_nom		   			=     'roaminoo_app';
$roa_log_nom		   			=	  'roaminoo_log';
$roa_user_nom		  			=	  'roaminoo_user';
$roa_ope_nom		  			=	  'roaminoo_ope';
$roa_pays_nom		  			=	  'roaminoo_pays';
$roa_role_nom		  			=	  'roaminoo_role';
$roa_right_nom 		  			=     'roaminoo_right';
$roa_ope_history_nom  			=     'roaminoo_ope_history';
$roa_ope_ndc_nom 	  			=     'roaminoo_ope_ndc';
$roa_ss7_nom 		  			=     'roaminoo_ss7_carrier';
$roa_ope_group_nom    			=     'roaminoo_ope_group';
$roa_group_list_nom   			=     'roaminoo_group_list';
// Définition du nom des tables principales AMORGOS
$roam_acc_nom		  			=	  'roamorgos_accord';
$roam_tech_nom		  			=	  'roamorgos_techno';
$roam_event_nom	       			=	  'roamorgos_event';
$roam_filtre_nom 	   			=     'roamorgos_filtre';
$roam_objectif_nom 	   			=     'roamorgos_objectif';
$roam_stat_nom 		  			=     'roamorgos_stat';
// Définition du nom des tables principales SIMCARDS
$roas_simcard_nom 	  			=     'roasim_simcard';
$roas_simstatus_nom   			=     'roasim_status';
$roas_simloan_nom 	   			=     'roasim_simloan';
$roas_simloanlist_nom  			=     'roasim_loanlist';
$roas_simaudit_nom 	   			=     'roasim_simaudit';
$roas_simauditlist_nom 			=     'roasim_simaudit_list';
// Définition du nom des tables principales BDROAMING
$roabd_request_nom 	   			=     'roabd_request';
$roabd_changes_nom 	   			=     'roabd_changes';
$roabd_incident_nom    			= 	  'roabd_incident';
$roabd_incident_action_nom 		= 	  'roabd_incident_actions';
$roabd_incident_misc_nom 		= 	  'roabd_incident_misc';
$roabd_test_request_nom 		= 	  'roabd_test_request';
$roabd_test_request_history_nom =     'roabd_test_request_history';
$roabd_test_incident_nom 		=     'roabd_test_incident';


// Définition des champs des tables
$roa_app_champs			 			=	array('app_id', 'app_name', 'app_dir', 'app_description', 'app_version', 'app_date');
$roa_log_champs			 			=	array('log_id', 'log_user_id', 'log_app_name_id', 'log_date', 'log_text');
$roa_user_champs	     			=	array('usr_id', 'usr_name', 'usr_first_name', 'usr_mail', 'usr_login', 'usr_passwd', 'usr_init', 'usr_status');
$roa_ope_champs	         			=	array('ope_id', 'ope_pays_id', 'ope_name', 'ope_mnc', 'ope_nc', 'ope_tadig', 'ope_dns', 'ope_ip_range', 'ope_shortcode', 'ope_apn_oi', 'ope_realm_id', 'ope_camel_rin', 'ope_camel_rout');
$roa_pays_champs	     			=	array('pay_id', 'pay_name_fr', 'pay_name_en', 'pay_codet', 'pay_utc', 'pay_dst', 'pay_cc', 'pay_mcc', 'pay_pre_int', 'pay_pre_nat', 'pay_msisdn_length', 'pay_zone_area');
$roa_role_champs          			=   array('rol_id', 'rol_app_id', 'rol_slug', 'rol_libelle', 'rol_desc');
$roa_right_champs		  			=	array('rgt_id', 'rgt_user_id', 'rgt_role_id');
$roa_ope_history_champs   			=   array('hst_id', 'hst_ope_id', 'hst_edit_date', 'hst_ope_name');
$roa_ope_ndc_champs       			=   array('ndc_id', 'ndc_ope_id', 'ndc_type', 'ndc_start', 'ndc_end', 'ndc_value');
$roa_ss7_champs           			=   array('ss7_id', 'ss7_ope_id', 'ss7_signature', 'ss7_dpc');
$roa_ope_group_champs     			=   array('grp_id', 'grp_type', 'grp_name');
$roa_group_list_champs    			=   array('grl_id', 'grl_ope_id', 'grl_group_id');
// Définition des champs des tables AMORGOS
$roam_acc_champs	      			=	array('acc_id', 'acc_user_id', 'acc_tech_id', 'acc_ope_id', 'acc_sens', 'acc_date_param', 'acc_date_param', 'acc_date_real', 'acc_ouv_tech', 'acc_ouv_com', 'acc_reserve', 'acc_removed_reserves', 'acc_priorite', 'acc_status', 'acc_compliancy', 'acc_broker');
$roam_tech_champs	      			=	array('tec_id', 'tec_name');
$roam_event_champs	      			=	array('evt_id', 'evt_user_id', 'evt_acc_id', 'evt_type', 'evt_content', 'evt_date');
$roam_filtre_champs       			=   array('fil_id', 'fil_usr_id', 'fil_name', 'fil_value', 'fil_type');
$roam_objectif_champs     			=   array('obj_id', 'obj_stat_id', 'obj_tech_id', 'obj_value');
$roam_stat_champs         			=   array('sta_id', 'sta_year', 'sta_global_obj');
// Définition des champs des tables SIMCARDS
$roas_simcard_champs      			=   array('sim_id', 'sim_user_id', 'sim_ope_id', 'sim_iccid', 'sim_imsi', 'sim_msisdn', 'sim_segco', 'sim_localisation', 'sim_puk', 'sim_pin', 'sim_pin_modified', 'sim_comment', 'sim_date', 'sim_date_data', 'sim_date_lastcheck', 'sigos_profile', 'sigos_owner', 'sigos_camel_originale', 'sigos_camel_actuelle', 'sigos_declinaison', 'sigos_actual_user', 'sigos_sachem');
$roas_simstatus_champs    			=   array('sta_id', 'sta_user_id', 'sta_sim_id', 'sta_date', 'sta_comment', 'sta_etat');
$roas_simloan_champs      			=   array('loa_id', 'loa_user_id', 'loa_create_date', 'loa_people', 'loa_description', 'loa_status');
$roas_simloanlist_champs  			=   array('lnl_id', 'lnl_card_id', 'lnl_loan_id', 'lnl_date_begin', 'lnl_date_end');
$roas_simaudit_champs     			=   array('aud_id', 'aud_ope_id', 'aud_user_id', 'aud_status', 'aud_date', 'aud_comment');
$roas_simauditlist_champs 			=   array('lst_id', 'lst_audit_id', 'lst_card_id', 'lst_etat', 'lst_localisation');
// Définition des champs des tables BDROAMING
$roabd_request_champs     			=   array('req_id', 'req_ope_id', 'req_user_id', 'req_entity', 'req_date', 'req_echeance', 'req_execution', 'req_state');
$roabd_changes_champs     			=   array('cha_id', 'cha_request_id', 'cha_request_type', 'cha_operation_type', 'cha_comment', 'cha_request_description', 'cha_value');
$roabd_incident_champs    			=   array('inc_id', 'inc_user_id', 'inc_ope_id', 'inc_source_id', 'inc_sig_date', 'inc_inclusion_date', 'inc_failure_start', 'inc_failure_end', 'inc_cloture', 'inc_etat', 'inc_ocean_ticket', 'inc_sender', 'inc_agir_date', 'inc_sens', 'inc_service', 'inc_service_type', 'inc_impact', 'inc_terminal', 'inc_carrefour_info', 'inc_gravite', 'inc_nature', 'inc_cause');
$roabd_incident_action_champs		= 	array('act_id', 'act_user_id', 'act_inc_id', 'act_type', 'act_date', 'act_content');
$roabd_incident_misc_champs   		= 	array('msc_id', 'msc_type', 'msc_name', 'msc_status');
$roabd_test_request_champs 			=   array('tst_id', 'tst_ope_id', 'tst_user_id', 'tst_cha_id', 'tst_date_creation', 'tst_term_date', 'tst_comment', 'tst_status');
$roabd_test_request_history_champs 	=   array('thst_id', 'thst_test_id', 'thst_user_id', 'thst_type', 'thst_date_realisation', 'thst_comment', 'thst_result');
$roabd_test_incident_champs = array('tst_id', 'tst_type_id', 'tst_user_id', 'tst_ope_id', 'tst_sig_date', 'tst_taking_acount_date', 'tst_term_date', 'tst_execution_date', 'tst_duration', 'tst_description', 'tst_state');

// Définition des clés primaires
$roa_app_id			  			=	 array('app_id'); // $roa_app_champs[1] ?
$roa_log_id			 			=	 array('log_id');
$roa_user_id		  			=	 array('usr_id');
$roa_ope_id			  			=	 array('ope_id');
$roa_pays_id		  			=	 array('pay_id');
$roa_role_id    	  			=    array('rol_id');
$roa_right_id 		  			=    array('rgt_id');
$roa_ope_history_id  			=    array('hst_id');
$roa_ope_ndc_id 	 			=    array('ndc_id');
$roa_ss7_id 		  			=	 array('ss7_id');
$roa_ope_group_id 	  			=    array('grp_id');
$roa_group_list_id 	  			=    array('grl_id');
// Définition des clés primaires AMORGOS
$roam_acc_id		  			=    array('acc_id');
$roam_tech_id		  			=	 array('tec_id');
$roam_event_id		  			=	 array('evt_id');
$roam_filtre_id 	  			=    array('fil_id');
$roam_objectif_id 	  			=    array('obj_id');
$roam_stat_id 		  			=    array('sta_id');
//Définition des clés primaires SIMCARDS
$roas_simcard_id 	  			=   array('sim_id');
$roas_simstatus_id 	  			=   array('sta_id');
$roas_simloan_id 	  			=   array('loa_id');
$roas_simloanlist_id  			=   array('lnl_id');
$roas_simaudit_id 	  			=   array('aud_id');
$roas_simauditlist_id 			=   array('lst_id');
// Définition des clés primaires BDROAMING
$roabd_request_id 	  			=   array('req_id');
$roabd_changes_id 	  			=   array('cha_id');
$roabd_incident_id    			=   array('inc_id');
$roabd_incident_action_id 		= 	array('act_id');
$roabd_incident_misc_id 		= 	array('msc_id');
$roabd_test_request_id 			= 	array('tst_id');
$roabd_test_request_history_id 	= 	array('thst_id');
$roabd_test_incident_id	 		= 	array('tst_id');


// Déclaration des variables globales
$global_vars = array(
	// Nom des tables
	'ROA_APP_TABLE'						=>	$roa_app_nom,
	'ROA_LOG_TABLE'						=>	$roa_log_nom,
	'ROA_USER_TABLE'					=>	$roa_user_nom,
	'ROA_OPE_TABLE'						=>	$roa_ope_nom,
	'ROA_PAYS_TABLE'					=>	$roa_pays_nom,
	'ROA_ROLE_TABLE'            		=>  $roa_role_nom,
	'ROA_RIGHT_TABLE'        			=>  $roa_right_nom,
	'ROA_OPE_HISTORY_TABLE' 			=>  $roa_ope_history_nom,
	'ROA_OPE_NDC_TABLE'  				=>  $roa_ope_ndc_nom,
	'ROA_SS7_TABLE'  					=>  $roa_ss7_nom,
	'ROA_OPE_GROUP_TABLE' 				=>  $roa_ope_group_nom,
	'ROA_GROUP_LIST_TABLE'      		=>  $roa_group_list_nom,
	// Nom des tables AMORGOS
	'ROAM_ACC_TABLE'					=>	$roam_acc_nom,
	'ROAM_TECH_TABLE'					=>	$roam_tech_nom,
	'ROAM_EVENT_TABLE'					=>	$roam_event_nom,
	'ROAM_FILTRE_TABLE'					=>	$roam_filtre_nom,
	'ROAM_OBJECTIF_TABLE'				=>	$roam_objectif_nom,
	'ROAM_STAT_TABLE'					=>	$roam_stat_nom,
	// Nom des tables SIMCARDS
	'ROAS_SIMCARD_TABLE'				=>	$roas_simcard_nom,
	'ROAS_SIMSTATUS_TABLE'				=>	$roas_simstatus_nom,
	'ROAS_SIMLOAN_TABLE'				=>	$roas_simloan_nom,
	'ROAS_SIMLOANLIST_TABLE'			=>	$roas_simloanlist_nom,
	'ROAS_SIMAUDIT_TABLE'				=>	$roas_simaudit_nom,
	'ROAS_SIMAUDITLIST_TABLE'			=>	$roas_simauditlist_nom,
	// Nom des tables BDROAMING
	'ROABD_REQUEST_TABLE'				=>	$roabd_request_nom,
	'ROABD_CHANGE_TABLE'				=>	$roabd_changes_nom,
	'ROABD_INCIDENT_TABLE'      		=>  $roabd_incident_nom,
	'ROABD_INCIDENT_ACTION_TABLE'  		=>  $roabd_incident_action_nom,
	'ROABD_INCIDENT_MISC_TABLE' 		=>  $roabd_incident_misc_nom,
	'ROABD_TEST_REQUEST_TABLE'			=> 	$roabd_test_request_nom,
	'ROABD_TEST_REQUEST_HISTORY_TABLE'	=>	$roabd_test_request_history_nom,
	'ROABD_TEST_INCIDENT_TABLE'			=>	$roabd_test_incident_nom,
	
	
	// Structure des tables ROAMINOO
	'ROA_APP_STRUCTURE'			  			=>  serialize(array(
		$roa_app_nom			  			=>	$roa_app_champs,
	)),
	'ROA_LOG_STRUCTURE'		      			=>	serialize(array(
		$roa_log_nom			  			=>	$roa_log_champs,
	)),
	'ROA_USER_STRUCTURE'		  			=>	serialize(array(
		$roa_user_nom			  			=>	$roa_user_champs,
		$roa_right_nom			  			=>	$roa_right_champs,
		$roa_role_nom			  			=>	$roa_role_champs,
		$roam_filtre_nom 		  			=>  $roam_filtre_champs,
	)),
	'ROA_OPE_STRUCTURE'			  			=>	serialize(array(
		$roa_ope_nom			  			=>	$roa_ope_champs,
		$roa_pays_nom			  			=>	$roa_pays_champs,
	)),
	'ROA_PAYS_STRUCTURE'		  			=>	serialize(array(
		$roa_pays_nom			  			=>	$roa_pays_champs,
	)),
	'ROA_ROLE_STRUCTURE'		  			=>	serialize(array(
		$roa_role_nom 			  			=>  $roa_role_champs,		
	)),
	'ROA_RIGHT_STRUCTURE'		  			=>	serialize(array(
		$roa_right_nom 			  			=>  $roa_right_champs,
		$roa_role_nom 			  			=>  $roa_role_champs,
	)),
	'ROA_OPE_HISTORY_STRUCTURE'	  			=>	serialize(array(
		$roa_ope_history_nom  				=>  $roa_ope_history_champs,
		$roa_ope_nom 		  				=>  $roa_ope_champs,
	)),
	'ROA_OPE_NDC_STRUCTURE'	 	  			=>	serialize(array(
		$roa_ope_ndc_nom 	  				=>  $roa_ope_ndc_champs,
		$roa_ope_nom 		  				=>  $roa_ope_champs,
	)),
	'ROA_SS7_STRUCTURE'	 		  			=>	serialize(array(
		$roa_ss7_nom 		  				=>  $roa_ss7_champs,
		$roa_ope_nom 		  				=>  $roa_ope_champs,
	)),
	'ROA_OPE_GROUP_STRUCTURE'	  			=>	serialize(array(
		$roa_ope_group_nom 	  				=>  $roa_ope_group_champs,
	)),
	'ROA_GROUP_LIST_STRUCTURE'	 			=>	serialize(array(
		$roa_group_list_nom   				=>  $roa_group_list_champs,
		$roa_ope_nom 		  				=>  $roa_ope_champs,
		$roa_ope_group_nom 	  				=>  $roa_ope_group_champs,
	)),	
	// Structure des tables AMORGOS
	'ROAM_ACC_STRUCTURE'		  			=>	serialize(array(
		$roam_acc_nom			  			=>	$roam_acc_champs,
		$roa_user_nom			  			=>	$roa_user_champs,
		$roam_tech_nom 			  			=>  $roam_tech_champs,		
	)),
	'ROAM_TECH_STRUCTURE'		  			=>	serialize(array(
		$roam_tech_nom 			  			=>  $roam_tech_champs,
		$roam_objectif_nom 		  			=>  $roam_objectif_champs,
	)),
	'ROAM_EVENT_STRUCTURE'		  			=>	serialize(array(
		$roam_event_nom 		  			=>  $roam_event_champs,
		$roa_user_nom			  			=>	$roa_user_champs,
	)),
	'ROAM_FILTRE_STRUCTURE'		  			=>	serialize(array(
		$roam_filtre_nom 	 	  			=>  $roam_filtre_champs,
	)),
	'ROAM_OBJECTIF_STRUCTURE'	  			=>	serialize(array(
		$roam_objectif_nom 		  			=>  $roam_objectif_champs,
		$roam_tech_nom 		   	  			=>  $roam_tech_champs,
		$roam_stat_nom 			 			=>  $roam_stat_champs,
	)),
	'ROAM_STAT_STRUCTURE'		  			=>	serialize(array(
		$roam_stat_nom			  			=>  $roam_stat_champs,
	)),
	// Structure des tables SIMCARD
	'ROAS_SIMCARD_STRUCTURE'	  			=>	serialize(array(
		$roas_simcard_nom 		  			=>  $roas_simcard_champs,
		$roa_ope_nom 			  			=>  $roa_ope_champs,
	)),
	'ROAS_SIMSTATUS_STRUCTURE'	  			=>	serialize(array(
		$roas_simstatus_nom 	  			=>  $roas_simstatus_champs,
		$roa_user_nom			  			=>	$roa_user_champs,
	)),
	'ROAS_SIMLOAN_STRUCTURE'	  			=>	serialize(array(
		$roas_simloan_nom 		  			=>  $roas_simloan_champs,		
		$roa_user_nom 			 			=>  $roa_user_champs,		
	)),
	'ROAS_SIMLOANLIST_STRUCTURE'  			=>	serialize(array(
		$roas_simloanlist_nom 	  			=>  $roas_simloanlist_champs,		
	)),
	'ROAS_SIMAUDIT_STRUCTURE'	  			=>	serialize(array(
		$roas_simaudit_nom 		 			=>  $roas_simaudit_champs,		
	)),
	'ROAS_SIMAUDITLIST_STRUCTURE' 			=>	serialize(array(
		$roas_simauditlist_nom 	  			=>  $roas_simauditlist_champs,		
	)),
	// Structure des tables BDROAMING
	'ROABD_REQUEST_STRUCTURE'	  			=>	serialize(array(
		$roabd_request_nom 	 				=>  $roabd_request_champs,
		$roa_user_nom						=>  $roa_user_champs,
		$roa_ope_nom						=>  $roa_ope_champs,		
	)),
	'ROABD_CHANGE_STRUCTURE'	 			=>	serialize(array(
		$roabd_changes_nom    				=>  $roabd_changes_champs,
		$roabd_request_nom 	 				=>  $roabd_request_champs,
	)),
	'ROABD_INCIDENT_STRUCTURE'	 			=>	serialize(array(
		$roabd_incident_nom   				=>  $roabd_incident_champs,
		$roabd_incident_misc_nom  			=>  $roabd_incident_misc_champs,
		$roa_user_nom 			 			=>  $roa_user_champs,
		$roa_ope_nom 						=> 	$roa_ope_champs,
	)),	
	'ROABD_INCIDENT_ACTION_STRUCTURE'		=>	serialize(array(
		$roabd_incident_action_nom  		=>  $roabd_incident_action_champs,
		$roabd_incident_nom  				=>  $roabd_incident_champs,
		$roa_user_nom  						=>  $roa_user_champs,
	)),
	'ROABD_INCIDENT_MISC_STRUCTURE'		=>	serialize(array(
		$roabd_incident_misc_nom 	 		=>  $roabd_incident_misc_champs,
	)),
	'ROABD_TEST_REQUEST_STRUCTURE'			=>	serialize(array(
		$roabd_test_request_nom 			=>  $roabd_test_request_champs,
		$roabd_changes_nom					=>	$roabd_changes_champs,
		$roa_ope_nom 						=> 	$roa_ope_champs,
		$roa_user_nom						=> 	$roa_user_champs,
	)),
	'ROABD_TEST_REQUEST_HISTORY_STRUCTURE'	=>	serialize(array(
		$roabd_test_request_history_nom		=> 	$roabd_test_request_history_champs,
		$roabd_test_request_nom				=> 	$roabd_test_request_champs,
		$roa_user_nom						=> 	$roa_user_champs,
	)),
	'ROABD_TEST_INCIDENT_HISTORY_STRUCTURE'	=>	serialize(array(
		$roabd_test_request_history_nom		=> 	$roabd_test_request_history_champs,
		$roabd_incident_nom					=> 	$roabd_incident_champs,
		$roa_user_nom						=> 	$roa_user_champs,
	)),	
	'ROABD_TEST_INCIDENT_STRUCTURE'			=>	serialize(array(
		$roabd_test_incident_nom			=> 	$roabd_test_incident_champs,
		$roabd_incident_misc_nom			=> 	$roabd_incident_misc_champs,
		$roa_user_nom						=> 	$roa_user_champs,		
		$roa_pays_nom						=>  $roa_pays_champs,
		$roa_ope_nom						=>  $roa_ope_champs,
	)),
	
	
	// Clé primaire des tables
	'ROA_APP_CHAMP_ID'						=>	serialize(array(
		$roa_app_nom						=>	$roa_app_id,
	)),
	'ROA_LOG_CHAMP_ID'						=>	serialize(array(
		$roa_log_nom						=>	$roa_log_id,
	)),
	'ROA_USER_CHAMP_ID'						=>	serialize(array(
		$roa_user_nom						=>	$roa_user_id,
	)),
	'ROA_OPE_CHAMP_ID'						=>	serialize(array(
		$roa_ope_nom						=>	$roa_ope_id,
	)),
	'ROA_PAYS_CHAMP_ID'						=>	serialize(array(
		$roa_pays_nom						=>	$roa_pays_id,
	)),
	'ROA_ROLE_CHAMP_ID'						=>	serialize(array(
		$roa_role_nom						=>	$roa_role_id,
	)),
	'ROA_RIGHT_CHAMP_ID'					=>	serialize(array(
		$roa_right_nom						=>	$roa_right_id,
	)),
	'ROA_OPE_HISTORY_CHAMP_ID'				=>	serialize(array(
		$roa_ope_history_nom				=>	$roa_ope_history_id,
	)),
	'ROA_OPE_NDC_CHAMP_ID'					=>	serialize(array(
		$roa_ope_ndc_nom					=>	$roa_ope_ndc_id,
	)),
	'ROA_SS7_CHAMP_ID'						=>	serialize(array(
		$roa_ss7_nom						=>	$roa_ss7_id,
	)),
	'ROA_OPE_GROUP_CHAMP_ID'				=>	serialize(array(
		$roa_ope_group_nom					=>	$roa_ope_group_id,
	)),
	'ROA_GROUP_LIST_CHAMP_ID'				=>	serialize(array(
		$roa_group_list_nom					=>	$roa_group_list_id,
	)),
	// Clé primaire des tables AMORGOS 
	'ROAM_ACC_CHAMP_ID'						=>	serialize(array(
		$roam_acc_nom						=>	$roam_acc_id,
	)),	
	'ROAM_TECH_CHAMP_ID'					=>	serialize(array(
		$roam_tech_nom						=>	$roam_tech_id,
	)),
	'ROAM_EVENT_CHAMP_ID'					=>	serialize(array(
		$roam_event_nom						=>	$roam_event_id,
	)),
	'ROAM_FILTRE_CHAMP_ID'					=>	serialize(array(
		$roam_filtre_nom					=>	$roam_filtre_id,
	)),
	'ROAM_OBJECTIF_CHAMP_ID'				=>	serialize(array(
		$roam_objectif_nom					=>	$roam_objectif_id,
	)),
	'ROAM_STAT_CHAMP_ID'					=>	serialize(array(
		$roam_stat_nom						=>	$roam_stat_id,
	)),
	'ROAS_SIMCARD_CHAMP_ID'					=>	serialize(array(
		$roas_simcard_nom					=>	$roas_simcard_id,
	)),
	'ROAS_SIMSTATUS_CHAMP_ID'				=>	serialize(array(
		$roas_simstatus_nom					=>	$roas_simstatus_id,
	)),
	'ROAS_SIMLOAN_CHAMP_ID'					=>	serialize(array(
		$roas_simloan_nom					=>	$roas_simloan_id,
	)),
	'ROAS_SIMLOANLIST_CHAMP_ID'				=>	serialize(array(
		$roas_simloanlist_nom				=>	$roas_simloanlist_id,
	)),
	'ROAS_SIMAUDIT_CHAMP_ID'				=>	serialize(array(
		$roas_simaudit_nom					=>	$roas_simaudit_id,
	)),
	'ROAS_SIMAUDITLIST_CHAMP_ID'			=>	serialize(array(
		$roas_simauditlist_nom				=>	$roas_simauditlist_id,
	)),
	// Clé primaire des tables BDROAMING
	'ROABD_REQUEST_CHAMP_ID'				=>	serialize(array(
		$roabd_request_nom					=>	$roabd_request_id,
	)),
	'ROABD_CHANGE_CHAMP_ID'					=>	serialize(array(
		$roabd_changes_nom					=>	$roabd_changes_id,
	)),
	'ROABD_INCIDENT_CHAMP_ID'				=>	serialize(array(
		$roabd_incident_nom					=>	$roabd_incident_id,
	)),
	'ROABD_INCIDENT_ACTION_CHAMP_ID'		=>	serialize(array(
		$roabd_incident_action_nom			=>	$roabd_incident_action_id,
	)),
	'ROABD_INCIDENT_MISC_CHAMP_ID'		=>	serialize(array(
		$roabd_incident_misc_nom		=>	$roabd_incident_misc_id,
	)),
	'ROABD_TEST_REQUEST_CHAMP_ID'			=>	serialize(array(
		$roabd_test_request_nom				=> $roabd_test_request_id,
	)),
	'ROABD_TEST_REQUEST_HISTORY_CHAMP_ID'	=>	serialize(array(
		$roabd_test_request_history_nom		=>	$roabd_test_request_history_id,
	)),
	'ROABD_TEST_INCIDENT_CHAMP_ID'			=>	serialize(array(
			$roabd_test_incident_nom		=>	$roabd_test_incident_id,
	)),
	
	
	// Jointures entre les tables
	'ROA_APP_JOINTURES'					   				=>    serialize(array(
		// Pas de jointure
	)),
	'ROA_LOG_JOINTURES'					   				=>    serialize(array(
		// Pas de jointure
	)),
	'ROA_USER_JOINTURES'				  				=>	 serialize(array(
	  	$roa_user_nom.'.usr_id' 		   				=>    $roa_right_nom.'.rgt_user_id',
	 	$roa_user_nom.'.usr_id' 		   				=>    $roam_filtre_nom.'.fil_usr_id',
	)),
	'ROA_OPE_JOINTURES'					  				=>	 serialize(array(
		$roa_ope_nom.'.ope_pays_id' 	   				=>    $roa_pays_nom.'.pay_id',
	)),
	'ROA_PAYS_JOINTURES'				   				=>	 serialize(array(
	 	// Pas de jointure
	)),
	'ROA_ROLE_JOINTURES'				   				=>	 serialize(array(
		//
	)),
	'ROA_RIGHT_JOINTURES'				   				=>	 serialize(array(
	 	$roa_right_nom.'.rgt_role_id' 	   				=>    $roa_role_nom.'.rol_id',
	 	$roa_right_nom.'.rgt_user_id' 	   				=>    $roa_user_nom.'.usr_id',
	)),
	'ROA_OPE_HISTORY_JOINTURES'			   				=>	 serialize(array(
		$roa_ope_history_nom.'.hst_ope_id' 				=>    $roa_ope_nom.'.ope_id',		
	)),
	'ROA_OPE_NDC_JOINTURES'				   				=>	 serialize(array(
		$roa_ope_ndc_nom.'.ndc_ope_id' 	   				=>    $roa_ope_nom.'.ope_id',
	)),
	'ROA_SS7_JOINTURES'				   	  				=>	 serialize(array(
		$roa_ss7_nom.'.ss7_ope_id' 	   	   				=>    $roa_ope_nom.'.ope_id',
	)),
	'ROA_OPE_GROUP_JOINTURES'			   				=>	 serialize(array(
		// Pas de jointures
	)),
	'ROA_GROUP_LIST_JOINTURES'			   				=>	 serialize(array(
		$roa_group_list_nom.'.grl_ope_id'  				=>    $roa_ope_nom.'.ope_id',
		$roa_group_list_nom.'.grl_ope_id'  				=>    $roa_ope_group_nom.'.grp_id',
	)),
	'ROAM_ACC_JOINTURES'								=>	 serialize(array(
		$roam_acc_nom.'.acc_user_id'	   				=>   $roa_user_nom.'.usr_id',
		$roam_acc_nom.'.acc_tech_id'	    			=>   $roam_tech_nom.'.tec_id',
		$roam_acc_nom.'.acc_ope_id' 	    			=>   $roa_ope_nom.'.ope_id',
	)),
	'ROAM_TECH_JOINTURES'				   				=>	 serialize(array(
		$roam_tech_nom.'.tec_id' 						=>   $roam_objectif_nom.'.obj_tech_id',
	)),
	'ROAM_EVENT_JOINTURES'				  			 	=>	 serialize(array(
		$roam_event_nom.'.evt_user_id' 	   	 			=>   $roa_user_nom.'.usr_id',
	)),
	'ROAM_FILTRE_JOINTURES'				    			=>	 serialize(array(
		// Pas de jointures
	)),
	'ROAM_OBJECTIF_JOINTURES'			    			=>	 serialize(array(
		// Pas de jointures
	)),
	'ROAM_STAT_JOINTURES'				    			=>	 serialize(array(
		$roam_stat_nom.'.sta_id' 		    			=>   $roam_objectif_nom.'.obj_stat_id',
	)),
	'ROAS_SIMCARD_JOINTURES'			    			=>	 serialize(array(
		$roas_simcard_nom.'.sim_ope_id'	   				=>   $roa_ope_nom.'.ope_id',
	)),
	'ROAS_SIMSTATUS_JOINTURES'							=>	 serialize(array(
		$roas_simstatus_nom.'.sta_user_id'  			=>   $roa_user_nom.'.usr_id',
	)),
	'ROAS_SIMLOAN_JOINTURES'							=>	 serialize(array(
		$roas_simloan_nom.'.loa_user_id'    			=>   $roa_user_nom.'.usr_id',
	)),
	'ROAS_SIMLOANLIST_JOINTURES'						=>	 serialize(array(
		// Pas de jointures
	)),
	'ROAS_SIMAUDIT_JOINTURES'							=>	 serialize(array(
		// Pas de jointures
	)),
	'ROAS_SIMAUDITLIST_JOINTURES'						=>	 serialize(array(
		// Pas de jointures
	)),
	'ROABD_REQUEST_JOINTURES'							=>	 serialize(array(
		$roabd_request_nom.'.req_ope_id'				=> 	 $roa_ope_nom.'.ope_id',
		$roabd_request_nom.'.req_user_id'				=> 	 $roa_user_nom.'.usr_id',		
	)),
	'ROABD_CHANGE_JOINTURES'							=>	 serialize(array(
		$roabd_changes_nom.'.cha_request_id'			=>   $roabd_request_nom.'.req_id',
	)),
	'ROABD_INCIDENT_JOINTURES'							=>	 serialize(array(
		$roabd_incident_nom.'.inc_user_id'				=> 	 $roa_user_nom.'.usr_id',
		$roabd_incident_nom.'.inc_ope_id'				=>	 $roa_ope_nom.'.ope_id',
		$roabd_incident_nom.'.inc_source_id'			=>	 $roabd_incident_misc_nom.'.msc_id',
	)),
	'ROABD_INCIDENT_ACTION_JOINTURES'					=>	 serialize(array(
		$roabd_incident_action_nom.'.act_inc_id' 		=> 	 $roabd_incident_nom.'.inc_id',
		$roabd_incident_action_nom.'.act_user_id' 		=> 	 $roa_user_nom.'.usr_id',
	)),
	'ROABD_INCIDENT_MISC_JOINTURES'					=>	 serialize(array(
		// Pas de jointures
	)),
	'ROABD_TEST_REQUEST_JOINTURES'						=>	 serialize(array(
		$roabd_test_request_nom.'.tst_ope_id'			=> 	 $roa_ope_nom.'.ope_id',
		$roabd_test_request_nom.'.tst_cha_id'			=> 	 $roabd_changes_nom.'.cha_id',
		$roabd_test_request_nom.'.tst_user_id'			=> 	 $roa_user_nom.'.usr_id',
	)),
	'ROABD_TEST_REQUEST_HISTORY_JOINTURES'				=>	 serialize(array(
		$roabd_test_request_history_nom.'.thst_test_id'	=> 	 $roabd_test_request_nom.'.tst_id',
		$roabd_test_request_history_nom.'.thst_user_id'	=> 	 $roa_user_nom.'.usr_id',
	)),
	
	'ROABD_TEST_INCIDENT_JOINTURES'						=>	 serialize(array(
		$roabd_test_incident_nom.'.tst_user_id'			=> 	 $roa_user_nom.'.usr_id',
		$roabd_test_incident_nom.'.tst_ope_id'			=> 	 $roa_ope_nom.'.ope_id',
		 // !!!!!! RAJOUTER INCIDENT TYPE !!!!!!		
	)),
	
	'ROABD_TEST_INCIDENT_HISTORY_JOINTURES'				=>	 serialize(array(
		$roabd_test_request_history_nom.'.thst_test_id'	=> 	 $roabd_test_incident_nom.'.tst_id',
		$roabd_test_request_history_nom.'.thst_user_id'	=> 	 $roa_user_nom.'.usr_id',
	)),
	
);

// Mise en constante globale
foreach($global_vars as $key => $value) define($key, $value);
?>