<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 6/2/2021
 * Time: 2:45 PM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

/**
 * Get instagram photos
 *
 * @param string $token - instagram token
 * @param integer $items - number of photos
 */
if ( ! function_exists( 'oew_get_instagram_photos' ) ) {
	function oew_get_instagram_photos( $token, $items = 9 ) {
		$instagram = array();

		if ( $token ) {
			$connect = wp_remote_get( 'https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,timestamp,permalink,caption&access_token=' . trim( $token ) );

			if ( is_wp_error( $connect ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'cct2-helper' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'cct2-helper' ) );
			}

			$result    = isset( $connect['body'] ) ? $connect['body'] : array();
			$instagram = array();

			$the_core_count = 0;

			if ( ! empty( $result ) ) {
				$arr = json_decode( $result );

				if ( ! empty( $arr ) ) {
					foreach ( $arr->data as $item ) {
						$instagram[] = array(
							'code'  => $item->id,
							'image' => $item->media_url,
							'url'   => $item->permalink,
							'alt'   => $item->caption,
						);

						$the_core_count ++;

						if ( $the_core_count == $items ) {
							break;
						}
					}
				}
			}
		}

		return $instagram;
	}
}

/**
 * Genaral Render Button elementor
 *
 * @param array $item_attr
 * @param array $custom_icon
 */
if ( ! function_exists( 'oew_render_button' ) ) {
	function oew_render_button( $item_attr, $custom_icon = array() ) {
		if ( empty( $item_attr ) ) {
			return;
		}

		$button_text          = oew_get_value_in_array( $item_attr, 'button_text' );
		$button_link          = oew_get_value_in_array( $item_attr, 'button_link' );
		$button_selected_icon = oew_get_value_in_array( $item_attr, 'button_selected_icon' );
		$button_icon_align    = oew_get_value_in_array( $item_attr, 'button_icon_align' );

		$button = array(
			$button_link['url'] !== '' ? 'href="' . $button_link['url'] . '"' : '',
			$button_link['is_external'] === 'on' ? 'target="_blank"' : '',
			$button_link['nofollow'] === 'on' ? 'rel="nofollow"' : '',
			$button_link['custom_attributes'] !== '' ? $button_link['custom_attributes'] : '',
		);

		$icon_position = $button_icon_align === 'right' ? ' oew-ord-last' : ' oew-ord-first';

		$output = array();

		if ( $button_text && $button_link['url'] !== '' ) {
			$output[] = '<div class="oew-default-btn">';
			$output[] = '<a ' . implode( ' ', array_filter( $button ) ) . ' role="button">';
			if ( ! empty( $button_selected_icon ) && $button_selected_icon['value'] !== '' ) {
				$output[] = '<span class="align-icon-' . esc_attr( $button_icon_align ) . $icon_position . '">';
				if ( 'svg' === $button_selected_icon['library'] ) {
					$output[] = \Elementor\Icons_Manager::render_uploaded_svg_icon( $button_selected_icon['value'] );
				} else {
					$output[] = \Elementor\Icons_Manager::render_font_icon( $button_selected_icon );
				}
				$output[] = '</span>';
			}
			if ( ! empty( $custom_icon ) ) {
				$output[] = '<span class="icon ' . $custom_icon['position'] . '">' . $custom_icon['icon'] . '</span>';
			}
			$output[] = '<span class="oew-button-text">' . esc_attr( $button_text ) . '</span>';
			$output[] = '</a>';
			$output[] = '</div>';
		}

		return implode( '', $output );
	}
}

/**
 * Genaral Render Icon elementor
 *
 * @param array $item_attr
 */
if ( ! function_exists( 'oew_render_icon' ) ) {
	function oew_render_icon( $item_attr ) {
		if ( empty( $item_attr ) ) {
			return;
		}

		$icon_type    = oew_get_value_in_array( $item_attr, 'icon_type' );
		$icon_default = oew_get_value_in_array( $item_attr, 'icon_default' );

		$output = array();

		if ( $icon_type === 'image' ) {
			$output[] = '<div class="icon icon-image">' . Group_Control_Image_Size::get_attachment_image_html( $item_attr, 'icon_image' ) . '</div>';
		} else {
			if ( $icon_default['value'] !== '' ) {
				$output[] = '<div class="icon">';
				if ( 'svg' === $icon_default['library'] ) {
					$output[] = \Elementor\Icons_Manager::render_uploaded_svg_icon( $icon_default['value'] );
				} else {
					$output[] = \Elementor\Icons_Manager::render_font_icon( $icon_default );
				}
				$output[] = '</div>';
			}
		}

		return implode( '', $output );
	}
}

/**
 * Genaral Render Slider Data Config elementor
 *
 * @param Object $oew
 * @param boolean $custom_arrow
 */
if ( ! function_exists( 'oew_render_data_slider' ) ) {
	function oew_render_data_slider( $oew, $custom_arrow = false ) {
		$settings = $oew->get_settings_for_display();

		$widget_ID               = $oew->get_id();
		$slides_to_show          = oew_get_value_in_array( $settings, 'slides_to_show' );
		$slides_to_show_tablet   = oew_get_value_in_array( $settings, 'slides_to_show_tablet' );
		$slides_to_show_mobile   = oew_get_value_in_array( $settings, 'slides_to_show_mobile' );
		$slides_to_scroll        = oew_get_value_in_array( $settings, 'slides_to_scroll' );
		$slides_to_scroll_tablet = oew_get_value_in_array( $settings, 'slides_to_scroll_tablet' );
		$slides_to_scroll_mobile = oew_get_value_in_array( $settings, 'slides_to_scroll_mobile' );
		$show_arrows             = oew_get_value_in_array( $settings, 'show_arrows' );
		$pagination              = oew_get_value_in_array( $settings, 'pagination' );
		$speed                   = oew_get_value_in_array( $settings, 'speed' );
		$autoplay                = oew_get_value_in_array( $settings, 'autoplay' );
		$autoplay_speed          = oew_get_value_in_array( $settings, 'autoplay_speed' );
		$loop                    = oew_get_value_in_array( $settings, 'loop' );

		$data_1024 = array(
			$slides_to_show_tablet ? '"slidesToShow": ' . $slides_to_show_tablet : '',
			$slides_to_scroll_tablet ? '"slidesToScroll": ' . $slides_to_scroll_tablet : '',
		);

		$data_767 = array(
			$slides_to_show_mobile ? '"slidesToShow": ' . $slides_to_show_mobile : '',
			$slides_to_scroll_mobile ? '"slidesToScroll": ' . $slides_to_scroll_mobile : '',
		);

		$breakpoint_1024 = ! empty( $data_1024 ) ? '{"breakpoint": 1024, "settings": {' . implode( ',', array_filter( $data_1024 ) ) . '}}' : '';
		$breakpoint_767  = ! empty( $data_767 ) ? '{"breakpoint": 767, "settings": {' . implode( ',', array_filter( $data_767 ) ) . '}}' : '';

		$responsive = array(
			$breakpoint_1024,
			$breakpoint_767
		);

		$data_slide = array(
			$slides_to_show ? '"slidesToShow": ' . $slides_to_show : '"slidesToShow": 4',
			$slides_to_scroll ? '"slidesToScroll": ' . $slides_to_scroll : '"slidesToScroll": 1',
			'"speed": ' . $speed,
			$loop === 'yes' ? '"infinite": true' : '',
			$autoplay === 'yes' ? '"autoplay": true' : '',
			$autoplay === 'yes' && $autoplay_speed !== '' ? '"autoplaySpeed": ' . $autoplay_speed : '',
			$show_arrows !== '' ? '"arrows": true' : '"arrows": false',
			$pagination === 'bullets' ? '"dots": true' : '',
			$custom_arrow ? '"prevArrow": ".oew-elementor-widget-' . $widget_ID . ' .oew-arrow-controls .slick-prev"' : '',
			$custom_arrow ? '"nextArrow": ".oew-elementor-widget-' . $widget_ID . ' .oew-arrow-controls .slick-next"' : '',
			! empty( $responsive ) ? '"responsive": [' . implode( ',', array_filter( $responsive ) ) . ']' : '',
		);

		return implode( ',', array_filter( $data_slide ) );
	}
}

/**
 * Genaral Render Heading Title Elementor
 *
 * @param array $item_attr
 */
if ( ! function_exists( 'oew_render_heading_title' ) ) {
	function oew_render_heading_title( $item_attr ) {
		$heading_tag     = oew_get_value_in_array( $item_attr, 'heading_tag' );
		$description_tag = oew_get_value_in_array( $item_attr, 'description_tag' );
		$heading         = oew_get_value_in_array( $item_attr, 'heading' );
		$description     = oew_get_value_in_array( $item_attr, 'description' );

		if ( $heading === '' ) {
			return;
		}

		$output = array();

		$output[] = '<div class="oew-section-title">';
		$output[] = '<' . $heading_tag . ' class="oew-heading-title"><span>' . $heading . '</span></' . $heading_tag . '>';
		if ( $description ) {
			$output[] = '<' . $description_tag . ' class="oew-description">' . $description . '</' . $description_tag . '>';
		}
		$output[] = '</div>';

		return implode( '', $output );
	}
}

/**
 * Genaral Render Control Slick Slider
 *
 * @param string $control
 * @param array $custom
 */
if ( ! function_exists( 'oew_render_slider_ui_control' ) ) {
	function oew_render_slider_ui_control( $control = array() ) {
		if ( empty( $control ) ) {
			return;
		}
		$output = array();

		switch ( $control['layout'] ) {
			case 'navigation':
				if ( $control['navigation'] === 'yes' || $control['navigation'] !== '' ) {
					$icon_prev = ! empty( $control['navi_icon_prev'] ) && $control['navi_icon_prev'] !== '' ? $control['navi_icon_prev'] : '<i class="fas fa-caret-left"></i>';
					$icon_next = ! empty( $control['navi_icon_next'] ) && $control['navi_icon_next'] !== '' ? $control['navi_icon_next'] : '<i class="fas fa-caret-right"></i>';

					$output[] = '<div class="oew-arrow-controls">';
					$output[] = '<div class="arrow-nav slick-prev"><span>' . $icon_prev . '</span></div>';
					$output[] = '<div class="arrow-nav slick-next"><span>' . $icon_next . '</span></div>';
					$output[] = '</div>';
				}
				break;
			case 'pagination':
				if ( $control['pagination'] === 'progressbar' ) {
					$output[] = '<div class="progress" role="progressbar"></div>';
				}
				break;
		}

		return implode( '', $output );
	}
}