function eljin_career_meta_boxes() {
    add_meta_box(
        'career_details',
        'Career Details',
        'eljin_career_details_callback',
        'career',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eljin_career_meta_boxes');

function eljin_career_details_callback($post) {
    wp_nonce_field('eljin_career_details', 'eljin_career_details_nonce');
    
    $department = get_post_meta($post->ID, 'department', true);
    $location = get_post_meta($post->ID, 'location', true);
    $employment_type = get_post_meta($post->ID, 'employment_type', true);
    $salary_range = get_post_meta($post->ID, 'salary_range', true);
    $requirements = get_post_meta($post->ID, 'requirements', true);
    $benefits = get_post_meta($post->ID, 'benefits', true);
    $application_deadline = get_post_meta($post->ID, 'application_deadline', true);
    $status = get_post_meta($post->ID, 'status', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="department">Department</label></th>
            <td>
                <select id="department" name="department">
                    <option value="production" <?php selected($department, 'production'); ?>>Production</option>
                    <option value="sales" <?php selected($department, 'sales'); ?>>Sales</option>
                    <option value="marketing" <?php selected($department, 'marketing'); ?>>Marketing</option>
                    <option value="management" <?php selected($department, 'management'); ?>>Management</option>
                    <option value="operations" <?php selected($department, 'operations'); ?>>Operations</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="location">Location</label></th>
            <td><input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="employment_type">Employment Type</label></th>
            <td>
                <select id="employment_type" name="employment_type">
                    <option value="full-time" <?php selected($employment_type, 'full-time'); ?>>Full Time</option>
                    <option value="part-time" <?php selected($employment_type, 'part-time'); ?>>Part Time</option>
                    <option value="contract" <?php selected($employment_type, 'contract'); ?>>Contract</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="salary_range">Salary Range</label></th>
            <td><input type="text" id="salary_range" name="salary_range" value="<?php echo esc_attr($salary_range); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="requirements">Requirements</label></th>
            <td><?php wp_editor($requirements, 'requirements', array('textarea_rows' => 5)); ?></td>
        </tr>
        <tr>
            <th><label for="benefits">Benefits</label></th>
            <td><?php wp_editor($benefits, 'benefits', array('textarea_rows' => 5)); ?></td>
        </tr>
        <tr>
            <th><label for="application_deadline">Application Deadline</label></th>
            <td><input type="date" id="application_deadline" name="application_deadline" value="<?php echo esc_attr($application_deadline); ?>"></td>
        </tr>
        <tr>
            <th><label for="status">Status</label></th>
            <td>
                <select id="status" name="status">
                    <option value="open" <?php selected($status, 'open'); ?>>Open</option>
                    <option value="closed" <?php selected($status, 'closed'); ?>>Closed</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// Career Application Form
function eljin_career_application_form() {
    ob_start();
    ?>
    <form id="career-application" class="career-form" enctype="multipart/form-data">
        <?php wp_nonce_field('career_application', 'career_nonce'); ?>
        <input type="hidden" name="position_id" value="<?php echo get_the_ID(); ?>">
        
        <div class="form-group">
            <label for="applicant_name">Full Name</label>
            <input type="text" id="applicant_name" name="applicant_name" required>
        </div>
        
        <div class="form-group">
            <label for="applicant_email">Email</label>
            <input type="email" id="applicant_email" name="applicant_email" required>
        </div>
        
        <div class="form-group">
            <label for="applicant_phone">Phone</label>
            <input type="tel" id="applicant_phone" name="applicant_phone" required>
        </div>
        
        <div class="form-group">
            <label for="resume">Resume (PDF)</label>
            <input type="file" id="resume" name="resume" accept=".pdf" required>
        </div>
        
        <div class="form-group">
            <label for="cover_letter">Cover Letter</label>
            <textarea id="cover_letter" name="cover_letter" rows="5"></textarea>
        </div>
        
        <button type="submit" class="cta-button">Submit Application</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('career_application', 'eljin_career_application_form');