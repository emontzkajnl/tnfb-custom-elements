<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}




class Td_block_big_grid_5 extends Tnfb_Block_Class {

    protected $tag = 'td_block_big_grid_5';



    public function map() {
        return array(
            'name'        => esc_html__( 'td_block_big_grid_5', 'text-domain' ),
            'description' => esc_html__( 'td_block_big_grid_5', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Name', 'textdomain' ),
                    'param_name' => 'name',
                    'description' => __( 'Enter a title do display under the image', 'textdomain' )
                ),
                array(
                    'type' => 'dropdown',
                    // 'holder' => 'div',
                    'class' => '',
                    'value'	=> $this->get_category_options(),
                    'admin_label' => true,
                    'heading' => __( 'Category', 'textdomain' ),
                    'param_name' => 'tfbf_category',
                    'description' => __( 'Category', 'textdomain' )
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
                    'tfbf_category' => 'tfbf_category'
                ),
                $atts
            )
        );
        $args = array(
            'posts_per_page'        => 3,
            'post_type'             => 'post'
        );
        if ($tfbf_category) {
            $args['cat'] = $tfbf_category;
        }
        $query = new WP_Query($args);
        $buffy = '';
        if ($query->have_posts()) {
            $buffy .= '<div class="td_block_big_grid_5 block-layout-1 vc_row">';
            while ($query->have_posts()) {
                $query->the_post();
                $buffy .= '<div class="td_block__item vc_col-md-4" >';
                $buffy .= '<a href="'.get_the_permalink().'">';
               $buffy .=  get_the_post_thumbnail( get_the_ID());
               $buffy .= '<div class="td_block__meta">';
               $buffy .= '<h4 class="td_block__title">'.get_the_title().'</h4>';
               $buffy .= '</div>';


                $buffy .= '</a></div>';
            }
            $buffy .= '</div>';
            wp_reset_postdata(  );
            return $buffy;
            
        }

    //    return 'cat is '.$tfbf_category;

        // return 'Hello, ' . esc_html( $parsed_atts['name'] ) . '!';
    }


}
new Td_block_big_grid_5();