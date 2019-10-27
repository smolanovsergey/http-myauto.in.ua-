$(document).ready(function(){
	$("#device-buttons .response").click(function(){
		$("#device-buttons .response").removeClass("active");
		$(this).addClass("active");
		$("#preview-frame").removeAttr("class").addClass($(this).attr("id"));
	});
	$("#qr_code_open").click(function(){
		$("#qr_code_content").removeClass("hidden");
		$("#qr_code_open").addClass("active");
		$("#submask").removeClass("hidden");
	});
	$("#submask").click(function(){
		$("#qr_code_content").addClass("hidden");
		$("#qr_code_open").removeClass("active");
		$("#submask").addClass("hidden");
	});
});