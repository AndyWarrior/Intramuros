<?php

class UsersController extends AppController
{
    public $helpers = array('Html', 'Form');

    var $layout = 'superadmin';

    public function index(){
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
        $users = $this->User->find('all');
        $this->set('users', $users);
    }

    public function add()
    {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
				$this->loadModel('Actionlog');
				date_default_timezone_set('America/Monterrey');
				$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Crear nuevo usuario', 'timestamp' => date('Y-m-d h:i:s'));
				$this->Actionlog->create();
				$this->Actionlog->save($action);
                $this->Session->setFlash('Tu usuario ha sido creado');
            } else {
                $this->Session->setFlash('No se puedo crear el usuario');
            }

            $this->redirect(array('action'=>'index'));

        }

    }

    public function edit($id = null) {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }

        $user = $this->User->find('first', array(
            'conditions' =>array('id' => $id)));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
				$this->loadModel('Actionlog');
				date_default_timezone_set('America/Monterrey');
				$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Editar informacion de un usuario', 'timestamp' => date('Y-m-d h:i:s'));
				$this->Actionlog->create();
				$this->Actionlog->save($action);
                $this->Session->setFlash(__('El usuario ha sido editado'));
                $this->redirect(array('action' => 'index'));
            }else{
                $this->Session->setFlash(__('No se pudo modificar'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function password($id = null){
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }
        $user = $this->User->find('first', array(
            'conditions' =>array('id' => $id)));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->loadModel('Actionlog');
                date_default_timezone_set('America/Monterrey');
                $action = array('user_id' => $this->Auth->user('id'), 'action' => 'Cambiar contraseña', 'timestamp' => date('Y-m-d h:i:s'));
                $this->Actionlog->create();
                $this->Actionlog->save($action);
                $this->Session->setFlash(__('El usuario ha sido editado'));
                $this->redirect(array('action' => 'index'));
            }else{
                $this->Session->setFlash(__('No se pudo modificar'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function deactivate($id = null){
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }

        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('active', 0)) {
			$this->loadModel('Actionlog');
			date_default_timezone_set('America/Monterrey');
			$action = array('user_id' => $this->Auth->user('id'), 'action' => 'Eliminar a un usuario', 'timestamp' => date('Y-m-d h:i:s'));
			$this->Actionlog->create();
			$this->Actionlog->save($action);
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));

    }

    public function activate($id = null) {
        $type = $this->Auth->User('user_type');
        if($type != 1){
            $this->redirect(array('controller' => 'teams', 'action'=>'index'));
        }

            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }

            $this->User->id = $id;
            if (!$this->User->exists()) {
                $this->Session->setFlash('Invalid user id provided');
                $this->redirect(array('action'=>'index'));
            }
            if ($this->User->saveField('active', 1)) {
                $this->Session->setFlash(__('User re-activated'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('User was not re-activated'));
            $this->redirect(array('action' => 'index'));
        }
}