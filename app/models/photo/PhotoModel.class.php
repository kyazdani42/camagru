<?php
/*
 * this class handles image requests
 */

class PhotoModel extends Model {

    public function setPhoto($url, $login) {

        $param = array($login);
        $sql = "SELECT id FROM `user` WHERE login = ?";
        $loginId = self::request($sql, $param)->fetch()['id'];
        $param = array($url, $loginId);
        $query = "INSERT INTO images (`data`, `id_user`) VALUES (?, ?)";
        self::request($query, $param);
        $query = "SELECT MAX(`id`) AS `id` FROM images";
        return (self::request($query)->fetchAll()[0]['id']);

    }

    /*
     * gets all the images
     */

    public function getAllPhotos() {

        $sql = "SELECT `data`, `id` FROM `images` ORDER BY `id` desc";
        $content = self::request($sql);
        if ($content->rowCount() === 0) {
            throw new Exception("No photos in database");
        }
        return ($content->fetchAll());

    }

    /*
     * gets all images for one user
     */

    public function getAllUsrImg() {
        $param = array(SessionController::getLogin());
        $login = self::request("SELECT `id` from `user` WHERE login = ?", $param)->fetchAll()[0]['id'];
        $param = array($login);
        $query = "SELECT `data`, `id` FROM `images` WHERE id_user = ? ORDER BY `id` desc";
        return (self::request($query, $param)->fetchAll());
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
            $param = array($e);
            $query = "SELECT `data`, `id` FROM `images` WHERE id= ?";
            $data = self::request($query, $param)->fetchAll()[0]['data'];
            $elem[] = $data;
        }
        return (array_reverse($elem));

    }

    /*
     * delete one image and all likes and comments associated
     */

	public function deleteImg($id, $check = null) {

	    if ($check !== null) {
	        $param = array($id, SessionController::getLogin());
	        $queryCheck = "SELECT data FROM `images` 
	        INNER JOIN `user` ON images.id_user=user.id 
	        WHERE images.id= ? AND user.login = ?";
	        if (self::request($queryCheck, $param)->rowCount() === 0) {
	            throw new Exception("Not yours to delete !");
            }
        }
        $param = array($id);
        $getData = "SELECT `data` FROM `images` WHERE id = ?";
        $img = self::request($getData, $param)->fetchAll()[0]['data'];
		$query = "DELETE FROM `images` WHERE id = ?";
		$query2 = "DELETE FROM `infos` WHERE id_photo = ?";
		self::request($query, $param);
		self::request($query2, $param);
		unlink($img);
		return (0);

	}

	/*
	 * deletes all the images for one user, and all comments and likes associated
	 */

	public function deleteAllImg($id_user) {

        $query = "SELECT `id` FROM `images` WHERE id_user = ?";
        $param = array($id_user);
        $data = self::request($query, $param)->fetchAll();
        foreach ($data as $e => $key) {
            $this->deleteImg($key[0]);
        }

    }

    public function getLoginPic($id_photo) {

	    $query = "SELECT `login` FROM `user` INNER JOIN `images` ON user.id=images.id_user WHERE images.id = ?";
	    $param = array($id_photo);
	    return (self::request($query, $param)->fetchAll()[0]['login']);

    }

}