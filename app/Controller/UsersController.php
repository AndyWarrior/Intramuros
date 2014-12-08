<?php

class UsersController extends AppController
{
    public $helpers = array('Html', 'Form');

    public function index(){
        $users = $this->User->find('all');
        $this->set('users', $users);
    }

    public function add()
    {

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash('Tu usuario ha sido creado');
            } else {
                $this->Session->setFlash('No se puedo crear el usuario');
            }

            $this->redirect(array('action'=>'index'));

        }

    }

    public function edit($id = null) {

        $user = $this->User->find('first', array(
            'conditions' =>array('id' => $id)));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
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
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));

    }

    public function activate($id = null) {

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