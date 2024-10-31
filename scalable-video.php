<?php
/*
	Plugin Name: Scalable Video
	Plugin URI: http://direct.somedia.net
	Description: Complete video solution for your website. Order custom video content and easily add any video to your webpages with advanced real-time analytics tracking.
	Author: SoMedia Development Team
	Author URI: http://www.somedia.net
	Version: 0.1
*/
/*
	Scalable Video
	Copyright 2014 SoMedia Inc.  (email : support@somedia.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
	
*/

// define('WP_DEBUG', true);

define( 'SCALABLE_VIDEO_PLUGIN_DIR', dirname( __FILE__ ) );

add_action('admin_menu', 'add_somedia_menu');

function add_somedia_menu() {

	if(get_option('somedia_username')){
		add_menu_page( 'Scalable Video', 'Scalable Video', 'edit_pages', 'somedia', 'somedia_page',  plugins_url('icon_somedia.png', __FILE__));
		add_submenu_page( 'somedia', 'Create a Player', 'Create a Player', 'edit_pages','somedia&action=customize', 'somedia_page');
		add_submenu_page( 'somedia', 'My Videos', 'My Videos', 'edit_pages','somedia&action=my-players', 'somedia_page');
		add_submenu_page( 'somedia', 'Player Analytics', 'Player Analytics', 'edit_pages','somedia&action=my-analytics', 'somedia_page');
		add_submenu_page( 'somedia', 'Order SoMedia Video', 'Order Video', 'edit_pages','somedia&action=order', 'somedia_page');
		add_submenu_page( 'somedia', 'SoMedia Settings', 'Settings', 'edit_pages','somedia-settings', 'somedia_settings');
	} else {
		add_menu_page( 'Scalable Video', 'Scalable Video', 'edit_pages', 'somedia-settings', 'somedia_settings', plugins_url('icon_somedia.png', __FILE__));
	}
	
}


function somedia_page() {

	if(!get_option('somedia_username')){ 
		somedia_settings();
	} else { ?>

		<script>
		
		jQuery( document ).ready(function() {
		
			jQuery("#SoSubmit a").click(function() {
				var action = jQuery(this).attr("rel");
				jQuery("#SoDestination").val(action);
				jQuery("#user_data").submit();
				return false;
			});
			
		});
		</script>
		
		<style>
			.top-row h1 { text-align: center; }
			.green-grad { font-size: 20px; width: 300px !important; display: block !important; text-transform: none !important; 
			background: #7fc531 !important;
			box-shadow: 0 5px 0 0 #477f08;
			text-shadow: 0 1px 0 #679041;
			border-radius: 8px !important;
			padding: 15px 20px 15px 20px;
			text-align: center;
			color: #fff;
			border: 0px; 
			text-decoration: none;
			margin: 0 auto;
			}
			.container { width: 960px; }
			.green-grad:hover { color: #333; }
			.green-grad span { font-size: 12px; color: #656565; text-shadow: none !important; -webkit-text-shadow: none !important; }
			.hover { color: #fff !important; }
			.grey-span { background: #e2e2e2; }
			.lside { float: left; }
			.rside {  float: right; }
			.w40 { width: 40%; }
			.w60 { width: 60%; }
			.w50 { width: 50%; }
			.page .container { padding: 20px 0 20px 0 !important; }
			
		</style>
		
		<? if(!$_GET['action']) { ?>
		
		<style type="text/css">
		
		.table a { text-decoration: none; border: 0; }
		.table div { width:240px;height:470px;margin:10px 40px 50px 0;display:inline-block;text-align:center;font-size:16px;position:relative;font-weight: 600;vertical-align: middle}
		.table p { font-size: 15px; }
		.table h2 {color:#188ece; margin:10px 0 40px 0; font-size: 25px; line-height: 1.2;}
		.table .btn-submit {position: absolute;top:390px;left: 0;font-size: 18px;width: 180px;}
		.table div a img { margin-bottom: 40px; }
		
		</style>
		
		<p class="sobanner"><img src="<? echo plugins_url( 'assets/banner-772x250.jpg' , __FILE__ ); ?>"></p>
		
		<div class="table" id="SoSubmit">
	
			<div>
			<a href="#" rel="wordpress/order">
			<h2>Order a Video Content</h2>
			<img src="<? echo plugins_url( 'assets/page-platform-1.png' , __FILE__ ); ?>" width="196">
			<p>Order professionally produced video ads and custom video content, shot anywhere in North America.</p>
			</a>
			</div>
			
			<div>
			<a href="#" rel="wordpress/customize">
			<h2>Customize Your Video Player</h2>
			<img src="<? echo plugins_url( 'assets/page-platform-2.png' , __FILE__ ); ?>" width="200">
			<p>Turn all your videos into branded, interactive sales and marketing tools.  Add calls-to-action, maps, lead forms and customize player colors.</p>
			</a>
			</div>
			
			<div style="margin-right:0px">
			<a href="#" rel="wordpress/my-analytics">
			<h2>View<br>Video Analytics</h2>
			<img src="<? echo plugins_url( 'assets/page-platform-3.png' , __FILE__ ); ?>" width="156">
			<p>Monitor your video's performance through your real-time analytics dashboard. Track viewing behavior, drop-offs, and more.</p>
			</a>
			</div>
			
		</div>
		
			
		<? } else if($_GET['action'] == 'customize'){ ?>
		
			<style>
			
			.vplayerheader { background: url('<? echo plugins_url( 'assets/page-player-intro-header.png' , __FILE__ ); ?>') center center no-repeat; width: 100%; height: 185px; margin: 0 auto;   }
			.page { padding-bottom: 20px !important; }
			.container h2 {  }

			.top-row h2 { color: #666; text-align: center; margin: 0 0 20px 0; font-weight: 300; }
			.vplayerheader { margin: 0 0 20px 0; }
			.top-row p { text-align: center; margin: 0 0 30px 0; }

			.lside h2, .rside h2 { color: #188ece; padding: 70px 0 0 0; line-height: 25px; font-weight: 300; font-size: 25px !important; }
			.lside h2 { margin: 0 50px 20px 20px; width: 330px;  }
			.lside p { margin: 0 50px 0 20px; width: 330px; }
			.rside h2 { margin: 0 100px 20px 50px; width: 330px; }
			.rside p { margin: 0 0 0 50px; width: 330px; }

			#row1 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row_03.png' , __FILE__ ); ?>') no-repeat center center; }
			#row2 { height: 280px; background: url('<? echo plugins_url( 'assets/page-player-intro-row_06.png' , __FILE__ ); ?>') no-repeat center center; }
			#row3 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row_10.png' , __FILE__ ); ?>') no-repeat 130px center; }
			#row4 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row_14.png' , __FILE__ ); ?>') no-repeat left center; }
			#row5 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row-_18.png' , __FILE__ ); ?>') no-repeat center center; }
			#row6 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row-_20.png' , __FILE__ ); ?>') no-repeat -10px center; }
			#row7 { height: 340px; background: url('<? echo plugins_url( 'assets/page-player-intro-row-_24.png' , __FILE__ ); ?>') no-repeat center center; }
			</style>
			
			
			<div class="page grey-span" id="SoSubmit">
				<div class="container top-row">
					<h1>Convert Your Viewers Into Customers</h1>
					<h2>Customize your own interactive video players for free.</h2>
					<div class="vplayerheader"></div>
						<a href="#" rel="wordpress/my-players" class="green-grad btn-submit">BUILD A PLAYER</a>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
					<div class="lside w40">
					<h2>Connect with viewers on any device, anytime.</h2>
					<p>Whether uploading a video or using one already on YouTube, our player automatically encodes Flash and HTML5 versions, ensuring clear delivery on all devices, including iPhone, iPad, and iPad touch.</p>
					</div>
					<div class="rside w60" id="row1"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container">
				<div class="lside w40" id="row2" style="margin-top: -60px !important;"></div>
				<div class="rside w60">
				<h2 style="margin-left: 140px; padding-top: 40px !important;">FREE video content management and hosting.</h2>
				<p style="margin-left: 140px;">Whether you have a few video clips or hundreds, our platform makes uploading, storing and managing your video content fast and easy.  And did we mention free?</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
				<div class="lside w40">
				<h2>Control your video's look and feel.</h2>
				<p>Customize your video so that it matches your brand and company colors.  Manipulate player colors, add your logo, add links to social sites, set dimentions and more!</p>
				</div>
				<div class="rside w60" id="row3"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container">
				<div class="lside w40" id="row4"></div>
				<div class="lside w40" style="padding-left: 120px;">
				<h2>Collect qualified leads.</h2>
				<p>Add an email form to your video so that you can easily connect with people interested in your product, service, or company.  Create lead-lists at the click of a button while your viewers are engaged in real-time.</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
				<div class="lside w40">
				<h2>Convert viewers into customers with interactive plug-ins.</h2>
				<p>Guide your most engaged viewers where you want them to go with clickable calls-to-action.  Transform your video into a sales machine by showcasing content, promoting special offers and more.</p>
				</div>
				<div class="lside w40" id="row5" style="margin: 0 0 0 100px;"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container">
				<div class="lside w50" id="row6"></div>
				<div class="rside w50">
				<h2>Use videos to drive traffic to your website.</h2>
				<p>Our platform creates video sitemaps for you - automatically!  A video sitemap helps Google and other search engines read the content of your videos.  This means your videos rank higher in search results along with the pages they live on.  Higher ranking means better results!</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
				<div class="lside w40">
				<h2>Measure and enhance your videos with real-time analytics.</h2>
				<p>Successful video marketing requires access to robust and accurate data.  As you learn what works, you can use the data to enhance future videos!  SoMedia provides analytics and reports that reveal trends in views, viewer behaviour, engagement rates and conversions - so you can get the results you want.</p>
				</div>
				<div class="rside w60" id="row7"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span" id="SoSubmit">
				<div class="container top-row">
				<h1 style="margin: 0 0 30px 0;">Why not get started? It's free!</h1>
				<p>
					<a href="#" rel="wordpress/my-players" class="green-grad btn-submit">BUILD A PLAYER</a>
				</p>
				</div>
				<div class="clear"></div>
			</div>
			
			
		<? } else if($_GET['action'] == 'my-players'){ ?>
		
			<p class="sobanner"><img src="<? echo plugins_url( 'assets/banner-772x250.jpg' , __FILE__ ); ?>"></p>
			<p id="SoSubmit"><a href="#" rel="wordpress/my-players" class="green-grad" style="float: left;">VIEW MY PLAYERS</a></p>
		
		<? } else if($_GET['action'] == 'my-analytics'){ ?>
		
			
			<style>
		
			.hover { color: #fff !important; }
			h1 { line-height: 1.2; }
			.grey-span { background: #e2e2e2; }
			.lside { float: left; }
			.rside {  float: right; }
			.w40 { width: 40%; }
			.w60 { width: 60%; }
			.w50 { width: 50%; }
			.page .container { padding: 20px 0 20px 0 !important; }
			.vanalyticsheader { background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_header.png' , __FILE__ ); ?>') -10px center no-repeat; width: 980px; height: 185px; margin: 0 auto;   }
			.page { padding-bottom: 20px; }

			.top-row h2 { color: #666; text-align: center; margin: 0 0 20px 0; font-weight: 300 !important; font-size: 25px; }
			.top-row p { text-align: center; margin: 0 0 30px 0; }

			.lside h2, .rside h2 { color: #188ece; padding: 80px 0 0 0; line-height: 32px; font-weight: 300; font-size: 25px;}
			.lside h2 { margin: 0 50px 20px 20px; width: 330px;  }
			.lside p { margin: 0 50px 0 20px; width: 330px; font-size: 13px; }
			.rside h2 { margin: 0 100px 20px 50px; width: 330px; }
			.rside p { margin: 0 0 0 50px; width: 330px; font-size: 13px; }

			#row1 { padding: 0 !important; margin-top: -33px; position: absolute; width: 980px; height: 293px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_03.png' , __FILE__ ); ?>') no-repeat center center; }
			#row2 { height: 260px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_07.png' , __FILE__ ); ?>') no-repeat 10px center; }
			#row3 { height: 245px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_11.png' , __FILE__ ); ?>') no-repeat left center; }
			#row4 { height: 260px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_15.png' , __FILE__ ); ?>') no-repeat left center; }
			#row5 { height: 220px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_19.png' , __FILE__ ); ?>') no-repeat center center; }
			#row6 { height: 260px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_23.png' , __FILE__ ); ?>') no-repeat left center; }
			#row7 { height: 230px; background: url('<? echo plugins_url( 'assets/page-analytics-intro-row_24.png' , __FILE__ ); ?>') no-repeat 60px center; }

		
			</style>

			<div class="page grey-span">
				<div class="container top-row">
					<h1>Measure & Enhance Your Video <br>With Real-Time Analytics</h1>
					<h2>Make better decisions and improve results with advanced analytics.</h2>
					<div class="vanalyticsheader"></div>
					
					<p id="SoSubmit"><a href="#" rel="wordpress/my-analytics" class="green-grad btn-submit">ANALYZE MY DATA</a></p>
					
				</div>
				<div class="clear"></div>
			</div>

			<div class="page" style="padding: 20px 0 30px 0 !important;">
				<div class="container top-row">
					<h2 style="margin: 0px !important;">Real-time data enables you to monitor:</h2>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container" style="height: 240px; padding: 0 !important;">
				  <div class="row" id="row1">
					<div class="lside w40">
					<h2 style="padding-top: 80px !important;">Viewer Engagement</h2>
					<p>How many viewers watch the entire video?  At what point do they drop off ?  What content is being skipped? Understanding engagement data will provide the breadcrumbs you need to improve performance of future videos.</p>
					</div>
				  </div>
				  <div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
				<div class="lside w50" id="row2"></div>
				<div class="rside w50">
				<h2 style="margin-left: 100px; padding-top: 65px !important;">Conversion Rates</h2>
				<p style="margin-left: 100px;">Is your video generating the leads you need to see positive ROI? How many  people are clicking on your calls-to-action? Test, optimize, repeat!</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span" style="padding: 0px">
				<div class="container">
				<div class="lside w50">
				<h2 style="padding-top: 50px;">Viewer Geography</h2>
				<p>Track the geographic location of all your viewers - filtered by country, region, or city.</p>
				</div>
				<div class="rside w50" id="row3"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page" style="padding: 0px">
				<div class="container">
				<div class="lside w50" id="row4"></div>
				<div class="lside w40">
				<h2 style="padding-top: 50px; margin-left: 95px;">Device Breakdown</h2>
				<p style="margin-left: 95px;">Get a deeper understanding of your viewers. Track their viewing behaviour by device, OS and even browser type.</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container">
				<div class="lside w50">
				<h2 style="padding-top: 50px !important;">Social Engagement</h2>
				<p>Monitor how many times your video is shared and which social networks are most popular with viewers.</p>
				</div>
				<div class="lside w50" id="row5"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container">
				<div class="lside w50" id="row6"></div>
				<div class="rside w50">
				<h2 style="padding-top: 55px !important; margin-left: 80px;">Performance by<br>Embed Location</h2>
				<p style="margin-left: 80px;">Filter your data by embed location and compare how each is performing.</p>
				</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page grey-span">
				<div class="container">
				<div class="lside w50">
				<h2 style="padding-top: 20px !important;">Video's Impact on Your Website or Blog</h2>
				<p>After watching a video, are visitors staying on your site longer?  Are they more likely to convert?  We've integrated with Google Analytics to understand how your video is impacting your website.</p>
				</div>
				<div class="rside w50" id="row7"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="page">
				<div class="container top-row">
				<h2 style="padding-top: 20px; line-height: 1.3;">Best of all, all this is packaged into a clean,intuitive interface that's easy<br>
			to manipulate so you can get the data you need, whenever you need it!</h2>
				<h1 style="margin: 0 0 30px 0;">Why not get started? It's free!</h1>
				<p id="SoSubmit"><a href="#" rel="wordpress/my-analytics" class="green-grad btn-submit build2">ANALYZE MY DATA</a></p>
				</div>
				<div class="clear"></div>
			</div>

		
		<? } else if($_GET['action'] == 'order'){ ?>
		
			
		<style type="text/css">
		.container h1 { margin: 10px 0 40px 410px; }
		.container { }
		.types { width: 100%; text-align: center; margin: 0 auto; }
		.type { width: 290px; float: left; margin: 0 0 10px 0; }
		.type .ttitle, .type .tdesc { display: none; }
		.type img { margin: 0 0 10px 0; }
		.type a { text-decoration: none; }
		.row { width: 900px; padding-bottom: 20px; border-bottom: 5px solid #eaeaea;  margin: 0 0 20px 40px; }
		h3 { text-align: center; }
		.ui-widget-overlay { position: fixed !important; height: 100% important; }
		#title { padding-top: 10px; font-weight: 700; }
		.start-holder { padding: 20px 0 30px 0; display: none; }
		.overlay { width: 100%; height: 100%; z-index: 1; position: absolute; left: 0px; top: 0px; background: #fff url('<? echo plugins_url( 'assets/wordpress-overlay.png' , __FILE__ ); ?>') repeat; display: none; }
		#player_popup { position: fixed; width: 540px; padding: 20px; top: 50%; left: 50%; background: #fff; webkit-border-radius: 10px; border-radius: 10px; margin-left: -250px; margin-top: -300px; z-index: 10; display: none; }
		.close { float: right; }
		</style>

		<script>
		jQuery(document).ready(function(){
		
			jQuery(".type .popup").on('click',function(e){
				e.preventDefault();
				var content = '<a href="#" class="close">close</a><iframe width="532" height="322" src="http://enterprise.somedia.net/videoembed-iframe.php?nid='+jQuery(this).attr('data-nid')+'&autoplay=true" frameborder="0" allowfullscreen></iframe>';
			
				jQuery("#player_popup").show();
				jQuery("#player_popup").html(content);
				jQuery(".close_popup").show();
				jQuery(".overlay").show();

				var title = jQuery(this).find(".ttitle").text();
				var desc = jQuery(this).find(".tdesc").text();
				jQuery("#player_popup").append("<p id='title'><strong>"+title+"</strong></p><p id='desc'>"+desc+"</p>");
				return false;
			});
		
			jQuery(".close").live( "click", function() {
				jQuery("#player_popup").empty();
				jQuery("#player_popup").hide();
				jQuery(".overlay").hide();
				return false;
			});
			
			jQuery(".overlay").on('click',function(e){
				jQuery("#player_popup").empty();
				jQuery("#player_popup").hide();
				jQuery(".overlay").hide();
				return false;
			});
			
		});
		</script>


	<div class="container">
	
	<h1>Video Ad Types</h1>
	
		<div class="types">
	
		<div class="type" style="margin: 0 0 0 70px;">
		  <a class='popup' href="/contact?type=ad" data-title="scripted" data-nid="18738">
			<div class="ttitle">Texas - Import Car Center</div>
			<div class="tdesc">With a professionally scripted voiceover, this ad describes the various services offered by Import Car Center. The video drives home a clear message for targeted viewers searching for information on repair services for their high end cars.</div>
			<div class="thumb"><img src="<? echo plugins_url( 'assets/page_types_08.png' , __FILE__ ); ?>"></div>
			<div class="desc"><p>A professionally scripted ad complete with music and voiceover.</p></div>
		  </a>
		<div class="start-holder">
		
		</div>
		</div>
		 
		<div class="type">
		   <a class='popup' href="/contact?type=testimonial" data-title="testimonial" data-nid="19192">
			<div class="ttitle">Las Vegas - Web Services</div>
			<div class="tdesc">A video testimonial for your web services And a portfolio video for your favourite customer?  in Vegas it's all possible as the Web Captain is showing off Couture Bride's beautiful services while covering the 600% business growth he helped them achieve in this special 60 second video.</div>
			<div class="thumb"><img src="<? echo plugins_url( 'assets/page_types_03.png' , __FILE__ ); ?>"></div>
			<div class="desc"><p>Feature endorsements<br>from happy clients</p></div>
		  </a>
		<div class="start-holder">
		
		</div>
		</div>
		
		<div class="type">
		  <a class='popup' href="/contact?type=profile" data-title="profile" data-nid="26819">
			<div class="ttitle">Colorado - Landscape Design Firm</div>
			<div class="tdesc">Paul Fredell, the owner of this award winning landscaping firm takes us on a visual tour of his company's professional services and his work philosophy, and it's all done with beautiful imagery and under 40 seconds.</div>
			<div class="thumb"><img src="<? echo plugins_url( 'assets/page_types_05.png' , __FILE__ ); ?>"></div>
			<div class="desc"><p>Showcase a business, product, service or location with a Profile Ad.</p></div>
		  </a>
		<div class="start-holder">
	
		
		</div>
		</div>
		
	</div>
	<br class="clear">
	<div class="types" style="padding-left: 220px;">
	
		<div class="type">
		  <a class='popup' href="/contact?type=news" data-title="news" data-nid="18140">
			<div class="ttitle">World wide - Tobii Technologies</div>
			<div class="tdesc">When your clients develop a cutting edge Eye tracking technology and need to demonstrate its ease of use and many applications, you can help them achieve all that and more with a personal 2 min news video.</div>
			<div class="thumb"><img src="<? echo plugins_url( 'assets/page_types_13.png' , __FILE__ ); ?>"></div>
			<div class="desc"><p>Produce news stories<br>that generate great PR</p></div>
		  </a>
		<div class="start-holder">
		
		</div>
		</div>
		
		<div class="type">
		   <a class='popup' href="/contact?type=custom" data-title="custom" data-nid="26103">
			<div class="ttitle">Expedia CruiseShipCenters</div>
			<div class="tdesc">"Own a profitable business making dream vacations come true". This simple message is clearly illustrated in this custom video as they share the benefits of owning a successful travel franchise, while not forgetting to show the sights & sounds the end client will be looking for.</div>
			<div class="thumb"><img src="<? echo plugins_url( 'assets/page_types_25.png' , __FILE__ ); ?>"></div>
			<div class="desc"><p>Anything you want,<br>we can create it</p></div>
		  </a>
		<div class="start-holder">
		
		</div>
		</div>
		
	</div>
	<br class="clear">
	
	
	<div class="row" style="padding: 30px 0 50px 0;" id="SoSubmit">
		<p style="text-align: center;"><a href="#" rel="wordpress/order-form" class="green-grad btn-action" style="padding: 15px 70px 15px 70px;">Start Your Production</a></p>
		<div class="first-vid"></div>
		<br>
	</div>
	
	<br class="clear">
	<div class="row">
		<p style="text-align: center;"><img src="<? echo plugins_url( 'assets/video_types_18.png' , __FILE__ ); ?>"></p>
	</div>
	<br class="clear">
	<div class="row" style="border-bottom: none;">
		
		<p style="text-align: center;"><img src="<? echo plugins_url( 'assets/page_dashboard_07.png' , __FILE__ ); ?>"></p>
	</div>
	
	</div>


<div id="player_popup"></div><div class="overlay"></div>
			
			
		<? } ?>
		
		<form method="post" action="http://login.somedia.net/login" target="_blank" id="user_data">
			<input type="hidden" name="edit[name]" value="<? echo get_option('somedia_username'); ?>">
			<input type="hidden" name="edit[pass]" value="<? echo get_option('somedia_password'); ?>">
			<input type="hidden" name="domain" value="partners">
			<input type="hidden" name="destination" value="" id="SoDestination">
			<input type="submit" style="display: none;">
		</form>
<?	}
}

function somedia_settings() {

	require_once(SCALABLE_VIDEO_PLUGIN_DIR.'/scalable-settings.php');
	$somediaSettings = new SoMedia_Settings();

	if ($_GET['action']!=-1)
		$action=$_GET['action'];

	elseif (isset($_GET['action2']))
		$action=$_GET['action2'];
	else
	$action='show_list';

	if (method_exists($somediaSettings,$action)) {
		$somediaSettings->$action();
	}
	else
		$somediaSettings->options_page();
	return true;
	
}


function embedSomediaCode() { ?>

	<script>

	jQuery(function(){
	
		jQuery("#somedia-add-player").click(function() {
		
				jQuery.ajax({
					type: "GET",
					url: '<? echo plugins_url( 'list-players.php' , __FILE__ ); ?>',
					data: { so_username : '<? echo get_option('somedia_username'); ?>', so_secret : '<? echo get_option('somedia_secret'); ?>' },
					success: function(response) { 
						jQuery("#TB_ajaxContent").html(response);
				  }
				});
			
		});	
		
	});	
	</script>
<? }

add_action('admin_head', 'embedSomediaCode');

function wp_somedia_add_player_button() {
 add_thickbox();
 
 /** thickbox only loads content within a child element, and onclose, or send_to_editor, will remove this child element **/
 
 $btn = '<div id="somedia-add-players-container" style="display:none;"></div>
		 <a href="#TB_inline?height=550px&inlineId=somedia-add-players-container" class="thickbox button" title="Click on one of your players to insert it into your page!" id="somedia-add-player"><img src="'.plugins_url( "icon_somedia.png" , __FILE__ ).'"> Add Scalable Video Player</a>'; 
  return sprintf($btn);
}

add_filter('media_buttons_context', 'wp_somedia_add_player_button');

function somedia_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'id' => '',
        'size' => 'medium' // defaults to medium if undefined
    ), $atts );

	if ($a['size'] == 'small'){
		$size = '420';
	} else if ($a['size'] == 'medium') {
		$size = '560';
	} else if ($a['size'] == 'large') {
		$size = '640';
	}
	
	if($a['id'] == ''){
		return '** Somedia player error: no player id defined! **';
	} else {
		return '<script type="text/javascript" id="somedia_player_script_'.$a['id'].'" src="http://videoplayer.somedia.net/videoplayer_js?vid='.$a['id'].'&w='.$size.'"></script>';
	}
 
}

add_shortcode( 'scalable_player', 'somedia_shortcode' );

?>
