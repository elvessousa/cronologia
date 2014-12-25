<?php
/*
Plugin Name: Le Timeline
Plugin URI: http://elvessousa.com.br
Description: Plugin for registering timeline chronologies.
Version: 0.1
Author: Elves Sousa
Author Email: elvessousa@icloud.com
License:

	Copyright 2014 Elves Sousa (elvessousa@icloud.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// ----------------------------------------------------
// Constants
// ----------------------------------------------------
define('ESS_TIMELINE_URL', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );
define('ESS_TIMELINE_PATH', WP_PLUGIN_DIR."/".dirname( plugin_basename( __FILE__ ) ) );


// ----------------------------------------------------
// Enqueues [frontend]
// ----------------------------------------------------
add_action('init', 'ess_timeline_frontend_enqueues', 5);
function ess_timeline_frontend_enqueues() {
    wp_register_style('ess-timeline', ESS_TIMELINE_URL . '/css/timeline.css', true);
    wp_register_style('ess-timeline-custom', ESS_TIMELINE_URL . '/inc/timeline-style.php', true);
    wp_register_script('ess-timeline', ESS_TIMELINE_URL . '/js/timeline-min.js', array('jquery'), true);
    wp_register_script('ess-timeline-data', ESS_TIMELINE_URL . '/js/ess-timeline-data.js', array('jquery'), true);
    wp_register_script('ess-storyjs', ESS_TIMELINE_URL . '/js/storyjs-embed.js', array('jquery'), true);
}


// ----------------------------------------------------
// Timeline: [ess-timeline  src="src"]
// ----------------------------------------------------
add_shortcode('ess-timeline', 'ess_timeline');
function ess_timeline($atts, $content = null) {
    extract( shortcode_atts( array(
        'name'    => '',
        'width'   => '100%',
        'lang'    => '',
        'height'  => '600',
        'hash'    => 'true',
        'reverse' => 'false'
    ), $atts) );

    // Initial values
    global $post;
    $args = array(
        'post_type'      => 'timeline',
        'chronologies'   => $name,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'posts_per_page' => -1
    );
    $timeline_query = new WP_Query($args);
    $slides         = array();

    // Slide content
    while ( $timeline_query->have_posts() ) {
        $timeline_query->the_post();

        $slide  = ess_get_timeline_fields();

        // Slide data
        $content = array (
            'startDate' => $slide['date'],
            'endDate'   => $slide['end-date'],
            'headline'  => get_the_title(),
            'text'      => $slide['text'],
            'asset'     => array (
                'media'   => $slide['media'],
                'credit'  => $slide['credit'],
                'caption' => $slide['caption']
            )
        );

        $slides[] = $content;
    }

    // Timeline with slides
    $time = array (
        'timeline' => array (
            'headline' => '',
            'type'     => 'default',
            'text'     => '',
            'date'     => $slides),
    );

    // Timeline data
    $timeline_data = array(
        'twidth'  => '100%',
        'theight' => $height,
        'src'     => json_encode($time),
        'id'      => $name . '-embed',
        'lang'    => $lang,
        'hash'    => $hash,
        'reverse' => $reverse,
        'maptype' => 'watercolor',
        'css'     => '',
        'js'      => ''
    );

    // Enqueue the scripts
    wp_enqueue_style('ess-timeline');
    wp_enqueue_script('ess-timeline');
    wp_localize_script('ess-timeline-data', 'ess_timeline', $timeline_data);
    wp_enqueue_script('ess-timeline-data');
    wp_enqueue_script('ess-storyjs');

    // Output
    $output = '<div id="' . $name . '-embed"></div>';
    return $output;
}


// ----------------------------------------------------
// Includes
// ----------------------------------------------------
require_once('inc/metaboxes.php');
require_once('types/timeline-type.php'); ?>
