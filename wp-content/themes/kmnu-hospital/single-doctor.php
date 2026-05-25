<?php
/**
 * The template for displaying all single doctor posts
 */

get_header();
?>

<main id="primary" class="site-main doctor-single">
    <?php
    while ( have_posts() ) :
        the_post();
        $qualification = get_post_meta( get_the_ID(), 'qualification', true );
        $profile = get_post_meta( get_the_ID(), 'profile', true );
        $specializations = wp_get_object_terms( get_the_ID(), 'specialization' );
        $doctor_subtitle = $profile ?: $qualification;
        if (!$doctor_subtitle && !empty($specializations)) {
            $doctor_subtitle = $specializations[0]->name;
        }

        kmnu_page_banner(array(
            'class' => 'doctor-single-hero',
            'title' => get_the_title(),
            'subtitle' => $doctor_subtitle,
            'wave_fill' => '#fdfdfd',
        ));
        ?>
        <div class="container">

            <div class="doctor-profile-wrap">
                <div class="doctor-sidebar">
                    <div class="doctor-image-box">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php else : ?>
                            <img src="https://via.placeholder.com/600x800.png?text=Doctor+Portrait" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( ! empty( $specializations ) ) : ?>
                        <div class="doctor-specialization-badge">
                            <?php echo esc_html( $specializations[0]->name ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="doctor-contact-actions">
                        <a href="<?php echo esc_url(add_query_arg('doctor_id', get_the_ID(), home_url('/book-appointment/'))); ?>" class="btn btn-appointment">Book Appointment</a>
                    </div>
                </div>

                <div class="doctor-info-content">
                    <div class="doctor-header-info">
                        <h1 class="doctor-name"><?php the_title(); ?></h1>
                        <?php if ( $qualification ) : ?>
                            <div class="doctor-qualification-title"><?php echo esc_html( $qualification ); ?></div>
                        <?php endif; ?>
                        <?php if ( $profile ) : ?>
                            <p class="doctor-tagline"><?php echo esc_html( $profile ); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="doctor-full-details">
                        <div class="details-section">
                            <h2>Biography / Professional Profile</h2>
                            <div class="bio-content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <?php if ( ! empty( $specializations ) ) : ?>
                            <div class="details-section">
                                <h2>Specialization</h2>
                                <div class="spec-list">
                                    <?php foreach ( $specializations as $spec ) : ?>
                                        <span class="spec-tag"><?php echo esc_html( $spec->name ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main>

<style>
.doctor-single {
    padding: 0 0 80px;
    background: #fdfdfd;
}

.doctor-profile-wrap {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 60px;
}

.doctor-sidebar {
    position: sticky;
    top: 120px;
    height: fit-content;
}

.doctor-image-box {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    background: #000;
}

.doctor-image-box img {
    width: 100%;
    height: auto;
    display: block;
}

.doctor-specialization-badge {
    display: inline-block;
    background: var(--brand-light-blue);
    color: #fff;
    padding: 8px 25px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.doctor-contact-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn-call-doctor {
    background: var(--brand-orange) !important;
    text-align: center;
}

.doctor-info-content {
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.02);
}

.doctor-header-info {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 35px;
    margin-bottom: 40px;
}

.doctor-name {
    font-size: 48px;
    color: var(--brand-blue);
    margin: 0 0 10px;
    font-weight: 800;
}

.doctor-qualification-title {
    font-size: 24px;
    color: #4d4d4d;
    font-weight: 700;
    margin-bottom: 15px;
}

.doctor-tagline {
    font-size: 19px;
    color: #777;
    margin: 0;
    line-height: 1.5;
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

.spec-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.spec-tag {
    background: #f0f4f8;
    color: var(--brand-blue);
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
}

@media (max-width: 992px) {
    .doctor-profile-wrap {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .doctor-sidebar {
        position: static;
        max-width: 500px;
        margin: 0 auto;
    }
}
</style>

<?php
get_footer();
