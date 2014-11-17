<?php

class MovieController extends Controller {

    /**
     * @return \MovieController
     */
    public function  __construct(){
        parent::__construct('movie');
    }

    /**
     * @param $params
     * @return void
     */
    public function indexAction($params = []){
       $this->loadView('Movie/index');
    }

    public function findAllAction(){
        if($this->isRequestMethod('GET')) {
            Session::Start();
            $userId = Session::Get('Id');
            $movie = $this->loadModel('Movie');
            $movies = $movie->Find("*","userId = $userId");
            echo json_encode($movies);
        }
    }

    public function findByWhereAction(){
        if($this->isRequestMethod('GET')) {
            Session::Start();
            $userId = Session::Get('Id');
            $releaseYear = htmlspecialchars($_GET['releaseYear'], ENT_QUOTES);
            $movie = $this->loadModel('Movie');
            $movies = $movie->Find("*","userId = $userId AND releaseYear = $releaseYear");
            echo json_encode($movies);
        }
    }

    public function saveAction(){
       if ($this->isRequestMethod('POST')){
           Session::Start();
           $userId = Session::Get('Id');
           $request = json_decode(file_get_contents('php://input'));
           $name = htmlspecialchars($request->{'name'} , ENT_QUOTES);
           $releaseYear = htmlspecialchars($request->{'releaseYear'}, ENT_QUOTES);
           $movie = $this->loadModel('Movie');
           $movie->Name = $name;
           $movie->UserId = $userId;
           $movie->ReleaseYear = $releaseYear;
           $movieId = $movie->Save();
           echo json_encode(array("movieId" => $movieId, "userId" => $userId , "name"=> $name, "releaseYear" => $releaseYear));
       }
    }
} 