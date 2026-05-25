<?php
/**
 * The template for displaying 404 pages (not found)
 */
get_header();
?>

<style>
/* KMNU Transparent Header Setup (matching other internal pages) */
.site-header {
    margin-bottom: -100px;
    background: transparent !important;
    box-shadow: none !important;
    position: relative;
    z-index: 1000;
}

.site-header a,
.site-header i {
    color: #fff !important;
}

/* Page Hero for 404 */
.page-hero-404 {
    position: relative;
    padding: 220px 0 150px;
    background: linear-gradient(135deg, rgba(0, 70, 139, 0.95), rgba(0, 180, 216, 0.85)), url('<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/KM-NU-Logo-scaled.jpg' ) ); ?>');
    background-size: cover;
    background-position: center;
    color: #fff;
    text-align: center;
    overflow: hidden;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-404-inner {
    position: relative;
    z-index: 2;
}

.hero-title-404 {
    font-size: 120px;
    font-weight: 900;
    margin-bottom: 10px;
    animation: fadeInDown 0.8s ease-out;
    line-height: 1;
    text-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.hero-subtitle-404 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.hero-desc-404 {
    font-size: 18px;
    max-width: 600px;
    margin: 0 auto 40px;
    opacity: 0.9;
    animation: fadeInUp 0.8s ease-out 0.4s both;
    line-height: 1.6;
}

.btn-home {
    display: inline-block;
    background: var(--brand-orange, #f26522);
    color: #fff !important;
    padding: 16px 40px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    transition: 0.3s;
    animation: fadeInUp 0.8s ease-out 0.6s both;
    box-shadow: 0 10px 20px rgba(242, 101, 34, 0.3);
}

.btn-home:hover {
    background: #d9581b;
    transform: translateY(-3px);
    box-shadow: 0 15px 25px rgba(242, 101, 34, 0.4);
}

.hero-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

.hero-shape svg {
    width: 100%;
    height: 100px;
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<main class="page-main">
    <section class="page-hero-404">
        <div class="container hero-404-inner">
            <h1 class="hero-title-404">404</h1>
            <h2 class="hero-subtitle-404">Page Not Found</h2>
            <p class="hero-desc-404">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's get you back on track.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-home"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Return Home</a>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>
</main>

<?php get_footer(); ?>
