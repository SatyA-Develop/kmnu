<?php
/**
 * Template Name: Standard Page Template
 */
get_header();
?>

<style>
/* ===== GLOBAL HEADER OVERLAY ===== */
.site-header {
    margin-bottom: -100px;
    background: transparent !important;
    box-shadow: none;
    position: relative;
    z-index: 130;
}
.site-header a, .site-header i { color: #fff !important; }

.standard-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px;
    color: #fff;
    text-align: center;
    position: relative;
}
.standard-hero h1 { font-size: 48px; font-weight: 800; margin: 0; }
.hero-shape {
    position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5;
}
.hero-shape svg { width: 100%; height: 80px; }

.standard-content {
    padding: 100px 0;
    background: #fff;
    min-height: 400px;
}
.content-wrap {
    max-width: 900px;
    margin: 0 auto;
    line-height: 1.8;
    color: #444;
}
.content-wrap h2 { color: #0065a5; margin-top: 40px; }
</style>

<main class="standard-page">
    <section class="standard-hero">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="standard-content">
        <div class="container">
            <div class="content-wrap">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
