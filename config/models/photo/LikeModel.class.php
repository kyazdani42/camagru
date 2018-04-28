<?php

/*
 ** This class handles Likes modifications in db
 */

class LikeModel extends Model {

    public function setLike($id_photo) {

        $id_user = self::request("SELECT `id` FROM `user` WHERE login='" . SessionController::getLogin() . "'", 1)->fetchAll()[0]['id'];
        $queryCheck = "SELECT `id` FROM `infos` WHERE id_photo='" . $id_photo . "' AND id_user='" . $id_user . "' AND type='like'";
        if (self::request($queryCheck)->rowCount() === 1) {
            $query = "DELETE FROM `infos` WHERE id_user='" . $id_user . "' AND id_photo='" . $id_photo . "' AND type='like'";
            $ret = 0;
        } else {
            $query = "INSERT INTO `infos` (`id_photo`, `id_user`, `type`) VALUE ('" . $id_photo . "', '" . $id_user . "', 'like')";
            $ret = 1;
        }
        self::request($query, 1);
        return ($ret);

    }

    public function getLikesUser() {

        $login = self::request("SELECT `id` from `user` WHERE login='" . SessionController::getLogin() . "'", 1)->fetchAll()[0]['id'];
        $query = "SELECT `id` from `images` WHERE id_user='" . $login . "' AND type='like'";
        return (self::request($query, 1)->fetchAll());

    }

    public function getLikesPhoto($photoId) {

        $query = "SELECT `id` FROM `infos` WHERE id_photo='" . $photoId . "' AND type='like'";
        return (self::request($query, 1)->rowCount());

    }

    public function getFlagLike($photoId) {

		$login = SessionController::getLogin();
        $query = "SELECT `id` FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE id_photo='" . $photoId . "' AND user.login='" . $login . "' AND `type`='like'";
        return (self::request($query, 1)->rowCount());

    }

}
