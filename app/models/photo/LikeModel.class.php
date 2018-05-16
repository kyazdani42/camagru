<?php

/*
 ** This class handles Likes modifications in db
 */

class LikeModel extends Model {

    public function setLike($id_photo) {

        $param = array(SessionController::getLogin());
        $id_user = self::request("SELECT `id` FROM `user` WHERE login= ?", $param)->fetchAll()[0]['id'];
        $param = array($id_photo, $id_user);
        $queryCheck = "SELECT `id` FROM `infos` WHERE id_photo = ? AND id_user = ? AND type='like'";
        if (self::request($queryCheck, $param)->rowCount() === 1) {
            $param = array($id_user, $id_photo);
            $query = "DELETE FROM `infos` WHERE id_user = ? AND id_photo = ? AND type='like'";
            $ret = 0;
        } else {
            $param = array($id_photo, $id_user);
            $query = "INSERT INTO `infos` (`id_photo`, `id_user`, `type`) VALUE (?, ?, 'like')";
            $ret = 1;
        }
        self::request($query, $param);
        return ($ret);

    }

    /*
     * gets all the likes for one user
     */

    public function getLikesUser() {

        $param = array(SessionController::getLogin());
        $login = self::request("SELECT `id` from `user` WHERE login = ?", $param)->fetchAll()[0]['id'];
        $param = array($login);
        $query = "SELECT `id` from `images` WHERE id_user = ? AND type='like'";
        return (self::request($query, $param)->fetchAll());

    }

    /*
     * get all the likes for one image
     */

    public function getLikesPhoto($photoId) {

        $param = array($photoId);
        $query = "SELECT `id` FROM `infos` WHERE id_photo = ? AND type='like'";
        return (self::request($query, $param)->rowCount());

    }

    /*
     * check if image is already liked by user, returns 0 or 1
     */

    public function getFlagLike($photoId) {

		$login = SessionController::getLogin();
		$param = array($photoId, $login);
        $query = "SELECT infos.id FROM `infos` INNER JOIN `user` ON infos.id_user=user.id WHERE id_photo = ? AND user.login = ? AND `type`='like'";
        return (self::request($query, $param)->rowCount());

    }

}
