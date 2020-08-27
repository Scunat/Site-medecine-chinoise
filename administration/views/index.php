<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1eea0c00ae.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Aladin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/ressources/css/connexion.css">
    <title>Médecine traditionelle chinoise-XIAO YU-connexion</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="logo"><a href="index.php"><img src="../../public/ressources/images/logo.jpg" alt=""></a></li>
                <div class="nav-link">
                    <li><a href="../../application/controllers/index.php">Mon site</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <section class="title">
        <h1>Connexion à mon compte</h1>
    </section>
    <section class="form">
        <form action="index.php" method="post">
            <label for="login">Votre adresse email</label>
            <input type="text" class="mail" name="email">
            <label for="hashed_password" class="mdp">Votre mot de passe</label>
            <input type="password" name="password">
            <button>Se connecter</button>
        </form>
    </section>
    <footer>
        <a class="ml">Mentions Légales</a>
    </footer>
</body>

</html>