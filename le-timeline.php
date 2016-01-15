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
  wp_register_script('ess-timeline', ESS_TIMELINE_URL . '/js/timeline-min.js', array('jquery'), true);
  wp_register_script('ess-timeline-data', ESS_TIMELINE_URL . '/js/ess-timeline-data.js', array('jquery'), true);
}

// ----------------------------------------------------
// Enqueues [backend]
// ----------------------------------------------------
add_action('admin_enqueue_scripts', 'ess_timeline_backend_enqueues');
function ess_timeline_backend_enqueues() {
  $screen   = get_current_screen();
  $screenId = $screen->id;

  $labels = array(
    'imgDiagTitle' => __('Choose a media from Wordpress', 'ess-timeline'),
    'imgDiagBtn' => __('Use this one', 'ess-timeline'),
    'plugin_url' => ESS_TIMELINE_URL
  );

  if ($screenId == 'timeline') {
    // Wordpress scripts
    wp_enqueue_media();

    // Angular
    wp_enqueue_script('angularjs', ESS_TIMELINE_URL . '/bin/angular/angular.min.js', array(), null );

    // Timeline metabox script
    wp_register_script('ess-timeline-metabox', ESS_TIMELINE_URL . '/js/ess-timeline-metabox.js', array(), null  );
    wp_localize_script('ess-timeline-metabox', 'ess_timeline', $labels);
    wp_enqueue_script('ess-timeline-metabox');

    wp_enqueue_style('ess-timeline-metabox-ui', ESS_TIMELINE_URL . '/css/ess-timeline-fields.css');

  }
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
    $content = array(
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
  'timeline' => array(
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
  wp_register_script('ess-timeline-storyjs', ESS_TIMELINE_URL . '/js/storyjs-embed.js', array('jquery'), true);
  wp_enqueue_script('ess-timeline-storyjs');

  // Output
  $output = "<div id='$name-embed'></div>";
  return $output;
}

// ----------------------------------------------------
// Timeline: [ess-timeline  src="src"]
// ----------------------------------------------------
add_shortcode('ess-timeline-3', 'ess_timeline_3');
function ess_timeline_3($atts, $content = null) {
  extract( shortcode_atts( array(
    'name'     => '',
    'width'    => '100%',
    'lang'     => '',
    'height'   => '600',
    'hash'     => 'true',
    'reverse'  => 'false',
    'caption'  => '',
    'credit'   => '',
    'headline' => '',
    'text'     => '',
    'thumb'    => '',
    'bg'       => ''
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
    $slide = json_decode(get_post_meta( $post->ID, '_timeline_content', true ));

    // Slide data
    $content = array(
      'start_date' => array($slide->date),
      'end_date'   => array($slide->enddate),
      'media'      => array($slide->media),
      'background' => array($slide->background),
      'text'       => array(
        'headline' => get_the_title(),
        'text'     => $slide->text,
      ),
    );

    $slides[] = $content;
  }

  echo "<pre>";
  echo(json_encode($slides, JSON_PRETTY_PRINT));
  echo "</pre><hr>";

  // Timeline with slides
  $time = array(
    'title'  => array(
      'media' => array(
        'url'       => $thumb,
        'thumbnail' => $bg,
        'caption'   => $headline,
        'credit'    => $text,
      ),
      'text' => array(
        'headline' => $headline,
        'text'     => $text,
      ),
    ),
    'events'   => $slides,
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

  wp_register_style('ess-timeline-3', ESS_TIMELINE_URL . '/bin/timeline/css/timeline.css', true);
  wp_register_script('ess-timeline-3', ESS_TIMELINE_URL . '/bin/timeline/timeline-min.js', array('jquery'), true);
  wp_register_script('ess-timeline-3-data', ESS_TIMELINE_URL . '/js/ess-timeline-3-data.js', array('jquery'), true);

  // Enqueue the scripts
  wp_enqueue_style('ess-timeline-3');
  wp_enqueue_script('ess-timeline-3');
  wp_localize_script('ess-timeline-3-data', 'ess_timeline', $timeline_data);
  wp_enqueue_script('ess-timeline-3-data');

  // Output
  $output = "<div id='$name-embed' style='height:{$height}px; width:100%'></div>";
  return $output;
}


// ----------------------------------------------------
// Includes
// ----------------------------------------------------
require_once('inc/metaboxes.php');
require_once('types/timeline-type.php'); ?>
