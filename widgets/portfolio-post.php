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
class Exdos_Portfolio_Post extends Widget_Base {

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
		return 'exdos-portfolio-post';
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
		return __( 'Exdos Portfolio Post', 'exdos-core' );
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
		$this->start_controls_section(
			'post_section',
			[
				'label' => __( 'Portfolio Post', 'exdos-core' ),
			]
		);

		$this->add_control(
			'post_per_page',
				[
					'label' => esc_html__( 'Post Number', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 3,
				]
			);


		// Start category Control
		$this->add_control(
			'cat_include',
			[
				'label' => esc_html__( 'Category Including', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => tp_post_cat('portfolio-cat'),
			]
		);
		// End catgory Control


		// Start post Control
		$this->add_control(
			'post_include',
			[
				'label' => esc_html__( 'Post Including', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => tp_all_post('portfolio'),
			]
		);

		$this->add_control(
			'post_exclude',
			[
				'label' => esc_html__( 'Post Excluding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => tp_all_post(),
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'textdomain' ),
					'desc' => esc_html__( 'DESC', 'textdomain' ),
				]
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
				],
			]
		);
		// End post Control

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

		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $settings['post_per_page'],
			'orderby' => $settings['order_by'],
			'order' => $settings['order'],
			'post__in' => $settings['post_include'],
			'post__not_in' => $settings['post_exclude'],
		);

		if(!empty($settings['cat_include'] ) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio-cat',
					'field' => 'slug',
					'terms' => $settings['cat_include'],
					'operator' => 'IN',
				),
			);
		}

		$query = new \WP_Query( $args );
		
	// 	$args = [
	// 	'post_type' => 'post',
	// 	'post_status' => 'publish',
	// 	'posts_per_page' => 1,
	// 	'tax_query' => [
	// 		'relation' => 'OR',
	// 		[
	// 			'taxonomy' => 'team',
	// 			'field' => 'slug',
	// 			'terms' => $team_slug,
	// 		],
	// 		[
	// 			'taxonomy' => 'team',
	// 			'field' => 'id',
	// 			'operator' => 'NOT EXISTS',
	// 		],
	// 	],
	// 	'ignore_sticky_posts' => 1,
	//    ];
		

		?>

		<!-- Start Potfolio Section -->

		<section class="tp-portfolio-area pt-130 pb-90">
            <div class="container">
                <div class="tp-portfolio-filter text-center mb-50">
                    <button class="active" data-filter="*">Show All</button>
					
					<?php foreach($settings['cat_include'] as $item) : ?>
                    <button data-filter=".<?php echo esc_html($item); ?>"><?php echo tp_post_cat('portfolio-cat')[$item]?></button>
					<?php endforeach; ?>

                </div>
                <div class="row grid">

				<?php if ( $query->have_posts() ) : while($query-> have_posts()  ) : $query->the_post(); 
						$categories = get_the_terms(get_the_ID(),'portfolio-cat');
					?>

                    <div class="col-xl-4 col-lg-4 col-md-6 grid-item <?php echo exdos_get_cat_data($categories, ', ', 'slug'); ?>">
                        <div class="tp-portfolio-item mb-40">
                            <div class="tp-portfolio-thumb br-15 position-relative mb-20">
                                <?php the_post_thumbnail(); ?>
                                <div class="tp-portfolio-arrow">
                                    <a href="<?php the_permalink(); ?>"><i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                            <div class="tp-portfolio-text text-center">
                                <h3 class="tp-portfolio-title tp-fs-30"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="m-0 pl-60"><span class="mr-5"></span><?php echo exdos_get_cat_data($categories, ', ', 'name'); ?></p>
                            </div>
                        </div>
                    </div>

				<?php endwhile; endif; wp_reset_postdata(); ?>

                </div>
            </div>
        </section>

		<!-- End Portfolio Section -->

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


$widgets_manager->register( new Exdos_Portfolio_Post() );
