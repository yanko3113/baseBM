<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
    Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
    Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
    Router::connect('/admin', array('controller' => 'admins'));
    Router::connect('/admin/center', array('controller' => 'admins','action'=>'switch_company','center'));
    Router::connect('/admin/office', array('controller' => 'admins','action'=>'switch_company','office'));
    Router::connect('/admin/center/nosotros', array('controller' => 'admins','action'=>'center_nosotros'));

    Router::connect('/admin/categories', array('controller' => 'admins','action'=>'categories_index'));
    Router::connect('/admin/categories/add', array('controller' => 'admins','action'=>'categories_add'));
    Router::connect('/admin/categories/edit/*', array('controller' => 'admins','action'=>'categories_edit'));
    Router::connect('/admin/categories/delete/*', array('controller' => 'admins','action'=>'categories_delete'));

    Router::connect('/admin/projects', array('controller' => 'admins','action'=>'projects_index'));
    Router::connect('/admin/projects/add', array('controller' => 'admins','action'=>'projects_add'));
    Router::connect('/admin/projects/edit/*', array('controller' => 'admins','action'=>'projects_edit'));
    Router::connect('/admin/projects/delete/*', array('controller' => 'admins','action'=>'projects_delete'));


    Router::connect('/admin/products', array('controller' => 'admins','action'=>'products_index'));
    Router::connect('/admin/products/add', array('controller' => 'admins','action'=>'products_add'));
    Router::connect('/admin/products/edit/*', array('controller' => 'admins','action'=>'products_edit'));
    Router::connect('/admin/products/delete/*', array('controller' => 'admins','action'=>'products_delete'));

    Router::connect(
        '/admin/products/index/p/:page',
        array('controller' => 'admins', 'action' => 'products_index'),
        array(
            'named' => array('page' => '[\d]+')
        )
    ); 
    Router::connect(
        '/admin/products/index/p/:page/:sort/:direction',
        array('controller' => 'admins', 'action' => 'products_index'),
        array(
            'named' => array('page' => '[\d]+', 'sort', 'direction')
        )
    );
    Router::connect(
        '/admin/products/index/p/:sort/:direction',
        array('controller' => 'admins', 'action' => 'products_index'),
        array(
            'named' => array('sort', 'direction')
        )
    );

    Router::connect('/py', array('controller' => 'pages','action'=>'py_index'));
    Router::connect('/py/*', array('controller' => 'pages','action'=>'py_servicio'));
    Router::connect('/bo', array('controller' => 'pages','action'=>'bo_index'));
    Router::connect('/bo/*', array('controller' => 'pages','action'=>'bo_servicio'));

    Router::connect('/admin/blogs', array('controller' => 'admins','action'=>'blogs_index'));
    Router::connect('/admin/blogs/add', array('controller' => 'admins','action'=>'blogs_add'));
    Router::connect('/admin/blogs/edit/*', array('controller' => 'admins','action'=>'blogs_edit'));
    Router::connect('/admin/blogs/duplicate/*', array('controller' => 'admins','action'=>'blogs_duplicate'));
    Router::connect('/admin/blogs/delete/*', array('controller' => 'admins','action'=>'blogs_delete'));
    Router::connect('/admin/users/:action/*', array('controller' => 'users'));

    // FORM
    Router::connect('/formulario', array('controller' => 'pages', 'action' => 'submit_form'));

    // CENTER
    Router::connect('/center', array('controller' => 'pages', 'action' => 'center_index'));
    Router::connect('/center/blog', array('controller' => 'pages', 'action' => 'blogs', 'center'));
    Router::connect('/center/blog/*', array('controller' => 'pages', 'action' => 'center_blog'));
    Router::connect('/center/servicios', array('controller' => 'pages', 'action' => 'center_services'));
    Router::connect('/center/contacto', array('controller' => 'pages', 'action' => 'center_contact'));

    // CENTER SECCIONES
    Router::connect('/center/secciones', array('controller' => 'pages', 'action' => 'center_products'));
    Router::connect(
        '/center/secciones/:category',
        array('controller' => 'pages', 'action' => 'center_products'),
        array(
            'pass' => array('category'),
        )
    ); 

    Router::connect(
        '/center/secciones/:category/:product',
        array('controller' => 'pages', 'action' => 'center_products'),
        array(
            'pass' => array('category','product'),
        )
    ); 
    Router::connect(
        '/center/secciones/:category/p/:page',
        array('controller' => 'pages', 'action' => 'center_products'),
        array(
            'pass' => array('category'),
            'named' => array('page' => '[\d]+')
        )
    ); 
    Router::connect(
        '/center/secciones/:category/p/:page/:sort/:direction',
        array('controller' => 'pages', 'action' => 'center_products'),
        array(
            'pass' => array('category'),
            'named' => array('page' => '[\d]+', 'sort', 'direction')
        )
    );
    Router::connect(
        '/center/secciones/:category/p/:sort/:direction',
        array('controller' => 'pages', 'action' => 'center_products'),
        array(
            'pass' => array('category'),
            'named' => array('sort', 'direction')
        )
    );

    // FIN CENTER SECCIONES
    
    // OFICE
    Router::connect('/office', array('controller' => 'pages', 'action' => 'office_index'));
    Router::connect('/office/blog', array('controller' => 'pages', 'action' => 'blogs', 'office'));
    Router::connect('/office/blog/*', array('controller' => 'pages', 'action' => 'office_blog'));
    Router::connect('/office/marcas', array('controller' => 'pages', 'action' => 'office_brands'));
    Router::connect('/office/proyectos', array('controller' => 'pages', 'action' => 'office_projects'));
    Router::connect('/office/contacto', array('controller' => 'pages', 'action' => 'office_contact'));
    Router::connect('/office/proyectos', array('controller' => 'pages', 'action' => 'office_projects'));
    Router::connect('/office/proyecto/*', array('controller' => 'pages', 'action' => 'office_project'));
    // OFFICE SECCIONES
    Router::connect('/office/productos', array('controller' => 'pages', 'action' => 'office_products'));
    Router::connect(
        '/office/productos/:category',
        array('controller' => 'pages', 'action' => 'office_products'),
        array(
            'pass' => array('category'),
        )
    ); 
    Router::connect(
        '/office/productos/:category/:product',
        array('controller' => 'pages', 'action' => 'office_products'),
        array(
            'pass' => array('category','product'),
        )
    ); 
    // FIN OFFICE SECCIONES
    

    Router::connect('/attachment/*', array('controller' => 'admins', 'action' => 'attachment'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	// Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
