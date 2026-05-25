<?php
/**
 * Template Name: Doctors Template
 */
get_header();

// Get search parameters
$search_query = isset($_GET['dr_name']) ? sanitize_text_field($_GET['dr_name']) : '';
$speciality_filter = isset($_GET['speciality']) ? sanitize_text_field($_GET['speciality']) : '';

// Get all specializations for the filter
$specializations = get_terms(array(
    'taxonomy' => 'specialization',
    'hide_empty' => true,
));

// Build Query
$args = array(
    'post_type' => 'doctors',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
);

if (!empty($search_query)) {
    $args['s'] = $search_query;
}

if (!empty($speciality_filter)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'specialization',
            'field'    => 'slug',
            'terms'    => $speciality_filter,
        ),
    );
}

$doctors_query = new WP_Query($args);
?>

<main id="primary" class="site-main doctors-page">
    <!-- Hero Section -->
    <?php
    kmnu_page_banner(array(
        'class' => 'doctors-hero',
        'title' => 'Our Expert Doctors',
        'subtitle' => 'KMNU Hospital brings together world-class specialists dedicated to your health and well-being. Our team of doctors utilizes advanced medical technology and compassionate care to ensure the best outcomes for every patient.',
        'wave_fill' => '#f0f4f8',
    ));
    ?>

    <!-- Search & Filter Bar -->
    <section class="filters-section">
        <div class="container">
            <form action="<?php echo esc_url(get_permalink()); ?>" method="GET" class="doctors-filter-form" id="doctorsFilterForm">
                <div class="filter-wrapper">
                    <div class="filter-group specialization-filter">
                        <div class="filter-label">
                            <i class="fa-solid fa-stethoscope"></i>
                            <span>Search By Speciality</span>
                        </div>
                        <div class="select-wrapper">
                            <select name="speciality" id="specialitySelect" onchange="this.form.submit()">
                                <option value="">All Specialities</option>
                                <?php foreach ($specializations as $spec) : ?>
                                    <option value="<?php echo esc_attr($spec->slug); ?>" <?php selected($speciality_filter, $spec->slug); ?>>
                                        <?php echo esc_html($spec->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-group name-filter">
                        <div class="filter-label">
                            <i class="fa-solid fa-id-card"></i>
                            <span>Doctors name</span>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" name="dr_name" placeholder="Enter Doctor Name" value="<?php echo esc_attr($search_query); ?>" id="drNameInput" autocomplete="off">
                            <div id="doctorSuggestions" class="suggestions-dropdown"></div>
                            <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Doctors Grid -->
    <section class="doctors-grid-section">
        <div class="container">
            <?php if ($doctors_query->have_posts()) : ?>
                <div class="doctors-page-grid" id="doctorsGrid">
                    <?php while ($doctors_query->have_posts()) : $doctors_query->the_post(); 
                        $qualification = get_post_meta(get_the_ID(), 'qualification', true);
                        $specs = wp_get_object_terms(get_the_ID(), 'specialization');
                    ?>
                        <article class="doctor-page-card" data-speciality="<?php echo !empty($specs) ? esc_attr($specs[0]->slug) : ''; ?>">
                            <div class="doctor-card-inner">
                                <div class="doctor-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    <?php else : ?>
                                        <img src="https://via.placeholder.com/400x500.png?text=Doctor+Portrait" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                    
                                    <!-- Premium Social Overlay -->
                                    <div class="doctor-social-links">
                                        <a href="<?php the_permalink(); ?>" class="social-btn" aria-label="View <?php echo esc_attr(get_the_title()); ?> profile"><i class="fa-solid fa-user-doctor"></i></a>
                                        <a href="<?php echo esc_url(add_query_arg('doctor_id', get_the_ID(), home_url('/book-appointment/'))); ?>" class="social-btn" aria-label="Book appointment with <?php echo esc_attr(get_the_title()); ?>"><i class="fa-solid fa-calendar-check"></i></a>
                                        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="social-btn" aria-label="Contact KM NU Hospitals"><i class="fa-solid fa-envelope"></i></a>
                                    </div>

                                    <div class="card-overlay">
                                        <a href="<?php the_permalink(); ?>" class="view-profile-btn">View Profile <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="doctor-details">
                                    <div class="spec-badge-wrap">
                                        <?php if (!empty($specs)) : ?>
                                            <span class="doctor-spec-badge"><?php echo esc_html($specs[0]->name); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="doctor-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php if ($qualification) : ?>
                                        <p class="doctor-qual"><?php echo esc_html($qualification); ?></p>
                                    <?php endif; ?>
                                    
                                    <div class="doctor-footer">
                                        <a href="<?php echo esc_url(add_query_arg('doctor_id', get_the_ID(), home_url('/book-appointment/'))); ?>" class="btn-book-now">
                                            <span>Book Appointment</span>
                                            <i class="fa-solid fa-calendar-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="no-doctors-found">
                    <div class="no-results-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <h3>No doctors found matching your criteria.</h3>
                    <p>Please try adjusting your search or filter settings.</p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="reset-filter-btn">Reset Filters</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
.doctors-page {
    background: #f0f4f8; 
    padding-bottom: 150px;
    overflow-x: hidden; /* Fix horizontal scroll */
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
    letter-spacing: 0.5px;
}

.filter-label i {
    font-size: 20px;
    color: var(--brand-orange);
}

.select-wrapper, .input-wrapper {
    position: relative;
}

.filter-group select, .filter-group input {
    width: 100%;
    border: none;
    background: #f3f6f9;
    padding: 15px 20px;
    border-radius: 12px;
    font-size: 17px;
    font-weight: 600;
    color: #444;
    outline: none;
    transition: 0.3s;
    height: 54px;
    box-sizing: border-box;
}

.filter-group input { padding-right: 60px; }

.filter-group select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%230065a5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 18px;
    cursor: pointer;
}

.filter-group input:focus, .filter-group select:focus {
    background: #fff;
    box-shadow: 0 0 0 2px var(--brand-blue);
}

.search-submit {
    position: absolute;
    right: 5px;
    top: 5px;
    bottom: 5px;
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

/* --- DOCTORS GRID --- */
.doctors-grid-section { padding: 80px 0; overflow: hidden; }
.doctors-page-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Better responsiveness */
    gap: 30px;
    width: 100%;
}

.doctor-page-card {
    background: transparent;
    perspective: 1000px;
    animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.doctor-card-inner {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    position: relative;
    transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 40px rgba(0, 70, 139, 0.05);
    border: 1px solid rgba(0, 101, 165, 0.03);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.doctor-page-card:hover .doctor-card-inner {
    transform: translateY(-15px);
    box-shadow: 0 40px 90px rgba(0, 70, 139, 0.15);
    border-color: rgba(0, 101, 165, 0.2);
}

.doctor-image {
    height: 420px;
    position: relative;
    overflow: hidden;
}

.doctor-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.7s cubic-bezier(0.19, 1, 0.22, 1);
}

.doctor-page-card:hover .doctor-image img {
    transform: scale(1.1) rotate(-1deg);
}

.doctor-social-links {
    position: absolute;
    top: 25px;
    right: -60px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 10;
}

.doctor-page-card:hover .doctor-social-links { right: 25px; }

.social-btn {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--brand-blue);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 18px;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
}

.social-btn:hover {
    background: var(--brand-blue);
    color: #fff;
    transform: translateX(-5px);
}

.card-overlay {
    position: absolute;
    bottom: -100px;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 101, 165, 0.9) 0%, transparent 60%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 40px;
    opacity: 0;
    transition: 0.5s;
    z-index: 5;
}

.doctor-page-card:hover .card-overlay {
    bottom: 0;
    opacity: 1;
}

.view-profile-btn {
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    font-size: 16px;
    padding: 10px 25px;
    border: 2px solid #fff;
    border-radius: 50px;
    transition: 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.view-profile-btn:hover {
    background: #fff;
    color: var(--brand-blue);
}

.doctor-details {
    padding: 30px;
    text-align: left;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.spec-badge-wrap { margin-bottom: 15px; }

.doctor-spec-badge {
    background: #edf5ff;
    color: #0065a5;
    padding: 6px 15px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.doctor-title {
    font-size: 28px;
    margin: 0 0 10px;
    color: #00468b;
    font-weight: 900;
}

.doctor-title a {
    text-decoration: none;
    color: inherit;
    transition: 0.3s;
}

.doctor-page-card:hover .doctor-title a { color: var(--brand-orange); }

.doctor-qual {
    font-size: 16px;
    color: #64748b;
    margin-bottom: 25px;
    line-height: 1.5;
    font-weight: 500;
}

.doctor-footer {
    margin-top: auto;
    padding-top: 25px;
    border-top: 1px solid #f1f5f9;
}

.btn-book-now {
    background: linear-gradient(45deg, var(--brand-blue), #00a3e0);
    color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 800;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
    box-shadow: 0 10px 20px rgba(0, 101, 165, 0.2);
    justify-content: center;
    width: 100%;
    box-sizing: border-box;
}

.btn-book-now:hover {
    background: linear-gradient(45deg, var(--brand-orange), #ffb366);
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
    color: #fff;
}

/* No Results State */
.no-doctors-found {
    text-align: center;
    padding: 100px 0;
    background: #fff;
    border-radius: 20px;
}

.no-results-icon {
    font-size: 80px;
    color: #cbd5e1;
    margin-bottom: 30px;
}

.no-doctors-found h3 {
    font-size: 32px;
    color: var(--brand-blue);
    margin-bottom: 15px;
}

.no-doctors-found p {
    font-size: 18px;
    color: #64748b;
    margin-bottom: 30px;
}

.reset-filter-btn {
    display: inline-block;
    padding: 15px 40px;
    background: var(--brand-blue);
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
}

/* Responsiveness */
@media (max-width: 992px) {
    .filter-wrapper {
        flex-direction: column;
    }
    .doctors-hero h1 {
        font-size: 42px;
    }
}

@media (max-width: 768px) {
    .doctors-page-grid {
        grid-template-columns: 1fr;
    }
    .hero-inner {
        padding: 0 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('drNameInput');
    const suggestionsBox = document.getElementById('doctorSuggestions');
    const filterForm = document.getElementById('doctorsFilterForm');
    
    let debounceTimer;

    nameInput.addEventListener('input', function() {
        const value = this.value.trim();
        clearTimeout(debounceTimer);

        if (value.length < 2) {
            suggestionsBox.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=get_doctor_suggestions&term=${value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        suggestionsBox.innerHTML = '';
                        data.data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'suggestion-item';
                            div.textContent = item.label;
                            div.onclick = () => {
                                nameInput.value = item.label;
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

    // Close suggestions on outside click
    document.addEventListener('click', function(e) {
        if (!nameInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });

    // Submitting on specialization change is already handled by inline onchange
});
</script>

<?php
get_footer();
