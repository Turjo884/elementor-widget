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
class Exdos_Service_Box extends Widget_Base {

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
		return 'exdos-services-box';
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
		return __( 'Exdos Services Box', 'exdos-core' );
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
			'services_section_content',
			[
				'label' => __( 'Services Content', 'exdos-core' ),
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
			'description',
			[
				'label' => __( 'Content', 'exdos-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Perfs ipsum ultrices sollicitudin iaculis platea facilisi', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// End Text Section


		// Start Icon Section 
		$this->start_controls_section(
			'services_icon_section',
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
		// Start Image Section 

		// Start Button Section
		$this->start_controls_section(
			'hero_button_content',
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
			'services_list_section',
			[
				'label' => esc_html__( 'Services List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'services_list_name',
			[
				'label' => esc_html__( 'List Item', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Branding Design' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'services_list',
			[
				'label' => esc_html__( 'Services List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'services_list_name' => esc_html__( 'services_list_name', 'textdomain' ),
					],
					[
						'services_list_name' => esc_html__( 'Research & Testing', 'textdomain' ),
					],
				],
				'title_field' => '{{{ services_list_name }}}',
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
			$this->add_render_attribute('button_arg', 'class', 'tp-sv-btn br-5');
		}	

		?>


			<div class="tpservices br-24 mb-30  wow tpFadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
					<div class="tpservices__icon mb-25">
						<span><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
					</div>

					<?php if(!empty($settings['main_title'])) : ?>
					<div class="tpservices__text ">

						<h3 class="tpservices__title mb-15">
						<?php if(!empty($settings['exdos_button_url']['url'])) : ?>

							<a href="<?php echo esc_url($settings['exdos_button_url']['url'])?>"><?php echo exdos_core_kses($settings['main_title'])?></a>
							<?php else : ?>

							<?php echo exdos_core_kses($settings['main_title'])?>
							<?php endif; ?>

						</h3>
					<?php endif; ?>

					<?php if(!empty($settings['description'])) : ?>
						<p><?php echo exdos_core_kses($settings['description'])?></p>
					<?php endif; ?>

						<div class="tpservices__list">
							<ul>
							<?php foreach($settings['services_list'] as $item) : ?>
								<li><?php echo esc_html($item['services_list_name']); ?></li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>

					<?php if(!empty($settings['exdos_button'])) : ?>
					<div class="tpservices__btn mt-30">
						<a <?php echo $this->get_render_attribute_string('button_arg'); ?>><?php echo esc_html($settings['exdos_button']); ?><i class="far fa-arrow-right"></i></a>
					</div>
					<?php endif; ?>

				</div>

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


$widgets_manager->register( new Exdos_Service_Box() );
