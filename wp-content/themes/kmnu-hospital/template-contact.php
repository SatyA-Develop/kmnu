<?php
/**
 * Template Name: Contact Us Template
 */
get_header();

// Fetch specialities for the dropdown
$specialities = get_terms(array(
    'taxonomy' => 'specialization',
    'hide_empty' => false,
));
?>

<style>
/* ===== GLOBAL HEADER OVERLAY ===== */
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

/* ===== HERO BANNER ===== */
.contact-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 140px;
    color: #fff;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.contact-hero h1 {
    font-size: 56px;
    font-weight: 800;
    margin-bottom: 20px;
}

.contact-hero p {
    font-size: 20px;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
}

.hero-shape {
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 5;
}

.hero-shape svg {
    width: 100%;
    height: 100px;
}

/* ===== CONTACT SECTION ===== */
.contact-section {
    padding: 100px 0;
    background: #f8fafc;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 50px;
}

/* Contact Info Cards */
.contact-info-wrap {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.contact-card {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    display: flex;
    align-items: flex-start;
    gap: 20px;
    transition: 0.3s;
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 101, 165, 0.1);
}

.contact-card .icon {
    width: 60px;
    height: 60px;
    background: #f0f7ff;
    color: var(--brand-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 24px;
    flex-shrink: 0;
}

.contact-card h3 {
    font-size: 20px;
    margin: 0 0 10px;
    color: #00468b;
}

.contact-card p, .contact-card a {
    color: #64748b;
    font-size: 16px;
    line-height: 1.6;
    text-decoration: none;
    margin: 0;
}

.contact-card a:hover {
    color: var(--brand-orange);
}

/* Contact Form */
.contact-form-wrap {
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}

.contact-form-wrap h2 {
    font-size: 32px;
    color: #00468b;
    margin-bottom: 30px;
    font-weight: 800;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #444;
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #f8fafc;
    font-size: 16px;
    transition: 0.3s;
    box-sizing: border-box;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: var(--brand-blue);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(0, 101, 165, 0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 150px;
}

.btn-submit {
    background: linear-gradient(45deg, var(--brand-blue), #00a3e0);
    color: #fff;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 10px 20px rgba(0, 101, 165, 0.2);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0, 101, 165, 0.3);
}

/* Form Message Responses */
.form-msg {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    display: none;
}
.form-msg.success { background: #d4edda; color: #155724; display: block; }
.form-msg.error { background: #f8d7da; color: #721c24; display: block; }

/* Responsive */
@media (max-width: 992px) {
    .contact-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .form-row { grid-template-columns: 1fr; }
    .contact-hero h1 { font-size: 40px; }
}
</style>

<main id="primary" class="site-main contact-page-wrapper">
    <!-- Hero Banner -->
    <section class="contact-hero">
        <div class="container relative">
            <h1>Contact Us</h1>
            <p>Get in touch with KMNU Hospital. Our team is ready to assist you with your highly specialized healthcare needs.</p>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="contact-section" id="appointment">
        <div class="container">
            <div class="contact-grid">
                
                <!-- Left: Info Cards -->
                <div class="contact-info-wrap">
                    <div class="contact-card">
                        <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="info">
                            <h3>Our Location</h3>
                            <p>75/2F2, NH 48, MC Road, Solur,<br>Ambur - 635 814, Tirupattur (Dt.),<br>Tamilnadu.</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <div class="info">
                            <h3>Contact Number</h3>
                            <p>Emergency & Helplines</p>
                            <a href="tel:+918431314141"><strong>+91 8431314141</strong></a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                        <div class="info">
                            <h3>Email Address</h3>
                            <p>For inquiries and support</p>
                            <a href="mailto:care.ambur@nuhospitals.com"><strong>care.ambur@nuhospitals.com</strong></a>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="contact-form-wrap">
                    <h2>Send Us a Message</h2>
                    
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                        <div class="form-msg success">Your message has been sent successfully. We will get back to you soon.</div>
                    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error') : ?>
                        <div class="form-msg error">There was a problem sending your message. Please try again or call us.</div>
                    <?php endif; ?>

                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="kmnu-contact-form">
                        <input type="hidden" name="action" value="submit_kmnu_contact">
                        <?php wp_nonce_field('kmnu_contact_nonce', 'kmnu_nonce_field'); ?>
                        <?php kmnu_render_spam_protection_fields('contact'); ?>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required placeholder="John">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Doe">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" name="phone" id="phone" class="form-control" required placeholder="+91 xxxxx xxxxx">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="speciality">Select Speciality / Department *</label>
                            <select name="speciality" id="speciality" class="form-control" required>
                                <option value="" disabled selected>-- Select Speciality --</option>
                                <?php 
                                if (!empty($specialities) && !is_wp_error($specialities)) {
                                    foreach ($specialities as $spec) {
                                        echo '<option value="' . esc_attr($spec->name) . '">' . esc_html($spec->name) . '</option>';
                                    }
                                }
                                ?>
                                <option value="General Inquiry">General Inquiry / Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea name="message" id="message" class="form-control" placeholder="How can we help you?"></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            Send Message <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
