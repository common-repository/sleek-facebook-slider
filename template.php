<?php  
function sleek_fb_get_template($output){
    $fb_sleek_slider = get_option('sleek_fb_options');
    if(empty($fb_sleek_slider)){
    		return false;
    }
    else {
    		extract($fb_sleek_slider);   
    	}
    $template='<script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/'.$language.'/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk")); 
    </script>
    <div id="sleekouttab">
        <div class="sleekinset testthis">
            <div id="sleekbutton" style="left: 0px;top:'.$icon.'px;"><img src="'.$sleek_img_show.'"></div>
            <div id="sleekarea" style="left: -350px;top:'.$icon.'px; ">
                <div class="form-close">X</div>
                <div class="form-area">
                    <div class="fb-page" 
                        data-href="' . $fb_username . '"
                        data-show-facepile="' . $face . '"
                        data-small-header="false"
                        data-width="350"  
                        data-height="'.$fb_height.'"
                        data-show-posts="' . $post . '"
                        data-hide-cover="' . $cover . '">
                    </div>
                    <div class="fb-credits">'.$output.'</div>
                </div>
            </div>
        </div>
    </div>';
    return $template;
}
?>
