<?php

class App {

    protected $url;
    protected $routes = [];
    protected $currentController = "LoginController";
    protected $currentAction = "indexAction";

    public function __construct(){

    }

    public function run(){
        $this->url = $this->parseUrl();
        $route = $this->getRoute();
        $isOauthRequired = $this->routes[$route]['isOauthRequired'];

        if ($isOauthRequired){
            if(!Helper::isUserLoggedIn()){
                Helper::redirectTo(ROOT.'web/login');
            }
        }

        $controller = $this->routes[$route]['controller'];
        $this->setController($controller);
        $this->loadControllerFile();
        $this->initControllerClass();
        $this->runControllerAction($this->getAction(), $this->getParams());
    }

    /**
     *
     * @param $controller
     * @return void
     */
    private function setController($controller){
        if (!empty($controller)) {
            if(file_exists(CONTROLLER_PATH.$controller.'Controller.php')) {
                $this->currentController = $controller.'Controller';
            }
        }
    }

    /**
     * Load controller class file.
     *
     * @return void
     */
    private function loadControllerFile(){
        require_once CONTROLLER_PATH.$this->currentController.'.php';
    }

    /**
     * Create a new instance of controller class and run its  __construct method.
     *
     * @return void
     */
    private function initControllerClass(){
        if (class_exists($this->currentController)){
            $this->currentController = new $this->currentController();
        }
    }

    /**
     * This method checks if the action exists then set $currentAction.
     *
     * @param string $action
     * @param array $params
     * @return void
     */
    private function runControllerAction($action = "index", $params = []){
        if (!empty($action) && method_exists($this->currentController, $action.'Action')){
            $this->currentAction = $action.'Action';
        }
        call_user_func_array([$this->currentController, $this->currentAction], $params);
    }

    /**
     * First checking if url is given then parsing.
     *
     * @return array
     */
    private function parseUrl(){
        return $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
    }

    /**
     *
     * @return string
     */
    private function getRoute(){
        return $this->unsetArray(0);
    }

    /**
     *
     * @return string
     */
    private function getAction(){
        return $this->unsetArray(1);
    }

    /**
     * This is a helper method which getRoute and getAction use.
     *
     * @param $index
     * @return string
     */
    private function unsetArray($index){
        if (sizeof($this->url) >= $index){
            $return = $this->url[$index];
            unset($this->url[$index]);
            return $return;
        }
    }

    /**
     *
     * @return array
     */
    private function getParams(){
       return $this->url ? array_values($this->url) : [];
    }

    /**
     *
     * @param string $routeName
     * @param string $controllerName
     * @param bool $isOauthRequired
     * @return void
     */
    public function addRoute($routeName, $controllerName, $isOauthRequired){
        $this->routes[$routeName] = array('controller' => $controllerName, 'isOauthRequired' => $isOauthRequired);
    }

    /**
     *
     * @return array
     */
    public function getRoutes(){
        return $this->routes;
    }
} 