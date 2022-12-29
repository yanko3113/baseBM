<?php
class Product extends AppModel {

	var $name = 'Product';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Brand' => array(
			'className' => 'Brand',
			'foreignKey' => 'brand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

    var $hasMany = array(
		'ProductImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'ProductImage.order ASC'
			),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
    );

    var $showAll = false;

	function beforeFind($queryData) {
		if(empty($queryData['conditions'][$this->alias.'.enabled']) && empty($queryData['conditions'][$this->alias.'.id']) && !$this->showAll)
			$queryData['conditions'][$this->alias.'.enabled'] = true;
		
		// $this->debug($queryData); die();

		return $queryData;
	}

	function setConditions() {
		$conditions = array();
		if(!empty($_GET['name'])) {
			$conditions['Product.name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(!empty($_GET['company'])) {
			$conditions[] = "Product.category_id IN (SELECT id FROM categories WHERE company_id = {$_GET['company']})";
		}

		return $conditions;
	}

	function beforeSave($options = array()) {
		if(!empty($_FILES) && !empty($this->data['Product']['pdf_file']['name'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Product']['pdf_file']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Product']['pdf_file'], $fileDest) ) {
				$this->data['Product']['pdf_file'] = $file;
			}
		} else {
			unset($this->data['Product']['pdf_file']);
		}

		return parent::beforeSave($options);
	}
}
?>