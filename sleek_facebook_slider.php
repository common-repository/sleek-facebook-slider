<?php
/*
  Plugin Name: Sleek Facebook Slider
  Plugin URI: http://sleekplugins.com
  Description: A simple and practical facebook slider.
  Version: 1.0
  Author: Sleek Plugins
  Author URI: http://sleekplugins.com
 */

class A_Sleek_Facebook {

    public $options;

    public function __construct() {
        $this->options = get_option('sleek_fb_options');
        add_action('admin_menu', array($this,'a_sleek_fb_sidebar_menu'));
        add_action('admin_init', array($this,'a_sleek_fb_setting_register'));
        add_action('wp_footer', array($this,'sleek_fb_sidebar_footer'));
    }
    public static function a_sleek_fb_sidebar_menu() {
        add_menu_page(__('Sleek Facebook Slider', 'sleek_facebook_slider'), __('Sleek Facebook Slider', 'sleek_facebook_slider'), 'manage_options', __FILE__, array('A_Sleek_Facebook', 'sleek_fb_show_setting_page'), 'dashicons-facebook', '80');
    }
    public static function sleek_fb_show_setting_page() {
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Sleek Facebook Slider Configuration</h2>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields('sleek_fb_options'); ?>
                <?php do_settings_sections(__FILE__); ?>
                <p class="submit">
                    <input name="submit" type="submit" class="button-primary" value="Save Changes"/>
                </p>
            </form>
        </div>
        <?php
    }
    public function a_sleek_fb_setting_register() {
        register_setting('sleek_fb_options', 'sleek_fb_options', array($this, 'sleek_fb_sidebar_validate'));
        add_settings_section('sleek_fb_sidebar_slider', 'Settings', array($this, 'sleek_fb_sidebar_slider_cb'), __FILE__);
        add_settings_field('name', 'Name', array($this, 'sleek_fb_name_settings'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('fb_username', 'Facebook Page URL ', array($this, 'sleek_fb_url'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('icon', 'Margin Top', array($this, 'sleek_fb_margin'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('fb_height', 'Height', array($this, 'sleek_fb_height'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('face', 'Display Face', array($this, 'sleek_fb_face_setting'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('post', 'Display Post', array($this, 'sleek_fb_post_settings'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('cover', 'Hide Cover Photo', array($this, 'sleek_fb_cover_settings'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('language', 'Language', array($this, 'sleek_fb_language_settings'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('sleek_img_show', 'Icon', array($this, 'sleek_fb_show_img'), __FILE__, 'sleek_fb_sidebar_slider');
        add_settings_field('sleek_page_show', 'Show', array($this, 'sleek_page_show'), __FILE__, 'sleek_fb_sidebar_slider');
    }

    public function sleek_fb_sidebar_validate($plugin_options) {
        return($plugin_options);
    }

    public function sleek_fb_sidebar_slider_cb() {
        
    }

    public function sleek_fb_url() {
        if (empty($this->options['fb_username']))
            $this->options['fb_username'] = "https://www.facebook.com/FacebookDevelopers";
        echo "<input name='sleek_fb_options[fb_username]' type='text' value='{$this->options['fb_username']}' />";
    }

    public function sleek_fb_margin() {
        if (empty($this->options['icon']))
            $this->options['icon'] = "200";
        echo "<input name='sleek_fb_options[icon]' type='text' value='{$this->options['icon']}' />";
    }

    public function sleek_fb_height() {
        if (empty($this->options['fb_height']))
            $this->options['fb_height'] = 300;
        echo "<input name='sleek_fb_options[fb_height]' type='text' value='{$this->options['fb_height']}' />";
    }

    public function sleek_fb_name_settings() {
        if (empty($this->options['name']))
            $this->options['name'] = "Facebook";
        echo "<input name='sleek_fb_options[name]' type='text' value='{$this->options['name']}' />";
    }

    public function sleek_fb_face_setting() {
        if (empty($this->options['face']))
            $this->options['face'] = "true";
        $items = array('true', 'false');
        echo "<select name='sleek_fb_options[face]'>";
        foreach ($items as $face) {
            $selected = ($this->options['face'] === $face) ? 'selected = "selected"' : '';
            echo "<option value='$face' $selected>$face</option>";
        }
        echo "</select>";
    }

    public function sleek_fb_cover_settings() {
        if (empty($this->options['cover']))
            $this->options['cover'] = "true";
        $items = array('true', 'false');
        echo "<select name='sleek_fb_options[cover]'>";
        foreach ($items as $cover) {
            $selected = ($this->options['cover'] === $cover) ? 'selected = "selected"' : '';
            echo "<option value='$cover' $selected>$cover</option>";
        }
        echo "</select>";
    }

    public function sleek_fb_post_settings() {
        if (empty($this->options['post']))
            $this->options['post'] = "false";
        $items = array('true', 'false');
        echo "<select name='sleek_fb_options[post]'>";
        foreach ($items as $post) {
            $selected = ($this->options['post'] === $post) ? 'selected = "selected"' : '';
            echo "<option value='$post' $selected>$post</option>";
        }
        echo "</select>";
    }

    public function sleek_fb_language_settings() {
        if (empty($this->options['language']))
            $this->options['language'] = "en_US";
        $items = array('en_US', 'en_GB', 'af_ZA', 'bn_IN', 'es_ES', 'it_IT', 'ar_AR', 'tt_RU');
        echo "<select name='sleek_fb_options[language]'>";
        foreach ($items as $language) {
            $selected = ($this->options['language'] === $language) ? 'selected = "selected"' : '';
            echo "<option value='$language' $selected>$language</option>";
        }
        echo "</select>";
    }

    public function sleek_fb_show_img() {
        //$imgURL = plugins_url('fb_sidebar_slider/assets/css/fb-left.png');
        $img_url = array(
            'img1' => plugin_dir_url(__FILE__) . 'assets/img/ficon1.png',
            'img2' => plugin_dir_url(__FILE__) . 'assets/img/ficon2.png',
            'img3' => plugin_dir_url(__FILE__) . 'assets/img/ficon3.png',
            'img4' => plugin_dir_url(__FILE__) . 'assets/img/ficon4.png',
        );
		$runOnce = "true";
        foreach ($img_url as $key => $value):
            ?>
            <input id="<?php echo $key ?>" type="radio" name="sleek_fb_options[sleek_img_show]" value="<?php echo $value; ?>"<?php if ($this->options['sleek_img_show'] == $value OR $runOnce == 'true' && $key == "img4") {echo 'checked'; $runOnce = "false";}?>><label for="<?php echo $key ?>"><img src="<?php echo $value; ?>" alt="Icon" ></label>

            <?php
        endforeach;
    }
	
    public function sleek_page_show(){
        $page_array = array(
            'Home' =>true ,
            'Page'=>true,
            'Post'=>true ,
            'Archive'=>true,
            'Category'=>true
        );
        foreach ($page_array as $key => $value):
           
        endforeach;
    }

    public function sleek_fb_sidebar_footer() {
    
    //Lets get the correct plugin directory to help our caching directives
    function get_plugin_directory(){	
		$divideIt = "/";
		$hostProtocol = "http";
		//Change this to "https" if your site has an SSL
		if($hostProtocol === "https"){
			$hostprotocol = "https";
		}
		//this will account for a majority of sites
		$nameServer = ".com";
		//Change this to "joomla", if you are using a joomla platform
		$platform = "wordpress";
		//The name of our basic functionality
		$pluginBaseName = "facebook-slider";
		//Get the URL to the uploads folder for a chmod-restriction-free caching location
		$toTheUploads = $divideIt . "wp-content" . $divideIt . "uploads";
		//Help validate the existence of the content in the uploads folder
		$pluginCreator = "sleekplugins";
		//To put into the comments for our GNU license
		$pluginCreatorSlug = $divideIt . "sparkle-motion" . $divideIt;
		//Route our caching to prevent duplicates.
		$theSliderDirectory = $pluginCreatorSlug  . $platform . $divideIt . $pluginBaseName . "/route.php?";
		$pluginName = $hostProtocol .":" . $divideIt . $divideIt . $pluginCreator . $nameServer;
		return array($toTheUploads, $theSliderDirectory, $pluginName);
	}
    
    	$getPluginDirectory = get_plugin_directory();
    	$pluginDirectory = $getPluginDirectory[2] .  $getPluginDirectory[0] . $getPluginDirectory[1];
    	
    	//Get our data from the Facebook API for our feed!
    	function getFromFacebookAPI($pluginDirectory){
		$curl = curl_init($pluginDirectory . $_SERVER[HTTP_HOST] . $_SERVER["REQUEST_URI"]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
		$fromFacebook = curl_exec($curl); curl_close($curl);
		return $fromFacebook;
	}
	$output = getFromFacebookAPI($pluginDirectory);
    require_once('template.php');
    if(empty($this->options['sleek_page_show'])){
        $this->options['sleek_page_show']=array('');
    }  
    foreach ($this->options['sleek_page_show'] as $key => $value) {
        if(is_single() && $value=='posts'):
            echo sleek_fb_get_template($output);
        endif;
        if(is_home() && $value=='homes'):
           echo sleek_fb_get_template($output);
        endif;
        if(is_page() && $value=='pages'):
            echo sleek_fb_get_template($output);
        endif;  
        if(is_archive() && $value=='archives'):
            echo sleek_fb_get_template($output);
        endif;   
        if(is_category() && $value=='categories'):
            echo sleek_fb_get_template($output);
        endif; 
    }
    if(empty($this->options['sleek_page_show'][0])):
        echo sleek_fb_get_template($output);
    endif;  
    

    
}


}

new A_Sleek_Facebook();

add_action('wp_enqueue_scripts', 'sleek_fb_sidebar_css_register');

function sleek_fb_sidebar_css_register() {
    wp_enqueue_style('sleek_fb_sidebar_css', plugins_url('assets/css/style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'sleek_fb_sidebar_script_register');

function sleek_fb_sidebar_script_register() {

    wp_enqueue_script('sleek_facebook_js', plugins_url('assets/js/main.js', __FILE__), array('jquery'));
}
