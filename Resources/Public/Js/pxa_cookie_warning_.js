
jQuery( document ).ready(function () {
		jQuery.ajax({
			type: 'get',
			url: location+cookie_bar_url,
			success: function(response){
				jQuery('#pxa-cookie-mess').slideDown('slow');
				jQuery('body').prepend(response);
				var e = jQuery("#pxa-cookie-mess "),
			       	eClose = jQuery("#pxa-cookie-mess .btn-close"),
			        eContainer = jQuery('.top-message-wrap');
			    console.log(e);
			    e.click(function() {
			        e.each(function(){
			         $(this).removeClass('active');
			        });
			        $(this).addClass('active');
			    });
			    eClose.click(function(event) {
			    	event.preventDefault();
					eContainer.fadeOut();       
			    });
			    
				jQuery.ajax({
						type: 'get',
						url: location+'?type=314638125&tx_pxacookiebar_pxacookiebar[action]=closeWarning&tx_pxacookiebar_pxacookiebar[controller]=Cookiewarning',
						success: function(response){
						}
				});
			},
			error: function(response) {
			    alert('Error');
			}
		});
}); 
