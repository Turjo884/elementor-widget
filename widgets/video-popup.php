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
class Exdos_Video_Popup extends Widget_Base {

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
		return 'exdos-video';
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
		return __( 'Exdos Video', 'exdos-core' );
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
		
		$this->end_controls_section();
        // End Control Part


		$this->start_controls_section(
			'video_section',
			[
				'label' => __( 'Video', 'exdos-core' ),
			]
		);

		$this->add_control(
			'exdos_title',
			[
				'label' => __( 'Main Title', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Main Tittle', 'textdomain' ),
				'label_block' => true,
			]
		);
	
		$this->add_control(
			'exdos_video_url',
			[
				'label' => esc_html__( 'Video URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();


		// Hero Sectio Background Image 
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
			       'layout' => 'style-2',
		],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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

		<!-- For Video Slider Start -->
		<?php if($settings['layout'] == 'style-2') : ?>

			<div class="tp-video-area jarallax" style="background-image: url('<?php echo esc_url($settings['image']['url']); ?>');">
				<div class="tp-play-btn text-center">
					<a class="popup-video" href="<?php echo esc_url($settings['exdos_video_url']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/play.png" alt=""></a>
				</div>
           </div>

		
		<!-- For Video Slider End -->
		<?php else : ?>

		<?php if(!empty($settings['exdos_video_url'])) : ?>
			<div class="tp-about-video-info d-flex align-items-center mb-27">
				<div class="tp-about-video-icon mr-15">
					<a class="popup-video" href="<?php echo esc_url($settings['exdos_video_url']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/play.svg" alt=""></a>
				</div>

				<?php if(!empty($settings['exdos_title'])) : ?>
				<h4 class="m-0"><?php echo exdos_core_kses($settings['exdos_title'])?></h4>
				<?php endif; ?>
			</div>
		<?php endif; ?>

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


$widgets_manager->register( new Exdos_Video_Popup() );
