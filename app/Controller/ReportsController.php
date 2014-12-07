<?php

class ReportsController extends AppController
{
    public function index(){
        $this->loadModel('Team');

        $teams = $this->Team->find('all');


        if ($this->request->is('post')) {
            $data = $this->request->data;

        } else {
            $this->set('teams',$teams);
        }



    }
}