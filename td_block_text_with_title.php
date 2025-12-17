<?php 
// if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
// }

// params:
// custom title 
// title url 
// text (wysiwyg)




class Td_Block_Text_With_Title extends Tnfb_Block_Class {

    protected $tag = 'td_block_text_with_title';



    public function map() {
        return array(
            'name'        => esc_html__( 'td_block_text_with_title', 'text-domain' ),
            'description' => esc_html__( 'td_block_text_with_title', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Custom Title', 'textdomain' ),
                    'param_name' => 'custom_title',
                    'description' => __( 'Enter a title', 'textdomain' )
                ),
                array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Text', 'textdomain' ),
                    'param_name' => 'content',
                    'description' => __( 'Enter your content', 'textdomain' )
                ),
                array(
                    'type' => 'vc_link',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => false,
                    'heading' => __( 'Title Url', 'textdomain' ),
                    'param_name' => 'title_url',
                    'description' => __( 'Enter your content', 'textdomain' )
                )
            ),
        );
    }

    /**
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
                    'custom_title' => 'custom_title',
                    // 'content'       => 'content',
                    'title_url'     => 'title_url'
                ),
                $atts
            )
        );
        
        $buffy = '<div class="td_block_text_with_title">';
        $buffy .= '<h4 class="block-title"><span>';
        $buffy .= $title_url ? '<a href="'.$title_url.'" target="_blank">'.$custom_title.'</a>' :  $custom_title;
        $buffy .= '</span></h4>';
        $buffy .= '<div class="text-title-content">'.$content.'</div>';
        $buffy .= '</div>';
        return $buffy;
            
        }
    }



new Td_Block_Text_With_Title();