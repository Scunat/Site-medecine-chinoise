<?php

namespace app;

class Validator
{
    private $data;
    protected $errors = [];

    /**
     * @param array $data
     * @return array || bool
     */
    public function validates(array $data)
    {
        $this->errors = [];
        $this->data = $data;
    }

    public function validate(string $field, string $method, ...$parameters)
    {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champ $field n'est pas rempli";
        } else {
            call_user_func([$this, $method], $field, ...$parameters);
        }
    }
    public function minLength(string $field, int $length): bool
    {
        if (mb_strlen($field) < $length) {
            $this->erros[$field] = "Le champ doit avoir plus de $length caractères";
            return false;
        }
        return true;
    }
    public function date(string $field): bool
    {
        if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "La date ne semble pas valide";
            return false;
        }
        return true;
    }
    public function time(string $field): bool
    {
        if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "Le temps ne semble pas valide";
            return false;
        }
        return true;
    }
    public function beforeTime(string $startField, string $endField)
    {
        if($this->time($startField) && $this->time($endField)){
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if($start->getTimestamp() > $end->getTimestamp()){
                $this->errors[$startField] = "Le temps doit être inférieur au temps de fin";
                return false;
            }
            return true;
        }
        return false;
    }
}
