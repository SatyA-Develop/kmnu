<?php
/**
 * Template Name: Awards Template
 */
get_header();

// Fetch Awards data
$awards_query = new WP_Query([
    'post_type'      => 'awards',
    'posts_per_page' => -1,
    'meta_key'       => 'award_year',
    'orderby'        => 'meta_value',
    'order'          => 'DESC'
]);

$all_awards = [];
$years = [];
$categories = ['All', 'Hospital', 'Individual'];

if ($awards_query->have_posts()) {
    while ($awards_query->have_posts()) {
        $awards_query->the_post();
        $year = get_post_meta(get_the_ID(), 'award_year', true);
        $cat  = get_post_meta(get_the_ID(), 'award_category', true);
        $img  = get_the_post_thumbnail_url(get_the_ID(), 'large');
        
        $years[] = $year;
        
        $all_awards[] = [
            'id'       => get_the_ID(),
            'title'    => html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8'),
            'year'     => $year,
            'category' => $cat,
            'image'    => $img,
            'content'  => get_the_content()
        ];
    }
    wp_reset_postdata();
}

$years = array_unique($years);
rsort($years);
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

/* Awards Hero */
.awards-hero {
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
.awards-hero-content {
    flex: 1.2;
}
.awards-hero-image {
    flex: 0.8;
    position: relative;
}
.awards-hero-image img {
    width: 100%;
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.2);
}
.awards-hero h1 { 
    font-size: 56px; 
    font-weight: 800; 
    line-height: 1.1; 
    margin-bottom: 25px; 
}
.awards-hero h1 span { color: #ff9933; }
.awards-hero .sub-title { 
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
.awards-hero p {
    font-size: 20px;
    opacity: 0.9;
    line-height: 1.6;
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

/* Filter Section */
.awards-filters {
    background: #fff;
    padding: 40px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid #eee;
}
.filters-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}
.filter-tabs {
    display: flex;
    background: #f4f7f9;
    padding: 5px;
    border-radius: 50px;
    gap: 5px;
}
.filter-btn {
    padding: 10px 25px;
    border: none;
    background: transparent;
    color: #666;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
}
.filter-btn.active {
    background: #0065a5;
    color: #fff;
    box-shadow: 0 4px 10px rgba(0,101,165,0.3);
}
.filter-btn:hover:not(.active) {
    background: rgba(0,101,165,0.05);
    color: #0065a5;
}
.year-filter-wrap {
    display: flex;
    align-items: center;
    gap: 15px;
}
.year-filter-wrap label {
    font-weight: 700;
    color: #333;
    font-size: 14px;
}
.year-filter {
    padding: 10px 20px;
    border-radius: 10px;
    border: 2px solid #e1e8ed;
    font-weight: 700;
    color: #0065a5;
    background: #fff;
    cursor: pointer;
    outline: none;
    transition: 0.3s;
}
.year-filter:focus { border-color: #0065a5; }

/* Awards Grid */
.awards-timeline { padding: 80px 0; background: #fafbfc; }
.year-group { margin-bottom: 60px; }
.year-title {
    font-size: 2.5rem;
    color: #0065a5;
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 3px solid #ff9800;
    display: inline-block;
}
.awards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}
.award-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s;
    cursor: pointer;
    display: flex;
    flex-column-oriented: column;
    flex-direction: column;
}
.award-card:hover { transform: translateY(-5px); }
.award-img {
    height: 200px;
    background-size: cover;
    background-position: center;
    border-bottom: 4px solid #f0f0f0;
}
.award-info { padding: 20px; flex-grow: 1; }
.award-info h4 { font-size: 1.1rem; color: #333; margin: 0 0 10px; line-height: 1.4; }
.award-badge {
    display: inline-block;
    padding: 3px 10px;
    font-size: 0.75rem;
    border-radius: 4px;
    font-weight: 700;
    text-transform: uppercase;
}
.badge-hospital { background: #e3f2fd; color: #0065a5; }
.badge-individual { background: #fff3e0; color: #e65100; }

/* Modal Styles */
.award-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.modal-content {
    background: #fff;
    max-width: 800px;
    width: 100%;
    border-radius: 15px;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
    animation: zoomIn 0.3s ease-out;
}
@keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.modal-close {
    position: absolute;
    top: 15px; right: 20px;
    font-size: 2rem;
    cursor: pointer;
    z-index: 10;
}
.modal-body { display: flex; flex-direction: column; }
.modal-img { width: 100%; height: 400px; object-fit: contain; background: #eee; }
.modal-text { padding: 30px; }
.modal-text h2 { color: #0065a5; margin-bottom: 10px; }
.modal-meta { display: flex; gap: 15px; margin-bottom: 20px; font-weight: 600; color: #666; }

@media (max-width: 768px) {
    .awards-hero h1 { font-size: 2.2rem; }
    .year-title { font-size: 2rem; }
}
</style>

<main class="awards-page">
    <section class="awards-hero">
        <div class="container relative">
            <div class="hero-flex">
                <div class="awards-hero-content">
                    <span class="sub-title">Recognition of Excellence</span>
                                        <h1>Honors & <span>Awards</span></h1>
                                        <p>A legacy of commitment to medical breakthroughs and compassionate care. We celebrate the dedication of our clinicians and the trust of our patients.</p>
                </div>
                <div class="awards-hero-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/awards-banner.png" alt="Awards Recognition">
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fafbfc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <div class="awards-filters">
        <div class="container">
            <div class="filters-wrapper">
                <div class="filter-tabs">
                    <button class="filter-btn active" onclick="filterByCat('All', this)">All Awards</button>
                    <button class="filter-btn" onclick="filterByCat('Hospital', this)">Hospital</button>
                    <button class="filter-btn" onclick="filterByCat('Individual', this)">Individual</button>
                </div>
                <div class="year-filter-wrap">
                    <label>Filter by Year:</label>
                    <select class="year-filter" onchange="filterByYear(this.value)">
                        <option value="All">All Years</option>
                        <?php foreach($years as $year): ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <section class="awards-timeline">
        <div class="container">
            <div id="awards-container">
                <?php foreach($years as $year): ?>
                <div class="year-group" data-year="<?php echo $year; ?>">
                    <h2 class="year-title"><?php echo $year; ?></h2>
                    <div class="awards-grid">
                        <?php 
                        foreach($all_awards as $award): 
                            if($award['year'] != $year) continue;
                        ?>
                        <div class="award-card" 
                             data-cat="<?php echo $award['category']; ?>" 
                             data-year="<?php echo $award['year']; ?>"
                             onclick="showModal(<?php echo htmlspecialchars(json_encode($award)); ?>)">
                            <div class="award-img" style="background-image: url('<?php echo $award['image'] ?: 'https://via.placeholder.com/400x300?text=Award'; ?>')"></div>
                            <div class="award-info">
                                <span class="award-badge <?php echo 'badge-' . strtolower($award['category']); ?>">
                                    <?php echo $award['category']; ?>
                                </span>
                                <h4><?php echo $award['title']; ?></h4>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<!-- Award Modal -->
<div id="awardModal" class="award-modal" onclick="closeModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <span class="modal-close" onclick="closeModalDirect()">&times;</span>
        <div class="modal-body">
            <img id="m-img" src="" class="modal-img" alt="Award Image">
            <div class="modal-text">
                <div class="modal-meta">
                    <span id="m-year"></span> | <span id="m-cat"></span>
                </div>
                <h2 id="m-title"></h2>
                <div id="m-content"></div>
            </div>
        </div>
    </div>
</div>

<script>
let currentCat = 'All';
let currentYear = 'All';

function filterByCat(cat, btn) {
    currentCat = cat;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    applyFilters();
}

function filterByYear(year) {
    currentYear = year;
    applyFilters();
}

function applyFilters() {
    const yearGroups = document.querySelectorAll('.year-group');
    
    yearGroups.forEach(group => {
        const groupYear = group.getAttribute('data-year');
        const cards = group.querySelectorAll('.award-card');
        let visibleInGroup = 0;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-cat');
            const cardYear = card.getAttribute('data-year');
            
            const catMatch = (currentCat === 'All' || cardCat === currentCat);
            const yearMatch = (currentYear === 'All' || cardYear === currentYear);

            if(catMatch && yearMatch) {
                card.style.display = 'flex';
                visibleInGroup++;
            } else {
                card.style.display = 'none';
            }
        });

        if(visibleInGroup > 0) {
            group.style.display = 'block';
        } else {
            group.style.display = 'none';
        }
    });
}

function showModal(award) {
    document.getElementById('m-title').innerText = award.title;
    document.getElementById('m-year').innerText = "Year: " + award.year;
    document.getElementById('m-cat').innerText = award.category + " Award";
    document.getElementById('m-img').src = award.image || 'https://via.placeholder.com/800x600?text=Award';
    document.getElementById('m-content').innerHTML = award.content || '';
    
    document.getElementById('awardModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModalDirect() {
    document.getElementById('awardModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeModal(e) {
    closeModalDirect();
}

// Close modal on Esc
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeModalDirect();
});
</script>

<?php get_footer(); ?>
