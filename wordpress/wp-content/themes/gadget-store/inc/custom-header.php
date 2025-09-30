<?php
register_default_headers( array(
	'default-image' => array(
		'url'           => get_template_directory_uri() . '/assets/custom-header.png',
		'thumbnail_url' => get_template_directory_uri() . '/assets/custom-header.png',
		'description'   => __( 'Default Header Image', 'gadget-store' ),
	),
) );