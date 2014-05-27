<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EventsController extends AppController {



	public function listModeration($eventId)
	{


		if ($this->request->is('post')) {




		}

		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $eventId));
		$event = $this->Event->find('first', $options);
		$event = $event['Event'];
		$tag = $event['tags'];
		$results = Cache::read("getTags_{$eventId}_{$tag}", 'default');
        debug($results);
        if (!$results) {
        	debug('nao foi cache');
			$HttpSocket = new HttpSocket();
			$results = json_decode($HttpSocket->get("https://api.instagram.com/v1/tags/$tag/media/recent?access_token=17844556.f59def8.1088003165514e1e8e562400fb0542c5")->body);
            debug($results);
            Cache::write("getTags_{$eventId}_{$tag}", $results, 'default');
        }
        
		
		$this->set(array(
						'event' => $event,
						'results' => $results->data,
						));
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$dados = $this->request->data;
			$dadosAlbum['Album'][0]['Album'] = array(
				'title' => $dados['Event']['tags'],
				'tags' => $dados['Event']['tags'],
			);
			// $dadosAlbum['Album'][1]['Album'] = array(
			// 	'title' => $dados['Event']['tags'],
			// 	'tags' => $dados['Event']['tags'],
			// );

			$dados = array_merge($dadosAlbum,$dados);
			//debug($dados);exit;
			$this->Event->create();
			if ($this->Event->saveAll($dados)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		}
		$customeres = $this->Event->Customer->find('list');
		$this->set(compact('customeres'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
		$customeres = $this->Event->Customer->find('list');
		$this->set(compact('customeres'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('The event has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
