<?php
/**
 * The template for displaying all single location posts
 */

get_header();
?>

<main id="primary" class="site-main location-single">
    <?php
    while ( have_posts() ) :
        the_post();
        $directions = get_post_meta( get_the_ID(), 'location_link', true );
        $phone = get_post_meta( get_the_ID(), 'phone', true );
        $email = get_post_meta( get_the_ID(), 'email', true );

        kmnu_page_banner(array(
            'class' => 'location-single-hero',
            'title' => get_the_title(),
            'subtitle' => 'KMNU Hospital location details, available services and contact information.',
            'wave_fill' => '#fdfdfd',
        ));
        ?>
        <div class="container">

            <div class="location-profile-wrap">
                <div class="location-sidebar">
                    <div class="location-image-box">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php else : ?>
                            <img src="https://via.placeholder.com/600x400.png?text=Hospital+Image" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <div class="location-contact-actions">
                        <?php if ( $directions ) : ?>
                            <a href="<?php echo esc_url( $directions ); ?>" target="_blank" class="btn btn-directions">
                                <i class="fa-solid fa-map-location-dot"></i> Get Directions
                            </a>
                        <?php endif; ?>
                        
                        <?php if ( $phone ) : ?>
                            <a href="tel:<?php echo esc_attr( $phone ); ?>" class="btn btn-call-location">
                                <i class="fa-solid fa-phone"></i> <?php echo esc_html( $phone ); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ( $email ) : ?>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="btn btn-email-location">
                                <i class="fa-solid fa-envelope"></i> <?php echo esc_html( $email ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="location-info-content">
                    <div class="location-header-info">
                        <h1 class="location-name"><?php the_title(); ?></h1>
                        <div class="hosp-rating-single">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <span class="rating-num">4.7 (Google Review)</span>
                        </div>
                    </div>

                    <div class="location-full-details">
                        <div class="details-section">
                            <h2>About this Facility</h2>
                            <div class="bio-content">
                                <?php if ( get_the_content() ) : ?>
                                    <?php the_content(); ?>
                                <?php else : ?>
                                    <p>Welcome to <?php the_title(); ?>. We are dedicated to providing the highest quality healthcare services. Our facility is equipped with state-of-the-art medical technology and staffed by experienced professionals committed to your well-being.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="details-section">
                            <h2>Services Available</h2>
                            <div class="services-mini-grid">
                                <div class="service-mini-item">
                                    <i class="fa-solid fa-check-circle"></i> Emergency Care
                                </div>
                                <div class="service-mini-item">
                                    <i class="fa-solid fa-check-circle"></i> Outpatient Department
                                </div>
                                <div class="service-mini-item">
                                    <i class="fa-solid fa-check-circle"></i> Specialised Surgery
                                </div>
                                <div class="service-mini-item">
                                    <i class="fa-solid fa-check-circle"></i> Diagnostic Services
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    endwhile; // End of the loop.
    ?>
</main>

<style>
.location-single {
    padding: 0 0 80px;
    background: #fdfdfd;
}

.location-profile-wrap {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 60px;
}

.location-sidebar {
    position: sticky;
    top: 120px;
    height: fit-content;
}

.location-image-box {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    background: #000;
}

.location-image-box img {
    width: 100%;
    height: auto;
    display: block;
}

.location-contact-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn-directions {
    background: var(--brand-blue) !important;
    text-align: center;
}

.btn-call-location {
    background: var(--brand-orange) !important;
    text-align: center;
}

.btn-email-location {
    background: #444 !important;
    text-align: center;
}

.location-info-content {
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.02);
}

.location-header-info {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 35px;
    margin-bottom: 40px;
}

.location-name {
    font-size: 42px;
    color: var(--brand-blue);
    margin: 0 0 15px;
    font-weight: 800;
}

.hosp-rating-single {
    font-size: 20px;
    color: #ffc107;
    display: flex;
    align-items: center;
    gap: 8px;
}

.hosp-rating-single .rating-num {
    color: #888;
    font-size: 16px;
    font-weight: 600;
    margin-left: 10px;
}

.details-section {
    margin-bottom: 45px;
}

.details-section h2 {
    font-size: 28px;
    color: var(--brand-blue);
    font-weight: 800;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.details-section h2::after {
    content: '';
    flex: 1;
    height: 2px;
    background: #f0f0f0;
}

.bio-content {
    font-size: 18px;
    line-height: 1.8;
    color: #555;
}

.services-mini-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.service-mini-item {
    font-size: 17px;
    color: #444;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}

.service-mini-item i {
    color: var(--brand-light-blue);
}

@media (max-width: 992px) {
    .location-profile-wrap {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .location-sidebar {
        position: static;
        max-width: 600px;
        margin: 0 auto;
    }
}
</style>

<?php
get_footer();
