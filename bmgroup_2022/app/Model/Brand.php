<?php
class Brand extends AppModel {

	var $name = 'Brand';

	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

    var $hasMany = array(
		'BrandImage' => array(
			'className' => 'BrandImage',
			'foreignKey' => 'brand_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'BrandImage.order ASC'
			),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
    );

	function beforeSave($options = array()) {
		if(empty($this->data['Brand']['avatar']['name'])) {
			unset($this->data['Brand']['avatar']);
		}


		if(!empty($_FILES) && !empty($this->data['Brand']['avatar'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Brand']['avatar']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Brand']['avatar'], $fileDest) ) {
				App::import('Component', 'Image');
				$image = new ImageComponent;
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_".$file, 40, 40);
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_big_".$file, 120, 120);
				$this->data['Brand']['avatar'] = $file;
			}
		}

		return parent::beforeSave($options);
	}

}
?>