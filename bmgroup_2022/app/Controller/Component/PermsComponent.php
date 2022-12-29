<?php
class PermsComponent extends CakeObject {
	var $modal = true;
	var $Controller;
	var $conf;
	var $isApi = false;

	function initialize(Controller $controller) {
		$this->Controller =& $controller;
		$this->loadConf();
		App::import("Core", "CakeSession");
		$this->Session = new CakeSession;
	}
	
	private function loadConf() {
		Configure::load('perms');
		$this->conf = Configure::read('perms');
	}

	private function checkFeatures($code) {
		return true;
		$codes = $this->Session->read("Features");
		if (!$codes) {
			return false;
		}
		return in_array($code, $codes);
	}
	
	function beforeRedirect() {

	}

	function startup() {
		return true;
	}

	function beforeRender() {

	}

	function shutdown() {

	}

	function getOperationsList() {
		Configure::load('perms');
		$conf = Configure::read('perms');
		$list = array();

		foreach ($conf['rules'] as $label => $sections) {
			foreach ($sections as $key => $attrs) {
				if(!empty($attrs['label']))
					$list[$label][$key] = $attrs['label'];
			}
		}

		return $list;
	}

	function getSUOperationsList() {
		return array();
		
		Configure::load('perms');
		$conf = Configure::read('superperms');
		$list = array();

		foreach ($conf['rules'] as $label => $sections) {
			foreach ($sections as $key => $attrs) {
				if(!empty($attrs['label']))
					$list[$label][$key] = $attrs['label'];
			}
		}

		return $list;
	}

	function isSU() {
		if (!isset($this->Session)) {
			App::import("Core", "CakeSession");
			$Session = new CakeSession;
		}

		$this->Session = new CakeSession;
		if(empty($this->Session->read('User.id')))
			return false;

		$perms = unserialize($this->Session->read('Group.perms'));

		return $this->Session->read('Company.full') || @preg_grep('/su([A-Z].*)/',$perms) == true;
	}
	
	function check($modal = true, $options = array()) {
		$cache = false;

		if (!isset($this->Session)) {
			App::import("Core", "CakeSession");
			$this->Session = new CakeSession;
		}
		
		$controller = $this->Controller;
		$this->modal = $modal;
		$group = $this->Session->read("Group");
		$group['full'] = isset($group['full']) ? $group['full'] : false;
		
		$cname = !empty($options['controller']) ? $options['controller'] : strtolower($controller->name);
		$caction = !empty($options['action']) ? $options['action'] : strtolower($controller->action);
		// Controladores de único acceso para Super Administrador Global
		/*$superCname = array(
			'companies',
			'periods',
			'cycles',
			'pes',
			'sets',
			'cards'
		);

		if(in_array($cname, $superCname)) { // Super Administrador Global
			$perms = $group['full'] ? $this->getAllTags() : (!empty($group['perms']) ? unserialize($group['perms']) : array());
			$rules = $this->sintetizedRules();
			$fullCompany = false;
			foreach ($perms as $pk) {
				if(isset($rules[$pk][$cname])) {
					if (in_array($caction, $rules[$pk]['allow'][$cname]) && $this->Session->read("Company.full")) {
						$fullCompany = true;
					}
				}
			}
			$fullCompany = $this->Session->read("Company.full") && $group['full'] ? true : $fullCompany;
			if($modal)
				return $fullCompany ? $fullCompany : $this->defaultAction();
			else
				return $fullCompany;
			//return $this->Session->read("Company.full") && $perms[? true : $this->defaultAction();
		}*/

		$this->isApi = strpos($caction,"api_") !== false ? true : false;

		$expired = !empty($_SESSION['globals']['package']) && $_SESSION['globals']['package'] == 'expired';

		if($cname=='cakeerror') {
			return true;
		}
		if ($expired && !($cname == 'users' && $caction == 'logout') && !($cname == 'users' && $caction == 'login') && !($cname == 'users' && $caction == 'admintest')) {
			$result = $modal ? $this->defaultAction() : false;
			$_SESSION['cache']['perms'][$cname][$caction] = $result;
			return $result;
		} /*else {
			return true;
		}*/
	
		if(!empty($_SESSION['pack'])){
			// die('ss');
			if (!empty($group['full']) && !empty($_SESSION['pack']['full'])) return true;
		}
		
		$rules = $this->sintetizedRules();

		if ($cache && isset($_SESSION['cache']['perms'][$cname][$caction])) {
			if (!$modal) {
				return $_SESSION['cache']['perms'][$cname][$caction];
			}
			else {
				if (!$_SESSION['cache']['perms'][$cname][$caction]) {
					if(!$this->isApi) {
						$this->Controller->redirect(array('controller'=>'pages', 'action'=>'index'));
					} else {
						echo json_encode(array(
							'code' => '401',
							'status' => 'error',
							'message' => __('Unauthorized', true)
						));
						die();
					}
				}
			}
		}
		
		$perms = !empty($group['full']) && boolval($group['full'])===true ? $this->getAllTags() : (!empty($group['perms']) ? unserialize($group['perms']) : array());
		$perms[] = $this->Session->read("User.id") === null ? 'unlogged' : 'logged';

		/*if($this->isSU()) {
			$rules += $this->sintetizedSURules();
			if($group['full'])
				$perms = $this->getAllSUTags();
		}*/

		// if (!$modal) {
		// 	echo "controller=$cname<br />action=$caction<br />";
		// 	print_r($perms);
		// 	print_r($rules);
		// 	die();
		// }
		// echo "[$cname]"; die();
                // return $perms;
		
		$this->log($cname . "->" . $caction, "perms");
		
		$prefix = $cname . "->" . $caction . " = ";
		
		// echo "$cname\n";
		// print_r($rules);
		// die($prefix);
		// print_r($perms); die();
	
		//print_r($rules); die();
		
		$rulesFound = 0;

		foreach ($perms as $pk) {
			// echo "Chequeando $pk\n";
			if (isset($rules[$pk]['allow'][$cname])) {
				// print_r($rules[$pk]);
				// print_r($rules[$pk]['packs']);
				// echo "\ncname=$cname\n";
				//die('ssss');
				
				if (in_array($caction, $rules[$pk]['allow'][$cname])) {
					// die('hola');
					// print_r($rules); die();
					$this->log($prefix . "$pk = " . serialize($rules[$pk]['allow'][$cname]), "perms");

					if(!empty($_SESSION['globals']))
						$this->log("package=".$_SESSION['globals']['package'], 'perms');
					
					$rulesFound++;
					
					// die('holamanolas');
					
					// Se verifica que la función esté habilitada para el paquete
					if (empty($rules[$pk]['packs']) || in_array($_SESSION['globals']['package'], $rules[$pk]['packs'])) {
						// die('sss');
						$_SESSION['cache']['perms'][$cname][$caction] = true;
						return true;
					}
					else {
						// die('No paquete');
						// return false;
					}
				}
				else {
					// die('joda');
					// print_r($rules); die();
					$this->log("$prefix It is not set", "perms");
					foreach ($rules[$pk]['allow'][$cname] as $act) {
						if (strpos($act, "*") !== false || strpos($act, "+") !== false) {
							// print_r($rules[$pk]['allow'][$cname]); die('IS REGEX');
							// die("act=$act matches=$caction");
							if (preg_match("#$act#", $caction, $matches, PREG_OFFSET_CAPTURE)) {
								// die("matches");
								$this->log("$prefix $pk Matches: $act", "perms");
								// print_r($rules[$pk][$cname]); die();
								$_SESSION['cache']['perms'][$cname][$caction] = true;
								// Se verifica que la función esté habilitada para el paquete
								//print_r($rules[$pk]); die();
								if (empty($rules[$pk]['packs']) || in_array($_SESSION['globals']['package'], $rules[$pk]['packs'])) {
									$_SESSION['cache']['perms'][$cname][$caction] = true;
									return true;
								}
								$rulesFound++;
							}
							else {
								// die("not matches");
							}
						}
						else {
							$this->log("$prefix $pk $act NOT A REGEX", "perms");
						}
					}
				}
			}
			else {
				// No hay regla para el controller
				// echo "No hay reglas para el controller ($pk -> $cname)<br />";
				// print_r($rules);
				// die();
			}
		}
		
		// Si se encontraron reglas y llegó hasta aquí, implica que las funciones
		// no estaban habilitadas para el paquete
		if ($group['full'] && $rulesFound == 0) {
			$_SESSION['cache']['perms'][$cname][$caction] = true;
			return true;
		}
		
		// die('sssssssxxxxxx');
		
		// Si el usuario esta loggeado, se verifica los permisos
		// genéricos
		if ($this->Session->read("User.id") !== null) {
			
		}
		else {
			// Si el usuario no está loggeado, se verifican
			// los permisos genéricos para usuarios no loggeados
			
		}
		
		$result = $modal ? $this->defaultAction() : false;
		$_SESSION['cache']['perms'][$cname][$caction] = $result;

		return $result;
	}
	
	function sintetizedRules() {
		// if (!$this->modal) {
		// 	print_r($this->conf);
		// } 
		if (empty($this->conf)) {
			$this->loadConf();
		}
		$list = array();
		$rules = $this->conf['rules'];
		if (!empty($rules)) {
			foreach ($rules as $label => $perm) {
				foreach ($perm as $key => $value) {
					$list[$key]['allow'] = !empty($value['allow'])?$value['allow']:array();
					$list[$key]['packs'] = !empty($value['packs'])?$value['packs']:array();
				}
			}
		}
		if (!empty($this->conf['default']['rules']))
			$list += $this->conf['default']['rules'];
		// print_r($list); die();
		return $list;
	}

	function sintetizedSURules() {
		// if (!$this->modal) {
		// 	print_r($this->conf);
		// } 
		Configure::load('perms');

		$list = array();
 		// $rules = Configure::read('superperms.rules');
 		$rules = Configure::read('perms.rules');
 		//print_r($rules); die();
		if (!empty($rules)) {
			foreach ($rules as $label => $perm) {
				foreach ($perm as $key => $value) {
					$list[$key]['allow'] = !empty($value['allow'])?$value['allow']:array();
					$list[$key]['packs'] = !empty($value['packs'])?$value['packs']:array();
				}
			}
		}

		return $list;
	}
	
	private function defaultAction() {
		if(!$this->isApi) {
			if ($this->Session->read("User.id") !== null) {
				$this->Controller->setFlash("Access denied", "error");
				if (!empty($_SERVER['HTTP_REFERER'])) {
					if (strpos( $_SERVER['HTTP_REFERER'], '?' ) === false) {
						header('Location:'.$_SERVER['HTTP_REFERER'].'?fm=Access denied');
					}
					else {
						header('Location:'.$_SERVER['HTTP_REFERER'].'&fm=Access denied');
					}
				}
				else {
					$this->Controller->redirect($this->conf['default']['redirectOnLogged']);
				}
			}
			else {
				$this->Controller->redirect($this->conf['default']['redirectOnUnlogged']);
			}
		} else {
			echo json_encode(array(
				'code' => '401',
				'status' => 'error',
				'message' => __('Unauthorized', true)
			));
			die();
		}
	}
	
	function checkTag($tag) {
		App::import("Core", "CakeSession");
		$this->Session = new CakeSession;

		$user = $this->Session->read("User");
		$user['Group'] = $this->Session->read("Group");
		if (!empty($user['Group']['full']))
			return true;
		
		if (!empty($user['Group']['perms'])) {
			if (!is_array($user['Group']['perms'])) {
				$user['Group']['perms'] = unserialize($user['Group']['perms']);
			}
			return in_array($tag, $user['Group']['perms']);
		}
		return false;
	}
	
	function getAllTags() {
		// $tags = array();
		$rules = $this->sintetizedRules();
		// print_r($rules); die();
		return array_keys($rules);
	}

	function getAllSUTags() {
		// $tags = array();
		$rules = $this->sintetizedSURules();
		// print_r($rules); die();
		return array_keys($rules);
	}

	function debug($data) {
		echo "<pre>".print_r($data, true)."</pre>";
	}
	
}
?>
