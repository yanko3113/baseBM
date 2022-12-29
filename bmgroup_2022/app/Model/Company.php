<?php
class Company extends AppModel {
	
	var $name = 'Company';
	var $displayField = 'name';
	
	function getbyTag($tag) {
		$company = $this->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'Company.tag' => $tag
			)
		));		

		return $company;
	}

}
?>