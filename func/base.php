<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 6/2/2021
 * Time: 2:45 PM
 */

/**
 * Get config from library
 */
if (! function_exists('oew_get_option')) {
	function oew_get_option($option_name = '', $default = '', $name = OEW_OPTIONS) {
		$options = get_option($name);

		if (! empty($option_name) && ! empty($options[ $option_name ])) {
			return $options[ $option_name ];
		} else {
			return (! empty($default)) ? $default : null;
		}

	}
}

/**
 * Get array value.
 */
if (! function_exists('oew_get_value_in_array')) {
	function oew_get_value_in_array($array, $key, $default = false) {
		return isset($array[ $key ]) ? $array[ $key ] : $default;
	}
}