<?php
$langue = new Langue();
$langue->load('landing.mod.php');
$xtpl->assign_langue($langue);

$xtpl->assign_file('CONTENT', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/'.FRAMES.'/appListe.tpl');
$xtpl->assign_file('RIGHT_TOOLBAR', DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/'.FRAMES.'/right_toolbar.tpl');
if(!isset($_GET['action'])) $_GET['action'] = '';

switch($_GET['action']) {
	default:
	case 'liste':
	{
		$App = new App($db);		
		
		if(isset($_GET['evt']) && $_GET['evt'] == 'interdit') {
			$xtpl->assign('message_interdit', $langue->get('forbid_message'));
			$xtpl->parse('main.FORBIDDEN');
		}
		
		$listeApps = $App->listeApps();
		$xtpl->assign('apps_path', BASE_REP.APPSDIR);

		$i=0;
		foreach($listeApps as $value) {
			$i++;
			$xtpl->assign('app_name', $value->app_name);
			$xtpl->assign('app_description', $value->app_description);
			$xtpl->assign('app_version', $value->app_version);
			$xtpl->assign('app_dir', $value->app_dir);
			
			// Dernier élément
			if($i == 2) {
				$xtpl->parse('main.appListe.appDetails.APPS_LAST_MODIFICATIONS');
			}
			
			// On parse le bloc appListe dans appListe.tpl
			$xtpl->parse('main.appListe.appDetails');
			
			// Tous les x mod 2, on parse
			if($i%2 ==0) {				
				$xtpl->parse('main.appListe');
			}
		}

		$xtpl->parse('main.liste');
	}
	break;
}
?>