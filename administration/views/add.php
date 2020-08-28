<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/ressources/css/add.css">
    <title>Médecine traditionelle chinoise-XIAO YU-ajouterUnRendez-vous</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="logo"><a href="index.php"><img src="../../public/ressources/images/logo.jpg" alt=""></a></li>
                <div class="nav-link">
                    <li><a href="../../administration/views/planning.php">Mon planning</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <section class="title">
        <h1>Ajouter un rendez-vous</h1>
    </section>
    <section class="form">
        <?php if (!empty($errors)) : ?>
            <div class="alert">
                Merci de corriger les erreurs
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="title">Titre</label>
            <input id="title" type="text" class="title" name="title" value="<?= isset($data['title']) ? h($data['title']) : ''; ?>">
            <?php if (isset($errors['title'])) : ?>
                <?= $errors['title']; ?>
            <?php endif; ?>
            <label for="date">Date</label>
            <input id="date" type="date" class="title" value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">
            <?php if (isset($errors['date'])) : ?>
                <?= $errors['date']; ?>
            <?php endif; ?>
            <label for="start">Démarrage</label>
            <input id="start" type="time" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>" class="time">
            <?php if (isset($errors['start'])) : ?>
                <?= $errors['start']; ?>
            <?php endif; ?>
            <label for="end">Fin</label>
            <input id="end" type="time" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>" class="time">
            <label for="description">Decription</label>
            <textarea id="description" name="description" placeholder="..." <?= isset($data['description']) ? h($data['description']) : ''; ?>></textarea>
            <button>Valider</button>
        </form>
    </section>
    <footer>
        <a class="ml">Mentions Légales</a>
    </footer>
</body>

</html>