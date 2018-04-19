<?php

class UserModel extends Model {

    private $_login;
    private $_password;
    private $_email;

    public function register( array $kwargs ) {

        $tmpLogin = $kwargs['login'];
        $tmpEmail = $kwargs['email'];
        $sql_user = "SELECT login FROM `user` WHERE login = '" . $tmpLogin . "'";
        $sql_email = "SELECT email FROM `user` WHERE email = '" . $tmpEmail . "'";

        if ($this->request($sql_user)->rowCount() !== 0) {
            throw new Exception("login " . $tmpLogin . " is already taken");
        } else if ($this->request($sql_email)->rowCount() !== 0) {
            throw new Exception("e-mail " . $tmpEmail . " is already used");
        } else {
            if (strlen($kwargs['password']) < 8) {
                throw new Exception("password must contain at least 8 characters");
            } else {
                $this->_login = $tmpLogin;
                $this->_email = $tmpEmail;
                $this->_password = hash('whirlpool', $kwargs['password']);
                $hash = md5( rand(0,1000) );
                $query = "INSERT INTO `user` (login, email, password, hash) VALUES ('" . $this->_login . "', '" . $this->_email . "', '" . $this->_password . "', '" . $hash . "')";
                $this->request($query, 1);
                return ( array('hash' => $hash, 'email' => $this->_email) );
            }
        }
    }

    public static function connect( $login, $password ) {
        $tmpLogin = htmlspecialchars($login);
        $tmpPass = hash('whirlpool', $password);
        $sql = "SELECT password, `active` FROM `user` WHERE login = '" . $tmpLogin . "'";
        if (($query = self::request($sql))->rowCount() === 1) {
            $tab = $query->fetchAll();
            if ($tab[0]['password'] === $tmpPass) {
                if ($tab[0]['active'] === '0') {
                    throw new Exception("Please validate your email");
                } else {
                    return ($tmpLogin);
                }
            } else {
                throw new Exception("Wrong password");
            }
        } else {
            throw new Exception("Wrong login");
        }
    }

    public function setActive($login) {
        $sql = "UPDATE `user` SET active='1' WHERE login = '" . $login . "'";
        self::request($sql, 1);
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

    public function verifyAccount($hash) {
        $sql = "SELECT `active` FROM `user` WHERE hash = '" . $hash . "'";
        if (($query = self::request($sql))->rowCount() === 1) {
            $sql = "UPDATE `user` SET active='1' WHERE hash='" . $hash . "'";
            $this::request($sql, 1);
        }
    }

}