<?php

class ContentModel extends Model {

    public function setPhoto($data, $login) {
        $sql = "SELECT id FROM `user` WHERE login='" . $login . "'";
        $loginId = $this->request($sql)->fetch()['id'];
        $query = "INSERT INTO images (`data`, `id_user`) VALUES ('" . $data . "', '" . $loginId . "')";
        $this->request($query, 1);
    }

    public function getAllPhotos() {
        $sql = "SELECT `data` FROM `images`";
        $content = $this->request($sql, 1);
        if ($content->rowCount() === 0) {
            throw new Exception("No photos in database");
        }
        return ($content);
    }

}