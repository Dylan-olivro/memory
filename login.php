<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory game</title>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/9a09d189de.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once 'includes/header.php'; ?>
    <?php
    if ($player->isConnected()) {
        header('Location: index.php');
        exit();
    } ?>

    <main id="login">
        <form method="post" action="login.php">
            <h1>Connexion</h1>
            <label for="login-input">Login :</label>
            <input type="text" id="login-input" name="login">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">

            <?php
            if (isset($_POST['submit'])) {
                $login = trim(htmlspecialchars($_POST['login']));
                $password = trim(htmlspecialchars($_POST['password']));

                $player->connect($login, $password);
            }
            ?>

            <input type="submit" value="Connexion" class="button" name="submit">
            <p>Vous etes nouveau ici ?&nbsp;<a href="login.php">Inscription</a></p>
        </form>
    </main>

    <?php require_once 'includes/footer.php'; ?>