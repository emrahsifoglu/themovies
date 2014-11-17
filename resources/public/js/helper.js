var patterns = {
    year  : /^(19|20)\d{2}$/,
    str   : "^[a-zA-Z0-9_.öçşiğüÖÇŞİĞÜ-]{min,max}$"
};

function updateMinMax(pattern_str, min, max){
    var mapObj = { min:min, max:max };
    return pattern_str.replace(/min|max/gi, function(matched) {
        return mapObj[matched];
    });
}

function isStringValid(name, min, max) {
    return new RegExp(updateMinMax(patterns.str, min, max)).test(name);
}

function isYearValid(year){
    return patterns.year.test(year);
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}