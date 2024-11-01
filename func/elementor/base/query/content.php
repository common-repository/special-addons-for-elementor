<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 01/09/2021
 * Time: 12:28 SA
 */

if ( ! function_exists( 'oew_elementor_option_query_content' ) ) {
	function oew_elementor_option_query_content( $oew, $params, $enable_section = true ) {
		$filter_check   = ! empty( $params['filter_value'] ) && ! empty( $params['filter_default'] ) ? true : false;
		$order_by_check = ! empty( $params['order_by_value'] ) && ! empty( $params['order_by_default'] ) ? true : false;
//		$item_show      = ! empty( $params['per_page_default'] ) ? true : false;

		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_query_content',
				[
					'label' => __( 'Query', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		if ( $filter_check ) {
			$oew->add_control( 'query_filter_by', [
				'label'   => esc_html__( 'Filter By', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => $params['filter_default'],
				'options' => $params['filter_value']
			] );
		}

		if ( $order_by_check ) {
			$oew->add_control( 'query_order_by', [
				'label'   => esc_html__( 'Order By', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => $params['order_by_default'],
				'options' => $params['order_by_value']
			] );
		}

		if ( $params['order'] ) {
			$oew->add_control( 'order', [
				'label'   => __( 'Order', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				],
				'default' => 'desc',
			] );
		}

		$oew->add_control( 'query_item_count', [
			'label'   => __( 'Post per page', 'ocanus-elementor-widgets' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'default' => $params['per_page_default'] !== '' ? (int) $params['per_page_default'] : 4,
			'min'     => 1,
			'max'     => 100,
			'step'    => 1,
		] );

		$taxonomies = get_taxonomies( [ 'object_type' => [ 'product' ] ], 'objects' );
		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) ) {
				continue;
			}
			$multiple = true;
			if ( ! empty( $params['multiple'] ) && $taxonomy === 'product_cat' ) {
				$multiple = $params['multiple'];
			}

			$oew->add_control(
				$taxonomy . '_ids',
				[
					'label'       => $object->label,
					'type'        => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => $multiple,
					'object_type' => $taxonomy,
					'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
				]
			);
		}

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}