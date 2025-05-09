function eljin_franchise_application_form() {
    ob_start();
    ?>
    <form id="franchise-application" class="franchise-form" method="post">
        <?php wp_nonce_field('franchise_application', 'franchise_nonce'); ?>
        
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
            <label for="location">Proposed Location</label>
            <input type="text" id="location" name="location" required>
        </div>
        
        <div class="form-group">
            <label for="investment_capacity">Investment Capacity</label>
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
            <label for="message">Why do you want to franchise with ELJIN?</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        
        <button type="submit" class="cta-button">Submit Application</button>
    </form>
    
    <script>
    jQuery(document).ready(function($) {
        $('#franchise-application').on('submit', function(e) {
            e.preventDefault();
            
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
    
    $full_name = sanitize_text_field($_POST['full_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $location = sanitize_text_field($_POST['location']);
    $investment_capacity = sanitize_text_field($_POST['investment_capacity']);
    $experience = sanitize_textarea_field($_POST['experience']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Save to database
    global $wpdb;
    $table_name = $wpdb->prefix . 'eljin_franchise_applications';
    
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
        )
    );
    
    if ($result) {
        // Send email notification
        $admin_email = get_option('admin_email');
        $subject = 'New Franchise Application - ELJIN BWSUPERBAKESHOP';
        $email_message = "New franchise application received:\n\n";
        $email_message .= "Name: $full_name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Phone: $phone\n";
        $email_message .= "Location: $location\n";
        $email_message .= "Investment Capacity: $investment_capacity\n\n";
        $email_message .= "Message: $message\n";
        
        wp_mail($admin_email, $subject, $email_message);
        
        wp_send_json_success('Application submitted successfully');
    } else {
        wp_send_json_error('Failed to submit application');
    }
}
add_action('wp_ajax_submit_franchise_application', 'eljin_handle_franchise_application');
add_action('wp_ajax_nopriv_submit_franchise_application', 'eljin_handle_franchise_application');