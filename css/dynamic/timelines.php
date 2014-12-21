<?php
/*-----------------------------------------------------------------------

	Style Name: Timelines
	This file uses the design options to create a custom CSS at runtime.
	Make sure you know what you're doing before altering this file.
  
------------------------------------------------------------------------*/
	require_once('../../../../../wp-load.php');
	header("Content-type: text/css");
	
	// ---------------------------------------------------------
	// Timelines CSS
	// --------------------------------------------------------- 
	if (get_option('ess-customposts_custom_timeline')) {
		   
		// Timeline areas
	    $timebg = get_option('ess-customposts_time_bg');
	    $timenavlinecolor = get_option('ess-customposts_time_navline_color');
	    $timebordercolor = get_option('ess-customposts_time_bordercolor');
	    $timenavbg = get_option('ess-customposts_time_nav_color');
	    $shadowcolor = get_option('ess-customposts_time_shadowcolor');

	    // Timeline font color
	    $timetitlecolor = get_option('ess-customposts_time_titlecolor');
	    $timetextcolor = get_option('ess-customposts_time_textcolor');
	    $timelinelink = get_option('ess-customposts_time_linkcolor');
	    $timelinelink2 = get_option('ess-customposts_time_linkcolor2');
	    $timesecondarytextcolor = get_option('ess-customposts_time_caption_textcolor');
	    
		// Background colors
		echo "/* Timeline background color overrides */ \n";
		if ($timebg != '') {
			echo 	".storyjs-embed, .vco-storyjs, \n
					.vco-timeline .vco-navigation .timenav-background .timenav-interval-background, \n
					.vco-timeline .vco-navigation .vco-toolbar, \n
					.vco-storyjs blockquote, .vco-storyjs blockquote p { \n
						background: #".$timebg." !important; \n 
					} \n";
		}

		// Border colors
		if ($timebordercolor) {
			echo ".storyjs-embed.sized-embed, .vco-timeline .vco-navigation,
			.vco-slider .slider-item .content .content-container .media .media-wrapper .media-container .media-frame,
			.vco-slider .slider-item .content-container.layout-text-media.pad-left .text-media,
			.vco-slider .slider-item .content .content-container .media .media-wrapper .media-container .media-image img { 
				border-color: #".$timebordercolor." !important; } \n";
		}

		// Time navigator
		if ($timenavbg != '') {
			echo ".vco-timeline .vco-navigation .timenav-background { background-color: #".$timenavbg." !important; } \n";
		}

		if ($timenavlinecolor != '') {
			echo ".vco-timeline .vco-navigation .timenav .content .marker.active .line, \n
				.vco-timeline .vco-navigation .timenav .content .marker.active .dot,
				.vco-timeline .vco-navigation .timenav-background .timenav-line { \n 
					background-color: #".$timenavlinecolor." !important; } \n";
		}

		// Font colors
		echo "/* Timeline font color overrides */ \n";
		echo ".vco-storyjs .vco-feature h3, .vco-storyjs h2.start { \n";
			if($timetitlecolor != '') { echo "color: #".$timetitlecolor." !important; \n";}
		echo " } \n";

		if ($timelinelink != '') { echo ".vco-storyjs a { color: #".$timelinelink." !important; } \n"; }
		if ($timelinelink2 != '') { echo ".vco-storyjs a:hover { color: #".$timelinelink2." !important; } \n"; }

		if ($timesecondarytextcolor != '') {
			echo ".vco-notouch .vco-slider .nav-previous, .vco-storyjs h2.date,
		 	.vco-notouch .vco-slider .nav-next, .vco-slider .slider-item .content .content-container .media .media-wrapper .caption, 
		 	.vco-slider .slider-item .content .content-container .media .media-wrapper .credit { 
		 		color: #".$timesecondarytextcolor." !important; } \n";
		}
		
		if ($timetextcolor != '') {
			echo ".vco-notouch .vco-slider .nav-previous:hover, \n
		 	.vco-notouch .vco-slider .nav-next:hover, \n
		 		.vco-slider .slider-item .content .content-container .text .container p,
		 		.vco-slider .slider-item .content .twitter blockquote, .vco-slider .slider-item .content .plain-text-quote blockquote, .vco-slider .slider-item .content .storify blockquote, .vco-slider .slider-item .content .googleplus blockquote,
		 		.vco-timeline .vco-navigation .timenav .time .time-interval-major div,
		 		.vco-timeline .vco-navigation .timenav .time .time-interval div { \n
		 			color: #".$timetextcolor." !important; } \n";
		}

		// Shadows
		if ($shadowcolor != '') {
			echo ".vco-slider .slider-item .content .content-container .media .media-wrapper .media-container .media-shadow::before, .vco-slider .slider-item .content .content-container .media .media-wrapper .media-container .media-shadow:after 
			{ \n -webkit-box-shadow: 0 15px 10px #".$shadowcolor." !important; \n
				-moz-box-shadow: 0 15px 10px #".$shadowcolor." !important; \n
				box-shadow: 0 15px 10px #".$shadowcolor." !important; } \n ";
		}
	}

	
