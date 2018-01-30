$(function() {
    $("#invite-username").autocomplete({
        source: "getdata",
        minLength: 1
    });
});