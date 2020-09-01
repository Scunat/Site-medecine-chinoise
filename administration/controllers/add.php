<?php

require './bootstrap.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST;
  $validator = new controllers\AppointmentValidator();
  $errors = $validator->validates($_POST);
  //var_dump($errors);
  if (empty($errors)) {
    $appointment = new \controllers\Appointment();
    $appointment->setTitle($data['title']);
    $appointment->setDescription($data['description']);
    $appointment->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
    $appointment->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
    $appointments = new \controllers\Appointments(get_pdo());
    $appointments->create($appointment);
    //header('Location:planning.php');
    //exit();
  }
}

require '../views/add.php';