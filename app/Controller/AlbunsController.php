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
			$dados = $this->request->data;
			foreach ($dados['Picture'] as $value) {
				if (isset($value['instagram_id'])) {
					$retorno[] = array(
									'album_id' 	   => $albumId,
									'result'       => $value['result'],
									'instagram_id' => $value['instagram_id']
								);
				}
			}
			$this->loadModel('Picture');
			$this->Picture->create();
			if ($this->Picture->saveMany($retorno)) {
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
			$results = json_decode($HttpSocket->get("https://api.instagram.com/v1/tags/$tag/media/recent?access_token=17844556.f59def8.1088003165514e1e8e562400fb0542c5")->body,true);
            Cache::write("getTags_{$albumId}_{$tag}", $results, 'default');
        }
       // debug($results);
        if (!isset($results['erro'])) {
        	$results = $results['data'];
    		$pictureIds = $this->Album->Picture->find('list',array('fields'=>array('instagram_id'),'conditions'=>array('album_id'=>$albumId)));
    		foreach ($results as $key => $result) {
    			$instagramId = Hash::get($result, 'caption.id');
    			if (in_array($instagramId, $pictureIds)) {
    				unset($results[$key]);
    			}
    		}
        }
		
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