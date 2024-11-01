// When Left View is selected
jQuery( document ).ready(function() {	
	/*if (true) {						
		var ieclass = 'ie' + document['documentMode']; 
		jQuery( ".popup-wrap" ).addClass(ieclass);
	} */
	jQuery( ".sticky-popup" ).addClass('sticky-popup-left');
	var contwidth = jQuery( ".popup-content" ).outerWidth()+2;      	
  	jQuery( ".sticky-popup" ).css( "left", "-"+contwidth+"px" );

  	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

  	jQuery('.sticky-popup').addClass("open_sticky_popup_left");
  	jQuery('.sticky-popup').addClass("popup-content-bounce-in-left");
  	
    jQuery( ".popup-header" ).click(function() {
    	if(jQuery('.sticky-popup').hasClass("open"))
    	{
    		jQuery('.sticky-popup').removeClass("open");
    		jQuery( ".sticky-popup" ).css( "left", "-"+contwidth+"px" );
    	}
    	else
    	{
    		jQuery('.sticky-popup').addClass("open");
      		jQuery( ".sticky-popup" ).css( "left", 0 );		
    	}
      
    });		    
});