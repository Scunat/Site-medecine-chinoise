<?php
require './bootstrap.php';
$pdo = get_pdo();
$appointments = new controllers\Appointments($pdo);
$month = new controllers\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getFirstDay();
$firstDay = $start->format('N') === '1' ? $start :  $month->getFirstDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
$appointments = $appointments->getAppointmentsBetweenByDay($start, $end);
//var_dump($appointments);
require '../views/header.php';
?>
<section class="title">
    <h1>Mon planning</h1>
</section>
<section class="h2">
    <h2>
        <?= $month->toString(); ?>
    </h2>
</section>
<section class="button">
    <a href="./planning.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="button_left">&lt;</a>
    <a href="./planning.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="button_right">&gt;</a>
</section>
<section class="section_add_button">
    <a href="../../administration/controllers/add.php" class="add_button">+</a>
</section>
<section class="planning">
    <table class="planning_table planning_table--<?= $weeks; ?>weeks">
        <?php for ($i = 0; $i < $month->getWeeks(); $i++) : ?>
            <tr>
                <?php foreach ($month->days as $k => $day) :
                    $date = (clone $firstDay)->modify("+" . $k + $i * 7 . "days");
                    $appointmentsForDay = $appointments[$date->format('Y-m-d')] ?? [];
                ?>
                    <td class="<?= $month->withInMonth($date) ? '' :  'planning_othermonth'; ?>">
                        <?php if ($i === 0) : ?>
                            <div class="planning_weekday"><?= $day; ?></div>
                        <?php endif; ?>
                        <div class="plannig_day"><?= $date->format('d'); ?></div>
                        <?php foreach ($appointmentsForDay as $appointment) : ?>
                            <div class="planning_appointment">
                                <?= (new DateTime($appointment['start']))->format('H:i') ?> - <a class='link-black' href="../views/appointment.php?id=<?= $appointment['id']; ?>"><?= $appointment['title']; ?></a>
                            </div>
                        <?php endforeach; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
</section>

<?php require '../views/footer.php'; ?>