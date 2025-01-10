<?php
namespace Exdos_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Exdos_Testimonial extends Widget_Base {

    public function get_name() {
        return 'exdos-testimonial';
    }

    public function get_title() {
        return __( 'Exdos Testimonial', 'exdos-core' );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'exdos-category' ];
    }

    public function get_script_depends() {
        return [ 'exdos-core' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'testimonial_section',
            [
                'label' => esc_html__( 'Testimonial Slider', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_name',
            [
                'label'       => esc_html__( 'Name', 'textdomain' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Cynthia A. Keely', 'textdomain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_text',
            [
                'label'       => esc_html__( 'Content', 'textdomain' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Sample testimonial text.', 'textdomain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_bio',
            [
                'label'       => esc_html__( 'Designation/Role', 'textdomain' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'CEO of Company', 'textdomain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_list',
            [
                'label'       => esc_html__( 'Testimonials', 'textdomain' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [ 'testimonial_name' => 'Cynthia A. Keely' ],
                    [ 'testimonial_name' => 'John Doe' ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_image_section',
            [
                'label' => esc_html__( 'Images', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image 1', 'textdomain' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->add_control(
            'image_2',
            [
                'label'   => esc_html__( 'Image 2', 'textdomain' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="tp-testimonial-area">
            <div class="container">
                <div class="tp-testimonial-wrapper text-center">
                    <div class="tp-testimonial-shape-thumb-1">
                        <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="Image 1">
                    </div>
                    <div class="tp-testimonial-shape-thumb-2">
                        <img src="<?php echo esc_url( $settings['image_2']['url'] ); ?>" alt="Image 2">
                    </div>
                    <div class="swiper tp-testimonial-active">
                        <div class="swiper-wrapper">
                            <?php foreach ( $settings['testimonial_list'] as $item ) : ?>
                                <div class="swiper-slide">
                                    <div class="tp-testimonial-item">
                                        <p class="tp-testimonial-desc"><?php echo esc_html( $item['testimonial_text'] ); ?></p>
                                        <div class="tp-testimonial-author">
                                            <h4><?php echo esc_html( $item['testimonial_name'] ); ?></h4>
                                            <span><?php echo esc_html( $item['testimonial_bio'] ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

$widgets_manager->register( new \Exdos_Core_Help\Widgets\Exdos_Testimonial() );
