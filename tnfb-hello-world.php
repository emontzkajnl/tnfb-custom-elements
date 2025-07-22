<?php 
/**
 * Example of extending the Tnfb_Block_Class class for a simple "Hello World" shortcode.
 */
include( 'tnfb_block_class.php');
class My_Hello_Shortcode extends Tnfb_Block_Class {

    protected $tag = 'my_hello';

    public function map() {
        return array(
            'name'        => esc_html__( 'Hello World', 'text-domain' ),
            'description' => esc_html__( 'Just a test', 'text-domain' ),
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
        $defaults = array(
            'name' => 'World',
        );
        $parsed_atts = $this->parse_atts( $atts, $defaults );

        return 'Hello, ' . esc_html( $parsed_atts['name'] ) . '!';
    }
}
new My_Hello_Shortcode();