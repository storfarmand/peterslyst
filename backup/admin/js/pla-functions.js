/******  TRIM Functions  ******/
function trim(stringToTrim) {
    return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
    return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
    return stringToTrim.replace(/\s+$/,"");
}
var log = typeof console === "undefined" ? function (msg) { return; } : function (msg) { console.log(msg); } ;

var showResult = function(theResult) {
    $.blockUI({
        message: theResult,
        fadeIn: 2000,
        fadeOut: 2000,
        timeout: 3000,
        showOverlay: false,
        css: {
            top: '60px',
            width: '350px',
            border: 'none',
            padding: '5px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .8,
            color: '#fff'
        }
    });
};
