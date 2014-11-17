<?php
require_once('../model/User.php');
require_once('../model/Movie.php');
require_once('../library/Session.php');

if($_REQUEST){
	
	$operation = $_POST['operation'];

	if (!empty($operation)){
		
		switch($operation){
			case 'login' : //mysql_real_escape_string($username));;
				
				$username=htmlspecialchars($_POST['username'],ENT_QUOTES);
				$password=htmlspecialchars($_POST['password'],ENT_QUOTES);
				
				$user = new User();
				$user->Username = $username;
				$user->Password = $password;
				$userId = $user->Validate();


				if ($userId > 0) {
					Session::Start();
					Session::Set('Id',$userId);
					$userId = 1;
				}

				echo $userId; // if user name and passworda aren't matched, id will be 0;
			
			break;
			
			case 'addMovie' : 
				
				Session::Start();
				$userId = Session::Get('Id');
				$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
				$releaseYear = htmlspecialchars($_POST['releaseYear'],ENT_QUOTES);
			
				$movie = new Movie();
				$movie->Name = $name;
				$movie->UserId = $userId;
				$movie->ReleaseYear = $releaseYear;
				$movieId = $movie->Save();
				
				if ($movieId > 0) {
					echo $movieId;
				} else {
					echo 0;	
				}
				
			break;
			
			case 'loadMovie' : 
			
				Session::Start();
				$userId = Session::Get('Id');
				$movies = array();
				$movie = new Movie();
				$movies = $movie->Find("*","userId = $userId");
				echo json_encode($movies);
		
			break;
			
			case 'findMovie' : 
			
				Session::Start();
				$userId = Session::Get('Id');
				$releaseYear = htmlspecialchars($_POST['releaseYear'],ENT_QUOTES);
				
				$movies = array();
				$movie = new Movie();
				$movies = $movie->Find("*","userId = $userId AND releaseYear=$releaseYear");
				echo json_encode($movies);

			break;
			
			case 'logout' : 
				
				Session::Start();
				Session::Stop();
				echo 1;
		
			break;
		}
	}
}
