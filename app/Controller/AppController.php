<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $isMobile = false;
	public $isTablet = false;
	public $isFront;
	public $baseUrl;
	public $user; 
	public $helpers = array('Minify','Image','Form'=>array('className'=> 'InstagramForm')); 
	public $components = array('Session', 'Auth', 'Acl');//,'MenuAcl');

	/**
	 * Verifica se é o prefixo
	 * 
	 * @param string $prefix Prefixo que será testado
	 * @return bool
	 */
	public function isPrefix($prefix) {
		return isset($this->request->params['prefix']) && $this->request->params['prefix'] == $prefix;
	}

	/**
	 * Verifica se é a extensão
	 * 
	 * @param string $ext extensão que será testada
	 * @return bool
	 */
	public function isExt($ext) {
		return isset($this->request->params['ext']) && $this->request->params['ext']==$ext;
	}

	/**
	*	Verifica se é a pagina inicial ou não	
	*  
	*	@return bool
	* */
	public function isFront() {
		return $this->request->params['controller']==='pages' && $this->request->params['action']=='display';
	}

	/**
	 * Before filter method
	 * 
	 */
	public function beforeFilter() {

		$this->isFront = $this->isFront();
		$this->baseUrl = Router::url('/',true);

		// Campo de login é 'email' (e não 'username')
		$this->Auth->authenticate = array(
			'Form' => array(
				'userModel' => 'User',
				'fields' => array(
					'username' => 'email',
					'password' => 'password')));

		$this->Auth->loginAction = array(
								'controller' => 'users',
								'action' => 'login');

		// Verifica permissões no nível de actions
		$this->Auth->authorize = array('Actions' => array(
			'actionPath' => 'controllers/'
		));

		$this->Auth->loginRedirect = array('controller'=>'users','action'=>'dashboard');
		$this->Auth->authError = __('Você não está autorizado a acessar essa página.');

		// Libera o acesso à toda a aplicação
		//$this->Auth->allow();
 	}

 	public function responseJson($valores=array()) {
 		$this->autoRender = false;
 		$this->response->body(json_encode($valores));
 		return true;
 	}

 	public function responseJsonErro($mensagem='') {
 		$erro = array('erro'=>$mensagem);
 		return $this->responseJson($erro);
 	}

	/**
	 * Before render convencional
	 * 
	 */
	public function beforeRender() {

		/**
		 * Acrescenta classes no body
		 * o controller e verifica se eh front e not-front
		 * 
		*/
		if ($this->isFront) {
			$this->bodyClass = 'front';
		} else {
			$this->bodyClass = 'not-front';
		}
		
		/**
		*	Carrega os Models que serão utilizados
		*/
		if (!$this->Formulario) {
			$this->loadModel('Formulario');
		}

		/**
		*  Carrega o Usuario atual para exibir na view
		*/
		$this->user = AuthComponent::user();

				
		// gerais
		$this->set(array(
			'user' => $this->user,
			'is_front' 	 => $this->isFront,
			'body_class' => strtolower($this->bodyClass),
			'base_url'	 => $this->baseUrl
		));
		
		/**
		 * Quando for chamado uma view basta passar .ajax como extensão para
		 * que somente o conteúdo da view venha tipo overlay do Drupal
		 */
		if ($this->isExt('ajax')) {
			$this->layout = 'ajax'; 
		}

		if ($this->isExt('form')) {
			$this->layout = 'ajax_form'; 
		}
	}


	public function flashErro($mensagem = '', $redirecionamento = false) 
	{

		if ($this->isExt('ajax') || $this->request->is('ajax')) {
			return $this->fullResponse($mensagem);
		}
		$this->Session->setFlash($mensagem, 'flash/error');
		if ($redirecionamento) {
			if (!is_array($redirecionamento)) {
				$redirecionamento = desmascararURL($redirecionamento);
			}
			$this->redirect($redirecionamento);
		}
	}

	public function flashSucesso($mensagem = '', $redirecionamento = false) 
	{

		if ($this->isExt('ajax') || $this->request->is('ajax')) {
			return $this->fullResponse($mensagem);
		}
		$this->Session->setFlash($mensagem, 'flash/success');
		if ($redirecionamento) {
			if (!is_array($redirecionamento)) {
				$redirecionamento = desmascararURL($redirecionamento);
			}
			$this->redirect($redirecionamento);
		}
	}

	public function fullResponse($dados)
	{	
		$this->autoRender = false;
		return $this->response->body = $dados;
	}

	public function jsonResponse($dados)
	{
		return $this->fullResponse(json_encode($dados));
	}
}
