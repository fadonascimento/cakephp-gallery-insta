<?php 
App::uses('FormHelper', 'View/Helper');

/**
 * Extendendo as funcionalidades do FormHelper
 * 
 */
class InstagramFormHelper extends FormHelper {


	/**
	* Adicionado as classes do Bootstrap nos metodos do FormHelper
	*
	*/
  	public function create($model = null, $options = array())
	{
		$optionsDefault = array();
		$options = array_merge($optionsDefault, $options);
		return parent::create($model, $options);
	}
	
	public function input($fieldName, $options = array())
	{	
		$options = $this->addClass($options,'form-control');

		if (empty($options['div']) || $options['div'] !== false) {
			$optionsDefault = array('div'=>'form-group');
			$options = array_merge_recursive($optionsDefault, $options);
			if (sizeof($options['div']) > 1) {
				$options['div'] = join(' ',$options['div']);
			}
		}

		if (!isset($options['placeholder'])) {
			$label = (isset($options['label'])) ? $options['label'] : Inflector::humanize($fieldName);
			$options['placeholder'] = $label;
		}

		if (isset($options['helpText'])) {
			$options['after'] ='<span class="help-block">' . $options['helpText'] . '</span>';
		}

		if (isset($options['type']) && $options['type'] === 'radio') {
			unset($options['class']);
		}

		return parent::input($fieldName, $options);
	}

	public function textarea($fieldName, $options = array()) {
		$optionsDefault = array('class'=>'form-control');
		$options = array_merge_recursive($optionsDefault, $options);
		return parent::textarea($fieldName, $options);
	}

	public function end($string = null,$options = array()) {
		
		if ($string === false) {
			return parent::end();
		}

		if (is_null($string)) {
			$string = __('Salvar');
		}

		$optionsDefault = array('class'=>'btn btn-primary','div'=>'form-group');
		$options = array_merge_recursive($optionsDefault, $options);

		$retorno  = parent::submit($string,$options);
		$retorno .= parent::end();
		return $retorno;
	}

	
}