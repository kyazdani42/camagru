<?php
/*
 * this class handles image requests
 */

class PhotoModel extends Model {

    public function setPhoto($url, $login) {

        $sql = "SELECT id FROM `user` WHERE login='" . $login . "'";
        $loginId = self::request($sql, 1)->fetch()['id'];
        $query = "INSERT INTO images (`data`, `id_user`) VALUES ('" . $url . "', '" . $loginId . "')";
        self::request($query);
        $query = "SELECT MAX(`id`) AS `id` FROM images";
        return (self::request($query)->fetchAll()[0]['id']);

    }

    /*
     * gets all the images
     */

    public function getAllPhotos() {

        $sql = "SELECT `data`, `id` FROM `images` ORDER BY `id` desc";
        $content = self::request($sql, 1);
        if ($content->rowCount() === 0) {
            throw new Exception("No photos in database");
        }
        return ($content->fetchAll());

    }

    /*
     * gets all images for one user
     */

    public function getAllUsrImg() {
        $login = self::request("SELECT `id` from `user` WHERE login='" . SessionController::getLogin() . "'", 1)->fetchAll()[0]['id'];
        $query = "SELECT `data`, `id` FROM `images` WHERE id_user='" . $login . "' ORDER BY `id` desc";
        return (self::request($query, 1)->fetchAll());
    }

    /*
     * get session images
     */
    public function getSessionImg() {

        $array = $_SESSION['imageSession'];
        if ($array === null) {
            return (null);
        }
        $elem = array();
        foreach ($array as $e) {
            $query = "SELECT `data`, `id` FROM `images` WHERE id='" . $e . "'";
            $data = self::request($query, 1)->fetchAll()[0]['data'];
            $elem[] = $data;
        }
        return (array_reverse($elem));

    }

    /*
     * delete one image and all likes and comments associated
     */

	public function deleteImg($id, $check = null) {

	    if ($check !== null) {
	        $queryCheck = "SELECT data FROM `images` 
	        INNER JOIN `user` ON images.id_user=user.id 
	        WHERE images.id='" . $id . "' AND user.login='" . SessionController::getLogin() . "'";
	        if (self::request($queryCheck)->rowCount() === 0) {
	            throw new Exception("Not yours to delete !");
            }
        }
        $getData = "SELECT `data` FROM `images` WHERE id='" . $id . "'";
        $img = self::request($getData)->fetchAll()[0]['data'];
		$query = "DELETE FROM `images` WHERE id='" . $id . "'";
		$query2 = "DELETE FROM `infos` WHERE id_photo='" . $id . "'";
		self::request($query, 1);
		self::request($query2, 1);
		unlink($img);
		return (0);

	}

	/*
	 * deletes all the images for one user, and all comments and likes associated
	 */

	public function deleteAllImg($id_user) {

        $query = "SELECT `id` FROM `images` WHERE id_user='" . $id_user . "'";
        $data = self::request($query)->fetchAll();
        foreach ($data as $e => $key) {
            $this->deleteImg($key[0]);
        }

    }

}