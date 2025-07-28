<?php 
if (!class_exists('Tnfb_Block_Class')) {
    include_once( 'tnfb_block_class.php');
}




class Td_block_image_box extends Tnfb_Block_Class {

    protected $tag = 'td_block_image_box';

    // image_item0 image_title_item0 custom_url_item0 
    // attach_image, vc_link, textfield

    public function map() {
        return array(
            'name'        => esc_html__( 'td_block_image_box', 'text-domain' ),
            'description' => esc_html__( 'td_block_image_box', 'text-domain' ),
            'base'        => 'vc_infobox',
            'category' => __('TFBF', 'text-domain'),
            'icon' => 'tfbf-icon-1-1',
            'params'      => array(
                array(
                    "param_name" => "image_item0",
                    "type" => "attach_image",
                    "value" => '',
                    "heading" => "Image 1",
                    "description" => "",
                    "holder" => "div",
                    "class" => "",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "image_title_item0",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom title",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "custom_url_item0",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom url",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "image_item1",
                    "type" => "attach_image",
                    "value" => '',
                    "heading" => "Image 2",
                    "description" => "",
                    "holder" => "div",
                    "class" => "",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "image_title_item1",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom title",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "custom_url_item1",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom url",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "image_item2",
                    "type" => "attach_image",
                    "value" => '',
                    "heading" => "Image 3",
                    "description" => "",
                    "holder" => "div",
                    "class" => "",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "image_title_item2",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom title",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
                ),
                array(
                    "param_name" => "custom_url_item2",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => "Custom url",
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-extrabig",
                    "group" => 'Images'
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
                    'image_item0' => 'image_item0',
                    'image_title_item0' => 'image_title_item0',
                    'custom_url_item0' => 'custom_url_item0',
                    'image_item1' => 'image_item1',
                    'image_title_item1' => 'image_title_item1',
                    'custom_url_item1' => 'custom_url_item1',
                    'image_item2' => 'image_item2',
                    'image_title_item2' => 'image_title_item2',
                    'custom_url_item2' => 'custom_url_item2',
                ),
                $atts
            )
        );
   
      
     
        $buffy = '<div class="vc_row td_block_image_box block-layout-4">';
       $index = 0;
      for ($i=0; $i < 3; $i++) { 
        $buffy .= '<div class="td_block__item vc_col-md-4" >';
        $buffy .= '<a class="td_block__link" href="'.${'custom_url_item' . $i}.'" target="_blank" style="background-image: url('.wp_get_attachment_url(${'image_item' . $i}).');">';
    //    $buffy .= '<div class="td_block__meta">';
       $buffy .= '<h4 class="td_block__title">'.${'image_title_item' . $i}.'</h4>';
    //    $buffy .= '</div>'; //meta
       $buffy .= '</a></div>'; //md-4
    }
       $buffy .= '</div>'; //vc_row
       return $buffy;
            
        }

    //    return 'cat is '.$tfbf_category;

        // return 'Hello, ' . esc_html( $parsed_atts['name'] ) . '!';
    


}
new Td_block_image_box();