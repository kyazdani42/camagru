<?php

class UserModel extends Model {

    public function register( array $kwargs ) {

        $tmpLogin = $kwargs['login'];
        $tmpEmail = $kwargs['email'];
        $sql_user = "SELECT login FROM `user` WHERE login = '" . $tmpLogin . "'";
        $sql_email = "SELECT email FROM `user` WHERE email = '" . $tmpEmail . "'";

        if (self::request($sql_user)->rowCount() !== 0) {
            throw new Exception("login " . $tmpLogin . " is already taken");
        } else if (self::request($sql_email)->rowCount() !== 0) {
            throw new Exception("e-mail " . $tmpEmail . " is already used");
        } else {
            if (strlen($kwargs['password']) < 8) {
                throw new Exception("password must contain at least 8 characters");
            } else {
                $password = hash('whirlpool', $kwargs['password']);
                $hash = md5( rand(0,1000) );
                $query = "INSERT INTO `user` (login, email, password, hash) VALUES ('" . $tmpLogin . "', '" . $tmpEmail . "', '" . $password . "', '" . $hash . "')";
                self::request($query, 1);
                return ( array('hash' => $hash, 'email' => $tmpEmail) );
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
            $query = "UPDATE `user` SET login='" . $new . "' WHERE login='" . SessionController::getLogin() . "'";
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
            $query = "UPDATE `user` SET email='" . $new . "' WHERE login='" . SessionController::getLogin() . "'";
            self::request($query, 1);
        }
    }

    public function modPassword($newPassword) {
        if (strlen($newPassword) < 8) {
            throw new Exception("password must contain at least 8 characters");
        }
        $new = hash('whirlpool', $newPassword);
        $sql = "SELECT password FROM `user` WHERE login = '" . SessionController::getLogin() . "'";
        if (($query = self::request($sql))->fetch()['password'] === $new) {
            throw new Exception("Please enter a new password");
        } else {
            $query = "UPDATE `user` SET password='" . $new . "' WHERE login='" . SessionController::getLogin() . "'";
            $this->_password = $new;
            self::request($query, 1);
        }
    }

    public function deleteAccount() {
        $query = "DELETE FROM `user` WHERE login='" . SessionController::getLogin() . "'";
        self::request($query, 1);
    }

    public function verifyAccount($hash) {
        $sql = "SELECT `active` FROM `user` WHERE hash = '" . $hash . "'";
        if (($query = self::request($sql))->rowCount() === 1) {
            $sql = "UPDATE `user` SET active='1' WHERE hash='" . $hash . "'";
            self::request($sql, 1);
        } else {
            throw new Exception("The hash doesn't match any account");
        }
    }

}