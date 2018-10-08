<?php
$categories = get_the_terms( $post->ID , 'news-filter' );
$category = 'news';
if ( ! empty( $categories ) ) {
  $category = esc_html( $categories[0]->name );
}
?>
<section class="section-recent-post section-header">
  <?php load_Feature_Img(".section-recent-post", $post->ID); ?>
  <div class="container white-bg banner-content">
    <div class="cta-brown"><?php echo $category; ?></div>
    <h1><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
    <p class="author-info">Wrtitten by <?php echo get_the_author_meta( 'first_name', $post->post_author ) . ' ' . get_the_author_meta( 'last_name', $post->post_author); ?><span> | </span><?php print_r(get_the_author_meta('user_description', $post->post_author)); ?></p>
    <p><?php echo get_the_date('F j, Y'); ?></p>
  </div>
</section>
<article @php post_class("section-margin-top") @endphp>
  <div class="entry-content container">
    <div class="socialBar fLeft">
      <?php
        while(has_sub_field('social_medias_info', 'option')):
      ?>
      <div class="social"><i class="<?php echo get_sub_field('social_media_info_icon', 'option'); ?>"></i></div>
      <?php endwhile; ?>
    </div>
    <div class="inner-container fLeft">
      @php the_content() @endphp
    </div>
    <div class="sidebar fRight">
      <div class="sidebar-subscribe"><?php echo get_field("sidebar_subscribe", 'option'); ?></div>
      <?php
        while(has_sub_field('sidebar_images', 'option')):
          $linkTarget = get_sub_field("sidebar_image_link_open_new_tab", 'option');
          $openTab = ($linkTarget) ? "_blank" : "_self";
          $image = get_sub_field('sidebar_image', 'option');
      ?>
      <a href="<?php echo get_sub_field("sidebar_image_link", 'option'); ?>" target="<?php echo $openTab; ?>">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="img-responsive" />
      </a>
      <?php endwhile; ?>
    </div>
  </div>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
