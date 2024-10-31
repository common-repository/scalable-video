<?php
$json = json_decode(file_get_contents("http://production.somedia.net/api/videoplayers/list?client=".$_GET['so_username']."&secret=".$_GET['so_secret']));
?>
<html>
<head>

<style>
	#TB_ajaxContent { width: 100% !important; height: 90% !important; padding: 0px !important; }
	#TB_window { height: 80% !important; }
	#TB_ajaxContent .somedia-players { font-family: Open Sans, calibri, tahoma; font-size: 12px; border: 0px; width: 100%; padding: 30px 0 0 0; }
	#TB_ajaxContent .somedia-players .player-row { padding: 5px !important; }
	#TB_ajaxContent .somedia-players .player-row:hover { background: #dfedfe; cursor: pointer; }
	#TB_ajaxContent .somedia-players .player-row .thumb { width: 10px; height: 39px; }
	#TB_ajaxContent .somedia-players .player-row .title p { margin: 0 0 4px 0 !important; padding: 0px !important; }
	#TB_ajaxContent .somedia-players .player-row .title .title { font-weight: 700; }
	#TB_ajaxContent .somedia-players .player-row .title .created-txt {  font-size: 8px; text-transform: uppercase; color: #777; }
	#TB_ajaxContent .somedia-players .player-row .title .created { font-size: 10px; text-transform: uppercase; }
	#TB_ajaxContent .somedia-players .player-row .action { min-width: 80px; }
	#TB_ajaxContent .somedia-players .player-row .action .add { display: none; text-transform: uppercase; font-size: 12px; color: #188ece; font-weight: 700; }
	#TB_ajaxContent .no-player { padding: 30px; text-align: center; }
	#TB_ajaxContent .more-players { text-align: center; width: 100%; padding-top: 15px; }
</style>

<script>

jQuery( document ).ready(function() {

	jQuery(".player-row").hover(
		function() {
			jQuery( this ).find('.add').show();
		}, function() {
			jQuery( this ).find('.add').hide();
		}
	);
	
	jQuery(".player-row").click(function() {
		var pid = jQuery(this).attr('id');
		var shortcode = '[scalable_player id="'+pid+'"]';
		send_to_editor(shortcode);
	});
	
});
</script>

</head>
<body>

<table class="somedia-players" cellspacing="0" cellpadding="5" border="0">

<? if($json){
	foreach($json as $vp){
			echo '<tr class="player-row" id="'.$vp->vid.'">
					<td class="spacer"> &nbsp; </td>
					<td class="thumb"></td>
					<td class="title"><p><span class="title">'.$vp->title.'</span> <span class="created-txt">created</span> <span class="created">'.$vp->created.'</span></p>
					<p>'.$vp->description.'</p>
					</td>
					<td class="action"><span class="add">insert<br>into post</span></td>
				  </tr>';	  
			}
	} else {
	echo "<p class='no-player'><strong>Woops! You have no video players.</strong></p>";
	} ?>
</table>

<div class="more-players">
	<p><strong>Want to create more free players?</strong></p>
	<p>Under the Scalable Video Plugin, press on <strong>Create a Player</strong>!</p>
	<p>Did you know you can host a YouTube video or upload your own video?</p>
</div>

</body>
</html>