<?php

class InfoModel extends Model {

    public function setComment($id_photo, $data) {

        $queryId = "SELECT `id` FROM `user` WHERE login='" . SessionController::getLogin() . "'";
        $id_user = self::request($queryId, 1)->fetchAll()[0]['id'];
        $type = 'comment';
        $query = "INSERT INTO `infos` (`content`, `id_photo`, `id_user`, `type`) VALUE ('" . $data. "', '" .
            $id_photo . "', '" . $id_user . "', '" . $type . "')";
        self::request($query, 1);

    }

    public function setLike($id_photo) {

        $queryId = "SELECT `id` FROM `user` WHERE login='" . SessionController::getLogin() . "'";
        $id_user = self::request($queryId, 1)->fetchAll()[0]['id'];
        $queryCheck = "SELECT id FROM `infos` WHERE id_photo='" . $id_photo . "' AND id_user='" . $id_user .
            "' AND type='like'";

        if (self::request($queryCheck)->rowCount() === 1) {
            $query = "DELETE FROM `infos` WHERE id_user='" . $id_user . "' AND id_photo='" . $id_photo . "' AND type='like'";
        } else {
            $type = 'like';
            $query = "INSERT INTO `infos` (`id_photo`, `id_user`, `type`) VALUE ('" . $id_photo . "', '" .
                $id_user . "', '" . $type . "')";
        }
        self::request($query, 1);

    }

    public function getComment($photoId) {

        $query = "SELECT `content` FROM `infos` WHERE id_photo='" . $photoId . "'";
        return (self::request($query, 1)->fetchAll());
    }

    public function getLike($photoId) {

        $query = "SELECT `id` FROM `infos` WHERE id_photo='" . $photoId . "' AND type='like'";
        return (self::request($query, 1)->rowCount());

    }

    public function getFlagLike($photoId) {
        $sql = "SELECT `id` FROM `user` WHERE login='" . SessionController::getLogin() . "'";
        $id = self::request($sql, 1)->fetchAll()[0]['id'];
        $query = "SELECT `id` FROM `infos` WHERE id_photo='" . $photoId . "' AND id_user='" . $id . "' AND `type`='like'";
        return (self::request($query, 1)->rowCount());
    }

}