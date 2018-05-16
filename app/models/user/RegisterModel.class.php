<?php

class RegisterModel extends Model {

    public function register( array $kwargs ) {

        $tmpLogin = $kwargs['login'];
        $tmpEmail = $kwargs['email'];
        $param_usr = array($tmpLogin);
        $param_mail = array($tmpEmail);
        $sql_user = "SELECT login FROM `user` WHERE login = ?";
        $sql_email = "SELECT email FROM `user` WHERE email = ?";

        if (self::request($sql_user, $param_usr)->rowCount() !== 0) {
            throw new Exception("login " . $tmpLogin . " is already taken");
        } else if (self::request($sql_email, $param_mail)->rowCount() !== 0) {
            throw new Exception("e-mail " . $tmpEmail . " is already used");
        } else {
            if (strlen($kwargs['password']) < 8) {
                throw new Exception("password must contain at least 8 characters");
            } else {
                $password = hash('whirlpool', $kwargs['password']);
                $hash = $tmpLogin . md5( rand(0,1000) );
                $param = array($tmpLogin, $tmpEmail, $password, $hash);
                $query = "INSERT INTO `user` (login, email, password, hash) VALUES (?, ?, ?, ?)";
                self::request($query, $param);
                return ( array('hash' => $hash, 'email' => $tmpEmail) );
            }
        }

    }

    public function verifyAccount($hash) {

        $sql = "SELECT `active` FROM `user` WHERE hash = '" . $hash . "'";
        $param = array($hash);
        if (($query = self::request($sql))->rowCount() === 1) {
            $sql = "UPDATE `user` SET active='1' WHERE hash = ?";
            self::request($sql, $param);
        } else {
            throw new Exception("The hash doesn't match any account");
        }

    }

}
