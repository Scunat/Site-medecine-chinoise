<?php
require '../controllers/bootstrap.php';
require '../controllers/Appointments.php';

$pdo = get_pdo();
$appointments = new controllers\Appointments($pdo);
if (!isset($_GET['id'])) {
    header('HTTP/1.0 404 Not Found');
    exit;
}
try {
    $appointment = $appointments->find($_GET['id']);
} catch (\Exception $e) {
    e404();
}
render('header', ['title' => $appointment->getTitle()]);
?>

<h1 class="titleh1">Mon rendez-vous</h1>
<h2 class="titleAppointment"><?= h($appointment->getTitle()); ?></h2>
<ul class="detailsAppointment">
    <li>Date: <?= $appointment->getStart()->format('d/m/y'); ?></li>
    <li>Heure de démarrage: <?= $appointment->getStart()->format('H:i'); ?></li>
    <li>Heure de fin: <?= $appointment->getEnd()->format('H:i'); ?></li>
    <li>Description:<br>
        <?= h($appointment->getDescription()); ?>
    </li>
</ul>
<?php
render('footer');