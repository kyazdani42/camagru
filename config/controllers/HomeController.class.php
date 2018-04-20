<?php

class HomeController extends Controller {

    private $_obj;

    public function display() {

            parent::__construct();
            $photos = $this->_getImages();
            $this->_view->render('index', 'Home', 0, $photos);
    }

    private function _getImages() {
        $this->_obj = new ContentModel();
        try {
            $photos = $this->_obj->getAllPhotos()->fetchAll();
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
        return ($this->_obj->getFlagLike($id_photo));
    }

    private function _getLikes($id_photo) {

        return ($this->_obj->getLike($id_photo));

    }

    private function _getComments($id_photo) {

        $obj = $this->_obj->getComment($id_photo);
        foreach ($obj as $e => $key) {
            $array[] = htmlspecialchars(base64_decode($key['content']));
        }
        return ($array);
    }

    public function sendComment($id_photo) {

        if (isset($_POST) && isset($_POST['comment']) && !empty($_POST['comment'] && strlen($_POST['comment']) < 255)) {
            $this->_obj = new ContentModel();
            $data = base64_encode($_POST['comment']);
            $this->_obj->setComment($id_photo, $data);
        }
        header('location: ' . URL . 'Home');

    }

    public function sendLike($id_photo) {

        $this->_obj = new ContentModel();
        $this->_obj->setLike($id_photo);
        header('location: ' . URL . 'Home');
    }

}