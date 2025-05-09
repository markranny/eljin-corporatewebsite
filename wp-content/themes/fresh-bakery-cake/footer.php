<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Fresh Bakery Cake
 */
?>
    <div class="clear"></div>
    <div id="footer">
    <?php 
    $fresh_bakery_cake_footer_widget_enabled = get_theme_mod('fresh_bakery_cake_footer_widget', false);
  
    if ($fresh_bakery_cake_footer_widget_enabled !== false && $fresh_bakery_cake_footer_widget_enabled !== '') { ?>
    <div class="footer-content">
      <div class="container">
      </div>
     </div>
     <?php } ?>
        <div class="logo text-center pt-5 pt-md-5">
          <?php fresh_bakery_cake_the_custom_logo(); ?>
          <?php $fresh_bakery_cake_blog_info = get_bloginfo( 'name' ); ?>
          <?php if ( ! empty( $fresh_bakery_cake_blog_info ) ) : ?>
            <p class="site-title mt-3"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
            <?php $fresh_bakery_cake_description = get_bloginfo( 'description', 'display' );
            if ( $fresh_bakery_cake_description || is_customize_preview() ) : ?>
              <span class="site-description"><?php echo esc_html( $fresh_bakery_cake_description ); ?></span>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <div class="copywrap text-center">
          <p>
          <a href="<?php 
            $fresh_bakery_cake_copyright_link = get_theme_mod('fresh_bakery_cake_copyright_link', '');
            if (empty($fresh_bakery_cake_copyright_link)) {
                echo esc_url('https://www.theclassictemplates.com/products/free-cake-shop-wordpress-theme');
            } else {
                echo esc_url($fresh_bakery_cake_copyright_link);
            } ?>" target="_blank">
            <?php echo esc_html(get_theme_mod('fresh_bakery_cake_copyright_line', __('Bakery Cake WordPress Theme', 'fresh-bakery-cake'))); ?>
          </a> 
          <?php echo esc_html('By Classic Templates', 'fresh-bakery-cake'); ?>
          </p>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>

<?php if(get_theme_mod('fresh_bakery_cake_scroll_hide',true)){ ?>
  <a id="button"><?php echo esc_html( get_theme_mod('fresh_bakery_cake_scroll_text',__('TOP', 'fresh-bakery-cake' )) ); ?></a>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>


