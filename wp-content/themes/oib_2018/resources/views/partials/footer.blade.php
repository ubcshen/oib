<footer class="content-info">
  <div class="container">
    <div class="copyright"><?php the_field('copyright', 'option'); ?></div>
    <div class="brand_declaration"><?php the_field('brand_declaration', 'option'); ?></div>
    <hr class="short" />
    <a href="/privacy-policy/" class="foot-link">Privacy Policy</a>
    <div class="social_medias">
      <div class="inline boldMF"><?php the_field('follow_us', 'option'); ?></div>
      <div class="inline social_icons">
        <?php while(has_sub_field('social_medias', 'option')): $image = get_sub_field('social_media_icon', 'option'); ?>
          <a class="social_icon inline" href="<?php echo get_sub_field("social_media_link", 'option'); ?>" target="_blank">
            <i class="<?php echo get_sub_field('social_media_icon', 'option'); ?>"></i>
          </a>
        <?php  endwhile; ?>
      </div>
    </div>
  </div>
</footer>
