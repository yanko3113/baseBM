<?php
class Project extends AppModel {

	var $name = 'Project';

    var $hasMany = array(
		'ProjectImage' => array(
			'className' => 'ProjectImage',
			'foreignKey' => 'project_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'ProjectImage.order ASC'
			),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
    );

	function beforeSave($options = array()) {
		if(empty($this->data['Project']['avatar']['name'])) {
			unset($this->data['Project']['avatar']);
		}


		if(!empty($_FILES) && !empty($this->data['Project']['avatar'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Project']['avatar']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Project']['avatar'], $fileDest) ) {
				App::import('Component', 'Image');
				$image = new ImageComponent;
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_".$file, 40, 40);
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_big_".$file, 120, 120);
				$this->data['Project']['avatar'] = $file;
			}
		}

		return parent::beforeSave($options);
	}

}
?>