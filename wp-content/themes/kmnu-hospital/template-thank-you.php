<?php
/**
 * Template Name: Thank You Template
 */
get_header();

$token = isset($_GET['ref']) ? sanitize_text_field(wp_unslash($_GET['ref'])) : '';
$payload = $token ? get_transient('kmnu_thank_you_' . $token) : false;

$form_type = is_array($payload) && !empty($payload['form_type']) ? $payload['form_type'] : 'generic';
$name = is_array($payload) && !empty($payload['name']) ? $payload['name'] : 'there';
$details = is_array($payload) && !empty($payload['details']) ? (array) $payload['details'] : array();

$content = array(
    'contact' => array(
        'title' => 'Thank you for contacting us',
        'message' => 'Our team has received your message and will get back to you soon.',
        'icon' => 'fa-envelope-open-text',
        'summary_title' => 'Contact Request Summary',
    ),
    'appointment' => array(
        'title' => 'Thank you for booking an appointment',
        'message' => 'Your appointment request has been received. A confirmation has been sent to your email, and our team will contact you to confirm the slot.',
        'icon' => 'fa-calendar-check',
        'summary_title' => 'Appointment Request Summary',
    ),
    'career' => array(
        'title' => 'Thank you for applying',
        'message' => 'Your career application has been received. Our HR team will review your details and contact you if your profile matches an open role.',
        'icon' => 'fa-briefcase',
        'summary_title' => 'Application Summary',
    ),
    'subscription' => array(
        'title' => 'Thank you for subscribing',
        'message' => 'You have been added to our health updates list. We will share useful hospital news and expert health insights with you.',
        'icon' => 'fa-envelope-circle-check',
        'summary_title' => 'Subscription Summary',
    ),
    'generic' => array(
        'title' => 'Thank you',
        'message' => 'Your submission has been received.',
        'icon' => 'fa-circle-check',
        'summary_title' => 'Submission Summary',
    ),
);

$page_data = isset($content[$form_type]) ? $content[$form_type] : $content['generic'];
$labels = array(
    'speciality' => 'Selected Speciality',
    'doctor' => 'Preferred Doctor',
    'date' => 'Preferred Date',
    'email' => 'Email',
    'phone' => 'Phone',
    'package' => 'Package',
    'experience' => 'Experience',
    'city' => 'City',
);
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
.thank-you-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    color: #fff;
    padding: 180px 0 110px;
    text-align: center;
}
.thank-you-hero h1 {
    color: #fff;
    font-size: 52px;
    font-weight: 800;
    margin: 0 0 16px;
}
.thank-you-hero p {
    max-width: 700px;
    margin: 0 auto;
    font-size: 19px;
    line-height: 1.6;
    opacity: 0.92;
}
.thank-you-section {
    background: #f8fafc;
    padding: 80px 0;
}
.thank-you-card {
    max-width: 860px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.06);
    padding: 46px;
    text-align: center;
}
.thank-you-icon {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    background: #e8f6ff;
    color: #0065a5;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 38px;
    margin-bottom: 24px;
}
.thank-you-card h2 {
    color: #00468b;
    font-size: 30px;
    font-weight: 800;
    margin: 0 0 12px;
}
.thank-you-card > p {
    color: #475569;
    font-size: 17px;
    line-height: 1.7;
    margin: 0 auto 30px;
    max-width: 650px;
}
.thank-you-summary {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    margin: 0 auto 30px;
    max-width: 640px;
    padding: 24px;
    text-align: left;
}
.thank-you-summary h3 {
    color: #00468b;
    font-size: 20px;
    margin: 0 0 16px;
}
.thank-you-summary dl {
    display: grid;
    grid-template-columns: 180px 1fr;
    gap: 10px 18px;
    margin: 0;
}
.thank-you-summary dt {
    color: #64748b;
    font-weight: 700;
}
.thank-you-summary dd {
    color: #1f2937;
    margin: 0;
}
.thank-you-actions {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}
.thank-you-btn {
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    padding: 14px 26px;
    text-decoration: none;
}
.thank-you-btn.primary {
    background: #0065a5;
    color: #fff;
}
.thank-you-btn.secondary {
    background: #eef6fb;
    color: #0065a5;
}
@media (max-width: 700px) {
    .thank-you-hero h1 { font-size: 36px; }
    .thank-you-card { padding: 32px 20px; }
    .thank-you-summary dl { grid-template-columns: 1fr; }
}
</style>

<main id="primary" class="site-main thank-you-page">
    <section class="thank-you-hero">
        <div class="container">
            <h1><?php echo esc_html($page_data['title']); ?></h1>
            <p><?php echo esc_html($page_data['message']); ?></p>
        </div>
    </section>

    <section class="thank-you-section">
        <div class="container">
            <div class="thank-you-card">
                <div class="thank-you-icon"><i class="fa-solid <?php echo esc_attr($page_data['icon']); ?>"></i></div>
                <h2>Thank you, <?php echo esc_html($name); ?>.</h2>
                <p><?php echo esc_html($page_data['message']); ?></p>

                <?php if (!empty($details)) : ?>
                    <div class="thank-you-summary">
                        <h3><?php echo esc_html($page_data['summary_title']); ?></h3>
                        <dl>
                            <?php foreach ($details as $key => $value) :
                                if ($value === '') continue;
                                $label = isset($labels[$key]) ? $labels[$key] : ucwords(str_replace('_', ' ', $key));
                            ?>
                                <dt><?php echo esc_html($label); ?></dt>
                                <dd><?php echo esc_html($value); ?></dd>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                <?php endif; ?>

                <div class="thank-you-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="thank-you-btn primary">Back to Home</a>
                    <a href="<?php echo esc_url(home_url('/doctors/')); ?>" class="thank-you-btn secondary">View Doctors</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
