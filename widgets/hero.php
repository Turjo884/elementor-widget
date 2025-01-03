<?php
namespace Exdos_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Exdos Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Exdos_Hero extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'exdos-hero';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Exdos Hero', 'exdos-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'exdos-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'exdos-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	 protected function register_controls() {

		$this->register_controls_section();
		$this->style_tab_controls();

	 }


	//  register controls section
	protected function register_controls_section() {
		$this->start_controls_section(
			'hero_section_content',
			[
				'label' => __( 'Demo Content', 'exdos-core' ),
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => __( 'Main Title', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Main Tittle One', 'textdomain' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'main_title_2',
			[
				'label' => __( 'Main Title 2', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Main Title Two' ),
				'label_block' => true,
			]
		);

	
		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);



		$this->end_controls_section();

		
	}

	// style tab controls section
	protected function style_tab_controls() {

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'exdos-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'exdos-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'exdos-core' ),
					'uppercase' => __( 'UPPERCASE', 'exdos-core' ),
					'lowercase' => __( 'lowercase', 'exdos-core' ),
					'capitalize' => __( 'Capitalize', 'exdos-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>


			<section class="tp-hero-area tp-hero-space tp-black-bg pt-265 pb-170 p-relative " style="background-image: url(assets/img/shape/hero-1-bg-shape.png);">
						<div class="tp-hero-shape">
							<img class="tp-hero-shape-1 p-absolute" src="assets/img/shape/hero-1-ball-shape.png" alt="">
							<img class="tp-hero-shape-2 p-absolute d-none d-xl-block" src="assets/img/shape/hero-1-large-shape.png" alt="">
							<img class="tp-hero-shape-3 p-absolute" src="assets/img/shape/hero-sm-circle.png" alt="">
							<img class="tp-hero-shape-4 p-absolute d-none d-md-block" src="assets/img/shape/hero-1-shape-2.png" alt="">
							<img class="tp-hero-shape-5 p-absolute d-none d-md-block" src="assets/img/shape/hero-1-circle-3.png" alt="">
						</div>
						<div class="hero-info d-none d-xxl-flex">
							<div class="hero-social">
								<span>Follow Us - </span>
								<a href="#">Fb</a>/
								<a href="#">Tw</a>/
								<a href="#">in</a>/
								<a href="#">Be</a>
							</div>
							<div class="hero-info-text">
								<span>2k+ company trust us</span>
							</div>
						</div>
						<div class="container">
							<div class="tp-hero p-relative z-index-11">
								<div class="mb-30">

									<?php if(!empty($settings['main_title'])) : ?>
									<h1 class="tp-hero-title wow img-custom-anim-left" data-wow-duration="1.5s" data-wow-delay="0.1s"><?php echo exdos_core_kses($settings['main_title'])?></h1>
									<?php endif; ?>

									<h1 class="tp-hero-title wow img-custom-anim-right" data-wow-duration="1.5s" data-wow-delay="0.4s"><?php echo exdos_core_kses($settings['main_title_2'])?></h1>
								</div>
								<div class="tp-hero-btn wow img-custom-anim-top" data-wow-duration="1.5s" data-wow-delay="0.9s">
									<a href="about.html" class="tp-btn-sec tp-btn-sec-lg" >
										<span class="tp-btn-wrap">
											<span class="tp-btn-y-1">Discover More</span>
											<span class="tp-btn-y-2">Discover More</span>
										</span>  
										<i></i>
									</a>
								</div>
							</div>
						</div>
			</section>

		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}
}


$widgets_manager->register( new Exdos_Hero() );
