<?php
class Card
{
    public $id;
    private $front;
    private $back;
    private $flip1;
    private $flip2;

    public function __construct($id)
    {
        $this->id = $id;
        $this->front = $_SESSION['board'][$id];
        $this->back = 'assets/img/cards/back_img.png';

        if (isset($_SESSION['flip1'])) {
            $this->flip1['id'] = $_SESSION['flip1']['id'];
            $this->flip1['front'] = $_SESSION['flip1']['front'];
        } else {
            $this->flip1['id'] = "";
            $this->flip1['front'] = "";
        }
        if (isset($_SESSION['flip2'])) {
            $this->flip2['id'] = $_SESSION['flip2']['id'];
            $this->flip2['front'] = $_SESSION['flip2']['front'];
        } else {
            $this->flip2['id'] = "";
            $this->flip2['front'] = "";
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function flippedCards()
    {
        if ($this->flip1['id'] === "") {

            $_SESSION['flip1']['id'] = $this->id;
            $_SESSION['flip1']['front'] = $this->front;
            $this->flip1['id'] = $this->id;
            $this->flip1['front'] = $this->front;
        } else {

            $_SESSION['flip2']['id'] = $this->id;
            $_SESSION['flip2']['front'] = $this->front;
            $this->flip2['id'] = $this->id;
            $this->flip2['front'] = $this->front;
        }
    }

    public function isFound()
    {
        if ($this->id === $this->flip1['id'] || $this->id === $this->flip2['id'] || in_array($this->id, $_SESSION['find'])) {
            return true;
        } else {
            return false;
        }
    }

    public function displayCard()
    {
        if ($this->isFound()) { ?>
            <img src="<?= $this->front ?>" alt="card" height="200px>" width="133px>">
        <?php
        } else { ?>
            <button type="submit" name="id" value="<?= $this->id ?>">
                <img src="<?= $this->back ?>" alt="card" height="200px" width="133px">
            </button>
<?php
        }
    }
}

?>