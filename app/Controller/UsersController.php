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
		
		//$exames = $this->User->getAgenda();

		
	}

	public function index()
	{
		$this->User->recursive = 0;
		$options = array('conditions'=> array('User.id !=' => 1));
		$this->paginate = $options;       
		$this->set('users', $this->paginate('User'));
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				return $this->flashSucesso(__('Usuário salvo com sucesso.'),array('action' => 'index'));
			} 
			return $this->flashErro(__('Falha ao salvar o usuário, por favor tente novamente'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null)
	{
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuário inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				return $this->flashSucesso(__('Usuário salvo com sucesso'),array('action' => 'index'));
			}
			return $this->flashErro(__('Falha ao salvar o usuário, por favor tente novamente'));
		} 
		$this->User->contain('Group');
		$user = $this->User->find('first', array('recursive' => -1,'conditions'=>array('User.id' => $id)));
		unset($user['User']['senha']);
		$this->request->data = $user;
		
		// $groups = $this->User->Group->find('list');
		// $user = AuthComponent::user();
		// if ($user['Group']['id'] != 1) {
		// 	$gruposPermitidos = $this->User->grupos[$user['Group']['name']];
		// 	foreach ($groups as $key => $value) {
		// 		if (in_array($value,$gruposPermitidos))
		// 		$r[$key] = $value;
		// 	}
		// 	$groups = $r;
		// }
		// $this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->User->delete()) {
			$this->flashSucesso(__('Usuário deletado com sucesso.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->flashErro(__('Falha ao deletar o usuário.'));
		$this->redirect(array('action' => 'index'));
	}


	//	adicionando usuário administrador
	public function adicionar()
	{
		
	  $this->User->save(array(
	    'nome'=>'Administrador RS',
	    'email'=>'admin@admin.com',
	    'senha'=>'admin',
	    ));
	}
}
