<?php

class UserModel extends Model {

    public function connect( $login, $password ) {

        $tmpLogin = $login;
        $tmpPass = hash('whirlpool', $password);
        $sql = "SELECT password, `active` FROM `user` WHERE login = ?";
        $params = array($tmpLogin);
        if (($query = self::request($sql, $params))->rowCount() === 1) {
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
		$param = array($login);
		$query = "SELECT `id` FROM `user` WHERE login = ?";
		$id_user = self::request($query, $param)->fetchAll()[0]['id'];
		unset($param);
		$param = array($id_user);
		$query = "DELETE FROM `infos` WHERE id_user = ?";
		self::request($query, $param);
		$photo = new PhotoModel();
		$photo->deleteAllImg($id_user);
		unset($param);
		$param = array($login);
		$query = "DELETE FROM `user` WHERE login = ?";
		self::request($query, $param);

    }

    /*
     * checks if mail must be sent to user when receiving comment on a photo
     */

    public function getMail() {

        $param = array(SessionController::getLogin());
        $query = "SELECT `check` FROM `user` WHERE login = ?";
        return (self::request($query, $param)->fetchAll()[0]['check']);

    }

    public function setMail() {

        $login = SessionController::getLogin();
        if ($this->getMail() === '0') {
            $val = '1';
        } else {
            $val = '0';
        }
        $query = "UPDATE `user` SET `check` = ? WHERE login = ?";
        $param = array($val, $login);
        self::request($query, $param);
        return ($val);

    }

    public function checkHash($hash) {

        $param = array($hash);
        $query = "SELECT `login` FROM `user` WHERE hash = ?";
        if (($mail = self::request($query, $param))->rowCount() === 1) {
            return ($mail->fetchAll()[0]['login']);
        } else {
            return (null);
        }

    }

    public function setHash($mail) {

        $hash = md5(rand(0, 1000)) . preg_replace("/@.+/", "", $mail);
        while ($this->checkHash($hash) !== null) {
            $hash = md5(rand(0, 1000)) . preg_replace("/@.+/", "", $mail);
        }
        $param = array($mail);
        $query = "SELECT `active` FROM `user` WHERE email = ?";
        if (self::request($query, $param)->fetchAll()[0]['active'] === 0) {
            return (null);
        }
        $param = array($hash, $mail);
        $query = "UPDATE `user` SET `hash` = ? WHERE email = ?";
        self::request($query, $param);
        return ($hash);
    }
}
