<?php

$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new controllers\AppointmentValidator;
    $errors = $validator->validates($_POST);
    if(empty($errors)){
      $appointment = new \controllers\Appointment();
      $appointment->setTitle($data['title']);
      $appointment->setDescription($data['description']);
      $appointment->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $date['start'])->format('Y-m-d H:i:s'));
      $appointment->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $date['end'])->format('Y-m-d H:i:s'));
      $appointment = new \controllers\Appointments(get_pdo());
      $appointments->create($appointment);
      header('Location:planning.php');
      exit();
    }
}

require '../views/add.php';