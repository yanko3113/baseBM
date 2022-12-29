<?php
class Blog extends AppModel {
	
	var $name = 'Blog';

	var $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	function beforeFind($querydata) {
		if(!empty($_GET['company'])) {
			$querydata['conditions'][$this->alias.'.company_id'] = $_GET['company'];
		}
		
		return $querydata;
	}

	function beforeSave($options = array()) {
		if(empty($this->data['Blog']['avatar']['name'])) {
			unset($this->data['Blog']['avatar']);
		}


		if(!empty($_FILES) && !empty($this->data['Blog']['avatar'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Blog']['avatar']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Blog']['avatar'], $fileDest) ) {
				App::import('Component', 'Image');
				$image = new ImageComponent;
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_".$file, 40, 40);
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_big_".$file, 120, 120);
				$this->data['Blog']['avatar'] = $file;
			}
		}

		return parent::beforeSave($options);
	}

}
?>