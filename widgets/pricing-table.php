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
class Exdos_Pricing_Table extends Widget_Base {

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
		return 'exdos-prcing-table';
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
		return __( 'Exdos Pricing Table', 'exdos-core' );
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
		// Start Text Section
		$this->start_controls_section(
			'pricing_section_content',
			[
				'label' => __( 'Price Content', 'exdos-core' ),
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
			'price-sign',
			[
				'label' => __( 'Price Sign', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '$', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '120', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// End Text Section


		// Start Icon Section 
		$this->start_controls_section(
			'price_icon_section',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();
		// End Section 

		// Start Button Section
		$this->start_controls_section(
			'price_button_section',
			[
				'label' => __( 'Button', 'exdos-core' ),
			]
		);

		$this->add_control(
			'exdos_button',
			[
				'label' => __( 'Button Text', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is button text' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'exdos_button_url',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// End Button Section


		// start repeater control
		$this->start_controls_section(
			'price_list_section',
			[
				'label' => esc_html__( 'Features List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_name',
			[
				'label' => esc_html__( 'List Item', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Branding Design' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'features_list',
			[
				'label' => esc_html__( 'Feature List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_name' => esc_html__( 'Full design support', 'textdomain' ),
					],
					[
						'list_name' => esc_html__( 'Customizable registration', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_name }}}',
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

		if ( ! empty( $settings['exdos_button'] ) ) {	
			$this->add_link_attributes( 'button_arg', $settings['exdos_button_url'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-orange');
		}	

		?>


        <!-- Start Pricing Table -->
		<div class="tpprice mb-30 pt-60 pb-60 pl-50 pr-50 wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-bg-color="#FDF6F2" data-background="assets/img/price/price-bg.png">
			<div class="tpprice__icon">
				<span><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<div class="tpprice__icon-shape">
					<img src="<?php echo get_template_directory_uri();?>/assets/img/price/shape-1.png" alt="">
				</div>
			</div>
			<div class="tpprice__price">
				<h4><span><?php echo exdos_core_kses($settings['price-sign'])?></span><?php echo exdos_core_kses($settings['price'])?></h4>
			</div>
			
			<h3 class="tpprice__title"><?php echo exdos_core_kses($settings['main_title']); ?></h3>
			<div class="tpprice__sep"></div>
			
			<ul class="tpprice__features">
			<?php foreach($settings['features_list'] as $item) : ?>
				<li><i class="fal fa-check"></i> <span><?php echo esc_html($item['list_name']); ?></span></li>
			<?php endforeach; ?>
			</ul>

			<?php if(!empty($settings['exdos_button'])) : ?>
			<div class="tp-price-btn mt-50">
				<a <?php echo $this->get_render_attribute_string('button_arg'); ?>>
					<span class="tp-btn-wrap">
						<span class="tp-btn-y-1"><?php echo esc_html($settings['exdos_button']); ?></span>
						<span class="tp-btn-y-2"><?php echo esc_html($settings['exdos_button']); ?></span>
					</span>  
					<i></i> 
				</a>
			</div>
			<?php endif; ?>
		</div>
		<!-- End Pricing Table -->


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


$widgets_manager->register( new Exdos_Pricing_Table() );
