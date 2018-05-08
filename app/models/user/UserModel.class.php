<?php

class UserModel extends Model {

    public function connect( $login, $password ) {

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
		$query = "SELECT `id` FROM `user` WHERE login='" . $login . "'";
		$id_user = self::request($query)->fetchAll()[0]['id'];
		$queryInfo = "DELETE FROM `infos` WHERE id_user='" . $id_user . "'";
		self::request($queryInfo);
		$photo = new PhotoModel();
		$photo->deleteAllImg($id_user);
		$query = "DELETE FROM `user` WHERE login='" . $login . "'";
		self::request($query, 1);

    }

    /*
     * checks if mail must be sent to user when receiving comment on a photo
     */

    public function getMail() {

        $login = SessionController::getLogin();
        $query = "SELECT `check` FROM `user` WHERE login='" . $login . "'";
        return (self::request($query, 1)->fetchAll()[0]['check']);

    }

    public function setMail() {

        $login = SessionController::getLogin();
        if ($this->getMail() === '0') {
            $val = '1';
        } else {
            $val = '0';
        }
        $query = "UPDATE `user` SET `check` = '" . $val . "' WHERE login='" . $login . "'";
        self::request($query, 1);
        return ($val);

    }

    public function checkHash($hash) {

        $query = "SELECT `login` FROM `user` WHERE hash='" . $hash . "'";
        if (($mail = self::request($query, 1))->rowCount() === 1) {
            return ($mail->fetchAll()[0]['login']);
        } else {
            return (null);
        }

    }

}
