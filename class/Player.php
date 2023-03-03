<?php require_once 'autoloader.php'; ?>

<?php

class Player
{
    public $id;
    public $login;
    private $password;
    public $level;
    public $score;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        if (isset($_SESSION['login'])) {
            $this->login = $_SESSION['login']['login'];
            $this->id = $_SESSION['login']['id'];
        }
    }
    public function register($login, $password)
    {
        if (!empty($login) && !empty($password)) {
            $request = "SELECT * FROM players WHERE login = :login ";
            $select = $this->db->getPdo()->prepare($request);
            $select->execute([':login' => $login]);
            $fetch = $select->fetchAll();
            $row = count($fetch);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if ($row == 0) {
                $register = "INSERT INTO players (login, password) VALUES (:login, :password)";
                $insert = $this->db->getPdo()->prepare($register);
                $insert->execute([
                    ':login' => $login,
                    ':password' => $hashed_password
                ]);

                echo "Registration successful!";
                header('Location: login.php');
            } else {
                $error = "This login already exists!";
                return $error;
            }
        } else {
            echo "You must fill in all fields!";
        }
    }
    public function connect($login, $password)
    {
        if (!empty($login) && !empty($password)) {
            $request = "SELECT password FROM players WHERE login = :login";
            $select = $this->db->getPdo()->prepare($request);
            $select->execute([':login' => $login]);
            $result = $select->fetch();

            if ($result == true) {

                $hashed_password = $result['password'];

                if (password_verify($password, $hashed_password)) {
                    $request = "SELECT * FROM players WHERE login = :login";
                    $select = $this->db->getPdo()->prepare($request);
                    $select->execute([':login' => $login]);
                    $result = $select->fetch();

                    $_SESSION['login'] = [
                        'id' => $result['id'],
                        'login' => $login,
                    ];
                    header('Location: index.php');
                } else {
                    echo "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspLogin ou mot de passe incorrect !</p>";
                }
            } else {
                echo "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspLogin ou mot de passe incorrect !</p>";
            }
        } else {
            echo "<p><i class='fa-solid fa-triangle-exclamation'></i>&nbspVous devez remplir tous les champs !</p>";
        }
    }
    public function disconnect()
    {
        if ($this->isConnected()) {
            $this->login = null;
            session_unset();
            session_destroy();
        } else {
            echo "Vous n'êtes pas connecté(e) !";
        }
    }
    public function isConnected()
    {
        if ($this->login != null) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllInfos()
    {
        if ($this->isConnected()) {   ?>
            <table border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>id</td>
                        <th>login</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?php echo $this->id; ?></td>
                        <td><?php echo $this->login; ?></td>
                    </tr>
                </tbody>
            </table>

<?php
        } else {
            echo "Vous devez être connecté(e) pour voir vos informations !";
        }
    }
    public function getLogin()
    {
        if ($this->isConnected()) {
            return $this->login;
        } else {
            echo "Vous devez être connecté(e) pour voir vos informations !";
        }
    }
    public function getId()
    {
        return $this->id;
    }
}
