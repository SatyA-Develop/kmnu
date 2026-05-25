<?php
/**
 * Template Name: Blogs
 */
get_header();

$categories = get_categories(array('hide_empty' => true));
$cat_filter = isset($_GET['cat_filter']) ? sanitize_text_field($_GET['cat_filter']) : '';
$search_title = isset($_GET['search_title']) ? sanitize_text_field($_GET['search_title']) : '';
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

/* --- FILTERS SECTION --- */
.filters-section {
    margin-top: -60px;
    position: relative;
    z-index: 10;
}

.filter-wrapper {
    background: #fff;
    padding: 20px;
    border-radius: 24px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    display: flex;
    flex-wrap: wrap; /* Fix overflow on tablets */
    gap: 20px;
    align-items: stretch;
    max-width: 1100px;
    margin: 0 auto;
}

.filter-group {
    flex: 1;
    min-width: 280px; /* Force wrap on smaller screens */
    padding: 15px 25px;
    border: 1px solid #eef2f6;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--brand-blue);
    font-weight: 700;
    font-size: 16px;
    text-transform: uppercase;
}

.select-wrapper, .input-wrapper {
    position: relative;
    width: 100%;
}

.select-wrapper select,
.input-wrapper input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #eef2f6;
    border-radius: 8px;
    font-size: 16px;
    color: #444;
    background: #f8fafc;
    transition: 0.3s;
    outline: none;
    box-sizing: border-box;
}

.select-wrapper select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2300468b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

.input-wrapper {
    display: flex;
    gap: 10px;
}

.search-submit {
    background: var(--brand-blue);
    color: #fff;
    border: none;
    width: 44px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.search-submit:hover { background: var(--brand-orange); }

/* Suggestion Dropdown Styling */
.suggestions-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #fff;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    z-index: 100;
    margin-top: 5px;
    max-height: 300px;
    overflow-y: auto;
    display: none;
    border: 1px solid #eef2f6;
}

.suggestion-item {
    padding: 12px 20px;
    cursor: pointer;
    font-size: 16px;
    color: #444;
    border-bottom: 1px solid #f8fafc;
    transition: 0.2s;
}

.suggestion-item:hover {
    background: #f0f7ff;
    color: var(--brand-blue);
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
    min-height: 92px;
}

.blog-info h3 a {
    color: inherit;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
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
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 102px;
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

<main id="primary" class="site-main blogs-page">
    
    <!-- Hero Banner -->
    <?php
    kmnu_page_banner(array(
        'class' => 'blogs-hero',
        'title' => 'Health Blogs',
        'subtitle' => 'Stay informed with the latest medical news, health tips, and treatment guidance from our healthcare professionals.',
        'wave_fill' => '#f8fafc',
    ));
    ?>

    <!-- Search & Filter Bar -->
    <section class="filters-section">
        <div class="container">
            <form action="<?php echo esc_url(get_permalink()); ?>" method="GET" id="blogsFilterForm">
                <div class="filter-wrapper">
                    <div class="filter-group specialization-filter">
                        <div class="filter-label">
                            <i class="fa-solid fa-layer-group"></i>
                            <span>Search By Category</span>
                        </div>
                        <div class="select-wrapper">
                            <select name="cat_filter" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat) : ?>
                                    <option value="<?php echo esc_attr($cat->slug); ?>" <?php selected($cat_filter, $cat->slug); ?>>
                                        <?php echo esc_html($cat->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-group name-filter">
                        <div class="filter-label">
                            <i class="fa-solid fa-pen-nib"></i>
                            <span>Search By Title</span>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" name="search_title" placeholder="Enter Blog Title" value="<?php echo esc_attr($search_title); ?>" id="blogTitleInput" autocomplete="off">
                            <div id="blogSuggestions" class="suggestions-dropdown"></div>
                            <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Blogs Grid -->
    <section class="blogs-grid-section">
        <div class="container">
            <div class="blogs-grid">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 9,
                    'paged' => $paged
                );
                if ($cat_filter) {
                    $args['category_name'] = $cat_filter;
                }
                if ($search_title) {
                    $args['s'] = $search_title;
                }

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
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
                                <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html(kmnu_trim_card_text(get_the_title(), 72)); ?></a></h3>
                                <div class="desc">
                                    <?php 
                                    // Use short_desc if available, else standard excerpt
                                    $short_desc = get_post_meta(get_the_ID(), 'short_desc', true);
                                    if ($short_desc) {
                                        echo esc_html(kmnu_trim_card_text($short_desc, 145));
                                    } else {
                                        echo esc_html(kmnu_trim_card_text(kmnu_get_clean_excerpt(get_the_content(), 35), 145));
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
            
            <!-- Pagination Layout -->
            <div class="pagination-wrap">
                <?php
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                    'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                ));
                wp_reset_postdata();
                ?>
            </div>
            
            <?php else : ?>
                </div>
                <p>No blog posts found. Check back later for health updates!</p>
            <?php endif; ?>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('blogTitleInput');
    const suggestionsBox = document.getElementById('blogSuggestions');
    const filterForm = document.getElementById('blogsFilterForm');
    
    let debounceTimer;

    titleInput.addEventListener('input', function() {
        const value = this.value.trim();
        clearTimeout(debounceTimer);

        if (value.length < 2) {
            suggestionsBox.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=get_blog_suggestions&term=${value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        suggestionsBox.innerHTML = '';
                        data.data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'suggestion-item';
                            div.textContent = item.label;
                            div.onclick = () => {
                                titleInput.value = item.label;
                                suggestionsBox.style.display = 'none';
                                filterForm.submit();
                            };
                            suggestionsBox.appendChild(div);
                        });
                        suggestionsBox.style.display = 'block';
                    } else {
                        suggestionsBox.style.display = 'none';
                    }
                });
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!titleInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });
});
</script>

<?php get_footer(); ?>
