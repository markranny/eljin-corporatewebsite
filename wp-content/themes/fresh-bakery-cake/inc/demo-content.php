<div class="theme-offer">
   <?php
     // POST and update the customizer and other related data
    if ( isset( $_POST['submit'] ) ) {

         // Check if woocommerce is installed and activated
         if (!is_plugin_active('woocommerce/woocommerce.php')) {
            // Install the plugin if it doesn't exist
            $fresh_bakery_cake_plugin_slug = 'woocommerce';
            $fresh_bakery_cake_plugin_file = 'woocommerce/woocommerce.php';

            // Check if plugin is installed
            $fresh_bakery_cake_installed_plugins = get_plugins();
            if (!isset($fresh_bakery_cake_installed_plugins[$fresh_bakery_cake_plugin_file])) {
                include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                include_once(ABSPATH . 'wp-admin/includes/file.php');
                include_once(ABSPATH . 'wp-admin/includes/misc.php');
                include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

                // Install the plugin
                $fresh_bakery_cake_upgrader = new Plugin_Upgrader();
                $fresh_bakery_cake_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
            }
            // Activate the plugin
            activate_plugin($fresh_bakery_cake_plugin_file);
        }

        // ------- Create Main Menu --------
        $fresh_bakery_cake_menuname = 'Primary Menu';
        $fresh_bakery_cake_bpmenulocation = 'primary';
        $fresh_bakery_cake_menu_exists = wp_get_nav_menu_object( $fresh_bakery_cake_menuname );
    
        if ( !$fresh_bakery_cake_menu_exists ) {
            $fresh_bakery_cake_menu_id = wp_create_nav_menu( $fresh_bakery_cake_menuname );

            // Create Home Page
            $fresh_bakery_cake_home_title = 'Home';
            $fresh_bakery_cake_home = array(
                'post_type'    => 'page',
                'post_title'   => $fresh_bakery_cake_home_title,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'home'
            );
            $fresh_bakery_cake_home_id = wp_insert_post($fresh_bakery_cake_home);
            // Assign Home Page Template
            add_post_meta($fresh_bakery_cake_home_id, '_wp_page_template', '/template-home-page.php');
            // Update options to set Home Page as the front page
            update_option('page_on_front', $fresh_bakery_cake_home_id);
            update_option('show_on_front', 'page');
            // Add Home Page to Menu
            wp_update_nav_menu_item($fresh_bakery_cake_menu_id, 0, array(
                'menu-item-title' => __('Home', 'fresh-bakery-cake'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $fresh_bakery_cake_home_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create a new Page 
            $fresh_bakery_cake_pages_title = 'Pages';
            $fresh_bakery_cake_pages_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $fresh_bakery_cake_pages = array(
                'post_type'    => 'page',
                'post_title'   => $fresh_bakery_cake_pages_title,
                'post_content' => $fresh_bakery_cake_pages_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'pages'
            );
            $fresh_bakery_cake_pages_id = wp_insert_post($fresh_bakery_cake_pages);
            // Add Pages Page to Menu
            wp_update_nav_menu_item($fresh_bakery_cake_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'fresh-bakery-cake'),
                'menu-item-classes' => 'pages',
                'menu-item-url' => home_url('/pages/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $fresh_bakery_cake_pages_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create About Us Page with Dummy Content
            $fresh_bakery_cake_about_title = 'About Us';
            $fresh_bakery_cake_about_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $fresh_bakery_cake_about = array(
                'post_type'    => 'page',
                'post_title'   => $fresh_bakery_cake_about_title,
                'post_content' => $fresh_bakery_cake_about_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'about-us'
            );
            $fresh_bakery_cake_about_id = wp_insert_post($fresh_bakery_cake_about);
            // Add About Us Page to Menu
            wp_update_nav_menu_item($fresh_bakery_cake_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'fresh-bakery-cake'),
                'menu-item-classes' => 'about-us',
                'menu-item-url' => home_url('/about-us/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $fresh_bakery_cake_about_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Assign the menu to the primary location if not already set
            if ( ! has_nav_menu( $fresh_bakery_cake_bpmenulocation ) ) {
                $fresh_bakery_cake_locations = get_theme_mod( 'nav_menu_locations' );
                if ( empty( $fresh_bakery_cake_locations ) ) {
                    $fresh_bakery_cake_locations = array();
                }
                $fresh_bakery_cake_locations[ $fresh_bakery_cake_bpmenulocation ] = $fresh_bakery_cake_menu_id;
                set_theme_mod( 'nav_menu_locations', $fresh_bakery_cake_locations );
            }
        }

        //Logo
        set_theme_mod( 'fresh_bakery_cake_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Header
        set_theme_mod( 'fresh_bakery_cake_phone_number', '123 456 7890');
        set_theme_mod( 'fresh_bakery_cake_email_address', 'example@gmail.com');

        //Slider
        set_theme_mod( 'fresh_bakery_cake_slider_top_text', 'We Have Best');
        set_theme_mod( 'fresh_bakery_cake_button_text', 'Read More');
        set_theme_mod( 'fresh_bakery_cake_slider_btn_link', '#');
        set_theme_mod( 'fresh_bakery_cake_product_sale_discount_title', '10% Special Discount');
        set_theme_mod( 'fresh_bakery_cake_product_btn_text', 'Read More');
        set_theme_mod( 'fresh_bakery_cake_discount_sale_img', esc_url( get_template_directory_uri().'/images/slider-right.png'));

        // Create or retrieve the 'Bakery' category
        $fresh_bakery_cake_featured_category_id = wp_create_category('Bakery');
        set_theme_mod('fresh_bakery_cake_slidersection', $fresh_bakery_cake_featured_category_id);

        // Define post titles
        $fresh_bakery_cake_titles = array(
            'BAKERY WORDPRESS THEME', 
            'FRESHLY BAKED DELIGHTS JUST FOR YOU', 
            'CELEBRATE EVERY MOMENT WITH OUR CAKES.'
        );        

        // Define post content
        $fresh_bakery_cake_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';

        // Loop to create posts and set their properties
        foreach ($fresh_bakery_cake_titles as $fresh_bakery_cake_index => $fresh_bakery_cake_title) {
            // Set theme mod for the post title
            set_theme_mod('fresh_bakery_cake_title' . ($fresh_bakery_cake_index + 1), $fresh_bakery_cake_title);

            // Create post data array
            $fresh_bakery_cake_my_post = array(
                'post_title'    => wp_strip_all_tags($fresh_bakery_cake_title),
                'post_content'  => $fresh_bakery_cake_content,
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array($fresh_bakery_cake_featured_category_id),
            );

            // Insert post into the database
            $fresh_bakery_cake_post_id = wp_insert_post($fresh_bakery_cake_my_post);

            // Check if post creation was successful
            if (!is_wp_error($fresh_bakery_cake_post_id)) {
                // Define the image URL for the current post
                $fresh_bakery_cake_image_url = get_template_directory_uri() . '/images/slider' . ($fresh_bakery_cake_index + 1) . '.png';

                // Attempt to sideload the image
                $fresh_bakery_cake_image_id = media_sideload_image($fresh_bakery_cake_image_url, $fresh_bakery_cake_post_id, null, 'id');

                if (!is_wp_error($fresh_bakery_cake_image_id)) {
                    // Set the featured image for the post
                    set_post_thumbnail($fresh_bakery_cake_post_id, $fresh_bakery_cake_image_id);
                } else {
                    error_log('Failed to set post thumbnail for post ID: ' . $fresh_bakery_cake_post_id . '. Error: ' . $fresh_bakery_cake_image_id->get_error_message());
                }
            } else {
                error_log('Failed to create post: ' . $fresh_bakery_cake_title . '. Error: ' . $fresh_bakery_cake_post_id->get_error_message());
            }
        }

        //Product Category
        set_theme_mod( 'fresh_bakery_cake_product_title', 'Best Seller');
        set_theme_mod( 'fresh_bakery_cake_pro_view_btn_text', 'View All');
        set_theme_mod( 'fresh_bakery_cake_pro_view_btn_link', '#');

         // Set the theme mod for the product category
         set_theme_mod('fresh_bakery_cake_hot_products_cat', 'productcategory1');

         // Define the single product category name, product titles, and tags
         $fresh_bakery_cake_category_name = 'productcategory1';
         $fresh_bakery_cake_titles = array(
             "Sweet Cakes",
             "Cupcake Queen",
             "Pumpkin Brownie",
             "Pumpkin Cupcake"
         );
 
         // Create or retrieve the product category term ID
         $fresh_bakery_cake_term = term_exists($fresh_bakery_cake_category_name, 'product_cat');
         if (!$fresh_bakery_cake_term) {
             $fresh_bakery_cake_term = wp_insert_term($fresh_bakery_cake_category_name, 'product_cat');
         }
 
         if (is_wp_error($fresh_bakery_cake_term)) {
             error_log('Error creating category: ' . $fresh_bakery_cake_term->get_error_message());
             return; // Exit if category creation fails
         }
 
         $fresh_bakery_cake_term_id = is_array($fresh_bakery_cake_term) ? $fresh_bakery_cake_term['term_id'] : $fresh_bakery_cake_term;
 
        // Define prices for the products
        $fresh_bakery_cake_prices = array(
            '7.29', 
            '5.49', 
            '7.49', 
            '6.49', 
        );

        // Loop to create 4 products for the category
        foreach ($fresh_bakery_cake_titles as $fresh_bakery_cake_index => $fresh_bakery_cake_title) {
            // Create product content
            $fresh_bakery_cake_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';

            // Create product post object
            $fresh_bakery_cake_post_id = wp_insert_post(array(
                'post_title'    => wp_strip_all_tags($fresh_bakery_cake_title),
                'post_content'  => $fresh_bakery_cake_content,
                'post_status'   => 'publish',
                'post_type'     => 'product', // Post type set to 'product'
            ));

            if (is_wp_error($fresh_bakery_cake_post_id)) {
                error_log('Error creating product: ' . $fresh_bakery_cake_post_id->get_error_message());
                continue; // Skip to the next product if creation fails
            }

            // Assign the category to the product
            wp_set_object_terms($fresh_bakery_cake_post_id, $fresh_bakery_cake_term_id, 'product_cat');

            // Set product price
            $fresh_bakery_cake_product_price = $fresh_bakery_cake_prices[$fresh_bakery_cake_index]; // Get the price for the current product
            update_post_meta($fresh_bakery_cake_post_id, '_price', $fresh_bakery_cake_product_price);
            update_post_meta($fresh_bakery_cake_post_id, '_regular_price', $fresh_bakery_cake_product_price);

            // Handle the featured image using media_sideload_image
            $fresh_bakery_cake_image_url = get_template_directory_uri() . '/images/Product' . ($fresh_bakery_cake_index + 1) . '.png';
            $fresh_bakery_cake_image_id = media_sideload_image($fresh_bakery_cake_image_url, $fresh_bakery_cake_post_id, null, 'id');

            if (!is_wp_error($fresh_bakery_cake_image_id)) {
                // Assign featured image to product
                set_post_thumbnail($fresh_bakery_cake_post_id, $fresh_bakery_cake_image_id);
            } else {
                error_log('Error downloading image for product: ' . $fresh_bakery_cake_image_id->get_error_message());
            }
        }

        //Footer Copyright Text
        set_theme_mod( 'fresh_bakery_cake_copyright_line', 'Fresh Bakery Cake WordPress Theme' );

        //Show success message and the "View Site" button
         echo '<div class="success">Demo Import Successful</div>';
    }
     ?>
    <ul>
        <li>
        <hr>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
           <!-- Show demo importer form only if it's not submitted -->
           <?php echo esc_html( 'Click on the below content to get demo content installed.', 'fresh-bakery-cake' ); ?>
          <br>
          <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'fresh-bakery-cake' ); ?></b></small>
          <br><br>

          <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
            <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','fresh-bakery-cake'); ?>" class="button button-primary button-large">
          </form>
        <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '</div>';
        }
        ?>

        <hr>
        </li>
    </ul>
 </div>