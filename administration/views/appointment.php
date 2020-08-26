<?php

require '../controllers/Appointments.php';

$appointments = new Appointments();
if (!isset($_GET['id'])){
    header('Location:/404.php');
}
$appointment = $appointments->find($_GET['id'] ?? null);