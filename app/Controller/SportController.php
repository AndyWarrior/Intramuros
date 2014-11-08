<?php
/**
 * Created by PhpStorm.
 * User: juanpi-91
 * Date: 11/8/14
 * Time: 2:21 AM
 */

class SportController extends AppController {

    public $paginate = array(
        'order' => array('Sport.sport_name' => 'asc' )
    );

    public function index() {
        $this->layout='admin';
        $this->paginate = array(
            'order' => array('Sport.sport_name' => 'asc' )
        );
        $sports = $this->paginate('Sport');
        $this->set(compact('sports'));
    }


    public function add() {
        $this->layout='admin';
        if ($this->request->is('post')) {

            $this->Sport->create();
            if ($this->Sport->save($this->request->data)) {
                $this->Session->setFlash(__('The sport has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sport could not be created. Please, try again.'));
            }
        }
    }

    public function edit($sport_id = null) {
        $this->layout='admin';
        if (!$sport_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $sport = $this->Sport->find('all', array('sport_id' => $sport_id));
        if (!$sport) {
            $this->Session->setFlash('Invalid Sport ID Provided');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Sport->sport_id = $sport_id;
            if ($this->Sport->save($this->request->data)) {
                $this->Session->setFlash(__('The sport has been updated'));
                $this->redirect(array('action' => 'index'));
            }else{
                $this->Session->setFlash(__('Unable to update your sport.'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $sport;
        }
    }

    public function delete($sport_id = null) {

        if (!$sport_id) {
            $this->Session->setFlash('Please provide a sport id');
            $this->redirect(array('action'=>'index'));
        }

        $this->Sport->sport_id = $sport_id;
        if (!$this->Sport->exists()) {
            $this->Session->setFlash('Invalid sport id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Sport->delete($sport_id)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }



}