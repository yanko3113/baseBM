<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Company $Company
 */
class Service extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function beforeSave($options = array()) {
		if(empty($this->data['Service']['image']['name'])) {
			unset($this->data['Service']['image']);
		}


		if(!empty($_FILES) && !empty($this->data['Service']['image'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Service']['image']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Service']['image'], $fileDest) ) {
				$this->data['Service']['image'] = $file;
			}
		}

		return parent::beforeSave($options);
	}

}
