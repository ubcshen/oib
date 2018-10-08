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
    <div class="sidebar">
      @php dynamic_sidebar('sidebar-primary') @endphp
    </div>
  </div>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
