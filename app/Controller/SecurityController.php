<?php
/**
 * Created by PhpStorm.
 * User: juanpi-91
 * Date: 11/21/14
 * Time: 7:38 PM
 */

App::uses('AuthComponent', 'Controller/Component');

class SecurityController extends AppController {


    public function login() {

        $this->layout='login';
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller' => 'teams', 'action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            // check username and password
            if ($this->Auth->login()) {
                $active = $this->Auth->user('active');
                if($active) {
                    $this->loadModel('Sport');
                    $type = $this->Auth->user('user_type');
                    if($type == 2){
                        $id = $this->Auth->user('id');
                        $sports = $this->Sport->find('all', array(
                            'conditions' => array('user_id' => $id, 'active' => 1)));
                        if($sports != null){
                            $this->redirect($this->Auth->redirectUrl());
                        } else {
                            $this->redirect(array('action' => 'logout'));
                        }
                    } else {
                        $this->redirect($this->Auth->redirectUrl());
                    }
                } else {
                    $this->redirect(array('action' => 'logout'));
                }

            }
            // wrong username or password
            else {
                $this->Session->setFlash(__('Username o password invalido'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}