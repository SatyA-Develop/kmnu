<?php
/**
 * Template Name: Locations Template
 */
get_header();
?>

<style>
/* ===== HEADER OVERLAY (Like About Us) ===== */
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

/* ===== HERO SECTION (Like About Us) ===== */
.locations-hero {
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

.locations-hero-content {
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

.locations-hero h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 25px;
}

.locations-hero h1 span {
    color: #ff9933;
}

.locations-hero p {
    font-size: 20px;
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 35px;
}

.locations-hero-image {
    flex: 1;
    position: relative;
}

.locations-hero-image img {
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

/* ===== LOCATIONS GRID (Like Home Page) ===== */
.locations-grid-section {
    padding: 100px 0;
    background: #f8fafc;
}

.locations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 40px;
}

/* Re-using Home Page Hospital Card styles */
.hospital-card {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    transition: 0.4s ease;
    border: 1px solid #f1f5f9;
}

.hospital-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 70, 139, 0.1);
    border-color: #0065a5;
}

.hosp-image {
    height: 280px;
    position: relative;
    overflow: hidden;
}

.hosp-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s ease;
}

.hospital-card:hover .hosp-image img {
    transform: scale(1.1);
}

.get-directions {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: var(--brand-blue);
    color: #fff !important;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    transform: translateY(10px);
    opacity: 0;
    transition: 0.3s ease;
}

.hospital-card:hover .get-directions {
    transform: translateY(0);
    opacity: 1;
}

.hosp-info {
    padding: 30px;
}

.hosp-info h3 {
    margin: 0 0 15px;
    font-size: 24px;
    color: #00468b;
    font-weight: 800;
    line-height: 1.3;
}

.hosp-rating {
    display: flex;
    align-items: center;
    gap: 12px;
}

.google-ico {
    width: 20px;
    height: 20px;
}

.stars {
    color: #ffc107;
    font-size: 14px;
}

.rating-num {
    color: #64748b;
    font-weight: 700;
    font-size: 14px;
}

/* Responsiveness */
@media (max-width: 992px) {
    .hero-flex { flex-direction: column; text-align: center; }
    .locations-hero h1 { font-size: 42px; }
}

@media (max-width: 768px) {
    .locations-page,
    .locations-grid-section {
        overflow-x: hidden;
    }
    .locations-page .container {
        width: 100%;
        max-width: 100%;
        padding-left: 18px;
        padding-right: 18px;
        box-sizing: border-box;
    }
    .locations-grid {
        grid-template-columns: 1fr;
        width: 100%;
        max-width: 100%;
        justify-items: center;
    }
    .hospital-card {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    .hosp-info {
        padding: 24px 22px;
    }
    .hosp-info h3 {
        font-size: 24px;
        line-height: 1.25;
    }
    .hosp-rating {
        flex-wrap: wrap;
        gap: 8px;
    }
}
</style>

<main id="primary" class="site-main locations-page">
    <!-- Hero Section -->
    <section class="locations-hero">
        <div class="container">
            <div class="hero-flex">
                <div class="locations-hero-content">
                    <span class="sub-title">Our Network</span>
                    <h1>Healing Spaces, <br><span>Near You.</span></h1>
                    <p>Experience world-class healthcare at a location convenient for you. Our network of hospitals is equipped with advanced technology and compassionate experts across the region.</p>
                </div>
                <div class="locations-hero-image">
                    <img src="https://images.pexels.com/photos/236380/pexels-photo-236380.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Modern Hospital Building">
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Locations Grid Section -->
    <section class="locations-grid-section">
        <div class="container">
            <div class="locations-grid">
                <?php
                $args = array(
                    'post_type' => 'locations',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $directions = get_post_meta(get_the_ID(), 'location_link', true);
                        ?>
                        <article class="hospital-card">
                            <div class="hosp-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <img src="https://via.placeholder.com/600x400.png?text=Hospital+Facility" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                                
                                <?php if ($directions) : ?>
                                    <a href="<?php echo esc_url($directions); ?>" target="_blank" class="get-directions">
                                        GET DIRECTIONS <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="hosp-info">
                                <h3><?php
                                    $title = get_the_title();
                                    echo str_replace(', ', ',<br>', $title);
                                ?></h3>
                                <div class="hosp-rating">
                                    <img src="https://www.google.com/favicon.ico" alt="Google" class="google-ico">
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <span class="rating-num">4.7</span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>No locations found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
