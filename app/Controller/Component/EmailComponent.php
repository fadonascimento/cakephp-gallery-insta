<?php 
/**
 * Gerenciamento de e-mails e fila para envio em massa
 * 
 */

App::uses('CakeEmail', 'Network/Email');
App::uses('Config', 'Config');


class EmailComponent extends Component {

	public $configuracoes = array();

	/**
	 * Construtor
	 */
	public function __construct(ComponentCollection $collection, $configuracoes = array()) {
		// Configurações iniciais
		$this->configuracoes['de'] 		= Config::emailContato();
		$this->configuracoes['assunto'] = '';
		$this->configuracoes['layout'] 	= 'default';
		
		parent::__construct($collection, array_merge($this->configuracoes, $configuracoes));
	}
	
	/**
	 * Inicializador
	 * @see Component::initialize()
	 */
	public function initialize(Controller $controller) {
		$this->Controller = $controller;
	}

	/**
	 * Novo e-mail na fila
	 * 
	 * $configuracoes = array(['de'], 'para', 'assunto', 'mensagem', ['layout']);
	 * 
	 */
	public function novo($configuracoes) {
		$this->Controller->loadModel('Manager.Email');
		$this->configuracoes = array_merge($this->configuracoes, $configuracoes);
		$email['Email'] = $this->configuracoes;
		return $this->Controller->Email->save($email);
	}

}