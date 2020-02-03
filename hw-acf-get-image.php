<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://hardweb.it/
 * @since             1.0
 * @package           hw-acf-get-image
 *
 * @wordpress-plugin
 * Plugin Name:       ACF Get Image
 * Description:       Get the image URL and ALT as array, regardless output format selected for the image field (Choose Array, URL or ID will be equals. Require ACF version 4.0.0 or above). Use get_field_image($field, $size); Read documentation for more info.
 * Version:           1.0
 * Author:            Hardweb.it
 * Author URI:        https://hardweb.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hw-acf-get-image
 * Domain Path:       /languages
 */
 
 // If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Get the image field, rebuild it as array, it return 2 keys ('url' and 'alt') with the values.
 * @param  string $field		field_slug
 * @param  string $size (optional)	image-size-slug
 * @return array			url and alt keys with the values
 */

# GET ACF IMAGES
function get_field_image($field, $size=false) {
	$array_immagine = array('url'=>'', 'alt'=>'');
	
	if (function_exists('get_field')) {
		$immagine = get_field($field);
	} else {
		return array('url'=>'Install and activate ACF Plugin first!', 'alt'=>'Install and activate ACF Plugin first!');
	}
	
	/* fast order
	1: array
	2: id
	3: url
	*/
	
	//if ACF return an array
	if (is_array($immagine)) {
		
		if ($size) { //size è specificato
			$array_immagine['url'] = (!empty($immagine['sizes'][$size])) ? $immagine['sizes'][$size] : $immagine['url'];
		} else { //size non è specificato
			$array_immagine['url'] = $immagine['url'];
		}
		$array_immagine['alt'] = $immagine['alt'];
		
	//if ACF return the ID
	} elseif (is_numeric($immagine)) {
		
		if ($size) { //size è specificato
			$url_immagine_size = wp_get_attachment_image_src($immagine, $size);
			$url_immagine_full = wp_get_attachment_image_src($immagine, 'full');
			$array_immagine['url'] = (!empty($url_immagine_size[0])) ? $url_immagine_size[0] : $url_immagine_full[0];
		} else { //size non è specificato
			$url_immagine_full = wp_get_attachment_image_src($immagine, 'full');
			$array_immagine['url'] = $url_immagine_full[0];
		}
		$array_immagine['alt'] = get_post_meta($immagine, '_wp_attachment_image_alt', true);	
		
	//if ACF return the URL string
	} else {
		
    global $wpdb;
    $query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $immagine ) ) );
    $image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;
		
		$array_immagine['url'] = $immagine;
		$array_immagine['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	}
	
	return $array_immagine;
}
?>
