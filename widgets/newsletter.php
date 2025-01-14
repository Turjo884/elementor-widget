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
class Exdos_Newsletter extends Widget_Base {

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
		return 'exdos-newsletter';
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
		return __( 'Exdos Newsletter', 'exdos-core' );
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
			'newsletter_section',
			[
				'label' => __( 'Newsletter Content', 'exdos-core' ),
			]
		);

		$this->add_control(
			'exdos_title',
			[
				'label' => __( 'Title', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tittle Here', 'textdomain' ),
				'label_block' => true,
			]
		);
	
		$this->add_control(
			'exdos_shorcode',
			[
				'label' => esc_html__( 'Enter Your Form Shortcode', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'placeholder' => esc_html__( 'Enter your shortcode here', 'textdomain' ),
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

		<!-- Start Newsletter Markup -->
		<section class="tp-newsletter-area p-relative z-index-11 wow tpFadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
            <div class="container">
                <div class="tp-newsletter-bg tp-blue-bg">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="tp-section-title-wrapper">

							<?php if(!empty($settings['exdos_title'])) : ?>
                                <h2 class="tp-section-title tp-section-title-white m-0"><?php echo exdos_core_kses($settings['exdos_title'])?></h2>
							<?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="tp-newsletter-box p-relative">

							<?php if(!empty($settings['exdos_title'])) : ?>
                                <h2 class="tp-newsletter-back d-none d-md-block"><?php echo exdos_core_kses($settings['exdos_title'])?></h2>
							<?php endif; ?>


							<?php if(!empty($settings['exdos_shorcode'])) : ?>
							<?php echo do_shortcode($settings['exdos_shorcode']); ?>
							<?php endif; ?>

                                <form action="#">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- End Newsletter Markup -->

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


$widgets_manager->register( new Exdos_Newsletter() );
