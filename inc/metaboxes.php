<?php
/*-----------------------------------------------------------------------

	Metaboxes for the timeline.
	Feel free to adjust it to your needs.

------------------------------------------------------------------------*/
add_filter( 'cmb2_meta_boxes', 'ess_timeline_metaboxes' );
function ess_timeline_metaboxes( $meta_boxes = array() ) {

    global $pagenow;
    $pagelist = array('post.php', 'post-new.php');

    if(in_array($pagenow, $pagelist)):
	$prefix_timeline = '_ess-timeline_';

	$meta_boxes['timeline'] = array(
		'id'         => 'timeline_metabox',
		'title'      => __('Timeline', 'template'),
		'object_types'      => array( 'timeline' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => __('Date', 'ess-customposts'),
				'id'      => $prefix_timeline . 'date',
				'type'    => 'text_small',
			),
			array(
				'name'    => __('End Date', 'ess-customposts'),
				'id'      => $prefix_timeline . 'enddate',
				'type'    => 'text_small',
			),
			array(
				'name'    => __('Text', 'ess-customposts'),
				'id'      => $prefix_timeline . 'text',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 3, 'teeny' => true )
			),
			array(
				'name' => __('Media', 'ess-customposts'),
				'id'   => $prefix_timeline . 'media',
				'type' => 'file',
				'std'  => ''
			),
			array(
				'name' => __('Credit', 'ess-customposts'),
				'id'   => $prefix_timeline . 'credit',
				'type' => 'text',
			),
			array(
				'name'    => __('Caption', 'ess-customposts'),
				'id'      => $prefix_timeline . 'caption',
				'type'    => 'text',
				'options' => array( 'textarea_rows' => 3, )
			),

		),
	);

	$meta_boxes['show-timeline'] = array(
		'id'          => 'page_metabox',
		'title'       => 'Top Content Options',
		'object_types' => array( 'page', 'post' ),
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __('Timeline to show', 'template'),
				'desc' => __('Write the slug of the timeline you wish to show on this page. Ex: "my-awesome-timeline".', 'template'),
				'id'   => $prefix_timeline . '_displaytimeline',
				'type' => 'text',
			),
		)
	);
    endif;

	return $meta_boxes;
}

// ----------------------------------------------------
// Initialize the metabox class.
// ----------------------------------------------------
require_once('metaboxes/init.php');
