$(document).ready(function(){

	$("#time").hide();
    $("#date").change(function(){
        $("#time").show();
    });
});