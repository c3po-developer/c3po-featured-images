<?php

/**
 * Plugin Name:     Imágenes destacadas
 * Description:     Gestión de imágenes destacadas para Posts, páginas y CPT.
 * Plugin URI:  	https://github.com/c3po-developer/c3po-featured-images
 * Author:      	USA LA FUERZA
 * Author URI:  	https://usalafuerza.com/
 */

// Config file
// DEFINIMOS RUTAS
define( 'C3PO_FEATURED_IMAGES_PATH', plugin_dir_path( __FILE__ ) );
define( 'C3PO_FEATURED_IMAGES_URL', plugin_dir_url( __FILE__ ) );


if( function_exists('c3po_core_required_notice') ){
	function c3po_core_required_notice() {
		echo '<div class="error notice"><p>El plugin precisa del C3PO CORE para su correcto funcionamiento.</p></div>';
	}
}

// Comprobamos que el CORE esté instalado
if( !in_array('c3po-core/index.php', apply_filters('active_plugins', get_option('active_plugins') ) ) ){
	add_action( 'admin_notices', 'c3po_core_required_notice' );
}else{
	// Comprobamos que CMB2 esté instalado (Via CORE). No bloqueamos el plugin, solo avisamos en ADMIN.
	add_action( 'init', 'check_cmb2_is_installed', 10 );
	// Cargamos archivos del plugin
	require dirname( __FILE__ ) . '/plugin/options-feat-imgs.php';
	require dirname( __FILE__ ) . '/plugin/cf-feat-imgs.php';

}
    
