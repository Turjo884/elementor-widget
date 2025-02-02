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
class Exdos_Faq extends Widget_Base {

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
		return 'exdos-faq';
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
		return __( 'Exdos Faq', 'exdos-core' );
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
		
		// Start Code copy from heading.php file

		$this->start_controls_section(
			'heading_section',
			[
				'label' => __( 'Title And Content', 'exdos-core' ),
			]
		);

		$this->add_control(
			'exdos_sub_title',
			[
				'label' => __( 'Sub Title', 'exdos-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Tittle', 'textdomain' ),
				'label_block' => true,
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
			'exdos_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);

		$this->end_controls_section();

		// End Code copy for heading.php file

		// start testimonial section
		$this->start_controls_section(
			'faq_section',
			[
				'label' => esc_html__( 'Faq List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();


        //start faq title section 
		$repeater->add_control(
			'faq_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Here' , 'textdomain' ),
				'label_block' => true,
			]
		);
        //end faq title section

        //start faq text section 
		$repeater->add_control(
			'faq_text',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Per ipsum ultrices sollicitudin iaculis platea facilisi semper aliquam up' , 'textdomain' ),
				'label_block' => true,
			]
		);
        //end faq text section 

        //start testimonial list section 
		$this->add_control(
			'faq_list',
			[
				'label' => esc_html__( 'Social Repeater List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faq_title' => esc_html__( 'How do you collaborate with developers?', 'textdomain' ),
					],
					[
						'faq_title' => esc_html__( 'How do you collaborate with developers?', 'textdomain' ),
					],
				],
				'title_field' => '{{{ faq_title }}}',
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


		// Hero Sectio Background Image 
		$this->start_controls_section(
			'faq_image_section',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		<!-- Start Faq Section -->

		<div class="tp-faq-area mt-130 mb-130 p-relative">
            <div class="tpfaq-bg tpfaq-bg-right wow img-custom-anim-right" data-wow-duration="1.5s" data-wow-delay="0.2s" style="background-image: url('<?php echo esc_url($settings['image']['url']); ?>');"
			></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tpfaq-wrapper">
                            <div class="tp-section-title-wrapper mb-40">
                                <span class="tp-section-subtitle mb-10"><i></i> <?php echo exdos_core_kses($settings['exdos_sub_title'])?></span>
                                <h2 class="tp-section-title tp-upper mb-20"><?php echo exdos_core_kses($settings['exdos_title'])?></h2>
                                <p><?php echo exdos_core_kses($settings['exdos_content'])?></p>
                            </div>
                            <div class="accordion" id="accordionExample">

							<?php foreach($settings['faq_list'] as $key => $item) : 
								
								$button_Class = ($key == 0) ? '' : 'collapsed';
								$show = ($key == 0) ? 'show' : '';

								?>

                                <div class="tp-accordion-item mb-20">
                                  <h2 class="accordion-header">
                                    <button class="tp-accordion-button <?php echo esc_attr($button_Class);?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($key);?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($key);?>">
									<?php echo esc_html($item['faq_title']); ?>
                                        <span><i class="far fa-arrow-down"></i></span>
                                    </button>
                                  </h2>
                                  <div id="collapseOne-<?php echo esc_attr($key);?>" class="tp-accordion-collapse collapse <?php echo esc_attr($show);?>" data-bs-parent="#accordionExample">
                                    <div class="tp-accordion-body">
                                      <p><?php echo esc_html($item['faq_text']); ?></p>
                                    </div>
                                  </div>
                                </div>
								<?php endforeach; ?>
                                <!-- <div class="tp-accordion-item mb-20">
                                  <h2 class="tp-accordion-header">
                                    <button class="tp-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How do we start working together?
                                        <span><i class="far fa-arrow-down"></i></span>
                                    </button>
                                  </h2>
                                  <div id="collapseTwo" class="tp-accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="tp-accordion-body">
                                        <p>Leo site ultrices donec a volutpat penatibus mind suscipit faucibus and duis pharetra bed name socios phasellus nunce accumsan lectus morbi ridiculus. He beginning it bee won't they are shall life</p>
                                      </div>
                                  </div>
                                </div>

                                <div class="tp-accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="tp-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What are your cancellation policies?
                                        <span><i class="far fa-arrow-down"></i></span>
                                    </button>
                                  </h2>
                                  <div id="collapseThree" class="tp-accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="tp-accordion-body">
                                        <p>Leo site ultrices donec a volutpat penatibus mind suscipit faucibus and duis pharetra bed name socios phasellus nunce accumsan lectus morbi ridiculus. He beginning it bee won't they are shall life</p>
                                    </div>
                                  </div>
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 		<!-- End Faq Section -->

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


$widgets_manager->register( new Exdos_Faq() );
