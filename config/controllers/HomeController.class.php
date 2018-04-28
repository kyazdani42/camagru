<?php

class HomeController extends Controller {

    private $_objPhoto;
    private $_objLike;
	private $_objCom;

    public function display() {

            parent::__construct();
            $photos = $this->_getImages();
            $this->_view->render('index', 'Home', 0, $photos);
    }

    private function _getImages() {

        $this->_objPhoto = new PhotoModel();
        $this->_objLike = new LikeModel();
		$this->_objCom = new CommentModel();
        try {
            $photos = $this->_objPhoto->getAllPhotos()->fetchAll();
        } catch (Exception $e) {
            return null;
        }
        return ($this->_getContent($photos));

    }

    private function _getContent( $array ) {

        foreach ($array as $e => $i) {
			$like = $this->_objLike->getLikesPhoto($i['id']);
			$flag = $this->_objLike->getFlagLike($i['id']);
			$comm = $this->_getComments($i['id']);
            $new[] = array('data' => $i['data'], 'likes' => $like, 'comments' => $comm, 'id_photo' => $i['id'], 'flag' => $flag);
        }
        return ($new);

    }

    private function _getComments($id_photo) {

        $obj = $this->_objCom->getCommentPhoto($id_photo);
        foreach ($obj as $e => $key) {
            $array[] = $key['content'];
        }
        return ($array);
    }

    public function sendComment($id_photo) {

        if (isset($_POST) && isset($_POST['comment']) && !empty($_POST['comment'] && strlen($_POST['comment']) < 255)) {
            $this->_objComm = new CommentModel();
            $data = $_POST['comment'];
            $this->_objComm->setComment($id_photo, $data);
        }
        header('location: ' . URL . 'Home');

    }

    public function sendLike($id_photo) {

        $this->_objLike = new LikeModel();
        $array = array($this->_objLike->setLike($id_photo), $this->_objLike->getLikesPhoto($id_photo));
        echo json_encode($array);
        unset($array);
        exit();
    }

}
