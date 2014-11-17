<?php

class LoginController extends Controller {

    /**
     * @return \LoginController
     */
    public function  __construct(){
        parent::__construct('login');
        if (Helper::isUserLoggedIn()){
            Helper::redirectTo(ROOT.'web/movies');
        }
    }

    /**
     * @param $params
     * @return void
     */
    public function indexAction($params = []) {
        $this->loadView('Login/index');
    }

    public function loginAction(){
        if($this->isRequestMethod('POST')) {
            if(filter_has_var(INPUT_POST, "inputUsername") && filter_has_var(INPUT_POST, "inputPassword")) {
                $return = array('success' => false);
                $username = htmlspecialchars($_POST['inputUsername'], ENT_QUOTES);
                $password = htmlspecialchars($_POST['inputPassword'], ENT_QUOTES);
                $user = $this->loadModel('User');
                $user->Username = $username;
                $user->Password = $password;
                $userId = $user->Validate();
                if ($userId > 0) {
                    Session::Start();
                    Session::Set('Id', $userId);
                    $return = array('success' => true, 'id' => $userId);
                }
                echo json_encode($return);
            }
        } else {
            Helper::redirectTo(ROOT.'web/login');
        }
    }
}

