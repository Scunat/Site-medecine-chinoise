<?php

namespace controllers;

use app\Validator;

class AppointmentValidator extends Validator{
    /**
     * @param array $data
     * @return array || bool
     */
    public function validates(array $data){
        parent::validates($data);
        $this->validate('title', 'minLength', 3);
        $this->validate('date', 'date');
        $this->validate('start', 'beforeTime', 'end');
        return $this->errors;
    }
}