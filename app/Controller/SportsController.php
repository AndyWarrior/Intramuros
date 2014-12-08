<?php 

class SportsController extends AppController {
    public $helpers = array('Html', 'Form');

    var $layout = 'superadmin';

    public function index() {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
		$this->loadModel('User');
		$users = $this->User->find('all');
		$sports = $this->Sport->find('all', array(
            'conditions' => array('active' => 1)));
		$this->set('sports', $sports);
		$this->set('users', $users);
    }
	
	public function add() {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
		$this->loadModel('User');
		$users = $this->User->find('all');
		$this->set('users', $users);
		if ($this->request->is('post')) {
            $this->Sport->create();
            if ($this->Sport->save($this->request->data)) {
				$this->loadModel('Actionlog');
				date_default_timezone_set('America/Monterrey');
				$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Crear nuevo deporte', 'timestamp' => date('Y-m-d h:i:s'));
				$this->Actionlog->create();
				$this->Actionlog->save($action);
                $this->Session->setFlash(__('Se ha creado el deporte con exito.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido crear el deporte.'));
        }
    }
	
	public function edit($id = null) {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
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
				$this->loadModel('Actionlog');
				date_default_timezone_set('America/Monterrey');
				$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Editar informacion de deporte', 'timestamp' => date('Y-m-d h:i:s'));
				$this->Actionlog->create();
				$this->Actionlog->save($action);
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
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$data = array('id' => $id, 'active' => 0);
		$this->Sport->save($data);
		
		$this->loadModel('Actionlog');
		date_default_timezone_set('America/Monterrey');
		$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Eliminar deporte de la lista', 'timestamp' => date('Y-m-d h:i:s'));
		$this->Actionlog->create();
		$this->Actionlog->save($action);

		return $this->redirect(array('action' => 'index'));
		$this->Session->setFlash(__('Se ha borrado de manera exitosa.'));
	}
}