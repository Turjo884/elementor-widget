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
class Exdos_Team extends Widget_Base {

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
		return 'exdos-team';
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
		return __( 'Exdos Team', 'exdos-core' );
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

		// start title section
		$this->start_controls_section(
			'heading_section',
			[
				'label' => __( 'Title And Content', 'exdos-core' ),
			]
		);

		$this->add_control(
			'team_title',
			[
				'label' => __( 'Main Title', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Main Tittle Here', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// end title section


		// start testimonial section
		$this->start_controls_section(
			'team_section',
			[
				'label' => esc_html__( 'Team List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();


        //start testimonial name section 
		$repeater->add_control(
			'team_name',
			[
				'label' => esc_html__( 'Name', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Cynthia A. Keely' , 'textdomain' ),
				'label_block' => true,
			]
		);
        //end testimonial name section 

        //start testimonial bio section 
		$repeater->add_control(
			'team_bio',
			[
				'label' => esc_html__( 'URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( ' CEO of lollipop' , 'textdomain' ),
				'label_block' => true,
			]
		);
        //end testimonial bio section 

		// start team image section
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
		// end team image section

		// start team url section
		$repeater->add_control(
			'team_url',
			[
				'label' => esc_html__( 'Team URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
			]
		);

		// end team url section


		//start testimonial social media section 
		$repeater->add_control(
			'team_fb',
			[
				'label' => esc_html__( 'Facebook URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_tw',
			[
				'label' => esc_html__( 'Twitter URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_in',
			[
				'label' => esc_html__( 'LinkedIn URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
			]
		);
		//end testimonial social media section 

        //start testimonial list section 
		$this->add_control(
			'team_list',
			[
				'label' => esc_html__( 'Team List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'team_name' => esc_html__( 'Cynthia A. Keely', 'textdomain' ),
					],
					[
						'team_name' => esc_html__( 'John Doe', 'textdomain' ),
					],
				],
				'title_field' => '{{{ team_name }}}',
			]
		);
        //end testimonial list section 

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
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-sec tp-btn-sec-lg');
		}	

		?>



		<div class="tp-team-area pl-100 pr-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="tp-section-title-wrapper mb-50">

							<?php if(!empty($settings['team_title'])) : ?>
                            <h2 class="tp-section-title mb-20"><?php echo exdos_core_kses($settings['team_title'])?></h2>
							<?php endif; ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tp-team-nav text-end d-flex justify-content-start justify-content-md-end align-items-center">
                            <div class="tp-swiper-team-button-prev tp-swiper-team-button tp-rot-180"><i class="flaticon-right-arrow"></i></div>
                            <span></span>
                            <div class="tp-swiper-team-button-next tp-swiper-team-button"><i class="flaticon-right-arrow"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="swiper tp-team-active">
                    <div class="swiper-wrapper">

					<?php foreach($settings['team_list'] as $item) : ?>
                      <div class="swiper-slide">
                            <div class="tpteam">
                                <div class="tpteam__thumb br-15">
                                    <a href="<?php echo esc_url($item['team_url']); ?>"><img src="<?php echo esc_url($item['exdos_image']['url']); ?>" alt=""></a>
                                </div>
                                <div class="tpteam__info mt-30 ml-80">
                                    <h3 class="tpteam__title"><a href="<?php echo esc_url($item['team_url']); ?>"><?php echo esc_html($item['team_name']); ?></a></h3>
                                    <span class="ml-45"><i></i><?php echo esc_html($item['team_bio']); ?></span>
                                    <div class="tpteam__social mt-20">

									<!-- Start facebook link -->
									<?php if(!empty($item['team_fb'])) : ?>
                                        <a href="<?php echo esc_url($item['team_fb']); ?>"><i class="fab fa-facebook-f"></i></a>
									<?php endif; ?>
									<!-- End facebook lin -->

									<!-- Start twitter link -->
									<?php if(!empty($item['team_tw'])) : ?>
                                        <a href="<?php echo esc_url($item['team_tw']); ?>"><i class="fab fa-twitter"></i></a>
									<?php endif; ?>
									<!-- End twitter link -->

									<!-- Start linkedin link -->
									<?php if(!empty($item['team_in'])) : ?>
                                        <a href="<?php echo esc_url($item['team_in']); ?>"><i class="fab fa-linkedin-in"></i></a>
									<?php endif; ?>
									<!-- End linkein link -->

                                    </div>
                                </div>
                            </div>
                      </div>
					<?php endforeach; ?>

                    </div>
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


$widgets_manager->register( new Exdos_Team() );
