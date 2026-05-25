<?php
/**
 * Template Name: Preventive Health Checkup
 */
get_header();
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
.checkup-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 140px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.hero-flex {
    display: flex;
    align-items: center;
    gap: 60px;
}

.checkup-hero-content {
    flex: 1;
}

.sub-title {
    display: inline-block;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 25px;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.checkup-hero h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 25px;
}

.checkup-hero h1 span {
    color: #ff9933;
}

.checkup-hero p {
    font-size: 20px;
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 35px;
}

.checkup-hero-image {
    flex: 1;
    position: relative;
}

.checkup-hero-image img {
    width: 100%;
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
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

/* ===== PACKAGES GRID ===== */
.checkup-grid-section {
    padding: 100px 0;
    background: #f8fafc;
}

.checkup-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 40px;
}

.package-card {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid #f1f5f9;
    display: flex;
    flex-direction: column;
}

.package-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 30px 60px rgba(0, 70, 139, 0.12);
    border-color: #00a3e0;
}

.package-image {
    height: 220px;
    position: relative;
    overflow: hidden;
    background: #eef2f6;
}

.package-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.7s ease;
}

.package-card:hover .package-image img {
    transform: scale(1.1) rotate(2deg);
}

.package-price-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #ff9933;
    color: #fff;
    padding: 8px 15px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 18px;
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
    z-index: 10;
}

.package-info {
    padding: 30px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.package-info h3 {
    margin: 0 0 15px;
    font-size: 22px;
    color: #00468b;
    font-weight: 800;
    line-height: 1.3;
}

.package-info .desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 25px;
    flex: 1;
}

.package-info .desc strong {
    color: #444;
}

.package-footer {
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    gap: 15px;
    align-items: center;
}

.btn-view-details {
    background: transparent;
    color: var(--brand-blue) !important;
    padding: 10px 0;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s;
    flex: 1;
    text-align: center;
}

.btn-view-details:hover {
    color: var(--brand-orange) !important;
}

.btn-book-package {
    background: linear-gradient(45deg, #00468b, #0065a5);
    color: #fff !important;
    padding: 12px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: 0.3s;
    flex: 1;
    text-align: center;
    box-sizing: border-box;
    box-shadow: 0 10px 20px rgba(0, 101, 165, 0.2);
}

.package-card:hover .btn-book-package {
    background: linear-gradient(45deg, var(--brand-orange), #ffb366);
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
    transform: translateY(-2px);
}

/* Responsiveness */
@media (max-width: 992px) {
    .hero-flex { flex-direction: column; text-align: center; }
}

@media (max-width: 768px) {
    .checkup-grid { grid-template-columns: 1fr; }
    .checkup-hero h1 { font-size: 42px; }
}
</style>

<main id="primary" class="site-main checkup-page">
    
    <!-- Hero Banner -->
    <?php
    kmnu_page_banner(array(
        'class' => 'checkup-standard-hero',
        'title' => 'Preventive Health Checkups',
        'subtitle' => 'Detect early, live healthy. Our comprehensive health packages are designed by experts to give you a complete understanding of your well-being, tailored to every life stage.',
        'wave_fill' => '#f8fafc',
    ));
    ?>

    <!-- Packages Grid -->
    <section class="checkup-grid-section">
        <div class="container">
            <div class="checkup-grid">
                <?php
                $args = array(
                    'post_type' => 'preventive_checkup',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order', 
                    'order' => 'ASC'
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $price = get_post_meta(get_the_ID(), 'price', true);
                        ?>
                        <article class="package-card">
                            <div class="package-image">
                                <?php if ($price) : ?>
                                    <div class="package-price-badge">₹<?php echo esc_html($price); ?></div>
                                <?php endif; ?>

                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <img src="https://via.placeholder.com/600x400.png?text=Health+Package" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="package-info">
                                <h3><?php the_title(); ?></h3>
                                <div class="desc">
                                    <strong>Includes:</strong><br> 
                                    <?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
                                </div>
                                <div class="package-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn-view-details">View Details</a>
                                    <a href="<?php echo esc_url(add_query_arg('package', get_the_title(), home_url('/book-appointment/'))); ?>" class="btn-book-package">Book Now</a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>No health checkup packages found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
