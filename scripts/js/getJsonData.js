$(document).ready(function () {
    $.getJSON('./model/data.json', function (jsonObj) {
        console.log(jsonObj);
    })
});