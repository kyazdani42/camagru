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

        $query = "SELECT `content` FROM `infos` WHERE id_photo='" . $photoId . "' ORDER BY id DESC";
        return (self::request($query, 1)->fetchAll());

    }

}
