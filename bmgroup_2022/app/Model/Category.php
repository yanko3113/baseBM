<?php
class Category extends AppModel {

	var $name = 'Category';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

    var $hasMany = array(
		'CategoryImage' => array(
			'className' => 'CategoryImage',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'CategoryImage.order ASC'
			),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
    );

	function beforeFind($querydata) {
		if(!empty($_GET['company']) && !isset($querydata['conditions'][$this->alias.'.company_id'])) {
			$querydata['conditions'][$this->alias.'.company_id'] = $_GET['company'];
		}
		return $querydata;
	}

	function beforeSave($options = array()) {
		if(empty($this->data['Category']['avatar']['name'])) {
			unset($this->data['Category']['avatar']);
		}


		if(!empty($_FILES) && !empty($this->data['Category']['avatar']['name'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Category']['avatar']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Category']['avatar'], $fileDest) ) {
				App::import('Component', 'Image');
				$image = new ImageComponent;
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_".$file, 40, 40);
				$image->resizeImage('resizeCrop', $folderDest, $file, $folderDest, "thumb_big_".$file, 120, 120);
				$this->data['Category']['avatar'] = $file;
			}
		} else {
			unset($this->data['Category']['avatar']);
		}

		if(!empty($_FILES) && !empty($this->data['Category']['pdf_file']['name'])) {
			$file = uniqid().'_'.str_replace(" ","",$this->data['Category']['pdf_file']['name']);
			$folderDest = WWW_ROOT.'upload/';
			$fileDest = $folderDest.$file;
			if( move_uploaded_file($_FILES['data']['tmp_name']['Category']['pdf_file'], $fileDest) ) {
				$this->data['Category']['pdf_file'] = $file;
			}
		} else {
			unset($this->data['Category']['pdf_file']);
		}

		return parent::beforeSave($options);
	}


	function getTree() {
		return $this->find('threaded', array(
			'recursive' => -1,
            'order'=> array(
            	'name'
            )
		));
	}

	function treeList($top = true, $tree = array(), $list = array(), $level = 0) {
		if ($top) {
			$tree = $this->getTree();
		}
		foreach ($tree as $key => $item) {
			$list[$item[$this->alias]['id']] = str_repeat("–", $level) . ($level > 0 ? ' ' : '') . $item[$this->alias]['name'];
			if (!empty($item['children']))
				$list = $this->treeList(false, $item['children'], $list, $level+1);
		}
		return $list;
	}

	function getSubtreeIds($parent_id, $top = true, $tree = null, $ids = array(), $count = 0) {
		if ($top) {
			$tree = $this->getTree();
		}
			
		if ($count > 3) {
			return $ids;
		}

		foreach ($tree as $key => $item) {
			if (!$top || $item[$this->alias]['id'] == $parent_id) {
				$ids[] = $item[$this->alias]['id'];
				$ids = $this->getSubtreeIds($item[$this->alias]['id'], false, $item['children'], $ids, $count+1);
			}
		}
		return $ids;
	}

	function getAscendingTree($id, $list = array()) {
		$item = $this->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				$this->alias.'.id' => $id
			),
		));
		$data = array(
			'id' => $id,
			'name' => $item[$this->alias]['name'],
			'parent_id' => $item[$this->alias]['parent_id'],
			'slug' => $item[$this->alias]['slug']
		);

		$list = array_merge(array($data), $list);
		if (!empty($item[$this->alias]['parent_id'])) {
			$list = $this->getAscendingTree($item[$this->alias]['parent_id'], $list);
		}

		return $list;
	}

	function setConditions() {
		$conditions = array();
		if(!empty($_GET['name'])) {
			$conditions['Category.name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(!empty($_GET['company'])) {
			$conditions['Category.company_id'] = $_GET['company'];
		}

		return $conditions;
	}
}
?>