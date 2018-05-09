<?php

	/*
	 ** This class handles all comments modifications in db
	 */ 

class CommentModel extends Model {

    public function setComment($id_photo, $data) {

		$login = SessionController::getLogin();
		$id = self::request("SELECT `id` FROM `user` WHERE login='" . $login  . "'", 1)->fetchAll()[0]['id'];
        $query = "INSERT INTO `infos` (`content`, `id_photo`, `id_user`, `type`, `date`) VALUE ('" . $data. "', '" . $id_photo . "', '" . $id . "', 'comment', '" . date("Y-m-d H:i:s") . "')";
        self::request($query, 1);
        $query = "SELECT MAX(`id`) AS id FROM `infos`";
        return (self::request($query)->fetchAll()[0]['id']);

    }

    /*
     * this function gets all the comments from one user
     */
    public function getCommentUser() {

		$login = SessionController::getLogin();
        $query = "SELECT `content`, `id_photo` FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE user.login='" . $login . "' AND type='comment' ORDER BY id DESC";
        return (self::request($query, 1)->fetchAll());

    }

    /*
     * this function gets all the comments from one image
     */
    public function getCommentPhoto($photoId) {

        $query = "SELECT `content`, infos.id, `date`, user.login FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE id_photo='" . $photoId . "' AND type='comment' ORDER BY id DESC";
        return (self::request($query, 1)->fetchAll());

    }

    public function checkComment($id_com) {

        $login = SessionController::getLogin();
        $query = "SELECT `id_photo` FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE infos.id='" . $id_com . "' AND user.login='" . $login . "' AND type='comment'";
        return (self::request($query, 1)->rowCount());

    }

    public function delComment($id_com) {

        $query = "DELETE FROM `infos` WHERE id='" . $id_com . "' AND type='comment'";
        self::request($query, 1);

    }

    public function checkUserComment($login, $id_photo) {

        $query = "SELECT `check` FROM `user` INNER JOIN `images` ON user.id=images.id_user WHERE images.id='" . $id_photo . "'";
        if (self::request($query)->fetchAll()[0]['check']) {
            $query = "SELECT `id_user` FROM `images` WHERE id='" . $id_photo . "'";
            $id = self::request($query)->fetchAll()[0]['id_user'];
            $query = "SELECT `id` FROM `user` WHERE id='" . $id . "' AND login='" . $login . "'";
            return (self::request($query)->rowCount());
        } else
            return (1);

    }

    public function getMailUsr($id_photo) {

        $query = "SELECT `email` FROM `user` INNER JOIN `images` ON user.id=images.id_user WHERE images.id='" . $id_photo . "'";
        return (self::request($query, 1)->fetchAll()[0]['email']);

    }

}
