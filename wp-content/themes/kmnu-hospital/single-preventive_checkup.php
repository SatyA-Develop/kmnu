<?php
/**
 * Single Template for Preventive Health Checkups
 */
get_header();

$price = get_post_meta(get_the_ID(), 'price', true);
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

/* ===== SINGLE HERO BANNER ===== */
.single-checkup-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px;
    color: #fff;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.single-checkup-hero h1 {
    font-size: 52px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #fff;
}

.badge-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.checkup-badge {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.price-badge-hero {
    background: #ff9933;
    color: #fff;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
}

/* ===== CONTENT SECTION ===== */
.single-checkup-content {
    padding: 80px 0 120px;
    background: #f8fafc;
}

.checkup-content-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 50px;
    align-items: start;
}

.checkup-main-image {
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    position: relative;
}

.checkup-main-image img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.8s ease;
}

.checkup-main-image:hover img {
    transform: scale(1.05);
}

.checkup-details-box {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}

.checkup-details-box h2 {
    font-size: 28px;
    color: #00468b;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f1f5f9;
}

.checkup-details-list {
    color: #444;
    font-size: 16px;
    line-height: 1.8;
}

/* Treat comma-separated desc as a list visually */
.checkup-details-list p {
    margin-bottom: 0;
}

.checkup-sidebar {
    position: sticky;
    top: 120px;
}

.booking-card {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,70,139,0.08);
    text-align: center;
    border: 1px solid #eef2f6;
}

.booking-card h3 {
    color: #00468b;
    font-size: 24px;
    margin-bottom: 15px;
}

.booking-card p {
    color: #64748b;
    margin-bottom: 30px;
}

.booking-price {
    font-size: 48px;
    color: #ff9933;
    font-weight: 900;
    margin-bottom: 30px;
    line-height: 1;
}

.booking-price span {
    font-size: 20px;
    color: #94a3b8;
    font-weight: 600;
}

.btn-book-action {
    display: block;
    background: linear-gradient(45deg, var(--brand-blue), #00a3e0);
    color: #fff !important;
    padding: 18px 30px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 800;
    text-decoration: none;
    transition: 0.4s;
    box-shadow: 0 10px 25px rgba(0,101,165,0.2);
}

.btn-book-action:hover {
    background: linear-gradient(45deg, var(--brand-orange), #ffb366);
    box-shadow: 0 15px 35px rgba(255,153,51,0.3);
    transform: translateY(-5px);
}

.features-list {
    margin-top: 30px;
    text-align: left;
    list-style: none;
    padding: 0;
}

.features-list li {
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    color: #64748b;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.features-list li i {
    color: #00a3e0;
}

/* Package Navigation */
.package-navigation {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid #eef2f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.nav-link-wrap {
    flex: 1;
}

.nav-link-wrap a {
    display: flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
    padding: 20px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: 0.3s;
    color: #00468b;
    border: 1px solid transparent;
}

.nav-link-wrap a:hover {
    box-shadow: 0 15px 30px rgba(0,70,139,0.08);
    transform: translateY(-3px);
    border-color: rgba(0,163,224,0.2);
}

.nav-link-wrap.next a {
    flex-direction: row-reverse;
    text-align: right;
}

.nav-link-wrap i {
    font-size: 24px;
    color: #4db8ff;
    transition: 0.3s;
}

.nav-label {
    display: block;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 700;
    color: #94a3b8;
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.nav-title {
    display: block;
    font-size: 18px;
    font-weight: 800;
}

.nav-link-wrap a:hover i {
    color: var(--brand-orange);
}

/* Responsiveness */
@media (max-width: 992px) {
    .checkup-content-grid { grid-template-columns: 1fr; }
    .checkup-sidebar { position: static; }
}
@media (max-width: 768px) {
    .single-checkup-page,
    .single-checkup-content {
        overflow-x: hidden;
    }
    .single-checkup-page .container {
        width: 100%;
        max-width: 100%;
        padding-left: 18px;
        padding-right: 18px;
        box-sizing: border-box;
    }
    .single-checkup-hero h1 { font-size: 36px; }
    .single-checkup-content {
        padding-top: 42px;
        padding-bottom: 74px;
    }
    .checkup-content-grid,
    .checkup-main-col,
    .checkup-sidebar,
    .checkup-main-image,
    .checkup-details-box,
    .booking-card {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }
    .checkup-details-box,
    .booking-card {
        padding: 28px 22px;
        border-radius: 18px;
    }
    .checkup-details-box h2,
    .booking-card h3 {
        font-size: 24px;
        line-height: 1.35;
    }
    .checkup-details-list ul {
        column-count: 1 !important;
        column-gap: 0 !important;
        padding-left: 20px !important;
    }
    .btn-book-action {
        width: 100%;
        box-sizing: border-box;
        padding-left: 18px;
        padding-right: 18px;
    }
    .features-list li {
        align-items: flex-start;
        line-height: 1.5;
    }
    .package-navigation {
        flex-direction: column;
        gap: 14px;
    }
    .nav-link-wrap,
    .nav-link-wrap a {
        width: 100%;
        box-sizing: border-box;
    }
}
</style>

<main id="primary" class="site-main single-checkup-page">
    
    <!-- Hero Banner -->
    <section class="kmnu-standard-hero single-checkup-hero">
        <div class="container">
            <div class="badge-wrapper">
                <span class="checkup-badge">Wellness Package</span>
                <?php if ($price) : ?>
                    <span class="price-badge-hero">₹<?php echo esc_html($price); ?></span>
                <?php endif; ?>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="hero-shape kmnu-standard-hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Content Area -->
    <section class="single-checkup-content">
        <div class="container">
            <div class="checkup-content-grid">
                
                <!-- Main Details -->
                <div class="checkup-main-col">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="checkup-main-image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="checkup-details-box">
                        <h2>What's Included in this Package</h2>
                        <div class="checkup-details-list">
                            <?php 
                            // The raw text might be a comma separated list. Let's make it look nicer.
                            $content = get_the_content();
                            $items = explode(', ', $content);
                            if (count($items) > 3) {
                                echo '<ul style="column-count: 2; column-gap: 40px; list-style-type: disc; padding-left: 20px;">';
                                foreach($items as $item) {
                                    echo '<li style="margin-bottom:10px;">' . esc_html(trim($item)) . '</li>';
                                }
                                echo '</ul>';
                            } else {
                                the_content();
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Sticky Sidebar Booking -->
                <div class="checkup-sidebar">
                    <div class="booking-card">
                        <h3>Secure Your Health Today</h3>
                        <p>Early detection saves lives. Schedule your comprehensive checkup now.</p>
                        
                        <?php if ($price) : ?>
                            <div class="booking-price">₹<?php echo esc_html($price); ?></div>
                        <?php endif; ?>

                        <a href="<?php echo esc_url(add_query_arg('package', get_the_title(), home_url('/book-appointment/'))); ?>" class="btn-book-action">
                            Book Appointment Now
                        </a>

                        <ul class="features-list">
                            <li><i class="fa-solid fa-check-circle"></i> Priority Scheduling</li>
                            <li><i class="fa-solid fa-check-circle"></i> Complete Medical Report</li>
                            <li><i class="fa-solid fa-check-circle"></i> Expert Doctor Consultation</li>
                            <li><i class="fa-solid fa-check-circle"></i> Zero Waiting Time Guarantee</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Package Navigation -->
            <div class="package-navigation">
                <div class="nav-link-wrap prev">
                    <?php 
                    $prev_post = get_previous_post();
                    if (!empty($prev_post)): ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>">
                            <i class="fa-solid fa-arrow-left"></i>
                            <div>
                                <span class="nav-label">Previous Package</span>
                                <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="nav-link-wrap next">
                    <?php 
                    $next_post = get_next_post();
                    if (!empty($next_post)): ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>">
                            <i class="fa-solid fa-arrow-right"></i>
                            <div>
                                <span class="nav-label">Next Package</span>
                                <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
