<?php
class AdminsController extends AppController {

	var $name = 'Admins';
	var $helpers = array('Html', 'Form');
	var $components = array('Email');
	var $controllerName = 'Admin';
	var $controllerAction = null;
	var $superAdmin = false;
	var $uses = array('Slider', 'Blog', 'Company', 'Product', 'Category', 'Project', 'Brand', 'FormEntry', 'Service');

    public $paginate = array(
        'Product' => array(
            'limit' => 20,
        ),
        'Category' => array(
            'limit' => 20,
        ),
		'FormEntry' => array(
            'limit' => 50,
        )
    );


	function index() {
		$this->title = 'Inicio';
		if(empty($this->Session->read('Company'))) {
			$this->redirect(array('action'=>'switch_company','py'));
		}
	}

	function sliders($tag) {
		$sliders = $this->Slider->getByTag($tag);

		$this->set(compact('sliders'));
	}

	function switch_company($company) {
		$company = $this->Company->findByTag($company);
		$this->Session->write('Company', $company['Company']);
		$this->redirect(array('action'=>'index'));
	}

	function upload_slider() {
		$data = $this->ajaxResponse('200');
		$folderDest = WWW_ROOT.'upload/';
		foreach($_FILES['file']['name'] as $i => $file_name) {
			$id = date("Y-m-d_His").uniqid();
			$extensions = explode(".", $file_name);
			$file = $id.".".end($extensions);
			if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $folderDest.$file)) {
				$slider = array(
					'file' => $file,
					'ext' => $_FILES['file']['type'][$i],
					'name' => $file_name,
					'uuid' => $_POST['files'][$i],
					'tag' => $_POST['id'],
					'size' => $_FILES['file']['size'][$i]
				);
				$this->Slider->create();
				if( $this->Slider->save($slider) ) {
					$result[$i] = $slider + array('id'=>$this->Slider->id);
				} else {
					$result[$i] = $slider + array('id'=>null);
				}
			} else {
				$result[$i] = array(
					'id' => 'error',
				);
			}
		}
		$data['result'] = $result;
		$this->renderJson($data);
	}

	function delete_slider() {
		$slider = $this->Slider->deleteByUUID($_GET['uuid']);
		$data = $this->ajaxResponse('200');
		if(!$slider)
			$data = $this->ajaxResponse('error');
		$this->renderJson($data);
	}

	function edit_slider() {
		$slider = $this->Slider->getByUUID($this->request->data['Slider']['uuid']);

		$slider['Slider']['link'] = $this->request->data['Slider']['link'];
		$this->Slider->save($slider['Slider']);
		$data = $this->ajaxResponse('200');
		$this->renderJson($data);
	}

	function blogs_index() {
		$blogs = $this->Blog->find('all');
		$this->set(compact('blogs'));
	}

	function blogs_edit($id) {
		if(!empty($this->request->data)) {
			if($this->Blog->save($this->request->data['Blog'])) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'blogs_index'));
			}
		}
		$this->request->data = $this->Blog->read(null, $id);
		$this->set('companies', $this->Blog->Company->find('list'));
	}

	function blogs_duplicate($id) {
		$blog = $this->Blog->read(null, $id);
		unset($blog['Blog']['id']);
		unset($blog['Blog']['created']);
		unset($blog['Blog']['modified']);
		$this->Blog->create();
		if($this->Blog->save($blog['Blog'])) {
			$this->redirect(array('action'=>'blogs_edit', $this->Blog->id));
		}
	}

	function blogs_add() {
		if(!empty($this->request->data)) {
			// $this->debug($this->request->data); die();
			if($this->Blog->save($this->request->data['Blog'])) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'blogs_index'));
			} else {
				$this->debug($this->Blog->validationErrors); die();
			}
		}

		$this->set('companies', $this->Blog->Company->find('list'));
	}

	function upload_attachment() {
		$dir = WWW_ROOT.'/upload/'; //carpeta privada
		$file_name = $_FILES['file']["name"];
		$i = 1;
		while (file_exists($dir . $file_name)) {
			$file_name = "d" . ($i++) . "_" . $_FILES['file']["name"];
		}

		if (move_uploaded_file($_FILES['file']["tmp_name"], $dir . $file_name)) {
			$reply = $this->apiResponse('ok');
			$reply['data']['file_name'] = $file_name;
			// $reply['link'] = "{UPLOAD_DIR}".$file_name;
			$reply['link'] = Router::url(array('controller' => 'admins', 'action' => 'attachment')) . "/" . $file_name;
			// return true;
		} else {
			$reply = $this->apiResponse('error');
		}
		$this->renderAPI($reply, 'json');
	}

	function attachment($file)
	{
		return $this->files($file);
	}

	function files($file)
	{
		$file_parts = pathinfo($file);
		$file_full = WWW_ROOT.'upload/' . $file;
		switch ($file_parts['extension']) {
			case 'pdf':
				header('Content-Type: application/pdf');
				break;

			case 'PDF':
				header('Content-Type: application/pdf');
				break;

			case 'png':
				header('Content-Type: image/png');
				break;
			case 'jpg':
				header('Content-Type: image/jpg');
				break;
			default:
				header('Content-Description: File Transfer');
				header('Content-Type: application/force-download');
				break;
		}

		header('Content-Length: ' . filesize("$file_full"));
		readfile("$file_full");
		exit;
	}

	function blogs_delete($id) {
		$this->setFlash('OK');
		$this->Blog->delete($id);
		$this->redirect(array('action'=>'blogs_index'));
	}

	function categories_index() {
		// $categories = $this->Category->find('all');
		$this->paginate['Category']['conditions'] = $this->Category->setConditions();
		$categories = $this->paginate('Category');
		$this->set(compact('categories'));
	}

	function categories_add() {
		if(!empty($this->request->data)) {
			if( $this->Category->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'categories_index'));
			}
		}
		$companies = $this->Company->find('list');
		$categories = array(null => 'Seleccione') + $this->Category->treeList();
		$this->set(compact('companies', 'categories'));
	}

	function categories_edit($id) {
		if(!empty($this->request->data)) {
			if( $this->Category->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'categories_index'));
			}
		} else {
			$category = $this->Category->find('first', array(
				'conditions' => array(
					'Category.id' => $id
				)
			));

			// $this->debug($category); die();
			$this->request->data = $category;
		}

		$companies = $this->Company->find('list');
		$categories = array(null => 'Seleccione') + $this->Category->treeList();
		$this->set(compact('companies', 'categories'));
	}

	function categories_delete($id) {
		$this->Category->delete($id);
		$this->setFlash('OK');
		$this->redirect(array('action'=>'categories_index'));
	}

	function products_index() {
		$this->Product->showAll = true;
		$options = array(
			'order' => array(
				'Product.id DESC',
			)
		);

		$options['conditions'] = $this->Product->setConditions();
		// $this->debug($options); die();

		$this->paginate['Product'] = $options;
		// $products = $this->Product->find('all', $options);
		$products = $this->paginate('Product');
		$this->set(compact('products'));
	}

	function products_add() {
		if(!empty($this->request->data)) {
			if( $this->Product->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'products_index'));
			}
		}

		$companies = $this->Company->find('list');
		$categories = array(null => 'Seleccione') + $this->Category->treeList();
		$this->set(compact('companies', 'categories'));
	}

	function products_edit($id) {
		if(!empty($this->request->data)) {
			if( $this->Product->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'products_index'));
			}
		} else {
			$product = $this->Product->find('first', array(
				'conditions' => array(
					'Product.id' => $id
				)
			));

			$this->request->data = $product;
		}

		$companies = $this->Company->find('list');
		$categories = array(null => 'Seleccione') + $this->Category->treeList();
		$this->set(compact('companies', 'categories'));
	}

	function products_delete($id) {
		$this->Product->delete($id);
		$this->setFlash('OK');
		$this->redirect(array('action'=>'products_index'));
	}

	function multi_file_upload($model) {
		$response = $this->ajaxResponse('200');
		$directory = WWW_ROOT."img/upload/{$model}/";
		if(!file_exists($directory)) {
			mkdir($directory,0777,true);
		}
		$data = array();
		foreach($_FILES['file']['name'] as $i => $file) {
			$data[$i] = array(
				'file' => $file,
				'tmp_name' => $_FILES['file']['tmp_name'][$i],
				'size' => $_FILES['file']['size'][$i],
				'type' => $_FILES['file']['type'][$i]
			);
			if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $directory.$file)) {
				$data[$i]['status'] = 'ok';
			} else {
				$data[$i]['status'] = 'error';
			}
		}

		$response['data'] = $data;
		$this->renderJson($response);
	}

	function multi_upload_delete($model) {
		$uuid = $_GET['uuid'];
		$response = $this->ajaxResponse('200');

		$this->loadModel($model);
		$this->{$model}->deleteAll(array(
			"{$model}.uuid" => $uuid
		));

		$this->renderJson($response);
	}

	function office_nosotros() {
		$c_nosotros_1 = $this->Slider->getByTag('c_nosotros_1');
		$c_nosotros_2 = $this->Slider->getByTag('c_nosotros_2');

		$this->set(compact('c_nosotros_1','c_nosotros_2'));
	}

	function projects_index() {
		$options = array(
			'order' => array(
				'Project.id DESC',
			)
		);
		$projects = $this->Project->find('all', $options);
		$this->set(compact('projects'));
	}

	function projects_add() {
		if(!empty($this->request->data)) {
			// $this->debug($this->request->data); die();
			if( $this->Project->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'projects_index'));
			} else {
				$this->debug($this->Project->validationErrors); die();
			}
		}
	}

	function projects_edit($id) {
		if(!empty($this->request->data)) {
			if( $this->Project->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'projects_index'));
			}
		} else {
			$project = $this->Project->find('first', array(
				'conditions' => array(
					'Project.id' => $id
				)
			));

			$this->request->data = $project;
		}
	}

	function projects_delete($id) {
		$this->Project->delete($id);
		$this->setFlash('OK');
		$this->redirect(array('action'=>'projects_index'));
	}

	function brands_index() {
		$options = array(
			'order' => array(
				'Brand.id DESC',
			)
		);
		$brands = $this->Brand->find('all', $options);
		$this->set(compact('brands'));
	}

	function brands_add() {
		if(!empty($this->request->data)) {
			if( $this->Brand->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'brands_index'));
			} else {
				$this->debug($this->Brand->validationErrors); die();
			}
		}

		$this->set('categories', array(null=>'Seleccione') + $this->Category->find('list'));
	}

	function brands_edit($id) {
		if(!empty($this->request->data)) {
			if( $this->Brand->saveAll($this->request->data) ) {
				$this->setFlash('OK');
				$this->redirect(array('action'=>'brands_index'));
			}
		} else {
			$brand = $this->Brand->find('first', array(
				'conditions' => array(
					'Brand.id' => $id
				)
			));

			$this->request->data = $brand;
		}

		$this->set('categories', array(null=>'Seleccione') + $this->Category->find('list'));
	}

	function brands_delete($id) {
		$this->Brand->delete($id);
		$this->setFlash('OK');
		$this->redirect(array('action'=>'brands_index'));
	}

	function form_entries() {
		if(!empty($_GET['excel'])) {
			return $this->form_entries_excel();
		} else {		
			$this->paginate['FormEntry'] = array(
				'conditions' => array(
					'FormEntry.company' => $_GET['company_tag']
				)
			);

			$form_entries = $this->paginate('FormEntry');
			$this->set(compact('form_entries'));
		}
	}

	private function form_entries_excel() {
		App::import('Vendor','PHPExcel',array('file' => 'PHPExcel/PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getProperties()->setCreator("Linco");
		$objPHPExcel->getProperties()->setLastModifiedBy("Linco");		
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Fecha');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Servicio');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'País');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Nombre Completo');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Teléfono');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Notas');

		$entries = $this->FormEntry->find('all', array(
			'conditions' => array(
				'FormEntry.company' => $_GET['company_tag']
			),
			'order' => array(
				'FormEntry.created ASC'
			)
		));
		
		foreach ($entries as $i => $item) {
			$country = $item['FormEntry']['company']=='py' ? 'PARAGUAY' : 'BOLIVIA';
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $item['FormEntry']['created']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $item['FormEntry']['type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $country);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $item['FormEntry']['full_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $item['FormEntry']['email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $item['FormEntry']['phone']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.($i+2), $item['FormEntry']['notes']);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		HEADER("Content-Type: application/vnd.ms-excel");
		HEADER("Content-Disposition: attachment; filename=EntradasSitio.xls");
		HEADER("Pragma: no-cache");
		HEADER("Expires: 0");
		$objWriter->save('php://output');
		exit;
	}

	function servicios($tag) {
		$services = $this->Service->find('all', [
			'conditions' => [
				'Company.tag' => $tag
			]
		]);

		$this->set(compact('services'));
	}

	function servicios_edit($id) {
		$service = $this->Service->read(null, $id);
		// debug($service); die();
		if(!empty($this->request->data)) {
			$this->Service->save($this->request->data['Service']);
			$this->redirect(['action'=>'servicios', $service['Company']['tag']]);
		} else {
			$this->request->data = $service;
		}
	}

	function delete_avatar($id = null) {

		$service = $this->Service->read(null, $id);
		if(empty($service['Service']['image'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		$folderDest = WWW_ROOT.'upload/';
		$this->Service->query("UPDATE services SET image = null WHERE id = $id");
		@unlink($folderDest.$service['Service']['image']);
		@unlink($folderDest.'thumb_'.$service['Service']['image']);
		@unlink($folderDest.'thumb_big_'.$service['Service']['image']);
		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	function home($id) {
		if(!empty($this->request->data)) {
			if( $this->Company->save($this->request->data) ) {
				$this->setFlash('Ok');
			}
		} else {
			$this->request->data = $this->Company->getByTag($id);
		}
	}

}

?>
