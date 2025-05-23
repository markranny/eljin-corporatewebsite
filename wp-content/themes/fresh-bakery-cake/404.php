<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Fresh Bakery Cake
 */

get_header(); ?>

<div class="container">
    <div id="content" class="contentsecwrap">
        <section class="site-main">
            <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'fresh-bakery-cake' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'fresh-bakery-cake' ); ?></p>
            </div>
        </section>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>