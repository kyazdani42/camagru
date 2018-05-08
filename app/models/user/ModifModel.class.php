<?php

class ModifModel extends Model {

	    public function modLogin($newLogin) {
        $sql = "SELECT login FROM `user` WHERE login = '" . $newLogin . "'";
        if (($query = self::request($sql))->rowCount() !== 0) {
            throw new Exception("login " . $newLogin . " is already taken");
        } else {
            $query = "UPDATE `user` SET login='" . $newLogin . "' WHERE login='" . SessionController::getLogin() . "'";
            self::request($query, 1);
        }
    }

    public function modEmail($newEmail) {

        $new = $newEmail;
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
            self::request($query, 1);
        }
    }

    public function resetPass($newPassword, $login) {
        if (strlen($newPassword) < 8) {
            throw new Exception("password must contain at least 8 characters");
        }
        $new = hash('whirlpool', $newPassword);
        $query = "UPDATE `user` SET password='" . $new . "' WHERE login='" . $login . "'";
        self::request($query, 1);
    }
	
}
