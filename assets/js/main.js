
jQuery(document).ready(function(){
	jQuery('.form-close').click(function(){
		jQuery('#sleekarea').animate({
			left: "-=350"
		});
		jQuery('#sleekbutton').animate({
			left: "+=100"
		});
	})

	jQuery('#sleekbutton').click(function(){
		jQuery('#sleekarea').animate({
			left: "+=350"
		});
		jQuery('#sleekbutton').animate({
			left: "-=100"
		});
	})

})
