<?php
class User extends AppModel {

	var $name = 'User';
	var $displayField = 'nombre_completo';

	var $validate = array(
		'user' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Este campo no puede dejarse vacío'
			),
			'checkUser' => array(
				'on' => 'create',
				'rule' => 'checkUser',
				'message' => 'Este usuario ya ha sido utilizado'
			)
		),
		//'nombres' => array('notBlank'),
		//'apellidos' => array('notBlank'),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Este campo no puede dejarse vacío'
			),
			'checkEmail' => array(
				// 'on' => 'create',
				'rule' => 'checkEmail',
				'message' => 'Este email ya ha sido utilizado'
			)
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['nombre_completo'] = 'CONCAT('.$this->alias.'.nombres, " ", '.$this->alias.'.apellidos)';
	}

	function setConditions() {
		$conditions = array();
		
		if(!empty($_GET['company'])) {
			$conditions[$this->alias.'.company_id'] = $_GET['company'];
		}

		if(!empty($_GET['group'])) {
			$conditions[$this->alias.'.group_id'] = $_GET['group'];
		}

		return $conditions;
	}

	function setColumns() {
		if(!empty($_GET['columns'])) {
			foreach($_GET['columns'] as $column => $fields) {
				foreach($fields as $field) {
					$queryData[] = "{$column}.{$field}";	
				}
			}
		}
		return $queryData;
	}

	function checkEmail() {
		if(!empty($this->data['User']['email'])) {
			$conditions = array(
					'User.email' => $this->data['User']['email']
				);
			if(!empty($this->data['User']['id'])) {
				$conditions['not'] = array(
					'User.id' => $this->data['User']['id']
				);
			}
			// $this->debug($conditions); die();

			$user = $this->find('first', array(
				'conditions' => $conditions
			));
			if(!empty($user)) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	function checkUser() {
		if(!empty($this->data['User']['user'])) {
			$user = $this->find('first', array(
				'conditions' => array(
					'User.user' => $this->data['User']['user']
				)
			));
			if(!empty($user)) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}


	function beforeSave($options = array()) {
		if (!class_exists('CakeSession'))
			App::import('Core', 'Session');
		$session = new CakeSession;



		if(!$session->read('Company.full') && !empty($session->read('Company.id')))
			$this->data['User']['company_id'] = $session->read('Company.id');

		if(empty($this->data['User']['avatar']['name'])) {
			unset($this->data['User']['avatar']);
		}


		if(!empty($_FILES) && !empty($this->data['User']['avatar'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['User']['avatar']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['User']['avatar'], $fileDest) ) {
				App::import('Component', 'Image');
				$image = new ImageComponent;
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_".$file, 40, 40);
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_big_".$file, 120, 120);
				$this->data['User']['avatar'] = $file;
				if($session->read('User.id') == $this->data['User']['id']) {
					$session->write('User.avatar', $file);
				}
			}
		}

		if(!empty($this->data['User']['password'])) {
			if(empty($this->data['User']['salt']))
				$this->data['User']['salt'] = md5(uniqid());
			
			$this->data['User']['password'] = md5($this->data['User']['password'].$this->data['User']['salt']);
		} else {
			unset($this->data['User']['password']);
		}



		//if(empty($this->data['User']['group_id'])) {
		//	$defaultGroup = $this->Group->find('first', array('conditions'=>array('Group.default'=>true)));
		//	$this->data['User']['group_id'] = $defaultGroup['Group']['id'];
		//}

		return parent::beforeSave($options);
	}

	function defaultGroup() {
		$group = $this->Group->find('first', array(
			'conditions' => array(
				'Group.default' => 1
			)
		));

		return $group;
	}

	function findByEmail($email) {
		return $this->find('first', array(
			'recursive' => -1,
			'fields' => array(
				'User.id',
				'User.email',
				'User.nombres',
				'User.apellidos'
			),
			'conditions' => array(
				'User.email' => $email
			)
		));
	}

	function findById($id) {
		return $this->find('first', array(
			'recursive' => -1,
			'fields' => array(
				'User.id',
				'User.email',
				'User.nombres',
				'User.apellidos'
			),
			'conditions' => array(
				'User.id' => $id
			)
		));
	}
}
?>