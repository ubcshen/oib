<?php
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$incname = $term->slug;
$taxname = $term->name;
?>
<section class="section-tax-banner container hasBothbar">
  <a href="/newsroom/" class="backtonews">< Back to News</a>
  <h1><?php echo $taxname; ?></h1>
</section>
<section class="section-news-tax container">
  <div class="tabs">
    <?php wp_reset_postdata();
      $tax_query[] = array(
        'taxonomy' => 'news-filter',
        'field'    => 'slug',
        'terms'    => $incname,
      );
      $args = array(
        'post_type'=>'news',
        'post_status' => 'publish',
        'posts_per_page'=>-1,
        'orderby'=>'date',
        'tax_query'=> $tax_query
      );
      $the_query = new WP_Query( $args );
      //print_r($the_query);
      if( $the_query->have_posts() ) {
    ?>
    <div class="grid infinitescroll grid-tax">
      <?php $i = 0;
        while ( $the_query->have_posts() ): $the_query->the_post();
      ?>
        <div class="inline element-item">
          <?php load_Feature_Img_Item(".item-" . $i, get_the_ID(), "news-thumbnail"); ?>
          <div class="item item-<?php echo $i; ?>"></div>
          <?php
            $categories = get_the_terms( get_the_ID(), 'news-filter' );
            $category = 'news';
            if ( ! empty( $categories ) ) {
              $category = esc_html( $categories[0]->name );
              $categorySlug = esc_html( $categories[0]->slug );
            }
            $iid = get_primary_taxonomy_id(get_the_ID(), 'news-filter');

            if($iid!=null) $category = get_the_category_by_ID($iid);
          ?>
          <div class="item-content">
            <h4><a href="/news_categories/<?php echo strtolower($categorySlug); ?>" class="cta-brown"><?php echo $category; ?></a></h4>
            <a href="<?php echo get_permalink(); ?>" class="cta-brown"><?php echo get_the_title(); ?></a>
            <p><?php echo get_the_excerpt(); ?></p>
            <?php if(get_field("display_author", 'option')) { ?>
            <p class="author-info-item"><?php echo get_the_author_meta( 'first_name') . ' ' . get_the_author_meta( 'last_name'); ?></p>
            <?php } ?>
          </div>
        </div>
      <?php //}
      $i++; endwhile; } wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php
  load_Tax_Img(".section-subscribe", "section_subscribe_background_image", $term);
  $image = get_field('section_subscribe_book_image', $term);
?>
<section class="container section-subscribe" id="section-subscribe">
    <div class="sub_container">
        <h2><?php echo get_field("section_subscribe_title", $term); ?></h2>
        <div class="section-content"><?php echo get_field("section_subscribe_content", $term); ?></div>
    </div>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="img-responsive sub-img" />
</section>


