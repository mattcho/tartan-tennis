$(document).ready(function(){
	$("#begins_time").hide();
	$("#ends_time").hide();

	$("#date").change(function(){
		$("#begins_time").show();
	})	

	$("#begins_time").change(function(){
		$("#ends_time").show();
	})
})
