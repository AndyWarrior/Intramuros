<?php 

class TeamsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function index() {
      
    }

	
	public function edit($id = null, $sid = null) {
		$this->loadModel('Sport');
		if (!$id) {
			throw new NotFoundException(__('Opcion invalida.'));
		}
		
		if (!$sid) {
			throw new NotFoundException(__('Opcion invalida.'));
		}
		$sports = $this->Sport->find('all', array(
            'conditions' => array('id' => $sid)));
		$this->set('sports', $sports);
		$team = $this->Team->findById($id);
		if (!$team) {
			throw new NotFoundException(__('Opcion invalida.'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Team->id = $id;
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('Se ha guardado exitosamente la informacion.'));
				return $this->redirect(array('action' => 'index', $sid));
			}
			$this->Session->setFlash(__('No se pudo actualizar la informacion.'));
		}

		if (!$this->request->data) {
			$this->request->data = $team;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$data = array('id' => $id, 'active' => 0);
		$this->Team->save($data);

		return $this->redirect(array('action' => 'index'));
		$this->Session->setFlash(__('Se ha borrado de manera exitosa.'));
	}
}