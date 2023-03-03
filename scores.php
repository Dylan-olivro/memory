<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory</title>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/score.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/9a09d189de.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once 'includes/header.php';

    if (!$player->isConnected()) {
        header('Location: login.php');
        exit();
    }
    ?>
    <main id="scores">
        <div class="container">
            <h1>Score</h1>
        </div>
    </main>

    <?php require_once 'includes/footer.php'; ?>