<?php
/**
 * Database Setup and Custom Tables
 */

function eljin_create_tables() {
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // Franchise applications table
    $franchise_table = $wpdb->prefix . 'eljin_franchise_applications';
    $franchise_sql = "CREATE TABLE $franchise_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        full_name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(50) NOT NULL,
        location varchar(255) NOT NULL,
        investment_capacity varchar(50) NOT NULL,
        experience text,
        message text NOT NULL,
        application_date datetime NOT NULL,
        status varchar(20) DEFAULT 'pending',
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    // Career applications table
    $career_apps_table = $wpdb->prefix . 'eljin_career_applications';
    $career_sql = "CREATE TABLE $career_apps_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        position_id mediumint(9) NOT NULL,
        applicant_name varchar(100) NOT NULL,
        applicant_email varchar(100) NOT NULL,
        applicant_phone varchar(50) NOT NULL,
        resume_url varchar(255),
        cover_letter text,
        application_date datetime NOT NULL,
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($franchise_sql);
    dbDelta($career_sql);
    
    // Add version option
    add_option('eljin_db_version', '1.0');
}

// Hook for database updates
function eljin_update_db_check() {
    if (get_option('eljin_db_version') != '1.0') {
        eljin_create_tables();
    }
}
add_action('plugins_loaded', 'eljin_update_db_check');

// Franchise application form handler
function eljin_franchise_application_form() {
    ob_start();
    ?>
    <form id="franchise-application" class="franchise-form" method="post">
        <?php wp_nonce_field('franchise_application', 'franchise_nonce'); ?>
        
        <div class="form-group">
            <label for="full_name">Full Name *</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
            <label for="location">Proposed Location *</label>
            <input type="text" id="location" name="location" required>
        </div>
        
        <div class="form-group">
            <label for="investment_capacity">Investment Capacity *</label>
            <select id="investment_capacity" name="investment_capacity" required>
                <option value="">Select Range</option>
                <option value="50k-100k">$50,000 - $100,000</option>
                <option value="100k-200k">$100,000 - $200,000</option>
                <option value="200k-500k">$200,000 - $500,000</option>
                <option value="500k+">$500,000+</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="experience">Previous Business Experience</label>
            <textarea id="experience" name="experience" rows="4"></textarea>
        </div>
        
        <div class="form-group">
            <label for="message">Why do you want to franchise with ELJIN? *</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        
        <button type="submit" class="cta-button">Submit Application</button>
    </form>
    
    <script>
    jQuery(document).ready(function($) {
        $('#franchise-application').on('submit', function(e) {
            e.preventDefault();
            
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Submitting...');
            
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: $(this).serialize() + '&action=submit_franchise_application',
                success: function(response) {
                    if (response.success) {
                        alert('Thank you for your application! We will contact you soon.');
                        $('#franchise-application')[0].reset();
                    } else {
                        alert('Error: ' + response.data);
                    }
                    submitButton.prop('disabled', false).text('Submit Application');
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                    submitButton.prop('disabled', false).text('Submit Application');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('franchise_application', 'eljin_franchise_application_form');

// Handle franchise application submission
function eljin_handle_franchise_application() {
    check_ajax_referer('franchise_application', 'franchise_nonce');
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'eljin_franchise_applications';
    
    // Sanitize and validate data
    $full_name = sanitize_text_field($_POST['full_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $location = sanitize_text_field($_POST['location']);
    $investment_capacity = sanitize_text_field($_POST['investment_capacity']);
    $experience = sanitize_textarea_field($_POST['experience']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validate required fields
    if (empty($full_name) || empty($email) || empty($phone) || empty($location) || empty($investment_capacity) || empty($message)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    
    // Insert application
    $result = $wpdb->insert(
        $table_name,
        array(
            'full_name' => $full_name,
            'email' => $email,
            'phone' => $phone,
            'location' => $location,
            'investment_capacity' => $investment_capacity,
            'experience' => $experience,
            'message' => $message,
            'application_date' => current_time('mysql'),
            'status' => 'pending'
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($result) {
        // Send email notification to admin
        $admin_email = get_option('admin_email');
        $subject = 'New Franchise Application - ELJIN BWSUPERBAKESHOP';
        
        $email_message = "New franchise application received:\n\n";
        $email_message .= "Name: $full_name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Phone: $phone\n";
        $email_message .= "Location: $location\n";
        $email_message .= "Investment Capacity: $investment_capacity\n";
        $email_message .= "Experience: $experience\n\n";
        $email_message .= "Message: $message\n\n";
        $email_message .= "Application Date: " . current_time('mysql') . "\n";
        
        wp_mail($admin_email, $subject, $email_message);
        
        // Send confirmation email to applicant
        $applicant_subject = 'Thank you for your franchise application - ELJIN BWSUPERBAKESHOP';
        $applicant_message = "Dear $full_name,\n\n";
        $applicant_message .= "Thank you for your interest in ELJIN BWSUPERBAKESHOP franchise opportunity.\n\n";
        $applicant_message .= "We have received your application and will review it carefully. ";
        $applicant_message .= "Our team will contact you within 5-7 business days.\n\n";
        $applicant_message .= "Best regards,\nELJIN BWSUPERBAKESHOP Team";
        
        wp_mail($email, $applicant_subject, $applicant_message);
        
        wp_send_json_success('Application submitted successfully');
    } else {
        wp_send_json_error('Failed to submit application. Please try again.');
    }
}
add_action('wp_ajax_submit_franchise_application', 'eljin_handle_franchise_application');
add_action('wp_ajax_nopriv_submit_franchise_application', 'eljin_handle_franchise_application');

// Career application form
function eljin_career_application_form() {
    ob_start();
    ?>
    <form id="career-application" class="career-form" enctype="multipart/form-data">
        <?php wp_nonce_field('career_application', 'career_nonce'); ?>
        <input type="hidden" name="position_id" value="<?php echo get_the_ID(); ?>">
        
        <div class="form-group">
            <label for="applicant_name">Full Name *</label>
            <input type="text" id="applicant_name" name="applicant_name" required>
        </div>
        
        <div class="form-group">
            <label for="applicant_email">Email *</label>
            <input type="email" id="applicant_email" name="applicant_email" required>
        </div>
        
        <div class="form-group">
            <label for="applicant_phone">Phone *</label>
            <input type="tel" id="applicant_phone" name="applicant_phone" required>
        </div>
        
        <div class="form-group">
            <label for="resume">Resume (PDF only) *</label>
            <input type="file" id="resume" name="resume" accept=".pdf" required>
        </div>
        
        <div class="form-group">
            <label for="cover_letter">Cover Letter</label>
            <textarea id="cover_letter" name="cover_letter" rows="5"></textarea>
        </div>
        
        <button type="submit" class="cta-button">Submit Application</button>
    </form>
    
    <script>
    jQuery(document).ready(function($) {
        $('#career-application').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('action', 'submit_career_application');
            
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Submitting...');
            
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert('Thank you for your application! We will review it and contact you soon.');
                        $('#career-application')[0].reset();
                    } else {
                        alert('Error: ' + response.data);
                    }
                    submitButton.prop('disabled', false).text('Submit Application');
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                    submitButton.prop('disabled', false).text('Submit Application');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('career_application', 'eljin_career_application_form');

// Handle career application submission
function eljin_handle_career_application() {
    check_ajax_referer('career_application', 'career_nonce');
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'eljin_career_applications';
    
    // Sanitize data
    $position_id = intval($_POST['position_id']);
    $applicant_name = sanitize_text_field($_POST['applicant_name']);
    $applicant_email = sanitize_email($_POST['applicant_email']);
    $applicant_phone = sanitize_text_field($_POST['applicant_phone']);
    $cover_letter = sanitize_textarea_field($_POST['cover_letter']);
    
    // Handle file upload
    $resume_url = '';
    if (!empty($_FILES['resume']['name'])) {
        $upload = wp_upload_bits($_FILES['resume']['name'], null, file_get_contents($_FILES['resume']['tmp_name']));
        
        if (!$upload['error']) {
            $resume_url = $upload['url'];
        } else {
            wp_send_json_error('Failed to upload resume: ' . $upload['error']);
        }
    }
    
    // Insert application
    $result = $wpdb->insert(
        $table_name,
        array(
            'position_id' => $position_id,
            'applicant_name' => $applicant_name,
            'applicant_email' => $applicant_email,
            'applicant_phone' => $applicant_phone,
            'resume_url' => $resume_url,
            'cover_letter' => $cover_letter,
            'application_date' => current_time('mysql'),
            'status' => 'new'
        )
    );
    
    if ($result) {
        // Send notification email
        $position_title = get_the_title($position_id);
        $admin_email = get_option('admin_email');
        $subject = "New Career Application - $position_title";
        
        $message = "New career application received:\n\n";
        $message .= "Position: $position_title\n";
        $message .= "Name: $applicant_name\n";
        $message .= "Email: $applicant_email\n";
        $message .= "Phone: $applicant_phone\n";
        $message .= "Resume: $resume_url\n\n";
        $message .= "Cover Letter:\n$cover_letter";
        
        wp_mail($admin_email, $subject, $message);
        
        wp_send_json_success('Application submitted successfully');
    } else {
        wp_send_json_error('Failed to submit application. Please try again.');
    }
}
add_action('wp_ajax_submit_career_application', 'eljin_handle_career_application');
add_action('wp_ajax_nopriv_submit_career_application', 'eljin_handle_career_application');