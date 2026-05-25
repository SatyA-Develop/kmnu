<?php
/**
 * Template Name: Videos Template
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

.videos-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px;
    color: #fff;
    text-align: center;
    position: relative;
}
.videos-hero h1 { font-size: 48px; font-weight: 800; margin: 0; }
.hero-shape {
    position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5;
}
.hero-shape svg { width: 100%; height: 80px; }

.videos-section {
    padding: 100px 0;
    background: #fff;
}
.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 30px;
}
.video-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.video-card:hover { transform: translateY(-5px); }
.video-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
}
.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
.video-info {
    padding: 20px;
}
.video-info h3 { margin: 0; font-size: 18px; color: #333; }

@media (max-width: 576px) {
    .video-grid { grid-template-columns: 1fr; }
}
</style>

<main class="videos-page">
    <section class="videos-hero">
        <div class="container">
            <h1>Health Videos</h1>
            <p>Informative videos from our experts</p>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="videos-section">
        <div class="container">
            <div class="video-grid">
                <!-- Example Video 1 -->
                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <h3>Understanding Kidney Health</h3>
                    </div>
                </div>

                <!-- Example Video 2 -->
                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <h3>Modern Urology Procedures</h3>
                    </div>
                </div>

                <!-- Example Video 3 -->
                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <h3>Patient Care Excellence</h3>
                    </div>
                </div>
            </div>

            <div class="content-extra mt-5">
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
