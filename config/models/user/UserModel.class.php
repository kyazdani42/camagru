<?php

class UserModel extends Model {

    public static function connect( $login, $password ) {

        $tmpLogin = $login;
        $tmpPass = hash('whirlpool', $password);
        $sql = "SELECT password, `active` FROM `user` WHERE login = '" . $tmpLogin . "'";
        if (($query = self::request($sql, 1))->rowCount() === 1) {
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

	/*
	 * delete user, all comments/likes associated, all photos and comment/likes associated to photos
	 */

    public function deleteAccount() {

		$login = SessionController::getLogin();
        $query = "DELETE FROM `user` WHERE user.login='" . $login . "'";

		$query2 = "DELETE FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE user.login='" . $login . "'";
		$query3 = "DELETE FROM `images` INNER JOIN `user` ON images.id_user=user.id WHERE user.login='" . $login . "'";
        self::request($query, 1);
		self::request($query2, 1);
		self::request($query3, 1);

    }

}
