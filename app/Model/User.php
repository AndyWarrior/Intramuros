<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $validate = array(
        'username' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required',
                'allowEmpty' => false
            ),
            'unique' => array(
                'rule'    => array('isUniqueUsername'),
                'message' => 'This username is already in use'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Username can only be letters, numbers and underscores'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
        ),

        'email' => array(
            'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            ),
        ),

    );

    /**
     * Before isUniqueUsername
     * @param array $check
     * @return boolean
     */
    function isUniqueUsername($check) {

        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );

        if(!empty($username)){
            if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Before isUniqueEmail
     * @param array $check
     * @return boolean
     */
    function isUniqueEmail($check) {

        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );

        if(!empty($email)){
            if($this->data[$this->alias]['id'] == $email['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        // fallback to our parent
        return parent::beforeSave($options);
    }

}

