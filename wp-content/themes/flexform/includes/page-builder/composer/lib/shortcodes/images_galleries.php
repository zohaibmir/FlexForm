<?php
/**
 */

class WPBakeryShortCode_VC_gallery extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        $title = $type = $onclick = $custom_links = $img_size = '';
        $width = $images = $el_class = $interval = $el_position = '';
        extract(shortcode_atts(array(
            'title' => '',
            'type' => 'flexslider',
            'onclick' => 'link_image',
            'custom_links' => '',
            'img_size' => 'thumbnail',
            'width' => '1/1',
            'images' => '',
            'el_class' => '',
            'interval' => '5',
            'el_position' => ''
        ), $atts));
        $output = '';
        $gal_images = '';
        $link_start = '';
        $link_end = '';
        $el_start = '';
        $el_end = '';
        $slides_wrap_start = '';
        $slides_wrap_end = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        if ( $type == 'nivo' ) {
            $type = ' wpb_slider_nivo';
            wp_enqueue_script( 'nivo-slider' );
        } else if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'flexslider_slide' || $type == 'fading' ) {
            $el_start = '<li>';
            $el_end = '</li>';
            $slides_wrap_start = '<ul class="slides">';
            $slides_wrap_end = '</ul>';
            //wp_enqueue_style('flexslider');
            //wp_enqueue_script('flexslider');
        } else if ( $type == 'image_grid' ) {
            wp_enqueue_script( 'isotope' );

            $el_start = '<li class="isotope-item">';
            $el_end = '</li>';
            $slides_wrap_start = '<ul class="wpb_image_grid_ul">';
            $slides_wrap_end = '</ul>';
        }

//        if ( $onclick == 'link_image' ) {
//            wp_enqueue_script( 'prettyphoto' );
//            wp_enqueue_style( 'prettyphoto' );
//        }

        $flex_fx = '';
        if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'fading' ) {
            $type = ' wpb_flexslider flexslider_fade flexslider';
            $flex_fx = ' data-flex_fx="fading"';
        } else if ( $type == 'flexslider_slide' ) {
            $type = ' wpb_flexslider flexslider_slide flexslider';
            $flex_fx = ' data-flex_fx="slide"';
        } else if ( $type == 'image_grid' ) {
            $type = ' wpb_image_grid';
        }


        /*
       else if ( $type == 'fading' ) {
          $type = ' wpb_slider_fading';
          $el_start = '<li>';
          $el_end = '</li>';
          $slides_wrap_start = '<ul class="slides">';
          $slides_wrap_end = '</ul>';
          wp_enqueue_script( 'cycle' );
      }*/

        if ( $images == '' ) return null;

        $pretty_rel_random = 'rel-'.rand();

        if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }
        $images = explode( ',', $images);
        $i = -1;

        foreach ( $images as $attach_id ) {
            $i++;
            $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
            if ( wpb_debug() ) {
                //var_dump($post_thumbnail);
            }
            $thumbnail = $post_thumbnail['thumbnail'];
            $p_img_large = $post_thumbnail['p_img_large'];

            if ( $onclick == 'link_image' ) {
                $link_start = '<a class="view" rel="gallery_'.$pretty_rel_random.'" href="'.$p_img_large[0].'">';
                $link_end = '</a>';
            }
            else if ( $onclick == 'custom_link' ) {
                $link_start = '<a href="'.$custom_links[$i].'">';
                $link_end = '</a>';
            }
            $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
        }

        $output .= "\n\t".'<div class="wpb_gallery wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading wpb_teaser_grid_heading"><span>'.$title.'</span></h3>' : '';
        $output .= '<div class="wpb_gallery_slides'.$type.'" data-interval="'.$interval.'"'.$flex_fx.'>'.$slides_wrap_start.$gal_images.$slides_wrap_end.'</div>';
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

class WPBakeryShortCode_VC_Single_image extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $el_class = $width = $image_size = $frame = $lightbox = $image_link = $link_target = $caption = $el_position = $image = '';

        extract(shortcode_atts(array(
            'width' => '1/1',
            'image' => $image,
            'image_size' => '',
            'frame'	=> '',
            'lightbox' => '',
            'image_link' => '',
            'link_target' => '',
            'caption' => '',
            'el_position' => ''
        ), $atts));
		
		if ($image_size == "") { $image_size = "large"; }
		
        $output = '';
        $img = wpb_getImageBySize(array( 'attach_id' => preg_replace('/[^\d]/', '', $image), 'thumb_size' => $image_size ));
        $img_url = wp_get_attachment_image_src($image, 'large');
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
        // $content =  !empty($image) ? '<img src="'..'" alt="">' : '';
        $content = '';
        $output .= "\n\t".'<div class="wpb_content_element wpb_single_image '. $frame .' '.$width.$el_class.'">';           

        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        if ($lightbox == "yes") {
        $output .= '<figure class="lightbox clearfix">';
        } else {
        $output .= '<figure class="clearfix">';
        }
        if ($image_link != "") {
        $output .= "\n\t\t\t".'<a class="img-link" href="'.$image_link.'" target="'.$link_target.'">';
        $output .= $img['thumbnail'];
        $output .= '</a>';
        } else if ($lightbox == "yes") {
        $output .= "\n\t\t\t".'<a class="view" href="'.$img_url[0].'" rel="image-gallery">';
        $output .= '<div class="overlay"><div class="thumb-info">';
        $output .= '<i class="icon-search"></i>';
        $output .= '</div></div>';
        $output .= $img['thumbnail'];
        $output .= '</a>';
        } else { 
        $output .= "\n\t\t\t".$img['thumbnail'];
        }
        $output .= '</figure>';
        if ($caption != "") {
        $output .= '<div class="image-caption">'.$caption.'</div>';
        }
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }

    public function singleParamHtmlHolder($param, $value) {
        $output = '';
        // Compatibility fixes
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);
        //$value = __($value, "js_composer");
        //
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
            $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
            if(($param['type'])=='attach_image') {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'thumbnail' ));
                $output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" />') . '<a href="#" class="column_edit_trigger' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '"><i class="icon-wpb-single-image"></i>' . __( 'No image yet! Click here to select it now.', 'js_composer' ) . '</a>';
            }
        }
        else {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        return $output;
    }
}