<?php

/**
 * Custom functions
 */

// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
function remove_wp_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
endif;

add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_action( 'init', function() {
  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');
  // Turn off oEmbed auto discovery.
  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
}, PHP_INT_MAX - 1 );  // remove the wp-embed.min.js file from the frontend completely

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

//remove wordpress dns-prefetch
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }

    return $hints;
}

add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

if( !defined('OIB_PAGE_PATH') ){
    define('OIB_PAGE_PATH', get_template_directory() .'/' );
}
require_once OIB_PAGE_PATH . 'mobiledetect/Mobile_Detect.php';

if( function_exists('acf_add_options_page') ) {
  // add parent
  $parent = acf_add_options_page(array(
    'page_title'  => 'OIB Settings',
    'menu_title'  => 'OIB Settings',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Footer CopyRight',
    'menu_title'  => 'Footer CopyRight',
    'menu_slug'   => 'footer-copyright',
    'parent_slug'   => $parent['menu_slug'],
    'capability'  => 'activate_plugins',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Header Setting',
    'menu_title'  => 'Header Setting',
    'menu_slug'   => 'header_setting',
    'parent_slug'   => $parent['menu_slug'],
    'capability'  => 'activate_plugins',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Topbar Setting',
    'menu_title'  => 'Topbar Setting',
    'menu_slug'   => 'topbar_setting',
    'parent_slug'   => $parent['menu_slug'],
    'capability'  => 'activate_plugins',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Sidebar Setting',
    'menu_title'  => 'Sidebar Setting',
    'menu_slug'   => 'sidebar_setting',
    'parent_slug'   => $parent['menu_slug'],
    'capability'  => 'activate_plugins',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'News Archives Page Setting',
    'menu_title'  => 'News Archives Page Setting',
    'menu_slug'   => 'news_archives_page_setting',
    'parent_slug'   => $parent['menu_slug'],
    'capability'  => 'activate_plugins',
    'redirect'    => false
  ));
}

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size('news-thumbnail', 390, 240,  array( 'center', 'top' ));
}

function load_Img($className, $fieldName) { ?>

    <!--[if lt IE 9]>
    <script>
        $(document).ready(function() {
            $("<?php print $className ?>").backstretch("<?php $img=wp_get_attachment_image_src(get_sub_field($fieldName), "full"); echo $img[0];  ?>");
        });
    </script>
    <![endif]-->

  <style scoped>
  <?php echo $className; ?> {
    background-image: url(<?php $img=wp_get_attachment_image_src(get_sub_field($fieldName), "full"); echo $img[0];  ?>);
        background-repeat:no-repeat;
        background-position: center center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
  }
  @media only screen and (max-width: 1024px) {
    <?php echo $className; ?> {
      background-image: url(<?php $img=wp_get_attachment_image_src(get_sub_field($fieldName), "large"); echo $img[0];  ?>);
    }
  }
  @media only screen and (max-width: 640px) {
    <?php echo $className; ?> {
      background-image: url(<?php $img=wp_get_attachment_image_src(get_sub_field($fieldName), "medium"); echo $img[0];  ?>);
    }
  }
  </style>
  <?php
    $detect = new Mobile_Detect;
    $css_code = "<style scoped>";
    if ( $detect->isMobile() )
    {
      $css_code .= $className . ' {background-attachment: scroll;}';
    }
    $css_code .= "</style>";
    echo $css_code;
}

function load_Feature_Img($className, $fieldName) { ?>

  <style scoped>
  <?php echo $className; ?> {
    background-image: url(<?php $img=wp_get_attachment_image_src( get_post_thumbnail_id( $fieldName ), "full" ); echo $img[0];  ?>);
        background-repeat:no-repeat;
        background-position: center center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
  }
  @media only screen and (max-width: 1024px) {
    <?php echo $className; ?> {
      background-image: url(<?php $img=wp_get_attachment_image_src( get_post_thumbnail_id( $fieldName ),  "large"); echo $img[0];  ?>);
    }
  }
  @media only screen and (max-width: 640px) {
    <?php echo $className; ?> {
      background-image: url(<?php $img=wp_get_attachment_image_src( get_post_thumbnail_id( $fieldName ), "medium"); echo $img[0];  ?>);
    }
  }
  </style>
  <?php
    $detect = new Mobile_Detect;
    $css_code = "<style scoped>";
    if ( $detect->isMobile() )
    {
      $css_code .= $className . ' {background-attachment: scroll;}';
    }
    $css_code .= "</style>";
    echo $css_code;
}

function load_Feature_Img_Item($className, $fieldName, $size) { ?>

  <style scoped>
  <?php echo $className; ?> {
    background-image: url(<?php $img=wp_get_attachment_image_src( get_post_thumbnail_id( $fieldName ), $size ); echo $img[0];  ?>);
        background-repeat:no-repeat;
        background-position: center center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
  }
  </style>
  <?php
    $detect = new Mobile_Detect;
    $css_code = "<style scoped>";
    if ( $detect->isMobile() )
    {
      $css_code .= $className . ' {background-attachment: scroll;}';
    }
    $css_code .= "</style>";
    echo $css_code;
}

function load_Img_no_mobile_not_sub($className, $fieldName) { ?>
  <style>
  <?php echo $className; ?> {
    background-image: url(<?php $img=wp_get_attachment_image_src(get_field($fieldName), "full"); echo $img[0];  ?>);
  }
  @media only screen and (max-width: 1024px) {
    <?php echo $className; ?> {
      background-image: url(<?php $img=wp_get_attachment_image_src(get_field($fieldName), "large"); echo $img[0];  ?>);
    }
  }
  @media only screen and (max-width: 640px) {
    <?php echo $className; ?> {
      background: none;
    }
  }
  </style>
  <?php
}

// GET SECTION BUILDER
function build_sections()
{
    $question_count = 1;

    if( get_field('section_builder') )
    {
        while( has_sub_field("section_builder") )
        {
            if( get_row_layout() == "section_html" ) // layout: Section Html
            {
                $contentAlignement = get_sub_field("text_alignment");
            ?>
                <section class="container section-html" style="text-align: <?php echo $contentAlignement; ?>">
                    <?php echo get_sub_field("html_field"); ?>
                </section>
            <?php }
            elseif( get_row_layout() == "section_image_with_text" ) // layout: Section image with text
            {
                $imageAlignment = get_sub_field("image_alignment");
                $textAlignement = ($imageAlignment == 'Left') ? "Right" : "Left";
                $image = get_sub_field('section_image');
            ?>
                <section class="container section-image-with-text">
                    <div class="content">
                        <?php echo get_sub_field("section_content"); ?>
                    </div>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="img-responsive" />
                </section>
            <?php }
            elseif( get_row_layout() == "section_subscribe" ) // layout: Section Subscribe
            { ?>
                <section class="container section-subscribe">
                    <h2><?php echo get_sub_field("section_subscribe_title"); ?></h2>
                    <div class="section-content"><?php echo get_sub_field("section_subscribe_content"); ?></div>
                </section>
            <?php }
            elseif( get_row_layout() == "section_tab_system" ) // layout: Section Tabs
            { ?>
                <section class="container section-tabs-system">
                     <div class="fliter-btns-group">
                      <?php $i = 0;
                        while(has_sub_field('section_tabs')):
                            $tab = strtolower(get_sub_field("tab"));
                            $tab = preg_replace('/\s+/', '_', $tab);
                      ?>
                      <div class="inline tab <?php if($i==0) { echo "tab-active"; } ?>" data-filter=".<?php echo $tab; ?>"><?php echo get_sub_field("tab"); ?></div>
                      <?php $i++; endwhile; ?>
                    </div>
                    <div class="grid section-content">
                        <?php
                          while(has_sub_field('section_tabs')):
                            $tab = strtolower(get_sub_field("tab"));
                            $tab = preg_replace('/\s+/', '_', $tab);
                        ?>
                        <div class="<?php echo $tab; ?> element-item"><?php echo get_sub_field("tab_section"); ?></div>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php }
            elseif( get_row_layout() == "section_banner" ) // layout: Section Banner
            { ?>
                <?php load_Img(".section-banner", "banner_background_image"); ?>
                <section class="section-banner normalHeight">
                    <div class="container">
                        <div class="fLeft banner-content">
                            <h1><?php echo get_sub_field("banner_header"); ?></h1>
                            <div class="section-banner-content"><?php echo get_sub_field("banner_subheader"); ?></div>
                        </div>
                    </div>
                </section>
            <?php }
            elseif( get_row_layout() == "section_intro" ) // layout: Section Intro
            { ?>
                <section class="section-intro">
                    <div class="hasCrossLine">
                        <div class="container">
                            <div class="inner-container">
                                <div class="hasCrossLine-topic"><?php echo get_sub_field("section_intro_topic"); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="inner-container">
                            <div class="fLeft intro-topic">
                                <h2><?php echo get_sub_field("section_intro_headline"); ?></h2>
                            </div>
                            <div class="fRight intro-content">
                                <div><?php echo get_sub_field("section_intro_content"); ?></div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php }
        }
    }
}
