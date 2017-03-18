/* 
*	Author: Pedro Mauricio Tavares
*	ID: D12123176
*	Course: DT249/3
*	Subject: Internet Development Application
*
*/
//	JavaScript Codes. General

//To execute when the document is loaded
$(document).ready(function(){
	//Slide on the index Page
	$('#slider').anythingSlider({
		autoPlay: true,
		buildStartStop: false,
		buildNavigation: false,
		toggleArrows: true // Make the navigation appear when hover over the image
		
	}),
	$(".link_subjects").fancybox({
		'width': 500,
		'height': 500,
		'autoSize' : false,
		
		
	});
	$("#terms_conditions a").fancybox({
		'width': 500,
		'height': 600,
		'autoSize' : false,
		
		
	});
	
	
	/*Function for the Login menu
	* 
	* 
	*/
	$('#open_menu').click(function() {
	 	$('#login_link form').stop().slideToggle(600);
	 	$(this).toggleClass('close'); 
 	 }); // end click
	
	
	/*Function for the Responsive Menu
	* This function will make the menu items appear or disappear. 
	* This will be for small screen only
	*/
	var MenuState = true;
	$("#menu_button").on("click", function(){ 
		if(MenuState){
			$("#main_menu").stop().slideDown(1500);
			$("#menu_responsive p").stop().fadeOut(1000);
		}else{
			$("#main_menu").stop().slideUp(1500);
			$("#menu_responsive p").stop().fadeIn(1000);
					
		}
		
		MenuState = !MenuState;	
		
	});
	
	
});


/*
*	This function is to correct the bug. After resizing the window, the Menu kept hidden.
*	The bellow code will make the Menu appear again when resizing the window.
*
*/
$(window).resize(function(){
	
	if($('#menu_button').is(':visible')) {
    	$("#main_menu").hide(100);
		$("#menu_responsive p").fadeIn(1000);
	}
	else{
		$("#main_menu").attr("height","auto");
		$("#main_menu").show(100);
		
	}	
	
	
});


/*
*	Validate the form on the contacts page
*/
