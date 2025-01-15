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
class Exdos_Project_Tab extends Widget_Base {

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
		return 'exdos-project-tab';
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
		return __( 'Exdos Project Tab', 'exdos-core' );
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

		// Start Button Section
		$this->start_controls_section(
			'project_button',
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
			'project-tab_section',
			[
				'label' => esc_html__( 'Project List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'exdos-title',
			[
				'label' => esc_html__( 'List Item', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Branding Design' , 'textdomain' ),
				'label_block' => true,
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
			]
		);

		$this->add_control(
			'project_list',
			[
				'label' => esc_html__( 'Project List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'exdos-title' => esc_html__( 'Brand Design', 'textdomain' ),
					],
					[
						'exdos-title' => esc_html__( 'Digital Thinker', 'textdomain' ),
					],
				],
				'title_field' => '{{{ exdos-title }}}',
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

		if ( ! empty( $settings['exdos_button'] ) ) {	
			$this->add_link_attributes( 'button_arg', $settings['exdos_button_url'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-circle');
		}	

		?>


		<div class="tp-project-tab-area tp-nblue-bg pt-130 pb-130 pr-100" data-background="assets/img/bg/project-tab-bg.png">
            <div class="container-fluid p-0">
                <div class="row gx-0">
                    <div class="col-lg-6">
                        <div class="tp-project-tab-wraper">
                            <nav>
                                <div class="tp-project-tab" id="nav-tab" role="tablist">

								<?php foreach($settings['project_list'] as $key => $item) : 
									$active = ($key == 0) ? 'active' : '';
								?>
                                  <button class="nav-links <?php echo esc_attr($active); ?>" id="nav-home-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-home-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-home-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo esc_html($item['exdos-title']); ?></button>
								<?php endforeach; ?>
                                  
                                <!-- </div> -->
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="tp-project-tab-content pl-30 text-end mt-50">
                            <div class="tab-content" id="nav-tabContent">

								<?php foreach($settings['project_list'] as $key => $item) : 
									$active = ($key == 0) ? 'show active' : '';
								?>
                                <div class="tab-pane fade <?php echo esc_attr($key); ?>" id="nav-home-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-home-tab-<?php echo esc_attr($key); ?>" tabindex="0">
                                    <div class="tp-project-tab-thumb">
                                        <a class="popup-image" href="assets/img/project/project-tab-1.jpg"><img src="assets/img/project/project-tab-1.jpg" alt=""></a>
                                    </div>
                                </div>
								<!-- Strt mage -->
                                    <div class="tp-project-tab-thumb">
                                        <a class="popup-image" href="<?php echo esc_url($item['exdos_image']['url']); ?>"><img src="<?php echo esc_url($item['exdos_image']['url']); ?>" alt=""></a>
                                    </div>
								<!-- End Image -->
							<?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tp-project-tab-btn text-center mt-80 z-index-11 p-relative">
                    <a <?php echo $this->get_render_attribute_string('button_arg'); ?>><?php echo esc_html($settings['exdos_button']); ?></a>
                </div>
            </div>
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


$widgets_manager->register( new Exdos_Project_Tab() );
