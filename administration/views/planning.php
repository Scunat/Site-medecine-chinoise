<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1eea0c00ae.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Aladin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/ressources/css/planning.css">
    <title>Médecine traditionelle chinoise-XIAO YU-votrePlanning</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="logo"><a href="../../administration/controllers/index.php"><img src="../../public/ressources/images/logo.jpg" alt=""></a></li>
                <div class="nav-link">
                    <li><a href="../../administration/controllers/account.php">Mon espace</a></li>
                    <li><a href="../../administration/controllers/deconnexion.php">Deconnexion</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <section class="title">
        <h1>Mon planning</h1>
    </section>
    <?php
    require '../controllers/month.php';
    require '../controllers/appointments.php';
        $appointments = new App\controllers\Appointments();
        $month = new App\controllers\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $start = $month->getFirstDay();
        $firstDay = $start->format('N') === '1' ? $start :  $month->getFirstDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = (clone $start)->modify('+' . (6 +7 * ($weeks -1)) . 'days' );
        $appointments = $appointments->getEventsBetweenByDay($start, $end);
        //var_dump($appointments);
        [
            ''
        ]
    ?>
    <section class="h2">
        <h2>
            <?= $month->toString(); ?>
        </h2>
    </section>
    <section class="button">
        <a href="./planning.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="button_left">&lt;</a>
        <a href="./planning.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="button_right">&gt;</a>
    </section>
    <table class="planning planning--<?= $weeks; ?>weeks">
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
                        <?php foreach($appointmentsForDay as $appointment): ?>
                         <div class="planning_appointment">
                             <?= (new DateTime($appointment['start']))->format('H:i') ?> - <a href="/administration/controllers/appointments.php?id=<?= $appointment['id']; ?>"><?= $appointment['name']; ?></a> 
                         </div>
                        <?php endforeach; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <footer>
        <a class="ml">Mentions Légales</a>
    </footer>
</body>

</html>