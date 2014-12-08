<?php 

class StudentsController extends AppController {
    public $helpers = array('Html', 'Form', 'Js');

    var $layout = 'student';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login');
        $this->Auth->allow('index');
        $this->Auth->allow('add');
        $this->Auth->allow('edit');

    }

	public function login() {
        $this->layout='login';
		if ($this->request->is('post')) {
		
			$student = $this->Student->findById($this->request->data['Student']['id']);
				
			if($student) {
                if ($student['Student']['name'] == NULL || $student['Student']['email'] == NULL || $student['Student']['cellphone'] == NULL){
                    return $this->redirect(array('action' => 'edit',$this->request->data['Student']['id']));
                } else {
                    return $this->redirect(array('action' => 'index',$this->request->data['Student']['id']));
                }

			}
			
			else {
				$data = array('id' => $this->request->data['Student']['id']);
				$this->Student->create();
				if ($this->Student->save($data)) {
					return $this->redirect(array('action' => 'edit',$this->request->data['Student']['id']));
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
		$sports = $this->Sport->find('all', array(
            'order' => array('name' => 'ASC')
        ));
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
        $student = $this->Student->findById($id);
        $this->set('sid', $id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Student->id = $id;
            if ($this->Student->save($this->request->data)) {
                $this->Session->setFlash(__('Se han actualizado tus datos'));
                $this->redirect(array('action' => 'index',$id));
            }else{
                $this->Session->setFlash(__('No se puedo editar contacte al administrador'));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $student;
        }
	}
	
	public function check() {

        $this->layout=false;
        $this->autoRender = false;
        if($this->request->is('ajax')){
        $this->loadModel('Sport');

        $sportId = $this->request->data('sportId');

        $sport = $this->Sport->findById($sportId);

        $days = "";

        if($sport['Sport']['monday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        if($sport['Sport']['tuesday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        if($sport['Sport']['wednesday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        if($sport['Sport']['thursday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }
        if($sport['Sport']['friday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        if($sport['Sport']['saturday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        if($sport['Sport']['sunday']){
            $days = $days.'1';
        } else {
            $days = $days.'0';
        }

        echo $days;
        }

	}
}