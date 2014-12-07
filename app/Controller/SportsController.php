<?php 

class SportsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
		$this->loadModel('User');
		$users = $this->User->find('all');
		$sports = $this->Sport->find('all', array(
            'conditions' => array('active' => 1)));
		$this->set('sports', $sports);
		$this->set('users', $users);
    }
	
	public function add() {
		$this->loadModel('User');
		$users = $this->User->find('all');
		$this->set('users', $users);
		if ($this->request->is('post')) {
            $this->Sport->create();
            if ($this->Sport->save($this->request->data)) {
                $this->Session->setFlash(__('Se ha creado el deporte con exito.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido crear el deporte.'));
        }
    }
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Deporte invalido'));
		}

		$sport = $this->Sport->findById($id);
		if (!$sport) {
			throw new NotFoundException(__('Deporte invalido'));
		}
		
		$this->loadModel('User');
		$users = $this->User->find('all');
		$this->set('users', $users);
		if ($this->request->is(array('post', 'put'))) {
			$this->Sport->id = $id;
			if ($this->Sport->save($this->request->data)) {
				$this->Session->setFlash(__('Se ha actualizado el deporte.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar el deporte.'));
		}

		if (!$this->request->data) {
			$this->request->data = $sport;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$data = array('id' => $id, 'active' => 0);
		$this->Sport->save($data);

		return $this->redirect(array('action' => 'index'));
		$this->Session->setFlash(__('Se ha borrado de manera exitosa.'));
	}
}