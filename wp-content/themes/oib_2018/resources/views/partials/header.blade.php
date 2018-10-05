<?php //check if the page id is in the enable list on option page
  global $post;
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
<header class="banner">
  <div class="container">
    <a class="brand inline" href="{{ home_url('/') }}">
      <?php $image = get_field('header_logo', 'option'); ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="115" height="140" class="img-responsive" />
    </a>
    <nav class="nav-primary inline">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
