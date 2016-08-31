<?php
if($nb_resultats > 0) {
	for($i=$page_en_cours; $i<=$page_en_cours+4; $i++) {
		if($i <= $nb_pages) {
			if ($i == $page_en_cours){
				$xtpl->assign('class_page_en_cours', 'enCours');
			}
			else {
				$xtpl->assign('class_page_en_cours', '');
			}
			// if isset i+4
			$xtpl->assign('numero_page', $i);
			$xtpl->parse($xtpl_parse.'.gestion_page.page');
		}			
	}
	
	for($i=5; $i<=50; $i=$i+5) {
		$xtpl->assign('nb_par_page', $i);
		if($i == $nb_par_page) $xtpl->assign('select_nb_par_page', 'selected="selected"');
		else $xtpl->assign('select_nb_par_page', '');
		
		$xtpl->parse($xtpl_parse.'.gestion_page.nb_par_page');
	}
	


	if($page_en_cours - 1 < 1) $page_prec = 1;
	else $page_prec = $page_en_cours - 1;
	if($page_en_cours + 1 > $nb_pages) $page_suiv = $nb_pages;
	else $page_suiv = $page_en_cours + 1;
	
	$xtpl->assign('page_en_cours', $page_en_cours);
	$xtpl->assign('numero_page_precedent', $page_prec);
	$xtpl->assign('numero_page_suivant', $page_suiv);
	$xtpl->assign('numero_page_fin', $nb_pages);
	
	$xtpl->assign('colspan', $nb_pages);
	
	$xtpl->assign('nb_enregistrement', $nb_resultats);
	$xtpl->assign('numero_debut', (($page_en_cours - 1) * $nb_par_page) + 1);
	
	if(($page_en_cours * $nb_par_page) > $nb_resultats) $xtpl->assign('numero_fin', $nb_resultats);
	else $xtpl->assign('numero_fin', $page_en_cours * $nb_par_page);
	
	if($_SERVER['QUERY_STRING'] != '') {
		foreach(explode('&', $_SERVER['QUERY_STRING']) as $param_string) {
			list($param_name, $param_value) = explode('=', $param_string);
			if($param_name != 'page' && $param_name != 'nb_par_page') {
				$xtpl->assign('page_param_name', urldecode($param_name));
				$xtpl->assign('page_param_value', urldecode($param_value));
				
				$xtpl->parse($xtpl_parse.'.gestion_page.page_param'); 
			}
		}
	}
}
$xtpl->parse($xtpl_parse.'.gestion_page');
?>