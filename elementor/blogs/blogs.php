<?php

use Elementor\Utils;

class Oew_Widget_Blogs extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_blogs';
	}

	public function get_title() {
		return esc_html__( 'Blogs', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-archive-posts oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-script', 'oew-blogs' ];
	}

	public function get_style_depends() {
		return [ 'oew-line-awesome', 'oew-blogs' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'        => esc_html__( 'Layout', 'ocanus-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => [
					'default' => 'Default',
					'list'    => 'List',
				],
				'prefix_class' => 'oew-blog-layout-',
			]
		);

		$this->add_control(
			'enable_meta_date',
			[
				'label'     => esc_html__( 'Enable Meta Date', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => '',
				'condition' => [
					'layout' => 'default',
				],
			]
		);

		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => true,
			'description' => true,
		], false );

		oew_elementor_option_button_content( $this, [
			'indent_position' => '',
			'divider'         => true,
			'align'           => true,
			'icon'            => false,
		], false );

		$this->end_controls_section();
	}

	protected function add_layout_query_controls() {
		$this->start_controls_section(
			'section_query_content',
			[
				'label' => esc_html__( 'Query', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'query_order_by',
			[
				'label'   => esc_html__( 'Order By', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID'            => esc_html__( 'Post ID', 'ocanus-elementor-widgets' ),
					'author'        => esc_html__( 'Author', 'ocanus-elementor-widgets' ),
					'title'         => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
					'date'          => esc_html__( 'Date', 'ocanus-elementor-widgets' ),
					'rand'          => esc_html__( 'Random Order', 'ocanus-elementor-widgets' ),
					'comment_count' => esc_html__( 'Comment Count', 'ocanus-elementor-widgets' )
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				],
				'default' => 'desc',
			]
		);

		$this->add_control( 'query_item_count', [
			'label'   => __( 'Post per page', 'ocanus-elementor-widgets' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'default' => 4,
			'min'     => 2,
			'max'     => 50,
			'step'    => 1,
		] );

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 2,
			'column'         => true,
			'arrows_skin'    => false,
			'progress'       => false
		] );
	}

	protected function add_style_heading_controls() {
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => true,
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'button_heading',
			'label'    => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.inner-column-content .oew-default-btn a'
		], false, true );

		$this->end_controls_section();
	}

	protected function add_style_content_default_controls() {
		$this->start_controls_section(
			'section_style_content_default',
			[
				'label'     => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'default',
				],
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title_default',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.item-content .item-title a'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'meta_default',
			'label'    => esc_html__( 'Meta', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.item-content .item-meta'

		], false );

		$this->add_control(
			'color_meta_other_default',
			[
				'label'     => esc_html__( 'Meta Other Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-content .item-meta span' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'content_overlay_heading',
			[
				'label' => 'Content Overlay',
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'tabs_layout_default_style' );

		$this->start_controls_tab(
			'tab_layout_default_normal',
			[
				'label' => esc_html__( 'Normal', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'background_color_content_overlay',
			[
				'label'     => esc_html__( 'Content Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item .item-content' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'color_read_more_detail',
			[
				'label'     => esc_html__( 'Action Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item .item-action-more a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_layout_default_hover',
			[
				'label' => esc_html__( 'Hover', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'background_color_content_overlay_hover',
			[
				'label'     => esc_html__( 'Content Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item:hover .item-content' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'color_content_overlay_hover',
			[
				'label'     => esc_html__( 'Content Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item:hover .inner-content *' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'color_read_more_hover',
			[
				'label'     => esc_html__( 'Action Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item:hover .item-action-more a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function add_style_content_list_controls() {
		$this->start_controls_section(
			'section_style_content_list',
			[
				'label'     => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'list',
				],
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title-list',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.item-content .item-title a'
		], false, true );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'meta-list',
			'label'    => esc_html__( 'Meta', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.item-content .item-meta'

		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'author-list',
			'label'    => esc_html__( 'Author', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.item-content .item-meta a'

		], false, true );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'description-list',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.item-content .item-desc'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'action-list',
			'label'    => esc_html__( 'Action', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.item-content .item-action-more a'
		], false, true );

		$this->end_controls_section();
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => true,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_query_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_content_default_controls();
		$this->add_style_content_list_controls();
		$this->add_style_slider_controls();
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$layout           = oew_get_value_in_array( $settings, 'layout' );
		$enable_meta_date = oew_get_value_in_array( $settings, 'enable_meta_date' );

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this ) . "}'";

		$html  = array();
		$count = 0;
		$arpg  = array(
			'posts_per_page'      => $settings['query_item_count'],
			'order'               => $settings['order'],
			'orderby'             => $settings['query_order_by'],
			'ignore_sticky_posts' => 1,
		);

		$blog_query = new WP_Query( $arpg );

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-widget-blogs',
		);

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = $layout == 'list' ? oew_render_heading_title( $settings ) : '';

		$html[] = '<div class="oew-row">';

		if ( $layout == 'default' ) {
			$html[] = '<div class="column-left oew-col-12 oew-col-md-6 oew-col-xl-4"><div class="inner-column-content">';
			$html[] = oew_render_heading_title( $settings );
			$html[] = oew_render_button( $settings, [
				'position' => 'right',
				'icon'     => '<i class="las la-arrow-right"></i>'
			] );
			$html[] = '</div></div>';

			$html[] = '<div class="column-right oew-slick-style oew-col-12 oew-col-md-6">';
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
		}

		if ( $blog_query->have_posts() ) :
			while ( $blog_query->have_posts() ) :
				$blog_query->the_post();
				$count ++;
				global $post;
				$reverse = ( $count % 2 == 1 ) ? ' reverse' : '';

				switch ( $layout ) {
					case 'default':
						$html[] = $this->render_layout_default( $post, $enable_meta_date );
						break;
					case 'list':
						$html[] = $this->render_layout_list( $post, $reverse );
						break;
				}
			endwhile;
		endif;
		wp_reset_postdata();

		if ( $layout == 'default' ) {
			$html[] = '</div>'; //== [ End Slider ]
			$html[] = '</div>'; //== [ End Column Right ]
		}

		$html[] = '</div>'; //== [ End Row ]

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function render_layout_default( $post, $enable_meta_date ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$thumb_url = get_the_post_thumbnail_url( $post->ID );
			$thumb_url = oew_image_resize( $thumb_url, 480, 600 );
		} else {
			$thumb_url = oew_image_resize( Utils::get_placeholder_image_src(), 480, 600 );
		}

		$default_html = '<div class="item">';

		$default_html .= '<div class="item-image"><a href="' . get_the_permalink( $post->ID ) . '">';
		$default_html .= '<img src="' . $thumb_url . '" />';
		$default_html .= '</a></div>';

		$default_html .= '<div class="item-content">';
		$default_html .= '<div class="inner-content">';
		$default_html .= '<h4 class="item-title"><a href="' . get_the_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></h4>';
		$default_html .= '<div class="item-meta">';
		$default_html .= '<span>' . esc_html__( 'by ', 'ocanus-elementor-widgets' ) . '</span>' . get_the_author();
		$default_html .= $enable_meta_date ? '<span>' . esc_html__( ' on ', 'ocanus-elementor-widgets' ) . '</span>' . get_the_date( '', $post->ID ) : '';
		$default_html .= '</div>';
		$default_html .= '</div>';
		$default_html .= '<div class="item-action-more"><a href="' . get_the_permalink( $post->ID ) . '"><i class="las la-long-arrow-alt-right"></i></a></div>';
		$default_html .= '</div>';

		$default_html .= '</div>';

		return $default_html;
	}

	protected function render_layout_list( $post, $reverse ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$thumb_url = get_the_post_thumbnail_url( $post->ID );
			$thumb_url = oew_image_resize( $thumb_url, 264, 221 );
		} else {
			$thumb_url = oew_image_resize( Utils::get_placeholder_image_src(), 264, 221 );
		}

		$grid_html = '<div class="column oew-col-12 oew-col-md-6">';
		$grid_html .= '<div class="item' . $reverse . '">';

		$grid_html .= '<div class="item-image"><a href="' . get_the_permalink( $post->ID ) . '">';
		$grid_html .= '<img src="' . $thumb_url . '" />';
		$grid_html .= '</a></div>';

		$grid_html .= '<div class="item-content">';
		$grid_html .= '<h4 class="item-title"><a href="' . get_the_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></h4>';
		$grid_html .= '<div class="item-meta">';
		$grid_html .= esc_html__( 'By ', 'ocanus-elementor-widgets' ) . get_the_author_posts_link() . get_the_date( '', $post->ID );
		$grid_html .= '</div>';
		$grid_html .= '<div class="item-desc">' . get_the_excerpt( $post->ID ) . '</div>';
		$grid_html .= '<div class="item-action-more"><a href="' . get_the_permalink( $post->ID ) . '">' . esc_html__( 'READ MORE', 'ocanus-elementor-widgets' ) . '<i class="las la-long-arrow-alt-right"></i></a></div>';
		$grid_html .= '</div>';

		$grid_html .= '</div>';
		$grid_html .= '</div>';

		return $grid_html;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Blogs() );


