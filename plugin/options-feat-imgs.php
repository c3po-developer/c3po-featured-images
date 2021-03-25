<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5. -> https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 *
 */

add_action( 'cmb2_admin_init', 'create_c3po_featured_images_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */

function cmb2_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => 10,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}

/**
 * Gets 5 posts for your_post_type and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function c3po_get_post_types_options() {
    
	$ignore_posts_types = array(
		"revision",
    	"nav_menu_item",
    	"custom_css",
    	"customize_changeset",
    	"oembed_cache",
    	"user_request",
    	"wp_block",
    	"polylang_mo"
	);
	$post_options = array();
	foreach ( get_post_types() as $key => $post_type ) {
		if( ! in_array( $key , $ignore_posts_types) ){
			$post_options[ $key ] = $post_type;
		}		
	}
	return $post_options;
}

function create_c3po_featured_images_options_metabox() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'c3po_featured_images_option_metabox',
		'title'        => 'Imágenes destacadas',
		'object_types' => array( 'options-page' ),
		'option_key'      => 'c3po_featured_images_options', // The option key and admin menu page slug.
		'parent_slug'     => 'c3po_core_options', // Make options page a submenu item of the themes menu.
	) );

	$cmb_options->add_field( array(
		'name'       => 'Tipos de post que deben usar imágenes destacadas',
		'id'         => 'c3po_featured_images_available_post_types',
		'type'       => 'multicheck',
		'options_cb' => 'c3po_get_post_types_options',
	) );

}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function c3po_featured_images_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'c3po_featured_images_options', $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'c3po_featured_images_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}