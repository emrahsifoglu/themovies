$(document).ready(function() {
	var addBtn 				= $("#addBtn");
	var searchBtn 			= $("#searchBtn");
	var allBtn 				= $("#allBtn");
	var moviesTableHolder	= $("#moviesTableHolder");
	var logoutBtnHolder		= $("#logoutBtnHolder");
	var releaseYearDD		= $("#releaseYear");
	var todo 				= new Array();
	var movieId 			= 0;
	var releaseYear 		= "";
	var currentYear 		= (new Date).getFullYear();
	var buttons;
	
	buttons = new Array(addBtn, searchBtn, allBtn);
	
	loadMovie();
	
	logoutBtnHolder.hover(function() {
		 logoutBtnHolder.fadeTo(0.5,1);
		}, function() {
		  logoutBtnHolder.fadeTo(0.5,0.6);
		}
	);
	
	logoutBtnHolder.click(function() {
		logout();
	});		
	
	// releaseYearDD.trigger('change');
	releaseYearDD.change(function() {
	 	releaseYear = $(this).val();
	});
	
	for ( var i = 1901; i <= currentYear; i++ ) {
		releaseYearDD.append( new Option(i,i));
	}
	
	addBtn.click(function(){
		var name = $("#name").val();
		if (name.length >= 3 && releaseYear != ""){
			addMovie(name, releaseYear);
		} else {
			alert('Please enter name and release year.');
		}
	});
	
	searchBtn.click(function(){
		if (releaseYear != ""){
		    searchMovie();
		}
	});
	
	allBtn.click(loadMovie);
	
	function addMovie(name, releaseYear){
		todo = new Array();
		todo.push('operation=addMovie');
		todo.push('name='+name);
		todo.push('releaseYear='+releaseYear);
		$.ajax({
		   type: "POST",
		   url: "../controller/ajax.php",
		   data: todo.join("&"),
		   beforeSend: function(){
				disableButtons();
				movieId = 0;
		   },
		   success: function(returnData){
				movieId = returnData;
		   },		
		   complete: function(){
			   if (movieId > 0){
				   movieId = 0;
		           loadMovie();
			   }else{
			   		enableButtons();
			   }
		   }
		});	
	}
	
	function loadMovie(){
		todo = new Array();
    	todo.push('operation=loadMovie');
		$.ajax({
		   type: "POST",
		   url: "../controller/ajax.php",
		   data: todo.join("&"),
		   beforeSend: function(){
				disableButtons();
		   },
		   success: function(returnData){
			 	var movies = jQuery.parseJSON(returnData);
				if (movies.length > 0) makeMovieTable(movies);
		   },		
		   complete: function(){
			  	enableButtons();
		   }
		});	
	}
	
	function searchMovie(){
		todo = new Array();
    	todo.push('operation=findMovie');
		todo.push('releaseYear='+releaseYear);
		$.ajax({
		   type: "POST",
		   url: "../controller/ajax.php",
		   data: todo.join("&"),
		   beforeSend: function(){
				disableButtons();
		   },
		   success: function(returnData){
			 	var movies = jQuery.parseJSON(returnData);
				if (movies.length > 0) makeMovieTable(movies);
		   },		
		   complete: function(){
			  	enableButtons();
		   }
		});	
	}
	
	function logout(){
		todo = new Array();
    	todo.push('operation=logout');
		$.ajax({
		   type: "POST",
		   url: "../controller/ajax.php",
		   data: todo.join("&"),
		   beforeSend: function(){
			   disableButtons();
		   },
		   success: function(returnData){
			 	location.reload();
		   }
		});	
	}
	
	function makeMovieTable(movies){
		var tableStyle = 'height="30" colspan="2" style="border-left: 1px solid #D799ED; border-right: 1px solid #EDC2FB; border-top: 1px solid #EDC2FB; border-bottom: 1px solid #D799ED';
	    moviesTableHolder.html('<table style"'+tableStyle+'" id="moviesTable" border="0"></table>');
		var moviesTable	= $("#moviesTable");
		jQuery.each( movies, function( i, val ) {
			var mId = movies[i][0];
			var mName = movies[i][2];
			var mReleaseYear = movies[i][3];
			moviesTable.append("<tr style='background-color: rgb(238, 238, 239)' ><td>"+mId+"</td><td>"+mName+"</td><td>"+mReleaseYear+"</td></tr>");
		});
	}
	
	function disableButtons(){
		$.each(buttons, function( index, btn ) {
			btn.attr('disabled','disabled');
		});
	}
	
	function enableButtons(){ 
		$.each(buttons, function( index, btn ) {
			btn.removeAttr('disabled');
		});
	}
});