<?php
/*
  Template Name: Empower
 */

get_header();

$options = get_option('sf_flexform_options');

$default_show_page_heading = $options['default_show_page_heading'];
$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
$default_sidebar_config = $options['default_sidebar_config'];
$default_left_sidebar = $options['default_left_sidebar'];
$default_right_sidebar = $options['default_right_sidebar'];

$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
$page_title_one = get_post_meta($post->ID, 'sf_page_title_one', true);
$page_title_two = get_post_meta($post->ID, 'sf_page_title_two', true);
$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);

if ($show_page_title == "") {
    $show_page_title = $default_show_page_heading;
}
if ($page_title_bg == "") {
    $page_title_bg = $default_page_heading_bg_alt;
}

$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
$left_sidebar = get_post_meta($post->ID, 'sf_left_sidebar', true);
$right_sidebar = get_post_meta($post->ID, 'sf_right_sidebar', true);

if ($sidebar_config == "") {
    $sidebar_config = $default_sidebar_config;
}
if ($left_sidebar == "") {
    $left_sidebar = $default_left_sidebar;
}
if ($right_sidebar == "") {
    $right_sidebar = $default_right_sidebar;
}

$page_wrap_class = '';
if ($sidebar_config == "left-sidebar") {
    $page_wrap_class = 'has-left-sidebar has-one-sidebar row';
} else if ($sidebar_config == "right-sidebar") {
    $page_wrap_class = 'has-right-sidebar has-one-sidebar row';
} else if ($sidebar_config == "both-sidebars") {
    $page_wrap_class = 'has-both-sidebars';
} else {
    $page_wrap_class = 'has-no-sidebar';
}

$remove_breadcrumbs = get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
$remove_bottom_spacing = get_post_meta($post->ID, 'sf_no_bottom_spacing', true);
$remove_top_spacing = get_post_meta($post->ID, 'sf_no_top_spacing', true);

if ($remove_bottom_spacing) {
    $page_wrap_class .= ' no-bottom-spacing';
}
if ($remove_top_spacing) {
    $page_wrap_class .= ' no-top-spacing';
}
?>
<?php if (have_posts()) : the_post(); ?>

    <!--// OPEN .container //-->
    <div class="container">


        <!--// OPEN #page-wrap //-->
        <div id="page-wrap">

            <br />
            <div class="center-content">

                <?php if ($show_page_title) { ?>	
                    <div class="row">
                        <div class="page-heading span-12 clearfix alt-bg <?php echo $page_title_bg; ?>">

                            <h1><?php the_title(); ?></h1>

                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="span-12">
                        <?php
// BREADCRUMBS
                        if (!$remove_breadcrumbs) {
                            echo sf_breadcrumbs();
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span-12">
                        <?php the_content(); ?>	
                    </div>
                </div>

                <?php
                if (has_post_thumbnail()) {
                    ?>
                    <div class="row">
                        <div class="span-12">
                            <p>
                                <?php the_post_thumbnail('full'); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="span-12">
                        <?php if ($page_title_one) { ?>
                            <h1><?php echo $page_title_one; ?></h1>
                        <?php } ?>
                        <?php if ($page_title_one) { ?>
                            <h1><?php echo $page_title_two; ?></h1>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <!--// CLOSE #page-wrap //-->			
        </div>

        <!--// CLOSE .container //-->
    </div>

    <?php if (is_front_page()) { ?>

        <section id="tabs-section">            
            <div class="container">               
                <ul class="nav nav-tabs home-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">
                            - Modul 1 - <br />
                            <span class="tab-sub-title"> Kompetent mentoring</span>
                        </a>
                    </li>
                    <li>
                        <a href="#profile" data-toggle="tab">
                            - Modul 2 - <br />
                            <span class="tab-sub-title"> Hvem er du?</span>
                        </a>
                    </li>
                    <li>
                        <a href="#messages" data-toggle="tab">
                            - Modul 3  - <br />
                            <span class="tab-sub-title">Gør dig fri af mønstre</span>
                        </a>
                    </li>
                    <li>
                        <a href="#settings" data-toggle="tab">
                            - Modul 4  - <br />
                            <span class="tab-sub-title"> Gør dig fri af mønstre</span>
                        </a>
                    </li>
                    <li>
                        <a href="#settings" data-toggle="tab">
                            - Modul 5  - <br />
                            <span class="tab-sub-title">  Mindfulness </span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <div class="container">
            <div class="center-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <h2>MODUL 1 - Kompetent mentoring</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                            aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum
                            dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                            augue duis dolore te feugait nulla facilisi.
                        </p>
                        <p>
                        <center>
                            <a href="#" class="btn-readmore">LÆS MERE OM UDDANNELSEN OG TILMELD DIG HER</a>
                        </center>
                        </p>
                    </div>
                    <div class="tab-pane" id="profile">
                        <h2>MODUL 2 - Kompetent mentoring</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                            aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum
                            dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                            augue duis dolore te feugait nulla facilisi.
                        </p>
                        <p>
                        <center>
                            <a href="#" class="btn-readmore">LÆS MERE OM UDDANNELSEN OG TILMELD DIG HER</a>
                        </center>
                        </p>
                    </div>
                    <div class="tab-pane" id="messages">
                        <h2>MODUL 3 - Kompetent mentoring</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                            aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum
                            dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                            augue duis dolore te feugait nulla facilisi.
                        </p>
                    </div>
                    <div class="tab-pane" id="settings">
                        <h2>MODUL 4 - Kompetent mentoring</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                            aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum
                            dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                            augue duis dolore te feugait nulla facilisi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <div class="testimonial-main-slider">
        <div class="container">
               <?php
                        $args = array(
                            'posts_per_page' => 1,
                            'offset' => 0,
                            'category' => '',
                            'orderby' => 'ID',
                            'order' => 'DESC',
                            'include' => '51',
                            'exclude' => '',
                            'meta_key' => '',
                            'meta_value' => '',
                            'post_type' => 'page',
                            'post_mime_type' => '',
                            'post_parent' => '',
                            'post_status' => 'publish',
                            'suppress_filters' => true);
                        $myposts = get_pages($args);
                        global $more;    // Declare global $more (before the loop).

                        foreach ($myposts as $post) : setup_postdata($post);
                            $more = 0;
                            
                            the_content();
                        endforeach;
                        wp_reset_postdata();
                        ?>
        </div>
        </div>
    <?php } ?>
<?php endif; ?>

<?php get_footer(); ?>
