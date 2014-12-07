<?php

App::uses('CakeEmail', 'Network/Email');
class TeamsController extends AppController {
    public $helpers = array('Html', 'Form');

    var $layout = 'admin';
	
	public function index($sportId=null,$teamNameFil=null, $studentNameFil=null, $teamStatusFil=null)
    {

        if ($this->request->is('post'))
        {

            $sportId=$this->request->data('sportId');
            $teamNameFil=$this->request->data('teamNameFil');
            $studentNameFil=$this->request->data('studentNameFil');
            $teamStatusFil=$this->request->data('teamStatusFil');

        }
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
                ),
                array(
                    'table' => 'Sports',
                    'alias' => 'sprt',
                    'conditions' => array(
                        //verificar si la coma jala como AND
                        'Team.sport_id = sprt.id'
                    )
                )
            ),
            'conditions' => array('Team.sport_id' =>$sport['Sport']['id'], 'Team.period_id' => $period['Period']['id'],'Team.active' => 1,
                'Team.name LIKE' => '%'. $teamNameFil . '%', 'std.name LIKE' => '%'. $studentNameFil . '%', 'Team.status LIKE' => '%'. $teamStatusFil . '%',
            ),
            'fields' => array('Team.id','Team.active','Team.name', 'std.name', 'Team.status', 'std.email','sprt.id'),
            'order' => 'Team.name ASC'
        ));
        //Envio a front end the los resultados
        $this ->set('teams',$teams);

        //Actualizacion de variables para enviar
        $sportId = $sport['Sport']['id'];
        $periodId =  $period['Period']['id'];

        //Envio de variables a front end

        $this ->set('sportId',$sportId);
        $this ->set('periodId',$periodId);
        $this ->set('teamNameFil',$teamNameFil);
        $this ->set('studentNameFil',$studentNameFil);
        $this ->set('teamStatusFil',$teamStatusFil);

        // side-bar

        $type = $this->Auth->User('user_type');

        if($type == 1){
            $sports = $this->Sport->find('all');
        } else {
            $sports = $this->sport->find('all', array(
                'conditions' => array('user_id' => $uid, 'active' => 1)));
        }

        $this->set('sports',$sports);

    }

    public function sendAll($sportId=null,$periodId=null,$teamNameFil=null,$studentNameFil=null,$teamStatusFil=null) {

        if ($this->request->is('post')){

            //Se obtiene el "id" del admin
            $uid = $this->Auth->user('id');
            //Se carga el modelo de Users para obtener el email del admin
            $this->loadModel('User');
            //Se cargan los modelos necesarios para ejecutar el query que obtendra los emails
            $this->loadModel('Period');
            $this->loadModel('Student');
            $this->loadModel('Sport');

            //Se obtiene el email del admin
            $user = $this->User->findById($uid);


            //Se obtienen los paramtetros de la peticion
            $subject=$this->request->data('subject');
            $text=$this->request->data('text');
            $sportId=$this->request->data('sportId');
            $periodId=$this->request->data('periodId');
            $teamNameFil=$this->request->data('teamNameFil');
            $studentNameFil=$this->request->data('studentNameFil');
            $teamStatusFil=$this->request->data('teamStatusFil');

            //Se obtienen los emails de los equipos en base al deporte y periodo especificados
            $emails= $this->Team->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'Students',
                        'alias' => 'std',
                        'conditions' => array(
                            //verificar si la coma jala como AND
                            'std.id = Team.student_id'
                        )
                    ),
                    array(
                        'table' => 'Sports',
                        'alias' => 'sprt',
                        'conditions' => array(
                            //verificar si la coma jala como AND
                            'Team.sport_id = sprt.id'
                        )
                    )
                ),
                'conditions' => array('Team.sport_id' =>$sportId, 'Team.period_id' => $periodId,'Team.active' => 1,
                    'Team.name LIKE' => '%'. $teamNameFil . '%', 'std.name LIKE' => '%'. $studentNameFil . '%', 'Team.status LIKE' => '%'. $teamStatusFil . '%',
                ),
                'fields' => array('std.email'),
                'order' => 'Team.name ASC'
            ));

            //Se inicializa el subject si no le incluyo uno
            if (!$subject){
                $subject = 'Depto. Intramuros (No Responder)';
            }

            if ($emails!= null && $text !=null) {
                foreach ($emails as $email):
                    // send email with user password
                    $Email = new CakeEmail('gmail');
                    $Email->from($user['User']['email']);
                    $Email->to($email['std']['email']);
                    $Email->subject($subject);
                    $Email->send($text);
                endforeach;
            }

           $this->redirect(array('action'=>'index',$sportId));
        }
        else{
            $this ->set('sportId',$sportId);
            $this ->set('periodId',$periodId);
            $this ->set('teamNameFil',$teamNameFil);
            $this ->set('studentNameFil',$studentNameFil);
            $this ->set('teamStatusFil',$teamStatusFil);
        }
    }
    public function sendOne($sportId=null, $email = null) {

        if ($this->request->is('post')) {
            //Se obtiene el "id" del admin
            $uid = $this->Auth->user('id');
            //Se carga el modelo de Users para obtener el email del admin
            $this->loadModel('User');
            //Se obtiene el email del admin
            $user = $this->User->findById($uid);

            //Se obtienen los paramtetros de la peticion
            $subject = $this->request->data['subject'];
            $text = $this->request->data['text'];
            $sportId = $this->request->data['sportId'];
            $email = $this->request->data['email'];


            //Se inicializa el subject si no le incluyo uno
            if (!$subject) {
                $subject = 'Depto. Intramuros (No Responder)';
            }


            //Se comprueba que hayamos recibido texto y email
            if ($text != null && $email!=null) {
                // send email with user password
                $Email = new CakeEmail('gmail');
                $Email->from($user['User']['email']);
                $Email->to($email);
                $Email->subject($subject);
                $Email->send($text);
            }

            $this->redirect(array('action' => 'index', $sportId));
        }
        else{
            $this ->set('sportId',$sportId);
            $this ->set('email',$email);
        }
    }


    public function add() {
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
	
	public function delete($id = null) {

		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$data = array('id' => $id, 'active' => 0);
		$this->Team->save($data);

		$this->redirect(array('action' => 'index'));
		$this->Session->setFlash(__('Se ha borrado de manera exitosa.'));
	}
}