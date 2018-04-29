<?php

class UserModel extends Model {

    public static function connect( $login, $password ) {

        $tmpLogin = $login;
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

    public function deleteAccount() {

        $query = "DELETE FROM `user` WHERE login='" . SessionController::getLogin() . "'";
        self::request($query, 1);
    }

}
