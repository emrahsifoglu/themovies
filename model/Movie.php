<?php
require_once('ATable.php');

class Movie extends ATable{
	private $id;
	public $UserId;
	public $Name;
	public $ReleaseYear;

	public function __Construct(){
		parent::setTablename("movies");
	}	
	
	public function Save(){
		return Connection::Insert(parent::getTablename(),array('userId'		 =>	$this->UserId,
															   'name'		 =>	$this->Name,
															   'releaseYear' =>	$this->ReleaseYear));
	}
}