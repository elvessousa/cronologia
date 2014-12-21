<?php
/*-----------------------------------------------------------------------

	Type name: catalog
	Make sure you know what you're doing before altering this code.

------------------------------------------------------------------------*/
if ( !function_exists('ess_create_timeline') ) {

	add_action('init', 'ess_create_timeline');

	function ess_create_timeline() {
		$timeline_labels = array(
			'name' => __('Timeline Events', 'ess-customposts'),
			'singular_name' => __('Timeline Event', 'ess-customposts'),
			'menu_name' => __('Timeline Events', 'ess-customposts'),
			'add_new' => __('Add Timeline Event', 'ess-customposts'),
			'add_new_item' => __('Add New Timeline Event', 'ess-customposts'),
			'edit' => __('Edit', 'ess-customposts'),
			'edit_item' => __('Edit Timeline Event', 'ess-customposts'),
			'new_item' => __('New Timeline Event', 'ess-customposts'),
			'view' => __('View Timelines', 'ess-customposts'),
			'view_item' > __('View Timelines', 'ess-customposts'),
			'search_items' > __('Search Timelines', 'ess-customposts'),
			'not_found' => __('No Timelines Found', 'ess-customposts'),
			'not_found_in_trash' => __('No Timelines Found in Trash', 'ess-customposts'),
			'parent' => __('Parent Timelines', 'ess-customposts'),
		);

		$timeline_args = array(
			'labels' => $timeline_labels,
			'singular_label' => __('Timeline', 'ess-customposts'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'exclude_from_search' => true, 
			'supports' => array('title', 'thumbnail')
		);
		register_post_type('timeline',$timeline_args);
	}

	// ----------------------------------------------------	
	// Categories
	// ----------------------------------------------------
	function ess_timeline_taxonomies() {

		register_taxonomy( 'timelines', array('timeline'), 
			array(	
				'hierarchical' => true,
				'label' => __('Timelines', 'ess-customposts'), 
				'singular_label' => __('Timeline', 'ess-customposts'), 
				'rewrite' => true));

		flush_rewrite_rules();

	}
	add_action( 'init', 'ess_timeline_taxonomies', 0 ); 

	// ----------------------------------------------------	
	// Timeline [admin]
	// ----------------------------------------------------
	add_filter('manage_edit-timeline_columns', 'ess_timeline_edit_columns');
	add_action('manage_timeline_posts_custom_column',  'ess_timeline_columns_display');

	function ess_timeline_edit_columns($catalog_columns){
		$catalog_columns = array(
			'cb' => '<input type="checkbox" />',
			'icon' => '',
			'title' => __('Title', 'ess-customposts'),
			'author' => __('Author', 'ess-customposts'),
			'timelines' => __('Timelines', 'ess-customposts'),
			'date' => __('Date', 'ess-customposts'),
		);
		return $catalog_columns;
	}

	// ----------------------------------------------------
	// Columns [admin]
	// ----------------------------------------------------
	function ess_timeline_columns_display($timeline_columns){
		global $post;
		switch ($timeline_columns) {
			case 'icon':
				echo '<span class="big"><i class="icon-history tb-icon"></i></span>';
				break;
			case 'timelines':
				echo get_the_term_list($post->ID, 'timelines', '<li style="list-style: none; margin: 0">', '</li><li style="list-style: none; margin: 0">','</li>');
				break;
		}
	}

	// ----------------------------------------------------
	// Filter events list
	// ----------------------------------------------------
	function ess_restrict_events_by_timeline() {
		global $typenow;
		$post_type = 'timeline'; 
		$taxonomy = 'timelines'; 
		if ($typenow == $post_type) {
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Timelines", "ess-customposts"),
				'taxonomy' => $taxonomy,
				'name' => $taxonomy,
				'orderby' => 'name',
				'selected' => $selected,
				'show_count' => true,
				'hide_empty' => true,
			));
		};
	}

	add_action('restrict_manage_posts', 'ess_restrict_events_by_timeline');

	function ess_convert_timelineid_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'timeline';
		$taxonomy = 'timelines';
		$q_vars = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

	add_filter('parse_query', 'ess_convert_timelineid_to_term_in_query');

	// ----------------------------------------------------
	// Post class
	// ----------------------------------------------------
	function ess_add_timeline_class( $class ) {
		if ( ! is_tax() )
			return $class;
		$tax   = get_query_var( 'taxonomy' );
		$term  = $tax . '-' . get_query_var( 'term' );
		$class = array_merge( $class, array( 'taxonomy-archive', $tax, $term ) );
		return $class;
	}
	add_filter( 'post_class', 'ess_add_timeline_class' );

	// ----------------------------------------------------
	// Timeline fields
	// ----------------------------------------------------
	function ess_get_timeline_fields($id) {

		if (empty($id)) { $id = get_the_ID(); }
		
		$prefix_timeline = '_ess-timeline_';

		// Item data
		$timeline['caption'] = get_post_meta($id, $prefix_timeline . 'caption', true);
		$timeline['credit'] = get_post_meta($id, $prefix_timeline . 'credit', true);
		$timeline['date'] = get_post_meta($id, $prefix_timeline . 'date', true);
		$timeline['enddate'] = get_post_meta($id, $prefix_timeline . 'enddate', true);
		$timeline['media'] = get_post_meta($id, $prefix_timeline . 'media', true);
		$timeline['text'] = get_post_meta($id, $prefix_timeline . 'text', true);

		return $timeline;
	}
}
?>