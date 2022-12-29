<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');
App::uses('Inflector', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    var $helpers = array("Html", "Session", "Form", "Nav", "Paginator", "Js");
    var $components = array("Session", "Cookie", "Perms");
    var $languages = array(
        'spa' => 'Español',
        'esp' => 'Español',
        'eng' => 'English'
    );
    var $sidebar = null;
    var $controllerName = 'APP';
    var $controllerAction = null;
    var $printTemplates = array(
        'A4',
        'Legal'
    );
    var $adminControllers = array(
        'products',
        'contacts',
        'groups',
        'orders',
        'users'
    );
    var $userPages = array(
        'me',
        'login',
        'signup',
        'activate',
        'logout',
        'recover'
    );
    var $dateFormat = 'Y-m-d';
    var $fullScreen = false;
    var $title;
    var $metaData = array();

    var $companies = array(
        'center' => array(
            'name' => 'Quality Center',
            'id' => 'center'
        ),
        'office' => array(
            'name' => 'Quality Office',
            'id' => 'office'
        )
    );

    function beforeFilter() {
        @HEADER("Pragma: no-cache");
        @header("Strict-Transport-Security: max-age=0; includeSubDomains");

        $group = $this->Session->read('User.type');
        // $this->debug($this->params); die();
        $this->Perms->check();
        // $this->checkAdminSite();
        $this->setLanguage();
        $this->setCartData();
        if(!empty($_GET['fm'])) {
            $this->Session->setFlash(__($_GET['fm'], true), 'default', array('class' => "alert alert-danger"));
        }

        if(!empty($_GET['flash'])) {
            $this->setFlash('Error', 'error');
        }

        if(!empty($this->Session->read('User.id'))) {
            if(empty($this->Session->read('User.nombres')) && ($this->params['controller']!='user'&&$this->params['action']!='me')) {
                $this->setFlash('Debe completar sus Nombres y Apellidos en el apartado de Contacto', 'error');
                $this->redirect(array('controller'=>'users', 'action'=>'me'));
            }
        }
        $this->fixRoutingPaginator();
        $this->checkCurrentCompany();
    }

    private function fixRoutingPaginator() {
        if (isset($this->request->params['page'])) {
            $this->request->params['named']['page'] = $this->request->params['page'];
        }elseif( isset($this->request->query['page']) ){
            $this->request->params['named']['page'] = $this->request->query['page'];
        }

        if (isset($this->request->params['sort'])) {
            $this->request->params['named']['sort'] = $this->request->params['sort'];
        }elseif (isset($this->request->query['sort'])) {
            $this->request->params['named']['sort'] = $this->request->query['sort'];
        }  

        if (isset($this->request->params['direction'])) {
            $this->request->params['named']['direction'] = $this->request->params['direction'];
        }elseif (isset($this->request->query['direction'])) {
            $this->request->params['named']['direction'] = $this->request->query['direction'];
        }
    }

    private function checkCurrentCompany() {
        if(empty($this->Session->read('Company')))
            return;

        if($this->params['controller'] == 'admins') {
            if(!isset($_GET['company'])) {
                $_GET['company'] = $this->Session->read('Company.id');
                $_GET['company_tag'] = $this->Session->read('Company.tag');
            }
        }
    }

    function checkAdminSite() {
        if(in_array($this->params['controller'], $this->adminControllers)) {
            if($this->params['controller'] == 'users' && in_array($this->params['action'], $this->userPages)) {
                return true;
            }
            if(!$this->isAdmin()) {
                $this->redirect(array('controller'=>'pages','action'=>'home'));
            }
        }
    }

    function setCartData() {
        if(empty($this->Session->read('Cart'))) {
            $data = array(
                'session_id' => session_id()
            );
            $this->Session->write('Cart', $data);
        }
    }

    function addCartData($id, $qty = 1) {
        App::import('Model', 'Product');
        $this->Product = new Product;
        $this->setCartData();

        $cart = $this->Session->read('Cart');
        if(empty($cart['Products'])) {
            $cart['Products'] = array();
        }

        $uuid = uniqid();

        $product = $this->Product->read(null, $id);

        $cart['Products'][$uuid] = array(
            'product_id' => $id,
            'quantity' => $qty,
        ) + $product;

        $this->Session->write('Cart', $cart);
    }

    function delCartData($uuid) {
        $cart = $this->Session->read('Cart');
        unset($cart['Products'][$uuid]);
        $this->Session->write('Cart', $cart);
    }

    function clearCartData() {
        $this->Session->delete('Cart');
    }

    function clean($string) {
        $string = $this->sacar_tildes($string);
        $string = str_replace(' ', '-', $string);
        $string = str_replace('.', '-', $string);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    function sacar_tildes($texto) {
        $texto = str_replace('á', 'a', $texto);
        $texto = str_replace('é', 'e', $texto);
        $texto = str_replace('í', 'i', $texto);
        $texto = str_replace('ó', 'o', $texto);
        $texto = str_replace('ú', 'u', $texto);
        
        $texto = str_replace('Á', 'A', $texto);
        $texto = str_replace('É', 'E', $texto);
        $texto = str_replace('Í', 'I', $texto);
        $texto = str_replace('Ó', 'O', $texto);
        $texto = str_replace('Ú', 'U', $texto);

        $texto = str_replace('ñ', 'n', $texto);
        $texto = str_replace('Ñ', 'N', $texto);

        return $texto;
    }


    function beforeRender() {
        $this->setTitles();
        $this->setSidebar();
        // $this->setColumns();

        $this->set('dateFormat', $this->dateFormat);
        if(!empty($_GET['pdf'])) {
            $this->pdf();
        }
    }

    function debug($data) {
        echo "<pre>".print_r($data, true)."</pre>";
    }

    function setSidebar() {
        if (!isset($this->sidebar))
            $this->sidebar = new stdClass();
        if (!isset($this->sidebar->name))
            $this->sidebar->name = 'main';

        $this->set('sidebar', $this->sidebar);
    }

    function setTitles() {
        $this->controllerName = !empty($this->controllerName) ? $this->controllerName : __(Inflector::humanize($this->params['controller']));
        $this->actionName = !empty($this->actionName) ? $this->actionName : __(Inflector::humanize($this->params['action']));
        if(empty($this->title)) {
            $this->title = $this->actionName;
            $this->title = __($this->controllerName)." / ".__($this->actionName);
        } 

        $this->set('controller_name', $this->controllerName);
        $this->set('controller_action', $this->actionName);
        $this->set('title_for_layout', $this->title);

        if (isset($this->navbar)) {
            $this->set('navbar', $this->navbar);
        }

        if(!empty($this->Session->read('Company'))) {
            if($this->params['controller']=='admins')
                $this->set('prefix', $this->Session->read('Company.tag'));
        }

        $this->set('fullScreen', $this->fullScreen);
        $this->set('metaData', $this->metaData);

    }

    function setFlash($message, $class='ok', $template = 'alerts') {
        $this->Session->setFlash(__($message, true), 'Flash/'.$template, array('class' => "alert $class"));
    }

    function isLogged() {
        return !empty($this->Session->read('User.id'));
    }

    function isAdmin() {
        if(!$this->isLogged())
            return false;

        return $this->Session->read('Group.full');
    }

    function get_web_page( $url, $post = array() )
    {

        $options = array(
            CURLOPT_RETURNTRANSFER => true,     
            CURLOPT_HEADER         => false,    
            CURLOPT_FOLLOWLOCATION => true,     
            CURLOPT_ENCODING       => "",       
            CURLOPT_AUTOREFERER    => true,     
            CURLOPT_CONNECTTIMEOUT => 120,      
            CURLOPT_TIMEOUT        => 120,      
            CURLOPT_MAXREDIRS      => 10,       
            CURLOPT_SSL_VERIFYPEER => false     
        );
        if(!empty($post)) {
            $options[CURLOPT_POSTFIELDS] = $post;
        }

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    function sendEmail($email, $subject, $data = array(), $template = null, $layout = null) {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('smtp');
        $layout = !empty($layout) ? $layout : 'web';
        $template = !empty($template) ? $template : 'default';
        $Email->to($email);
        $Email->subject($subject);
        $Email->from(array('contacto@conecciones.net' => 'AHK'));
        $Email->template($template, $layout);
        $Email->emailFormat('html');
        $Email->viewVars(array('baseURL' => Router::url('/', true), 'data'=>$data));
        return $Email->send();
    }

    function sendEmailContact($data, $template = null, $layout = null) {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('smtp');
        $layout = !empty($layout) ? $layout : 'email';
        $template = !empty($template) ? $template : 'default';
        $Email->to($data['email']);
        $Email->subject($data['subject']);
        $Email->from(array('contacto@conecciones.net' => 'AIMAX'));
        $Email->template($template, $layout);
        $Email->emailFormat('html');
        $Email->viewVars(array('baseURL' => Router::url('/', true), 'data'=>$data));
        return $Email->send();
    }

    function setLanguage() {
        $lang = !empty($this->Session->read('User.lang')) ? $this->Session->read('User.lang') : $this->Session->read('Language.lang');

        if(!$lang) {
            if(!empty($this->Cookie->read('Language.lang'))) {
                $lang  = $this->Cookie->read('Language.lang');
            } else {
                //$currLang = $this->getBrowserLanguage();
                $currLang = 'es';
                switch ($currLang) {
                    case 'en':
                        $lang = 'eng';
                        break;
                    case 'es':
                    default:
                        $lang = "spa";
                        break;
                }

                $this->Cookie->write('Language', array(
                    'lang' => $lang,
                    'label' => $this->languages[ $lang ]
                ));
            }
            $this->Session->write('Language', array(
                'lang' => $lang,
                'label' => $this->languages[ $lang ]
            ));
        }

        Configure::write('Config.language', $lang);
        $this->set(compact('lang'));
    }

    function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '1234567890';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    function xml2array ( $xmlObject, $out = array () )
    {
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? $this->xml2array ( $node ) : $node;

        return $out;
    }

    function getOS() { 
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Unknown OS Platform";
        $os_array     = array(
                              '/windows nt 10/i'      =>  'Windows 10',
                              '/windows nt 6.3/i'     =>  'Windows 8.1',
                              '/windows nt 6.2/i'     =>  'Windows 8',
                              '/windows nt 6.1/i'     =>  'Windows 7',
                              '/windows nt 6.0/i'     =>  'Windows Vista',
                              '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                              '/windows nt 5.1/i'     =>  'Windows XP',
                              '/windows xp/i'         =>  'Windows XP',
                              '/windows nt 5.0/i'     =>  'Windows 2000',
                              '/windows me/i'         =>  'Windows ME',
                              '/win98/i'              =>  'Windows 98',
                              '/win95/i'              =>  'Windows 95',
                              '/win16/i'              =>  'Windows 3.11',
                              '/macintosh|mac os x/i' =>  'Mac OS X',
                              '/mac_powerpc/i'        =>  'Mac OS 9',
                              '/linux/i'              =>  'Linux',
                              '/ubuntu/i'             =>  'Ubuntu',
                              '/iphone/i'             =>  'iPhone',
                              '/ipod/i'               =>  'iPod',
                              '/ipad/i'               =>  'iPad',
                              '/android/i'            =>  'Android',
                              '/blackberry/i'         =>  'BlackBerry',
                              '/webos/i'              =>  'Mobile'
                        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }

    function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        = "Unknown Browser";
        $browser_array = array(
                                '/msie/i'      => 'Internet Explorer',
                                '/firefox/i'   => 'Firefox',
                                '/safari/i'    => 'Safari',
                                '/chrome/i'    => 'Chrome',
                                '/edge/i'      => 'Edge',
                                '/opera/i'     => 'Opera',
                                '/netscape/i'  => 'Netscape',
                                '/maxthon/i'   => 'Maxthon',
                                '/konqueror/i' => 'Konqueror',
                                '/mobile/i'    => 'Handheld Browser'
                         );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        return $browser;
    }

    function getBrowserLanguage() {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        return $lang;
    }

    function getBrowserCountry() {
        App::import('Vendor','geoip',array('file' => 'geoip/autoload.php')); 
        $geoIP = new GeoIp2\Database\Reader(APP.'GeoIP/countries.mmdb');
        $ip = $_SERVER['REMOTE_ADDR'];
        try {
            $row = $geoIP->country($ip);
        } catch(Exception $e) {
            // Si no se encuentra una IP valida estirar null
            $row = null;
        }
        return !empty($row) ? $row->country->isoCode : null;
    }

    function parseCSV($file) {
        $rows = array();
        $row = 1;
        if (($handle = fopen($file, "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            for ($c=0; $c < $num; $c++) {
                $rows[$row][] = $data[$c];
            }
          }
          fclose($handle);
        }
        return $rows;
    }

    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->utf8ize($v);
            }
        } else if (is_string ($d)) {
            return iconv(mb_detect_encoding($d), "UTF-8", $d);
            //return utf8_encode($d);
        }
        return $d;
    }

    function renderAPI($reply, $method) {
        $reply['last_update'] = date('Y-m-d H:i:s');
        // $this->log(print_r($reply, true), 'api');
        return $method == 'xml' ? $this->renderXML($reply) : $this->renderJson($reply);
    }
    
    function renderJson($reply) {
        $this->layout = 'json';
        $this->set(compact('reply'));
        $this->render('../Pages/json');
    }
    function apiResponse($code = '') {
        return $this->ajaxResponse($code);
    }
    
    function ajaxResponse($code = '') {
        switch ($code) {
            case '401':
            case 'unauthorized':
                return array(
                    'code' => '401',
                    'status' => 'error',
                    'message' => __('Unauthorized', true)
                );
            case 'no-input':
            case '405':
                return array(
                    'code' => '405',
                    'status' => 'error',
                    'message' => __('No input data', true)
                );
            case 'not-found':
            case '404':
                return array(
                    'code' => '404',
                    'status' => 'error',
                    'message' => __('Not found', true)
                );
            case 'ok':
            case '200':
                return array(
                    'code' => '200',
                    'status' => 'ok'
                );
            
            default:
                return array(
                    'code' => '400',
                    'status' => 'error',
                    'message' => __('Undefined Error', true)
                );
        }
    }

    function renderXML($reply) {
        $this->layout = 'json';
        $reply = array('reply'=>$reply);
        $this->set(compact('reply'));
        $this->render('../Pages/xml_reply');
    }

    function upload($table, $field) {
        return;
    }

    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
