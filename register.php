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
    <link rel="stylesheet" href="assets/css/register.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/9a09d189de.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once 'includes/header.php';

    if (isset($_POST['submit'])) {

        $login = trim(htmlspecialchars($_POST['login']));
        $password = trim(htmlspecialchars($_POST['password']));
        $password2 = trim(htmlspecialchars($_POST['password2']));

        if (empty($login)) {
            $error = "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspVeuillez saisir un login.</p>";
        } elseif (empty($password)) {
            $error = "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspVeuillez saisir un mot de passe.</p>";
        } elseif (empty($password2)) {
            $error = "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspVeuillez confirmer le mot de passe.</p>";
        } elseif ($password !== $password2) {
            $error = "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspLes mots de passe ne correspondent pas.</p>";
        } else {
            $error = $player->register($login, $password);
            header("Refresh:1; url=Location: login.php");
        }
    }
    ?>

    <main id="register">
        <form method="post" action="register.php">
            <h1>Inscription</h1>
            <label for="login-input">Login</label>
            <input type="text" id="login-input" name="login">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">

            <label for="password2">Confirmez le mot de passe</label>
            <input type="password" id="password2" name="password2">

            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>

            <input type="submit" value="Inscription" class="button" name="submit">
            <p>Deja inscrit ?&nbsp;<a href="login.php">Connexion</a></p>

        </form>
    </main>
    <?php require_once 'includes/footer.php'; ?>