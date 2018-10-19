<?php //check if the page id is in the enable list on option page
  global $post;
  $detect = new Mobile_Detect;
  $enableTopbar = false;
  $hasTopbar = get_field('topbar_pages', 'option');
  if( $hasTopbar ):
    foreach( $hasTopbar as $postID):
      setup_postdata($postID);
      if($postID == $post->ID) {
        $enableTopbar = true;
        break;
      }
    endforeach;
    wp_reset_postdata();
  endif;
?>
<?php if($enableTopbar) { ?>
  <section class="topbar" style="background-color: {{ the_field('topbar_background_color', 'option') }}">
    <div class="container">{{ the_field('topbar_content', 'option') }}</div>
  </section>
<?php } ?>
<?php if(!is_front_page()) { ?>
<header class="banner">
  <div class="container">
    <div class="inner-container">
      <a class="brand inline" href="{{ home_url('/') }}">
        <?php
        if(!$detect->isMobile()) {
          $image = get_field('header_logo', 'option');
          $imageFixed = get_field('header_mobile_logo', 'option');
        } else {
          $image = get_field('header_mobile_logo', 'option');
          $imageFixed = get_field('header_mobile_logo', 'option');
        }
        ?>
        <img src="<?php echo $imageFixed['url']; ?>" alt="<?php echo $imageFixed['alt']; ?>" width="90" height="41" class="img-responsive forFixed" />
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="90" height="41" class="img-responsive forLoaded" />
      </a>
      <nav class="nav-primary inline">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        @endif
      </nav>
      <nav class="mobile-primary inline <?php if($detect->isMobile()) { echo 'mobile-enable'; } ?>">
        <i class="icon-menu"></i>
      </nav>
    </div>
  </div>
</header>
<?php }
