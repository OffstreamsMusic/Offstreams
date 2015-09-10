//////////////////////////////////////////////////////////
//////////		JQUERY.JS						///////////
//////////											///////////
//////////		1.) VARIABLES					///////////
//////////		2.) FUNCTIONS				///////////
//////////		3.) DEVICE DETECTION		///////////
//////////		4.) MOBILE EVENTS			///////////
//////////		5.) DESKTOP EVENTS		///////////
//////////////////////////////////////////////////////////


$(document).ready(function(){
	
	
	
	////////////////////////////////////////////
	/**		1.) VARIABLES					**/
	////////////////////////////////////////////
	
	var base_uri = "http://localhost/offstreams/";
	var basepath = "localhost/offstreams/";
	var root = "/offstreams/";
	
	var w = (window.innerWidth > 0) ? window.innerWidth : screen.width;
	var h = window.innerHeight;
	var searchForm = $(".searchbarForm");
	var logo = '<a href="' + base_uri + '"><img src="' + base_uri + 'images/Offstreams Logo.png" style="height: 55px;" id="logoHeader" /></a>';
	var mobileLogo = '<img src="' + base_uri + 'images/Offstreams Logo.png" style="height: ' + ((h / 10) - 5) + 'px;" id="logoHeader">';
	var mobileNavButton = '<img src="' + base_uri + 'images/MobileNavButton.png" id="mobileNavButton" style=" height: ' + ((h / 10) - 5) + 'px; margin-left: ' + '">';
	var mobileNavButtonClicked = '<img src="' + base_uri + 'images/MobileNavButtonClicked.png" id="mobileNavButtonClicked" style=" height: ' + ((h / 10) - 5) + 'px; margin-left: ' + ';display: none;">';
	var loginRegMove = $("#loginRegisterWrapper");
	var loginFormDisplay = $("#loginFormDisplay");
	var registerFormDisplay = $("#registerFormDisplay");
	var currPage = location.protocol + '//' + location.host + location.pathname;
	var profileInfoContainer = $(".profileInfoContainer");
	var changeImageButton = $("#changeImage");
	var editProfileButton = $("#editProfile");
	var searchUl = "<ul class='searchUl'></ul>";
	
	
	////////////////////////////////////////////
	/**		2.) FUNCTIONS				**/
	////////////////////////////////////////////
	
	
	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	
	
	// LOAD CSS FILE
	loadCSS = function(size) {
		var cssLink = $("<link rel='stylesheet' type='text/css' href='" + base_uri + "includes/styles/" + size + ".css'>");
		$("head").append(cssLink);
	}
	
	camelCase = function(string) {
		var trimSring = trim(string);
	}
	
	
	// LOAD FONT FACES
	loadCSS("strudel");
	
	
	
	////////////////////////////////////////////
	/**		3.) DEVICE DETECTION		**/
	////////////////////////////////////////////
	
	// MOBILE DEVICE FUNCTION
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	
	// IF DEVICE IS ANDROID OR iOS
	if( isMobile.Android() || isMobile.iOS()){
		loadCSS("mobileBody");
		loadCSS("mobileHeader");
		$("#headerRight").prepend(mobileLogo);
		$("nav").prepend(searchForm);
		$("#headerLeft").append(mobileNavButton);
		$("#headerLeft").append(mobileNavButtonClicked);
		$(".profileInfoWrapper").after(profileInfoContainer.detach());
		$("#profilePicWrapper").after(changeImageButton.detach());
		$("#profilePicWrapper").after(editProfileButton.detach());
		$("nav > ul").before(loginRegMove.detach());
		$("nav > ul").before(loginFormDisplay.detach());
		$("nav > ul").before(registerFormDisplay.detach());
		$("nav").prepend(searchForm.detach());
		$("#searchbar").wrap("<strong></strong>");
		$(".profileInfoWrapper, .profileInfoContainer").wrapAll("<div class='profileWrapper'>");
		$(".wrapper").wrap("<div class='shadow'></div>");
		$("body").css("height", h);
		$("header").css("width", w);
		$("header").css("height", h / 10);
		$("header > table").css("height", h /10);
		$("#logoHeader").css("padding", "0px  10px 0px 0px");
		$("nav").css("height", h - (h / 10));
		$(".wrapper").css("height", h - (h / 10));
		$(".ulNavChild").css("height", h / 20);
		$("#loginSubmitButton").css("height", h / 25);
		$("#registerSubmitButton").css("height", h / 25);
		$(".dialogBox").css("width", (w - 20) + "px");
		$("#closeDialog").remove();
		
		$(".searchbarForm").append(searchUl);
		$(".searchUl").wrap("<div class='liveSearchBox'></div>");
		
		
		var profilePic = $(".imageCenter > img");
		var profilePicRatio = 135 / 230;
		var profilePicHeight = profilePic.height();
		var profilePicWidth = profilePic.width();
		var profilePicMarginLeft = (((profilePicRatio * profilePicWidth) / 2) - (135 / 2)) * -1;
		var profilePicMarginTop = (((profilePicRatio * profilePicHeight) / 2) - (135 / 2)) * -1;
		
		profilePic.css("height", profilePicRatio * profilePicHeight).css("width", profilePicRatio * profilePicWidth);
		profilePic.css("margin-left", profilePicMarginLeft).css("margin-top", profilePicMarginTop);
		
		// Remove wrapper on about page
		if (window.location.href == base_uri + "about") {
			$(".wrapper").css("width", "inherit").css("margin-top", "0").css("max-width", "inherit");
		}
		
		
		
		
	// IF DEVICE IS WINDOWS
	} else {
		loadCSS("desktopBody");
		loadCSS("desktopHeader");
		$("#headerLeft").append(logo);
		$(".wrapper").css("height", (h - 110) + "px");
		$(".dialogBox").css("width", w / 1.5);
		
		// Remove wrapper on about page
		if (window.location.href == base_uri + "about") {
			$(".wrapper").css("width", "inherit").css("margin-top", "0").css("max-width", "inherit");
		}
		
		// Search bar appending
		$(".searchbarForm").append(searchUl);
		$(".searchUl").wrap("<div class='liveSearchBox'></div>");
	}

	console.log("Width: " + w + "\n" + "Height: " + h);

	
	
	////////////////////////////////////////////
	/**		4.) MOBILE EVENTS			**/
	////////////////////////////////////////////
	
	// MobileNavButton TOUCH EVENTS
	$("#mobileNavButton").bind("touchstart", function(e){
		$(this).css("display", "none");
		$("#mobileNavButtonClicked").css("display", "inline-block");
	});
	
	$("#mobileNavButton").bind("touchend", function(){
		$("#mobileNavButtonClicked").css("display", "none");
		$(this).css("display", "inline-block");
	});
	
	// MobileNavButton "nav" functions
	// if navigation is off the screen
	$("#mobileNavButton").on("click", function(){
		$("nav").toggle("slide", {direction: "left"}, 500);
		$(".shadow").toggleClass("Effect", function(){
			$(this).animate({}, 500)
		});
	});
	
	
	// If Mobile Phone
	if (isMobile.Android() || isMobile.iOS()){
		
		$(".backButton").append("Back");
		
		// Login Button Clicked Mobile
		$("#loginButton").click(function(){
			$("#loginFormDisplay").fadeToggle(1000, "linear");
			$("#loginRegisterWrapper").css("display", "none");
			$("nav > ul").css("display", "none");
		});
		
		//	Register Button Clicked Mobile
		$("#registerButton").click(function(){
			$("#registerFormDisplay").fadeToggle(1000, "linear");
			$("#loginRegisterWrapper").css("display", "none");
			$("nav > ul").css("display", "none");
		});
		
		
		$(".backButton").on("click", function(){
			$("#loginFormDisplay").fadeOut(500, "linear");
			$("#registerFormDisplay").fadeOut(500, "linear");
			$("#loginRegisterWrapper").delay(500).fadeIn(500);
			$("nav > ul").delay(500).fadeIn(500);
		});
		
		
		$('#dialogBox').swipe( {
            swipeLeft:function(e) {
                $(this).animate({
					right: "400"
				}, 500, function(){ $(this).remove(); });
				e.preventDefault();
				window.history.pushState({urlPath: base_uri}, "", root);
            },
            swipeRight:function(e) {
                $(this).animate({
					left: "400"
				}, 500, function(){ $(this).remove(); });
				e.preventDefault();
				window.history.pushState({urlPath: base_uri}, "", root);
            }
        });
		
		
		// Poll Widget
		$(".pollWidget p").on("click", function(){
			$(".pollRadioButton").attr("checked", false);
			$(".pollWidget p").css("background", "#aaa").css("color", "#333");
			var checked = $(this).children().attr("checked", true);
			$(this).css("background", "#333").css("color", "#aaa");
		});

		
	}
	
		/*
		if (window.location.search.indexOf('e') > -1) {
			$(".dialogBox").on("swipeleft", function(e){
				$(this).animate({
					left: "-1000px"
				});
				$(this).remove();
				e.preventDefault();
				window.history.pushState({urlPath: base_uri}, "", root);
			});
			$(".dialogBox").on("swiperight", function(e){
				$(this).animate({
					right: "1000px"
				});
				$(this).remove();
				e.preventDefault();
				window.history.pushState({urlPath: base_uri}, "", root);
			});
		}
			
		// If Success Message
		} else if (window.location.search.indexOf('s') > -1) {
			$(".dialogBox").on("swipeleft", function(e){
				$(this).animate({
					left: "-1000px"
				});
				$(this).remove();
			});
			$(".dialogBox").on("swiperight", function(e){
				$(this).animate({
					right: "1000px"
				});
				$(this).remove();
			});
		}
		*/
	
	
	
	////////////////////////////////////////////
	/**		5.) DESKTOP EVENTS		**/
	////////////////////////////////////////////
	
	if (!isMobile.Android() && !isMobile.iOS()){
		
		// Login Button Clicked Desktop
		$("#loginButton > span").click(function(){
			$("#registerFormDisplay").fadeOut(500);
			$("#loginFormDisplay").fadeToggle(500, "linear");
			$("#loginFormWrapper").css("width", "300px");
			$("#loginFormWrapper").css("height", "220px");
			$("#loginFormWrapper").css("left", (w / 2) - (300 / 2) + "px");
			$("#loginFormWrapper").css("top", (h / 2) - (220 / 2) + "px");
		});
		
		// Register Button Clicked Desktop
		$("#registerButton > span").click(function(){
			$("#loginFormDisplay").fadeOut(500);
			$("#registerFormDisplay").fadeToggle(500, "linear");
			$("#registerFormWrapper").css("width", "300px");
			$("#registerFormWrapper").css("left", (w / 2) - (300 / 2) + "px");
			$("#registerFormWrapper").css("top", (h / 2) - (220 / 2) + "px");
		});
		
		
		var params = window.location.pathname.split('/').slice(4); // ["1", "my-event"]

		var id = params[0];
		var name = params[1];
		
		// If Error Message
		if (window.location.search.indexOf('e') > -1) {
			$("#closeDialog").click(function(e){
				e.preventDefault();
				$(".dialogBox").remove();
				window.history.pushState({urlPath: base_uri}, "", root);
			});
		
		// If Success Message
		} else if (params[0]) {
			$("#closeDialog").click(function(e){
				e.preventDefault();
				$(".successDialog").remove();
				var str = currPage;
				var res = str.replace("/s/1", "");
				window.history.pushState({urlPath: base_uri}, "", res);
			});
		}
		
		
		// Append close button
		$(".backButton").append("Close");
		
		// Close button is hit
		$(".backButton").click(function(){
			$("#loginFormDisplay").fadeOut(500);
			$("#registerFormDisplay").fadeOut(500);
		});
		
		var ellipsis = "...";

		function trimLen(input, maxLength) {
			var text = input;
			
			console.log("Text length: " + text.length);

			if (text.length > maxLength) {
				
				var part = text.substring(0, maxLength);
				
				return part + ellipsis;
				
			}
			else
				return text;
		}
		
		
		
		// Poll Button click
		$(".pollWidget p").on("click", function(){
			$(".pollRadioButton").attr("checked", false);
			$(".pollWidget p").css("background", "#aaa").css("color", "#333");
			var checked = $(this).children().attr("checked", true);
			$(this).css("background", "#333").css("color", "#aaa");
		});
				
	}
	
	////////////////////////////////////////////
	/**		6.) GENERIC EVENTS			**/
	////////////////////////////////////////////
	
	
	////////////////////////////////////////////////////////////////////////////////////////////
	// Animate Rotate function
	$.fn.animateRotate = function(angle, duration, easing, complete) {
	  var args = $.speed(duration, easing, complete);
	  var step = args.step;
	  return this.each(function(i, e) {
		args.complete = $.proxy(args.complete, e);
		args.step = function(now) {
		  $.style(e, 'transform', 'rotate(' + now + 'deg)');
		  if (step) return step.apply(e, arguments);
		};

		$({deg: angle - 180}).animate({deg: angle}, args);
	  });
	};
	
	// Click toggles
	(function($) {
		$.fn.clickToggle = function(func1, func2) {
			var funcs = [func1, func2];
			this.data('toggleclicked', 0);
			this.click(function() {
				var data = $(this).data();
				var tc = data.toggleclicked;
				$.proxy(funcs[tc], this)();
				data.toggleclicked = (tc + 1) % 2;
			});
			return this;
		};
	}(jQuery));
	
	// Initiate rotation on click
	$("#bandDropInfoButton").clickToggle(function() {   
		$(this).animateRotate(180);
		$(".bandInfoContainer").slideToggle();
	},
	function() {
		$(this).animateRotate(360);
		$(".bandInfoContainer").slideToggle();
	});
	
	////////////////////////////////////////////////////////////////////////////////////////////

	
	
	
	
});