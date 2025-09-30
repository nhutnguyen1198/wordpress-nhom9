<?php
/**
 * Customizer: Sanitization Callbacks
 *
 * This file demonstrates how to define sanitization callback functions for various data types.
 * 
 * @package   Gadget Store
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */

function gadget_store_sanitize_checkbox( $gadget_store_checked ) {
	return ( ( isset( $gadget_store_checked ) && true == $gadget_store_checked ) ? true : false );
}

/* Sanitization Text*/
function gadget_store_sanitize_text( $text ) {
	return wp_filter_post_kses( $text );
}

function gadget_store_sanitize_choices( $gadget_store_input, $gadget_store_setting ) {
    global $wp_customize; 
    $gadget_store_control = $wp_customize->get_control( $gadget_store_setting->id ); 
    if ( array_key_exists( $gadget_store_input, $gadget_store_control->choices ) ) {
        return $gadget_store_input;
    } else {
        return $gadget_store_setting->default;
    }
}

// Sanitization callback function for numeric input
function gadget_store_sanitize_numeric_input($gadget_store_input) {
    // Remove any non-numeric characters
    return preg_replace('/[^0-9]/', '', $gadget_store_input);
}

// Sanitization callback function for logo width
function gadget_store_sanitize_logo_width($gadget_store_input) {
    $gadget_store_input = absint($gadget_store_input); // Convert to integer
    // Ensure the value is between 1 and 150
    return ($gadget_store_input >= 1 && $gadget_store_input <= 300) ? $gadget_store_input : 150; // Default to 270 if out of range
}

function gadget_store_sanitize_copyright_position( $gadget_store_input ) {
    $gadget_store_valid = array( 'right', 'left', 'center' );

    if ( in_array( $gadget_store_input, $gadget_store_valid, true ) ) {
        return $gadget_store_input;
    } else {
        return 'right';
    }
}