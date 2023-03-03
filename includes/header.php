<?php require_once 'autoloader.php';

$db = new DbConnect();
$player = new Player($db);
$game = new Game();

if (isset($_GET['logout'])) {

    if ($_GET['logout'] == true) {
        $player->disconnect();
        header('Location: index.php');
    }
}

if (isset($_GET['reset'])) {
    $game->reset();
    header('Location: game.php');
}
?>
<header>
    <?php
    if ($player->isConnected()) { ?>

        <nav>
            <span>Bienvenue <?= $player->getLogin(); ?></span>
            <a href="index.php">Accueil</a>
            <a href="game.php">Jouer</a>
            <a href="scores.php">Classement</a>
            <a href="index.php?logout=true">Deconnexion</a>
        </nav>

    <?php } else {
    ?>
        <nav id="navigation" role="navigation" class="row flex-end">
            <a href="index.php">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        </nav>
    <?php
    }
    ?>

</header>