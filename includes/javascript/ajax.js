$(document).ready(function(){
	
	
	
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
	
	
	
	var base_uri = "http://localhost/offstreams/";
	var basepath = "localhost/offstreams/";
	var root = "/offstreams/";
	
	
	function camelize(str) {
	  return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(letter, index) {
		return index == 0 ? letter.toLowerCase() : letter.toUpperCase();
	  }).replace(/\s+/g, '');
	}
	
	// WHEN EDITING PROFILE, CHANGE STATE BOX ACCORDINGLY
	$("#userCountry").on("change", function(){
		
		var selectValue = this.value;
		
		// US States
		if (selectValue == "United States") {
			
			$.ajax({
				
				url: base_uri + "users/widgets/unitedstates_states.html",
				type: 'POST',
				data: {option : selectValue},
				success: function(html) {
					$("#userState").remove();
					$("#editStateSelect").html(html);
				},
				fail: function(e) {
					console.log(e);
				}
				
			});
			
		// Canada States
		} else if (selectValue == "Canada") {
			
			$.ajax({
				
				url: base_uri + "users/widgets/canada_states.html",
				type: 'POST',
				data: {option : selectValue},
				success: function(html) {
					$("#userState").remove();
					$("#editStateSelect").html(html);
				},
				fail: function(e) {
					console.log(e);
				}
				
			});
		
		// All other countries
		} else {
			
			$("#userState").remove();
				
		}
	});
	
	
	
	// Search form submit
	$(".searchbarForm").on("submit", function(e){
		e.preventDefault();
		
		var searchTerm = $("#searchbar").val();
		console.log(searchTerm);
		
		$.ajax({
			url: base_uri + "searchs/search.php",
			type: 'POST',
			data: {search: searchTerm},
			success: function(value) {
				var sT = camelize(searchTerm);
				window.location.replace(base_uri + "search/" + sT);
			},
			fail: function(e){
				console.log(e);
			}
		});
	})
	
	
	
	$("#userBdayMonth").on("click", function(){
		$(this).keyup(function(){
			if (event.currentTarget.value.length == 2) {
				$("#userBdayDay").select();
			}
		})
		$("#userBdayDay").keyup(function(){
			if (event.currentTarget.value.length == 2) {
				$("#userBdayYear").select();
			}
		});
	});
	
	$("#userBdayDay").on("click", function(){
		$(this).keyup(function(){
			if (event.currentTarget.value.length == 2) {
				$("#userBdayYear").select();
			}
		});
	});
	
	$(".musicButton").on("click", function(){
		
		var buttonValue = this.value;
		
		console.log(buttonValue);
		
		$.ajax({
			
			url: base_uri + "bands/process/music.php",
			type: 'POST',
			data: {myData: buttonValue},
			success: function(value) {
				$("#musicPlayer").attr("src", "https://embed.spotify.com?uri=" + value);
			},
			fail: function(e) {
				console.log(e);
			}
			
		})
		
	});
	
	
	// POLL AJAX
	$("#pollSubmitForm").on("submit", function(e){
		e.preventDefault();
		var action = $(this).attr("action");
		var radioButton = $('input[name=pollValues]:checked', this).val();
		var pollId = $("input[type=hidden]", this).val();
		var answerId = $("input[name=pollValues]:checked", this).attr("id");
		
		console.log(answerId);
		
		$.ajax({
			
			url: action,
			type: 'POST',
			data: {submitPoll: radioButton, pollId, answerId},
			success: function(value) {
				$(".pollWidget form").remove();
				$(".pollWidget").append("Thanks for submitting your vote: " + value);
				$(".pollWidget").append("<br /><br/><strong id='newPollButton'>Load New Poll</strong>");
			},
			fail: function(e) {
				console.log(e);
			}
			
		});
	});
	
	
	
	// DYNAMIC LIVE SEARCH
	$("#searchbar").bind("input", function(){
		
		var searchTerm = $(this).val();
		//console.log(searchTerm);
		
		
		// If there is a search term
		if (searchTerm.length >= 1) {
			
			$.ajax({
				url: base_uri + "searchs/process/searchResults.php",
				type: 'POST',
				data: {searchResult: searchTerm},
				success: function(value){
					
					console.log(value);
					if (value != "null") {
					
						// parse data that PHP sends
						var parse = JSON.parse(value);

						// Remove all search results from display to reset them
						$(".searchUl > li").remove();
						
						// FADE OUT NAVIGATION ON MOBILE
						if (isMobile.Android() || isMobile.iOS()) {
							
							$("#loginRegisterWrapper").css("display", "none");
							$("#navUl").css("display", "none");
							
							
						}
						// APPEND A LIST ITEM FOR EACH RESULT
						$.each(parse, function(index, data) {
							$(".searchUl").append(
								
								"<li id='" + parse[index].id + "'>" + 
									"<a class='hiddenLink' href='" + base_uri + parse[index].type.toLowerCase() + "/" + camelize(parse[index].link) + "'>" +
										"<div class='searchImgContainer' style='width: 90px; height: 70px; overflow: hidden; float: left;'>" +
											"<img src='" + base_uri + "images/" + parse[index].img + "' class='searchResultImg' style='" + parse[index].stuff + "'/>" + 
										"</div>" +
										"<div class='searchLiRight'>" + 
											"<p class='searchResultName'>" + parse[index].name + "</p>" +
											"<p class='searchResultType'>" + parse[index].type + "</p>" +
										"</div>" +
									"</a>" +
								"</li>"
								);
							
						});
					}
						
				}
			});
		
		
		// Empty search results
		} else {
			
			$(".searchUl").empty();
			
			if (isMobile.Android() || isMobile.iOS()) {
				$("#loginRegisterWrapper").css("display", "block");
				$("#navUl").css("display", "table");
			}
			
			
		} 
		
	});
	
	
	
	
	// MOBILE DYNAMIC SEARCH
	
	
	
	
	
	
	
});