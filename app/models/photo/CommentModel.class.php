<?php

	/*
	 ** This class handles all comments modifications in db
	 */ 

class CommentModel extends Model {

    public function setComment($id_photo, $data) {

		$login = SessionController::getLogin();
		$id = self::request("SELECT `id` FROM `user` WHERE login='" . $login  . "'", 1)->fetchAll()[0]['id'];
        $query = "INSERT INTO `infos` (`content`, `id_photo`, `id_user`, `type`) VALUE ('" . $data. "', '" . $id_photo . "', '" . $id . "', 'comment')";
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

        $query = "SELECT `content`, `id` FROM `infos` WHERE id_photo='" . $photoId . "' AND type='comment' ORDER BY id DESC";
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

}
