<?php 
App::uses('HtmlHelper', 'View/Helper');

/**
 * Extendendo as funcionalidades do HtmlHelper
 * Para toda a aplicação deveremos utilizar somente
 * essa classe ao invés de utilizar o HtmlHelper
 * 
 */
class FammaHelper extends HtmlHelper {

	var $helpers = array('Form','Image');

	function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);

		// if (!$this->cliente) {
		// 	$this->cliente = (isset($View->viewVars['cliente']))?$View->viewVars['cliente']:null;
		// }

	}

	/**
	 * Gera um select que se transforma em input
	 * quando selecionado a opção outro
	 * 
	 * @param string $fieldName This should be "Modelname.fieldname"
	 * @param array $options Each type of input takes different options.
	 * @return string Completed form widget.
	 */
	public function selectWithOther($fieldName, $options = array())
	{	
		// select
		$class = (!empty($options['class'])) ? $options['class'] : null;
		$options['class'] 	= 'select-with-other form-control' . $class;
		if (!isset($options['label'])) {
			$options['label'] = false;
		}
		if (empty($options['type'])) {
			$options['type'] = 'select';
		}
		$options['div'] = false;
		$options['options'][0] = 'Outro';

		$fieldNameInput = str_replace('id', 'nome', $fieldName); // name input
		$options['data-next-id'] =  $this->getNameInput($fieldNameInput);;
		
		$select = $this->Form->input($fieldName, $options);

		// input
		$inputOptions['before'] = $select;
		$inputOptions['data-next-id'] = $this->getNameInput($fieldName);
		$inputOptions['after']	= '<a href="#" class="glyphicon glyphicon-transfer select-with-other-switch"></a>';
		$inputOptions['type'] 	= 'text';
		$inputOptions['class']	= 'select-with-other-input';
		$inputOptions['div']    = array('data-id' => $inputOptions['data-next-id']);
		$inputOptions['label'] 	= false;		
		return $this->input($fieldNameInput, $inputOptions);
	}

	// public function selectWithOther($fieldName, $options = array())
	// {	
	// 	$class = (!empty($options['class'])) ? $options['class'] : null;
	// 	$options['class'] = 'select-with-other form-control' . $class;
	// 	if (!isset($options['label'])) {
	// 		$options['label'] = false;
	// 	}
	// 	if (empty($options['type'])) {
	// 		$options['type'] = 'select';
	// 	}
	// 	$options['options'][0] = 'Outro';
	// 	return $this->Form->input($fieldName, $options);
	// }

	public function getNameInput($fieldName)
	{
		$name = explode('.', $fieldName);
		$name[sizeof($name) - 1] = Inflector::humanize(end($name));
		return implode($name);
	}
	
	public function create($model = null, $options = array())
	{
		$optionsDefault = array();
		$options = array_merge($optionsDefault, $options);
		return $this->Form->create($model, $options);
	}
	
	public function input($fieldName, $options = array())
	{
		$optionsDefault = array('class'=>'form-control','div'=> array('class' => 'form-group'));

		if (isset($options['type']) && $options['type'] == 'date') {
			$options['type'] = 'text';
			$optionsDefault = array('class'=>'form-control date','div'=>'form-group');
		}

		if (!isset($options['placeholder'])) {
			$label = (isset($options['label'])) ? $options['label'] : Inflector::humanize($fieldName);
			$options['placeholder'] = $label;
		}

		if (isset($options['help-text'])) {
			$options['after'] = '<span class="help-block">'. $options['help-text'] .'</span>';
		}

		$options = array_merge_recursive($optionsDefault, $options);
		if (sizeof($options['div']) > 1) {
			$options['div']['class'] = join(' ',$options['div']);
		}
		return $this->Form->input($fieldName, $options);
	}

	public function textarea($fieldName, $options = array()) {
		$optionsDefault = array('class'=>'form-control');
		$options = array_merge_recursive($optionsDefault, $options);
		return $this->Form->textarea($fieldName, $options);
	}

	public function end($string ='Enviar',$options = array()) {
		
		if (isset($options['wrapper']) AND !$options['wrapper']) {
			return $this->Form->end();
		}

		$optionsDefault = array('class'=>'btn btn-primary btn-lg','div'=>'form-group form-actions');
		$options = array_merge_recursive($optionsDefault, $options);
		
		// <div class="form-group form-actions"><input type="submit" value="Salvar" class="btn btn-primary btn-lg"></div>
		
		// $retorno  = $this->Form->submit($string,$options);
		$button   = $this->Form->button('Cancelar', array(
													'type' => 'reset',
													'class'=>'btn btn-default btn-lg btn-m-right cancel-form'));
		$button  .= $this->Form->button($string, array('type' => 'submit','class'=>'btn btn-primary btn-lg'));
		if (isset($options['after'])) {
			$button  .= $options['after'];
		}
		$retorno  = $this->div('form-group form-actions',$button);
		$retorno .= $this->Form->end();
		return $retorno;
	}

	public function hidden($fieldName, $options = array())
	{	
		$optionsDefault = array('class'=>'hidden','div'=> false,'label'=>false);
		$options = array_merge_recursive($optionsDefault, $options);
		return $this->Form->text($fieldName, $options);
	}

	public function inputs($fields = null, $blacklist = null, $options = array())
	{	
	
		$r = array();
		foreach ($fields as $key => $value) {
			 $r[$value] = array('div'=>'form-group','class'=>'form-control');
		}
		$fields = $r;
		return $this->Form->inputs($fields,$blacklist,$options);	
	}


	public function finputs($fiedsets = array())
	{
		// debug($fiedsets);
		$r = null;
		
		foreach ($fiedsets as $fieldset) {
			
			$header 	   = $fieldset['Fieldset']['header'];
			$fieldsetClass = $fieldset['Fieldset']['class'];
			$params 	   = array('legend' => false,'fieldset' => false);
			$fields 	   = array();
			
			if (!empty($header)) {
					$r .= $this->tag('h3',$header,array('class' => $fieldsetClass));
			}
			
			if (!empty($fieldset['Campo'])) {
				
				foreach ($fieldset['Campo'] as $id => $campo) {
					
					$name    = 'Valor.'.$fieldset['Fieldset']['formulario_id'] . '_' . $fieldset['Fieldset']['id'] . '_' . $campo['id'];
					$name    = 'Valor.'.$campo['id'];
					$tipo    = $campo['tipo'];
					$label   = (!empty($campo['label'])) ? $campo['label'] : false;
					$class   = (!empty($campo['class'])) ? $campo['class'] : '';
					$default = (!empty($campo['default'])) ? $campo['default'] : '';

					if(json_decode($tipo) != null) {
					
						$type = json_decode($tipo,true);
						if ($type['multiple']['type'] == 'select') {
							$type = $type['multiple'];
							$opcoes = array(
								'class' => 'form-control',
								'div' => 'form-group form-left space-19 '. $class,
								'type' => $type['type'],
								'default' => $default,
								'options' =>$type['options'],
							);
						} elseif ($type['multiple']['type'] == 'radio') {
							$type = $type['multiple'];
							$opcoes = array(
								'class' => 'radio',
								'div' => 'form-group form-radio '. $class,
								'type' => $type['type'],
								'options' =>$type['options'],
								'default' => $default,
								'legend' => $label,
							);
						}
				
					} elseif ($tipo == 'checkbox_textarea') {
						
						$novoTipo = explode('_',$tipo);
						$opcoes = array(
							'class' =>'campo checkbox',
							'checked' => $default,
							'div' => "form-group form-checkbox open-input ". $class,
							'type' => $novoTipo[0],
							'after' => $this->input($name . '_' . $novoTipo[1],array('div'=>'input-children ','label'=>false,'type'=>$novoTipo[1])),
	 					);

					} elseif ($tipo == 'checkbox_text') {
						
						$novoTipo = explode('_',$tipo);
						$opcoes = array(
							'class' =>'campo checkbox',
							'checked' => $default,
							'div' => "form-group form-checkbox open-input ". $class,
							'type' => $novoTipo[0],
							'after' => $this->input($name . '_' . $novoTipo[1],array('div'=>'input-children ','label'=>false,'type'=>$novoTipo[1])),
						);
					
					} elseif ($tipo == 'date') {
						
						$opcoes = array(
							'type'  => 'text',
							'class' => 'form-control date ', 
							// 'name'=> "data[Valor][date][".$campo['id']."]",
							'value' => date('d/m/Y'),
							);
					
					} elseif ($tipo == 'checkbox') {
						$opcoes = array(
							'type'  => $tipo,
							'class' => 'campo checkbox ',
							'checked' => $default,
							'div' => 'form-group form-checkbox '. $class
							);					
					
					} else {
						$opcoes = array(
							'type' => $tipo,
							'value'=> $default,
							);
					}

					$opcoesDefault = array(
						'class' => " form-control campo $name",
						'label' => $label,
						'div'=> 'form-group '. $class
					);

					// $opcoes = array_merge_recursive($opcoesDefault, $opcoes);
					$opcoes = array_merge($opcoesDefault,$opcoes);
					$fields[$name] = $opcoes;

				}

				if (!empty($fieldset['Fieldset']['legend'])) {
					$params = array(
						'legend'   => $fieldset['Fieldset']['legend'],
						'fieldset' => $fieldsetClass,
					);
				}
				$r .= $this->Form->inputs($fields,null,array('legend' => $params['legend'] ,'fieldset' => $params['fieldset'])); 
			}	
		}

		return $r;
	}
		
	public function linkDropDown($title, $url = null, $options = array(), $confirmMessage = false)
	{
		// $title .= ' <b class="caret"></b>';
		//$optionsDefault = array('class'=>'dropdown-toggle','data-toggle' =>'dropdown','escapeTitle'=>false);
		//$options =  array_merge($optionsDefault,$options);

		return $this->link($title,$url, $options);
	}
	/**
	 *	Cria o breadcrumb baseado num array com a lista de links
	 * 
	 *	$itens = array (
	 *		'titulo' 	=> 'link',
	 *		'titulo-2'	=> array('controller'=>'tal', 'action'=>'tal')
	 *	)
	 * 
	*/
	public function breadcrumb($itens) {
		$html = $this->link('Início', '//');
		// montando o breadcrumb
		$total = sizeof($itens);
		$cont = 0;
		$opcoes = null;
		foreach ($itens as $valor => $link) {
			$cont ++;
			$html .= ($html!='') ? ' &raquo; ' : '';
			if ($cont >= $total)
				$html .= $valor;
			else
				$html .= $this->link($valor,$link);
		}
		return $this->tag('div', $html, array('class'=>'breadcrumb'));
	}

	

	public function mensagem($titulo = '', $texto = '',$class = 'info') {
		$msg  = $this->Form->button('×',array('type'=>'button','class'=>'close','data-dismiss'=>'alert'));
		$msg .= $this->tag('h5', $titulo);
		$msg .= $this->tag('p', $texto);
		$html1  = $this->div('alert alert-' . $class ,$msg);
		return $html1;
	}	


	public function age($date,$tag = 'span',$suffix = 'anos')
	{	
		$date = date('Y-m-d', strtotime(str_replace( '/', '-',$date)));
		$birth = new DateTime($date); 
		$today = new DateTime('today');
		return $this->tag($tag, $birth->diff($today)->y . ' ' . $suffix);
	}

	/**
	 * Verifica se o link que foi passado e o mesmo que esta na url
	 * 
	 * @param string $link
	 * @return bool 
	 */
	public function isMenuAtivo($link) {

		$server 	= explode('/', $_SERVER['REQUEST_URI']);
		$request 	= '/' . end($server);
		$url 		= explode('/', $_SERVER['REQUEST_URI']);
		$controller = '/' .$this->request->params['controller'];

		if (isset($url[5])) {
			$request_url = '/'.$url[3].'/'.$url[4].'/'.$url[5];
		} else {
			$request_url = null;
		}

		$class = ($link == $request || $link == $request_url || $link == $controller)? true:false;
		return 	$class;
	}


}