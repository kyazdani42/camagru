<?php

class RegisterModel extends Model {

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
                $hash = $tmpLogin . md5( rand(0,1000) );
                $query = "INSERT INTO `user` (login, email, password, hash) VALUES ('" . $tmpLogin . "', '" . $tmpEmail . "', '" . $password . "', '" . $hash . "')";
                self::request($query, 1);
                return ( array('hash' => $hash, 'email' => $tmpEmail) );
            }
        }

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
