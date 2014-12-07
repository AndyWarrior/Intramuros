<?php

App::uses('CakeEmail', 'Network/Email');
class TeamsController extends AppController {
    public $helpers = array('Html', 'Form');

    public $resultSet;
	
	public function index($sportId=null,$teamNameFil=null, $studentNameFil=null, $teamStatusFil=null)
    {
        //Se obtiene el "id" del admin
        $uid = $this->Auth->user('id');
        //Se cargan los modelos necesarios para desplegar los resultados para poblar la vista
        $this->loadModel('Period');
        $this->loadModel('Student');
        $this->loadModel('Sport');

        if ($sportId != null)
        {
            //Si recibe un sportId inicializa el deporte
            $sport = $this->Sport->findById($sportId);
        }
        else
        {
            //Si no recibe un SportId busca el primero asociado al admin
            $sport = $this->Sport->find('first', array(
                'conditions' => array('user_id' => $uid, 'active' => 1)));
        }

        //Se obtiene el periodo activo
        $period = $this->Period->find('first', array(
                'conditions' => array('active' => 1)));

        //Se inicializan los filtros en caso de ver recibido nulos
            if (!$teamNameFil)
                $teamNameFil = '';
            if (!$teamStatusFil)
                $teamStatusFil = '';
            if (!$studentNameFil)
                $studentNameFil = '';

        //Se obtienen los equipos en base al deporte y periodo obtenidos
        $teams= $this->Team->find('all', array(
            'joins' => array(
                array(
                    'table' => 'Students',
                    'alias' => 'std',
                    'conditions' => array(
                        //verificar si la coma jala como AND
                        'std.id = Team.student_id'
                    )
                )
            ),
            'conditions' => array('Team.sport_id' =>$sport['Sport']['id'], 'Team.period_id' => $period['Period']['id'],'Team.active' => 1,
                'Team.name LIKE' => '%'. $teamNameFil . '%', 'std.name LIKE' => '%'. $studentNameFil . '%', 'Team.status LIKE' => '%'. $teamStatusFil . '%',
            ),
            'fields' => array('Team.name', 'std.name', 'Team.status', 'std.email'),
            'order' => 'Team.name ASC'
        ));

        $this->resultSet = $teams;
        $this ->set('teams',$teams);

        //$res = Hash::merge($array, $arrayB, $arrayC, $arrayD);
        //$query->select(['id', 'title', 'body']);
    }

    public function sendAll($sportid=null) {

        //Se obtiene el "id" del admin
        $uid = $this->Auth->user('id');
        //Se carga el modelo de Users para obtener el email del admin
        $this->loadModel('Users');
        //Se obtiene el email del admin
        $user = $this->User->findById($uid);

        //Se obtienen los resultados desplegados en la tabla
        $resultSet = $this->resultSet;

        //Se obtienen los emails
        $emails = $resultSet['Team']['email'];
        //Se obtienen los paramtetros de la peticion
        $subject=$this->request->data['subject'];
        $text=$this->request->data['text'];

        //Se inicializa el subject si no le incluyo uno
        if (!$subject){
            $subject = 'Depto. Intramuros (No Responder)';
        }

        if (!$emails && !$text) {
            foreach ($emails as $email):
                // send email with user password
                $Email = new CakeEmail('gmail');
                $Email->from($user['User']['email']);
                $Email->to($email);
                $Email->subject($subject);
                $Email->send($text);
            endforeach;
        }

        $this->redirect(array('action'=>'index',$sportid));
    }
    public function sendOne($sportid=null, $email = null) {

        //Se obtiene el "id" del admin
        $uid = $this->Auth->user('id');
        //Se carga el modelo de Users para obtener el email del admin
        $this->loadModel('Users');
        //Se obtiene el email del admin
        $user = $this->User->findById($uid);

        //Se obtienen los paramtetros de la peticion
        $subject=$this->request->data['subject'];
        $text=$this->request->data['text'];


        //Se inicializa el subject si no le incluyo uno
        if (!$subject){
            $subject = 'Depto. Intramuros (No Responder)';
        }
        //Se comprueba que hayamos recibido texto y email
        if (!$text && !$email) {
                // send email with user password
                $Email = new CakeEmail('gmail');
                $Email->from($user['User']['email']);
                $Email->to($email);
                $Email->subject($subject);
                $Email->send($text);
        }

        $this->redirect(array('action'=>'index',$sportid));

    }


    public function add() {
    }
	
	public function edit($id = null, , $sid = null) {
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