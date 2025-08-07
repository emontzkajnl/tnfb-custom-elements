<?php

/**
 * Abstract base class for WordPress shortcodes.
 *
 * Provides a structured way to define and register shortcodes,
 * making them easily extendable and maintainable.
 */

abstract class Tnfb_Block_Class {

    /**
     * @var string The shortcode tag. Must be overridden by child classes.
     */
    protected $tag;

    /**
     * Constructor.
     * Registers the shortcode with WordPress.
     */
    public function __construct() {
        if ( empty( $this->tag ) ) {
            trigger_error( 'Shortcode tag must be defined in child class.', E_USER_ERROR );
        }
        add_shortcode( $this->tag, array( $this, 'render' ) );
        			// Map shortcode to Visual Composer
        if ( function_exists( 'vc_lean_map' ) ) {
            vc_lean_map( $this->tag, array( $this, 'map' ) );
        }

}

    /**
     * Abstract method that child classes must implement to render the shortcode output.
     *
     * @param array  $atts    Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string The HTML output of the shortcode.
     */
    abstract public function render( $atts, $content = '' );

    /**
     * Helper method to parse shortcode attributes with defaults. 
     *
     * @param array $atts User-defined attributes.
     * @param array $defaults Default attributes.
     * @return array Merged attributes.
     */
    protected function parse_atts( $atts, $defaults = array() ) {
        return shortcode_atts( $defaults, $atts, $this->tag );
    }

    //  /**
    //  * Get category list for dropdown menu
    //  *
    //  * @param array $cats all categories.
    //  * @param array $cat_array Formatted for VC dropdown.
    //  */
    // public function get_category_options() {
    //     $cats = get_categories();
    //     $cat_array = array('Choose Category' => '');
    //     foreach ($cats as $key => $value) {
    //         $cat_array[$value->name] = $value->term_id;
    //     }
    //     return $cat_array;
    // }
                 /**
     * Get category list for dropdown menu
     *
     * @param array $cats all categories.
     * @param array $cat_array Formatted for VC dropdown.
     */
    public function get_category_options() {
        $cats = get_categories();
        $cat_array = array('Choose Category' => '');
        foreach ($cats as $key => $value) {
            $cat_array[$value->name] = $value->term_id;
        }
        return $cat_array;
    }
}



/**
 * Example of extending the Tnfb_Block_Class class for a button shortcode.
 */
// class My_Button_Shortcode extends Tnfb_Block_Class {

//     protected $tag = 'my_button';

//     /**
//      * Renders the [my_button] shortcode.
//      *
//      * Usage: [my_button url="https://example.com" text="Click Me"]
//      * [my_button url="https://google.com"]Go to Google[/my_button]
//      *
//      * @param array  $atts    Shortcode attributes.
//      * @param string $content Shortcode content.
//      * @return string The HTML output.
//      */
//     public function render( $atts, $content = '' ) {
//         $defaults = array(
//             'url'  => '#',
//             'text' => 'Learn More',
//             'class' => '',
//         );
//         $parsed_atts = $this->parse_atts( $atts, $defaults );

//         $button_text = empty( $content ) ? esc_html( $parsed_atts['text'] ) : do_shortcode( $content );
//         $button_class = ! empty( $parsed_atts['class'] ) ? ' ' . esc_attr( $parsed_atts['class'] ) : '';

//         return sprintf(
//             '<a href="%s" class="my-button%s">%s</a>',
//             esc_url( $parsed_atts['url'] ),
//             $button_class,
//             $button_text
//         );
//     }
// }

// // Initialize the shortcodes (usually in your theme's functions.php or a plugin file)
// new My_Hello_Shortcode();
// new My_Button_Shortcode();
// class My_Hello_Shortcode extends Tnfb_Block_Class {

//     protected $tag = 'my_hello';

//     public function map() {
//         return array(
//             'name'        => esc_html__( 'Hello World', 'text-domain' ),
//             'description' => esc_html__( 'Just a test', 'text-domain' ),
//             'base'        => 'vc_infobox',
//             'category' => __('TFBF', 'text-domain'),
//             'icon' => 'tfbf-icon-1-1',
//             'params'      => array(
//                 array(
//                     'type' => 'textfield',
//                     'holder' => 'div',
//                     'class' => '',
//                     'admin_label' => false,
//                     'heading' => __( 'Name', 'textdomain' ),
//                     'param_name' => 'name',
//                     'description' => __( 'Enter a title do display under the image', 'textdomain' )
//                 ),
//             ),
//         );
//     }

//     /**
//      * Renders the [my_hello] shortcode.
//      *
//      * Usage: [my_hello name="John Doe"] or [my_hello]
//      *
//      * @param array  $atts    Shortcode attributes.
//      * @param string $content Shortcode content (not used in this example).
//      * @return string The HTML output.
//      */
//     public function render( $atts, $content = '' ) {
//         $defaults = array(
//             'name' => 'World',
//         );
//         $parsed_atts = $this->parse_atts( $atts, $defaults );

//         return 'Hello, ' . esc_html( $parsed_atts['name'] ) . '!';
//     }
// }
// new My_Hello_Shortcode();
?>