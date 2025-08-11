<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}

class News_Ticker extends Tnfb_Block_Class {

    protected $tag = 'news_ticker';

// post id, categories, tag slug, post number, custom title, title url, 

    public function map() {
        return array(
            'name'        => esc_html__( 'news_ticker', 'text-domain' ),
            'description' => esc_html__( 'news_ticker', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'dropdown',
                    // 'holder' => 'div',
                    'class' => '',
                    'value'	=> $this->get_category_options(),
                    'admin_label' => true,
                    'heading' => __( 'Category', 'textdomain' ),
                    'param_name' => 'category_id',
                    'description' => __( 'Category', 'textdomain' )
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Limit Post Number', 'textdomain' ),
                    'param_name' => 'limit',
                    'description' => __( 'If the field is empty the limit post number will be the number from Wordpress settings -> Reading', 'textdomain' )
                ),
            ),
        );
    }

    /**
     * Renders the [my_hello] shortcode.
     *
     * Usage: [my_hello name="John Doe"] or [my_hello]
     *
     * @param array  $atts    Shortcode attributes.
     * @param string $content Shortcode content (not used in this example).
     * @return string The HTML output.
     */
    public function render( $atts, $content = '' ) {
        // category for now, then post id filter, multiple cat, etc. 
        // $defaults = array(
        //     'name' => 'World',
        // );
        // $parsed_atts = $this->parse_atts( $atts, $defaults );
        extract(
            shortcode_atts(
                array(
                    'limit'  => 'limit',
                    'category_id' => 'category_id'
                ),
                $atts
            )
        );
        $args = array(
            'post_status'        => 'publish',
            'post_type'             => 'post'
        );
        if ($category_id) {
            $args['cat'] = $category_id;
        }
        if ($limit) {
            $args['posts_per_page'] = $limit;
        }
        $query = new WP_Query($args);
        $buffy = '';
        if ($query->have_posts()) {
            $buffy .= '<div class="news-ticker ">';
            $buffy .= '<div class="news-ticker__title">Trending Now</div>';
            $buffy .= '<div class="news-ticker__display-area">';
            while ($query->have_posts()) {
                $query->the_post();
                $buffy .= '<div class="news-ticker__post " >';
                $buffy .= '<a href="'.get_the_permalink().'">';
               $buffy .= '<span>'.get_the_title().'</span>';
                $buffy .= '</a></div>';
            }
            $buffy .= '</div></div>';
        }
            wp_reset_postdata(  );
            return $buffy;
            
        }
    }



new News_Ticker();