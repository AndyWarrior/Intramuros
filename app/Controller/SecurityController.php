<?php
/**
 * Created by PhpStorm.
 * User: juanpi-91
 * Date: 11/8/14
 * Time: 4:11 PM
 */

class SecurityController extends AppController {

    public function login() {

        $this->layout='login';
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}