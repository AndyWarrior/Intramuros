<?php

App::uses('CakeEmail', 'Network/Email');
class SadminController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index()
    {

    }

    public function viewPdf(){

                //Filtros
                $teamNameFil=$this->request->data('teamNameFil');
                $teamStatusFil=$this->request->data('teamStatusFil');
                $studentNameFil=$this->request->data('studentNameFil');
                $sportNameFil=$this->request->data('sportNameFil');
                $sportCategoryFil=$this->request->data('sportCategoryFil');
                $periodNameFil=$this->request->data('periodNameFil');

        //Se obtiene el "id" del admin
        $uid = $this->Auth->user('id');
        //Se cargan los modelos necesarios para desplegar los resultados para poblar la vista
        $this->loadModel('Period');
        $this->loadModel('Student');
        $this->loadModel('Sport');
        $this->loadModel('Team');

        //Se inicializan los filtros en caso de haber recibido nulos
        if (!$teamNameFil)
            $teamNameFil = '';
        if (!$teamStatusFil)
            $teamStatusFil = '';
        if (!$studentNameFil)
            $studentNameFil = '';
        if (!$sportNameFil)
            $sportNameFil = '';
        if (!$sportCategoryFil)
            $sportCategoryFil = '';
        if (!$periodNameFil)
            $periodNameFil = '';

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
                ),
                array(
                    'table' => 'Periods',
                    'alias' => 'prd',
                    'conditions' => array(
                        //verificar si la coma jala como AND
                        'Team.period_id = prd.id'
                    )
                )

            ),
            'conditions' => array(
                'Team.name LIKE' => '%'. $teamNameFil . '%', 'std.name LIKE' => '%'. $studentNameFil . '%', 'Team.status LIKE' => '%'. $teamStatusFil . '%',
                'sprt.name LIKE' => '%'. $sportNameFil . '%','sprt.category LIKE' => '%'. $sportCategoryFil . '%',
                'prd.period LIKE' => '%'. $periodNameFil . '%'
            ),
            'fields' => array('Team.name', 'std.name', 'Team.status','sprt.name','sprt.category', 'prd.period'),
            'order' => 'Team.name ASC'
        ));
        //Envio a front end the los resultados
        $this ->set('teams',$teams);
        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render();
    }

    public function sendAll() {

        if ($this->request->is('post')){

            //Se obtiene el "id" del admin
            $uid = $this->Auth->user('id');
            //Se carga el modelo de Users para obtener el email del admin
            $this->loadModel('User');
            //Se cargan los modelos necesarios para ejecutar el query que obtendra los emails
            $this->loadModel('Period');
            $this->loadModel('Student');
            $this->loadModel('Sport');
            $this->loadModel('Team');

            //Se obtiene el email del admin
            $user = $this->User->findById($uid);


            //Se obtienen los paramtetros de la peticion
            $subject=$this->request->data('subject');
            $text=$this->request->data('text');
            $period = $this->Period->find('first', array(
                'conditions' => array('active' => 1)));


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
                'conditions' => array( 'Team.period_id' => $period['Period']['id'],'Team.active' => 1,

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

            $this->redirect(array('action'=>'index'));
        }

    }

    public function rptActionLogs()
    {
        $this->loadModel('Actionlog');
        $this->loadModel('User');
        $logs = $this->Actionlog->find('all', array(
            'order' => array('timestamp' => 'DESC'),
            'limit' => 200,
        ));
        $users = $this->User->find('all');

        $this ->set('logs',$logs);
        $this ->set('users',$users);
    }
    public function rptTeams($teamNameFil=null, $studentNameFil=null, $teamStatusFil=null,$sportNameFil=null, $sportCategoryFil=null, $periodNameFil=null)
    {
        if ($this->request->is('post'))
        {
            if($this->request->data['submit'] == 'PDF'){
                $this->setAction('viewPdf');
            }
             else {
            //Filtros
            $teamNameFil=$this->request->data('teamNameFil');
            $teamStatusFil=$this->request->data('teamStatusFil');
            $studentNameFil=$this->request->data('studentNameFil');
            $sportNameFil=$this->request->data('sportNameFil');
            $sportCategoryFil=$this->request->data('sportCategoryFil');
            $periodNameFil=$this->request->data('periodNameFil');
             }


        }
        //Se obtiene el "id" del admin
        $uid = $this->Auth->user('id');
        //Se cargan los modelos necesarios para desplegar los resultados para poblar la vista
        $this->loadModel('Period');
        $this->loadModel('Student');
        $this->loadModel('Sport');
        $this->loadModel('Team');

        //Se inicializan los filtros en caso de haber recibido nulos
        if (!$teamNameFil)
            $teamNameFil = '';
        if (!$teamStatusFil)
            $teamStatusFil = '';
        if (!$studentNameFil)
            $studentNameFil = '';
        if (!$sportNameFil)
            $sportNameFil = '';
        if (!$sportCategoryFil)
            $sportCategoryFil = '';
        if (!$periodNameFil)
            $periodNameFil = '';

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
                ),
                array(
                    'table' => 'Periods',
                    'alias' => 'prd',
                    'conditions' => array(
                        //verificar si la coma jala como AND
                        'Team.period_id = prd.id'
                    )
                )

            ),
            'conditions' => array(
            'Team.name LIKE' => '%'. $teamNameFil . '%', 'std.name LIKE' => '%'. $studentNameFil . '%', 'Team.status LIKE' => '%'. $teamStatusFil . '%',
                'sprt.name LIKE' => '%'. $sportNameFil . '%','sprt.category LIKE' => '%'. $sportCategoryFil . '%',
                'prd.period LIKE' => '%'. $periodNameFil . '%'
            ),
            'fields' => array('Team.name', 'std.name', 'Team.status','sprt.name','sprt.category', 'prd.period', 'Team.id'),
            'order' => 'Team.name ASC'
        ));
        //Envio a front end the los resultados
        $this ->set('teams',$teams);


    }
	
	public function changePeriod() {
		$this->loadModel('Period');
		$this->loadModel('Team');
		$period = $this->Period->find('first', array(
                'conditions' => array('active' => 1)
            ));
		
		if(substr($period['Period']['period'],0,2) === 'EM') {
			$newperiod = array('period' => 'VE'.substr($period['Period']['period'],2,4));
		}
		else if(substr($period['Period']['period'],0,2) === 'VE') {
			$newperiod = array('period' => 'AD'.substr($period['Period']['period'],2,4));
		}
		else if(substr($period['Period']['period'],0,2) === 'AD') {
			$year = intval(substr($period['Period']['period'],2,4)) + 1;
			$newperiod = array('period' => 'EM'.$year);
		}
		
		
		$oldperiod = array('id' => $period['Period']['id'], 'active' => 0);
		$this->Period->save($oldperiod);
		
		$this->Period->create();
        $this->Period->save($newperiod);
		
		
		
		$teams = $this->Team->find('all', array(
                'conditions' => array('active' => 1)
            ));
			
		foreach ($teams as $team):
			$data = array('id' => $team['Team']['id'], 'active' => 0);
			$this->Team->save($data);
		endforeach;
		unset($team);
		
		return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		$this->Session->setFlash(__('Se ha iniciado un nuevo periodo.'));
		
    }

	
	public function view($id=null) {
		$this->loadModel('Student');
		$this->loadModel('Team');
		$team = $this->Team->findById($id);
		$student = $this->Student->findById($team['Team']['student_id']);
		$this->set('student',$student);
		$this->set('team',$team);
	}
	
}