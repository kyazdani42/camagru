<?php

class PhotoModel extends Model {

    public function setPhoto($url, $login) {
        $sql = "SELECT id FROM `user` WHERE login='" . $login . "'";
        $loginId = $this->request($sql)->fetch()['id'];
        $query = "INSERT INTO images (`data`, `id_user`) VALUES ('" . $url . "', '" . $loginId . "')";
        $this->request($query, 1);
    }

    public function getAllPhotos() {
        $sql = "SELECT `data`, `id` FROM `images` ORDER BY `id` desc";
        $content = $this->request($sql, 1);
        if ($content->rowCount() === 0) {
            throw new Exception("No photos in database");
        }
        return ($content);
    }

    public function getAllUsrImg() {
        $login = self::request("SELECT `id` from `user` WHERE login='" . SessionController::getLogin() . "'", 1)->fetchAll()[0]['id'];
        $query = "SELECT `data`, `id` FROM `images` WHERE id_user='" . $login . "' ORDER BY `id` desc";
        return ($this->request($query, 1)->fetchAll());
    }

}