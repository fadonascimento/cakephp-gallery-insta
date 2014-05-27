<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');


class AlbunsController extends AppController {

	public function view($id) {
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid Album'));
		}
		$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
		$this->set('album', $this->Album->find('first', $options));
	}


	public function listModeration($albumId)
	{


		if ($this->request->is('post') || $this->request->is('put')) {
			debug($this->request->data);exit;

			$this->loadModel('Picture');
			$this->Picture->create();
			if ($this->Picture->saveAll($this->request->data)) {
				$fotosSalvas = $this->request->data;
				$this->flashSucesso('Imagens Salvas com Sucesso');
			}


		}

		$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $albumId));
		$album = $this->Album->find('first', $options);
		
		$tag = $album['Album']['tags'];
		$results = Cache::read("getTags_{$albumId}_{$tag}", 'default');
        //debug($results);exit;
        if (!$results) {
        	debug('nao foi cache');
			$HttpSocket = new HttpSocket();
			$results = json_decode($HttpSocket->get("https://api.instagram.com/v1/tags/$tag/media/recent?access_token=17844556.f59def8.1088003165514e1e8e562400fb0542c5")->body);
            Cache::write("getTags_{$albumId}_{$tag}", $results, 'default');
        }

        if (!isset($results->erro)) {
        	$results = $results->data;

        	if (!empty($fotosSalvas)) {
        		foreach ($results as $key => $result) {
        			foreach ($fotosSalvas as $key => $value) {
        				# code...
        			}
        			// if ($this->recursive_array_search()) {

        			// }
        		}
        		// debug($fotosSalvas);
        		// debug($results);
        	}


        }


        $this->request->data = $album;
		
		$this->set(array('results' => $results));
	}

	public function recursive_array_search($needle,$haystack) {
	    foreach($haystack as $key=>$value) {
	        $current_key=$key;
	        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
	            return $current_key;
	        }
	    }
	    return false;
	}


}