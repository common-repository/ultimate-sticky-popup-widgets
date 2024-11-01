jQuery( document ).ready(function() {	
	jQuery( ".sticky-popup" ).addClass('top-left');
	var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
  	jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
	
  	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

  	jQuery('.sticky-popup').addClass("open_sticky_popup_top");
  	jQuery('.sticky-popup').addClass("popup-content-bounce-in-down");
  	
    jQuery( ".popup-header" ).click(function() {
    	if(jQuery('.sticky-popup').hasClass("open"))
    	{
    		jQuery('.sticky-popup').removeClass("open");
    		jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
    	}
    	else
    	{
    		jQuery('.sticky-popup').addClass("open");
      		jQuery( ".sticky-popup" ).css( "top", 0 );		
    	}
      
    });		    
});