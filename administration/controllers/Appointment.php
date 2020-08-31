<?php

namespace controllers;

class Appointment{

    private $id;

    private $title;

    private $description;

    private $start;

    private $end;

    public function getId(): int{
        return $this->id;
    }
    
    public function getTitle(): string{
        return $this->title;
    }

    public function getDescription(): string{
        return $this->description ?? '';
    }

    public function getStart(): \DateTime{
        return new \DateTime($this->start);
    }

    public function getEnd(): \DateTime{
        return new \DateTime($this->end);
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
    public function setDescription(string $description){
        $this->description = $description;
    }
    public function setStart(string $start){
        $this->start = $start;
    }
    public function setEnd(string $end){
        $this->end = $end;
    }
}