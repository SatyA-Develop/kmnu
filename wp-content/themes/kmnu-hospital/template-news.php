<?php
/**
 * Template Name: News Template
 */
get_header();

// Fetch News data
$news_query = new WP_Query([
    'post_type'      => 'news',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

$all_news = [];
if ($news_query->have_posts()) {
    while ($news_query->have_posts()) {
        $news_query->the_post();
        $img  = get_the_post_thumbnail_url(get_the_ID(), 'large');
        
        $all_news[] = [
            'id'       => get_the_ID(),
            'title'    => html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8'),
            'image'    => $img,
            'content'  => get_the_content(),
            'date'     => get_the_date()
        ];
    }
    wp_reset_postdata();
}
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

/* News Hero */
.news-hero {
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
.news-hero-content {
    flex: 1.2;
}
.news-hero-image {
    flex: 0.8;
    position: relative;
}
.news-hero-image img {
    width: 100%;
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.2);
}
.news-hero h1 { 
    font-size: 56px; 
    font-weight: 800; 
    line-height: 1.1; 
    margin-bottom: 25px; 
}
.news-hero h1 span { color: #ff9933; }
.news-hero .sub-title { 
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

/* News Grid */
.news-section { padding: 80px 0; background: #fafbfc; }
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}
.news-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid #eee;
}
.news-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
.news-img {
    height: 240px;
    background-size: cover;
    background-position: center;
}
.news-info { padding: 25px; }
.news-date { color: #888; font-size: 12px; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 10px; }
.news-info h3 { font-size: 1.25rem; color: #333; line-height: 1.4; margin: 0; }

/* Modal Styles */
.news-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(5px);
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.modal-content {
    background: #fff;
    max-width: 900px;
    width: 100%;
    border-radius: 20px;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideUp 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
@keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
.modal-close {
    position: absolute;
    top: 20px; right: 25px;
    font-size: 2rem;
    cursor: pointer;
    z-index: 100;
    color: #333;
}
.modal-img { width: 100%; max-height: 500px; object-fit: contain; background: #f0f0f0; }
.modal-text { padding: 40px; }
.modal-text h2 { color: #0065a5; margin-top: 0; line-height: 1.3; }

@media (max-width: 768px) {
    .hero-flex { flex-direction: column; text-align: center; }
    .news-hero h1 { font-size: 32px; }
}
</style>

<main class="news-page">
    <section class="news-hero">
        <div class="container relative">
            <div class="hero-flex">
                <div class="news-hero-content">
                    <span class="sub-title">Latest Updates</span>
                    <h1>KMNU on <span>News</span></h1>
                    <p>Stay updated with the latest breakthroughs, events, and medical milestones at KMNU Hospital. Our stories of care and excellence as featured in the media.</p>
                </div>
                <div class="news-hero-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/news-banner.png" alt="KMNU News">
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fafbfc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            <div class="news-grid">
                <?php foreach($all_news as $news): ?>
                <div class="news-card" onclick="openNewsModal(<?php echo htmlspecialchars(json_encode($news)); ?>)">
                    <div class="news-img" style="background-image: url('<?php echo $news['image'] ?: 'https://via.placeholder.com/600x400?text=News'; ?>')"></div>
                    <div class="news-info">
                        <span class="news-date"><?php echo $news['date']; ?></span>
                        <h3><?php echo $news['title']; ?></h3>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<!-- News Popup -->
<div id="newsModal" class="news-modal" onclick="closeNewsModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <span class="modal-close" onclick="closeNewsModal()">&times;</span>
        <img id="nm-img" src="" class="modal-img">
        <div class="modal-text">
            <span id="nm-date" class="news-date"></span>
            <h2 id="nm-title"></h2>
            <div id="nm-content"></div>
        </div>
    </div>
</div>

<script>
function openNewsModal(news) {
    document.getElementById('nm-img').src = news.image || '';
    document.getElementById('nm-title').innerText = news.title;
    document.getElementById('nm-date').innerText = news.date;
    document.getElementById('nm-content').innerHTML = news.content || '';
    
    document.getElementById('newsModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeNewsModal() {
    document.getElementById('newsModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeNewsModal();
});
</script>

<?php get_footer(); ?>
