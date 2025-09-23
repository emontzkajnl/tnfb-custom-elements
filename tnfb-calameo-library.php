<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}

class Tnfb_calameo_library extends Tnfb_Block_Class {

    protected $tag = 'tnfb_calameo_library';

// post id, categories, tag slug, post number, custom title, title url, 

    public function map() {
        return array(
            'name'        => esc_html__( 'Calameo Library Block', 'text-domain' ),
            'description' => esc_html__( 'Creates grid of magazines', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Calameo ID', 'textdomain' ),
                    'param_name' => 'calameo_id',
                    'description' => __( 'Enter Calameo ID', 'textdomain' )
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
                    'calameo_id'  => 'calameo_id'
                ),
                $atts
            )
        );
       
      
        $buffy = '';
      
            $buffy .= '<div class="tnfb_calameo_library">';
            $buffy .= '<iframe src="//v.calameo.com/library/?type=subscription&id='.$calameo_id.'&rows=10&sortBy=latestPublished&theme=white&bgColor=&thumbSize=large&showTitle=false&showShadow=false&showGloss=false&showInfo=no&linkTo=embed" width="100%" height="2500" frameborder="0" allowfullscreen="allowfullscreen" style="max-width:1170px; margin:0 auto;"></iframe>';
            $buffy .= '</div>';
            return $buffy;
    }


}
new Tnfb_calameo_library();