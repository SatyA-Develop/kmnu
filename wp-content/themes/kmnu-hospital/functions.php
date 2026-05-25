<?php
/**
 * kmnu hospital theme functions and definitions
 */

if (!function_exists('kmnu_hospital_setup')):
    function kmnu_hospital_setup()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        register_nav_menus(array(
            'menu-1' => esc_html__('Primary Menu', 'kmnu-hospital'),
        ));
    }
endif;
add_action('after_setup_theme', 'kmnu_hospital_setup');

/**
 * Enqueue scripts and styles.
 */
function kmnu_hospital_scripts()
{
    wp_enqueue_style('kmnu-hospital-style', get_stylesheet_uri(), array(), time());
}
add_action('wp_enqueue_scripts', 'kmnu_hospital_scripts');

/**
 * Shared blue page banner used across listing and single templates.
 */
function kmnu_page_banner($args = array())
{
    $args = wp_parse_args($args, array(
        'class'     => '',
        'title'     => '',
        'subtitle'  => '',
        'meta'      => '',
        'wave_fill' => '#ffffff',
    ));

    $classes = trim('kmnu-standard-hero ' . $args['class']);
    ?>
    <section class="<?php echo esc_attr($classes); ?>">
        <div class="container">
            <?php if (!empty($args['meta'])) : ?>
                <div class="kmnu-standard-hero-meta"><?php echo wp_kses_post($args['meta']); ?></div>
            <?php endif; ?>

            <?php if (!empty($args['title'])) : ?>
                <h1><?php echo esc_html($args['title']); ?></h1>
            <?php endif; ?>

            <?php if (!empty($args['subtitle'])) : ?>
                <p><?php echo esc_html($args['subtitle']); ?></p>
            <?php endif; ?>
        </div>
        <div class="hero-shape kmnu-standard-hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path fill="<?php echo esc_attr($args['wave_fill']); ?>" fill-opacity="1" d="M0,64L48,74.7C96,85,192,107,288,106.7C384,107,480,85,576,80C672,75,768,85,864,96C960,107,1056,117,1152,96C1248,75,1344,21,1392,0L1440,0L1440,120L0,120Z"></path>
            </svg>
        </div>
    </section>
    <?php
}

/**
 * Use the classic/custom WordPress editor instead of Gutenberg.
 * Existing content is left untouched; this only changes the admin editing UI.
 */
function kmnu_use_classic_editor($use_block_editor, $post_type)
{
    return false;
}
add_filter('use_block_editor_for_post_type', 'kmnu_use_classic_editor', 10, 2);

function kmnu_use_classic_editor_for_posts($use_block_editor, $post)
{
    return false;
}
add_filter('use_block_editor_for_post', 'kmnu_use_classic_editor_for_posts', 10, 2);

/**
 * Register Custom Post Type: Departments
 */
function kmnu_register_departments_cpt()
{
    $labels = array(
        'name' => 'Departments',
        'singular_name' => 'Department',
        'menu_name' => 'Departments',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Department',
        'edit_item' => 'Edit Department',
        'new_item' => 'New Department',
        'view_item' => 'View Department',
        'all_items' => 'All Departments',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-category',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'specialities', 'with_front' => false),
    );

    register_post_type('departments', $args);
}
add_action('init', 'kmnu_register_departments_cpt');

function kmnu_redirect_legacy_department_urls()
{
    if (!is_404()) {
        return;
    }

    $path = trim((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $home_path = trim((string) parse_url(home_url('/'), PHP_URL_PATH), '/');
    if ($home_path && strpos($path, $home_path . '/') === 0) {
        $path = substr($path, strlen($home_path) + 1);
    }

    if (strpos($path, 'departments/') !== 0) {
        return;
    }

    $slug = sanitize_title(basename($path));
    if (!$slug) {
        return;
    }

    $department = get_page_by_path($slug, OBJECT, 'departments');
    if ($department) {
        wp_safe_redirect(get_permalink($department), 301);
        exit;
    }
}
add_action('template_redirect', 'kmnu_redirect_legacy_department_urls');

/**
 * Register Custom Post Type: Doctors
 */
function kmnu_register_doctors_cpt()
{
    $labels = array(
        'name' => 'Doctors',
        'singular_name' => 'Doctor',
        'menu_name' => 'Doctors',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Doctor',
        'edit_item' => 'Edit Doctor',
        'new_item' => 'New Doctor',
        'view_item' => 'View Doctor',
        'all_items' => 'All Doctors',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'taxonomies' => array('specialization'),
    );

    register_post_type('doctors', $args);
}
add_action('init', 'kmnu_register_doctors_cpt');

/**
 * Register Custom Post Type: Locations
 */
function kmnu_register_locations_cpt()
{
    $labels = array(
        'name' => 'Locations',
        'singular_name' => 'Location',
        'menu_name' => 'Locations',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Location',
        'edit_item' => 'Edit Location',
        'new_item' => 'New Location',
        'view_item' => 'View Location',
        'all_items' => 'All Locations',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-location',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );

    register_post_type('locations', $args);
}
add_action('init', 'kmnu_register_locations_cpt');

/**
 * Register Custom Post Type: Preventive Health Checkups
 */
function kmnu_register_checkups_cpt()
{
    $labels = array(
        'name' => 'Health Checkups',
        'singular_name' => 'Health Checkup',
        'menu_name' => 'Health Checkups',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Checkup',
        'edit_item' => 'Edit Checkup',
        'new_item' => 'New Checkup',
        'view_item' => 'View Checkup',
        'all_items' => 'All Checkups',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'health-package', 'with_front' => false),
    );

    register_post_type('preventive_checkup', $args);
}
add_action('init', 'kmnu_register_checkups_cpt');

/**
 * Register Specialization Taxonomy
 */
function kmnu_register_specialization_taxonomy()
{
    $labels = array(
        'name' => 'Specializations',
        'singular_name' => 'Specialization',
        'search_items' => 'Search Specializations',
        'all_items' => 'All Specializations',
        'parent_item' => 'Parent Specialization',
        'parent_item_colon' => 'Parent Specialization:',
        'edit_item' => 'Edit Specialization',
        'update_item' => 'Update Specialization',
        'add_new_item' => 'Add New Specialization',
        'new_item_name' => 'New Specialization Name',
        'menu_name' => 'Specializations',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'specialization'),
        'show_in_rest' => true,
    );

    register_taxonomy('specialization', array('doctors'), $args);
}
add_action('init', 'kmnu_register_specialization_taxonomy');

function kmnu_get_department_specialization_term_id($department_id)
{
    $department = get_post($department_id);
    if (!$department || $department->post_type !== 'departments') {
        return 0;
    }

    $name = trim(wp_strip_all_tags($department->post_title));
    if ($name === '') {
        return 0;
    }

    $slug = sanitize_title($name);
    $term = term_exists($name, 'specialization');
    if (!$term) {
        $term = term_exists($slug, 'specialization');
    }
    if (!$term) {
        $term = wp_insert_term($name, 'specialization', array('slug' => $slug));
    }
    if (is_wp_error($term)) {
        return 0;
    }

    return is_array($term) ? (int) $term['term_id'] : (int) $term;
}

function kmnu_sync_department_doctors_to_specialization($department_id, $doctor_ids, $previous_doctor_ids = array())
{
    $term_id = kmnu_get_department_specialization_term_id($department_id);
    if (!$term_id) {
        return;
    }

    $doctor_ids = array_values(array_unique(array_map('intval', (array) $doctor_ids)));
    $previous_doctor_ids = array_values(array_unique(array_map('intval', (array) $previous_doctor_ids)));

    foreach ($doctor_ids as $doctor_id) {
        if (get_post_type($doctor_id) === 'doctors') {
            wp_set_object_terms($doctor_id, array($term_id), 'specialization', true);
        }
    }

    $removed_doctor_ids = array_diff($previous_doctor_ids, $doctor_ids);
    foreach ($removed_doctor_ids as $doctor_id) {
        if (get_post_type($doctor_id) === 'doctors') {
            wp_remove_object_terms($doctor_id, array($term_id), 'specialization');
        }
    }
}

function kmnu_sync_doctor_departments_from_specialization($doctor_id)
{
    if (get_post_type($doctor_id) !== 'doctors') {
        return;
    }

    $doctor_terms = wp_get_object_terms($doctor_id, 'specialization', array('fields' => 'ids'));
    if (is_wp_error($doctor_terms)) {
        $doctor_terms = array();
    }
    $doctor_terms = array_map('intval', (array) $doctor_terms);

    $departments = get_posts(array(
        'post_type' => 'departments',
        'post_status' => 'any',
        'numberposts' => -1,
        'fields' => 'ids',
    ));

    foreach ($departments as $department_id) {
        $term_id = kmnu_get_department_specialization_term_id($department_id);
        if (!$term_id) {
            continue;
        }

        $assigned_doctors = (array) get_post_meta($department_id, 'dept_doctors', true);
        $assigned_doctors = array_values(array_unique(array_map('intval', $assigned_doctors)));

        if (in_array($term_id, $doctor_terms, true)) {
            if (!in_array((int) $doctor_id, $assigned_doctors, true)) {
                $assigned_doctors[] = (int) $doctor_id;
                update_post_meta($department_id, 'dept_doctors', $assigned_doctors);
            }
        } elseif (in_array((int) $doctor_id, $assigned_doctors, true)) {
            $assigned_doctors = array_values(array_diff($assigned_doctors, array((int) $doctor_id)));
            update_post_meta($department_id, 'dept_doctors', $assigned_doctors);
        }
    }
}

function kmnu_sync_doctor_departments_after_specialization_change($object_id, $terms, $tt_ids, $taxonomy)
{
    if ($taxonomy === 'specialization' && get_post_type($object_id) === 'doctors') {
        kmnu_sync_doctor_departments_from_specialization($object_id);
    }
}
add_action('set_object_terms', 'kmnu_sync_doctor_departments_after_specialization_change', 10, 4);

/**
 * Register Custom Post Type: Guidance (Expert Medical Guidance)
 */
function kmnu_register_guidance_cpt()
{
    $labels = array(
        'name' => 'Guidance',
        'singular_name' => 'Guidance',
        'menu_name' => 'Expert Guidance',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Guidance',
        'edit_item' => 'Edit Guidance',
        'new_item' => 'New Guidance',
        'view_item' => 'View Guidance',
        'all_items' => 'All Guidance',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );

    register_post_type('guidance', $args);
}
add_action('init', 'kmnu_register_guidance_cpt');

/**
 * Register Custom Post Type: Success Stories
 */
function kmnu_register_stories_cpt()
{
    $labels = array(
        'name' => 'Success Stories',
        'singular_name' => 'Success Story',
        'menu_name' => 'Success Stories',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Success Story',
        'edit_item' => 'Edit Success Story',
        'new_item' => 'New Success Story',
        'view_item' => 'View Success Story',
        'all_items' => 'All Success Stories',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-id-alt',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );

    register_post_type('stories', $args);
}
add_action('init', 'kmnu_register_stories_cpt');

/**
 * Register Custom Post Type: Testimonials
 */
function kmnu_register_testimonials_cpt()
{
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'menu_name' => 'Testimonials',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'all_items' => 'All Testimonials',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-testimonial',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );

    register_post_type('testimonials', $args);
}
add_action('init', 'kmnu_register_testimonials_cpt');

add_theme_support('post-thumbnails');

/**
 * Add Metaboxes for Doctors
 */
function kmnu_add_doctor_metaboxes()
{
    add_meta_box(
        'doctor_details',
        'Doctor Details',
        'kmnu_doctor_details_callback',
        'doctors',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_doctor_metaboxes');

function kmnu_doctor_details_callback($post)
{
    $qualification = get_post_meta($post->ID, 'qualification', true);
    $profile = get_post_meta($post->ID, 'profile', true);
    ?>
    <div class="doctor-meta-fields">
        <p>
            <label for="qualification"><strong>Qualification:</strong></label><br>
            <input type="text" id="qualification" name="qualification" value="<?php echo esc_attr($qualification); ?>"
                style="width:100%;" />
        </p>
        <p>
            <label for="profile_tagline"><strong>Profile Tagline/Bio:</strong></label><br>
            <textarea id="profile" name="profile" style="width:100%;"
                rows="3"><?php echo esc_textarea($profile); ?></textarea>
        </p>
    </div>
    <?php
}

function kmnu_save_doctor_meta($post_id)
{
    if (get_post_type($post_id) !== 'doctors') return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (array_key_exists('qualification', $_POST)) {
        update_post_meta($post_id, 'qualification', $_POST['qualification']);
    }
    if (array_key_exists('profile', $_POST)) {
        update_post_meta($post_id, 'profile', $_POST['profile']);
    }

    kmnu_sync_doctor_departments_from_specialization($post_id);
}
add_action('save_post_doctors', 'kmnu_save_doctor_meta', 30);

/**
 * Add Metaboxes for Locations
 */
function kmnu_add_location_metaboxes()
{
    add_meta_box(
        'location_details',
        'Location Details',
        'kmnu_location_details_callback',
        'locations',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_location_metaboxes');

function kmnu_location_details_callback($post)
{
    $location_link = get_post_meta($post->ID, 'location_link', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $email = get_post_meta($post->ID, 'email', true);
    ?>
    <div class="location-meta-fields">
        <p>
            <label for="location_link"><strong>Get Directions Link:</strong></label><br>
            <input type="url" id="location_link" name="location_link" value="<?php echo esc_url($location_link); ?>"
                style="width:100%;" />
        </p>
        <p>
            <label for="phone"><strong>Phone:</strong></label><br>
            <input type="text" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="email"><strong>Email:</strong></label><br>
            <input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>" style="width:100%;" />
        </p>
    </div>
    <?php
}

function kmnu_save_location_meta($post_id)
{
    if (array_key_exists('location_link', $_POST)) {
        update_post_meta($post_id, 'location_link', $_POST['location_link']);
    }
    if (array_key_exists('phone', $_POST)) {
        update_post_meta($post_id, 'phone', $_POST['phone']);
    }
    if (array_key_exists('email', $_POST)) {
        update_post_meta($post_id, 'email', $_POST['email']);
    }
}
add_action('save_post', 'kmnu_save_location_meta');

/**
 * Add Metaboxes for Video CPTs (Guidance & Stories)
 */
function kmnu_add_video_metaboxes()
{
    add_meta_box(
        'video_details',
        'Video Details',
        'kmnu_video_details_callback',
        array('guidance', 'stories'),
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_video_metaboxes');

function kmnu_video_details_callback($post)
{
    $video_url = get_post_meta($post->ID, 'video_url', true);
    ?>
    <div class="video-meta-fields">
        <p>
            <label for="video_url"><strong>YouTube Video URL:</strong></label><br>
            <input type="url" id="video_url" name="video_url" value="<?php echo esc_url($video_url); ?>"
                style="width:100%;" placeholder="https://www.youtube.com/watch?v=..." />
        </p>
    </div>
    <?php
}

function kmnu_save_video_meta($post_id)
{
    if (array_key_exists('video_url', $_POST)) {
        update_post_meta($post_id, 'video_url', $_POST['video_url']);
    }
}
add_action('save_post', 'kmnu_save_video_meta');

/**
 * Metabox for Testimonials Designation
 */
function kmnu_add_testimonial_metaboxes()
{
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'kmnu_testimonial_details_callback',
        'testimonials',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_testimonial_metaboxes');

function kmnu_testimonial_details_callback($post)
{
    $designation = get_post_meta($post->ID, 'designation', true);
    ?>
    <p>
        <label for="designation"><strong>Designation / Treatment:</strong></label><br>
        <input type="text" id="designation" name="designation" value="<?php echo esc_attr($designation); ?>"
            style="width:100%;" placeholder="e.g. Medical Treatment" />
    </p>
    <?php
}

function kmnu_save_testimonial_meta($post_id)
{
    if (array_key_exists('designation', $_POST)) {
        update_post_meta($post_id, 'designation', $_POST['designation']);
    }
}
add_action('save_post', 'kmnu_save_testimonial_meta');

/**
 * Metabox for Blog Short Description
 */
function kmnu_add_post_metaboxes()
{
    add_meta_box(
        'post_short_desc',
        'Short Description',
        'kmnu_post_short_desc_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_post_metaboxes');

function kmnu_post_short_desc_callback($post)
{
    $short_desc = get_post_meta($post->ID, 'short_desc', true);
    ?>
    <p>
        <label for="short_desc"><strong>Description for Frontend:</strong></label><br>
        <textarea id="short_desc" name="short_desc"
            style="width:100%;height:100px;"><?php echo esc_textarea($short_desc); ?></textarea>
    </p>
    <?php
}

function kmnu_save_post_meta($post_id)
{
    if (array_key_exists('short_desc', $_POST)) {
        update_post_meta($post_id, 'short_desc', $_POST['short_desc']);
    }
}
add_action('save_post', 'kmnu_save_post_meta');

/**
 * Metabox for Preventive Checkups
 */
function kmnu_add_checkups_metaboxes()
{
    add_meta_box(
        'checkup_details',
        'Checkup Details',
        'kmnu_checkup_details_callback',
        'preventive_checkup',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_checkups_metaboxes');

function kmnu_checkup_details_callback($post)
{
    $price = get_post_meta($post->ID, 'price', true);
    wp_nonce_field('kmnu_checkup_meta_nonce', 'kmnu_checkup_meta_nonce_field');
    ?>
    <p>
        <label for="checkup_price" style="font-weight:bold; font-size:14px; margin-bottom:10px; display:block;">Package Price (₹):</label>
        <input type="text" id="checkup_price" name="price" value="<?php echo esc_attr($price); ?>" style="width:100%; max-width:400px; padding: 6px; font-size: 16px;" placeholder="e.g. 799" />
        <br><br><small style="color:#666;">Enter the price value without the currency symbol. The "₹" will be formatted automatically on the frontend design.</small>
    </p>
    <?php
}

function kmnu_save_checkup_meta($post_id)
{
    if (!isset($_POST['kmnu_checkup_meta_nonce_field']) || !wp_verify_nonce($_POST['kmnu_checkup_meta_nonce_field'], 'kmnu_checkup_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'preventive_checkup' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (array_key_exists('price', $_POST)) {
        update_post_meta($post_id, 'price', sanitize_text_field($_POST['price']));
    }
}
add_action('save_post', 'kmnu_save_checkup_meta');

/**
 * Enqueue Media scripts for metaboxes
 */
function kmnu_admin_scripts($hook) {
    if ('post.php' != $hook && 'post-new.php' != $hook) return;
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'kmnu_admin_scripts');

/**
 * Add Advanced Metaboxes for Departments
 */
function kmnu_add_department_metaboxes() {
    add_meta_box(
        'department_advanced_details',
        'Department Professional Details',
        'kmnu_department_advanced_callback',
        'departments',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_department_metaboxes');

function kmnu_department_advanced_callback($post) {
    // Sanitize and get values
    $dept_icon = get_post_meta($post->ID, 'dept_icon', true);
    $faqs = get_post_meta($post->ID, 'dept_faqs', true) ?: array();
    
    // Retrieve groups with backward compatibility
    $groups = get_post_meta($post->ID, 'sub_specialities_groups', true);
    if (empty($groups)) {
        $legacy_subs = get_post_meta($post->ID, 'sub_specialities', true);
        $legacy_heading = get_post_meta($post->ID, 'sub_specialities_heading', true) ?: 'SUB SPECIALITIES';
        if (!empty($legacy_subs)) {
            $groups = array(
                array(
                    'heading' => $legacy_heading,
                    'items' => $legacy_subs
                )
            );
        } else {
            $groups = array(
                array(
                    'heading' => 'SUB SPECIALITIES',
                    'items' => array()
                )
            );
        }
    }
    
    $selected_doctors = get_post_meta($post->ID, 'dept_doctors', true) ?: array();
    $more_details_title = get_post_meta($post->ID, 'more_details_title', true);
    $more_details_content = get_post_meta($post->ID, 'more_details_content', true);

    $hero_subtitle  = get_post_meta($post->ID, 'hero_subtitle', true);
    $hero_bg_color  = get_post_meta($post->ID, 'hero_bg_color', true) ?: '#0065a5';
	$banner_title = get_post_meta($post->ID, 'banner_title', true);

    // Get all doctors for the assignment list.
    $all_doctors = get_posts(array(
        'post_type' => 'doctors',
        'post_status' => array('publish', 'draft', 'pending', 'private', 'future'),
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    
    wp_nonce_field('kmnu_dept_meta_nonce', 'kmnu_dept_meta_nonce_field');
    ?>
    <style>
        .kmnu-meta-row { margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .kmnu-meta-label { font-weight: bold; display: block; margin-bottom: 8px; font-size: 14px; }
        .kmnu-repeater-item { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; position: relative; }
        .kmnu-remove-row { color: #a00; cursor: pointer; font-weight: bold; position: absolute; top: 10px; right: 10px; }
        .dual-list-container { display: flex; gap: 20px; align-items: start; }
        .dual-list-panel { flex: 1; min-width: 0; }
        .doctor-search {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 8px;
            padding: 8px 10px;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            background: #fff;
        }
        .dual-list-box { border: 1px solid #ccc; background: #fff; height: 200px; overflow-y: auto; border-radius: 4px; padding: 10px; }
        .dual-list-box div.doc-item { padding: 8px 12px; border-bottom: 1px solid #eee; cursor: pointer; transition: 0.2s; }
        .dual-list-box div.doc-item:hover { background: #f0f8ff; }
        .dual-list-box div.doc-item.selected { background: #0073aa; color: #fff; }
        .dual-list-actions { display: flex; flex-direction: column; justify-content: center; gap: 10px; height: 200px; }
        .kmnu-btn { padding: 5px 15px; background: #eee; border: 1px solid #ccc; cursor: pointer; border-radius: 3px; font-weight: bold; }
        .kmnu-btn:hover { background: #e0e0e0; }
    </style>

      <!-- Banner Title -->
<div class="kmnu-meta-row">
    <label class="kmnu-meta-label">Banner Title</label>

    <input 
        type="text"
        name="banner_title"
        value="<?php echo esc_attr($banner_title); ?>"
        style="width:100%;"
        placeholder="Enter Banner Title"
    >
</div>

    <!-- Hero Subtitle -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">Hero Subtitle (shown below the title in the banner)</label>
        <textarea
        name="hero_subtitle"
        rows="5"
        style="width:100%; padding:12px; font-size:15px;"
        placeholder="Enter Hero Subtitle"><?php echo esc_textarea($hero_subtitle); ?></textarea>
    </div>

    <!-- Hero Background Color -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">Hero Background Color</label>
        <input type="color" name="hero_bg_color" value="<?php echo esc_attr($hero_bg_color); ?>" style="width:80px; height:40px; cursor:pointer;">
        <span style="margin-left:10px; color:#666; font-size:13px;">Used as the hero section background. The featured image will appear on the right.</span>
    </div>

    <!-- Icon Field -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">FontAwesome Icon Class (e.g. fa-heart-pulse)</label>
        <input type="text" name="dept_icon" value="<?php echo esc_attr($dept_icon); ?>" style="width:100%;" placeholder="fa-stethoscope">
    </div>

    <!-- Dual List Doctors Selection -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">Assign Doctors to this Department</label>
        <div class="dual-list-container">
            <div class="dual-list-panel">
                <input type="search" class="doctor-search" data-target="#allDoctors" placeholder="Search available doctors">
                <div class="dual-list-box" id="allDoctors">
                    <div style="font-weight:bold; border-bottom:2px solid #ddd; margin-bottom:5px;">Available Doctors</div>
                    <?php foreach($all_doctors as $doc): 
                        if(!in_array($doc->ID, (array)$selected_doctors)): ?>
                        <div class="doc-item" data-id="<?php echo $doc->ID; ?>"><?php echo esc_html($doc->post_title); ?></div>
                    <?php endif; endforeach; ?>
                </div>
            </div>
            <div class="dual-list-actions">
                <button type="button" class="kmnu-btn" id="moveToSelected">Add &gt;</button>
                <button type="button" class="kmnu-btn" id="moveToAvailable">&lt; Remove</button>
            </div>
            <div class="dual-list-panel">
                <input type="search" class="doctor-search" data-target="#selectedDoctors" placeholder="Search selected doctors">
                <div class="dual-list-box" id="selectedDoctors">
                    <div style="font-weight:bold; border-bottom:2px solid #ddd; margin-bottom:5px;">Selected Doctors</div>
                    <?php foreach((array)$selected_doctors as $doc_id): 
                        $doc_post = get_post($doc_id);
                        if($doc_post): ?>
                        <div class="doc-item" data-id="<?php echo $doc_id; ?>"><?php echo esc_html($doc_post->post_title); ?></div>
                    <?php endif; endforeach; ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="dept_doctors" id="dept_doctors_input" value="<?php echo implode(',', (array)$selected_doctors); ?>">
    </div>

    <!-- Sub Specialities Groups Repeater (Nested Repeater) -->
    <div class="kmnu-meta-row" style="background: #fafafa; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
        <label class="kmnu-meta-label" style="font-size: 16px; color: #0065a5; margin-bottom: 15px;">Sub Specialities & Treatment Groups (Nested Repeater)</label>
        
        <div id="subGroupsWrap">
            <?php foreach((array)$groups as $g_idx => $group): ?>
                <div class="kmnu-group-item" data-group-index="<?php echo $g_idx; ?>" style="background: #ffffff; padding: 20px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px; position: relative;">
                    <div class="kmnu-group-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        <span class="kmnu-group-title" style="font-size: 15px; font-weight: bold; color: #23282d;">Group #<?php echo $g_idx + 1; ?></span>
                        <span class="kmnu-remove-group" style="color: #a00; cursor: pointer; font-weight: bold;">Remove Group</span>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label class="kmnu-meta-label">Group Heading / Section Title</label>
                        <input type="text" name="sub_specialities_groups[<?php echo $g_idx; ?>][heading]" value="<?php echo esc_attr($group['heading']); ?>" style="width:100%;" placeholder="e.g. SUB SPECIALITIES or CLINICS & SERVICES">
                    </div>
                    
                    <label class="kmnu-meta-label">Items in this Group</label>
                    <div class="kmnu-child-repeater subItemsWrap" style="margin-top: 10px; padding-left: 20px; border-left: 3px solid #0073aa;">
                        <?php 
                        $items = isset($group['items']) ? (array)$group['items'] : array();
                        foreach($items as $i_idx => $sub): 
                        ?>
                            <div class="kmnu-repeater-item" style="background:#f4f7fa; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; position: relative;">
                                <span class="kmnu-remove-row" style="color: #a00; cursor: pointer; font-weight: bold; position: absolute; top: 10px; right: 10px;">Remove</span>
                                <input type="text" name="sub_specialities_groups[<?php echo $g_idx; ?>][items][<?php echo $i_idx; ?>][title]" value="<?php echo esc_attr($sub['title']); ?>" placeholder="Title" style="width:30%;">
                                <input type="text" name="sub_specialities_groups[<?php echo $g_idx; ?>][items][<?php echo $i_idx; ?>][icon]" value="<?php echo esc_attr($sub['icon']); ?>" placeholder="Icon Class" style="width:25%;">
                                <input type="hidden" name="sub_specialities_groups[<?php echo $g_idx; ?>][items][<?php echo $i_idx; ?>][image]" class="sub-img-id" value="<?php echo esc_attr($sub['image']); ?>">
                                <div class="sub-img-preview" style="display:inline-block; vertical-align:middle; margin: 0 10px;">
                                    <?php if($sub['image']): echo wp_get_attachment_image($sub['image'], array(40, 40)); endif; ?>
                                </div>
                                <button type="button" class="button kmnu-upload-img">Select Image/SVG</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="button button-secondary addSubItem" style="margin-top:10px;">Add Item</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button button-primary" id="addSubGroup">Add Group</button>
    </div>

    <!-- FAQs Repeater -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">Frequently Asked Questions (FAQs)</label>
        <div id="faqsWrap">
            <?php foreach((array)$faqs as $index => $faq): ?>
                <div class="kmnu-repeater-item">
                    <span class="kmnu-remove-row">Remove</span>
                    <input type="text" name="dept_faqs[<?php echo $index; ?>][q]" value="<?php echo esc_attr($faq['q']); ?>" placeholder="Question" style="width:100%; margin-bottom:10px;">
                    <textarea name="dept_faqs[<?php echo $index; ?>][a]" rows="2" style="width:100%;" placeholder="Answer"><?php echo esc_textarea($faq['a']); ?></textarea>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button button-secondary" id="addFaq">Add FAQ</button>
    </div>

    <!-- More Details -->
    <div class="kmnu-meta-row">
        <label class="kmnu-meta-label">Extra Section Title (H2)</label>
        <input type="text" name="more_details_title" value="<?php echo esc_attr($more_details_title); ?>" style="width:100%; font-size:1.2rem; font-weight:bold;" placeholder="e.g. Advanced Treatment Protocols">
        <br><br>
        <label class="kmnu-meta-label">Extra Section Content</label>
        <?php wp_editor($more_details_content, 'more_details_content', array('textarea_rows' => 10)); ?>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Dual List logic
        $('.dual-list-box').on('click', '.doc-item', function() { $(this).toggleClass('selected'); });

        $('.doctor-search').on('input', function() {
            var target = $($(this).data('target'));
            var query = $(this).val().toLowerCase().trim();

            target.find('.doc-item').each(function() {
                var name = $(this).text().toLowerCase();
                $(this).toggle(name.indexOf(query) !== -1);
            });
        });
        
        $('#moveToSelected').click(function() {
            $('#allDoctors div.doc-item.selected:visible').appendTo('#selectedDoctors').removeClass('selected').show();
            $('.doctor-search[data-target="#allDoctors"], .doctor-search[data-target="#selectedDoctors"]').trigger('input');
            updateDocInput();
        });
        
        $('#moveToAvailable').click(function() {
            $('#selectedDoctors div.doc-item.selected:visible').appendTo('#allDoctors').removeClass('selected').show();
            $('.doctor-search[data-target="#allDoctors"], .doctor-search[data-target="#selectedDoctors"]').trigger('input');
            updateDocInput();
        });
        
        function updateDocInput() {
            var ids = [];
            $('#selectedDoctors div.doc-item').each(function() { ids.push($(this).data('id')); });
            $('#dept_doctors_input').val(ids.join(','));
        }

        // Repeater logic
        $('#addFaq').click(function() {
            var i = $('#faqsWrap .kmnu-repeater-item').length;
            $('#faqsWrap').append('<div class="kmnu-repeater-item"><span class="kmnu-remove-row">Remove</span><input type="text" name="dept_faqs['+i+'][q]" placeholder="Question" style="width:100%; margin-bottom:10px;"><textarea name="dept_faqs['+i+'][a]" rows="2" style="width:100%;" placeholder="Answer"></textarea></div>');
        });

        // Add Sub Group
        $('#addSubGroup').click(function() {
            var g = $('#subGroupsWrap .kmnu-group-item').length;
            var html = '';
            html += '<div class="kmnu-group-item" data-group-index="' + g + '" style="background: #ffffff; padding: 20px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px; position: relative;">';
            html += '  <div class="kmnu-group-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">';
            html += '    <span class="kmnu-group-title" style="font-size: 15px; font-weight: bold; color: #23282d;">Group #' + (g + 1) + '</span>';
            html += '    <span class="kmnu-remove-group" style="color: #a00; cursor: pointer; font-weight: bold;">Remove Group</span>';
            html += '  </div>';
            html += '  <div style="margin-bottom: 15px;">';
            html += '    <label class="kmnu-meta-label">Group Heading / Section Title</label>';
            html += '    <input type="text" name="sub_specialities_groups[' + g + '][heading]" placeholder="e.g. SUB SPECIALITIES" style="width:100%;">';
            html += '  </div>';
            html += '  <label class="kmnu-meta-label">Items in this Group</label>';
            html += '  <div class="kmnu-child-repeater subItemsWrap" style="margin-top: 10px; padding-left: 20px; border-left: 3px solid #0073aa;"></div>';
            html += '  <button type="button" class="button button-secondary addSubItem" style="margin-top:10px;">Add Item</button>';
            html += '</div>';
            $('#subGroupsWrap').append(html);
        });

        // Remove Sub Group
        $(document).on('click', '.kmnu-remove-group', function() {
            $(this).closest('.kmnu-group-item').remove();
            // Re-index groups
            $('#subGroupsWrap .kmnu-group-item').each(function(g_idx) {
                $(this).attr('data-group-index', g_idx);
                $(this).find('.kmnu-group-title').text('Group #' + (g_idx + 1));
                $(this).find('input[name^="sub_specialities_groups"]').each(function() {
                    var name = $(this).attr('name');
                    var newName = name.replace(/sub_specialities_groups\[\d+\]/, 'sub_specialities_groups[' + g_idx + ']');
                    $(this).attr('name', newName);
                });
            });
        });

        // Add Sub Item to Group
        $(document).on('click', '.addSubItem', function() {
            var groupItem = $(this).closest('.kmnu-group-item');
            var g = groupItem.attr('data-group-index');
            var wrap = groupItem.find('.subItemsWrap');
            var i = wrap.find('.kmnu-repeater-item').length;
            
            var html = '';
            html += '<div class="kmnu-repeater-item" style="background:#f4f7fa; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; position: relative;">';
            html += '  <span class="kmnu-remove-row" style="color: #a00; cursor: pointer; font-weight: bold; position: absolute; top: 10px; right: 10px;">Remove</span>';
            html += '  <input type="text" name="sub_specialities_groups[' + g + '][items][' + i + '][title]" placeholder="Title" style="width:30%;">';
            html += '  <input type="text" name="sub_specialities_groups[' + g + '][items][' + i + '][icon]" placeholder="Icon Class" style="width:25%;">';
            html += '  <input type="hidden" name="sub_specialities_groups[' + g + '][items][' + i + '][image]" class="sub-img-id">';
            html += '  <div class="sub-img-preview" style="display:inline-block; vertical-align:middle; margin:0 10px;"></div>';
            html += '  <button type="button" class="button kmnu-upload-img">Select Image/SVG</button>';
            html += '</div>';
            wrap.append(html);
        });

        // Upload media frame helper
        $(document).on('click', '.kmnu-upload-img', function(e) {
            e.preventDefault();
            var btn = $(this);
            var frame = wp.media({ title: 'Select Image', button: { text: 'Use this image' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                btn.parent().find('.sub-img-id').val(attachment.id);
                btn.parent().find('.sub-img-preview').html('<img src="'+attachment.url+'" style="width:40px;height:auto;">');
            }).open();
        });

        // Remove row handles sub items
        $(document).on('click', '.kmnu-remove-row', function() {
            var wrap = $(this).closest('.subItemsWrap');
            var groupItem = $(this).closest('.kmnu-group-item');
            var g = groupItem.attr('data-group-index');
            $(this).parent().remove();
            
            // Re-index items inside this group
            wrap.find('.kmnu-repeater-item').each(function(i_idx) {
                $(this).find('input[name^="sub_specialities_groups"]').each(function() {
                    var name = $(this).attr('name');
                    var newName = name.replace(/\[items\]\[\d+\]/, '[items][' + i_idx + ']');
                    $(this).attr('name', newName);
                });
            });
        });
    });
    </script>
    <?php
}

function kmnu_save_department_meta($post_id) {
    if (!isset($_POST['kmnu_dept_meta_nonce_field']) || !wp_verify_nonce($_POST['kmnu_dept_meta_nonce_field'], 'kmnu_dept_meta_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['dept_icon'])) update_post_meta($post_id, 'dept_icon', sanitize_text_field($_POST['dept_icon']));
	if (isset($_POST['banner_title'])) {
    update_post_meta(
        $post_id,
        'banner_title',
        sanitize_text_field($_POST['banner_title'])
    );
}
    if (isset($_POST['hero_subtitle'])) update_post_meta($post_id, 'hero_subtitle', sanitize_text_field($_POST['hero_subtitle']));
    if (isset($_POST['hero_bg_color'])) update_post_meta($post_id, 'hero_bg_color', sanitize_hex_color($_POST['hero_bg_color']));
    if (isset($_POST['more_details_title'])) update_post_meta($post_id, 'more_details_title', sanitize_text_field($_POST['more_details_title']));
    if (isset($_POST['more_details_content'])) update_post_meta($post_id, 'more_details_content', wp_kses_post($_POST['more_details_content']));
    
    // Save Sub Specialities groups
    if (isset($_POST['sub_specialities_groups'])) {
        $groups = array();
        foreach ($_POST['sub_specialities_groups'] as $g_data) {
            $heading = isset($g_data['heading']) ? sanitize_text_field($g_data['heading']) : '';
            $items = array();
            if (isset($g_data['items']) && is_array($g_data['items'])) {
                foreach ($g_data['items'] as $item) {
                    if (!empty($item['title'])) {
                        $items[] = array(
                            'title' => sanitize_text_field($item['title']),
                            'icon'  => sanitize_text_field($item['icon']),
                            'image' => (int)$item['image']
                        );
                    }
                }
            }
            if (!empty($heading) || !empty($items)) {
                $groups[] = array(
                    'heading' => $heading,
                    'items'   => $items
                );
            }
        }
        update_post_meta($post_id, 'sub_specialities_groups', $groups);
    } else {
        delete_post_meta($post_id, 'sub_specialities_groups');
    }
    
    // Doctors dual list
    if (isset($_POST['dept_doctors'])) {
        $previous_doctor_ids = (array) get_post_meta($post_id, 'dept_doctors', true);
        $doctor_ids = array_filter(explode(',', $_POST['dept_doctors']));
        $doctor_ids = array_values(array_unique(array_map('intval', $doctor_ids)));
        update_post_meta($post_id, 'dept_doctors', $doctor_ids);
        kmnu_sync_department_doctors_to_specialization($post_id, $doctor_ids, $previous_doctor_ids);
    }

    // FAQ Repeater
    if (isset($_POST['dept_faqs'])) {
        $faqs = array();
        foreach($_POST['dept_faqs'] as $faq) {
            if(!empty($faq['q'])) $faqs[] = array('q' => sanitize_text_field($faq['q']), 'a' => wp_kses_post($faq['a']));
        }
        update_post_meta($post_id, 'dept_faqs', $faqs);
    }

    // Sub Specialities Repeater
    if (isset($_POST['sub_specialities'])) {
        $subs = array();
        foreach($_POST['sub_specialities'] as $sub) {
            if(!empty($sub['title'])) $subs[] = array(
                'title' => sanitize_text_field($sub['title']), 
                'icon' => $sub['icon'],
                'image' => (int)$sub['image']
            );
        }
        update_post_meta($post_id, 'sub_specialities', $subs);
    }
}
add_action('save_post', 'kmnu_save_department_meta');

/**
 * Interactive Mega Menu for 'Our Specialities'
 */
function kmnu_specialities_mega_menu($item_output, $item, $depth, $args) {
    if (in_array(strtolower(trim($item->title)), ['specialities', 'our specialities']) && $depth === 0) {
        $args_query = array(
            'post_type' => 'departments',
            'posts_per_page' => 12,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $depts = get_posts($args_query);
        
        $mega_html = '<div class="kmnu-mega-menu">';
        $mega_html .= '<div class="mega-grid">';
        
        // Fallback icon map if empty
        $icon_map = [
            'cardiology' => 'fa-heart-pulse', 'orthopaedics' => 'fa-bone',
            'neurology' => 'fa-brain', 'pediatrics' => 'fa-baby',
            'gynaecology' => 'fa-venus', 'oncology' => 'fa-dna',
            'urology' => 'fa-person-rays', 'emergency' => 'fa-truck-medical',
            'dental' => 'fa-tooth', 'eye' => 'fa-eye', 'surgery' => 'fa-kit-medical'
        ];

        foreach($depts as $dept) {
            $icon = get_post_meta($dept->ID, 'dept_icon', true);
            if(empty($icon)) {
                $icon = 'fa-stethoscope';
                foreach($icon_map as $key => $fa_icon) {
                    if(stripos($dept->post_title, $key) !== false) {
                        $icon = $fa_icon; break;
                    }
                }
            }
            $permalink = get_permalink($dept->ID);
            $mega_html .= '<a href="'.esc_url($permalink).'" class="mega-item">';
            $mega_html .= '<div class="mega-icon"><i class="fa-solid '.esc_attr($icon).'"></i></div>';
            $mega_html .= '<span>'.esc_html($dept->post_title).'</span>';
            $mega_html .= '</a>';
        }
        $mega_html .= '</div>';
        $mega_html .= '<div class="mega-footer"><a href="'.home_url('/specialities').'" class="mega-btn">Explore All Specialities <i class="fa-solid fa-arrow-right"></i></a></div>';
        $mega_html .= '</div>';
        
        // Ensure the item has the 'menu-item-has-children' pseudo class logic by forcing it
        $item->classes[] = 'menu-item-has-children';
        $item->classes[] = 'has-mega-menu';
        
        return $item_output . $mega_html;
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'kmnu_specialities_mega_menu', 10, 4);

// Add class to item
function kmnu_mega_menu_class($classes, $item, $args) {
    if (in_array(strtolower(trim($item->title)), ['specialities', 'our specialities'])) {
        $classes[] = 'menu-item-has-children';
        $classes[] = 'has-mega-menu';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'kmnu_mega_menu_class', 10, 3);

/**
 * Dummy Data Generator
 * Run by visiting: yoursite.com/?fill_dummy_data=1
 */
function kmnu_generate_dummy_data() {
    if (!isset($_GET['fill_dummy_data']) || !current_user_can('manage_options')) return;

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    // Handle Featured Image Sideloading
    $image_path = WP_CONTENT_DIR . '/uploads/speciality-heart.png';
    $attachment_id = 0;
    if (file_exists($image_path)) {
        $existing_image = get_posts(array('post_type' => 'attachment', 'name' => 'speciality-heart', 'posts_per_page' => 1));
        if ($existing_image) {
            $attachment_id = $existing_image[0]->ID;
        } else {
            $file_array = array('name' => basename($image_path), 'tmp_name' => $image_path);
            $temp_copy = WP_CONTENT_DIR . '/uploads/temp-heart.png';
            copy($image_path, $temp_copy);
            $file_array['tmp_name'] = $temp_copy;
            $attachment_id = media_handle_sideload($file_array, 0);
        }
    }

    $depts_data = array(
        'Cardiology' => array(
            'icon' => 'fa-heart-pulse',
            'desc' => 'Leading heart care center specializing in minimum invasive cardiac surgeries and complex interventions.',
            'details_title' => 'Cardiology',
            'details_content' => '<p>Our center offers advanced flat-panel cath labs and 24/7 cardiac emergency services. We are dedicated to providing the highest level of care for every heartbeat.</p>',
            'subs' => array(
                array('title' => 'Interventional Cardiology', 'icon' => 'fa-stethoscope'),
                array('title' => 'Electrophysiology', 'icon' => 'fa-bolt-lightning'),
                array('title' => 'Heart Failure Clinic', 'icon' => 'fa-heart-circle-check'),
                array('title' => 'Pediatric Cardiology', 'icon' => 'fa-child-pulse'),
                array('title' => 'Non-invasive Imaging', 'icon' => 'fa-microscope'),
                array('title' => 'Rehabilitation', 'icon' => 'fa-person-walking')
            ),
            'faqs' => array(
                array('q' => 'What is the recovery time for angioplasty?', 'a' => 'Most patients recover within 24-48 hours but should avoid heavy lifting for a week.'),
                array('q' => 'Do you offer heart transplant evaluations?', 'a' => 'Yes, our multidisciplinary team provides complete pre-transplant diagnostic evaluations.')
            )
        ),
        'Neurology' => array(
            'icon' => 'fa-brain',
            'desc' => 'Comprehensive treatment for neurological disorders using state-of-the-art diagnostic and surgical tools.',
            'details_title' => 'Neurology',
            'details_content' => '<p>We specialize in the treatment of complex brain and spine disorders. Our team uses neuro-navigation and robotic surgery for precision care.</p>',
            'subs' => array(
                array('title' => 'Stroke Care Unit', 'icon' => 'fa-brain-circuit'),
                array('title' => 'Epilepsy Management', 'icon' => 'fa-head-side-virus'),
                array('title' => 'Neuro-Immunology', 'icon' => 'fa-shield-virus'),
                array('title' => 'Sleep Medicine', 'icon' => 'fa-bed'),
                array('title' => 'Pediatric Neurology', 'icon' => 'fa-child-reaching'),
                array('title' => 'Neuromuscular Disorders', 'icon' => 'fa-person-rays')
            ),
            'faqs' => array(
                array('q' => 'What are the symptoms of a stroke?', 'a' => 'Symptoms include facial drooping, arm weakness, and speech difficulty (FAST).'),
                array('q' => 'Can epilepsy be cured?', 'a' => 'While not always "cured", most cases are effectively managed with medication or specialized surgery.')
            )
        ),
        'Orthopaedics' => array(
            'icon' => 'fa-bone',
            'desc' => 'Expert solutions for joint, bone, and spine health with a focus on robotic-assisted techniques.',
            'details_title' => 'Orthopaedics',
            'details_content' => '<p>Our orthopaedic center is a pioneer in joint replacement and sports medicine. We ensure faster recovery with minimally invasive protocols.</p>',
            'subs' => array(
                array('title' => 'Total Knee Replacement', 'icon' => 'fa-robot'),
                array('title' => 'Sports Injury Clinic', 'icon' => 'fa-person-running'),
                array('title' => 'Spine Surgery', 'icon' => 'fa-bone'),
                array('title' => 'Trauma & Fracture Care', 'icon' => 'fa-truck-medical'),
                array('title' => 'Arthroscopy', 'icon' => 'fa-eye'),
                array('title' => 'Pediatric Ortho', 'icon' => 'fa-child')
            ),
            'faqs' => array()
        ),
        'Oncology' => array(
            'icon' => 'fa-dna',
            'desc' => 'Integrated cancer care offering advanced medical, surgical, and radiation oncology treatments.',
            'details_title' => 'Oncology',
            'details_content' => '<p>We provide personalized cancer treatment plans using targeted therapy and advanced immunotherapy. Our goal is holistic healing and care.</p>',
            'subs' => array(
                array('title' => 'Medical Oncology', 'icon' => 'fa-vial'),
                array('title' => 'Radiation Therapy', 'icon' => 'fa-circle-radiation'),
                array('title' => 'Bone Marrow Transplant', 'icon' => 'fa-dna'),
                array('title' => 'Surgical Oncology', 'icon' => 'fa-scalpel'),
                array('title' => 'Breast Cancer Clinic', 'icon' => 'fa-ribbon'),
                array('title' => 'Palliative Care', 'icon' => 'fa-hand-holding-heart')
            ),
            'faqs' => array()
        ),
        'Gastroenterology' => array(
            'icon' => 'fa-stomach',
            'desc' => 'Specialized care for digestive system disorders with high-end endoscopic diagnostic services.',
            'details_title' => 'Gastroenterology',
            'details_content' => '<p>Our experts deal with everything from routine digestive issues to complex liver transplants. We use the latest endoscopy and colonoscopy tech.</p>',
            'subs' => array(
                array('title' => 'Hepatology (Liver)', 'icon' => 'fa-liver'),
                array('title' => 'Advanced Endoscopy', 'icon' => 'fa-video'),
                array('title' => 'Inflammatory Bowel Disease', 'icon' => 'fa-bacteria'),
                array('title' => 'Gastrointestinal Surgery', 'icon' => 'fa-kit-medical'),
                array('title' => 'Nutrition Services', 'icon' => 'fa-apple-whole')
            ),
            'faqs' => array()
        ),
        'Urology' => array(
            'icon' => 'fa-person-rays',
            'desc' => 'Comprehensive urological care including kidney transplant and robotic urology services.',
            'details_title' => 'Urology',
            'details_content' => '<p>We provide advanced treatment for kidney stones, prostate issues, and urinary tract infections using laser and robotic technologies.</p>',
            'subs' => array(
                array('title' => 'Kidney Transplant', 'icon' => 'fa-kidney'),
                array('title' => 'Robotic Urology', 'icon' => 'fa-robot'),
                array('title' => 'Andrology', 'icon' => 'fa-mars'),
                array('title' => 'Female Urology', 'icon' => 'fa-venus'),
                array('title' => 'Stone Management', 'icon' => 'fa-gem')
            ),
            'faqs' => array()
        ),
        'Pediatrics' => array(
            'icon' => 'fa-baby',
            'desc' => 'Holistic healthcare for children from birth through adolescence in a compassionate environment.',
            'details_title' => 'Pediatrics',
            'details_content' => '<p>Our pediatric team is dedicated to the well-being of your children. We provide specialized care in neonatology and pediatric surgery.</p>',
            'subs' => array(
                array('title' => 'NICU', 'icon' => 'fa-hospital-user'),
                array('title' => 'Pediatric Intensive Care', 'icon' => 'fa-flask'),
                array('title' => 'Neonatology', 'icon' => 'fa-baby-carriage'),
                array('title' => 'Immunization', 'icon' => 'fa-syringe'),
                array('title' => 'Child Psychology', 'icon' => 'fa-face-smile')
            ),
            'faqs' => array()
        )
    );

    // List of existing professional doctors from user's system
    $doctor_names = array('Dr. A. Kiran Kumar', 'Dr. Aashish S', 'Dr. Aravindan CG', 'Dr. Avinaash K Raghupathy', 'Dr. Kathirazhagan Thulasilingam');
    $doctor_ids = array();

    foreach($doctor_names as $doc_name) {
        $existing_doc = get_page_by_title($doc_name, OBJECT, 'doctors');
        if($existing_doc) {
            $doctor_ids[] = $existing_doc->ID;
        } else {
            $doctor_ids[] = wp_insert_post(array('post_title' => $doc_name, 'post_type' => 'doctors', 'post_status' => 'publish'));
        }
    }

    foreach($depts_data as $name => $data) {
        $existing = get_page_by_title($name, OBJECT, 'departments');
        $dept_id = $existing ? $existing->ID : wp_insert_post(array('post_title' => $name, 'post_type' => 'departments', 'post_status' => 'publish'));
        
        if($dept_id) {
            update_post_meta($dept_id, 'dept_icon', $data['icon']);
            update_post_meta($dept_id, 'dept_faqs', $data['faqs']);
            update_post_meta($dept_id, 'sub_specialities', $data['subs']);
            update_post_meta($dept_id, 'more_details_title', $data['details_title']);
            update_post_meta($dept_id, 'more_details_content', $data['details_content']);
            
            // Assign 2-3 random doctors from the list
            $assigned_docs = array_rand(array_flip($doctor_ids), min(count($doctor_ids), rand(2, 3)));
            update_post_meta($dept_id, 'dept_doctors', (array)$assigned_docs);

            if ($attachment_id) set_post_thumbnail($dept_id, $attachment_id);
        }
    }

    echo "Full Dynamic Healthcare Portal Populated Successfully! Refresh your pages.";
    exit;
}
add_action('init', 'kmnu_generate_dummy_data');

/**
 * Automatically create the Specialities page and assign the template.
 */
function kmnu_create_specialities_page() {
    $page_title = 'Specialities';
    $page_content = '';
    $page_template = 'template-specialities.php';

    $page_check = get_page_by_title($page_title);
    
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post(array(
            'post_title'    => $page_title,
            'post_content'  => $page_content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ));
        
        if($new_page_id){
            update_post_meta($new_page_id, '_wp_page_template', $page_template);
        }
    } else {
        // Ensure the template is assigned even if the page exists
        update_post_meta($page_check->ID, '_wp_page_template', $page_template);
    }
}
add_action('init', 'kmnu_create_specialities_page');

/**
 * Register Careers Custom Post Type
 */
function kmnu_register_careers_cpt() {
    $labels = array(
        'name'               => 'Careers',
        'singular_name'      => 'Career',
        'menu_name'          => 'Careers',
        'add_new'            => 'Add New Job',
        'add_new_item'       => 'Add New Job',
        'edit_item'          => 'Edit Job',
        'new_item'           => 'New Job',
        'view_item'          => 'View Job',
        'search_items'       => 'Search Jobs',
        'not_found'          => 'No jobs found',
        'not_found_in_trash' => 'No jobs found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'career-job'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 23,
        'menu_icon'           => 'dashicons-businessperson',
        'supports'            => array('title', 'editor'),
    );

    register_post_type('careers', $args);
}
add_action('init', 'kmnu_register_careers_cpt');

/**
 * Add Metabox for Careers (Locations, Experience, Job Type)
 */
function kmnu_add_careers_metaboxes() {
    add_meta_box(
        'career_details_meta',
        'Job Details',
        'kmnu_render_career_metabox',
        'careers',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_careers_metaboxes');

function kmnu_render_career_metabox($post) {
    wp_nonce_field('save_career_meta', 'career_meta_nonce');

    $locations    = get_post_meta($post->ID, 'career_locations', true);
    $experience   = get_post_meta($post->ID, 'career_experience', true);
    $job_type     = get_post_meta($post->ID, 'career_job_type', true);
    $details_link = get_post_meta($post->ID, 'career_details_link', true);
    
    if (empty($job_type)) $job_type = 'Full Time';
    ?>
    <p>
        <label for="career_locations"><strong>Locations:</strong></label><br/>
        <input type="text" id="career_locations" name="career_locations" value="<?php echo esc_attr($locations); ?>" style="width:100%;" placeholder="e.g. Rajajinagar, Bengaluru" />
        <small>Comma separated if multiple locations applies.</small>
    </p>
    <p>
        <label for="career_experience"><strong>Experience Needed:</strong></label><br/>
        <input type="text" id="career_experience" name="career_experience" value="<?php echo esc_attr($experience); ?>" style="width:100%;" placeholder="e.g. 1-5 Years" />
    </p>
    <p>
        <label for="career_job_type"><strong>Job Type:</strong></label><br/>
        <select id="career_job_type" name="career_job_type" style="width:100%;">
            <option value="Full Time" <?php selected($job_type, 'Full Time'); ?>>Full Time</option>
            <option value="Part Time" <?php selected($job_type, 'Part Time'); ?>>Part Time</option>
            <option value="Contract" <?php selected($job_type, 'Contract'); ?>>Contract</option>
            <option value="Internship" <?php selected($job_type, 'Internship'); ?>>Internship</option>
        </select>
    </p>
    <p>
        <label for="career_details_link"><strong>External Details Link:</strong></label><br/>
        <input type="url" id="career_details_link" name="career_details_link" value="<?php echo esc_attr($details_link); ?>" style="width:100%;" placeholder="https://nhpl.keka.com/careers/jobdetails/XXXXX" />
        <small>Paste the full Keka (or external) job details URL here.</small>
    </p>
    <?php
}

function kmnu_save_career_metabox($post_id) {
    if (!isset($_POST['career_meta_nonce']) || !wp_verify_nonce($_POST['career_meta_nonce'], 'save_career_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['career_locations'])) {
        update_post_meta($post_id, 'career_locations', sanitize_text_field($_POST['career_locations']));
    }
    if (isset($_POST['career_experience'])) {
        update_post_meta($post_id, 'career_experience', sanitize_text_field($_POST['career_experience']));
    }
    if (isset($_POST['career_details_link'])) {
        update_post_meta($post_id, 'career_details_link', esc_url_raw($_POST['career_details_link']));
    }
    if (isset($_POST['career_job_type'])) {
        update_post_meta($post_id, 'career_job_type', sanitize_text_field($_POST['career_job_type']));
    }
}
add_action('save_post_careers', 'kmnu_save_career_metabox');

/**
 * Register Awards Custom Post Type
 */
function kmnu_register_awards_cpt() {
    $labels = array(
        'name'               => 'Awards',
        'singular_name'      => 'Award',
        'menu_name'          => 'Awards',
        'add_new'            => 'Add New Award',
        'add_new_item'       => 'Add New Award',
        'edit_item'          => 'Edit Award',
        'new_item'           => 'New Award',
        'view_item'          => 'View Award',
        'search_items'       => 'Search Awards',
        'not_found'          => 'No awards found',
        'not_found_in_trash' => 'No awards found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'award'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 24,
        'menu_icon'           => 'dashicons-awards',
        'supports'            => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('awards', $args);

    // Register Custom Taxonomy: Award Category
    $cat_labels = array(
        'name'              => 'Award Categories',
        'singular_name'     => 'Award Category',
        'search_items'      => 'Search Award Categories',
        'all_items'         => 'All Award Categories',
        'parent_item'       => 'Parent Award Category',
        'parent_item_colon' => 'Parent Award Category:',
        'edit_item'         => 'Edit Award Category',
        'update_item'       => 'Update Award Category',
        'add_new_item'      => 'Add New Award Category',
        'new_item_name'     => 'New Award Category Name',
        'menu_name'         => 'Award Categories',
    );

    $cat_args = array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'award-category'),
    );

    register_taxonomy('award_cat', array('awards'), $cat_args);
}
add_action('init', 'kmnu_register_awards_cpt');

/**
 * Add Metabox for Awards (Year)
 */
function kmnu_add_awards_metaboxes() {
    add_meta_box(
        'award_details_meta',
        'Award Details',
        'kmnu_render_award_metabox',
        'awards',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_awards_metaboxes');

function kmnu_render_award_metabox($post) {
    wp_nonce_field('save_award_meta', 'award_meta_nonce');
    $year = get_post_meta($post->ID, 'award_year', true);
    $category = get_post_meta($post->ID, 'award_category', true);
    ?>
    <p>
        <label for="award_year"><strong>Award Year:</strong></label><br/>
        <input type="text" id="award_year" name="award_year" value="<?php echo esc_attr($year); ?>" style="width:100%;" placeholder="e.g. 2024" />
    </p>
    <p>
        <label for="award_category"><strong>Award Category:</strong></label><br/>
        <select id="award_category" name="award_category" style="width:100%;">
            <option value="Hospital" <?php selected($category, 'Hospital'); ?>>Hospital Award</option>
            <option value="Individual" <?php selected($category, 'Individual'); ?>>Individual Award</option>
        </select>
    </p>
    <?php
}

function kmnu_save_awards_metabox($post_id) {
    if (!isset($_POST['award_meta_nonce']) || !wp_verify_nonce($_POST['award_meta_nonce'], 'save_award_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['award_year'])) {
        update_post_meta($post_id, 'award_year', sanitize_text_field($_POST['award_year']));
    }
    if (isset($_POST['award_category'])) {
        update_post_meta($post_id, 'award_category', sanitize_text_field($_POST['award_category']));
    }
}
add_action('save_post_awards', 'kmnu_save_awards_metabox');

/**
 * Register News Custom Post Type
 */
function kmnu_register_news_cpt() {
    $labels = array(
        'name'               => 'News',
        'singular_name'      => 'News',
        'menu_name'          => 'News',
        'add_new'            => 'Add New News',
        'add_new_item'       => 'Add New News',
        'edit_item'          => 'Edit News',
        'new_item'           => 'New News',
        'view_item'          => 'View News',
        'search_items'       => 'Search News',
        'not_found'          => 'No news found',
        'not_found_in_trash' => 'No news found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'hospital-news'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-megaphone',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('news', $args);

    // Register News Category Taxonomy
    register_taxonomy('news_cat', 'news', array(
        'labels' => array(
            'name' => 'News Categories',
            'singular_name' => 'News Category'
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'news-category'),
    ));
}
add_action('init', 'kmnu_register_news_cpt');

/**
 * Register Gallery Custom Post Type
 */
function kmnu_register_gallery_cpt() {
    $labels = array(
        'name'               => 'Gallery',
        'singular_name'      => 'Gallery',
        'menu_name'          => 'Gallery',
        'add_new'            => 'Add New Gallery',
        'add_new_item'       => 'Add New Gallery',
        'edit_item'          => 'Edit GalleryItem',
        'new_item'           => 'New GalleryItem',
        'view_item'          => 'View GalleryItem',
        'search_items'       => 'Search Gallery',
        'not_found'          => 'No items found',
        'not_found_in_trash' => 'No items found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'gallery-items'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-format-gallery',
        'supports'            => array('title', 'thumbnail'),
    );

    register_post_type('gallery', $args);

    // Register Gallery Category Taxonomy
    register_taxonomy('gallery_cat', 'gallery', array(
        'labels' => array(
            'name' => 'Gallery Categories',
            'singular_name' => 'Gallery Category'
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'gallery-category'),
    ));

    // Ensure terms exist
    if (!term_exists('Public events', 'gallery_cat')) {
        wp_insert_term('Public events', 'gallery_cat');
    }
    if (!term_exists('Hospital events', 'gallery_cat')) {
        wp_insert_term('Hospital events', 'gallery_cat');
    }
}
add_action('init', 'kmnu_register_gallery_cpt');

/**
 * Allow JFIF image uploads
 */
function kmnu_add_jfif_mime_type($mimes) {
    $mimes['jfif'] = 'image/jpeg';
    return $mimes;
}
add_filter('upload_mimes', 'kmnu_add_jfif_mime_type');

add_action('init', 'kmnu_create_specialities_page');

/**
 * Automatically create the Careers page and assign the template.
 */
function kmnu_create_careers_page() {
    $page_title = 'Careers';
    $page_template = 'template-careers.php';

    $page_check = get_page_by_title($page_title);
    
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post(array(
            'post_title'    => $page_title,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ));
        
        if($new_page_id){
            update_post_meta($new_page_id, '_wp_page_template', $page_template);
        }
    } else {
        update_post_meta($page_check->ID, '_wp_page_template', $page_template);
    }
}
add_action('init', 'kmnu_create_careers_page');
/**
 * Automatically create the Blogs page and assign the template.
 */
function kmnu_create_blogs_page() {
    $page_title = 'Blogs';
    $page_template = 'template-blogs.php';

    $page_check = get_page_by_title($page_title);
    
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post(array(
            'post_title'    => $page_title,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ));
        
        if($new_page_id){
            update_post_meta($new_page_id, '_wp_page_template', $page_template);
        }
    } else {
        // Ensure template is set if page exists but template is wrong or default
        $current_temp = get_post_meta($page_check->ID, '_wp_page_template', true);
        if ($current_temp != $page_template) {
            update_post_meta($page_check->ID, '_wp_page_template', $page_template);
        }
    }
}
add_action('init', 'kmnu_create_blogs_page');

/**
 * AJAX Handler for Doctors suggestions
 */

function kmnu_get_doctor_suggestions() {
    $search = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';
    
    if (empty($search)) {
        wp_send_json_success([]);
    }

    $args = array(
        'post_type' => 'doctors',
        'posts_per_page' => 10,
        's' => $search,
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    $suggestions = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $suggestions[] = array(
                'label' => get_the_title(),
                'url' => get_permalink()
            );
        }
    }
    wp_reset_postdata();

    wp_send_json_success($suggestions);
}
add_action('wp_ajax_get_doctor_suggestions', 'kmnu_get_doctor_suggestions');
add_action('wp_ajax_nopriv_get_doctor_suggestions', 'kmnu_get_doctor_suggestions');

function kmnu_get_form_receiver_emails() {
    $default_recipients = array('care.ambur@nuhospitals.com', 'siddu2214@gmail.com');

    if (!defined('KMNU_FORM_RECEIVER_EMAIL')) {
        return $default_recipients;
    }

    $recipients = KMNU_FORM_RECEIVER_EMAIL;
    if (is_string($recipients)) {
        $recipients = array_map('trim', explode(',', $recipients));
    }

    $recipients = array_filter((array) $recipients, 'is_email');
    return !empty($recipients) ? array_values($recipients) : $default_recipients;
}

function kmnu_redirect_to_thank_you($form_type, $name, $details = array()) {
    $token = wp_generate_uuid4();
    $payload = array(
        'form_type' => sanitize_key($form_type),
        'name' => sanitize_text_field($name),
        'details' => array_map('sanitize_text_field', (array) $details),
    );

    set_transient('kmnu_thank_you_' . $token, $payload, 30 * MINUTE_IN_SECONDS);
    wp_safe_redirect(add_query_arg('ref', rawurlencode($token), home_url('/thank-you/')));
    exit;
}

/**
 * Contact Form Handler
 */
function kmnu_handle_contact_submission() {
    if (!isset($_POST['kmnu_nonce_field']) || !wp_verify_nonce($_POST['kmnu_nonce_field'], 'kmnu_contact_nonce')) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#appointment'));
        exit;
    }

    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $speciality = sanitize_text_field($_POST['speciality']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = kmnu_get_form_receiver_emails();
    $subject = 'New Contact Request from ' . $first_name . ' ' . $last_name;
    
    $body = "<h2>New Contact Request from KMNU Website</h2>";
    $body .= "<p><strong>Name:</strong> {$first_name} {$last_name}</p>";
    $body .= "<p><strong>Phone:</strong> {$phone}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Selected Speciality:</strong> {$speciality}</p>";
    $body .= "<p><strong>Message:</strong><br/>" . nl2br($message) . "</p>";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $first_name . ' <' . $email . '>';
    }

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#appointment'));
        exit;
    }

    kmnu_redirect_to_thank_you('contact', trim($first_name . ' ' . $last_name), array(
        'speciality' => $speciality,
        'email' => $email,
        'phone' => $phone,
    ));
}
add_action('admin_post_nopriv_submit_kmnu_contact', 'kmnu_handle_contact_submission');
add_action('admin_post_submit_kmnu_contact', 'kmnu_handle_contact_submission');

/**
 * Book Appointment Form Handler
 */
function kmnu_handle_appointment_submission() {
    if (!isset($_POST['kmnu_appointment_nonce_field']) || !wp_verify_nonce($_POST['kmnu_appointment_nonce_field'], 'kmnu_appointment_nonce')) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#appointment'));
        exit;
    }

    $patient_name = isset($_POST['patient_name']) ? sanitize_text_field(wp_unslash($_POST['patient_name'])) : '';
    $patient_email = isset($_POST['patient_email']) ? sanitize_email(wp_unslash($_POST['patient_email'])) : '';
    $patient_phone = isset($_POST['patient_phone']) ? sanitize_text_field(wp_unslash($_POST['patient_phone'])) : '';
    $doctor_id = isset($_POST['doctor_id']) ? absint($_POST['doctor_id']) : 0;
    $appointment_date = isset($_POST['appointment_date']) ? sanitize_text_field(wp_unslash($_POST['appointment_date'])) : '';
    $package = isset($_POST['package']) ? sanitize_text_field(wp_unslash($_POST['package'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    $doctor = $doctor_id ? get_post($doctor_id) : null;
    $doctor_name = ($doctor && $doctor->post_type === 'doctors') ? $doctor->post_title : '';

    if (!$patient_name || !$patient_email || !$patient_phone || !$doctor_name || !$appointment_date) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#appointment'));
        exit;
    }

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $admin_email = kmnu_get_form_receiver_emails();
    $admin_subject = 'New Appointment Request - ' . $patient_name;

    $admin_body = '<h2>New Appointment Request</h2>';
    $admin_body .= '<p><strong>Patient Name:</strong> ' . esc_html($patient_name) . '</p>';
    $admin_body .= '<p><strong>Email:</strong> ' . esc_html($patient_email) . '</p>';
    $admin_body .= '<p><strong>Phone:</strong> ' . esc_html($patient_phone) . '</p>';
    $admin_body .= '<p><strong>Preferred Doctor:</strong> ' . esc_html($doctor_name) . '</p>';
    $admin_body .= '<p><strong>Preferred Date:</strong> ' . esc_html($appointment_date) . '</p>';
    if ($package) {
        $admin_body .= '<p><strong>Package:</strong> ' . esc_html($package) . '</p>';
    }
    if ($message) {
        $admin_body .= '<p><strong>Notes:</strong><br>' . nl2br(esc_html($message)) . '</p>';
    }

    $admin_headers = $headers;
    $admin_headers[] = 'Reply-To: ' . $patient_name . ' <' . $patient_email . '>';

    $user_subject = 'KMNU Hospital Appointment Request Confirmation';
    $user_body = '<p>Dear ' . esc_html($patient_name) . ',</p>';
    $user_body .= '<p>Thank you for booking an appointment with KMNU Hospital. We have received your request with the following details:</p>';
    $user_body .= '<p><strong>Preferred Doctor:</strong> ' . esc_html($doctor_name) . '<br>';
    $user_body .= '<strong>Preferred Date:</strong> ' . esc_html($appointment_date) . '</p>';
    if ($package) {
        $user_body .= '<p><strong>Package:</strong> ' . esc_html($package) . '</p>';
    }
    $user_body .= '<p>Our team will contact you to confirm the appointment slot.</p>';
    $user_body .= '<p>Regards,<br>KMNU Hospital</p>';

    $admin_sent = wp_mail($admin_email, $admin_subject, $admin_body, $admin_headers);
    $user_sent = wp_mail($patient_email, $user_subject, $user_body, $headers);

    if (!$admin_sent || !$user_sent) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#appointment'));
        exit;
    }

    kmnu_redirect_to_thank_you('appointment', $patient_name, array(
        'doctor' => $doctor_name,
        'date' => $appointment_date,
        'email' => $patient_email,
        'phone' => $patient_phone,
        'package' => $package,
    ));
}
add_action('admin_post_nopriv_submit_kmnu_appointment', 'kmnu_handle_appointment_submission');
add_action('admin_post_submit_kmnu_appointment', 'kmnu_handle_appointment_submission');

/**
 * Footer Subscription Form Handler
 */
function kmnu_handle_subscription_submission() {
    $fallback_url = wp_get_referer() ? wp_get_referer() : home_url('/');

    if (
        !isset($_POST['kmnu_subscription_nonce_field']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['kmnu_subscription_nonce_field'])), 'kmnu_subscription_nonce')
    ) {
        wp_safe_redirect(add_query_arg('subscription', 'error', $fallback_url));
        exit;
    }

    $subscriber_email = isset($_POST['subscriber_email']) ? sanitize_email(wp_unslash($_POST['subscriber_email'])) : '';

    if (!$subscriber_email || !is_email($subscriber_email)) {
        wp_safe_redirect(add_query_arg('subscription', 'error', $fallback_url));
        exit;
    }

    $subscriber_name = ucwords(str_replace(array('.', '_', '-'), ' ', strstr($subscriber_email, '@', true)));
    if (!$subscriber_name) {
        $subscriber_name = 'Subscriber';
    }

    $to = kmnu_get_form_receiver_emails();
    $subject = 'New KMNU Newsletter Subscription';
    $body = '<h2>New Newsletter Subscription</h2>';
    $body .= '<p><strong>Email:</strong> ' . esc_html($subscriber_email) . '</p>';
    $body .= '<p>This visitor subscribed from the KMNU website footer subscription form.</p>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $subscriber_email,
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent) {
        wp_safe_redirect(add_query_arg('subscription', 'error', $fallback_url));
        exit;
    }

    kmnu_redirect_to_thank_you('subscription', $subscriber_name, array(
        'email' => $subscriber_email,
    ));
}
add_action('admin_post_nopriv_submit_kmnu_subscription', 'kmnu_handle_subscription_submission');
add_action('admin_post_submit_kmnu_subscription', 'kmnu_handle_subscription_submission');

/**
 * Careers Form Handler (With File Attachment)
 */
function kmnu_handle_career_submission() {
    if (!isset($_POST['kmnu_nonce_field']) || !wp_verify_nonce($_POST['kmnu_nonce_field'], 'kmnu_career_nonce')) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#careers-form'));
        exit;
    }

    $full_name = sanitize_text_field($_POST['fullName']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $gender = sanitize_text_field($_POST['gender']);
    $experience = sanitize_text_field($_POST['experience']);
    $city = sanitize_text_field($_POST['city']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = kmnu_get_form_receiver_emails();
    $subject = 'New Career Application from ' . $full_name;
    
    $body = "<h2>New Career Application from KMNU Website</h2>";
    $body .= "<p><strong>Name:</strong> {$full_name}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Phone:</strong> {$phone}</p>";
    $body .= "<p><strong>Gender:</strong> {$gender}</p>";
    $body .= "<p><strong>Experience:</strong> {$experience} Years</p>";
    $body .= "<p><strong>City:</strong> {$city}</p>";
    $body .= "<p><strong>Message:</strong><br/>" . nl2br($message) . "</p>";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $full_name . ' <' . $email . '>';
    }

    $attachments = array();
    
    // Handle File Upload
    if (isset($_FILES['resumeFile']) && $_FILES['resumeFile']['error'] == UPLOAD_ERR_OK) {
        $uploaded_file = $_FILES['resumeFile'];
        $movefile = wp_handle_upload($uploaded_file, array('test_form' => false));
        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    $sent = wp_mail($to, $subject, $body, $headers, $attachments);

    // After sending, clean up the locally uploaded temp file so we don't bloat the server
    if (!empty($attachments)) {
        foreach ($attachments as $attachment) {
            @unlink($attachment);
        }
    }

    if (!$sent) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer() . '#careers-form'));
        exit;
    }

    kmnu_redirect_to_thank_you('career', $full_name, array(
        'email' => $email,
        'phone' => $phone,
        'experience' => $experience . ' Years',
        'city' => $city,
    ));
}
add_action('admin_post_nopriv_submit_kmnu_career', 'kmnu_handle_career_submission');
add_action('admin_post_submit_kmnu_career', 'kmnu_handle_career_submission');

/**
 * Configure Gmail SMTP settings for wp_mail.
 * Define KMNU_SMTP_* constants in wp-config.php; never store SMTP secrets in the theme.
 */
function kmnu_custom_phpmailer_init($phpmailer) {
    if (!defined('KMNU_SMTP_USER') || !defined('KMNU_SMTP_PASS') || KMNU_SMTP_USER === '' || KMNU_SMTP_PASS === '') {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = defined('KMNU_SMTP_HOST') ? KMNU_SMTP_HOST : 'smtp.gmail.com'; 
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = defined('KMNU_SMTP_PORT') ? KMNU_SMTP_PORT : 587; 
    $phpmailer->Username   = KMNU_SMTP_USER; 
    $phpmailer->Password   = KMNU_SMTP_PASS; 
    $phpmailer->SMTPSecure = defined('KMNU_SMTP_SECURE') ? KMNU_SMTP_SECURE : 'tls';
    $phpmailer->From       = defined('KMNU_SMTP_FROM') ? KMNU_SMTP_FROM : $phpmailer->Username;
    $phpmailer->FromName   = defined('KMNU_SMTP_FROMNAME') ? KMNU_SMTP_FROMNAME : 'KMNU Hospitals';
}
add_action('phpmailer_init', 'kmnu_custom_phpmailer_init');

function kmnu_mail_from_address($email) {
    if (defined('KMNU_SMTP_FROM')) {
        return KMNU_SMTP_FROM;
    }

    return defined('KMNU_SMTP_USER') ? KMNU_SMTP_USER : 'satyabrata@vmsoftsys.com';
}
add_filter('wp_mail_from', 'kmnu_mail_from_address');

function kmnu_mail_from_name($name) {
    return defined('KMNU_SMTP_FROMNAME') ? KMNU_SMTP_FROMNAME : 'KMNU Hospitals';
}
add_filter('wp_mail_from_name', 'kmnu_mail_from_name');

/**
 * Helper to clean Microsoft Word junk from content and generate a clean excerpt
 */
function kmnu_get_clean_excerpt($content = '', $limit = 25) {
    if (empty($content)) {
        $content = get_the_content();
    }
    
    // 0. Decode entities first to catch &gt; etc. in comments
    $content = html_entity_decode($content);

    // 1. Remove MS Word conditional comments (and common variations)
    $content = preg_replace('/<!--\[if[^\]]*\]>.*?<!\[endif\]-->/is', '', $content);
    $content = preg_replace('/<!\[if[^\]]*\]>.*?<!\[endif\]>/is', '', $content); // Non-standard MSO tags
    
    // 2. Remove <style> tags and their contents
    $content = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $content);
    
    // 3. Remove other HTML tags
    $content = wp_strip_all_tags($content);
    
    // 4. Remove leftover MSO junk text that might not have been in comments
    $content = preg_replace('/Normal\s+0\s+false\s+false\s+false\s+EN-IN\s+X-NONE\s+X-NONE/i', '', $content);
    $content = preg_replace('/\/\*\s*Style\s*Definitions\s*\*\//i', '', $content);
    $content = preg_replace('/table\.MsoNormalTable\s*\{[^\}]*\}/i', '', $content);
    
    // 5. Trim whitespace and &nbsp;
    $content = str_replace('&nbsp;', ' ', $content);
    $content = preg_replace('/\s+/', ' ', $content);
    $content = trim($content);
    
    return wp_trim_words($content, $limit, '...');
}


/**
 * AJAX Handler for Blog Post Suggestions
 */
function kmnu_get_blog_suggestions() {
    $term = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';
    
    if (empty($term)) {
        wp_send_json_error();
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        's' => $term,
        'posts_per_page' => 5
    );

    $query = new WP_Query($args);
    $suggestions = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $suggestions[] = array(
                'label' => get_the_title(),
                'value' => get_the_title(),
                'url' => get_permalink()
            );
        }
        wp_reset_postdata();
        wp_send_json_success($suggestions);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_get_blog_suggestions', 'kmnu_get_blog_suggestions');
add_action('wp_ajax_nopriv_get_blog_suggestions', 'kmnu_get_blog_suggestions');


/**
 * Register BMW Reports Custom Post Type
 */
function kmnu_register_bmw_reports_cpt() {
    $labels = array(
        'name'               => 'BMW Reports',
        'singular_name'      => 'BMW Report',
        'menu_name'          => 'BMW Reports',
        'add_new'            => 'Add New Report',
        'add_new_item'       => 'Add New Report',
        'edit_item'          => 'Edit Report',
        'new_item'           => 'New Report',
        'view_item'          => 'View Report',
        'search_items'       => 'Search Reports',
        'not_found'          => 'No reports found',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'bmw-report'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 27,
        'menu_icon'           => 'dashicons-media-document',
        'supports'            => array('title'),
    );

    register_post_type('bmw_reports', $args);
}
add_action('init', 'kmnu_register_bmw_reports_cpt');

/**
 * Add Metabox for BMW Reports
 */
function kmnu_add_bmw_metaboxes() {
    add_meta_box(
        'bmw_report_meta',
        'Report Details',
        'kmnu_render_bmw_metabox',
        'bmw_reports',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kmnu_add_bmw_metaboxes');

function kmnu_render_bmw_metabox($post) {
    wp_nonce_field('save_bmw_meta', 'bmw_meta_nonce');
    
    $year       = get_post_meta($post->ID, 'bmw_year', true);
    $month      = get_post_meta($post->ID, 'bmw_month', true);
    $pdf_url    = get_post_meta($post->ID, 'bmw_pdf', true);
    
    $categories = array(
        'red'       => 'Red Category',
        'yellow'    => 'Yellow Category',
        'cytotoxic' => 'Cytotoxic / Yellow Category',
        'blue'      => 'Blue Category',
        'white'     => 'White Category',
        'sharp'     => 'Sharp Container Category'
    );

    $years = range(date('Y'), date('Y') - 5);
    $months = array(
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
    );

    ?>
    <style>
        .bmw-meta-row { display: flex; gap: 20px; margin-bottom: 15px; align-items: center; }
        .bmw-meta-row label { font-weight: bold; width: 150px; }
        .bmw-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .bmw-table th, .bmw-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .bmw-table th { background: #f4f4f4; }
        .bmw-table input { width: 80px; }
    </style>

    <div class="bmw-meta-row">
        <label for="bmw_year">Year:</label>
        <select name="bmw_year" id="bmw_year">
            <?php foreach($years as $y): ?>
                <option value="<?php echo $y; ?>" <?php selected($year, $y); ?>><?php echo $y; ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="bmw_month" style="margin-left: 20px; width: auto;">Month:</label>
        <select name="bmw_month" id="bmw_month">
            <?php foreach($months as $m): ?>
                <option value="<?php echo $m; ?>" <?php selected($month, $m); ?>><?php echo $m; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="bmw-meta-row">
        <label for="bmw_pdf">PDF Report (URL):</label>
        <input type="text" name="bmw_pdf" id="bmw_pdf" value="<?php echo esc_url($pdf_url); ?>" style="flex: 1;" placeholder="Upload to Media Library and paste URL here" />
    </div>

    <table class="bmw-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Bags</th>
                <th>Total Weight (kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $key => $label): ?>
                <?php
                $bags = get_post_meta($post->ID, $key . '_bags', true);
                $wt   = get_post_meta($post->ID, $key . '_wt', true);
                ?>
                <tr>
                    <td><strong><?php echo $label; ?></strong></td>
                    <td><input type="number" step="1" name="<?php echo $key; ?>_bags" value="<?php echo esc_attr($bags); ?>" /></td>
                    <td><input type="number" step="0.01" name="<?php echo $key; ?>_wt" value="<?php echo esc_attr($wt); ?>" onchange="calculateTotalBMW()" class="bmw-wt-input" /></td>
                </tr>
            <?php endforeach; ?>
            <tr style="background: #eef7ff; font-weight: bold;">
                <td>TOTAL WEIGHT</td>
                <td></td>
                <td><input type="number" step="0.01" name="total_wt" id="bmw_total_wt" value="<?php echo esc_attr(get_post_meta($post->ID, 'total_wt', true)); ?>" readonly /> kg</td>
            </tr>
        </tbody>
    </table>

    <script>
    function calculateTotalBMW() {
        let total = 0;
        document.querySelectorAll('.bmw-wt-input').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('bmw_total_wt').value = total.toFixed(2);
    }
    </script>
    <?php
}

function kmnu_save_bmw_metabox($post_id) {
    if (!isset($_POST['bmw_meta_nonce']) || !wp_verify_nonce($_POST['bmw_meta_nonce'], 'save_bmw_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array(
        'bmw_year', 'bmw_month', 'bmw_pdf',
        'red_bags', 'red_wt',
        'yellow_bags', 'yellow_wt',
        'cytotoxic_bags', 'cytotoxic_wt',
        'blue_bags', 'blue_wt',
        'white_bags', 'white_wt',
        'sharp_bags', 'sharp_wt',
        'total_wt'
    );

    foreach($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $_POST[$field]);
        }
    }
}
add_action('save_post_bmw_reports', 'kmnu_save_bmw_metabox');

/**
 * AJAX Handler for BMW Reports Filter
 */
function kmnu_get_bmw_reports_ajax() {
    $year  = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';
    $month = isset($_POST['month']) ? sanitize_text_field($_POST['month']) : '';
    $view  = isset($_POST['view']) ? sanitize_text_field($_POST['view']) : 'list';

    // Query Logic
    if ($year && $month) {
        $args = array(
            'post_type'      => 'bmw_reports',
            'posts_per_page' => 1,
            'meta_query'     => array(
                'relation' => 'AND',
                array('key' => 'bmw_year', 'value' => $year, 'compare' => '='),
                array('key' => 'bmw_month', 'value' => $month, 'compare' => '=')
            )
        );
    } else {
        $args = array(
            'post_type'      => 'bmw_reports',
            'posts_per_page' => -1,
            'meta_key'       => 'bmw_year',
            'orderby'        => 'meta_value',
            'order'          => 'DESC'
        );
        if ($year) {
            $args['meta_query'] = array(
                array('key' => 'bmw_year', 'value' => $year, 'compare' => '=')
            );
        }
    }

    $query = new WP_Query($args);
    $html = '';
    $graph_data = array();

    if ($view === 'graph' || ($year && !$month)) {
        $months_order = array(
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 'May' => 5, 'June' => 6, 
            'July' => 7, 'August' => 8, 'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        );
        $temp_data = array();
        if ($query->have_posts()) {
            foreach ($query->posts as $post) {
                $y = get_post_meta($post->ID, 'bmw_year', true);
                $m = get_post_meta($post->ID, 'bmw_month', true);
                $wt = get_post_meta($post->ID, 'total_wt', true);
                if ($y && $m) $temp_data[$y][$months_order[$m]] = (float)$wt;
            }
        }
        ksort($temp_data);
        foreach ($temp_data as $y_key => $ms) {
            $sorted_ms = array();
            for ($i=1; $i<=12; $i++) $sorted_ms[] = isset($ms[$i]) ? $ms[$i] : 0;
            $graph_data[$y_key] = $sorted_ms;
        }
    }

    ob_start();
    if ($view === 'graph') {
        echo '<div class="graph-container"><canvas id="bmwTrendChart" height="120"></canvas></div>';
    } elseif ($year && $month) {
        if ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $categories = ['red', 'yellow', 'cytotoxic', 'blue', 'white', 'sharp'];
            ?>
            <div class="report-display-card">
                <div class="report-header">
                    <h2>Detailed Report: <?php echo esc_html($month . ' ' . $year); ?></h2>
                    <button onclick="generateBMW_PDF_Detail()" class="btn-download-pdf"><i class="fa-solid fa-file-pdf"></i> Generate PDF</button>
                </div>
                <div class="table-responsive">
                    <table class="bmw-data-table">
                        <thead>
                            <tr>
                                <th rowspan="2">Category</th>
                                <th colspan="2" class="th-red">Red</th>
                                <th colspan="2" class="th-yellow">Yellow</th>
                                <th colspan="2" class="th-yellow">Cytotoxic</th>
                                <th colspan="2" class="th-blue">Blue</th>
                                <th colspan="2" class="th-white">White</th>
                                <th colspan="2">Sharp</th>
                            </tr>
                            <tr>
                                <th class="th-red">Bags</th><th class="th-red">Wt</th>
                                <th class="th-yellow">Bags</th><th class="th-yellow">Wt</th>
                                <th class="th-yellow">Bags</th><th class="th-yellow">Wt</th>
                                <th class="th-blue">Bags</th><th class="th-blue">Wt</th>
                                <th class="th-white">Bags</th><th class="th-white">Wt</th>
                                <th>Bags</th><th>Wt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="category-cell">Totals</td>
                                <?php foreach($categories as $cat): ?>
                                    <td><?php echo esc_html(get_post_meta($id, $cat . '_bags', true)); ?></td>
                                    <td><?php echo esc_html(get_post_meta($id, $cat . '_wt', true)); ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr class="total-row"><td colspan="11" style="text-align: right;">GRAND TOTAL WEIGHT</td><td colspan="2"><?php echo esc_html(get_post_meta($id, 'total_wt', true)); ?> kg</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="no-report"><h3>No report found for ' . $month . ' ' . $year . '</h3></div>';
        }
    } else {
        echo '<div class="reports-grid">';
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $m = get_post_meta(get_the_ID(), 'bmw_month', true);
                $y = get_post_meta(get_the_ID(), 'bmw_year', true);
                ?>
                <div class="report-card">
                    <div class="report-card-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    <h3><?php echo esc_html($m . ' ' . $y); ?></h3>
                    <p>Waste Management Report</p>
                    <a href="javascript:void(0)" onclick="loadBMWReport('<?php echo $y; ?>', '<?php echo $m; ?>')" class="btn-view-card">View Report</a>
                </div>
                <?php
            }
        } else {
            echo '<div class="no-report"><h3>No reports available</h3></div>';
        }
        echo '</div>';
    }
    $html = ob_get_clean();

    wp_send_json_success(array('html' => $html, 'graph_data' => $graph_data));
}
add_action('wp_ajax_get_bmw_reports_ajax', 'kmnu_get_bmw_reports_ajax');
add_action('wp_ajax_nopriv_get_bmw_reports_ajax', 'kmnu_get_bmw_reports_ajax');

/**
 * Get Mobile Responsive Menu Data
 * Returns the menu structure with dynamic site URLs.
 */
function kmnu_get_mob_res_menu_data() {
    $base_url = home_url('/');
    
    $menu = array(
        'primary_menu' => array(
            array(
                'name' => 'Home',
                'link' => $base_url
            ),
            array(
                'name' => 'About Us',
                'link' => $base_url . 'about-us/',
                'submenu' => array(
                    array(
                        'name' => 'Leadership',
                        'link' => $base_url . 'about-us/#leadership'
                    ),
                    array(
                        'name' => 'Philosophy',
                        'link' => $base_url . 'about-us/#philosophy'
                    ),
                    array(
                        'name' => 'Milestones',
                        'link' => $base_url . 'about-us/#milestones'
                    ),
                    array(
                        'name' => 'Accreditations',
                        'link' => $base_url . 'about-us/#accreditations'
                    ),
                    array(
                        'name' => 'Facilities',
                        'link' => $base_url . 'about-us/#facilities'
                    ),
                    array(
                        'name' => 'Management Team',
                        'link' => $base_url . 'about-us/#our-team'
                    ),
                    array(
                        'name' => 'Organizational Structure',
                        'link' => $base_url . 'about-us/#structure'
                    )
                )
            ),
            array(
                'name' => 'Specialities',
                'link' => $base_url . 'specialities/',
                'mega_menu' => array(
                    'departments' => array(
                        array('name' => 'Obstetrics/ Gynaecology', 'link' => $base_url . 'specialities/obstetrics-gynaecology/'),
                        array('name' => 'Paediatric/ Neonatology', 'link' => $base_url . 'specialities/paediatric-neonatology/'),
                        array('name' => 'General Surgery', 'link' => $base_url . 'specialities/general-surgery/'),
                        array('name' => 'Orthopaedics', 'link' => $base_url . 'specialities/orthopaedics/'),
                        array('name' => 'Emergency Medicine', 'link' => $base_url . 'specialities/emergency-medicine/'),
                        array('name' => 'ENT', 'link' => $base_url . 'specialities/ent/'),
                        array('name' => 'ReproductiveMedicine/ IVF', 'link' => $base_url . 'specialities/reproductivemedicine-ivf/'),
                        array('name' => 'Cardiology', 'link' => $base_url . 'specialities/cardiology/'),
                        array('name' => 'Nephrology', 'link' => $base_url . 'specialities/nephrology/'),
                        array('name' => 'Urology', 'link' => $base_url . 'specialities/urology/'),
                        array('name' => 'Andrology', 'link' => $base_url . 'specialities/andrology/'),
                        array('name' => 'Anaesthesiology', 'link' => $base_url . 'specialities/anaesthesiology/'),
                        array('name' => 'Radiodignosis', 'link' => $base_url . 'specialities/radiodignosis/')
                    ),
                    'footer_button' => array(
                        'name' => 'Explore All Specialities',
                        'link' => $base_url . 'specialities/'
                    )
                )
            ),
            array(
                'name' => 'Doctors',
                'link' => $base_url . 'doctors/'
            ),
            array(
                'name' => 'Locations',
                'link' => $base_url . 'locations/'
            ),
            array(
                'name' => 'Preventive Health Checkup',
                'link' => $base_url . 'preventive-health-checkup/',
                'submenu' => array(
                    array('name' => 'Child Development Health Screening', 'link' => $base_url . 'health-package/child_health/'),
                    array('name' => 'Executive Health Check For Women', 'link' => $base_url . 'health-package/women_checkup/'),
                    array('name' => 'Executive Health Check For Men', 'link' => $base_url . 'health-package/men_checkup/'),
                    array('name' => 'Diabetic Health Checkup', 'link' => $base_url . 'health-package/diabetic_health_checkup/'),
                    array('name' => 'Kidney Health Checkup', 'link' => $base_url . 'health-package/kidney_profile/'),
                    array('name' => 'Basic Health Check', 'link' => $base_url . 'health-package/basic_health_check/'),
                    array('name' => 'Orthopaedic Health Checkup', 'link' => $base_url . 'health-package/orthopaedic_health_check/')
                )
            ),
            array(
                'name' => 'Contact Us',
                'link' => $base_url . 'contact-us/'
            )
        ),
        'header_flyout_menu' => array(
            array(
                'name' => 'Blogs',
                'link' => $base_url . 'blogs/'
            ),
            array(
                'name' => 'Careers',
                'link' => $base_url . 'careers/'
            ),
            array(
                'name' => 'Awards',
                'link' => $base_url . 'awards/'
            ),
            array(
                'name' => 'Gallery',
                'link' => $base_url . 'gallery/'
            ),
            array(
                'name' => 'News',
                'link' => $base_url . 'news/'
            ),
            array(
                'name' => 'BMW Reports',
                'link' => $base_url . 'bmw-reports/'
            ),
            array(
                'name' => 'Online Report',
                'link' => 'https://access.nuhospitals.com/PatientPortal'
            )
        )
    );

    return $menu;
}

/**
 * Register REST API Endpoint for Mobile Responsive Menu
 */
function kmnu_register_mob_res_menu_endpoint() {
    register_rest_route('kmnu/v1', '/mob-res-menu', array(
        'methods' => 'GET',
        'callback' => function() {
            return rest_ensure_response(kmnu_get_mob_res_menu_data());
        },
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'kmnu_register_mob_res_menu_endpoint');

/**
 * AJAX handler to get mobile responsive menu
 */
function kmnu_ajax_get_mob_res_menu() {
    wp_send_json_success(kmnu_get_mob_res_menu_data());
}
add_action('wp_ajax_get_mob_res_menu', 'kmnu_ajax_get_mob_res_menu');
add_action('wp_ajax_nopriv_get_mob_res_menu', 'kmnu_ajax_get_mob_res_menu');

/**
 * Add a universal Duplicate option for every editable post type in admin lists.
 */
function kmnu_get_duplicate_supported_post_types()
{
    $post_types = get_post_types(array('show_ui' => true), 'names');
    unset($post_types['attachment']);

    return apply_filters('kmnu_duplicate_supported_post_types', $post_types);
}

function kmnu_duplicate_post_action_link($actions, $post)
{
    if (!$post instanceof WP_Post) {
        return $actions;
    }

    if (!in_array($post->post_type, kmnu_get_duplicate_supported_post_types(), true)) {
        return $actions;
    }

    if (!current_user_can('edit_post', $post->ID)) {
        return $actions;
    }

    $url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => 'kmnu_duplicate_post',
                'post' => $post->ID,
            ),
            admin_url('admin.php')
        ),
        'kmnu_duplicate_post_' . $post->ID
    );

    $actions['kmnu_duplicate'] = '<a href="' . esc_url($url) . '" aria-label="' . esc_attr(sprintf('Duplicate %s', $post->post_title)) . '">Duplicate</a>';

    return $actions;
}
add_filter('post_row_actions', 'kmnu_duplicate_post_action_link', 10, 2);
add_filter('page_row_actions', 'kmnu_duplicate_post_action_link', 10, 2);

function kmnu_handle_duplicate_post_action()
{
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    $post = $post_id ? get_post($post_id) : null;

    if (!$post || !in_array($post->post_type, kmnu_get_duplicate_supported_post_types(), true)) {
        wp_die('Invalid post selected for duplication.');
    }

    if (!current_user_can('edit_post', $post_id)) {
        wp_die('You do not have permission to duplicate this item.');
    }

    check_admin_referer('kmnu_duplicate_post_' . $post_id);

    $current_user = wp_get_current_user();
    $new_post_id = wp_insert_post(
        array(
            'post_author' => $current_user->ID ?: $post->post_author,
            'post_content' => $post->post_content,
            'post_content_filtered' => $post->post_content_filtered,
            'post_title' => $post->post_title . ' - Copy',
            'post_excerpt' => $post->post_excerpt,
            'post_status' => 'draft',
            'post_type' => $post->post_type,
            'post_parent' => $post->post_parent,
            'menu_order' => $post->menu_order,
            'comment_status' => $post->comment_status,
            'ping_status' => $post->ping_status,
        ),
        true
    );

    if (is_wp_error($new_post_id)) {
        wp_die(esc_html($new_post_id->get_error_message()));
    }

    $taxonomies = get_object_taxonomies($post->post_type);
    foreach ($taxonomies as $taxonomy) {
        $terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'ids'));
        if (!is_wp_error($terms)) {
            wp_set_object_terms($new_post_id, array_map('intval', $terms), $taxonomy, false);
        }
    }

    $meta = get_post_meta($post_id);
    $skip_meta_keys = array('_edit_lock', '_edit_last');
    foreach ($meta as $meta_key => $meta_values) {
        if (in_array($meta_key, $skip_meta_keys, true)) {
            continue;
        }

        foreach ($meta_values as $meta_value) {
            add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
        }
    }

    wp_safe_redirect(
        add_query_arg(
            array(
                'post_type' => $post->post_type === 'post' ? false : $post->post_type,
                'kmnu_duplicated' => 1,
            ),
            admin_url('edit.php')
        )
    );
    exit;
}
add_action('admin_action_kmnu_duplicate_post', 'kmnu_handle_duplicate_post_action');

function kmnu_duplicate_admin_notice()
{
    if (!is_admin() || empty($_GET['kmnu_duplicated'])) {
        return;
    }

    echo '<div class="notice notice-success is-dismissible"><p>Item duplicated as a draft.</p></div>';
}
add_action('admin_notices', 'kmnu_duplicate_admin_notice');
