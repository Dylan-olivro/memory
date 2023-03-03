<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory game</title>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/game.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/9a09d189de.js" crossorigin="anonymous"></script>

</head>

<body id="game">
    <?php require_once('./includes/header.php');
    if (!$player->isConnected()) {
        header('Location: login.php');
        exit();
    }
    if (isset($_POST['level'])) {
        $game->reset();
        $_SESSION['level'] = $_POST['level'];
        $_SESSION['new'] = true;

        $game->getCards();

        $_POST['level'] = null;
        unset($_POST['level']);
    }
    if (isset($_SESSION['level'])) {
        // Créer les cartes
        for ($i = 0; $i < ((int)$_SESSION['level'] * 2); $i++) {
            $card = new Card($i);
            $cards[] = $card;
        }
    }

    $_POST['card'] = null;
    unset($_POST['card']);
    ?>
    <main>

        <section class="board">
            <?php if (!isset($_SESSION['new'])) { ?>
                <div class="level">
                    <form method="post" action="">
                        <select name="level">
                            <option value="3">3 paires</option>
                            <option value="4">4 paires</option>
                            <option value="5">5 paires</option>
                            <option value="6">6 paires</option>
                            <option value="7">7 paires</option>
                            <option value="8">8 paires</option>
                            <option value="9">9 paires</option>
                            <option value="10">10 paires</option>
                            <option value="11">11 paires</option>
                            <option value="12">12 paires</option>
                        </select>
                        <input type="submit" value="Jouer" class="button">
                    </form>
                </div>
            <?php
            }

            if (isset($_SESSION['new'])) {
            ?>
                <div>
                    <form action="verif.php" method="post" class="cards_form">
                        <?php
                        foreach ($cards as $card) { ?>
                            <div class="">
                                <?php
                                $card->displayCard();
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>

            <?php }
            ?>
            <a href='game.php?reset=true'>Reset</a>

            </div>

        </section>
    </main>
    <?php
    require_once 'includes/footer.php'; ?>