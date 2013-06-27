<?php
/**
* Highlight Module
* 2011 Benjamin Booth
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Add the Google hosted jQuery
JFactory::getDocument()->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js");

//JFactory::getDocument()->addScript("modules".DS."mod_polaroids".DS."js".DS."jQueryRotateCompressed.2.1.js");
JFactory::getDocument()->addStyleSheet("modules".DS."mod_highlight".DS."css".DS."highlight.css");

$img_full_width = $images_width + 40;
$slider_width = $img_full_width * sizeof($images_list);

?>

<style type="text/css">
.mod_highlight, .hl-window,
.nav-left, .nav-right,
.hl-fade-left, .hl-fade-right,
.hl-window, .hl-slider, .hl-image {
	height: <?php echo $images_height; ?>px;
}
.mod_highlight { width: <?php echo 140 + $images_width; ?>px; }
.hl-window, .hl-image { width: <?php echo $images_width; ?>px; }
</style>

<div class="mod_highlight" style="height: <?php echo $images_height; ?>px;">
	<a href="#" class="nav-left"></a>
	<div class="hl-window">
		<?php for ($i = 0; $i < sizeof($images_list); $i++) : ?>
			<?php if ($images_urls[$i] != "#") : ?>
				<a href="<?php echo $images_urls[$i]; ?>" class="hl-image" style="left: <?php echo $i * $img_full_width; ?>px;" target="_blank" >
			<?php else : ?>
				<span class="hl-image" style="left: <?php echo $i * $img_full_width; ?>px;" >
			<?php endif; ?>
				<img src="<?php echo $images_url.DS.$images_list[$i]; ?>"
					width="<?php echo $images_width; ?>"
					height="<?php echo $images_height; ?>"
					alt="<?php echo $images_list[$i]; ?>"
					class="image<?php echo $i; ?>" />
			<?php if ($images_urls[$i] != "#") : ?>
				</a>
			<?php else : ?>
				</span>
			<?php endif; ?>
		<?php endfor; ?>
		<div class="hl-fade-left"></div>
		<div class="hl-fade-right"></div>
	</div>
	<a href="#" class="nav-right"></a>
</div>

<script type="text/javascript">
//Use jQuery noConflict mode
var $jh = jQuery.noConflict();

var jq_timer;

// Initialise jQuery
$jh(document).ready(function(){
	balanceImages();
	
	//jq_timer = setTimeout(slide_images, <?php echo $image_time; ?>);
	
	$jh('.nav-left').click(function(event) {
		event.preventDefault();
		if (!$jh('.hl-image').is(':animated')) {
			//clearTimeout(jq_timer);
			slide_images(1);
		}
	});

	$jh('.nav-right').click(function(event) {
		event.preventDefault();
		if (!$jh('.hl-image').is(':animated')) {
			//clearTimeout(jq_timer);
			slide_images(-1);
		}
	});

	/* $jh('.hl-image').hover(function() {
		clearTimeout(jq_timer);
	}, function() {
		setTimeout(slide_images, <?php echo $image_time; ?>);
	}); */
});

function slide_images(direction) {
	if (direction == null) direction = -1;
	if (direction > 0) {
		$jh('.hl-image').animate({
			left: '+=<?php echo $img_full_width; ?>'
		}, <?php echo $transition_time; ?>, function() {
			balanceImages();
		});
	} else {
		$jh('.hl-image').animate({
			left: '-=<?php echo $img_full_width; ?>'
		}, <?php echo $transition_time; ?>, function() {
			balanceImages();
		});
	}
	
	/* var pos = $jh('.hl-slider').position();
	if (direction > 0 && pos.left < 0) {
		$jh('.hl-slider').animate({
			left: '+=<?php echo $images_width + 40; ?>'
		}, <?php echo $transition_time; ?>);
	} else if (direction < 0 && pos.left > -<?php echo (sizeof($images_list) - 1) * $images_width; ?>) {
		$jh('.hl-slider').animate({
			left: '-=<?php echo $images_width + 40; ?>'
		}, <?php echo $transition_time; ?>);
	}
	jq_timer = setTimeout(slide_images, <?php echo $image_time; ?>);*/
}

function balanceImages() {
	$jh('.hl-image').each(function() {
		var pos = $jh(this).position();
		if (pos.left <= -<?php echo (int)(sizeof($images_list) / 2) * $img_full_width; ?>) {
			$jh(this).css("left", (pos.left + <?php echo sizeof($images_list) * $img_full_width; ?>)+"px");
		}
		if (pos.left >= <?php echo round(sizeof($images_list) / 2) * $img_full_width; ?>) {
			$jh(this).css("left", (pos.left - <?php echo sizeof($images_list) * $img_full_width; ?>)+"px");
		}
	});
}

</script>
