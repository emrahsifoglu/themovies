$( document ).ready(function() {

    var addBtn 				= $("#addBtn");
    var searchBtn 			= $("#searchBtn");
    var allBtn 				= $("#allBtn");
    var moviesTableHolder	= $("#moviesTableHolder");
    var logoutBtnHolder		= $("#logoutBtnHolder");
    var releaseYearDD		= $("#releaseYear");
    var movieId 			= 0;
    var releaseYear 		= "";
    var currentYear 		= (new Date).getFullYear();
    var buttons             = [addBtn, searchBtn, allBtn];
    var controllerRoute     = $('#controllerRoute').html();
    var findAllAction       = controllerRoute+"findAll";
    var findByWereAction    = controllerRoute+"findByWhere";
    var saveAction          = controllerRoute+"save";
    var currentAction       = "";
    var logoutRoute         = $('#logoutRoute').html();

    for ( var i = 1901; i <= currentYear; i++ ) {
        releaseYearDD.append( new Option(i,i));
    }

    function saveMovie(name, releaseYear){
        disableButtons();
        currentAction = "save";
        movieId = 0;
        var movie = new Movie();
        movie.setName(name);
        movie.setReleaseYear(releaseYear);
        if (movie.isValid()){
            movie.save(saveAction, onMovieSuccess, onMovieError, onMovieComplete);
        } else {
            enableButtons();
        }
    }

    function loadMovies(){
        disableButtons();
        currentAction = "findAll";
        var movie = new Movie();
        movie.fetchAll(findAllAction, onMovieSuccess, onMovieError, onMovieComplete);
    }

    function loadMovie(releaseYear) {
        disableButtons();
        currentAction = "findByWere";
        var data = { releaseYear: releaseYear };
        var movie = new Movie();
        movie.fetchByWhere(findByWereAction, data, onMovieSuccess, onMovieError, onMovieComplete);
    }

    function onMovieSuccess(returnData, textStatus, jqXHR){
        console.log(currentAction);
        if (textStatus == "success") {
            switch (currentAction){
                case "findAll" :
                case "findByWere" :
                        updateMovieTable(returnData);
                    break;
                case "save" :
                    var data = $.parseJSON(returnData);
                    var movie = [data['movieId'], data['userId'], data['name'], data['releaseYear']];
                        moviesTableAppend(movie);
                    break;
            }
        }
    }

    function onMovieError(jqXHR, textStatus, errorThrown){
        console.log(errorThrown);
    }

    function onMovieComplete(){
        enableButtons();
    }

    function logout(){
        window.location.replace(logoutRoute);
    }

    function updateMovieTable(returnData){
        var movies = $.parseJSON(returnData);
        if (movies.length > 0) makeMovieTable(movies);
    }

    function makeMovieTable(movies){
        var tableStyle = 'height="30" colspan="2" style="border-left: 1px solid #D799ED; border-right: 1px solid #EDC2FB; border-top: 1px solid #EDC2FB; border-bottom: 1px solid #D799ED';
        moviesTableHolder.html('<table style"'+tableStyle+'" id="moviesTable" border="0"></table>');
        $.each( movies, function( i, val ) {
            moviesTableAppend(movies[i]);
        });
    }

    function moviesTableAppend(movie){
        var mId = movie[0];
        var mName = movie[2];
        var mReleaseYear = movie[3];
        $("#moviesTable").append("<tr style='background-color: rgb(238, 238, 239)' ><td>"+mId+"</td><td>"+mName+"</td><td>"+mReleaseYear+"</td></tr>");
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

    logoutBtnHolder.hover(function() {
            logoutBtnHolder.fadeTo(0.5,1);
        }, function() {
            logoutBtnHolder.fadeTo(0.5,0.6);
        }
    );

    logoutBtnHolder.click(function() {
        logout();
    });

    releaseYearDD.change(function() {    // releaseYearDD.trigger('change');
        releaseYear = $(this).val();
    });

    addBtn.click(function(){
        var name = $("#name").val();
        if (name.length >= 3 && releaseYear != ""){
            saveMovie(name, releaseYear);
        } else {
            alert('Please enter name and select a release year.');
        }
    });

    searchBtn.click(function(){
        if (releaseYear != "") loadMovie(releaseYear);
    });

    allBtn.click(loadMovies);

    loadMovies()

});