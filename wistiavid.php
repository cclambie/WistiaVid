<?php
/*
	Plugin Name: Place Wistia Vid
	Plugin URI: http://www.whatwasthat.com.au
	Description: A plugin to add embed a Wistia Vid on Wordpress
	Version: 0.1
	Author: Craig Lambie
	Author URI: http://craig.lambie.net.au

	Copyright 2012  Craig Lambie  (email : craig@whatwasthat.com.au)

*/

$wistiavid_pn = plugin_basename(__FILE__);
$wistiavid_pd = dirname(plugin_basename(__FILE__));
define( 'wistiavid', $wistiavid_pn );
define('wistiavidDIR', $wistiavid_pd );

//add_shortcode('wistiavid', 'PlaceWistiaIframe');
add_shortcode('wistiavid', 'PlaceWistiaVid');
add_action('wp_enqueue_scripts', 'my_scripts_method');

function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
	
	wp_deregister_script( 'wistiaSOC');
	wp_register_script( 'wistiaSOC', 'http://fast.wistia.com/static/concat/E-v1%2Csocialbar-v1%2CpostRoll-v1.js');
	wp_enqueue_script( 'wistiaSOC' );
	
	wp_deregister_script( 'wistia');
	wp_register_script( 'wistia', 'http://fast.wistia.com/static/concat/E-v1.js');
	wp_enqueue_script( 'wistia' );
}    
 
function PlaceWistiaVid($args) {
    //$siteurl = get_option('siteurl');
    //$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/wistiavidStyle.css';
    //echo "<link rel='stylesheet' type='text/css' href='$url' />\n";

	?>
		<div id="wistia_<?php echo $args[id]; ?>" class="wistia_embed" style="width:640px;height:388px;" data-video-width="640" data-video-height="360"></div>
		</div>
		<script>
			wistiaEmbed = Wistia.embed("<?php echo $args[id]; ?>", {
			  version: "v1",
			  videoWidth: 640,
			  videoHeight: 360,
			  volumeControl: true,
			  controlsVisibleOnLoad: true,
			  playerColor: "f78725",
			  plugin: {
				"requireEmail-v1": {
				  topText: "Want to get in touch?",
				  bottomText: "",
				  time: "end",
				  provider: "mailchimp",
				  list: "e76b12fdfc"
				}
			  }
			});
		</script>
		<?php
	
} //end PlaceWistiaVid

function PlaceWistiaIframe($args) {
	?>
	<iframe src="http://fast.wistia.net/embed/iframe/q509p384zl?controlsVisibleOnLoad=true&playerColor=f78725&plugin%5BrequireEmail-v1%5D%5BbottomText%5D=&plugin%5BrequireEmail-v1%5D%5Blist%5D=e76b12fdfc&plugin%5BrequireEmail-v1%5D%5Bprovider%5D=mailchimp&plugin%5BrequireEmail-v1%5D%5Btime%5D=end&plugin%5BrequireEmail-v1%5D%5BtopText%5D=Want%20to%20get%20in%20touch%3F&version=v1&videoHeight=360&videoWidth=640&volumeControl=true" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="640" height="360"></iframe>
	<?php
}

?>