$(document).ready(function() {

	$(".work__item-pr").hover(function() {
		var eHeight = $(this).find("img").innerHeight(),
			height = $(this).innerHeight();

		$(this).find("img").css("top", (height - eHeight));
		// $(this).find("img").animate({top: "-=40"});
	},
	function() {
		$(this).find("img").css("top", 0);
	});

	(function() {
		var date = new Date(),
			date  = new Date(date.setDate(date.getDate() + 14)),
			d = date.getDate(),
			m = date.getMonth() + 1,
			y = date.getFullYear();

			if(d < 10) {
				d = "0" + d;
			}

			if(m < 10) {
				m = "0" + m;
			}

			y = y % 100;

			$(".main__title").text(d + "." + m + "." + y);			
			$(".set-month").text(d + "." + m);

	})();

	$(".work__slider").slick({
		slidesToShow: 2,
		responsive: [
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 1
			}
		}]
	});
	/*
	$(".work__item-loupe").click(function() {
		$("body").css({overflow: "hidden"})
		console.log($(this).attr("src"));

		$("#site").attr("src", $(this).attr("href"))
			.css({display: "block"});
		$(".back-site").css({display: "block"});
		return false;
	});
	*/
	$(".back-site").click(function() {
		$("body").css({overflow: ""})
		console.log($(this).attr("src"));

		$("#site").attr("src", $(this).attr("href"))
			.css({display: "none"});
		$(".back-site").css({display: "none"});
		return false;
	});

	$(".work__all").click(function() {
		$(".work__items").toggleClass("open");
	});

	$(".fancy").fancybox({
		padding: 0
	});

	$(".input--phone").mask("+7 (999) 999-99-99");


	$(".nav a, .work__all").click(function(){
		// $(".nav__container").removeClass("nav__container-open");

		var hash = $(this).attr("href"),
			top = $(hash).offset().top,
			offset = $(".nav").height(),
			header = $(".header");

		$("html, body").animate({scrollTop: top - offset}, "slow");

		return false;
	});

	$('form').ajaxForm({
		url: "mail.php",

		success: function(responseText, statusText, xhr, $form) {
			$.fancybox.close();
			$form.trigger('reset');
			$.fancybox("#success", {padding: 0});
		}
	});

	$("#toTop").scrollToTop();
});

(function($) {
	$.fn.scrollToTop=function(){
		$(this).hide().removeAttr("href");
		if($(window).scrollTop()!="0"){
			$(this).fadeIn("slow")
		}
		
		var scrollDiv=$(this);
		$(window).scroll(function(){

			if($(window).scrollTop()=="0"){
				$(scrollDiv).fadeOut("slow");
			}else{
				$(scrollDiv).fadeIn("slow");
			}
		});
	
		$(this).click(function(){
			$("html, body").animate({scrollTop:0},"slow");
		})
	}
})(jQuery);