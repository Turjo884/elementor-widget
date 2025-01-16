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
class Exdos_Brand extends Widget_Base {

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
		return 'exdos-brand';
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
		return __( 'Exdos Brand', 'exdos-core' );
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

		// start repeater control

		// Start Brand Slider 1
		$this->start_controls_section(
			'design_section',
			[
				'label' => esc_html__( 'Design Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// End Brand Slider 1

		// Start Control Part
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'' => esc_html__( 'Default', 'textdomain' ),
					'style-1' => esc_html__( 'Layout 01', 'textdomain' ),
					'style-2'  => esc_html__( 'Layout 02', 'textdomain' ),
				],
			]
		);
		// End Control Part
		$this->end_controls_section();


		$this->start_controls_section(
			'brand_section',
			[
				'label' => esc_html__( 'Brand Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'exdos_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'brand_list',
			[
				'label' => esc_html__( 'Brand List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
		// end repeater control

		
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

		<?php if($settings['layout'] == 'style-2') : ?>

		<!-- Start Brand Style 2 -->
		<div class="tp-brand-area tp-blue-bg pt-40 pb-40">
			<div class="tp-brand-wrapper">
				<div dir="rtl" class="swiper tp-brand-bottom-active">
					<div class="swiper-wrapper tp-slide-transtion">

					<?php foreach($settings['brand_list'] as $key => $item) : ?>
					<div class="swiper-slide tp-brand-slide-element">
						<div class="tp-brand-img">
							<img src="<?php echo esc_url($item['exdos_image']['url']); ?>" alt="">
						</div>
					</div>
					<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
		<!-- End Brand Style 2 -->

		<?php else : ?>

		<!-- Start Brand Stye 1 -->
		<div class="tp-brand-area tp-yellow-bg pt-40 pb-40">
            <div class="tp-brand-wrapper">
                <div class="swiper tp-brand-top-active">
                    <div class="swiper-wrapper tp-slide-transtion">
					
					<?php foreach($settings['brand_list'] as $key => $item) : ?>
                    <div class="swiper-slide tp-brand-slide-element">
                        <div class="tp-brand-img">
                            <img src="<?php echo esc_url($item['exdos_image']['url']); ?>" alt="">
                        </div>
                    </div>

					  <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
		<!-- End Brand Style 1 -->
        <?php endif; ?>

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


$widgets_manager->register( new Exdos_Brand() );
