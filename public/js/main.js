$(document).ready(function(){

$("body").on("submit", "form", function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});

$("#btn_show").click(function(){
    $("#div_message").hide();
    $("#div_message_all").show();
    })
});
