<?php
$args = array(
  'numberposts' => 1,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'news',
  'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args );
//$categories = get_the_category();
//print_r($recent_posts);
//if( $recent_posts->have_posts() ) {
$categories = get_the_terms( $recent_posts[0]["ID"] , 'news-filter' );
$category = 'news';
if ( ! empty( $categories ) ) {
  $category = esc_html( $categories[0]->name );
}
?>
<section class="section-recent-post section-header">
  <?php load_Feature_Img(".section-recent-post", $recent_posts[0]["ID"]); ?>
  <div class="container white-bg banner-content">
    <div class="cta-brown"><?php echo $category; ?></div>
    <h1><a href="<?php echo get_permalink($recent_posts[0]["ID"]); ?>"><?php echo get_the_title($recent_posts[0]["ID"]); ?></a></h1>
    <p><?php echo get_the_excerpt($recent_posts[0]["ID"]); ?></p>
    <p class="author-info"><?php if(get_field("display_author", 'option')) { ?>Wrtitten by <?php echo get_the_author_meta( 'first_name', $recent_posts[0]["post_author"] ) . ' ' . get_the_author_meta( 'last_name', $recent_posts[0]["post_author"] ); ?><span> | </span><?php } ?><?php echo get_the_date('F j, Y', $recent_posts[0]["ID"]); ?></p>
  </div>
</section>
<section class="section-news container section-margin-top">
  <div class="tabs">
    <?php
      $resource = get_terms('news-filter',  array(
        'orderby'    => 'term_order',
        'order' => 'ASC',
      ));
    ?>
    <div class="fliter-btns-group">
      <?php $filter_text = '<div class="inline tab tab-active" data-filter="*">All Topics</div>';
      foreach($resource as $c) {
        $filter_text .= '<div class="inline tab" data-filter=".' . $c->slug. '">' . $c->name . '</div>';
      } echo $filter_text; ?>
    </div>
    <?php
      global $paged;
      if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
      $args = array(
        'post_type'=>'news',
        'post_status' => 'publish',
        'posts_per_page'=>-1,
        'paged'=>$paged,
        'orderby'=>'date',
      );
      $the_query = new WP_Query( $args );
      if( $the_query->have_posts() ) {
    ?>
    <div class="grid infinitescroll">
      <?php $i = 0;
        while ( $the_query->have_posts() ): $the_query->the_post();
          $cname= '';
          foreach (get_the_terms(get_the_ID(), 'news-filter') as $cat) {
            //$cat = get_the_terms(get_the_ID(), 'news-filter')[0];
            $cname .= $cat->slug . ' ';

          }
          //print_r($cname); $cat = get_the_terms(get_the_ID(), 'news-filter')[0];
            //$img=wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'news-thumbnail' );
      ?>
        <div class="inline element-item <?php echo $cname; ?>">
          <?php load_Feature_Img_Item(".item-" . $i, get_the_ID(), "news-thumbnail"); ?>
          <div class="item item-<?php echo $i; ?> newsitem" data-url="<?php echo get_permalink(); ?>"></div>
          <!--<img src="<?php echo $img[0]; ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" alt="news featured image" class="img-responsive featured-image" /> -->
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
      <?php $i++; endwhile; } //} ?>
    </div>
  </div>
  <div id="wp_pagination">
    <a class="next btn" href="#">Load More</a>
  </div>
</section>
<?php build_sections(); ?>
