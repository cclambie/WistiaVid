<?php
/*
	Plugin Name: Place Wistia Vid
	Plugin URI: http://www.whatwasthat.com.au
	Description: A plugin to add embed a Wistia Vid on Wordpress.  To use Plugin install and then on page you wish to place the Wistia Vid put shortcode [wistiavid id=xxxxx mailchimpid=yyyyy] xxxxx being the Wistia Video ID and yyyyy being the mailchimp list id.
	Version: 0.1
	Author: Craig Lambie
	Author URI: http://craig.lambie.net.au

	Copyright 2013  Craig Lambie  (email : craig+wistiavid@whatwasthat.com.au)
	
	To use Plugin install and then on page you wish to place the Wistia Vid put shortcode [wistiavid id=xxxxx] xxxxx being the Wistia Video ID, this can be found in the URL of the video on Wistia.
	Eg. http://smallbusinesswebsites.wistia.com/medias/q509p384zl
	The ID of this video is q509p384zl therefore the shortcode for the video is [wistiavid id=q509p384zl] as found on this page: 
	http://www.smallbusinesswebsites.org.au/about-us/

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
	
	$mailchimpid='';
	if(isset($args[mailchimpid])) {
		$mailchimpid = $args[mailchimpid];
	} //end if
		
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
				  list: "<?php echo $mailchimpid; ?>"
				}
			  }
			});
		</script>
		<?php
	
} //end PlaceWistiaVid

function PlaceWistiaIframe($args) {
	//Function to place a Wistia Iframe - to use this function instead of the API, comment out the line 25 and uncomment out line 24
	$mailchimpid='';
	if(isset($args[mailchimpid])) {
		$mailchimpid = $args[mailchimpid];
	} //end if
	?>
	<iframe src="http://fast.wistia.net/embed/iframe/<?php echo $args[id]; ?>?controlsVisibleOnLoad=true&playerColor=f78725&plugin%5BrequireEmail-v1%5D%5BbottomText%5D=&plugin%5BrequireEmail-v1%5D%5Blist%5D=<?php echo $mailchimpid; ?>&plugin%5BrequireEmail-v1%5D%5Bprovider%5D=mailchimp&plugin%5BrequireEmail-v1%5D%5Btime%5D=end&plugin%5BrequireEmail-v1%5D%5BtopText%5D=Want%20to%20get%20in%20touch%3F&version=v1&videoHeight=360&videoWidth=640&volumeControl=true" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="640" height="360"></iframe>
	<?php
} //end PlaceWistiaIframe

?>