<?php

function CF_fan_showroom_operator_images() {
	$prefix_mi = 'c3po_multi_image_';
	
	$cmb_box_mi = new_cmb2_box( 
		array(
			'id'            => $prefix_mi . 'metabox',
			'title'         => esc_html__( 'Imagen destacada C3PO', 'cmb2' ),
			'object_types'  => c3po_featured_images_get_option( 'c3po_featured_images_available_post_types' ),
			'context'       => 'side',
			'priority'      => 'low'
		) 
	);

	$cmb_box_mi->add_field( 
		array( 
			'name'       => esc_html__( 'DESKTOP', 'cmb2' ), 
			'id'         => $prefix_mi . 'desktop_image',
			'type'       => 'file',
			'options' => array(
				'url' => false
			),
			'text'    => array(
				'add_upload_file_text' => 'Establecer imagen destacada'  
			),
			'preview_size' => 'default'
		) 
	);

	$cmb_box_mi->add_field( 
		array( 
			'name'       => esc_html__( 'MOBILE', 'cmb2' ), 
			'id'         => $prefix_mi . 'mobile_image',
			'type'       => 'file',
			'options' => array(
				'url' => false
			),
			'text'    => array(
				'add_upload_file_text' => 'Establecer imagen destacada'  
			),
			'preview_size' => 'small'
		) 
	);
}
add_action( 'cmb2_admin_init', 'CF_fan_showroom_operator_images' );

