<?php
/**
* Classe gérant les utilisateurs de l'application
* Contient les méthodes indispensables de vérification d'identité
*/

class User extends Objet {
	function __construct($db) {
		parent::__construct($db, array_merge(unserialize(KOK_USER_STRUCTURE), unserialize(KOK_RIGHT_STRUCTURE), unserialize(KOK_ROLE_STRUCTURE)), array_merge(unserialize(KOK_USER_CHAMP_ID), unserialize(KOK_RIGHT_CHAMP_ID), unserialize(KOK_ROLE_CHAMP_ID)));
		
		foreach(unserialize(KOK_USER_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		foreach(unserialize(KOK_RIGHT_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		foreach(unserialize(KOK_ROLE_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		
		$this->langue->load('user.class.php');
	}
	
	function connect($login, $pass, $remember = '') {
		$this->usr_login = $login;
		if($this->getUser()) {
			if($this->usr_passwd == md5($pass)) {
				// if($this->usr_etat == 'actif') {
					$_SESSION['usr_id'] = $this->usr_id;
					$_SESSION['usr_login'] = $this->usr_login;
					$_SESSION['usr_first_name'] = $this->usr_first_name;
					
					if($remember == 'yes') {
						setcookie('login', $login, time()+TEMPS_COOKIE_CONNEXION, '/');
						setcookie('password', $pass, time()+TEMPS_COOKIE_CONNEXION, '/');
					}
					
					if(isset($_SESSION['after_login'])) {
						$url = $_SESSION['after_login'];
						unset($_SESSION['after_login']);
						redirige($url);
					}
					else return true;
				}
				// else {
					// $this->addMessage(MSG_INFO, $this->langue->get('inactif_user'));
					// return false;
				// }
			// }
			else {
				$this->addMessage(MSG_INFO, $this->langue->get('invalid_user_pass'));
				return false;
			}
		}
		else {
			$this->addMessage(MSG_INFO, $this->langue->get('invalid_user_pass'));
			return false;
		}
	}
	
	function logout() {
		if(isset($_COOKIE['login'])) setcookie('login', '', time()-TEMPS_COOKIE_CONNEXION, '/');
		if(isset($_COOKIE['password'])) setcookie('password', '', time()-TEMPS_COOKIE_CONNEXION, '/');
		
		unset($_SESSION);
		session_destroy();
		
		redirige(FICHE_PAGE);
	}
	
	/**
	* Contrôle des autorisations d'accès aux pages
	* Version "light"	
	*/
	function checkAccess() {
		$page = substr($_SERVER['SCRIPT_FILENAME'], strlen(DOCROOT));
		
		if ($page != 'login.php' && $page != 'config.php' && $this->usr_id == 0) return false;
		else return true;
	}
	
	/**
	* Contrôle des données avant insertion ou mise à jour
	*/
	function checkInfo($type) {
		$ok = true;
		
		switch($type) {
			case 'ajout_user':
			{
				if(isset($this->usr_passwd)) {
					$this->usr_passwd = $this->usr_passwd;
				}
				
				if(empty($this->usr_passwd)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_pass_empty'));
					$ok = false;
				}
				
				if(empty($this->usr_name)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_name_empty'));
					$ok = false;
				}
				
				if(empty($this->usr_first_name)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_first_name_empty'));
					$ok = false;
				}
				
				if(empty($this->usr_mail)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_mail_empty'));
					$ok = false;
				}
				
				if(empty($this->usr_init)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_init_empty'));
					$ok = false;
				}				
				if(empty($this->usr_login)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('usr_login_empty'));
					$ok = false;
				}				
			}
			case 'modif_user':
			{
				if(isset($this->usr_passwd) && (strlen(trim($this->usr_passwd)) > 32)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_usr_pass'));
					$ok = false;
				}
				if(isset($this->usr_passwd)) {
					$this->usr_passwd = md5($this->usr_passwd);
				}
			}
			break;
		}		
		return $ok;
	}
	
	function listeUser($page = NULL, $record = NULL) { return Objet::liste($page, $record, array(ROA_USER_TABLE, ROA_RIGHT_TABLE, ROA_ROLE_TABLE)); }
	function listeUserSimple($page = NULL, $record = NULL) { return Objet::liste($page, $record, array(ROA_USER_TABLE)); }
	
	function getUser() { return Objet::fill(array(ROA_USER_TABLE, ROA_RIGHT_TABLE, ROA_ROLE_TABLE)); }
	function getSimpleUser() { return Objet::fill(ROA_USER_TABLE); }
	function addUser() { return ($this->checkInfo('ajout_user') && Objet::insert(ROA_USER_TABLE)); }
	function mdfUser() { return ($this->checkInfo('modif_user') && Objet::update(ROA_USER_TABLE)); }
	function delUser() { return Objet::delete(ROA_USER_TABLE); }
}
?>