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
  <div class="related-news container">
    <h2>Related Articles</h2>
    <div class="related-news-container">
      <div class="grid">
        <?php
          wp_reset_postdata(); wp_reset_query();
          $temp_tax_query[] = array(
            'taxonomy' => 'news-filter',
            'field'    => 'name',
            'terms'    => $category,//wp_get_post_terms($post->ID, 'landing-page-templates', array("fields" => "names")),
          );
          $currentId[] = $post->ID;
          $args = array(
            'post_type'=>'news',
            'post_status' => 'publish',
            'posts_per_page'=>3,
            'orderby' => 'rand',
            'post__not_in' => $currentId,
            'tax_query'=> $temp_tax_query
          );
        $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ) { $i = 0;
          while ( $the_query->have_posts() ): $the_query->the_post();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($the_query->post->ID), "news-thumbnail");
            $categories = get_the_terms( $the_query->post->ID , 'news-filter' );
            $category = 'news';
            if ( ! empty( $categories ) ) {
              $category = esc_html( $categories[0]->name );
            }
        ?>
        <div class="inline element-item <?php echo $cat->slug; ?>">
          <div class="item">
              <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title($the_query->post->ID); ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" class="img-responsive" />
              <div class="item-content">
                  <h4><?php echo $category; ?></h4>
                  <a href="<?php echo get_permalink(); ?>" class="cta-brown"><?php echo get_the_title($the_query->post->ID); ?></a>
                  <p><?php echo get_the_excerpt($the_query->post->ID); ?></p>
              </div>
          </div>
        </div>
        <?php $i++; endwhile; } ?>
      </div>
    </div>
  </div>
</article>
