<?php

class HomeController extends Controller {

    private $_objPhoto;
    private $_objInfo;

    public function display() {

            parent::__construct();
            $photos = $this->_getImages();
            $this->_view->render('index', 'Home', 0, $photos);
    }

    private function _getImages() {
        $this->_objPhoto = new PhotoModel();
        $this->_objInfo = new InfoModel();
        try {
            $photos = $this->_objPhoto->getAllPhotos()->fetchAll();
        } catch (Exception $e) {
            return null;
        }
        return ($this->_getContent($photos));
    }

    private function _getContent( $array ) {

        foreach ($array as $e => $i) {
            $new[] = array('data' => $i['data'], 'likes' => $this->_getLikes($i['id']),
                'comments' => $this->_getComments($i['id']), 'id_photo' => $i['id'], 'flag' => $this->_getFlagLike($i['id']));
        }
        return ($new);
    }

    private function _getFlagLike($id_photo) {
        return ($this->_objInfo->getFlagLike($id_photo));
    }

    private function _getLikes($id_photo) {

        return ($this->_objInfo->getLike($id_photo));

    }

    private function _getComments($id_photo) {

        $obj = $this->_objInfo->getComment($id_photo);
        foreach ($obj as $e => $key) {
            $array[] = htmlspecialchars(base64_decode($key['content']));
        }
        return ($array);
    }

    public function sendComment($id_photo) {

        if (isset($_POST) && isset($_POST['comment']) && !empty($_POST['comment'] && strlen($_POST['comment']) < 255)) {
            $this->_objInfo = new InfoModel();
            $data = base64_encode($_POST['comment']);
            $this->_objInfo->setComment($id_photo, $data);
        }
        header('location: ' . URL . 'Home');

    }

    public function sendLike($id_photo) {

        $this->_objInfo = new InfoModel();
        $this->_objInfo->setLike($id_photo);
        header('location: ' . URL . 'Home');
    }

}