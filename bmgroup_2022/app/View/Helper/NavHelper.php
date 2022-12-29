<?php
App::uses('Inflector', 'Utility');
class NavHelper extends Helper {

	public $helpers = array("Html", "Javascript", "Form");
	public $topSelected = '';
	public $months = array(
		'January' => 'Enero',
		'February' => 'Febrero',
		'March' => 'Marzo',
		'April' => 'Abril',
		'May' => 'Mayo',
		'June' => 'Junio',
		'July' => 'Julio',
		'August' => 'Agosto',
		'September' => 'Septiembre',
		'October' => 'Octubre',
		'November' => 'Noviembre',
		'December' => 'Diciembre'
	);


	function gencss() {
		$this->Session = new CakeSession;
		$bgcolor = !empty($this->Session->read('User.color')) ? $this->Session->read('User.color') : '#3ac9d6';
		$this->_View->set('bgcolor', $bgcolor);
		return $this->_View->element('css');
	}

	function date($date, $format = null) {
		if(!$format) {
			$this->Controller = new AppController;
			$format = $this->Controller->dateFormat;
		}
		return date($format, strtotime($date));
	}

	function form($model = null, $options = array()) {
		if(!empty($model)) {
			$options['model'] = $model;
			App::import('Model', $model);
			$this->{$model} = new $model;
			if(!empty($this->{$model}->virtualFields)) {
				$items = array();
				foreach($this->{$model}->virtualFields as $column => $value) {
					if(strpos($column, "custom_") !== false) {
						$items[$column] = array(
							'label' => __(Inflector::humanize(str_replace("custom_","",$column))),
							'cols' => 6
						);						
					}
				}
				if(!empty($items)) {
					$options['groups'][] = array(
						'title' => 'Campos Personalizados',
						'desc' => 'Campos Personalizados',
						'items' => $items
					);					
				}
			}
		}

		$this->_View->set('options', $options);
		return $this->_View->element('form/form');
	}

	function filter($filter, $options = array()) {
		$this->_View->set('options', $options);
		$this->_View->set('filter', $filter);
		return $this->_View->element('filter/_filter');
	}

	function toplink($options) {
		if(empty($options['filter'])) {
			$options['filter'] = 'empty';
		}
		return $this->filter($options['filter'], $options);
	}

	function buttonList($options = array()) {
		$this->_View->set('options', $options);
		return $this->_View->element('buttonlist');
	}

	function paginator($options = array()) {
		$this->_View->set('options', $options);
		return $this->_View->element('paginator');
	}

	function css($url, $options = array()) {
		if(empty($options['fullBase'])) {
			$options['fullBase'] = true;
		}
		return $this->Html->css($url, $options);
	}

	function script($url, $options = array()) {
		if(empty($options['fullBase'])) {
			$options['fullBase'] = true;
		}
		return $this->Html->script($url, $options);
	}

	function url($url = NULL, $full = true) {
		return $this->Html->url($url, $full);
	}

	function image($path, $options = array()) {
		if(empty($options['fullBase'])) {
			$options['fullBase'] = true;
		}
		return $this->Html->image($path, $options);
	}

	function social_link($text, $network, $label, $options) {
		$url = $this->social($network,$label);
		return $this->Html->link($text, $url, $options);
	}

	function social($network, $label) {
		switch ($network) {
			case 'facebook':
				if(preg_match('/(http|https):\/\/(www\.|)facebook\.com\/(.*)/',$label)) {
					return $this->Html->url($label);
				} else {
					return $this->Html->url("https://facebook.com/".$label);
				}
				break;
			case 'twitter':
				if( strpos($label, "@") !== false ) {
					$label = str_replace("@","",$label);
					return $this->Html->url("https://twitter.com/".$label);
				} else {
					if(preg_match('/(http|https):\/\/(www\.|)twitter\.com\/(.*)/',$label)) {
						return $this->Html->url($label);
					} else {
						return $this->Html->url("https://twitter.com/".$label);
					}
				}
				break;
			default:
				return 'http://google.com';
				break;
		}
	}

	function link($label, $url, $ops = array()) {
		$label = __($label);
		if( $this->params['action'] == $url['action'] && $this->params['controller'] == $url['controller']) {
			$ops['class'] = !empty($ops['class']) ? $ops['class'].' active' : 'active';
		}

		if(!empty($ops['confirm'])) {
			$ops['confirm'] == __($opt['confirm']);
		}

		if($this->perms(array('controller'=>$url['controller'],'action'=>$url['action']))) {
			return $this->Html->link($label, $url, $ops);
		} else {
			$ops['class'] = !empty($ops['class']) ? $ops['class'] . " disabled" : "disabled";
			$ops['data-toggle'] = 'tooltip';
			$ops['data-placement'] = 'top';
			$ops['data-original-title'] = __('Acceso denegado');
			return $this->Html->link($label, 'javascript:void(0)', $ops);
		}
		return '';
	}

	function linkicon($label, $icon, $url, $ops = array()) {
		$ops['data-toggle']="tooltip";
		$ops['data-placement']="top";
		$ops['title']="";
		$ops['data-original-title']=__($label);
		$html = '<a';
		foreach($ops as $op => $value) {
			if($op == 'confirm') {
				$value = __($value);
				$html .= ' onclick="return confirm(\''.$value.'\')" ';
			} else {
				$html .= " {$op}=\"{$value}\" ";
			}
		}
		$html .= " href=\"".Router::url($url)."\"><i class=\"".$icon."\"></i></a>";

		if(!$this->perms(array('controller'=>$url['controller'],'action'=>$url['action']))) {
			return '';
		}

		return $html;
	}

	function slink($label, $url, $ops = array()) {
		$ops['class'] = !empty($ops['class']) ? $ops['class'].' sidebar-menu-button' : 'sidebar-menu-button';
		// $ops['class'] .= ' '.;

		$html = '<a';
		foreach($ops as $op => $value) {
			if($op == 'confirm') {
				$value = __($value);
				$html .= ' onclick="return confirm(\''.$value.'\')" ';
			} else {
				$html .= " {$op}=\"{$value}\" ";
			}
		}
		$html .= " href=\"".Router::url($url)."\"><span class=\"sidebar-menu-text\">{$label}</span></a>";

		if(!$this->perms(array('controller'=>$url['controller'],'action'=>$url['action']))) {
			return '';
		}

		return $html;
	}

	function perms($url) {                   
		if (isset($url['admin']) && $url['admin'])
			$url['action'] = 'admin_' . $url['action'];

		if (!isset($url['controller']))
			$url['controller'] = $this->params['controller'];
			
		if (!isset($url['action']))
			$url['controller'] = $this->params['action'];

		$url['controller'] = str_replace("_", "", $url['controller']);

        App::import('Component', 'Perms');
		$this->Perms = new PermsComponent;

		return $this->Perms->check(false, $url);
	}

	function checkTag($tag) {
		$this->Session = new CakeSession;
		
        App::import('Component', 'Perms');
		$this->Perms = new PermsComponent;

		return $this->Perms->checkTag($tag);
	}

	function isSU() {
        App::import('Component', 'Perms');
		$this->Perms = new PermsComponent;

		return $this->Perms->isSU();
	}

	function getDivision($year) {
        App::import('Component', 'Pokeadmin');
		$this->Pokeadmin = new PokeadminComponent;

		return $this->Pokeadmin->getDivision($year);
	}

	function unidad($numuero){
		$numuero = round($numuero);
		// die($numuero);
		$numu = "";
	switch ($numuero)
	{
	case 9:
	{
	$numu = "NUEVE";
	break;
	}
	case 8:
	{
	$numu = "OCHO";
	break;
	}
	case 7:
	{
	$numu = "SIETE";
	break;
	}
	case 6:
	{
	$numu = "SEIS";
	break;
	}
	case 5:
	{
	$numu = "CINCO";
	break;
	}
	case 4:
	{
	$numu = "CUATRO";
	break;
	}
	case 3:
	{
	$numu = "TRES";
	break;
	}
	case 2:
	{
	$numu = "DOS";
	break;
	}
	case 1:
	{
	$numu = "UN";
	break;
	}
	case 0:
	{
	$numu = "";
	break;
	}
	}
	return $numu;
	}

	function decena($numdero){

		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".($this->unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".($this->unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".($this->unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".($this->unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".($this->unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".($this->unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".($this->unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE ";
			else
				$numd = "VEINTI".($this->unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
				case 10:
				{
					$numd = "DIEZ ";
					break;
				}
				case 11:
				{
					$numd = "ONCE ";
					break;
				}
				case 12:
				{
					$numd = "DOCE ";
					break;
				}
				case 13:
				{
					$numd = "TRECE ";
					break;
				}
				case 14:
				{
					$numd = "CATORCE ";
					break;
				}
				case 15:
				{
					$numd = "QUINCE ";
					break;
				}
				case 16:
				{
					$numd = "DIECISEIS ";
					break;
				}
				case 17:
				{
					$numd = "DIECISIETE ";
					break;
				}
				case 18:
				{
					$numd = "DIECIOCHO ";
					break;
				}
				case 19:
				{
					$numd = "DIECINUEVE ";
					break;
				}
			}
		}
		else
			$numd = $this->unidad($numdero);
		return $numd;
	}

	function centena($numc){
		$numce = '';
		if ($numc >= 100)
		{
			if ($numc >= 900 && $numc <= 999)
			{
				$numce = "NOVECIENTOS ";
				if ($numc > 900)
					$numce = $numce.($this->decena($numc - 900));
			}
			else if ($numc >= 800 && $numc <= 899)
			{
				$numce = "OCHOCIENTOS ";
				if ($numc > 800)
					$numce = $numce.($this->decena($numc - 800));
			}
			else if ($numc >= 700 && $numc <= 799)
			{
				$numce = "SETECIENTOS ";
				if ($numc > 700)
					$numce = $numce.($this->decena($numc - 700));
			}
			else if ($numc >= 600 && $numc <= 699)
			{
				$numce = "SEISCIENTOS ";
				if ($numc > 600)
					$numce = $numce.($this->decena($numc - 600));
			}
			else if ($numc >= 500 && $numc <= 599)
			{
				$numce = "QUINIENTOS ";
				if ($numc > 500)
					$numce = $numce.($this->decena($numc - 500));
			}
			else if ($numc >= 400 && $numc <= 499)
			{
				$numce = "CUATROCIENTOS ";
				if ($numc > 400)
					$numce = $numce.($this->decena($numc - 400));
			}
			else if ($numc >= 300 && $numc <= 399)
			{
				$numce = "TRESCIENTOS ";
				if ($numc > 300)
					$numce = $numce.($this->decena($numc - 300));
			}
			else if ($numc >= 200 && $numc <= 299)
			{
				$numce = "DOSCIENTOS ";
				if ($numc > 200)
					$numce = $numce.($this->decena($numc - 200));
			}
			else if ($numc >= 100 && $numc <= 199)
			{
				if ($numc == 100)
					$numce = "CIEN ";
				else
					$numce = "CIENTO ".($this->decena($numc - 100));
			}
		}
		else
			$numce = $this->decena($numc);

		return $numce;
	}

	function miles($nummero){
		if ($nummero >= 1000 && $nummero < 2000){
			$numm = "MIL ".($this->centena($nummero%1000));
		}
		if ($nummero >= 2000 && $nummero <10000){
			$numm = $this->unidad(Floor($nummero/1000))." MIL ".($this->centena($nummero%1000));
		}
		if ($nummero < 1000)
			$numm = $this->centena($nummero);

		return $numm;
	}

	function decmiles($numdmero){
		if ($numdmero == 10000)
			$numde = "DIEZ MIL";
		if ($numdmero > 10000 && $numdmero <20000){
			$numde = $this->decena(Floor($numdmero/1000))."MIL ".($this->centena($numdmero%1000));
		}
		if ($numdmero >= 20000 && $numdmero <100000){
			$numde = $this->decena(Floor($numdmero/1000))." MIL ".($this->miles($numdmero%1000));
		}
		if ($numdmero < 10000)
			$numde = $this->miles($numdmero);

		return $numde;
	}

	function cienmiles($numcmero){
	if ($numcmero == 100000)
	$num_letracm = "CIEN MIL";
	if ($numcmero >= 100000 && $numcmero <1000000){
	$num_letracm = $this->centena(Floor($numcmero/1000))." MIL ".($this->centena($numcmero%1000));
	}
	if ($numcmero < 100000)
	$num_letracm = $this->decmiles($numcmero);
	return $num_letracm;
	}

	function millon($nummiero){
	if ($nummiero >= 1000000 && $nummiero <2000000){
	$num_letramm = "UN MILLON ".($this->cienmiles($nummiero%1000000));
	}
	if ($nummiero >= 2000000 && $nummiero <10000000){
	$num_letramm = $this->unidad(Floor($nummiero/1000000))." MILLONES ".($this->cienmiles($nummiero%1000000));
	}
	if ($nummiero < 1000000)
	$num_letramm = $this->cienmiles($nummiero);

	return $num_letramm;
	}

	function decmillon($numerodm){
	if ($numerodm == 10000000)
	$num_letradmm = "DIEZ MILLONES";
	if ($numerodm > 10000000 && $numerodm <20000000){
	$num_letradmm = $this->decena(Floor($numerodm/1000000))."MILLONES ".($this->cienmiles($numerodm%1000000));
	}
	if ($numerodm >= 20000000 && $numerodm <100000000){
	$num_letradmm = $this->decena(Floor($numerodm/1000000))." MILLONES ".($this->millon($numerodm%1000000));
	}
	if ($numerodm < 10000000)
	$num_letradmm = $this->millon($numerodm);

	return $num_letradmm;
	}

	function cienmillon($numcmeros){
	if ($numcmeros == 100000000)
	$num_letracms = "CIEN MILLONES";
	if ($numcmeros >= 100000000 && $numcmeros <1000000000){
	$num_letracms = $this->centena(Floor($numcmeros/1000000))." MILLONES ".($this->millon($numcmeros%1000000));
	}
	if ($numcmeros < 100000000)
	$num_letracms = $this->decmillon($numcmeros);
	return $num_letracms;
	}

	function milmillon($nummierod){
	if ($nummierod >= 1000000000 && $nummierod <2000000000){
	$num_letrammd = "MIL ".($this->cienmillon($nummierod%1000000000));
	}
	if ($nummierod >= 2000000000 && $nummierod <10000000000){
	$num_letrammd = $this->unidad(Floor($nummierod/1000000000))." MIL ".($this->cienmillon($nummierod%1000000000));
	}
	if ($nummierod < 1000000000)
	$num_letrammd = $this->cienmillon($nummierod);

	return $num_letrammd;
	}


	function num2letras($numero){
		$numf = $this->milmillon($numero);

		/*if(strpos($numero,".")!==false) {
			$cent = explode(".",$numero);
			$numf.= " CON ".$this->milmillon($cent[1]);
		}*/

		return trim($numf);
	}

	function money($numero) {
		return number_format($numero, 0, ",", ".").".-";
	}

	function fecha($date) {
		$fecha = explode("-", $date);
		$months = array(
			'01' => 'Enero',
			'02' => 'Febrero',
			'03' => 'Marzo',
			'04' => 'Abril',
			'05' => 'Mayo',
			'06' => 'Junio',
			'07' => 'Julio',
			'08' => 'Agosto',
			'09' => 'Septiembre',
			'10' => 'Octubre',
			'11' => 'Noviembre',
			'12' => 'Diciembre',
		);
		return "........ de ................. de ".$fecha[0].".-";
		//return (int)$fecha[2]." de ".$months[$fecha[1]]." de ".$fecha[0].".-";
	}

	function fecha2($date) {
		$fecha = explode("-", $date);
		$months = array(
			'01' => 'Enero',
			'02' => 'Febrero',
			'03' => 'Marzo',
			'04' => 'Abril',
			'05' => 'Mayo',
			'06' => 'Junio',
			'07' => 'Julio',
			'08' => 'Agosto',
			'09' => 'Septiembre',
			'10' => 'Octubre',
			'11' => 'Noviembre',
			'12' => 'Diciembre',
		);
		//return "........................ de ...................... de ".$fecha[0].".-";
		return (int)$fecha[2]." de ".$months[$fecha[1]]." de ".$fecha[0].".-";
	}

	function price($amount) {
		return $this->priceGs($amount);
	}

	function priceGs($amount) {
		return "₲ ".number_format($amount, 0, ",", ".");
	}

	function priceUSS($amount) {
		$amount = $this->convertPrice($amount, 'DÓLAR');
		return "US$ ".number_format($amount, 2, ".", ",");
	}

	function convertPrice($amount, $currency) {
		$url = "http://cotizext.maxicambios.com.py/maxicambios.xml";
		$xml = simplexml_load_file($url);
		foreach($xml as $element) {
			if($element->nombre == $currency)
				return $amount / $element->compra;
		}

		return 0;
	}

	function getYoutubeId($url) {
		if(strpos($url, ",")!==false) {
			$link = explode(",", $url);
		} else {
			$link[] = $url;
		}

		$regex = '/(https|http):\/\/(www.|)youtube\.com\/watch\?v=([\w\-]{10,12})\b/';
		$ids = array();
		foreach($link as $l) {
			preg_match($regex, $l, $output);
			$ids[] = end($output);
		}

		return $ids;
	}

	function isActive($params, $controller, $action = null) {
		if(!empty($action)) {
			return $params->controller == $controller && $params->action == $action ? 'active' : '';
		} else {
			return $params->controller == $controller ? 'active' : '';
		}
	}

	function isActiveBool($params, $controller, $action = null) {
		if(!empty($action)) {
			return $params->controller == $controller && $params->action == $action;
		} else {
			return $params->controller == $controller;
		}
	}

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}

	
	function formatDate($timestamp) {
		$date = date("d-F-Y", strtotime($timestamp));
		$dateArr = explode("-", $date);
		$month = $this->months[ $dateArr[1] ];
		$strDate = "{$month} {$dateArr[0]}, {$dateArr[2]}";
		return $strDate;
	}

}
?>
