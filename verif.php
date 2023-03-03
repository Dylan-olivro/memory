<?php
session_start();
require_once 'includes/header.php';

if (isset($_SESSION['level'])) {
    for ($i = 0; $i < ((int)$_SESSION['level'] * 2); $i++) {
        $card = new Card($i);
        $cards[] = $card;
    }
}

if (isset($_POST['id'])) {
    // Le joueur a cliqué sur une carte
    foreach ($cards as $card) {
        if ($_POST['id'] == $card->id) {
            $card->flippedCards();
            header('Location: game.php');
        }
    }
}
