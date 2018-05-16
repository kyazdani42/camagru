<?php

	/*
	 ** This class handles all comments modifications in db
	 */ 

class CommentModel extends Model {

    public function setComment($id_photo, $data) {

		$login = SessionController::getLogin();
		$param = array($login);
		$id = self::request("SELECT `id` FROM `user` WHERE login= ?", $param)->fetchAll()[0]['id'];
		$param = array($data, $id_photo, $id, date("Y-m-d H:i:s"));
        $query = "INSERT INTO `infos` (`content`, `id_photo`, `id_user`, `type`, `date`) VALUE (?, ?, ?, 'comment', ?)";
        self::request($query, $param);
        $query = "SELECT MAX(`id`) AS id FROM `infos`";
        return (self::request($query)->fetchAll()[0]['id']);

    }

    /*
     * this function gets all the comments from one user
     */
    public function getCommentUser() {

		$param = array(SessionController::getLogin());
        $query = "SELECT `content`, `id_photo` FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE user.login = ? AND type='comment' ORDER BY id DESC";
        return (self::request($query, $param)->fetchAll());

    }

    /*
     * this function gets all the comments from one image
     */
    public function getCommentPhoto($photoId) {

        $param = array($photoId);
        $query = "SELECT `content`, infos.id, `date`, user.login FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE id_photo = ? AND type='comment' ORDER BY id DESC";
        return (self::request($query, $param)->fetchAll());

    }

    public function checkComment($id_com) {

        $login = SessionController::getLogin();
        $param = array($id_com, $login);
        $query = "SELECT `id_photo` FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE infos.id = ? AND user.login = ? AND type='comment'";
        return (self::request($query, $param)->rowCount());

    }

    public function delComment($id_com) {

        $param = array($id_com);
        $query = "DELETE FROM `infos` WHERE id = ? AND type='comment'";
        self::request($query, $param);

    }

    public function checkUserComment($login, $id_photo) {

        $param = array($id_photo);
        $query = "SELECT `check` FROM `user` INNER JOIN `images` ON user.id=images.id_user WHERE images.id = ?";
        if (self::request($query, $param)->fetchAll()[0]['check']) {
            $query = "SELECT `id_user` FROM `images` WHERE id='" . $id_photo . "'";
            $id = self::request($query, $param)->fetchAll()[0]['id_user'];
            $param = array($id, $id_photo);
            $query = "SELECT `id` FROM `user` WHERE id = ? AND login = ?";
            return (self::request($query, $param)->rowCount());
        } else
            return (1);

    }

    public function getMailUsr($id_photo) {

        $param = array($id_photo);
        $query = "SELECT `email` FROM `user` INNER JOIN `images` ON user.id=images.id_user WHERE images.id = ?";
        return (self::request($query, $param)->fetchAll()[0]['email']);

    }

}
