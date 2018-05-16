<?php

class ModifModel extends Model {

	    public function modLogin($newLogin) {
        $sql = "SELECT login FROM `user` WHERE login = ?";
        $param = array($newLogin);
        if (($query = self::request($sql, $param))->rowCount() !== 0) {
            throw new Exception("login " . $newLogin . " is already taken");
        } else {
            $query = "UPDATE `user` SET login = ? WHERE login = ?";
            $param = array($newLogin, SessionController::getLogin());
            self::request($query, $param);
        }
    }

    public function modEmail($newEmail) {

        $new = $newEmail;
        $param = array($new);
        $sql = "SELECT email FROM `user` WHERE email = ?";
        if (($query = self::request($sql, $param))->rowCount() !== 0) {
            throw new Exception("email " . $new . " is already taken");
        } else {
            $param = array($new, SessionController::getLogin());
            $query = "UPDATE `user` SET email= ? WHERE login = ?";
            self::request($query, $param);
        }
    }

    public function modPassword($newPassword) {

        $new = hash('whirlpool', $newPassword);
        $param = array(SessionController::getLogin());
        $sql = "SELECT password FROM `user` WHERE login = ?";
        if (($query = self::request($sql, $param))->fetch()['password'] === $new) {
            throw new Exception("Please enter a new password");
        } else {
            $param = array($new, SessionController::getLogin());
            $query = "UPDATE `user` SET password= ? WHERE login = ?";
            self::request($query, 1);
        }
    }

    public function resetPass($newPassword, $login) {

        $new = hash('whirlpool', $newPassword);
        $param = array($new, $login);
        $query = "UPDATE `user` SET password = ? WHERE login = ?";
        self::request($query, $param);
    }
	
}
