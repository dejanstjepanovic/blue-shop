$(document).ready(function() {
/* Navigation
----------------------------------------------------------------------------------------------------*/
	$("#main-nav").find("li").mouseenter(function(){
		$(this).find("a:first").addClass("hoverTab");
		$(this).find("ul").slideDown('fast');
	});
	$("#main-nav").find("li").mouseleave(function(){
		$(this).find("a:first").removeClass("hoverTab");
		$(this).find("ul").slideUp('fast');
	});
	
	setTimeout("removeFlashMsg()", 7000);
	
	$('.bs-grid-table').find('tr').mouseenter(function(){
		$(this).find('.bs-link-v2').show();
	});
	$('.bs-grid-table').find('tr').mouseleave(function(){
		$(this).find('.bs-link-v2').hide();
	});
	
	$("#change_currency").find("#submit").hide();
	$("#change_currency").find("#currency").change(function(){
		$("#change_currency").find("#submit").click();
	});
});


function removeFlashMsg() {
	$(".flash-messenger-default").slideUp(500);
}


/* Content
----------------------------------------------------------------------------------------------------*/
function updateContentHeight() {
	var newH = 51 + $("#header").outerHeight(true) 
		+ $("#main-nav").outerHeight(true) 
		+ $("#footer").outerHeight(true);
	newH = $(window).height() - newH;
	$("#content").height(newH);
	setTimeout("updateContentHeightT()", 1000);
}
