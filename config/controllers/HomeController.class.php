<?php

class HomeController extends Controller {

    private $_objPhoto;
    private $_objLike;
	private $_objCom;

    public function display() {

            parent::__construct();
            $photos = $this->getImages();
            $this->_view->render('index', 'Home', 0, $photos);
    }

    public function getImages() {

        $this->_objPhoto = new PhotoModel();
        $this->_objLike = new LikeModel();
		$this->_objCom = new CommentModel();
		$new = array();
        try {
            $photos = $this->_objPhoto->getAllPhotos();
        } catch (Exception $e) {
            return null;
        }
		foreach ($photos as $e => $i) {
			$like = $this->_objLike->getLikesPhoto($i['id']);
			$flag = $this->_objLike->getFlagLike($i['id']);
			$comm = $this->getComments($i['id']);
            $new[] = array('data' => $i['data'], 'likes' => $like, 'comments' => $comm, 'id_photo' => $i['id'], 'flag' => $flag);
		}
        return ($new);

    }

    public function getComments($id_photo) {

        if ($this->_objCom === null)
            $this->_objCom = new CommentModel();
        $obj = $this->_objCom->getCommentPhoto($id_photo);
        $array = array();
        foreach ($obj as $e => $key) {
            $check = $this->_objCom->checkComment($key['id']);
            $array[] = array('com' => $key['content'], 'id' => $key['id'], "check" => $check);
        }
		if (self::_isAjax())
			echo json_encode($array);
		else
        	return ($array);
		
    }

    public function sendComment($id_photo) {

        if (isset($_POST) && isset($_POST['comment']) && !empty($_POST['comment'])) {
			if (strlen($_POST['comment']) > 255) {
				if (self::_isAjax()) {
					echo json_encode(array("error", "comment is too long"));
					die();
				}
				SessionController::setSession("error", "comment is too long");
			} else {
            	$this->_objCom = new CommentModel();
           		$data = $_POST['comment'];
            	$this->_objCom->setComment($id_photo, $data);
				if (self::_isAjax()) {
					echo json_encode(array($data));
					die();
				}
			}
		}
		if (self::_isAjax()) {
			echo json_encode(array("error", "please say something"));
			die();
		}
        header('location: ' . URL . 'Home');

    }

    public function sendLike($id_photo) {

        $this->_objLike = new LikeModel();
        $array = array($this->_objLike->setLike($id_photo), $this->_objLike->getLikesPhoto($id_photo));
		if (self::_isAjax()) {
        	echo json_encode($array);
			die();
		}
		header("location: " . URL . "Home");
    }

    public function checkComment($id_com) {

        $this->_objCom = new CommentModel();
        if ($this->_objCom->checkComment($id_com) === 1) {
            if ($this->_isAjax()) {
                echo json_encode(["key" => "1"]);
                die();
            }
            return (1);
        }
        else {
            if ($this->_isAjax()) {
                echo json_encode(["key" => "0"]);
                die();
            }
            return (0);
        }
    }

    public function delComment($id_com) {

        $this->_objCom = new CommentModel();
        if ($this->_objCom->checkComment($id_com) === 1) {
            $this->_objCom->delComment($id_com);
            if ($this->_isAjax()) {
                echo json_encode($id_com);
                die();
            }
        } else {
            if ($this->_isAjax()) {
                echo json_encode(0);
                die();
            }
        }
        header('location: ' . URL . "Home");
    }

}
