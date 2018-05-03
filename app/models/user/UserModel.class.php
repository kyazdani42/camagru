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
		$query = "SELECT `id` FROM `user` WHERE login='" . $login . "'";
		$id_user = $this->request($query)->fetchAll()[0]['id'];
		$queryInfo = "DELETE FROM `infos` WHERE id_user='" . $id_user . "'";
		$this->request($queryInfo);
		$photo = new PhotoModel();
		$photo->deleteAllImg($id_user);
		$query = "DELETE FROM `user` WHERE login='" . $login . "'";
		$this->request($query, 1);

    }

    /*
     * checks if mail must be sent to user when receiving comment on a photo
     */

    public function checkMail() {

        $login = SessionController::getLogin();
        $query = "SELECT `check` FROM `user` WHERE login='" . $login . "'";
        return ($this->request($query, 1)->fetchAll()[0]['check']);

    }

}
