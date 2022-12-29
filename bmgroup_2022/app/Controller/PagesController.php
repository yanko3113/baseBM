<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Slider','Blog','Product','Project','FormEntry', 'Service', 'Company');

    public $paginate = array(
        'Product' => array(
            'limit' => 9,
            'order' => array(
                'Product.name ASC'
            )
        )
    );

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */

    public function beforeRender() {

        if(strpos($this->params['action'], "py_")!==false) {
            $this->layout = 'py';
            $this->set('prefix', 'py');
        } elseif(strpos($this->params['action'], "bo_")!==false) {
            // $this->layout = 'bo';
            $this->layout = 'py';
            $this->set('prefix', 'bo');
        }

        if(!empty($_POST)) {
        	$this->debug($_POST); die();
        }

        // $this->set('prefix', $this->layout);
        return parent::beforeRender();
    }

    public function index() {
    	$this->layout = 'web';
        $this->title = 'Bienvenido';
    }

    public function center_index() {
        $this->title = 'Nosotros';
        $carousel = $this->Slider->getByTag('nosotros_1');
        $igpics = $this->Slider->getByTag('nosotros_2');
        
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.category_id IN (SELECT id FROM categories WHERE company_id = 1)',
            ),
            'order' => array(
                'Product.id DESC',
            ),
            'limit' => 3
        ));

        $this->set(compact('carousel','igpics','products'));
    }

    public function center_contact() {
        $this->title = 'Contacto';
    }

    public function center_products($category_id = null, $product_id = null) {
        $this->title = 'Secciones';
        if(!$category_id) {
            $slug = $this->Product->Category->find('first', array(
                'order' => array(
                    'Category.id'
                ),
                'conditions' => array(
                    'Category.company_id' => 1
                )
            ));
            // $this->debug($slug); die();
           $this->redirect(array('controller'=>'pages','action'=>'center_products', 'category'=>$slug['Category']['slug']));
        }

        $categories = $this->Product->Category->find('threaded', array(
            'conditions' => array(
                'Category.company_id' => 1
            )
        ));

        if(!empty($category_id)) {
            $category = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.slug' => $category_id
                )
            ));

            $this->paginate['Product']['conditions'] = $this->Product->setConditions() + array(
                'Product.category_id' => $this->Product->Category->getSubtreeIds($category['Category']['id']) + array($category['Category']['id'])
            );

            $hierrachyCategory = $this->Product->Category->getAscendingTree($category['Category']['id']);

            $urlCategories = array();
            foreach($hierrachyCategory as $hierrachyItem) {
                $urlCategories[] = Router::url(array('controller'=>'pages','action'=>'center_products', 'category'=>$hierrachyItem['slug']));
            }

            $topCategory = $hierrachyCategory[0];
            $currentSubcategories = $this->Product->Category->find('threaded', array(
                'conditions' => array(
                    'Category.id' => $this->Product->Category->getSubtreeIds($topCategory['id'])
                )
            ));
            // $this->debug($currentSubcategories); die();

            $products = $this->paginate('Product');

            $this->set('currentCategory', $category);
            $this->set(compact('products','currentSubcategories','urlCategories'));
        }


        if(!empty($product_id)) {
            $product = $this->Product->find('first', array(
                'conditions' => array(
                    'Product.slug' => $product_id
                )
            ));

            $this->set('currentProduct', $product);
        }

        $this->set(compact('categories'));
    }

    function blogs($tag) {
        $this->title = 'Blogs';
        $company = $this->Blog->Company->findByTag($tag);
        $blogs = $this->Blog->find('all', array(
            'conditions' => array(
                'Blog.company_id' => $company['Company']['id']
            )
        ));

        $this->set(compact('blogs'));
        if($tag=='office') {
            $this->render('office_blogs');
        }
    }

    function office_blog($id) {
        return $this->blog($id, 'office');
    }

    function center_blog($id) {
        return $this->blog($id, 'center');
    }

    function blog($id, $layout) {
        $blog = $this->Blog->find('first', array(
            'conditions' => array(
                'Blog.id' => $id
            )
        ));

        $this->title = $blog['Blog']['title'];

        $this->metaData = array(
            array(
                "property" => "og:title",
                "content" => $blog['Blog']['title'],
            ),
            array(
                "property" => "og:type",
                "content" => "website",
            ),
            array(
                "property" => "og:url",
                "content" => Router::url(null, true),
            ),
            array(
                "property" => "og:image",
                "content" => Router::url('/', true)."upload/{$blog['Blog']['avatar']}",
            ),
            array(
                "property" => "og:image:type",
                "content" => "image/jpg",
            ),
            array(
                "property" => "og:site_name",
                "content" => $blog['Company']['name'],
            ),
            array(
                "property" => "og:description",
                "content" => strip_tags($blog['Blog']['short_body']),
            ),
            array(
                "property" => "og:locale",
                "content" => "es_LA",
            ),
            array(
                "property" => "og:locale:alternate",
                "content" => "en_US",
            ),
            array(
                "name" => 'twitter:card',
                "content" => "summary"
            ),
            array(
                "name" => 'twitter:image',
                "content" => Router::url('/', true)."upload/{$blog['Blog']['avatar']}"
            ),
            array(
                "name" => 'twitter:title',
                "content" => $blog['Blog']['title']
            ),
            array(
                "name" => 'twitter:description',
                "content" => strip_tags($blog['Blog']['short_body'])
            ),
        );
  
        $this->layout = $layout;
        $this->set(compact('blog'));
        $this->render('blog');
    }

    function center_services() {
        $this->title = 'Servicios';
    }

    function office_index() {
        $this->title = 'Nosotros';

        $carousel = $this->Slider->getByTag('c_nosotros_1');
        $igpics = $this->Slider->getByTag('c_nosotros_2');
        
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.category_id IN (SELECT id FROM categories WHERE company_id = 2)',
            ),
            'order' => array(
                'Product.id DESC',
            ),
            'limit' => 3
        ));

        $projects = $this->Project->find('all', array(
            'order' => array(
                'Project.name ASC'
            )
        ));

        $this->set(compact('carousel','igpics','products','projects'));

    }

    function office_projects() {
        $options = array(
            'order' => array(
                'Project.name ASC'
            )
        );

        $this->set('projects', $this->Project->find('all',$options));
    }

    function office_project($id) {
        $project = $this->Project->read(null, $id);
        $this->title = $project['Project']['name'];
        $this->set(compact('project'));
    }

    function office_brands() {
        $brands = $this->Product->Brand->find('all');

        $this->set(compact('brands'));
    }

    public function office_products($category_id = null, $product_id = null) {
        $this->title = 'Productos';

        $categories = $this->Product->Category->find('threaded', array(
            'conditions' => array(
                'Category.company_id' => 2
            )
        ));

        if(!empty($category_id)) {
            $category = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.slug' => $category_id
                )
            ));

            $products = $this->paginate['Product']['conditions'] = array(
                'Product.category_id' => $this->Product->Category->getSubtreeIds($category['Category']['id']) + array($category['Category']['id'])
            );

            $hierrachyCategory = $this->Product->Category->getAscendingTree($category['Category']['id']);

            $urlCategories = array();
            foreach($hierrachyCategory as $hierrachyItem) {
                $urlCategories[] = Router::url(array('controller'=>'pages','action'=>'office_products', 'category'=>$hierrachyItem['slug']));
            }

            $topCategory = $hierrachyCategory[0];
            $currentSubcategories = $this->Product->Category->find('threaded', array(
                'conditions' => array(
                    'Category.id' => $this->Product->Category->getSubtreeIds($topCategory['id'])
                )
            ));

            $products = $this->paginate('Product');

            $this->set('currentCategory', $category);
            $this->set(compact('products','currentSubcategories','urlCategories'));
        } else {
            $this->paginate['Product'] = array(
                'conditions' => array(
                    "Product.category_id IN (SELECT id FROM categories WHERE company_id = 2)"
                )
            );
            $products = $this->paginate('Product');
            $urlCategories = array();
            $this->set(compact('products','urlCategories'));

        }


        if(!empty($product_id)) {
            $product = $this->Product->find('first', array(
                'conditions' => array(
                    'Product.slug' => $product_id
                )
            ));

            $this->set('currentProduct', $product);
        }

        $brands = $this->Product->Brand->find('all');

        $this->set(compact('categories', 'brands'));
    }

    public function office_contact() {
        $this->title = 'Contacto';
    }

    function submit_form() {
        $this->layout = 'none';
        if(!empty($this->data)) {
            $this->FormEntry->save($this->data);
            $this->setFlash('Su solicitud se ha enviado con éxito','alert-success','default');
            $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function py_index() {
    	$this->Service->Behaviors->attach('Containable');
    	$carousel = $this->Slider->getByTag('py');

    	$services = $this->Service->find('all', [
    		'contain' => [
    			'Company'
    		],
    		'conditions' => [
    			'Service.company_id' => 1
    		]
    	]);

    	$company = $this->Company->getbyTag('py');
    	$this->set(compact('services', 'carousel', 'company'));
    }

    public function bo_index() {
    	$this->Service->Behaviors->attach('Containable');
    	$carousel = $this->Slider->getByTag('bo');

    	$services = $this->Service->find('all', [
    		'contain' => [
    			'Company'
    		],
    		'conditions' => [
    			'Service.company_id' => 2
    		]
    	]);

    	$company = $this->Company->getbyTag('py');
    	$this->set(compact('services', 'carousel', 'company'));
    	$this->render('py_index');
    }

    public function py_servicio($tag) {
    	$this->Service->Behaviors->attach('Containable');
    	$service = $this->Service->find('first', [
    		'contain' => [
    			'Company'
    		],
    		'conditions' => [
    			'Service.company_id' => 1,
    			'Service.tag' => $tag
    		]
    	]);

    	if(empty($service)) {
    		$this->redirect(['action'=>'index']);
    	}

    	$this->set(compact('service'));
    }

    public function bo_servicio($tag) {
    	$this->Service->Behaviors->attach('Containable');
    	$service = $this->Service->find('first', [
    		'contain' => [
    			'Company'
    		],
    		'conditions' => [
    			'Service.company_id' => 2,
    			'Service.tag' => $tag
    		]
    	]);

    	if(empty($service)) {
    		$this->redirect(['action'=>'index']);
    	}

    	$this->set(compact('service'));
    	$this->render('py_servicio');
    }

    function ajax_send() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
		    if (!empty($_POST["nombre"]) &&
		        !empty($_POST["correo"]) &&
		        !empty($_POST["telefono"]) &&
		        !empty($_POST["mensaje"])/*  &&
		        !empty($_POST["g-recaptcha-response"])*/) {

		        $secret = "6Ld-kkIeAAAAAJqj8R-3JqweH5UKww13LcaqnmBg";
		        //$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST["g-recaptcha-response"]);
		        // $responseData = json_decode($verifyResponse);

		        $formEntry = [
		        	'company' => $_POST['country'],
		        	'full_name' => $_POST['nombre'],
		        	'phone' => $_POST['telefono'],
		        	'email' => $_POST['correo'],
		        	'type' => isset($_POST['type']) ? $_POST['type'] : null,
		        	'notes' => $_POST['mensaje']
		        ];

		        $nombre   = $_POST['nombre'];
		        $correo   = $_POST['correo'];
		        $telefono = $_POST['telefono'];
		        $mensaje  = $_POST['mensaje'];

		        $pais = $_POST['country']=='py'?'PARAGUAY':'BOLIVIA';

		        $asunto = "[BMGROUP {$pais}]";
		        $tipo = isset($_POST['type']) ? $_POST['type'] : null;

		        if (strlen($nombre) < 5) {
		            echo "El campo Nombre y Apellido debe tener más de 5 caracteres";

		        } else if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $correo)) {
		            echo "Error: Debe ingresar un correo válido. Ej: hola@gmail.com";

		        } else if (preg_match("/\b(?:(?:https?|ftp|http):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $mensaje)) {
		            echo "Error: Debe ingresar un mensaje válido";

		        } else if (strlen($mensaje) > 500) {
		            echo "Error: Su mensaje supera el límite de caracteres";

		        } else {
		        	$htmltipo = empty($tipo) ? null : '<p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">Servicio: </b>' . $tipo . '</p>';
		            ini_set('date.timezone', 'America/Asuncion');
		            $fecha_contacto = date("Y-m-d H:i:s");
		            $this->FormEntry->create();
		            if ($this->FormEntry->save($formEntry)) {
		              $para         = "info@bmgroup.com.bo";
		              $cabecera     = "From: no-reply@linco.com.py\r\n";
		              $cabecera    .= "MIME-Version: 1.0\r\n";
		              $cabecera    .= "Content-type: text/html\r\n";
		              $asunto       = "{$asunto}: Nuevo contacto desde la web";
		              $template     = '<html xmlns="http://www.w3.org/1999/xhtml">
		                <head>
		                  <meta name="viewport" content="width=device-width">
		                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		                </head>

		                <body bgcolor="#FFFFFF">
		                  <table bgcolor="#00416B" style="width: 100%; border-top-left-radius: 3px; border-top-right-radius: 3px;">
		                    <tbody>
		                      <tr>
		                        <td bgcolor="#00416B">
		                          <table style="width: 100%; padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 5px;">
		                            <tbody>
		                              <tr>
		                                <td>
		                                  <p style="font-size: 14px; color: #FFFFFF;">
		                                    ' . $nombre . ' se ha contactado
		                                  </p>
		                                </td>
		                              </tr>
		                            </tbody>
		                          </table>
		                        </td>
		                      </tr>
		                    </tbody>
		                  </table>

		                  <table bgcolor="#FAFAFA" style="width: 100%; border-left: 1px solid #F0F0F0; border-right: 1px solid #F0F0F0; border-bottom: 1px solid #F0F0F0;">
		                    <tbody>
		                      <tr>
		                        <td>
		                          <table bgcolor="#FFFFFF" style="width: 100%; padding-left: 25px; padding-right: 25px; padding-top: 15px; padding-bottom: 15px;">
		                            <tbody>
		                              <tr>
		                                <td>
		                                  '.$htmltipo.'
		                                  <p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">País Seleccioado: </b>' . $pais . '</p>
		                                  <p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">Nombre y Apellido: </b>' . $nombre . '</p>
		                                  <p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">Email: </b>' . $correo . '</p>
		                                  <p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">Teléfono: </b>' . $telefono . '</p>
		                                  <p style="font-size: 14px; color: #6E6E6E; margin-top: 0px; margin-bottom: 7px;"><b style="color: #6E6E6E">Mensaje: </b>' . $mensaje . '</p>
		                                </td>
		                              </tr>
		                            </tbody>
		                          </table>
		                        </td>
		                      </tr>
		                    </tbody>
		                  </table>
		                </body>
		              </html>';
		              if (mail($para, $asunto, $template, $cabecera)) {
		                  echo "Su mensaje fue enviado correctamente, en breve un representante se pondrá en contacto con usted.";
		              } else {
		                  echo "No se pudo enviar su mensaje";
		              }
		            } else {
		                echo "No se pudo insertar en la base de datos";
		            }
		        }
		    } else {
		        echo "Error: Debe completar todos los campos y marcar que no es un robot";
		    }
		} else {
		    echo "Acceso denegado";
		}
		exit;
    }
}
