function Movie () {

}

Movie.prototype.id   = 0;
Movie.prototype.name  = "";
Movie.prototype.releaseYear  = 0;
Movie.prototype.errors = [];

Movie.prototype.id = function(id) {
    if (isNumber(id)) this.id = id;
};

Movie.prototype.setName = function(name) {
    if (isStringValid(name, 5, 15)) this.name = name;
};

Movie.prototype.setReleaseYear = function(releaseYear) {
    if (isYearValid(releaseYear)) this.releaseYear = releaseYear;
};

Movie.prototype.getId = function() {
    return this.id;
};

Movie.prototype.getName = function() {
    return this.name;
};

Movie.prototype.getReleaseYear = function() {
    return this.releaseYear;
};

Movie.prototype.getErrors = function() {
    this.errors = [];
    if (this.name == "") this.errors.push({name:"name", msg:"Name is not valid."});
    if (this.releaseYear == 0) this.errors.push({name:"year", msg:"Release year is not valid."});
    return this.errors;
};

Movie.prototype.isValid = function() {
   return (this.getErrors().length == 0);
};

Movie.prototype.save = function(url, onSuccess, onError, onComplete){
    var data = { name:this.getName(), releaseYear:this.getReleaseYear()};
    callService(url, JSON.stringify(data), "POST", "html", "application/json; charset=utf-8", onSuccess, onError, onComplete);
};

Movie.prototype.fetchAll = function(url, onSuccess, onError, onComplete){
    callService(url, "", "GET", "html", "application/json; charset=utf-8", onSuccess, onError, onComplete);
};

Movie.prototype.fetchByWhere = function(url, data, onSuccess, onError, onComplete){
    callService(url, data, "GET", "html", "application/json; charset=utf-8", onSuccess, onError, onComplete);
};

function callService(url, data, type, dataType, contentType, onSuccess, onError, onComplete){
    $.ajax({
        type: type,
        dataType: dataType,
        url: url,
        contentType: contentType,
        data : data,
        success: function (data, textStatus, jqXHR) {
            onSuccess(data, textStatus, jqXHR);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            onError(jqXHR, textStatus, errorThrown);
        },
        complete: function(){
            onComplete();
        }
    });
}