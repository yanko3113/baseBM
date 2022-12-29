<?php
class Slider extends AppModel {
	
	var $name = 'Slider';

	function deleteByUUID($uuid) {
		$slider = $this->find('first', array(
			'recursive' => -1,
			'fields' => array(
				'Slider.id',
				'Slider.uuid'
			),
			'conditions' => array(
				'Slider.uuid' => $uuid
			)
		));

		if(!empty($slider)) {
			$this->delete($slider['Slider']['id']);
			return true;
		} else {
			return false;
		}
	}

	function getByUUID($uuid) {
		$slider = $this->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'Slider.uuid' => $uuid
			)
		));

		return $slider;
	}

	function getbyTag($tag) {
		$sliders = $this->find('all', array(
			'recursive' => -1,
			'conditions' => array(
				'Slider.tag' => $tag
			)
		));		

		return $sliders;
	}

}
?>