<?php 

class StudentsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function login() {
		if ($this->request->is('post')) {
		
			$student = $this->Student->find('all', array(
				'conditions' => array('id' => $this->request->data['Student']['id'])));
				
			if($student) {
				return $this->redirect(array('action' => 'index',$this->request->data['Student']['id']));
			}
			
			else {
				$data = array('id' => $this->request->data['Student']['id']);
				$this->Student->create();
				if ($this->Student->save($data)) {
					return $this->redirect(array('action' => 'index',$this->request->data['Student']['id']));
				}
			}
            $this->Session->setFlash(__('No se ha podido iniciar sesion.'));
        }

    }

    public function index($sid=null) {
		if (!$sid) {
			throw new NotFoundException(__('Alumno invalido'));
		}
		$this->loadModel('Team');
		$this->loadModel('Sport');
		$this->loadModel('Period');
		$teams = $this->Team->find('all', array(
            'conditions' => array('student_id' => $sid)));
		$sports = $this->Sport->find('all');
		$periods = $this->Period->find('all');
		$this->set('teams', $teams);
		$this->set('sports', $sports);
		$this->set('periods', $periods);
		$this->set('sid', $sid);
    }
	
	public function add($sid=null) {
		if (!$sid) {
			throw new NotFoundException(__('Alumno invalido'));
		}
		
		$this->loadModel('Sport');
		$this->loadModel('Team');
		$this->loadModel('Period');
		$sports = $this->Sport->find('all');
		$period = $this->Period->find('first', array(
            'conditions' => array('active' => 1)));
		$this->set('sports', $sports);
		$this->set('sid', $sid);
		$this->set('period', $period);
		if ($this->request->is('post')) {
            $this->Team->create();
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash(__('Se ha creado el equipo con exito.'));
                return $this->redirect(array('action' => 'index',$sid));
            }
            $this->Session->setFlash(__('No se ha podido crear el equipo.'));
        }
    }
	
	public function edit($id = null) {
	}
	
	public function delete($id) {
	}
}