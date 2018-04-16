<?php

require_once 'Model.class.php';

class User extends Model {

    private $_login;
    private $_password;
    private $_email;

    public function __construct( array $kwargs ) {
        if (strlen($kwargs['password']) < 8)
            throw new Exception("password must contain at least 8 characters");
        $tmpLogin = htmlspecialchars($kwargs['login']);
        $tmpEmail = htmlspecialchars($kwargs['email']);
        $sql_user = "SELECT login FROM `user` WHERE login = '" . $tmpLogin . "'";
        $sql_email = "SELECT email FROM `user` WHERE email = '" . $tmpEmail . "'";

        if ($this->request($sql_user)->rowCount() !== 0) {
            throw new Exception("login " . $tmpLogin . " is already taken");
        } else if ($this->request($sql_email)->rowCount() !== 0) {
            throw new Exception("e-mail " . $tmpEmail . " is already used");
        } else {
            $this->_login = $tmpLogin;
            $this->_email = $tmpEmail;
            $this->_password = hash('whirlpool', $kwargs['password']);
            $query = "INSERT INTO `user` (login, email, password) VALUES ('" . $this->_login . "', '" . $this->_email . "', '" . $this->_password . "')";
            $this->request($query, 1);
        }
    }

    public static function connect( $login, $password ) {
        $tmpLogin = htmlspecialchars($login);
        $tmpPass = hash('whirlpool', $password);
        $sql = "SELECT password FROM `user` WHERE login = '" . $tmpLogin . "'";
        if (($query = self::request($sql))->rowCount() === 1) {
            if ($query->fetch()['password'] === $tmpPass) {
                return ($tmpLogin);
            } else {
                throw new Exception("Wrong password");
            }
        } else {
            throw new Exception("Wrong login");
        }
    }

    public function modLogin($newLogin) {
        $new = htmlspecialchars($newLogin);
        $sql = "SELECT login FROM `user` WHERE login = '" . $new . "'";
        if (($query = self::request($sql))->rowCount() !== 0) {
            throw new Exception("login " . $new . " is already taken");
        } else {
            $query = "UPDATE `user` SET login='" . $new . "' WHERE login='" . $this->_login . "'";
            $this->_login = $new;
            self::request($query, 1);
        }
    }

    public function modEmail($newEmail) {
        $new = htmlspecialchars($newEmail);
        $sql = "SELECT email FROM `user` WHERE email = '" . $new . "'";
        if (($query = self::request($sql))->rowCount() !== 0) {
            throw new Exception("email " . $new . " is already taken");
        } else {
            $query = "UPDATE `user` SET email='" . $new . "' WHERE email='" . $this->_email . "'";
            $this->_email = $new;
            self::request($query, 1);
        }
    }

    public function modPassword($newPassword) {
        $new = hash('whirlpool', $newPassword);
        $sql = "SELECT password FROM `user` WHERE login = '" . $this->_login . "'";
        if (($query = self::request($sql))->fetch()['password'] === $new) {
            throw new Exception("Please enter a new password");
        } else {
            $query = "UPDATE `user` SET password='" . $new . "' WHERE login='" . $this->_login . "'";
            $this->_password = $new;
            self::request($query, 1);
        }
    }

}