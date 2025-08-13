<?php

/**
* Adds new shortcodes for page content blocks and registeres them to 
* the WPBakery Visual Composer plugin
*
*/
// If this file is called directly, abort


if ( ! defined( 'ABSPATH' ) ) {
    die ('Silly human what are you doing here');
}

add_action('admin_head', 'remove_vc_link');

function remove_vc_link() {
  echo '<style>
	.wpb_element_wrapper .wpb_vc_param_value {
		display:none;
    }
	.vc_element-icon.tfbf-icon-1-1 {
		background-image: url(/wp-content/plugins/tnfb-custom-elements/img/tfbf-icon-1-1.svg);
		background-size: 32px;
		background-position: 0 0;
		background-repeat: no-repeat;
		display: block;
		margin: 0;
	}
  </style>';
}

////////////////////////////////
// TFBF CUSTOM LINK WITH IMAGE
////////////////////////////////

if ( ! class_exists( 'tnfblinkimage' ) ) {
	class tnfblinkimage {
		/**
		* Main constructor
		*
		*/
		public function __construct() {

			// Registers the shortcode in WordPress
			add_shortcode( 'tnfb-link-image', array( 'tnfblinkimage', 'output' ) );

			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnfb-link-image', array( 'tnfblinkimage', 'map' ) );
			}

		}
		/**
		* Map shortcode to VC
    *
    * This is an array of all your settings which become the shortcode attributes ($atts)
		* for the output.
		*
		*/
		public static function map() {
			return array(
				'name'        => esc_html__( 'TFBF Link Image', 'text-domain' ),
				'description' => esc_html__( 'Add and image, title and link block', 'text-domain' ),
				'base'        => 'vc_infobox',
				'category' => __('TFBF', 'text-domain'),
				'icon' => 'tfbf-icon-1-1',
				'params'      => array(
					array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => '',
						'admin_label' => false,
						'heading' => __( 'Image', 'textdomain' ),
						'param_name' => 'tfbf_image',
						'description' => __( 'Choose an image', 'textdomain' )
					),
					array(
						'type' => 'vc_link',
						'holder' => 'div',
						'class' => '',
						'admin_label' => false,
						'heading' => __( 'Link', 'textdomain' ),
						'param_name' => 'tfbf_link',
						'description' => __( 'Select a post, page or file on this site or an external website.', 'textdomain' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'admin_label' => false,
						'heading' => __( 'Title', 'textdomain' ),
						'param_name' => 'tfbf_title',
						'description' => __( 'Enter a title do display under the image', 'textdomain' )
					),
				),
			);
		}
		/**
		* Shortcode output
		*
		*/
		public static function output( $atts, $content = null ) {
			extract(
				shortcode_atts(
					array(
						'tfbf_image' => 'tfbf_image',
						'tfbf_link' => 'tfbf_link',
						'tfbf_title' => 'tfbf_title',
					),
					$atts
				)
			);
		$tfbf_link = vc_build_link($tfbf_link);
		$tfbf_link_url = $tfbf_link['url'];	
		$tfbf_image = wp_get_attachment_image_src( $tfbf_image, "full");
		$tfbf_image = $tfbf_image[0];
		$tfbf_title = $tfbf_title;
        // Fill $html var with data
		$html = '
		<div class="wpb_text_column wpb_content_element">
			<div class="wpb_wrapper">
				<a href="' . $tfbf_link_url . '" alt="' . $tfbf_title . '">
					<div class="tfbf-image-link"><img src="' . $tfbf_image . '" alt="$tfbf_title" /></div>
					<h3 style="margin-top:0.3em;">' . $tfbf_title . '</h3>
				</a>
			</div>
		</div>
		';
        return $html;
		}
	}
}
new tnfblinkimage;

////////////////////////////////
// TFBF LATEST NEWS BLOCK
////////////////////////////////

if ( ! class_exists( 'tnfblatestnews' ) ) {
	class tnfblatestnews {
		/**
		* Main constructor
		*
		*/
		public function __construct() {

			// Registers the shortcode in WordPress
			add_shortcode( 'tnfb-videos', array( 'tnfblatestnews', 'output' ) );

			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnfb-videos', array( 'tnfblatestnews', 'map' ) );
			}

		}
		/**
		* Map shortcode to VC
		*
		* This is an array of all your settings which become the shortcode attributes ($atts)
			* for the output.
			*
			*/
			public static function map() {
				return array(
					'name'        => esc_html__( 'TFBF Latest News', 'text-domain' ),
					'description' => esc_html__( 'Full width block displaying latest news', 'text-domain' ),
					'base'        => 'vc_infobox',
					'category' => __('TFBF', 'text-domain'),
					'icon' => 'tfbf-icon-1-1',
					'params'      => array(
						array(
							'type' => 'textfield',
							'holder' => 'div',
							'class' => '',
							'admin_label' => false,
							'heading' => __( 'Text Test', 'textdomain' ),
							'param_name' => 'tfbf_title',
							'description' => __( 'Just testing', 'textdomain' )
						),
					),
				);
			}

		/**
		* Shortcode output
		*
		*/
		public static function output( $atts, $content = null ) {
			extract(
				shortcode_atts(
					array(
						'tfbf_title' => 'tfbf_title',
					),
					$atts
				)
			);

		$tfbf_title = $tfbf_title;
        // Fill $html var with data
		$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> 9,
			'category_name'		=> 'news',
			'post_status'		=> 'publish'
		);
		$news_query = new WP_Query($args);
		$counter = 1;
		$html = '<div class="row latest-news-buttons">';
		$html .= '<ul>';
		$html .= '<li><a class="active-news-button" href="#" data-category="news">All</a></li>';
		$html .= '<li><a href="#" data-category="ag-news">Ag News</a></li>';
		$html .= '<li><a href="#" data-category="ag-angle">Ag Angle</a></li>';
		$html .= '<li><a href="#" data-category="press-releases">Press Releases</a></li>';
		$html .= '<li><a href="#" data-category="statements">Statements</a></li>';
		$html .= '</ul></div>';
		if ($news_query->have_posts()):
			$html .= '<div class="vc_row latest-news">';
		while ($news_query->have_posts()): $news_query->the_post();
			
			$html .= in_array($counter, [1,2,6]) ? '<div class="wpb_column vc_column_container vc_col-md-4">' : '';  // columns
			if ($counter == 1 ) {
				$html .= '<div class="vc_column-inner latest-news__featured">';
				$html .= get_the_post_thumbnail();
				$html .= '<p class="latest-news__date">'.get_the_date('M j, Y').'</p>';
				$html .= '<h3 class="latest-news__title">'.get_the_title().'</h3>';
				$html .= '</div>';
			} else {
				$html .= '<div class="vc_column-inner">';
				$html .= '<p class="latest-news__date">'.get_the_date('M j, Y').'</p>';
				$html .= '<h3 class="latest-news__title"><a class="unstyle-link" href="'.get_the_permalink( ).'">'.get_the_title().'</a></h3>';
				$html .= '</div>';
			}
			
			$html .= in_array($counter, [1,5,9]) ? '</div>' : '';  // close columns
			$counter++;
		endwhile;
		$html .= '</div>';
		endif;
        return $html;
		}	
	}
}

new tnfblatestnews;

function ajax_latest_news_homepage_callback() {
	$args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> 9,
		'category_name'		=> $_POST['cat'],
		'post_status'		=> 'publish'
	);

	$news_query = new WP_Query($args);
	$counter = 1;
	$html = '';

	if ($news_query->have_posts()){
		while ($news_query->have_posts()){ $news_query->the_post();
			$html .= in_array($counter, [1,2,6]) ? '<div class="wpb_column vc_column_container vc_col-md-4">' : '';  // columns
			if ($counter == 1 ) {
				$html .= '<div class="vc_column-inner latest-news__featured">';
				$html .= get_the_post_thumbnail();
				$html .= '<p class="latest-news__date">'.get_the_date('M j, Y').'</p>';
				$html .= '<h3 class="latest-news__title">'.get_the_title().'</h3>';
				$html .= '</div>';
			} else {
				$html .= '<div class="vc_column-inner">';
				$html .= '<p class="latest-news__date">'.get_the_date('M j, Y').'</p>';
				$html .= '<h3 class="latest-news__title"><a class="unstyle-link" href="'.get_the_permalink( ).'">'.get_the_title().'</a></h3>';
				$html .= '</div>';
			}
			
			$html .= in_array($counter, [1,5,9]) ? '</div>' : '';  // close columns
			$counter++;
		}
	} else {
		$html = '<p>no posts to display</p>';
		// echo 'no posts';
	}
	echo $html;
	wp_die();

}

add_action( 'wp_ajax_latest_news_homepage', 'ajax_latest_news_homepage_callback' );
add_action( 'wp_ajax_nopriv_latest_news_homepage', 'ajax_latest_news_homepage_callback' );

////////////////////////////////
// TFBF PUBLICATIONS BLOCK
////////////////////////////////

if ( ! class_exists( 'tnfbpublications' ) ) {
	class tnfbpublications {
		public function __construct() {

			// Registers the shortcode in WordPress
			add_shortcode( 'tnfb-publications', array( 'tnfbpublications', 'output' ) );

			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnfb-publications', array( 'tnfbpublications', 'map' ) );
			}

		}

				/**
		* Map shortcode to VC
		*
		* This is an array of all your settings which become the shortcode attributes ($atts)
			* for the output.
			* select h&f or news, description, 
			* thf-magazine or tfb-newsletter category	
			*/
			public static function map() {
				return array(
					'name'        => esc_html__( 'TFBF Publications', 'text-domain' ),
					'description' => esc_html__( 'Block displaying publication panel', 'text-domain' ),
					'base'        => 'vc_publication',
					'category' => __('TFBF', 'text-domain'),
					'icon' => 'tfbf-icon-1-1',
					'params'      => array(
						array(
							'type' => 'textfield',
							'holder' => 'h3',
							'class' => '',
							'admin_label' => false,
							'heading' => __( 'Title', 'textdomain' ),
							'param_name' => 'tfbf_title',
							'description' => __( 'Publication Title', 'textdomain' )
						),
						array(
							'type' => 'textarea',
							'holder' => 'p',
							'class' => '',
							'admin_label' => false,
							'heading' => __( 'Description', 'textdomain' ),
							'param_name' => 'tfbf_description',
							'description' => __( 'Description', 'textdomain' )
						),
						array(
							'type' => 'dropdown',
							// 'holder' => 'div',
							'class' => '',
							'value'	=> array(
								__('Choose a category', 'textdomain' ) => '',
								__('magazine', 'textdomain' ) => 'thf-magazine',
								__('newsletter', 'textdomain' ) => 'tfb-newsletter',
							),
							'admin_label' => true,
							'heading' => __( 'Category', 'textdomain' ),
							'param_name' => 'tfbf_category',
							'description' => __( 'Category', 'textdomain' )
						),
					),
				);
			}
					/**
		* Shortcode output
		*
		*/
		public static function output( $atts, $content = null ) {
			// print_r($atts);
			extract(
				shortcode_atts(
					array(
						'tfbf_title' => 'tfbf_title',
						'tfbf_description' => 'tfbf_description',
						'tfbf_category' => 'tfbf_category',
					),
					$atts
				)
			);

		// $category_name = $tfbf_category == 'magazine' ? 'thf-magazine' : 'tfb-newsletter'; 
        // Fill $html var with data
		$args = array(
			'post_type'			=> 'post',
			'number_posts'		=> 1,
			'category_name'		=> $tfbf_category,
			'post_status'		=> 'publish'
		);
		$pub_query = get_posts($args);
		if (empty($pub_query)) {
			return false;
		}
		$ID = $pub_query[0]->ID;
		$html = '';
		
			$html .= '<div class="tnfb-publication row col-md-12">';
			$html .= '<div class="tnfb-publication__text-container col-md-6">';
			$html .= '<h3 class="tnfb-publication__title">'.$tfbf_title.'</h3>';
			$html .= '<p class="tnfb-publication__description">'.$tfbf_description.'</p>';
			$html .= '<p class="tnfb-publication__read-more"><a href="'.get_the_permalink($ID).'">Read the latest issue ></a></p>';
			$html .= '</div>'; // text container
			$html .= '<div class="tnfb-publication__img-container col-md-6">';
			$html .= '<a href="'.get_the_permalink($ID).'">'.get_the_post_thumbnail( $ID, 'medium').'</a>';
			$html .= '</div>'; // img container

		$html .= '</div>';
        return $html;
		}	
	}
}


new tnfbpublications;

////////////////////////////////
// TFBF VIDEO BLOCK
////////////////////////////////

// if ( ! class_exists( 'tnfbvideos' ) ) {
// 	class tnfbvideos {
// 		/**
// 		* Main constructor
// 		*
// 		*/
// 		public function __construct() {

// 			// Registers the shortcode in WordPress
// 			add_shortcode( 'tnfb-videos', array( 'tnfbvideos', 'output' ) );

// 			// Map shortcode to Visual Composer
// 			if ( function_exists( 'vc_lean_map' ) ) {
// 				vc_lean_map( 'tnfb-videos', array( 'tnfbvideos', 'map' ) );
// 			}

// 		}
// 		/**
// 		* Map shortcode to VC
// 		*
// 		* This is an array of all your settings which become the shortcode attributes ($atts)
// 			* for the output.
// 			*
// 			*/
// 			public static function map() {
// 				return array(
// 					'name'        => esc_html__( 'TFBF Videos', 'text-domain' ),
// 					'description' => esc_html__( 'Full width block displaying video section', 'text-domain' ),
// 					'base'        => 'vc_infobox',
// 					'category' => __('TFBF', 'text-domain'),
// 					'icon' => 'tfbf-icon-1-1',
// 					'params'      => array(
// 						// array(
// 						// 	'type' => 'attach_image',
// 						// 	'holder' => 'img',
// 						// 	'class' => '',
// 						// 	'admin_label' => false,
// 						// 	'heading' => __( 'Image', 'textdomain' ),
// 						// 	'param_name' => 'tfbf_image',
// 						// 	'description' => __( 'Choose an image', 'textdomain' )
// 						// ),
// 						// array(
// 						// 	'type' => 'vc_link',
// 						// 	'holder' => 'div',
// 						// 	'class' => '',
// 						// 	'admin_label' => false,
// 						// 	'heading' => __( 'Link', 'textdomain' ),
// 						// 	'param_name' => 'tfbf_link',
// 						// 	'description' => __( 'Select a post, page or file on this site or an external website.', 'textdomain' )
// 						// ),
// 						array(
// 							'type' => 'textfield',
// 							'holder' => 'div',
// 							'class' => '',
// 							'admin_label' => false,
// 							'heading' => __( 'Text Test', 'textdomain' ),
// 							'param_name' => 'tfbf_title',
// 							'description' => __( 'Just testing', 'textdomain' )
// 						),
// 					),
// 				);
// 			}

// 		/**
// 		* Shortcode output
// 		*
// 		*/
// 		public static function output( $atts, $content = null ) {
// 			extract(
// 				shortcode_atts(
// 					array(
// 						'tfbf_title' => 'tfbf_title',
// 					),
// 					$atts
// 				)
// 			);

// 		$tfbf_title = $tfbf_title;
//         // Fill $html var with data
// 		$args = array(
// 			'post_type'			=> 'post',
// 			'posts_per_page'	=> 9,
// 			'category_name'		=> 'news',
// 			'post_status'		=> 'publish'
// 		);
// 		$news_query = new WP_Query($args);
// 		$counter = 1;
// 		$html = '';
// 		if ($news_query->have_posts()):
// 			$html .= '<div class="vc_row latest-news">';
// 		while ($news_query->have_posts()): $news_query->the_post();
			
// 			$html .= in_array($counter, [1,2,6]) ? '<div class="wpb_column vc_column_container vc_col-md-4">' : '';  // columns
// 			if ($counter == 1 ) {
// 				$html .= '<div class="vc_column-inner latest-news__featured">';
// 				$html .= get_the_post_thumbnail();
// 				$html .= '<h3>'.get_the_title().'</h3>';
// 				$html .= '</div>';
// 			} else {
// 				$html .= '<div class="vc_column-inner">';
// 				$html .= '<h3 class="latest-news__title"><a class="unstyle-link" href="'.get_the_permalink( ).'">'.get_the_title().'</a></h3>';
// 				$html .= '</div>';
// 			}
			
// 			$html .= in_array($counter, [1,5,9]) ? '</div>' : '';  // close columns
// 			$counter++;
// 		endwhile;
// 		$html .= '</div>';
// 		endif;
//         return $html;
// 		}	
// 	}
// }

// new tnfbvideos;