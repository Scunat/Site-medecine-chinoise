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
                    <li><a href="index.php">Deconnexion</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <section class="title">
        <h1>Mon planning</h1>
    </section>
    <?php
    require '../controllers/month.php';
    try {
        $month = new App\controllers\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $firstDay = $month->getFirstDay()->modify('last monday');
    } catch (\Exception $e) {
        $month = new \App\controllers\Month();
    }
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
    <table class="planning planning--<?= $month->getWeeks(); ?>weeks">
        <?php for ($i = 0; $i < $month->getWeeks(); $i++) : ?>
            <tr>
                <?php foreach ($month->days as $k => $day) :
                    $date = (clone $firstDay)->modify("+" . $k + $i * 7 . "days")
                ?>
                    <td class="<?= $month->withInMonth($date) ? '' :  'planning_othermonth'; ?>">
                        <?php if ($i === 0) : ?>
                            <div class="planning_weekday"><?= $day; ?></div>
                        <?php endif; ?>
                        <div class="plannig_day"><?= $date->format('d'); ?></div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <footer>
    </footer>
</body>

</html>