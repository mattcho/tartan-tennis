$(document).ready(function(){
	$("#begins_time").hide();
	$("#ends_time").hide();
	$("#tag").hide();

	$("#date").change(function(){
		$("#begins_time").show();
	})	

	$("#begins_time").change(function(){
		$("#ends_time").show();
	})

	$("#ends_time").change(function(){
		$("#tag").show();
	})
})
