<?php

App::uses('CakeEmail', 'Network/Email');
class SadminController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function index()
    {

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



    public function add() {
    }
	
	public function edit($id = null, $sid = null) {

	}
	
	public function delete($id = null) {

	}
}