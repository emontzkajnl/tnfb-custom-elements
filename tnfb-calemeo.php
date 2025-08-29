<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}

class Tnfb_calameo extends Tnfb_Block_Class {

    protected $tag = 'tnfb_calameo';

// post id, categories, tag slug, post number, custom title, title url, 

    public function map() {
        return array(
            'name'        => esc_html__( 'Calameo Block', 'text-domain' ),
            'description' => esc_html__( 'Creates calameo iframe', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Calemeo ID', 'textdomain' ),
                    'param_name' => 'calemeo_id',
                    'description' => __( 'Enter Calemeo ID', 'textdomain' )
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
                    'calemeo_id'  => 'calemeo_id'
                ),
                $atts
            )
        );
       
      
        $buffy = '';
      
            $buffy .= '<div class="tnfb_calameo">';
            $buffy .= '<iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode='.$calemeo_id.'&amp;page=1" width="100%" height="700" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe>';
            $buffy .= '</div>';
            return $buffy;
    }


}
new Tnfb_calameo();