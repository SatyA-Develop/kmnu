<?php
/**
 * The template for displaying Category pages
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
.blogs-hero {
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

.blogs-hero-content {
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

.blogs-hero h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 25px;
}

.blogs-hero h1 span {
    color: #ff9933;
}

.blogs-hero p {
    font-size: 20px;
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 35px;
}

.blogs-hero-image {
    flex: 1;
    position: relative;
}

.blogs-hero-image img {
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

/* ===== BLOG POSTS GRID ===== */
.blogs-grid-section {
    padding: 100px 0;
    background: #f8fafc;
}

.blogs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 40px;
}

.blog-card {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid #f1f5f9;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 30px 60px rgba(0, 70, 139, 0.12);
    border-color: #00a3e0;
}

.blog-image {
    height: 240px;
    position: relative;
    overflow: hidden;
    background: #eef2f6;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.7s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.1) rotate(1deg);
}

.blog-category-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #ff9933;
    color: #fff;
    padding: 8px 18px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 13px;
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
    z-index: 10;
    text-transform: uppercase;
}

.blog-info {
    padding: 35px 30px 30px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.blog-meta {
    font-size: 13px;
    color: #94a3b8;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.blog-meta i {
    color: #00a3e0;
}

.blog-info h3 {
    margin: 0 0 15px;
    font-size: 22px;
    color: #00468b;
    font-weight: 800;
    line-height: 1.4;
    transition: 0.3s;
}

.blog-info h3 a {
    color: inherit;
    text-decoration: none;
}

.blog-info h3 a:hover {
    color: #00a3e0;
}

.blog-info .desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 25px;
    flex: 1;
}

.blog-footer {
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
}

.btn-read-more {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #00468b !important;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-read-more i {
    font-size: 14px;
    transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.btn-read-more:hover {
    color: #ff9933 !important;
}

.blog-card:hover .btn-read-more i {
    transform: translateX(8px);
    color: #ff9933;
}

/* Pagination Details */
.pagination-wrap {
    margin-top: 60px;
    display: flex;
    justify-content: center;
}

.pagination-wrap .nav-links {
    display: flex;
    gap: 10px;
}

.pagination-wrap .page-numbers {
    padding: 10px 18px;
    background: #fff;
    border-radius: 8px;
    color: #00468b;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: 0.3s;
    border: 1px solid #eef2f6;
}

.pagination-wrap .page-numbers:hover,
.pagination-wrap .page-numbers.current {
    background: #00468b;
    color: #fff;
    border-color: #00468b;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,70,139,0.2);
}

/* Responsiveness */
@media (max-width: 992px) {
    .hero-flex { flex-direction: column; text-align: center; }
}

@media (max-width: 768px) {
    .blogs-grid { grid-template-columns: 1fr; }
    .blogs-hero h1 { font-size: 42px; }
}
</style>

<main id="primary" class="site-main blogs-category-page">
    
    <!-- Hero Banner -->
    <section class="blogs-hero">
        <div class="container">
            <div class="hero-flex">
                <div class="blogs-hero-content">
                    <span class="sub-title">Category Archive</span>
                    <h1><span><?php echo single_cat_title('', false); ?></span> <br> Health Blogs.</h1>
                    <p>Explore our detailed articles and expert advice specifically curated under the <?php echo single_cat_title('', false); ?> category.</p>
                </div>
                <div class="blogs-hero-image">
                    <!-- Standard health research abstraction -->
                    <img src="https://images.pexels.com/photos/5452201/pexels-photo-5452201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="KMNU Category">
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Blogs Grid -->
    <section class="blogs-grid-section">
        <div class="container">
            <div class="blogs-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        // Get primary category for the badge
                        $categories = get_the_category();
                        $primary_cat = !empty($categories) ? $categories[0]->name : 'Health';
                        ?>
                        <article class="blog-card">
                            <div class="blog-image">
                                <div class="blog-category-badge"><?php echo esc_html($primary_cat); ?></div>
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="https://via.placeholder.com/600x400.png?text=Health+Blog" alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                    <span><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
                                </div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="desc">
                                    <?php 
                                    $short_desc = get_post_meta(get_the_ID(), 'short_desc', true);
                                    if ($short_desc) {
                                        echo wp_trim_words($short_desc, 25, '...');
                                    } else {
                                        echo wp_trim_words(get_the_excerpt(), 25, '...');
                                    }
                                    ?>
                                </div>
                                <div class="blog-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn-read-more">Read Full Article <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
            </div>
            
            <!-- Pagination Layout (Native) -->
            <div class="pagination-wrap">
                <?php
                echo paginate_links(array(
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                    'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                ));
                ?>
            </div>
            
            <?php else : ?>
                </div>
                <p>No blog posts found in this category. Check back later for health updates!</p>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
