<?php
/**
 */

class WPBakeryShortCode_VC_Twitter extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $width = $el_class = $title = $twitter_name = $tweet_count = $el_position = $tweets_count = '';
        wp_enqueue_script( 'tweet' );
        //
        extract(shortcode_atts(array(
            'title' => '',
            'twitter_name' => 'twitter',
            'tweets_count' => 5,
            'el_position' => '',
            'width' => '1/1',
            'el_class' => ''
        ), $atts));
        $output = '';

        $el_class = $this->getExtraClass( $el_class );
        $width = wpb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="wpb_twitter_widget wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading wpb_twitter_heading"><span>'.$title.'</span></h3>' : '';
        $output .= "\n\t\t\t".'<div class="tweets" data-tw_name="'.$twitter_name.'" data-tw_count="'.$tweets_count.'"></div> <p class="twitter_follow_button_wrap"><a class="twitter_follow_button" href="http://twitter.com/'.$twitter_name.'">'.__("Follow us on twitter", "js_composer").'</a></p>';
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

class WPBakeryShortCode_VC_Facebook extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $type = $url = '';
        extract(shortcode_atts(array(
            'type' => 'standard',//standard, button_count, box_count
            'url' => ''
        ), $atts));
        if ( $url == '') $url = get_permalink();
        $output = '<div class="fb_like wpb_content_element fb_type_'.$type.'"><iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$type.'&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>'.$this->endBlockComment('fb_like')."\n";
        return $output;
    }
}

class WPBakeryShortCode_VC_TweetMeMe extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $type = '';
        extract(shortcode_atts(array(
            'type' => 'horizontal'//horizontal, vertical, none
        ), $atts));
        $output = '<a href="http://twitter.com/share" class="twitter-share-button" data-count="'.$type.'">'. __("Tweet", "js_composer") .'</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'.$this->endBlockComment('tweetmeme')."\n";
        return $output;
    }
}

class WPBakeryShortCode_VC_GooglePlus extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $type = $annotation = '';
        extract(shortcode_atts(array(
            'type' => '',
            'annotation' => ''
        ), $atts));

        $params = '';
        $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
        $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';

        $output = '<div class="wpb_googleplus wpb_content_element wpb_googleplus_type_'.$type.'"><g:plusone'.$params.'></g:plusone></div>'.$this->endBlockComment('wpb_googleplus')."\n";
        return $output;
    }
}

class WPBakeryShortCode_VC_Pinterest extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $type = $annotation = '';
        extract(shortcode_atts(array(
            'type' => 'horizontal'
        ), $atts));

        $params = '';
        $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
        $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';

        $url = rawurlencode(get_permalink());
        if ( has_post_thumbnail() ) {
            $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            $media = ( is_array($img_url) ) ? '&amp;media='.rawurlencode($img_url[0]) : '';
        } else {
            $media = '';
        }
        $description = ( get_the_excerpt() != '' ) ? '&amp;description='.rawurlencode(strip_tags(get_the_excerpt())) : '';

        $output =  '<div class="wpb_pinterest wpb_content_element wpb_pinterest_type_'.$type.'">';
        $output .= '<a href="http://pinterest.com/pin/create/button/?url='.$url.$media.$description.'" class="pin-it-button" count-layout="'.$type.'"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
        $output .= '</div>'.$this->endBlockComment('wpb_pinterest')."\n";

        return $output;
    }
}