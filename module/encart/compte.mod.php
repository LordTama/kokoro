<?php
$langue = new Langue();
$langue->load('compte.mod.php');

if($_SESSION['usr_id'] == 0) {
	$xtpl->assign_file('CONTENT', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/login.tpl');
	$xtpl->assign_langue($langue);
}
else {
	$User = new User($db);
	$User->usr_id = $_SESSION['usr_id'];
	$User->getUser();
	
	$xtpl->assign('logout', URL.LOGOUT_PAGE);
	$xtpl->assign('profile_link', BASE_REP.PROFIL_PAGE);
	$xtpl->assign_file('USER_BAR', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/welcome.tpl');

	$xtpl->assign('prenom', $User->usr_first_name);
	$xtpl->assign('login', $User->usr_login);
	$xtpl->assign('usr_initiales', $User->usr_init);
	$xtpl->assign('now_date',  date('d/m/Y'));
	$xtpl->assign('home_link', BASE_REP);
	$xtpl->assign('stats_link', BASE_REP.APPSDIR.APPAMORGOS.'statistiques.php');
	
	$xtpl->assign_langue($langue);
	
	if(isset($_GET['evt'])){
		switch($_GET['evt']) {
			case 'interdit' :
			{
				$xtpl->parse('main.interdit');
			}
			break;
		}
	}
	
	/* Gestion des rôles et droits utilisateur 
	** @param 1 - int : id du rôle
	** @param 2 - int : id de l'application
	** @param 3 - string : slug du rôle
	** @param 4 - string : description du rôle
	*/
	$_SESSION['userObject'] = $User;
	$Utilisateur = $_SESSION['userObject'];
	
	// A déporter dans le login
	$Right = new Right($db);
	$Right->rgt_user_id = $_SESSION['usr_id'];

	$Right->order('roaminoo_role.rol_app_id', false);
	$listeRights = $Right->listeRights();
	
	$droits = array();	
	
	foreach($listeRights as $key => $right) {
		if(isset($tmp)) {
			if($tmp->rol_app_id == $right->rol_app_id) 
				array_push($droits[$right->rol_app_id], $right);
			else 
				$droits[$right->rol_app_id] = array($right);
		}
		else 
			$droits[$right->rol_app_id] = array($right);
		$tmp = $right;
	}
	/* L'adresse doit matcher avec le masque */
	/*	if( ! preg_match('`^/roaminoo/apps/amorgos/|^/roaminoo/$|^/roaminoo/\?evt=interdit$`', $_SERVER['REQUEST_URI']) ) {
	redirige(URL,'evt=interdit');
	} */
	
	if(preg_match('`^' . BASE_REP . 'apps/amorgos/`', $_SERVER['REQUEST_URI'])){
		$appli = 1;
	}
	else if(preg_match('`^' . BASE_REP . 'apps/pra/`', $_SERVER['REQUEST_URI'])){			
		$appli = 4;	
	}
	else if(preg_match('`^' . BASE_REP . 'apps/simcard/`', $_SERVER['REQUEST_URI'])){
		$appli = 2;
	}
	else if(preg_match('`^' . BASE_REP . 'apps/bdroaming/`', $_SERVER['REQUEST_URI'])){
		$appli = 3;
	}
	else {
		$appli = 0;
	}
	switch($appli) {
		// Dans AMORGOS
		case 1:
		{
			if(isset($droits[1])) {
				
				foreach($droits[1] as $role) {
					
					if($role->rol_slug == 'mod_ireg') {
						// Ajout d'accords
						$addAccord = false;
						$editAccord = true;
						$ireg = true;
						$deleteAccord = false;
						
						// Workflow
						$droitsWorkflow = true;
						
						// Liste des accords
						
						// $xtpl->parse('main.ajouterAccord');
					}
					else if($role->rol_slug == 'mod_pilote') {
						// Ajout d'accords
						$addAccord = true;
						$editAccord = true;
						$deleteAccord = true;
						$droitsWorkflow = true;
						
						// Barre d'outils
						$xtpl->parse('main.HEADER.ADD_ACCORD');
					}
					else if($role->rol_slug == 'mod_view') {
						// Ajout d'accords
						$addAccord = false;
						$editAccord = false;
						$deleteAccord = false;												
						$droitsWorkflow = false;
					}
				}
				// Titre de page
				$xtpl->parse('main.HEADER.AMORGOS_TITLE');
			}
			else {
				redirige(URL.'?evt=interdit');
			}
		}
		break;
		// BDRoaming
		case 3:
		{
			// Titre de page
			$xtpl->parse('main.HEADER.BDROAMING_TITLE');
			
			if(isset($_POST['pays']) && isset($_POST['ope']) && !empty($_POST['ope'][0])) {
				$_SESSION['country'] = $_POST['pays'][0];
				$_SESSION['operator'] = $_POST['ope'][0];
				
				redirige(URL.APPSDIR.APPBDROAMING.'?action=ir21&operator='.$_SESSION['operator']);
			}			
			else if(isset($_POST['pays']) && isset($_POST['ope']) && empty($_POST['ope'][0])) {
				$_SESSION['country'] = $_POST['pays'][0];
				unset($_SESSION['operator']);
			}
			
			// Lecture du fichier pays et opérateur en cache
			$fichierPays = fopen(DOCROOT.DATADIR.'pays.php', 'r');
			$fichierE212 = fopen(DOCROOT.DATADIR.'OpeAddAccord.php', 'r');
			$filtrePays = unserialize(fgets($fichierPays));
			$filtreE212 = unserialize(fgets($fichierE212));
			fclose($fichierPays);
			fclose($fichierE212);
			
			// Construction des champs <select> de type Pays
			foreach($filtrePays as $pay_id => $pay_name_fr) {
				if((isset($_SESSION['country']) && ($_SESSION['country'] == $pay_id)) || (isset($_POST['pays']) && ($_POST['pays'][0] == $pay_id))) $xtpl->assign('select_pays', 'selected');
				else $xtpl->assign('select_pays', '');
				
				$xtpl->assign('pays_name_fr', $pay_name_fr);
				$xtpl->assign('pays_id', $pay_id);
				$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.paysListe');
				$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.paysListe1');
			}
			
			if(isset($_POST['bt_choose_operator']) || isset($_SESSION['operator'])) {
				$operatorExist = 0;
				foreach($filtreE212 as $ope_id => $e212) {					
					if((isset($_POST['pays']) && ($_POST['pays'][0] == $e212[1])) || (isset($_SESSION['country']) && ($_SESSION['country'] == $e212[1]))) {
						if((isset($_POST['ope']) && $_POST['ope'][0] == $ope_id) || (isset($_SESSION['operator']) && $_SESSION['operator'] == $ope_id)) {
							$xtpl->assign('select_ope', 'selected');
							$operatorExist++;
						}
						else $xtpl->assign('select_ope', '');
							
						$xtpl->assign('ope_name', $e212[0]);
						$xtpl->assign('ope_id', $ope_id);
						$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.e212Liste');
					}
				}
			}
			
			if(isset($_GET['operator'])) $xtpl->assign('operator_id', $_GET['operator']);
			if(isset($_SESSION['operator'])) $xtpl->assign('operator_id', $_SESSION['operator']);
			
			
				
			
			if(isset($_GET['action']) && $_GET['action'] != 'ir21') {
				$xtpl->assign('filter_form_id', 'formMainFilter');
			}
			else {
				$xtpl->assign('filter_form_id', 'formMainFilterIR21');
			}
			
			// Gestion des barre d'outils par fonctionnalité
			if(isset($_GET['action']) && $_GET['action'] == 'ir21') 
				$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.IR21_TOOLBAR');
			else if((isset($_GET['action']) && $_GET['action'] == 'modifications') || (isset($_GET['action']) && $_GET['action'] == 'tests'))
				$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.MODIFICATIONS_TOOLBAR');
			else if(isset($_GET['action']) && $_GET['action'] == 'incidents')
				$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS.INCIDENTS_TOOLBAR');
			
			// Barre d'outils secondaires
			$xtpl->parse('main.HEADER.BDROAMING_EXTRA_TOOLS');			
			// Barre d'outils principale (éléments de menu)
			$xtpl->parse('main.HEADER.BDROAMING_TOOLBAR');
		}
		break;
		case 4:
		{
			if($droits[4] != NULL) {
				$xtpl->parse('main.HEADER.PRA_TITLE');
				$xtpl->parse('main.HEADER.PRA_TOOLBAR');
			}
			else {
				redirige(URL.'?evt=interdit');
			}
		}
		break;
		case 2:
		{			
			if($droits[2] != NULL) {
				$xtpl->assign('workflow_simcard_path', URL.APPSDIR.APPSIMCARD.'?action=workflow&id=');
				$xtpl->parse('main.HEADER.SIMCARDS_TITLE');
				$xtpl->parse('main.HEADER.SIMCARDS_TOOLBAR');
			}
			else {
				redirige(URL.'?evt=interdit');
			}
		}
		break;
	}
	/* -- Fin de la gestion des rôles -- */
	$xtpl->parse('main.USER_BAR');
}
?>