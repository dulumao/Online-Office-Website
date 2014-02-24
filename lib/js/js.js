$(document).ready(function() {
	setInterval(function()
	{
		var footerheight =$(".footer_f").offset().top;
		if(footerheight < $(window).height()){
			$(".footer_f").find("div").addClass("footer_bottom");
			$(".footer_f").find("div").width($(window).width());
		}
		if(footerheight > $(window).height()){
			$(".footer_f").find("div").removeClass("footer_bottom");
		}	
	},30);
	$(".new_message").hide();
	$(".add").click(function(){
		$(this).hide();
		$(".old_message").hide();
		$(".new_message").slideDown();		
	});
});