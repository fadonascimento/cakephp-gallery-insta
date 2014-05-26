<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	var $scaffold;
/**
 * Antes de filtrar a requisição
 */
	public function beforeFilter() {
		// Libera o acesso às actions de login e logout
		$this->Auth->allow('login', 'logout');
		return parent::beforeFilter();
	}

/**
 * Login
 */
	public function login() {
		$this->layout = 'login';
		
		if ($this->Auth->login()){
			$this->redirect($this->Auth->redirectUrl());
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->flashErro('Usuário e/ou senha incorreto(s)');
			}
		}
	}

/**
 * Logout
 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
*	Area de Trabalho
* 
*/
	public function dashboard() {
		debug('dd');
		//$exames = $this->User->getAgenda();

		
	}

	public function addCustomer() {

		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)){
				return $this->flashSucesso(__('Salvo com sucesso'),array('action'=>'listCustomer'));
			}
			return $this->flashErro(__('Falha ao salvar tente novamente'));
		}
	}

	public function listCustomer() {
		$this->paginate = array(
			'recursive' => -1,
			'conditions' => array(
				'group_id' => CLIENTE,
			)
		);
		$this->set('customers', $this->paginate());
	}
}
