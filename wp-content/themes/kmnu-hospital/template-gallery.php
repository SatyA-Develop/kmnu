<?php
/**
 * Template Name: Gallery Template
 */
get_header();

// Fetch Gallery data
$gallery_items = new WP_Query([
    'post_type'      => 'gallery',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

$all_items = [];
$cats = ['All'];
if ($gallery_items->have_posts()) {
    while ($gallery_items->have_posts()) {
        $gallery_items->the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $item_cats = get_the_terms(get_the_ID(), 'gallery_cat');
        $cat_names = $item_cats ? wp_list_pluck($item_cats, 'name') : [];
        
        foreach($cat_names as $cn) if(!in_array($cn, $cats)) $cats[] = $cn;

        $all_items[] = [
            'id'    => get_the_ID(),
            'title' => get_the_title(),
            'image' => $img,
            'cats'  => $cat_names
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

/* Gallery Hero */
.gallery-hero {
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
.gallery-hero-content { flex: 1.2; }
.gallery-hero-image { flex: 0.8; position: relative; }
.gallery-hero-image img {
    width: 100%;
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.2);
}
.gallery-hero h1 { font-size: 56px; font-weight: 800; line-height: 1.1; margin-bottom: 25px; }
.gallery-hero h1 span { color: #ff9933; }
.gallery-hero .sub-title { 
    display: inline-block;
    background: rgba(255, 255, 255, 0.1);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 14px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; margin-bottom: 25px; backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
.hero-shape {
    position: absolute; bottom: -5px; left: 0; width: 100%; line-height: 0; z-index: 5;
}
.hero-shape svg { width: 100%; height: 100px; }

/* Filter Section */
.gallery-filters {
    background: #fff; padding: 40px 0; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    position: sticky; top: 0; z-index: 100; border-bottom: 1px solid #eee;
}
.filters-wrapper { display: flex; justify-content: center; align-items: center; }
.filter-tabs { display: flex; background: #f4f7f9; padding: 5px; border-radius: 50px; gap: 5px; }
.filter-btn {
    padding: 10px 25px; border: none; background: transparent;
    color: #666; border-radius: 50px; cursor: pointer;
    font-weight: 700; font-size: 14px; transition: all 0.3s ease;
}
.filter-btn.active {
    background: #0065a5; color: #fff; box-shadow: 0 4px 10px rgba(0,101,165,0.3);
}

/* Gallery Grid */
.gallery-section { padding: 100px 0; background: #fafbfc; position: relative; }
.gallery-grid {
    display: columns;
    column-count: 3;
    column-gap: 20px;
}
@media (max-width: 992px) { .gallery-grid { column-count: 2; } }
@media (max-width: 576px) { .gallery-grid { column-count: 1; } }

.gallery-card {
    display: inline-block;
    width: 100%;
    margin-bottom: 20px;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    background: #fff;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    animation: fadeIn 0.8s ease-out both;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.gallery-card:hover { 
    transform: translateY(-8px) scale(1.01); 
    box-shadow: 0 20px 40px rgba(0,0,0,0.12); 
    z-index: 5;
}
.gallery-card img { 
    width: 100%; 
    height: auto;
    display: block;
    transition: transform 0.8s ease; 
}
.gallery-card:hover img { transform: scale(1.05); }

.gallery-overlay {
    position: absolute; 
    inset: 0;
    background: linear-gradient(to top, rgba(0,101,165,0.85) 0%, transparent 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 30px; 
    color: #fff; 
    opacity: 0; 
    transition: all 0.4s ease;
    backdrop-filter: blur(2px);
}
.gallery-card:hover .gallery-overlay { opacity: 1; }
.gallery-overlay h4 { 
    margin: 0; 
    font-size: 16px; 
    font-weight: 700; 
    line-height: 1.4; 
    transform: translateY(20px);
    transition: transform 0.4s ease;
}
.gallery-card:hover .gallery-overlay h4 { transform: translateY(0); }

.view-btn {
    width: 45px; height: 45px;
    background: #ff9933;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -120%);
    opacity: 0;
    transition: all 0.4s ease;
    box-shadow: 0 5px 15px rgba(255,153,51,0.4);
}
.gallery-card:hover .view-btn { opacity: 1; transform: translate(-50%, -50%); }

/* Lightbox Modal */
.lightbox-modal {
    display: none; position: fixed; z-index: 3000; top: 0; left: 0;
    width: 100%; height: 100%; background: rgba(0,30,60,0.95);
    backdrop-filter: blur(10px);
    justify-content: center; align-items: center; padding: 40px;
}
.lightbox-content { 
    max-width: 1000px; 
    width: 100%;
    position: relative; 
    animation: zoomIn 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
@keyframes zoomIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.lightbox-content img { 
    width: 100%; 
    height: auto;
    max-height: 80vh; 
    object-fit: contain;
    border-radius: 15px; 
    box-shadow: 0 0 50px rgba(0,0,0,0.5); 
}
.lightbox-caption { 
    color: #fff; 
    text-align: center; 
    margin-top: 25px; 
    font-size: 20px; 
    font-weight: 700;
    max-width: 800px;
    margin-left: auto; margin-right: auto;
}
.lightbox-close { 
    position: absolute; top: -50px; right: -10px; color: #fff; font-size: 45px; 
    cursor: pointer; opacity: 0.7; transition: 0.3s;
}
.lightbox-close:hover { opacity: 1; transform: rotate(90deg); }

@media (max-width: 768px) {
    .gallery-hero h1 { font-size: 32px; }
    .hero-flex { flex-direction: column; text-align: center; }
}
</style>

<main class="gallery-page">
    <section class="gallery-hero">
        <div class="container relative">
            <div class="hero-flex">
                <div class="gallery-hero-content">
                    <span class="sub-title">Moments of Care</span>
                    <h1>KMNU <span>Gallery</span></h1>
                    <p>Relive the impactful events, successful medical camps, and collaborative milestones that define our commitment to healthcare excellence.</p>
                </div>
                <div class="gallery-hero-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery-banner.png" alt="KMNU Gallery">
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fafbfc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <div class="gallery-filters">
        <div class="container">
            <div class="filters-wrapper">
                <div class="filter-tabs">
                    <?php foreach($cats as $cat): ?>
                        <button class="filter-btn <?php echo ($cat === 'All') ? 'active' : ''; ?>" 
                                onclick="filterGallery('<?php echo $cat; ?>', this)">
                            <?php echo $cat; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <section class="gallery-section">
        <div class="container">
            <div class="gallery-grid" id="gallery-container">
                <?php foreach($all_items as $item): ?>
                <div class="gallery-card" data-cats='<?php echo json_encode($item['cats']); ?>' onclick="openLightbox('<?php echo $item['image']; ?>', '<?php echo addslashes($item['title']); ?>')">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                    <div class="gallery-overlay">
                        <div class="view-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                        <h4><?php echo $item['title']; ?></h4>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<div id="galleryLightbox" class="lightbox-modal" onclick="closeLightbox()">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <img id="lb-img" src="">
        <div id="lb-caption" class="lightbox-caption"></div>
    </div>
</div>

<script>
function filterGallery(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const cards = document.querySelectorAll('.gallery-card');
    cards.forEach(card => {
        const itemCats = JSON.parse(card.getAttribute('data-cats'));
        if (cat === 'All' || itemCats.includes(cat)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function openLightbox(src, title) {
    document.getElementById('lb-img').src = src;
    document.getElementById('lb-caption').innerText = title;
    document.getElementById('galleryLightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('galleryLightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeLightbox();
});
</script>

<?php get_footer(); ?>
