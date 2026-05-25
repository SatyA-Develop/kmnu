<?php
/**
 * The template for displaying Specialization taxonomy archives (Doctors list)
 */
get_header();
$current_term = get_queried_object();
?>

<main id="primary" class="site-main specialization-archive section-padding">
    <div class="container">
        <header class="archive-header text-center mb-5">
            <h1 class="page-title"><?php echo esc_html( $current_term->name ); ?> Specialists</h1>
            <div class="archive-description mt-3">
                <p><?php echo wp_kses_post( $current_term->description ); ?></p>
            </div>
        </header>

        <div class="specialists-grid d-flex flex-wrap gap-4 justify-content-center">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    $qualification = get_post_meta( get_the_ID(), 'qualification', true );
                    $profile = get_post_meta( get_the_ID(), 'profile', true );
                    ?>
                    <div class="doctor-card text-center" style="width: 320px;">
                        <div class="doc-image" style="background: #000; height: 320px; overflow: hidden; border-radius: 10px 10px 0 0;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            <?php else : ?>
                                <img src="https://via.placeholder.com/400x450.png?text=Doctor+Portrait" alt="<?php the_title(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="doc-info" style="padding: 25px 20px; background: #f8f9fa; border-radius: 0 0 10px 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                            <h3 style="font-size: 20px; color: #333; font-weight: 800; margin-bottom: 5px;"><?php the_title(); ?></h3>
                            <?php if ( $qualification ) : ?>
                                <p class="doc-qualification" style="font-size: 14px; color: #555; font-weight: 500; margin-bottom: 5px; line-height: 1.3;"><strong><?php echo esc_html( $qualification ); ?></strong></p>
                            <?php endif; ?>
                            <?php if ( $profile ) : ?>
                                <p class="doc-profile" style="font-size: 13px; color: #666; margin-bottom: 20px; line-height: 1.4; min-height: 36px;"><?php echo esc_html( $profile ); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn-profile" style="display: inline-block; background: var(--brand-blue, #0065a5); color: #fff; text-decoration: none; padding: 10px 30px; border-radius: 5px; font-size: 14px; font-weight: 700; text-transform: uppercase;">VIEW PROFILE</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="no-results text-center">No specialists found in <?php echo esc_html( $current_term->name ); ?>.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
.specialists-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
}
.section-padding {
    padding: 80px 0;
}
.mb-5 { margin-bottom: 3rem; }
.mt-3 { margin-top: 1rem; }
.text-center { text-align: center; }
</style>

<?php
get_footer();
