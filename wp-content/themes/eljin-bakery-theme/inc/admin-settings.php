<?php
/**
 * Admin Settings and Options
 */

// Add admin menu
function eljin_add_admin_menu() {
    // Main menu
    add_menu_page(
        'ELJIN Settings',
        'ELJIN Settings',
        'manage_options',
        'eljin-settings',
        'eljin_settings_page',
        'dashicons-store',
        20
    );
    
    // Submenu pages
    add_submenu_page(
        'eljin-settings',
        'General Settings',
        'General',
        'manage_options',
        'eljin-settings',
        'eljin_settings_page'
    );
    
    add_submenu_page(
        'eljin-settings',
        'Franchise Applications',
        'Franchise Apps',
        'manage_options',
        'eljin-franchise-apps',
        'eljin_franchise_applications_page'
    );
    
    add_submenu_page(
        'eljin-settings',
        'Career Applications',
        'Career Apps',
        'manage_options',
        'eljin-career-apps',
        'eljin_career_applications_page'
    );
}
add_action('admin_menu', 'eljin_add_admin_menu');

// Settings page content
function eljin_settings_page() {
    ?>
    <div class="wrap">
        <h1>ELJIN BWSUPERBAKESHOP Settings</h1>
        
        <?php settings_errors(); ?>
        
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('eljin_settings');
            do_settings_sections('eljin-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function eljin_register_settings() {
    // Register settings
    register_setting('eljin_settings', 'eljin_banner_image');
    register_setting('eljin_settings', 'eljin_hero_title');
    register_setting('eljin_settings', 'eljin_hero_subtitle');
    register_setting('eljin_settings', 'eljin_about_description');
    register_setting('eljin_settings', 'eljin_google_maps_api');
    
    // General settings section
    add_settings_section(
        'eljin_general_settings',
        'General Settings',
        'eljin_general_settings_callback',
        'eljin-settings'
    );
    
    // Homepage settings section
    add_settings_section(
        'eljin_homepage_settings',
        'Homepage Settings',
        'eljin_homepage_settings_callback',
        'eljin-settings'
    );
    
    // API settings section
    add_settings_section(
        'eljin_api_settings',
        'API Settings',
        'eljin_api_settings_callback',
        'eljin-settings'
    );
    
    // General fields
    add_settings_field(
        'eljin_banner_image',
        'Homepage Banner Image',
        'eljin_banner_image_callback',
        'eljin-settings',
        'eljin_homepage_settings'
    );
    
    add_settings_field(
        'eljin_hero_title',
        'Hero Title',
        'eljin_hero_title_callback',
        'eljin-settings',
        'eljin_homepage_settings'
    );
    
    add_settings_field(
        'eljin_hero_subtitle',
        'Hero Subtitle',
        'eljin_hero_subtitle_callback',
        'eljin-settings',
        'eljin_homepage_settings'
    );
    
    add_settings_field(
        'eljin_about_description',
        'About Us Description',
        'eljin_about_description_callback',
        'eljin-settings',
        'eljin_general_settings'
    );
    
    add_settings_field(
        'eljin_google_maps_api',
        'Google Maps API Key',
        'eljin_google_maps_api_callback',
        'eljin-settings',
        'eljin_api_settings'
    );
}
add_action('admin_init', 'eljin_register_settings');

// Settings callbacks
function eljin_general_settings_callback() {
    echo '<p>Configure general settings for your bakery website.</p>';
}

function eljin_homepage_settings_callback() {
    echo '<p>Customize your homepage content.</p>';
}

function eljin_api_settings_callback() {
    echo '<p>API keys and integration settings.</p>';
}

function eljin_banner_image_callback() {
    $banner_image = get_option('eljin_banner_image');
    ?>
    <input type="url" name="eljin_banner_image" id="eljin_banner_image" value="<?php echo esc_attr($banner_image); ?>" class="regular-text">
    <input type="button" class="button button-secondary" value="Upload Image" id="upload-banner">
    <?php if ($banner_image) : ?>
        <div style="margin-top: 10px;">
            <img src="<?php echo esc_url($banner_image); ?>" style="max-width: 300px; height: auto;">
        </div>
    <?php endif; ?>
    <p class="description">Upload or select a banner image for the homepage.</p>
    <?php
}

function eljin_hero_title_callback() {
    $hero_title = get_option('eljin_hero_title', 'ELJIN BWSUPERBAKESHOP');
    ?>
    <input type="text" name="eljin_hero_title" value="<?php echo esc_attr($hero_title); ?>" class="regular-text">
    <?php
}

function eljin_hero_subtitle_callback() {
    $hero_subtitle = get_option('eljin_hero_subtitle', 'Crafting Moments of Pure Delight');
    ?>
    <input type="text" name="eljin_hero_subtitle" value="<?php echo esc_attr($hero_subtitle); ?>" class="regular-text">
    <?php
}

function eljin_about_description_callback() {
    $about_description = get_option('eljin_about_description');
    ?>
    <textarea name="eljin_about_description" rows="5" cols="50" class="large-text"><?php echo esc_textarea($about_description); ?></textarea>
    <p class="description">Brief description for the About Us section.</p>
    <?php
}

function eljin_google_maps_api_callback() {
    $api_key = get_option('eljin_google_maps_api');
    ?>
    <input type="text" name="eljin_google_maps_api" value="<?php echo esc_attr($api_key); ?>" class="regular-text">
    <p class="description">Enter your Google Maps API key for location features.</p>
    <?php
}

// Franchise applications page
function eljin_franchise_applications_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'eljin_franchise_applications';
    
    // Handle status updates
    if (isset($_POST['update_status']) && isset($_POST['application_id'])) {
        $application_id = intval($_POST['application_id']);
        $new_status = sanitize_text_field($_POST['status']);
        
        $wpdb->update(
            $table_name,
            array('status' => $new_status),
            array('id' => $application_id)
        );
    }
    
    // Get applications
    $applications = $wpdb->get_results("SELECT * FROM $table_name ORDER BY application_date DESC");
    ?>
    <div class="wrap">
        <h1>Franchise Applications</h1>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Investment Capacity</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app) : ?>
                    <tr>
                        <td><?php echo esc_html($app->full_name); ?></td>
                        <td><?php echo esc_html($app->email); ?></td>
                        <td><?php echo esc_html($app->phone); ?></td>
                        <td><?php echo esc_html($app->location); ?></td>
                        <td><?php echo esc_html($app->investment_capacity); ?></td>
                        <td><?php echo esc_html($app->application_date); ?></td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="application_id" value="<?php echo esc_attr($app->id); ?>">
                                <select name="status">
                                    <option value="pending" <?php selected($app->status, 'pending'); ?>>Pending</option>
                                    <option value="reviewing" <?php selected($app->status, 'reviewing'); ?>>Reviewing</option>
                                    <option value="approved" <?php selected($app->status, 'approved'); ?>>Approved</option>
                                    <option value="rejected" <?php selected($app->status, 'rejected'); ?>>Rejected</option>
                                </select>
                                <input type="submit" name="update_status" value="Update" class="button button-small">
                            </form>
                        </td>
                        <td>
                            <a href="#" class="button button-small view-details" data-id="<?php echo esc_attr($app->id); ?>">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Details Modal -->
        <div id="application-details-modal" style="display: none;">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
    <?php
}

// Career applications page
function eljin_career_applications_page() {
    // Similar to franchise applications page
    echo '<div class="wrap"><h1>Career Applications</h1><p>Career applications will be displayed here.</p></div>';
}

// Dashboard widget
function eljin_dashboard_widgets() {
    wp_add_dashboard_widget(
        'eljin_overview',
        'ELJIN Bakery Overview',
        'eljin_dashboard_overview'
    );
}
add_action('wp_dashboard_setup', 'eljin_dashboard_widgets');

function eljin_dashboard_overview() {
    global $wpdb;
    
    // Get statistics
    $total_products = wp_count_posts('product')->publish;
    $featured_products = get_posts(array(
        'post_type' => 'product',
        'meta_key' => 'featured',
        'meta_value' => 'yes',
        'numberposts' => -1
    ));
    $total_featured = count($featured_products);
    
    $total_locations = wp_count_posts('location')->publish;
    $open_positions = get_posts(array(
        'post_type' => 'career',
        'meta_key' => 'status',
        'meta_value' => 'open',
        'numberposts' => -1
    ));
    $total_open_positions = count($open_positions);
    
    // Get pending applications
    $franchise_table = $wpdb->prefix . 'eljin_franchise_applications';
    $pending_franchises = $wpdb->get_var("SELECT COUNT(*) FROM $franchise_table WHERE status = 'pending'");
    ?>
    <div class="eljin-dashboard-overview">
        <div class="dashboard-stat">
            <h4>Total Products</h4>
            <p class="stat-number"><?php echo esc_html($total_products); ?></p>
        </div>
        <div class="dashboard-stat">
            <h4>Featured Products</h4>
            <p class="stat-number"><?php echo esc_html($total_featured); ?></p>
        </div>
        <div class="dashboard-stat">
            <h4>Store Locations</h4>
            <p class="stat-number"><?php echo esc_html($total_locations); ?></p>
        </div>
        <div class="dashboard-stat">
            <h4>Open Positions</h4>
            <p class="stat-number"><?php echo esc_html($total_open_positions); ?></p>
        </div>
        <div class="dashboard-stat">
            <h4>Pending Franchise Apps</h4>
            <p class="stat-number"><?php echo esc_html($pending_franchises); ?></p>
        </div>
    </div>
    
    <style>
    .eljin-dashboard-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    .dashboard-stat {
        background: #f5f5f5;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
    }
    .stat-number {
        font-size: 24px;
        font-weight: bold;
        color: #8B4513;
        margin: 10px 0;
    }
    </style>
    <?php
}