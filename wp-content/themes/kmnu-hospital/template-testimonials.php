<?php
/**
 * Template Name: Testimonials Template
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

.testimonials-hero {
    background: linear-gradient(135deg, #00468b 0%, #0065a5 100%);
    padding: 180px 0 100px;
    color: #fff;
    text-align: center;
    position: relative;
}
.testimonials-hero h1 { font-size: 48px; font-weight: 800; margin: 0; }
.hero-shape {
    position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5;
}
.hero-shape svg { width: 100%; height: 80px; }

.testimonials-section {
    padding: 100px 0;
    background: #f8f9fa;
}
.testimonial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}
.testimonial-card {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    position: relative;
    transition: transform 0.3s ease;
}
.testimonial-card:hover { transform: translateY(-10px); }
.testimonial-card i.fa-quote-left {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 30px;
    color: #0065a5;
    opacity: 0.1;
}
.testimonial-content {
    font-style: italic;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}
.author-avatar {
    width: 50px;
    height: 50px;
    background: #0065a5;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}
.author-info h4 { margin: 0; font-size: 16px; color: #333; }
.author-info span { font-size: 13px; color: #888; }
</style>

<main class="testimonials-page">
    <section class="testimonials-hero">
        <div class="container">
            <h1>Patient Testimonials</h1>
            <p>What our patients say about their experience at KMNU Hospital</p>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="testimonial-grid">
                <!-- Example Testimonial 1 -->
                <div class="testimonial-card">
                    <i class="fa-solid fa-quote-left"></i>
                    <div class="testimonial-content">
                        "The care I received at KMNU Hospital was exceptional. The doctors were knowledgeable and the staff was incredibly supportive throughout my treatment."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">RK</div>
                        <div class="author-info">
                            <h4>Rajesh Kumar</h4>
                            <span>Nephrology Patient</span>
                        </div>
                    </div>
                </div>

                <!-- Example Testimonial 2 -->
                <div class="testimonial-card">
                    <i class="fa-solid fa-quote-left"></i>
                    <div class="testimonial-content">
                        "I am grateful to the entire team at KMNU for their professionalism and compassionate care. The facility is world-class and very clean."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SP</div>
                        <div class="author-info">
                            <h4>Sneha Patil</h4>
                            <span>General Surgery</span>
                        </div>
                    </div>
                </div>

                <!-- Example Testimonial 3 -->
                <div class="testimonial-card">
                    <i class="fa-solid fa-quote-left"></i>
                    <div class="testimonial-content">
                        "Best hospital in the region for Urology. Dr. Venkatesh and his team are experts in their field. Highly recommended!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">AM</div>
                        <div class="author-info">
                            <h4>Anwar Malik</h4>
                            <span>Urology Patient</span>
                        </div>
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
