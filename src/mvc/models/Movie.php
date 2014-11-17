<?php

class Movie extends Model {

    private $id;
    public $UserId;
    public $Name;
    public $ReleaseYear;

    /**
     *
     * @param $modelName
     */
    public function __construct($modelName = "Movie"){
       parent::__construct($modelName);
       parent::setTablename("movies");
    }

    public function Save(){
        return Connection::Insert(parent::getTablename(),
            array('userId'		=>	$this->UserId,
                  'name'		=>	$this->Name,
                  'releaseYear' =>	$this->ReleaseYear));
    }
}