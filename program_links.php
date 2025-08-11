<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}

class Program_links extends Tnfb_Block_Class {

    protected $tag = 'program_links';

// post id, categories, tag slug, post number, custom title, title url, 

    public function map() {
        return array(
            'name'        => esc_html__( 'program_links', 'text-domain' ),
            'description' => esc_html__( 'program_links', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Title', 'textdomain' ),
                    'param_name' => 'title',
                    'description' => __( 'Enter a title', 'textdomain' )
                ),
                array(
                    'type' => 'href',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Title Link', 'textdomain' ),
                    'param_name' => 'title_link',
                    'description' => __( 'Page Link', 'textdomain' )
                ),
            
                array(
                    'type' => 'colorpicker',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Background Color', 'textdomain' ),
                    'param_name' => 'background_color',
                    'description' => __( 'Set Background Color', 'textdomain' )
                ),
                array(
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Background Image', 'textdomain' ),
                    'param_name' => 'background_image',
                    'description' => __( 'Set Background Image', 'textdomain' )
                ),
            ),
        );
    } //map

    /**
     *
     * @param array  $atts    Shortcode attributes.
     * @param string $content Shortcode content (not used in this example).
     * @return string The HTML output.
     */
    public function render( $atts, $content = '' ) {
        extract(
            shortcode_atts(
                array(
                    'title'  => 'title',
                    'title_link' => 'title_link',
                    'background_color' => 'background_color',
                    'background_image' => 'background_image',
                ),
                $atts
            )
        );


       $classname = uniqid( 'program-link-' );
       $link = $title_link ? $title_link : '';
       $buffy = '<style>';
       $buffy .= '.'.$classname.' {';
        
       if ($background_color) {
        $buffy .= 'background-color: '.$background_color.';';
       }
       if ($background_image) {
        $buffy .= 'background-image: url('.wp_get_attachment_image_url($background_image).');';
       }
       $buffy .= '}';
       $buffy .= '</style>';
       $buffy .= '<a class="program-link__link" href="'.$link.'">';
        $buffy .= '<div class="'.$classname.' program-link">';
        $buffy .= '<h3 class="program-link__title">'.$title.'</h3>';
        $buffy .= '</div></a>';
        return $buffy;
        }


    }


new Program_links();