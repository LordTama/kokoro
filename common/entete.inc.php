<?php
	// Commun à toutes les pages - Initialisation de la structure - Header
	$xtpl->assign_file('HEADER', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/header.tpl');
	$xtpl->assign_file('FOOTER', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/footer.tpl');

	// Remplissage des variables de la trame
	$xtpl->assign('slug', TITRE_SITE);
	$xtpl->assign('separateur', '-');
	
	// Feuille de style CSS
	$xtpl->assign('chemin_css', BASE_REP.TEMPLATEDIR.$_SESSION['template'].'/'.CSSDIR.'style.css');
	$xtpl->parse('main.css');

	// Liens divers
	$xtpl->assign('logo_path', BASE_REP.IMG_GEN.'logo_orange.gif');
	$xtpl->assign('workflow_path', URL.APPSDIR.APPAMORGOS.'?action=workflow&id=');
	$xtpl->assign('img_path', BASE_REP.TEMPLATEDIR.$_SESSION['template'].'/'.IMG_GEN);
	$xtpl->assign('admin_link', URL.APPSDIR.APPAMORGOS.ADMIN);
	$xtpl->assign('ajouter_accord_link', URL.APPSDIR.APPAMORGOS.'?action=ajouterAccord');
	$xtpl->assign('account_page', URL.PROFIL_PAGE);
	$xtpl->assign('js_path', BASE_REP.JAVASCRIPTDIR);
	$xtpl->assign('graph_path', BASE_REP.APPSDIR.APPAMORGOS);
	$xtpl->assign('css_path', BASE_REP.TEMPLATEDIR.$_SESSION['template'].'/'.CSSDIR);
	$xtpl->assign('amorgon_link', URL.APPSDIR.APPAMORGOS);
	$xtpl->assign('pra_link', URL.APPSDIR.APPPRA);
	$xtpl->assign('simcards_link', URL.APPSDIR.APPSIMCARD);
	$xtpl->assign('bdroaming_link', URL.APPSDIR.APPBDROAMING);
	$xtpl->assign('img_sort_asc', URL.TEMPLATEDIR.$_SESSION['template'].'/'.IMG_GEN.'tri_asc.gif');
	$xtpl->assign('img_sort_desc', URL.TEMPLATEDIR.$_SESSION['template'].'/'.IMG_GEN.'tri_desc.gif');

	/*********************************************
	********** Elements de menu : SimCards ***********
	**********************************************/
	$xtpl->assign('simcard_pret_link', URL.APPSDIR.APPSIMCARD. '?action=lend');
	$xtpl->assign('simcard_classeur_link', URL.APPSDIR.APPSIMCARD. '?action=classeurPerso');
	$xtpl->assign('simcard_audit_link', URL.APPSDIR.APPSIMCARD. '?action=audit');
	$xtpl->assign('simcard_stats_link', URL.APPSDIR.APPSIMCARD. '?action=stats');
?>