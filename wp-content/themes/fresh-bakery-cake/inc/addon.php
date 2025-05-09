<?php
/*
 * @package Fresh Bakery Cake
 */

function fresh_bakery_cake_admin_enqueue_scripts() {
    wp_enqueue_style( 'fresh-bakery-cake-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'fresh_bakery_cake_admin_enqueue_scripts' );

add_action( 'admin_init', 'fresh_bakery_cake_options' );

function fresh_bakery_cake_options() {
    global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        // Theme activated — future actions can go here, like setting theme mods or showing notices.
    }
}

function fresh_bakery_cake_theme_info_menu_link() {

    $fresh_bakery_cake_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'fresh-bakery-cake' ), $fresh_bakery_cake_theme->get( 'Name' ), $fresh_bakery_cake_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'fresh-bakery-cake' ),'edit_theme_options','fresh-bakery-cake','fresh_bakery_cake_theme_info_page'
    );
    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'fresh-bakery-cake' ),
        esc_html__( 'Theme Demo Import', 'fresh-bakery-cake' ),
        'edit_theme_options',
        'fresh-bakery-cake-demo',
        'fresh_bakery_cake_demo_content_page'
    );
}
add_action( 'admin_menu', 'fresh_bakery_cake_theme_info_menu_link' );

function fresh_bakery_cake_theme_info_page() {

    $fresh_bakery_cake_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'fresh-bakery-cake' ), esc_html($fresh_bakery_cake_theme->get( 'Name' )), esc_html($fresh_bakery_cake_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'fresh-bakery-cake' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'fresh-bakery-cake' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( FRESH_BAKERY_CAKE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'fresh-bakery-cake' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'fresh-bakery-cake' ); ?></p>
                <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'fresh-bakery-cake' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'fresh-bakery-cake' ); ?></p>
                <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'fresh-bakery-cake' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'fresh-bakery-cake' ); ?></p>
                <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'fresh-bakery-cake' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'fresh-bakery-cake' ); ?></p>
                <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'fresh-bakery-cake' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'fresh-bakery-cake' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'fresh-bakery-cake' ); ?></p>
                <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'fresh-bakery-cake' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'fresh-bakery-cake' ),
        esc_html($fresh_bakery_cake_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'fresh-bakery-cake' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($fresh_bakery_cake_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $fresh_bakery_cake_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'fresh-bakery-cake'); ?>"/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'fresh-bakery-cake' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'fresh-bakery-cake' ),esc_html($fresh_bakery_cake_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'fresh-bakery-cake' ); ?></a>
                        <a href="<?php echo esc_url( FRESH_BAKERY_CAKE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'fresh-bakery-cake' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'fresh-bakery-cake' ),
            esc_html($fresh_bakery_cake_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'fresh-bakery-cake' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( FRESH_BAKERY_CAKE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'fresh-bakery-cake' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'fresh-bakery-cake' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function fresh_bakery_cake_demo_content_page() {

    $fresh_bakery_cake_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Fresh Bakery Cake', 'fresh-bakery-cake' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'fresh-bakery-cake' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the demo importer button and click on it to initiate the importation of all the demo content.', 'fresh-bakery-cake' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
