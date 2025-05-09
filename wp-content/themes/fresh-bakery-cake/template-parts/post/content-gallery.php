<?php
/**
 * @package Fresh Bakery Cake
 */
?>

<?php
    $fresh_bakery_cake_post_date = get_the_date();
    $fresh_bakery_cake_year = get_the_date('Y');
    $fresh_bakery_cake_month = get_the_date('m');

    $fresh_bakery_cake_author_id = get_the_author_meta('ID');
    $fresh_bakery_cake_author_link = esc_url(get_author_posts_url($fresh_bakery_cake_author_id));
    $fresh_bakery_cake_author_name = get_the_author();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="listarticle">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the gallery.
          if ( get_post_gallery() ) {
              echo '<div class="entry-gallery">';
              echo ( get_post_gallery() );
              echo '</div>';
          };
        };
      ?>
        <header class="entry-header">
            <h2 class="single_title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php if ('post' == get_post_type() && ( get_theme_mod('fresh_bakery_cake_metafields_date', true) || get_theme_mod('fresh_bakery_cake_metafields_comments', true) || get_theme_mod('fresh_bakery_cake_metafields_author', true) || get_theme_mod('fresh_bakery_cake_metafields_time', true))) : ?>
                <div class="postmeta">
                    <?php if (get_theme_mod('fresh_bakery_cake_metafields_date', true)) : ?>
                        <div class="post-date">
                            <a href="<?php echo esc_url(get_month_link($fresh_bakery_cake_year, $fresh_bakery_cake_month)); ?>">
                           <i class="fas fa-calendar-alt"></i> &nbsp;<?php echo esc_html($fresh_bakery_cake_post_date); ?>
                                <span class="screen-reader-text"><?php echo esc_html($fresh_bakery_cake_post_date); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>  
                    <?php if (get_theme_mod('fresh_bakery_cake_metafields_comments', true)) : ?>  
                        <div class="post-comment">&nbsp; &nbsp;
                            <a href="<?php echo esc_url(get_comments_link()); ?>">
                            <span><?php echo esc_html(get_theme_mod('fresh_bakery_cake_metabox_seperator', '|'));?></span><i class="fa fa-comment"></i> &nbsp; <?php comments_number(); ?>
                                <span class="screen-reader-text"><?php comments_number(); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (get_theme_mod('fresh_bakery_cake_metafields_author', true)) : ?>
                        <div class="post-author">&nbsp; &nbsp;
                            <a href="<?php echo $fresh_bakery_cake_author_link; ?>">
                            <span><?php echo esc_html(get_theme_mod('fresh_bakery_cake_metabox_seperator', '|'));?></span><i class="fas fa-user"></i> &nbsp; <?php echo esc_html($fresh_bakery_cake_author_name); ?>
                                <span class="screen-reader-text"><?php echo esc_html($fresh_bakery_cake_author_name); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (get_theme_mod('fresh_bakery_cake_metafields_time', true)) : ?>
                        <div class="post-time">&nbsp; &nbsp;
                            <a href="#">
                            <span><?php echo esc_html(get_theme_mod('fresh_bakery_cake_metabox_seperator', '|'));?></span><i class="fas fa-clock"></i> &nbsp; <?php echo esc_html(get_the_time()); ?>
                                <span class="screen-reader-text"><?php echo esc_html(get_the_time()); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </header>
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php if(get_theme_mod('fresh_bakery_cake_blog_post_description_option') == 'Full Content'){ ?>
                <div class="entry-content"><?php
                    $content = get_the_content(); ?>
                    <p class="mb-0"><?php echo wpautop($content); ?></p>  
                </div>
             <?php }
            if(get_theme_mod('fresh_bakery_cake_blog_post_description_option', 'Excerpt Content') == 'Excerpt Content'){ ?>
                <?php if(get_the_excerpt()) { ?>
                    <div class="entry-content"> 
                        <p class="mb-0"><?php $excerpt = get_the_excerpt(); echo esc_html($excerpt); ?></p>
                    </div>
                <?php }?>
            <?php }?> 
            <div class="rsvp_button my-2">
                <div class="rsvp_inner d-inline-block"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','fresh-bakery-cake'); ?></a></div>
            </div>       
        </div>
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fresh-bakery-cake' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'fresh-bakery-cake' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div>
        <?php endif; ?>
        <div class="clear"></div>    
    </div>
</article>

