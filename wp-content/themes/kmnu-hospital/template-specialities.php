<?php
/**
 * Template Name: Specialities Template
 */
get_header();

$departments_count = wp_count_posts('departments');
$published_departments_count = isset($departments_count->publish) ? (int) $departments_count->publish : 0;

// Function to get doctor count for a speciality
function get_doctor_count_by_speciality($speciality_name) {
    if (!$speciality_name) return 0;
    
    $term = get_term_by('name', $speciality_name, 'specialization');
    if (!$term) {
        $term = get_term_by('slug', sanitize_title($speciality_name), 'specialization');
    }
    
    if ($term) {
        return $term->count;
    }
    
    $args = array(
        'post_type' => 'doctors',
        'tax_query' => array(
            array(
                'taxonomy' => 'specialization',
                'field'    => 'name',
                'terms'    => $speciality_name,
            ),
        ),
        'posts_per_page' => -1,
        'fields' => 'ids'
    );
    $query = new WP_Query($args);
    return $query->found_posts;
}
?>

<main id="primary" class="site-main specialities-page">
    <!-- Hero Section -->
    <?php
    kmnu_page_banner(array(
        'class' => 'specialities-hero',
        'title' => 'Our Specialities',
        'subtitle' => 'Explore ' . $published_departments_count . ' core specialities at KM NU Hospitals, each supported by experienced doctors, coordinated care teams and focused treatment services.',
        'wave_fill' => '#f8fafc',
    ));
    ?>

    <!-- Search Section -->
    <section class="filters-section">
        <div class="container">
            <div class="filter-wrapper">
                <div class="filter-group speciality-search">
                    <div class="filter-label">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Search for a speciality</span>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" id="specialitySearch" placeholder="Enter speciality name (e.g. Cardiology)" autocomplete="off">
                        <div id="specialitySuggestions" class="suggestions-dropdown"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specialities Grid -->
    <section class="specialities-grid-section">
        <div class="container">
            <div class="specialities-grid" id="specialitiesGrid">
                <?php
                $args = array(
                    'post_type' => 'departments',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC'
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $title = get_the_title();
                        $icon = 'fa-stethoscope';
                        $custom_icon = get_post_meta(get_the_ID(), 'dept_icon', true);
                        
                        if (!empty($custom_icon)) {
                            $icon = $custom_icon;
                        } else {
                            $icon_map = [
                                'cardio' => 'fa-heart-pulse',
                                'ortho' => 'fa-bone',
                                'neuro' => 'fa-brain',
                                'pedia' => 'fa-baby',
                                'gynae' => 'fa-venus',
                                'onco' => 'fa-dna',
                                'uro' => 'fa-person-rays',
                                'emergency' => 'fa-truck-medical',
                                'dental' => 'fa-tooth',
                                'eye' => 'fa-eye',
                                'surgery' => 'fa-kit-medical',
                                'gastro' => 'fa-dna',
                                'dermato' => 'fa-hand-dots',
                                'nephro' => 'fa-vial'
                            ];
                            foreach($icon_map as $key => $fa_icon) {
                                if(stripos($title, $key) !== false) { $icon = $fa_icon; break; }
                            }
                        }

                        $doc_count = get_doctor_count_by_speciality($title);
                        $description = get_the_excerpt();
                        if (!$description) {
                            $description = wp_strip_all_tags(get_post_meta(get_the_ID(), 'hero_subtitle', true));
                        }
                        if (!$description) {
                            $description = wp_strip_all_tags(get_post_meta(get_the_ID(), 'more_details_content', true));
                        }
                        if (!$description) {
                            $description = wp_strip_all_tags(get_the_content());
                        }
                        ?>
                        <div class="speciality-card-wrap">
                            <a href="<?php the_permalink(); ?>" class="speciality-card" data-title="<?php echo esc_attr(strtolower($title)); ?>">
                                <div class="speciality-card-inner">
                                    <div class="speciality-icon">
                                        <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                    </div>
                                    <div class="speciality-details">
                                        <h3 class="speciality-title"><?php the_title(); ?></h3>
                                        <p class="speciality-desc"><?php echo esc_html(wp_trim_words($description, 18, '...')); ?></p>
                                        <div class="speciality-meta">
                                            <span class="meta-item"><i class="fa-solid fa-user-doctor"></i> <?php echo $doc_count > 0 ? $doc_count . ' Experts' : 'Specialized Care'; ?></span>
                                            <span class="meta-item"><i class="fa-solid fa-arrow-right"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div id="noResults" class="no-results-found" style="display: none;">
                <div class="no-results-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h3>No specialities found matching your search.</h3>
                <p>Please try a different term or browse our main categories.</p>
            </div>
        </div>
    </section>
</main>

<style>
.specialities-page {
    background: #f8fafc;
    padding-bottom: 100px;
}

/* Filters Section */
.filters-section {
    margin-top: -60px;
    position: relative;
    z-index: 10;
}

.filter-wrapper {
    background: #fff;
    padding: 15px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
}

.filter-group {
    padding: 15px 25px;
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
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-label i {
    font-size: 18px;
    color: var(--brand-orange);
}

.input-wrapper {
    position: relative;
}

.filter-group input {
    width: 100%;
    border: none;
    background: #f3f6f9;
    padding: 15px 20px;
    padding-right: 60px; /* Room for button */
    border-radius: 12px;
    font-size: 17px;
    font-weight: 600;
    color: #444;
    outline: none;
    transition: 0.3s;
    height: 54px;
    box-sizing: border-box;
}

.filter-group input:focus {
    background: #fff;
    box-shadow: 0 0 0 2px var(--brand-blue);
}

/* Suggestions Dropdown */
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
    color: #0065a5;
}

/* Specialities Grid */
.specialities-grid-section {
    padding: 80px 0;
}

.specialities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
}

.speciality-card {
    display: block;
    text-decoration: none;
    background: #fff;
    border-radius: 24px;
    padding: 35px;
    transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid #f0f4f8;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    height: 100%;
    box-sizing: border-box;
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.speciality-card:nth-child(1) { animation-delay: 0.1s; }
.speciality-card:nth-child(2) { animation-delay: 0.2s; }
.speciality-card:nth-child(3) { animation-delay: 0.3s; }
.speciality-card:nth-child(4) { animation-delay: 0.4s; }
.speciality-card:nth-child(5) { animation-delay: 0.5s; }
.speciality-card:nth-child(6) { animation-delay: 0.6s; }

.speciality-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 40px 80px rgba(0, 70, 139, 0.12);
    border-color: #00a3e0;
}

.speciality-icon {
    width: 70px;
    height: 70px;
    background: #f0f8ff;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #0065a5;
    margin-bottom: 25px;
    transition: 0.3s;
}

.speciality-card:hover .speciality-icon {
    background: #ff9933;
    color: #fff;
    transform: rotate(10deg) scale(1.1);
}

.speciality-title {
    font-size: 24px;
    color: #0065a5;
    margin: 0 0 15px;
    font-weight: 800;
}

.speciality-desc {
    font-size: 16px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 25px;
}

.speciality-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
    color: #0065a5;
    font-weight: 700;
    font-size: 15px;
}

.speciality-meta i {
    color: #ff9933;
    margin-right: 8px;
}

/* No Results */
.no-results-found {
    text-align: center;
    padding: 80px 0;
}

.no-results-icon {
    font-size: 60px;
    color: #cbd5e1;
    margin-bottom: 20px;
}

.no-results-found h3 {
    color: #0065a5;
    font-size: 28px;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .specialities-grid {
        grid-template-columns: 1fr;
    }
    .specialities-hero h1 {
        font-size: 38px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('specialitySearch');
    const suggestionsBox = document.getElementById('specialitySuggestions');
    const cards = document.querySelectorAll('.speciality-card');
    const noResults = document.getElementById('noResults');
    
    searchInput.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase().trim();
        let hasVisible = false;
        
        // Handle Suggestions
        if (term.length >= 2) {
            suggestionsBox.innerHTML = '';
            let matches = 0;
            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                if (title.includes(term) && matches < 10) {
                    const div = document.createElement('div');
                    div.className = 'suggestion-item';
                    div.textContent = card.querySelector('.speciality-title').textContent;
                    div.onclick = () => {
                        searchInput.value = div.textContent;
                        suggestionsBox.style.display = 'none';
                        searchInput.dispatchEvent(new Event('input'));
                    };
                    suggestionsBox.appendChild(div);
                    matches++;
                }
            });
            suggestionsBox.style.display = matches > 0 ? 'block' : 'none';
        } else {
            suggestionsBox.style.display = 'none';
        }

        // Handle Grid Filtering
        cards.forEach(card => {
            const title = card.getAttribute('data-title');
            if (title.includes(term)) {
                card.closest('.speciality-card-wrap').style.display = 'block';
                hasVisible = true;
            } else {
                card.closest('.speciality-card-wrap').style.display = 'none';
            }
        });

        noResults.style.display = (hasVisible || term === '') ? 'none' : 'block';
    });

    // Close suggestions on outside click
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });
});
</script>

<?php
get_footer();
