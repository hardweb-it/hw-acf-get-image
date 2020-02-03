=== ACF Get Image ===
Contributors: giangel84
Tags: acf, field, image
Requires at least: 4.9
Tested up to: 5.3.2
Requires PHP: 7.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Get the image URL and ALT as array, regardless output format selected for the image field (Choose Array, URL or ID will be equals).
 
== Description ==
 
Annoying in select the proper output format for yours ACF custom image fields? 
With this plugin you can get the URL and the ALT image's property easily, regardless to the output format selected in ACF image field.
In any case (Array output, URL output, ID output), the new 'get_field_image' function will return an array with the image's attributes.

Usage `<?php $my_image = get_field_image($field, $size); ?>`

$field (string, name of the ACF field)
$size (string, name of the image size)

Return: Array('url'=>$url, 'alt'=>$alt);

== Example ==

`<?php $my_image = get_field_image('my_image', 'thumbnail'); ?>

<img src="<?php echo $my_image['url']; ?>" alt="<?php echo $my_image['alt']; ?>" />
`
 
== Installation ==
 
This section describes how to install the plugin and get it working.
 
e.g.
 
1. Upload `hw-acf-get-image` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Read the example to understand how it works.
 
== Changelog ==
 
= 1.0 =
* First stable and tested code.