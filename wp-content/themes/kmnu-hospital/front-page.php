<?php
get_header();

// Pre-fetch global data for the page
$all_doctors = get_posts(array(
    'post_type' => 'doctors',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
));

$specializations = get_terms(array(
    'taxonomy' => 'specialization',
    'hide_empty' => true,
));

$all_departments = get_posts(['post_type' => 'departments', 'posts_per_page' => -1]);
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-container">
        <div class="hero-row">
            <!-- Left Side Content -->
            <div class="hero-content">
                <h1>Find the Best Doctor for You</h1>
                <p>Choose from KM NU Hospitals' trusted specialists across emergency care, diagnostics, surgery, women and child health, kidney care, urology, IVF and more.</p>

                <div class="hero-btns">
                    <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="btn btn-learn-more">Learn More</a>
                </div>

                <div class="hero-search-area">
                    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="hero-search-form">
                        <div class="search-bar-wrap">
                            <input type="hidden" name="post_type" value="doctors">
                            <input type="text" name="s" id="hero-doctor-search" list="doctor-suggestions"
                                placeholder="Search for Doctors, Specialities & Conditions" autocomplete="off">
                            <datalist id="doctor-suggestions">
                                <?php
                                foreach ($all_doctors as $doc) {
                                    echo '<option value="' . esc_attr($doc->post_title) . '">';
                                }
                                if (!is_wp_error($specializations)) {
                                    foreach ($specializations as $term) {
                                        echo '<option value="' . esc_attr($term->name) . '">';
                                    }
                                }
                                foreach ($all_departments as $department_option) {
                                    echo '<option value="' . esc_attr($department_option->post_title) . '">';
                                }
                                $conditions = array('Kidney Stones', 'Dialysis', 'Joint Replacement', 'ENT Surgery', 'Urology Checkup', 'General Surgery', 'Radiology', 'Pediatric Nephrology');
                                foreach ($conditions as $condition) {
                                    echo '<option value="' . esc_attr($condition) . '">';
                                }
                                ?>
                            </datalist>
                            <button type="submit" class="btn-search"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>

                        <div class="hero-filters">
                            <div class="filter-group">
                                <select name="speciality" id="hero-specialization">
                                    <option value="">Speciality</option>
                                    <?php
                                    if (!empty($specializations) && !is_wp_error($specializations)) {
                                        foreach ($specializations as $term) {
                                            echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="filter-group">
                                <select name="doctor" id="hero-doctor">
                                    <option value="">Doctor</option>
                                    <?php
                                    foreach ($all_doctors as $doc) {
                                        $terms = wp_get_object_terms($doc->ID, 'specialization');
                                        $spec_slugs = !empty($terms) ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
                                        echo '<option value="' . esc_attr($doc->post_name) . '" data-speciality="' . esc_attr($spec_slugs) . '">' . esc_html($doc->post_title) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side Image (Normal Image Tag) -->
            <div class="hero-image-block">
                <div class="doctor-group-wrap">
                    <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/KMNU_Home-Assets-02-scaled.webp')); ?>"
                        alt="Modern Doctors Group" class="doctors-img">


                </div>
            </div>
        </div>
    </div>
</section>

<section class="departments-section">
    <div class="container">
        <div class="dept-row">
            <!-- Left: Department Image -->
            <div class="dept-image">
                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/KMNU_Home-Assets-03-scaled.webp')); ?>"
                    alt="Departments Overview" class="dept-main-img">
            </div>

            <!-- Right: Content & List -->
            <div class="dept-content">
                <div class="dept-header">
                    <h2>Our Departments</h2>
                    <p>Explore our core medical specialities at KM NU Hospitals, supported by experienced doctors,
                        modern diagnostics, emergency care and patient-focused treatment pathways.</p>
                </div>

                <div class="dept-list">
                    <?php
                    $department_icon_fallbacks = array(
                        'Anaesthesiology' => 'fa-lungs',
                        'Andrology' => 'fa-mars',
                        'Cardiology' => 'fa-heart-pulse',
                        'Emergency Medicine' => 'fa-truck-medical',
                        'ENT' => 'fa-ear-listen',
                        'General Surgery' => 'fa-user-doctor',
                        'Nephrology' => 'fa-droplet',
                        'Obstetrics/ Gynaecology' => 'fa-person-pregnant',
                        'Orthopaedics' => 'fa-bone',
                        'Paediatric/ Neonatology' => 'fa-baby',
                        'Radiodignosis' => 'fa-x-ray',
                        'ReproductiveMedicine/ IVF' => 'fa-seedling',
                        'Urology' => 'fa-prescription-bottle-medical',
                    );
                    $department_summary_fallbacks = array(
                        'Anaesthesiology' => 'Anaesthesia, operative monitoring and pain management for safe surgical care.',
                        'Andrology' => "Men's sexual health, male infertility and advanced andrology treatments.",
                        'Cardiology' => 'Heart care, ECG, ECHO, TMT and preventive cardiology services.',
                        'Emergency Medicine' => 'Round-the-clock emergency response for trauma, acute illness and critical care.',
                        'ENT' => 'Ear, nose, throat, head and neck care with advanced ENT procedures.',
                        'General Surgery' => 'General, laparoscopic and emergency surgical care.',
                        'Nephrology' => 'Kidney care, dialysis, renal biopsy and transplant-focused nephrology services.',
                        'Obstetrics/ Gynaecology' => "Women's health, pregnancy care and gynaecological treatments.",
                        'Orthopaedics' => 'Bone, joint, trauma, spine and sports injury care.',
                        'Paediatric/ Neonatology' => 'Paediatric and newborn care with specialist support.',
                        'Radiodignosis' => 'CT, X-ray, ultrasound and imaging support for accurate diagnosis.',
                        'ReproductiveMedicine/ IVF' => 'Fertility evaluation, IVF treatment and reproductive medicine support.',
                        'Urology' => 'Kidney, bladder, prostate, stone and reconstructive urology care.',
                    );
                    $args = array(
                        'post_type' => 'departments',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'orderby' => 'title',
                        'order' => 'ASC'
                    );
                    $dept_query = new WP_Query($args);
                    $count = 0;

                    if ($dept_query->have_posts()):
                        while ($dept_query->have_posts()):
                            $dept_query->the_post();
                            $dept_title = get_the_title();
                            $icon = get_post_meta(get_the_ID(), 'dept_icon', true);
                            if (empty($icon) && isset($department_icon_fallbacks[$dept_title])) {
                                $icon = $department_icon_fallbacks[$dept_title];
                            }
                            if (empty($icon)) {
                                $icon = 'fa-stethoscope';
                            }
                            $active_class = ($count == 0) ? 'active' : '';
                            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            if (!$thumb_url) {
                                $thumb_url = home_url('/wp-content/uploads/2026/04/KMNU_Home-Assets-03-scaled.webp');
                            }
                            $summary = get_the_excerpt();
                            if (!$summary) {
                                $summary = wp_strip_all_tags(get_post_meta(get_the_ID(), 'hero_subtitle', true));
                            }
                            if (!$summary) {
                                $summary = wp_strip_all_tags(get_post_meta(get_the_ID(), 'more_details_content', true));
                            }
                            if (!$summary && isset($department_summary_fallbacks[$dept_title])) {
                                $summary = $department_summary_fallbacks[$dept_title];
                            }
                            ?>
                            <a class="dept-item <?php echo esc_attr($active_class); ?>"
                                href="<?php the_permalink(); ?>"
                                data-dept-image="<?php echo esc_url($thumb_url); ?>"
                                aria-label="View <?php echo esc_attr($dept_title); ?>">
                                <div class="dept-icon">
                                    <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                </div>
                                <div class="dept-info">
                                    <h3><?php echo esc_html($dept_title); ?></h3>
                                    <p><?php echo esc_html(wp_trim_words($summary, 16)); ?></p>
                                </div>
                            </a>
                            <?php
                            $count++;
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team of Specialists Section -->
<section class="specialists-section">
    <div class="container">
        <div class="specialists-header">
            <h2>Our Team of Specialists</h2>
            <div class="specialists-controls">
                <div class="doc-search">
                    <input type="text" placeholder="Find a Doctor">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="slider-arrows">
                    <button class="prev"><i class="fa-solid fa-angles-left"></i></button>
                    <button class="next"><i class="fa-solid fa-angles-right"></i></button>
                </div>
            </div>
        </div>


        <div class="specialists-slider-container">
            <div class="doctors-grid" id="doctorsGrid">
                <?php
                $args = array(
                    'post_type' => 'doctors',
                    'posts_per_page' => -1, // Fetch all doctors
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                $doc_query = new WP_Query($args);

                if ($doc_query->have_posts()):
                    while ($doc_query->have_posts()):
                        $doc_query->the_post();
                        $qualification = get_post_meta(get_the_ID(), 'qualification', true);
                        $profile = get_post_meta(get_the_ID(), 'profile', true);
                        ?>
                        <div class="doctor-card">
                            <div class="doc-image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x450.png?text=Doctor+Portrait"
                                        alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="doc-info">
                                <h3><?php the_title(); ?></h3>
                                <?php if ($qualification): ?>
                                    <p class="doc-qualification"><strong><?php echo esc_html($qualification); ?></strong></p>
                                <?php endif; ?>
                                <?php if ($profile): ?>
                                    <p class="doc-profile"><?php echo esc_html($profile); ?></p>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn-profile">VIEW PROFILE</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>


<!-- Our Hospitals Section -->
<section class="hospitals-section">
    <div class="container">
        <div class="hospitals-header">
            <div class="hospitals-title-wrap">
                <h2>Our Hospitals</h2>
                <p>KM NU Hospitals connects Ambur with dependable multi-speciality care, modern facilities and responsive support for patients and families.</p>
            </div>
            <div class="hospitals-controls slider-arrows">
                <button class="h-prev prev"><i class="fa-solid fa-angles-left"></i></button>
                <button class="h-next next"><i class="fa-solid fa-angles-right"></i></button>
            </div>
        </div>
    </div>

    <div class="hospitals-slider-wrapper">
        <div class="hospitals-mask-left"></div>
        <div class="hospitals-slider-container">
            <div class="hospitals-grid" id="hospitalsGrid">
                <?php
                $args = array(
                    'post_type' => 'locations',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                $hosp_query = new WP_Query($args);

                if ($hosp_query->have_posts()):
                    while ($hosp_query->have_posts()):
                        $hosp_query->the_post();
                        $directions = get_post_meta(get_the_ID(), 'location_link', true);
                        $phone = get_post_meta(get_the_ID(), 'phone', true);
                        $email = get_post_meta(get_the_ID(), 'email', true);
                        ?>
                        <div class="hospital-card">
                            <div class="hosp-image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x300.png?text=Hospital" alt="<?php the_title(); ?>">
                                <?php endif; ?>

                                <?php if ($directions): ?>
                                    <a href="<?php echo esc_url($directions); ?>" target="_blank" class="get-directions">
                                        GET DIRECTIONS <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="hosp-info">
                                <h3><?php
                                $title = get_the_title();
                                echo str_replace(', ', ',<br>', $title);
                                ?></h3>
                                <div class="hosp-rating">
                                    <img src="https://www.google.com/favicon.ico" alt="Google" class="google-ico">
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <span class="rating-num">4.7</span>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Video Showcase Section -->
<section class="video-showcase-section">
    <div class="container">
        <div class="video-grid-outer">

            <!-- Left: Expert Medical Guidance -->
            <div class="video-column">
                <div class="video-col-header">
                    <h2>Expert Medical Guidance</h2>
                    <p>Our doctors share valuable insights, expertise, and the commitment behind every successful
                        treatment.</p>
                </div>

                <div class="video-slider-container guidance-slider">
                    <div class="video-cards-row">
                        <?php
                        $query = new WP_Query(['post_type' => 'guidance', 'posts_per_page' => 3]);
                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                $video_url = get_post_meta(get_the_ID(), 'video_url', true);
                                ?>
                                <div class="video-card">
                                    <div class="video-thumb-wrap" data-video-url="<?php echo esc_url($video_url); ?>">
                                        <?php if (has_post_thumbnail()):
                                            the_post_thumbnail('large');
                                        else: ?>
                                            <img src="https://via.placeholder.com/600x400.png?text=Video+Thumbnail" alt="Guidance">
                                        <?php endif; ?>
                                        <div class="play-overlay">
                                            <i class="fa-solid fa-play"></i>
                                        </div>

                                        <div class="video-badge-name">
                                            <h4><?php the_title(); ?></h4>
                                            <p><?php echo wp_trim_words(get_the_content(), 10); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <div class="video-slider-controls">
                    <div class="slider-arrows">
                        <button class="g-prev prev"><i class="fa-solid fa-angles-left"></i></button>
                        <button class="g-next next"><i class="fa-solid fa-angles-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="video-divider"></div>

            <!-- Right: Success Stories -->
            <div class="video-column">
                <div class="video-col-header">
                    <h2>Success Stories</h2>
                    <p>Delivering top-quality healthcare with a holistic approach, treating the whole person, not just
                        the symptoms.</p>
                </div>

                <div class="video-slider-container stories-slider">
                    <div class="video-cards-row">
                        <?php
                        $query = new WP_Query(['post_type' => 'stories', 'posts_per_page' => 3]);
                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                $video_url = get_post_meta(get_the_ID(), 'video_url', true);
                                ?>
                                <div class="video-card">
                                    <div class="video-thumb-wrap" data-video-url="<?php echo esc_url($video_url); ?>">
                                        <?php if (has_post_thumbnail()):
                                            the_post_thumbnail('large');
                                        else: ?>
                                            <img src="https://via.placeholder.com/600x400.png?text=Success+Story"
                                                alt="Success Story">
                                        <?php endif; ?>
                                        <div class="play-overlay">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <div class="video-slider-controls">
                    <div class="slider-arrows">
                        <button class="s-prev prev"><i class="fa-solid fa-angles-left"></i></button>
                        <button class="s-next next"><i class="fa-solid fa-angles-right"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="testimonials-header-new">
            <div class="th-left"></div>
            <div class="th-center">
                <h2>Our Reviews, What our patients say</h2>
                <p>Real experiences from patients and families who trusted KM NU Hospitals for attentive, specialist-led care.</p>
            </div>
            <div class="th-right slider-arrows">
                <button class="t-prev prev"><i class="fa-solid fa-angles-left"></i></button>
                <button class="t-next next"><i class="fa-solid fa-angles-right"></i></button>
            </div>
        </div>

        <div class="testimonials-slider-container">
            <div class="testimonials-grid" id="testimonialsGrid">
                <?php
                $test_query = new WP_Query(['post_type' => 'testimonials', 'posts_per_page' => 10]);
                if ($test_query->have_posts()):
                    while ($test_query->have_posts()):
                        $test_query->the_post();
                        $designation = get_post_meta(get_the_ID(), 'designation', true);
                        $headline = get_post_meta(get_the_ID(), 'headline', true);
                        ?>
                        <div class="testimonial-card">
                            <div class="quote-circle">
                                <i class="fa-solid fa-quote-right"></i>
                            </div>
                            <div class="testimonial-header-row">
                                <div class="user-avatar">
                                    <?php if (has_post_thumbnail()):
                                        the_post_thumbnail('thumbnail');
                                    else: ?>
                                        <div class="avatar-placeholder"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="user-meta">
                                    <h4><?php the_title(); ?></h4>
                                    <p><?php echo esc_html($designation); ?></p>
                                </div>
                            </div>
                            <div class="testimonial-body">
                                <?php if ($headline): ?>
                                    <h5 class="t-headline"><strong><?php echo esc_html($headline); ?></strong></h5>
                                <?php endif; ?>
                                <div class="t-content"><?php the_content(); ?></div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Blogs Section -->
<section class="blogs-section">
    <div class="container">
        <div class="blogs-header">
            <h2>Blogs</h2>
            <p>Read health tips, treatment guidance and hospital updates from the KM NU Hospitals care team.</p>
        </div>

        <div class="blogs-grid">
            <?php
            $blog_query = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3]);
            if ($blog_query->have_posts()):
                while ($blog_query->have_posts()):
                    $blog_query->the_post();
                    $short_desc = get_post_meta(get_the_ID(), 'short_desc', true);
                    ?>
                    <div class="blog-card" onclick="window.location.href='<?php the_permalink(); ?>'">
                        <div class="blog-thumb">
                            <?php if (has_post_thumbnail()):
                                the_post_thumbnail('medium_large');
                            else: ?>
                                <img src="https://via.placeholder.com/600x400.png?text=Blog" alt="Blog">
                            <?php endif; ?>
                        </div>
                        <div class="blog-post-body">
                            <p class="blog-date"><?php echo get_the_date('j F Y h:i A'); ?></p>
                            <h4 class="blog-main-title"><?php the_title(); ?></h4>
                            <p class="blog-text">
                                <?php 
                                if ($short_desc) {
                                    echo wp_trim_words($short_desc, 12); 
                                } else {
                                    echo kmnu_get_clean_excerpt(get_the_content(), 12);
                                }
                                ?>
                            </p>

                            <div class="blog-footer-icon">
                                <div class="circle-icon"><i class="fa-solid fa-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="blogs-footer-cta">
            <a href="<?php echo home_url('/blogs'); ?>" class="btn-blogs-cta">Learn More</a>
        </div>
    </div>
</section>

<!-- Health CTA Section -->
<section class="health-cta-section">
    <div class="container container-cta">
        <div class="cta-blue-box">
            <div class="cta-content">
                <h2>Don’t Let Your Health <br> Take a Backseat!</h2>
                <p>Schedule an appointment with one of the best team of specialists today!</p>
                <a href="<?php echo esc_url(home_url('/book-appointment/')); ?>" class="btn-cta-book">Book Now <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="cta-doctor-wrap">
                <img src="<?php echo home_url('/wp-content/uploads/2026/04/Health-Take-a-Backseat-scaled.webp'); ?>"
                    alt="Doctor" class="cta-doc-img">

                <!-- Decorative Plus Elements -->
                <div class="plus-decoration pd-1"><i class="fa-solid fa-plus"></i></div>
                <div class="plus-decoration pd-2"><i class="fa-solid fa-plus"></i></div>
                <div class="plus-decoration pd-3"><i class="fa-solid fa-plus"></i></div>
                <div class="plus-decoration pd-4"><i class="fa-solid fa-plus"></i></div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Department Image Swap ---
        const deptItems = document.querySelectorAll('.dept-item');
        const mainImg = document.querySelector('.dept-main-img');

        if (deptItems.length > 0 && mainImg) {
            deptItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    deptItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    const newImg = this.getAttribute('data-dept-image');
                    if (newImg) {
                        mainImg.style.opacity = '0';
                        setTimeout(() => {
                            mainImg.src = newImg;
                            mainImg.style.opacity = '1';
                        }, 300);
                    }
                });
            });
        }

        // --- Doctors Carousel Navigation ---
        const slider = document.querySelector('.specialists-slider-container');
        const nextBtn = document.querySelector('.slider-arrows .next');
        const prevBtn = document.querySelector('.slider-arrows .prev');

        if (slider && nextBtn && prevBtn) {
            nextBtn.addEventListener('click', function (e) {
                e.preventDefault();
                slider.scrollBy({ left: 340, behavior: 'smooth' });
            });

            prevBtn.addEventListener('click', function (e) {
                e.preventDefault();
                slider.scrollBy({ left: -340, behavior: 'smooth' });
            });
        }

        // --- Hospitals Carousel Navigation ---
        const hSlider = document.querySelector('.hospitals-slider-container');
        const hNextBtn = document.querySelector('.hospitals-controls .h-next');
        const hPrevBtn = document.querySelector('.hospitals-controls .h-prev');

        if (hSlider && hNextBtn && hPrevBtn) {
            hNextBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const cardWidth = document.querySelector('.hospital-card').offsetWidth;
                const gap = 30; // Matches CSS gap
                hSlider.scrollBy({ left: cardWidth + gap, behavior: 'smooth' });
            });

            hPrevBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const cardWidth = document.querySelector('.hospital-card').offsetWidth;
                const gap = 30; // Matches CSS gap
                hSlider.scrollBy({ left: -(cardWidth + gap), behavior: 'smooth' });
            });
        }

        // --- Doctors Search Functionality ---
        const searchInput = document.querySelector('.doc-search input');
        const searchBtn = document.querySelector('.doc-search button');
        const doctorCards = document.querySelectorAll('.doctor-card');

        if (searchInput && doctorCards.length > 0) {
            const handleSearch = () => {
                const query = searchInput.value.toLowerCase().trim();
                doctorCards.forEach(card => {
                    const name = card.querySelector('h3').innerText.toLowerCase();
                    if (name.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Reset scroll to start after filtering
                if (slider) slider.scrollLeft = 0;
            };

            searchInput.addEventListener('input', handleSearch);
            if (searchBtn) searchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                handleSearch();
            });
        }

        // --- Video Sliders (Guidance & Stories) ---
        const setupSlider = (containerSelector, nextBtnSelector, prevBtnSelector) => {
            const container = document.querySelector(containerSelector);
            const row = container ? container.querySelector('.video-cards-row') : null;
            const nextBtn = document.querySelector(nextBtnSelector);
            const prevBtn = document.querySelector(prevBtnSelector);
            let index = 0;

            if (row && nextBtn && prevBtn) {
                const total = row.children.length;
                nextBtn.addEventListener('click', () => {
                    index = (index + 1) % total;
                    row.style.transform = `translateX(-${index * 100}%)`;
                });
                prevBtn.addEventListener('click', () => {
                    index = (index - 1 + total) % total;
                    row.style.transform = `translateX(-${index * 100}%)`;
                });
            }
        };

        setupSlider('.guidance-slider', '.g-next', '.g-prev');
        setupSlider('.stories-slider', '.s-next', '.s-prev');

        // --- Testimonials Carousel Navigation ---
        const tSliderContainer = document.querySelector('.testimonials-slider-container');
        const tGrid = tSliderContainer ? tSliderContainer.querySelector('.testimonials-grid') : null;
        const tNextBtn = document.querySelector('.t-next');
        const tPrevBtn = document.querySelector('.t-prev');
        let tIndex = 0;

        if (tGrid && tNextBtn && tPrevBtn) {
            const total = tGrid.children.length;
            const perView = 3;
            const steps = Math.ceil(total / perView);

            tNextBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (tIndex < total - perView) {
                    tIndex++;
                    const card = tGrid.querySelector('.testimonial-card');
                    const moveX = (card.offsetWidth + 40) * tIndex;
                    tGrid.style.transform = `translateX(-${moveX}px)`;
                } else {
                    tIndex = 0; // Loop back
                    tGrid.style.transform = `translateX(0)`;
                }
            });

            tPrevBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (tIndex > 0) {
                    tIndex--;
                    const card = tGrid.querySelector('.testimonial-card');
                    const moveX = (card.offsetWidth + 40) * tIndex;
                    tGrid.style.transform = `translateX(-${moveX}px)`;
                } else {
                    tIndex = total - perView; // Go to last possible view
                    const card = tGrid.querySelector('.testimonial-card');
                    const moveX = (card.offsetWidth + 40) * tIndex;
                    tGrid.style.transform = `translateX(-${moveX}px)`;
                }
            });
        }

        // --- Video Playback Logic ---
        const videoThumbs = document.querySelectorAll('.video-thumb-wrap');
        videoThumbs.forEach(thumb => {
            thumb.addEventListener('click', function () {
                const url = this.getAttribute('data-video-url');
                const videoId = url.match(/(?:[v=]|\/)([0-9A-Za-z_-]{11})/)[1];
                if (videoId) {
                    const iframe = document.createElement('iframe');
                    iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}?autoplay=1`);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                    iframe.setAttribute('allowfullscreen', 'true');
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    iframe.style.borderRadius = '20px';

                    this.innerHTML = '';
                    this.appendChild(iframe);
                }
            });
        });

        // --- Hero Search Section Functionality ---
        const heroSearchForm = document.querySelector('.hero-search-form');
        const heroSearchInput = document.getElementById('hero-doctor-search');
        const heroSpecSelect = document.getElementById('hero-specialization');
        const heroDocSelect = document.getElementById('hero-doctor');
        const heroDocOptions = Array.from(heroDocSelect.querySelectorAll('option:not([value=""])'));

        // Carry out Linked Dropdown: Filtering Doctors by Specialization
        if (heroSpecSelect && heroDocSelect) {
            heroSpecSelect.addEventListener('change', function () {
                const selectedSpec = this.value;

                // Show/hide relevant doctors
                heroDocSelect.value = ""; // Reset
                heroDocOptions.forEach(opt => {
                    const docSpecs = (opt.getAttribute('data-speciality') || '').split(' ');
                    if (!selectedSpec || docSpecs.includes(selectedSpec)) {
                        opt.style.display = "";
                        opt.disabled = false;
                    } else {
                        opt.style.display = "none";
                        opt.disabled = true;
                    }
                });
            });
        }

        // Redirect to doctor profile when selected
        if (heroDocSelect) {
            heroDocSelect.addEventListener('change', function () {
                if (this.value) {
                    window.location.href = `<?php echo home_url('/doctors/'); ?>` + this.value;
                }
            });
        }

        // Handling Hero Search Redirection
        if (heroSearchForm) {
            heroSearchForm.addEventListener('submit', function (e) {
                const query = heroSearchInput.value.toLowerCase().trim();
                if (!query) return;

                // Check for Doctor Name direct match
                const docMatches = <?php echo json_encode(array_map(function ($d) {
                    return ['title' => strtolower($d->post_title), 'url' => home_url('/doctors/' . $d->post_name)];
                }, $all_doctors)); ?>;
                const docFound = docMatches.find(d => d.title === query);
                if (docFound) {
                    e.preventDefault();
                    window.location.href = docFound.url;
                    return;
                }

                // Check for Speciality Match
                const specMatches = <?php echo json_encode(array_map(function ($t) {
                    return ['name' => strtolower($t->name), 'url' => get_term_link($t)];
                }, $specializations)); ?>;
                const specFound = specMatches.find(s => s.name === query);
                if (specFound) {
                    e.preventDefault();
                    window.location.href = specFound.url;
                    return;
                }

                // Check for Department Match
                const deptMatches = <?php echo json_encode(array_map(function ($d) {
                    return ['title' => strtolower($d->post_title), 'url' => get_permalink($d)];
                }, $all_departments)); ?>;
                const deptFound = deptMatches.find(d => d.title === query);
                if (deptFound) {
                    e.preventDefault();
                    window.location.href = deptFound.url;
                    return;
                }
            });
        }
    });
</script>

<?php
get_footer();
?>
