<?php
$dbh = new PDO(
    'mysql:host=localhost;dbname=xiaoyu;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
//var_dump($dbh);


if (!empty($_POST)) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $query = 'SELECT id, email, password
              FROM user
              WHERE email = :email';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':email', $email, PDO::PARAM_STR);
    $sth->execute();
    $authentication = $sth->fetch();
    if ($authentication !== false AND password_verify($password, $authentication['password'])) {
        $_SESSION['authentication'] = intval(($authentication['id']));
        header('Location:account.php');
        exit;
    } else {
        header('Location:index.php');
        exit;
    }
}

require '../../administration/views/index.phtml';
