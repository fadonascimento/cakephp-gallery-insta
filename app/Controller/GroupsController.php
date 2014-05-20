<?php
App::uses('AppController', 'Controller');

/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

	// var $scaffold;

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->flashSucesso(__('Grupo salvo com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->flashErro(__('Falha ao salvar o Grupo. Por favor tente novamente.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Grupo Inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->flashSucesso(__('Grupo deletado com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->flashErro(__('Falha ao editar o Grupo. Por favor tente novamente.'));
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Grupo Inválido'));
		}
		if ($this->Group->delete()) {
			$this->flashSucesso(__('Grupo deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->flashErro(__('Falha ao deletar o Grupo'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * Define as permissões de cada grupo
 */
	// public function resetPermissions() {
	// 	$Group = $this->Group;

	// 	// Administradores podem tudo
	// 	$Group->id = $Group->field('id', array('name' => 'Administradores'));
	// 	$this->Acl->allow($Group, 'controllers');

	// 	// Moderadores só têm acesso à listagem, cadastro e edição de posts
	// 	$Group->id = $Group->field('id', array('name' => 'Moderadores'));
	// 	$this->Acl->deny($Group, 'controllers');
	// 	$this->Acl->allow($Group, 'controllers/Posts/index');
	// 	$this->Acl->allow($Group, 'controllers/Posts/view');
	// 	$this->Acl->allow($Group, 'controllers/Posts/add');
	// 	$this->Acl->allow($Group, 'controllers/Posts/edit');

	// 	$this->Session->setFlash('Permissões atualizadas');
	// 	$this->redirect(array('controller' => 'users', 'action' => 'index'));
	// }
}
