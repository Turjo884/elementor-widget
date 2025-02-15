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
class Exdos_Fact extends Widget_Base {

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
		return 'exdos-fact';
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
		return __( 'Fact', 'exdos-core' );
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
		$this->style_tab_content();
	}

	// register_controls_section
	protected function register_controls_section() {

		$this->start_controls_section(
			'fact_section',
			[
				'label' => esc_html__( 'Fact List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'select_icon_type',
			[
				'label' => __( 'Choose Icon Type', 'exdos-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __( 'Icon', 'exdos-core' ),
					'image' => __( 'Image', 'exdos-core' ),
				],
			]
		);
		
		$repeater->add_control(
			'exdos_icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
			         'select_icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'exdos_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
			       'select_icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'fact_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Project completed' , 'textdomain' ),
				'label_block' => true,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'fact_number',
			[
				'label' => esc_html__( 'Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '78' , 'textdomain' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'fact_list',
			[
				'label' => esc_html__( 'Fact List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fact_title' => esc_html__( 'Project completed', 'textdomain' ),

					],
					[
						'fact_title' => esc_html__( 'Project completed', 'textdomain' ),
					],
				],
				'title_field' => '{{{ fact_title }}}',
			]
		);

		$this->end_controls_section();


	}

	// style_tab_content 
	protected function style_tab_content() {
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

		<!-- Start Fact Section -->
		<div class="tp-fact-area tp-nblue-bg pt-100 pb-70">
            <div class="container">
                <div class="custom-row">

				<?php foreach($settings['fact_list'] as $item ) : ?>
                    <div class="cols">
                        <div class="tpfact text-center text-lg-start mb-40">
                            <div class="tpfact__icon">
								<?php if($item['select_icon_type'] == 'image') : ?>
                                <span><img src="<?php echo esc_url($item['exdos_image']['url']); ?>" alt=""></span>
								<?php else : ?>

									<span><?php \Elementor\Icons_Manager::render_icon($item['exdos_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>

								<?php endif; ?>	
                            </div>
                            <div class="tpfact__text">
                                <h4 class="tpfact__title mb-30"><?php echo esc_html($item['fact_title']); ?></h4>
                                <span><?php echo esc_html($item['fact_number']); ?></span>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>


                </div>
            </div>
        </div>
		<!-- End Fact Section  -->


		<?php 



	}

}


$widgets_manager->register( new Exdos_Fact() );