<?php
class FormEntry extends AppModel {
	
	var $name = 'FormEntry';

	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}
?>