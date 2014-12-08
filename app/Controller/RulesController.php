<?php 

class RulesController extends AppController {
    public $helpers = array('Html', 'Form');

    var $layout = 'superadmin';

    public function index() {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
		$this->set('rules', $this->Rule->find('all'));
    }
	
	public function edit($id = null) {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
		if (!$id) {
			throw new NotFoundException(__('Reglamento invalido'));
		}

		$rule = $this->Rule->findById($id);
		if (!$rule) {
			throw new NotFoundException(__('Reglamento invalido'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Rule->id = $id;
			if ($this->Rule->save($this->request->data)) {
				$this->loadModel('Actionlog');
				date_default_timezone_set('America/Monterrey');
				$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Editar reglamento de los torneos', 'timestamp' => date('Y-m-d h:i:s'));
				$this->Actionlog->create();
				$this->Actionlog->save($action);
				$this->Session->setFlash(__('Se ha actualizado el reglamento.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar el reglamento.'));
		}

		if (!$this->request->data) {
			$this->request->data = $rule;
		}
	}
}