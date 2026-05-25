<?php
/**
 * Template Name: Book Appointment Template
 */
get_header();

$selected_doctor_id = isset($_GET['doctor_id']) ? absint($_GET['doctor_id']) : 0;
$selected_package = isset($_GET['package']) ? sanitize_text_field(wp_unslash($_GET['package'])) : '';
$doctors = get_posts(array(
    'post_type' => 'doctors',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));
$today = current_time('Y-m-d');
?>

<style>
.site-header {
    margin-bottom: -100px;
    background: transparent !important;
    box-shadow: none !important;
    position: relative;
    z-index: 130;
}
.site-header a,
.site-header i {
    color: #fff !important;
}
.appointment-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    color: #fff;
    padding: 180px 0 120px;
    text-align: center;
}
.appointment-hero h1 {
    color: #fff;
    font-size: 54px;
    font-weight: 800;
    margin: 0 0 16px;
}
.appointment-hero p {
    max-width: 680px;
    margin: 0 auto;
    font-size: 19px;
    line-height: 1.6;
    opacity: 0.92;
}
.appointment-section {
    background: #f8fafc;
    padding: 80px 0;
}
.appointment-form-wrap {
    max-width: 920px;
    margin: 0 auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
    padding: 44px;
}
.appointment-form-wrap h2 {
    color: #00468b;
    font-size: 30px;
    font-weight: 800;
    margin: 0 0 26px;
}
.appointment-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}
.appointment-field {
    margin-bottom: 20px;
}
.appointment-field label {
    display: block;
    color: #334155;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 8px;
}
.appointment-control {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #dbe3ec;
    border-radius: 10px;
    background: #f8fafc;
    padding: 14px 16px;
    font: inherit;
    color: #1f2937;
}
.appointment-control:focus {
    outline: none;
    border-color: #0065a5;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(0, 101, 165, 0.1);
}
textarea.appointment-control {
    min-height: 130px;
    resize: vertical;
}
.appointment-submit {
    border: 0;
    border-radius: 999px;
    background: linear-gradient(45deg, #0065a5, #00a3e0);
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 800;
    padding: 16px 34px;
    box-shadow: 0 12px 24px rgba(0, 101, 165, 0.2);
}
.appointment-submit:hover {
    transform: translateY(-2px);
}
.appointment-msg {
    border-radius: 10px;
    font-weight: 700;
    margin-bottom: 22px;
    padding: 14px 16px;
}
.appointment-msg.success {
    background: #dcfce7;
    color: #166534;
}
.appointment-msg.error {
    background: #fee2e2;
    color: #991b1b;
}
@media (max-width: 720px) {
    .appointment-hero h1 { font-size: 38px; }
    .appointment-form-wrap { padding: 28px 20px; }
    .appointment-row { grid-template-columns: 1fr; gap: 0; }
}
</style>

<main id="primary" class="site-main appointment-page">
    <section class="appointment-hero">
        <div class="container">
            <h1>Book Appointment</h1>
            <p>Choose your preferred doctor and date. Our appointment team will confirm the schedule with you.</p>
        </div>
    </section>

    <section class="appointment-section" id="appointment">
        <div class="container">
            <div class="appointment-form-wrap">
                <h2>Appointment Details</h2>

                <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
                    <div class="appointment-msg success">Your appointment request has been submitted. A confirmation has been sent to your email.</div>
                <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error') : ?>
                    <div class="appointment-msg error">There was a problem submitting your appointment request. Please check the form and try again.</div>
                <?php endif; ?>

                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="kmnu-appointment-form">
                    <input type="hidden" name="action" value="submit_kmnu_appointment">
                    <?php wp_nonce_field('kmnu_appointment_nonce', 'kmnu_appointment_nonce_field'); ?>
                    <?php kmnu_render_spam_protection_fields('appointment'); ?>

                    <div class="appointment-row">
                        <div class="appointment-field">
                            <label for="patient_name">Patient Name *</label>
                            <input type="text" id="patient_name" name="patient_name" class="appointment-control" required>
                        </div>
                        <div class="appointment-field">
                            <label for="patient_email">Email Address *</label>
                            <input type="email" id="patient_email" name="patient_email" class="appointment-control" required>
                        </div>
                    </div>

                    <div class="appointment-row">
                        <div class="appointment-field">
                            <label for="patient_phone">Phone Number *</label>
                            <input type="tel" id="patient_phone" name="patient_phone" class="appointment-control" required>
                        </div>
                        <div class="appointment-field">
                            <label for="appointment_date">Preferred Date *</label>
                            <input type="date" id="appointment_date" name="appointment_date" class="appointment-control" min="<?php echo esc_attr($today); ?>" required>
                        </div>
                    </div>

                    <div class="appointment-field">
                        <label for="doctor_id">Preferred Doctor *</label>
                        <select id="doctor_id" name="doctor_id" class="appointment-control" required>
                            <option value="">Select Doctor</option>
                            <?php foreach ($doctors as $doctor) : ?>
                                <option value="<?php echo esc_attr($doctor->ID); ?>" <?php selected($selected_doctor_id, $doctor->ID); ?>>
                                    <?php echo esc_html($doctor->post_title); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if ($selected_package) : ?>
                        <input type="hidden" name="package" value="<?php echo esc_attr($selected_package); ?>">
                        <div class="appointment-field">
                            <label for="package_display">Selected Package</label>
                            <input type="text" id="package_display" class="appointment-control" value="<?php echo esc_attr($selected_package); ?>" readonly>
                        </div>
                    <?php endif; ?>

                    <div class="appointment-field">
                        <label for="message">Notes</label>
                        <textarea id="message" name="message" class="appointment-control" placeholder="Share symptoms, preferred time, or any additional details."></textarea>
                    </div>

                    <button type="submit" class="appointment-submit">
                        Confirm Request <i class="fa-solid fa-calendar-check"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
