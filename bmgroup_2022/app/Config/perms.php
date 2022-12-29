<?php

$config['perms']['default']['redirectOnUnlogged'] = array('controller'=>'users', 'action'=>'login', '?' => array('ref'=>$_SERVER['REQUEST_URI']));
$config['perms']['default']['redirectOnLogged'] = array('controller'=>'admins', 'action'=>'index');

// PERMISOS GENERICOS {
$config['perms']['default']['rules'] = array(

	// Usuario con Sesion Activa {
	'logged' => array(
		'allow' => array(
			'admins' => array(
				'attachment'
			),
			'users' => array(
				'logout',
				'api_+',
				'me'
			),
			'cart' => array(
				'api_+'
			),
			'pages' => array(
				'.+'
			),
			'products' => array(
				'api_+'
			),
		)
	),
	// Usuarios con Sesion Activa }
	
	// Usuario sin Sesion Activa {
	'unlogged' => array(
		'allow' => array(
			'admins' => array(
				'attachment'
			),
			'pages' => array(
				'.+'
			),
			'users' => array(
				'api_+',
				'index',
				'login',
				'logout',
				'recover',
				'activate',
				'signup',
				'language',
				'su_reset_pw'
			),
			'cart' => array(
				'api_+'
			),
			'products' => array(
				'api_+'
			),
		)
	),
	// Usuarios sin Sesion Activa }

);
// }




// USUARIOS {
/*$config['superperms']['rules'][__("Super Admin", true)] = array(
	'suCompanies' => array(
		'label' 	=> "Administrar Empresas",
		'allow' 	=> array(
			'companies' => array(
				'.+',
			)
		)
	),
	'suPeriods' => array(
		'label' 	=> "Administrar Periodos",
		'allow' 	=> array(
			'periods' => array(
				'.+',
			)
		)
	),
	'suCycles' => array(
		'label' 	=> "Administrar Ciclos",
		'allow' 	=> array(
			'cycles' => array(
				'.+',
			)
		)
	),
	'suPremierEvents' => array(
		'label' 	=> "Administrar Eventos Premiers",
		'allow' 	=> array(
			'spe' => array(
				'.+',
			)
		)
	),
	'suExpansions' => array(
		'label' 	=> "Administrar Expansiones TCG",
		'allow' 	=> array(
			'cards' => array(
				'.+',
			),
			'sets' => array(
				'.+',
			)

		)
	),


);*/

$config['perms']['rules']["Usuarios"] = array(
	
	// Ver {
	'usersView' => array(
		'label' 	=> "Listar Usuarios",
		'allow' 	=> array(
			'users' => array(
				'index',
				'view',
			)
		)
	),
	// Ver }
	
	// Edit Own {
	'usersEditOwn' => array(
		'label' 	=> __("Editar Perfil Propio", true),
		'allow' 	=> array(
			'users' => array(
				'me',
				'view',
				'upload_image'
			)
		)
	),
	// edit Own }
	
	// Manage {
	'usersManage' => array(
		'label' 	=> __("Administrar Usuarios", true),
		'allow' 	=> array(
			'users' => array(
					'.+'
			),
		),
	),
	// Manage }
	'groupsManage' => array(
		'label' 	=> __("Administrar Grupos de Usuario", true),
		'allow' 	=> array(
			'groups' => array(
					'.+'
			),
		),
	),

	
);

$config['perms']['rules'][__("Clientes", true)] = array(
	
	// Ver {
	'contactList' => array(
		'label' 	=> "Listar Clientes",
		'allow' 	=> array(
			'contacts' => array(
				'ajax_search',
				'index'
			),
			'gcontacts' => array(
				'ajax_search',
				'ajax_view'
			)
		)
	),

	'contactManage' => array(
		'label' 	=> "Gestionar Clientes",
		'allow' 	=> array(
			'contacts' => array(
				'.+'
			),
			'gcontacts' => array(
				'index',
				'ajax_search',
				'ajax_view'
			)
		)
	),

	'gcontactList' => array(
		'label' 	=> "Gestionar Grupos de Clientes",
		'allow' 	=> array(
			'gcontacts' => array(
				'.+'
			),
		)
	),
);

$config['perms']['rules'][__("Pagarés", true)] = array(
	'paymentOrderList' => array(
		'label' 	=> "Listar Pagarés",
		'allow' 	=> array(
			'paymentorders' => array(
				'index',
				'view'
			),
		)
	),
	'paymentManage' => array(
		'label' 	=> "Gestionar Pagarés",
		'allow' 	=> array(
			'paymentorders' => array(
				'.+',
			),
		)
	),
);
?>