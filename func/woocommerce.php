<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 03/09/2021
 * Time: 9:22 CH
 */

use Elementor\Utils;

if ( ! function_exists( 'oew_product_query_control' ) ) {
	function oew_product_query_control( $oew, $enable_multiple = true ) {
		$settings             = $oew->get_settings_for_display();
		$product_category     = oew_get_value_in_array( $settings, 'product_category' );
		$order_by             = oew_get_value_in_array( $settings, 'query_order_by' );
		$filter_by            = oew_get_value_in_array( $settings, 'query_filter_by' );
		$query_order          = oew_get_value_in_array( $settings, 'query_order' );
		$query_number_product = oew_get_value_in_array( $settings, 'query_number_product' );

		$args = [
			'post_type'      => 'product',
			'post_status'    => array( 'publish' ),
			'posts_per_page' => $query_number_product,
			'order'          => $query_order,
			'tax_query'      => [
				'relation' => 'AND',
				[
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => [ 'exclude-from-search', 'exclude-from-catalog' ],
					'operator' => 'NOT IN',
				],
			],
			'meta_query'     => [
				'relation' => 'AND'
			],
		];

		if ( $product_category ) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $product_category,
					'operator' => 'IN',
				]
			];
		}

		if ( get_option( 'woocommerce_hide_out_of_stock_items' ) == 'yes' ) {
			$args['meta_query'][] = [
				'key'   => '_stock_status',
				'value' => 'instock'
			];
		}

		switch ( $order_by ) {
			case '_price':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_price';
				break;
			case '_sku':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_sku';
				break;
			default:
				$args['orderby'] = ( ! empty( $order_by ) ? $order_by : 'date' );
				break;
		}

		switch ( $filter_by ) {
			case 'featured':
				$count                       = isset( $args['tax_query'] ) ? count( $args['tax_query'] ) : 0;
				$args['tax_query'][ $count ] = [
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				];
				break;
			case 'best_sell':
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;
			case 'sale':
				$count                        = isset( $args['meta_query'] ) ? count( $args['meta_query'] ) : 0;
				$args['meta_query'][ $count ] = [
					'relation' => 'OR',
					[
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					],
					[
						'key'     => '_min_variation_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					],
				];
				$args['post__in']             = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
				break;
			case 'hight_rate':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_wc_average_rating';
				break;
		}

		if ( $enable_multiple ) {
			$taxonomies      = get_taxonomies( [ 'object_type' => [ 'product' ] ], 'objects' );
			$tax_query_count = isset( $args['meta_query'] ) ? count( $args['meta_query'] ) : 0;

			foreach ( $taxonomies as $taxonomy ) {
				$setting_key = $taxonomy->name . '_ids';
				if ( ! empty( $settings[ $setting_key ] ) ) {
					$args['tax_query'][ $tax_query_count ] = [
						'taxonomy' => $taxonomy->name,
						'field'    => 'term_id',
						'terms'    => $settings[ $setting_key ],
					];
				}
				$tax_query_count ++;
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'oew_action_add_to_cart' ) ) {
	function oew_action_add_to_cart( $args = array(), $icon = '' ) {
		global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}

			return apply_filters(
				'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
				sprintf(
					'<a href="%s" data-quantity="%s" class="%s" %s>' . $icon . '<span>%s</span></a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
					esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
					isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
					esc_html( $product->add_to_cart_text() )
				),
				$product,
				$args
			);
		}
	}
}

if ( ! function_exists( 'oew_render_ui_component_product' ) ) {
	function oew_render_ui_component_product( $component = '', $data = array() ) {
		if ( $component === '' ) {
			return;
		}
		global $post, $product;
		global $_wp_additional_image_sizes;

		//== [ Check Product New ]
		$postdate  = get_the_time( 'Y-m-d', $post->ID );
		$timestamp = strtotime( $postdate );
		$is_new    = ( time() - $timestamp < 60 * 60 * 24 * 3 );

		$product_id    = $product->get_id();
		$product_name  = get_the_title( $product_id );
		$product_url   = get_permalink( $product_id );
		$product_label = array(
			$is_new ? '<span class="oew-product-label new">' . esc_html__( 'new', 'ocanus-elementor-widgets' ) . '</span>' : '',
			$product->is_on_sale() ? '<span class="oew-product-label sale">' . esc_html__( 'sale', 'ocanus-elementor-widgets' ) . '</span>' : '',
			$product->is_featured() ? '<span class="oew-product-label hot">' . esc_html__( 'hot', 'ocanus-elementor-widgets' ) . '</span>' : ''
		);

		$output = array();

		switch ( $component ) {
			case 'image':
				$attach_id      = get_post_thumbnail_id( $product_id );
				$attachment_ids = $product->get_gallery_image_ids();
				$hover_id       = ( ! empty( $attachment_ids ) ) ? $attachment_ids[0] : '';

				$thumb_url       = wp_get_attachment_image_src( $attach_id, $data['image_size'] );
				$thumb_hover_url = wp_get_attachment_image_src( $hover_id, $data['image_size'] );

				$image_class = array(
					'oew-image-thumb',
					! empty( $hover_id ) ? 'oew-has-hover' : ''
				);

				$output[] = '<a class="' . implode( ' ', array_filter( $image_class ) ) . '" href="' . esc_url( $product_url ) . '" title="' . esc_attr( $product_name ) . '">';
				if ( ! empty( $attach_id ) ) {
					$output[] = '<span class="featured-thumbnail">';
					$output[] = '<img src="' . esc_url( $thumb_url[0] ) . '" alt="' . esc_attr( $product_name ) . '" width="' . esc_attr( $thumb_url[1] ) . '" height="' . esc_attr( $thumb_url[2] ) . '"/>';
					$output[] = '</span>';
					if ( ! empty( $hover_id && $data['image_hover'] ) ) {
						$output[] = '<span class="hover-image">';
						$output[] = '<img src="' . esc_url( $thumb_hover_url[0] ) . '" alt="' . esc_attr( $product_name ) . '" width="' . esc_attr( $thumb_hover_url[1] ) . '" height="' . esc_attr( $thumb_hover_url[2] ) . '"/>';
						$output[] = '</span>';
					}
				} else {
					$output[] = '<img src="' . esc_url( Utils::get_placeholder_image_src() ) . '" alt="' . esc_attr( $product_name ) . '"/>';
				}
				$output[] = implode( '', array_filter( $product_label ) ); //== [ Product Label ]
				$output[] = '</a>';
				break;
			case 'title':
				$output[] = '<' . $data['tag'] . ' class="oew-product-title">';
				$output[] = '<a href="' . esc_url( $product_url ) . '" title="' . esc_attr( $product_name ) . '">' . esc_html( $product_name ) . '</a>';
				$output[] = '</' . $data['tag'] . '>';
				break;
			case 'category':
				$terms = get_the_terms( $product_id, 'product_cat' );
				if ( is_wp_error( $terms ) ) {
					return $terms;
				}
				$links = array();
				if ( ! empty( $terms ) ) {
					$output[] = '<div class="oew-product-categories">';
					foreach ( $terms as $term ) {
						$link = get_term_link( $term, 'product_cat' );
						if ( is_wp_error( $link ) ) {
							return $link;
						}
						$links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
					}
					$output[] = '</div>';
				}
				break;
			case 'price':
				$output[] = '<div class="oew-product-price">' . $product->get_price_html() . '</div>';
				break;
			case 'rating':
				$output[] = '<div class="oew-product-rating">' . wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) . '</div>';
				break;
			case 'author':
				$output[] = '<div class="oew-product-author">';
				if ( class_exists( 'WCVendors_Pro' ) ) {
					$label     = get_option( 'wcvendors_label_sold_by' );
					$label     = ( $label != '' ) ? $label : esc_html__( 'by: ', 'martel' );
					$separator = get_option( 'wcvendors_label_sold_by_separator' );

					$vendor_id   = get_post_field( 'post_author', $post->ID );
					$shop_link   = WCV_Vendors::get_vendor_shop_page( $vendor_id );
					$vendor_meta = array_map(
						function ( $a ) {
							return $a[0];
						},
						get_user_meta( $vendor_id )
					);
					$shop_name   = oew_get_value_in_array( $vendor_meta, 'pv_shop_name' );
					$first_name  = oew_get_value_in_array( $vendor_meta, 'first_name' );
					$last_name   = oew_get_value_in_array( $vendor_meta, 'last_name' );
					if ( $label !== '' ) {
						$output[] = '<span>' . esc_attr( $label ) . $separator . '</span>';
					}
					if ( ! empty( $shop_name ) ) {
						$output[] = '<a href="' . esc_url( $shop_link ) . '">' . esc_attr( $shop_name ) . '</a>';
					} else {
						$output[] = '<a href="' . esc_url( $shop_link ) . '">' . esc_attr( $first_name . ' ' . $last_name ) . '</a>';
					}
				} else {
					$output[] = '<span>' . esc_html__( 'by:', 'ocanus-elementor-widgets' ) . '</span>' . get_the_author_posts_link();
				}
				$output[] = '</div>';
				break;
			case 'wishlist':
				if ( function_exists( 'yith_wishlist_constructor' ) ) {
					$output[] = '<div class="oew-action-wishlist">';
					$output[] = do_shortcode( '[yith_wcwl_add_to_wishlist]' );
//					$output[] = '<span class="nav-txt"><i class="la la-plus"></i>' . esc_html__( 'Wishlist', 'ocanus-elementor-widgets' ) . '</span>';
					$output[] = '</div>';
				}
				break;
			case 'compare':
				if ( function_exists( 'yith_woocompare_constructor' ) ) {
					$output[] = '<div class="oew-action-compare">';
					$output[] = do_shortcode( '[yith_compare_button container="false"]' );
					$output[] = '<span class="nav-txt"><i class="la la-plus"></i>' . esc_html__( 'Compare', 'ocanus-elementor-widgets' ) . '</span>';
					$output[] = '</div>';
				}
				break;
			case 'addtocart':
				$output[] = '<div class="oew-action-addtocart">' . oew_action_add_to_cart( array(), $data['icon'] ) . '</div>';
				break;
			case 'quickview':
				$output[] = '<div class="oew-action-quickview">';
				$output[] = '<a href="javascript:void(0);" class="btn-quickview" data-id="' . esc_attr( $product_id ) . '">';
				$output[] = $data['icon'];
//					$output[] = '<span class="nav-txt"><i class="la la-plus"></i>' . esc_html__( 'Quickview', 'martel' ) . '</span>';
				$output[] = '</a>';
				$output[] = '</div>';
				break;
		}

		return implode( '', $output );
	}
}

if ( ! function_exists( 'oew_quick_view_start_actions' ) ) {
	function oew_quick_view_start_actions() {
		echo '<div class="oew-quick-view-actions">';
	}
}

if ( ! function_exists( 'oew_quick_view_end_actions' ) ) {
	function oew_quick_view_end_actions() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oew_render_modal_quick_view' ) ) {
	function oew_render_modal_quick_view() {
		global $product;
		$product_id = absint( $_POST['product_id'] );
		$product    = wc_get_product( $product_id );

		if ( ! $product_id ) {
			echo json_encode( - 99 );
			exit;
		}

		$data_slide       = array(
			'"slidesToShow": 1',
			'"slidesToScroll": 1',
			'"infinite": true',
			'"arrows": false',
			'"dots": true',
			'"fade": true',
		);
		$slide_attributes = "data-slick='{" . implode( ',', $data_slide ) . "}'";

		$product_id       = $product->get_id();
		$attachment_ids   = $product->get_gallery_image_ids();
		$image_id         = get_post_thumbnail_id( $product_id );
		$image_name       = get_the_title( $product_id );
		$image_url        = wp_get_attachment_image_src( $image_id, 'full' );
		$image_resize_url = oew_image_resize( $image_url[0], 560, 560 );
		$excerpt          = apply_filters( 'the_excerpt', $product->post->post_excerpt );
		?>
        <div id="oew-product-<?php echo esc_attr($product_id); ?>" class="oew-product-quick-view-popup">
            <div class="oew-quick-view-background"></div>
            <div class="oew-quick-view-content">
                <div class="oew-quick-view-images">
                    <div class="oew-inner-images" <?php echo wp_kses($slide_attributes, ['a' => [], 'p' => []]); ?>>
                        <div class="oew-item-image">
                            <img src="<?php echo esc_url( $image_resize_url ); ?>" alt="<?php echo esc_html( $image_name ); ?>">
                        </div>
						<?php if ( $attachment_ids ) {
							foreach ( $attachment_ids as $attachment_id ) {
								$thumb_name       = get_the_title( $attachment_id );
								$thumb_url        = wp_get_attachment_image_src( $attachment_id, 'full' );
								$thumb_resize_url = oew_image_resize( $thumb_url[0], 560, 560 );

								echo '<div class="oew-item-image"><img src="' . esc_url( $thumb_resize_url ) . '" alt="' . esc_html( $thumb_name ) . '"></div>';
							}
						} ?>
                    </div>
                </div>
                <div class="oew-quick-view-summary">
                    <div class="oew-quick-view-close"><i class="la la-close"></i></div>
                    <div class="oew-summary oew-entry-summary">
                        <h2 class="oew-product-title">
                            <?php echo get_the_title( $product_id ); ?>
                        </h2>
                        <div class="oew-summary-price-rating">
							<?php woocommerce_template_single_price(); ?>
							<?php woocommerce_template_single_rating(); ?>
                        </div>
						<?php if ( $excerpt !== '' ) {
							echo '<div class="oew-quick-view-short-description">' . esc_attr($excerpt) . '</div>';
						} ?>
						<?php
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
						add_action( 'woocommerce_single_product_summary', 'oew_quick_view_start_actions', 29 );
						add_action( 'woocommerce_single_product_summary', 'oew_quick_view_end_actions', 35 );
						do_action( 'woocommerce_single_product_summary' );
						?>
                    </div>
                </div>
            </div>
        </div>
		<?php
		$data = ob_get_clean();
		wp_reset_postdata();
		wp_send_json_success( $data );
	}
}