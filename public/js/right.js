// When Right Side view Selected 
jQuery( document ).ready(function() {	
	if (/*@cc_on!@*/true) { 						
		var ieclass = 'ie' + document.documentMode; 
		jQuery( ".popup-wrap" ).addClass(ieclass);
	} 
	jQuery( ".sticky-popup" ).addClass('sticky-popup-right');
	
	var contwidth = jQuery( ".popup-content" ).outerWidth()+2;      	
  	jQuery( ".sticky-popup" ).css( "right", "-"+contwidth+"px" );

  	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

  	jQuery('.sticky-popup').addClass("open_sticky_popup_right");
  	jQuery('.sticky-popup').addClass("popup-content-bounce-in-right");
  	
    jQuery( ".popup-header" ).click(function() {
    	if(jQuery('.sticky-popup').hasClass("open"))
    	{
    		jQuery('.sticky-popup').removeClass("open");
    		jQuery( ".sticky-popup" ).css( "right", "-"+contwidth+"px" );
    	}
    	else
    	{
    		jQuery('.sticky-popup').addClass("open");
      		jQuery( ".sticky-popup" ).css( "right", 0 );		
    	}
      
    });		    
});