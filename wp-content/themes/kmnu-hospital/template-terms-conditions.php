<?php
/**
 * Template Name: Terms & Conditions Template
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

.legal-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px;
    color: #fff;
    text-align: center;
    position: relative;
}
.legal-hero h1 { font-size: 48px; font-weight: 800; margin: 0; }
.hero-shape {
    position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5;
}
.hero-shape svg { width: 100%; height: 80px; }

.legal-content {
    padding: 100px 0;
    background: #fff;
}
.legal-wrap {
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.8;
    color: #444;
}
</style>

<main class="legal-page">
    <section class="legal-hero">
        <div class="container">
            <h1>Terms & Conditions</h1>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="legal-content">
        <div class="container">
            <div class="legal-wrap">
                <?php
                while ( have_posts() ) :
                    the_post();
                    if (empty(get_the_content())) {
                        echo "<h2>Terms and Conditions</h2>";
                        echo "<p>By accessing this website, you are agreeing to be bound by these website Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws.</p>";
                        echo "<p>The materials contained in this website are protected by applicable copyright and trademark law.</p>";
                    } else {
                        the_content();
                    }
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
