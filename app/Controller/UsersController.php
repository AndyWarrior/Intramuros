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

    }
}