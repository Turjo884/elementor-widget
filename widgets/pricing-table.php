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
		return 'exdos-pricing-table';
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

		//  Start Image Section
		$this->start_controls_section(
			'pricing_image_section',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pricing_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
		// End Image Section

		// Start Text Section
		$this->start_controls_section(
			'services_section_content',
			[
				'label' => __( 'Pricing Content', 'exdos-core' ),
			]
		);

		$this->add_control(
			'price_title',
			[
				'label' => __( 'Price', 'exdos-core' ),
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


		// start repeater control
		$this->start_controls_section(
			'prices_list_section',
			[
				'label' => esc_html__( 'Pricing List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'prices_list_name',
			[
				'label' => esc_html__( 'List Item', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Branding Design' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price_feature_list',
			[
				'label' => esc_html__( 'Pricing Feature List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'prices_list_name' => esc_html__( 'prices_list_name', 'textdomain' ),
					],
					[
						'prices_list_name' => esc_html__( 'Research & Testing', 'textdomain' ),
					],
				],
				'title_field' => '{{{ prices_list_name }}}',
			]
		);

		$this->end_controls_section();


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

		<!-- Start Pricing Box -->

		<section class="tp-pricing-area pt-120 pb-90">
            <div class="container">
                <!-- <div class="tp-section-title-wrapper mb-50 text-center">
                    <h2 class="tp-section-title mb-20">Price table</h2>
                    <p>Per ipsum ultrices sollicitudin iaculis platea facilisi semper aliquam up <br> senectus cursus vivamus volutpat penatibus</p>
                </div>
                <div class="row"> -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpprice mb-30 pt-60 pb-60 pl-50 pr-50 wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-bg-color="#FDF6F2" style="background-image: url('<?php echo esc_url($settings['bg_image']['url']); ?>');">
                            <div class="tpprice__icon">
                                <span><i class="flaticon-geometric-6"></i></span>

								<?php if(!empty($settings['exdos_image']['url'])) : ?>
                                <div class="tpprice__icon-shape">
                                    <img src="<?php echo esc_url($settings['exdos_image']['url']); ?>" alt="">
                                </div>
								<?php endif; ?>

                            </div>

							<?php if(!empty($settings['price_title'])) : ?>
                            <div class="tpprice__price">
                                <h4><?php echo exdos_core_kses($settings['price_title'])?></h4>
                            </div>
							<?php endif; ?>


							<?php if(!empty($settings['description'])) : ?>
                            <h3 class="tpprice__title"><?php echo exdos_core_kses($settings['description'])?></h3>
							<?php endif; ?>


                            <div class="tpprice__sep"></div>
                            <ul class="tpprice__features">

							<?php foreach($settings['price_feature_list'] as $item) : ?>
                                <li><i class="fal fa-check"></i> <span><?php echo esc_html($item['prices_list_name']); ?></span></li>
							<?php endforeach; ?>
                                
                            </ul>
                            <div class="tp-price-btn mt-50">
                                <a <?php echo $this->get_render_attribute_string('button_arg'); ?>>
                                    <span class="tp-btn-wrap">
                                        <span class="tp-btn-y-1"><?php echo esc_html($settings['exdos_button']); ?></span>
                                        <span class="tp-btn-y-2"><?php echo esc_html($settings['exdos_button']); ?></span>
                                    </span>  
                                    <i></i> 
                                </a>
								
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpprice mb-30 pt-60 pb-60 pl-50 pr-50 wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-bg-color="#FDF6F2" data-background="assets/img/price/price-bg.png">
                            <div class="tpprice__icon">
                                <span><i class="flaticon-geometric-7"></i></span>
                                <div class="tpprice__icon-shape">
                                    <img src="assets/img/price/shape-2.png" alt="">
                                </div>
                            </div>
                            <div class="tpprice__price">
                                <h4><span>$</span>150</h4>
                            </div>
                            
                            <h3 class="tpprice__title">App development</h3>
                            <div class="tpprice__sep"></div>
                            <ul class="tpprice__features">
                                <li><i class="fal fa-check"></i> <span> Full design support</span></li>
                                <li><i class="fal fa-check"></i> <span> Customizable registration</span></li>
                                <li><i class="fal fa-check"></i> <span> Guarantee Approval</span></li>
                                <li><i class="fal fa-check"></i> <span> Custom domain</span></li>
                                <li><i class="fal fa-check"></i> <span> Unlimited paid ticket</span></li>
                                <li><i class="fal fa-check"></i> <span>24/7 Client support </span></li>
                            </ul>
                            <div class="tp-price-btn mt-50">
                                <a href="contact.html" class="tp-btn-orange">
                                    <span class="tp-btn-wrap">
                                        <span class="tp-btn-y-1">Choose a Plan</span>
                                        <span class="tp-btn-y-2">Choose a Plan</span>
                                    </span>  
                                    <i></i> 
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpprice mb-30 pt-60 pb-60 pl-50 pr-50  wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-bg-color="#FDF6F2" data-background="assets/img/price/price-bg.png">
                            <div class="tpprice__icon">
                                <span><i class="flaticon-geometric-8"></i></span>
                                <div class="tpprice__icon-shape">
                                    <img src="assets/img/price/shape-3.png" alt="">
                                </div>
                            </div>
                            <div class="tpprice__price">
                                <h4><span>$</span>180</h4>
                            </div>
                            
                            <h3 class="tpprice__title">Digital marketing</h3>
                            <div class="tpprice__sep"></div>
                            <ul class="tpprice__features">
                                <li><i class="fal fa-check"></i> <span> Full design support</span></li>
                                <li><i class="fal fa-check"></i> <span> Customizable registration</span></li>
                                <li><i class="fal fa-check"></i> <span> Guarantee Approval</span></li>
                                <li><i class="fal fa-check"></i> <span> Custom domain</span></li>
                                <li><i class="fal fa-check"></i> <span> Unlimited paid ticket</span></li>
                                <li><i class="fal fa-check"></i> <span>24/7 Client support </span></li>
                            </ul>
                            <div class="tp-price-btn mt-50">
                                <a href="contact.html" class="tp-btn-orange">
                                    <span class="tp-btn-wrap">
                                        <span class="tp-btn-y-1">Choose a Plan</span>
                                        <span class="tp-btn-y-2">Choose a Plan</span>
                                    </span>  
                                    <i></i> 
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

		<!-- End Pricing Box -->




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
