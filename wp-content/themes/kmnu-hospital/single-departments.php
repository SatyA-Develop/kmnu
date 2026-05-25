<?php
/**
 * Template for displaying single Department (Speciality inner page)
 */
get_header();

while (have_posts()):
    the_post();

    // Meta fields
    $hero_subtitle = get_post_meta(get_the_ID(), 'hero_subtitle', true);
    $hero_bg_color = get_post_meta(get_the_ID(), 'hero_bg_color', true) ?: '#0065a5';
    $dept_icon = get_post_meta(get_the_ID(), 'dept_icon', true);
    // Retrieve nested sub-specialities groups with legacy support
    $sub_specialities_groups = get_post_meta(get_the_ID(), 'sub_specialities_groups', true);
    if (empty($sub_specialities_groups)) {
        $legacy_subs = get_post_meta(get_the_ID(), 'sub_specialities', true);
        $legacy_heading = get_post_meta(get_the_ID(), 'sub_specialities_heading', true) ?: 'SUB SPECIALITIES';
        if (!empty($legacy_subs)) {
            $sub_specialities_groups = array(
                array(
                    'heading' => $legacy_heading,
                    'items'   => $legacy_subs
                )
            );
        }
    }
    $faqs = get_post_meta(get_the_ID(), 'dept_faqs', true) ?: array();
    $more_title = get_post_meta(get_the_ID(), 'more_details_title', true);
    $more_content = get_post_meta(get_the_ID(), 'more_details_content', true);
    $selected_doctors = get_post_meta(get_the_ID(), 'dept_doctors', true) ?: array();

    // Featured image for hero right side
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

    // Find a doctors page link
    $doctors_page = get_page_by_path('doctors');
    $find_doctor_url = $doctors_page ? get_permalink($doctors_page->ID) : home_url('/doctors/');
    ?>

    <!-- ===== SPECIALITY HERO SECTION ===== -->
    <?php
    $hero_bg_img = home_url('/wp-content/uploads/2026/04/KMNU_Home-Assets-01-scaled.webp');
    $hero_inline_style = 'background-color:' . esc_attr($hero_bg_color) . ';'
        . 'background-image:url(' . esc_url($hero_bg_img) . ');'
        . 'background-size:cover;background-position:center bottom;background-repeat:no-repeat;';
    $banner_title = get_post_meta(get_the_ID(), 'banner_title', true);
    ?>
    <section class="dept-hero-section" style="<?php echo $hero_inline_style; ?>">
        <div class="container dept-hero-container">
            <div class="dept-hero-content">
                <?php if ($dept_icon): ?>
                    <div class="dept-hero-icon">
                        <i class="fa-solid <?php echo esc_attr($dept_icon); ?>"></i>
                    </div>
                <?php endif; ?>

                <h1 class="dept-hero-title">
                    <?php echo esc_html(!empty($banner_title) ? $banner_title : get_the_title()); ?>
                </h1>

                <?php if ($hero_subtitle): ?>
                    <p class="dept-hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php elseif (has_excerpt()): ?>
                    <p class="dept-hero-subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <a href="<?php echo esc_url($find_doctor_url); ?>" class="dept-hero-btn">
                    FIND A DOCTOR
                </a>
            </div>

            <div class="dept-hero-image">
                <?php if ($featured_img_url): ?>
                    <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php the_title_attribute(); ?>" class="dept-hero-img">
                <?php elseif ($dept_icon): ?>
                    <div class="dept-hero-icon-fallback">
                        <i class="fa-solid <?php echo esc_attr($dept_icon); ?>"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="dept-hero-wave">
            <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f4f7fa" />
            </svg>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="dept-inner-wrap">
        <div class="container">



            <!-- Extra Details: Title + Content sits ABOVE the sub-specialities box -->
            <?php if ($more_title || $more_content): ?>
                <div class="dept-more-section">
                    <?php if ($more_title): ?>
                        <h2 class="dept-more-title"><?php echo esc_html($more_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($more_content): ?>
                        <div class="dept-more-content"><?php echo wp_kses_post($more_content); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Sub Specialities box (dark blue gradient, white icons) -->
            <?php if (!empty($sub_specialities_groups)): ?>
                <?php
                foreach ($sub_specialities_groups as $g_idx => $group): 
                    $group_heading = isset($group['heading']) ? $group['heading'] : 'SUB SPECIALITIES';
                    $group_items = isset($group['items']) ? (array)$group['items'] : array();
                    if (empty($group_items)) continue;
                    $is_carousel_group = $g_idx > 0;
                    $carousel_id = 'deptSubCarousel-' . $g_idx;
                ?>
                    <div class="dept-sub-section <?php echo $is_carousel_group ? 'dept-sub-section-carousel' : ''; ?>">
                        <div class="dept-sub-box">
                            <div class="dept-sub-header">
                                <h2 class="dept-sub-heading"><?php echo esc_html($group_heading); ?></h2>
                                <?php if ($is_carousel_group): ?>
                                    <div class="dept-sub-arrows">
                                        <button type="button" class="dept-sub-prev" data-target="<?php echo esc_attr($carousel_id); ?>" aria-label="Previous <?php echo esc_attr($group_heading); ?>">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </button>
                                        <button type="button" class="dept-sub-next" data-target="<?php echo esc_attr($carousel_id); ?>" aria-label="Next <?php echo esc_attr($group_heading); ?>">
                                            <i class="fa-solid fa-angles-right"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="<?php echo $is_carousel_group ? 'dept-sub-carousel' : 'dept-sub-grid'; ?>" <?php echo $is_carousel_group ? 'id="' . esc_attr($carousel_id) . '"' : ''; ?>>
                                <?php foreach ($group_items as $sub): ?>
                                    <div class="dept-sub-card">
                                        <div class="sub-card-icon-wrap">
                                            <?php if (!empty($sub['image'])): ?>
                                                <?php
                                                $sub_image_full = wp_get_attachment_image_url($sub['image'], 'large');
                                                echo wp_get_attachment_image(
                                                    $sub['image'],
                                                    array(64, 64),
                                                    false,
                                                    array(
                                                        'class' => 'sub-card-img',
                                                        'data-full-image' => esc_url($sub_image_full),
                                                        'data-image-title' => esc_attr($sub['title']),
                                                        'role' => 'button',
                                                        'tabindex' => '0',
                                                    )
                                                );
                                                ?>
                                            <?php elseif (!empty($sub['icon'])): ?>
                                                <i class="fa-solid <?php echo esc_attr($sub['icon']); ?>"></i>
                                            <?php else: ?>
                                                <i class="fa-solid fa-stethoscope"></i>
                                            <?php endif; ?>
                                        </div>
                                        <span class="sub-card-label"><?php echo esc_html($sub['title']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Assigned Doctors -->
            <?php if (!empty($selected_doctors)): ?>
            </div><!-- /.container -->
        </div><!-- /.dept-inner-wrap -->

        <!-- Doctors Section: full-width section, header in container, carousel overflows right -->
        <section class="dept-doctors-section">
            <div class="container">
                <div class="dept-doctors-header">
                    <div class="dept-doctors-title-box">
                        <h2 class="dept-doctors-title">Our Team of Specialists</h2>
                    </div>
                    <div class="dept-doctors-arrows slider-arrows">
                        <button class="dept-doc-prev"><i class="fa-solid fa-angles-left"></i></button>
                        <button class="dept-doc-next"><i class="fa-solid fa-angles-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="dept-doctors-slider-wrapper">
                <div class="dept-doctors-mask-left"></div>
                <div class="dept-doctors-slider" id="deptDoctorsSlider">
                    <?php foreach ($selected_doctors as $doc_id):
                        $doc = get_post($doc_id);
                        if (!$doc)
                            continue;
                        $qualification = get_post_meta($doc_id, 'qualification', true);
                        $profile = get_post_meta($doc_id, 'profile', true);
                        $doc_img = get_the_post_thumbnail_url($doc_id, 'medium_large');
                        ?>
                        <div class="dept-doctor-card">
                            <div class="dept-doc-img">
                                <div class="dept-doc-img-circle">
                                    <?php if ($doc_img): ?>
                                        <img src="<?php echo esc_url($doc_img); ?>" alt="<?php echo esc_attr($doc->post_title); ?>">
                                    <?php else: ?>
                                        <div class="dept-doc-placeholder"><i class="fa-solid fa-user-doctor"></i></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="dept-doc-info">
                                <h4><?php echo esc_html($doc->post_title); ?></h4>
                                <?php if ($qualification): ?>
                                    <p class="doc-qual"><?php echo esc_html($qualification); ?></p>
                                <?php endif; ?>
                                <?php if ($profile): ?>
                                    <p class="doc-profile"><?php echo esc_html($profile); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(add_query_arg('doctor_id', $doc_id, home_url('/book-appointment/'))); ?>" class="dept-doc-btn">BOOK AN
                                    APPOINTMENT</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <div class="dept-inner-wrap dept-inner-wrap-bottom">
            <div class="container">
            <?php endif; ?>

            <!-- FAQs / Accordion Section -->
            <?php if (!empty($faqs)): ?>
                <div class="dept-faq-section-new">
                    <div class="dept-accordion-list">
                        <?php foreach ($faqs as $i => $faq): ?>
                            <div class="dept-acc-item <?php echo ($i === 0) ? 'active' : ''; ?>" id="acc-<?php echo $i; ?>">
                                <div class="dept-acc-header" onclick="toggleAccordion(<?php echo $i; ?>)">
                                    <h3 class="dept-acc-title"><?php echo esc_html($faq['q']); ?></h3>
                                    <div class="dept-acc-icon">
                                        <i class="fa-solid <?php echo ($i === 0) ? 'fa-minus' : 'fa-plus'; ?>"></i>
                                    </div>
                                </div>
                                <div class="dept-acc-content" id="acc-content-<?php echo $i; ?>">
                                    <div class="dept-acc-body">
                                        <?php echo wp_kses_post($faq['a']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div><!-- /.container -->
    </div><!-- /.dept-inner-wrap / .dept-inner-wrap-bottom -->

    <div class="dept-image-lightbox" id="deptImageLightbox" aria-hidden="true">
        <button type="button" class="dept-lightbox-close" aria-label="Close image preview"><i class="fa-solid fa-xmark"></i></button>
        <div class="dept-lightbox-content">
            <img src="" alt="" id="deptLightboxImage">
            <div class="dept-lightbox-title" id="deptLightboxTitle"></div>
        </div>
    </div>

    <style>
        /* ===== GLOBAL HEADER OVERLAY ===== */
.site-header {
    margin-bottom: -100px;
    background: transparent !important;
    box-shadow: none;
    position: relative;
    z-index: 130;
}

.site-header a, 
.site-header i {
    color: #fff !important;
}

/* ===== DEPT HERO ===== */
        .dept-hero-section {
            position: relative;
            min-height: 500px;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding: 180px 0 100px;
        }

        .dept-hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            position: relative;
            z-index: 2;
        }

        .dept-hero-content {
            flex: 1;
            color: #fff;
            max-width: 600px;
        }

        .dept-hero-icon {
            font-size: 48px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 20px;
        }

        .dept-hero-title {
            font-size: 64px;
            font-weight: 900;
            line-height: 1.1;
            margin: 0 0 20px;
            letter-spacing: -1.5px;
            color: #fff;
        }

        .dept-hero-subtitle {
            font-size: 22px;
            font-weight: 700;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.95);
            margin: 0 0 40px;
            max-width: 520px;
        }

        .dept-hero-btn {
            display: inline-block;
            background: #ff9933;
            color: #fff;
            padding: 16px 40px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 16px;
            text-decoration: none;
            letter-spacing: 1px;
            transition: background 0.3s;
        }

        .dept-hero-btn:hover {
            background: #e6851a;
            color: #fff;
        }

        /* Right image */
        .dept-hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
        }

        .dept-hero-img {
            max-width: 100%;
            max-height: 420px;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.25));
        }

        .dept-hero-icon-fallback {
            width: 280px;
            height: 280px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Wave */
        .dept-hero-wave {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            line-height: 0;
            z-index: 3;
        }

        .dept-hero-wave svg {
            display: block;
            width: 100%;
            height: 80px;
        }

        /* ===== INNER CONTENT ===== */
        .dept-inner-wrap {
            background: #f4f7fa;
            padding: 70px 0 100px;
        }

        .dept-description {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 50px;
            font-size: 17px;
            line-height: 1.8;
            color: #444;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .dept-section-title {
            font-size: 32px;
            font-weight: 800;
            color: #0065a5;
            margin: 0 0 30px;
            padding-bottom: 12px;
            border-bottom: 3px solid #e8f0f7;
        }

        /* Sub Specialities */
        .dept-sub-section {
            margin-bottom: 60px;
        }

        .dept-sub-box {
            background: linear-gradient(26deg, #003f7a69 0%, #0065a5 60%, #00a3e08a 100%);
            border-radius: 20px;
            padding: 50px 50px 40px;
        }

        .dept-sub-heading {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        .dept-sub-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin: 0 0 40px;
        }

        .dept-sub-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px 20px;
        }

        .dept-sub-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            padding: 4px 0 14px;
            scroll-snap-type: x mandatory;
        }

        .dept-sub-carousel::-webkit-scrollbar {
            display: none;
        }

        .dept-sub-carousel .dept-sub-card {
            flex: 0 0 calc((100% - 100px) / 6);
            scroll-snap-align: start;
        }

        .dept-sub-arrows {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .dept-sub-arrows button {
            width: 42px;
            height: 42px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .dept-sub-arrows button:hover {
            background: rgba(255, 255, 255, 0.24);
            transform: translateY(-2px);
        }

        .dept-sub-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px 10px;
            gap: 14px;
            cursor: default;
            transition: transform 0.3s;
        }

        .dept-sub-card:hover {
            transform: translateY(-4px);
        }

        .sub-card-icon-wrap {
            width: 72px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #fff;
        }

        .sub-card-icon-wrap img.sub-card-img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            cursor: zoom-in;
        }

        .sub-card-label {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            line-height: 1.4;
        }

        .dept-image-lightbox {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(4, 20, 34, 0.86);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 28px;
        }

        .dept-image-lightbox.active {
            display: flex;
        }

        .dept-lightbox-content {
            max-width: min(900px, 92vw);
            text-align: center;
        }

        .dept-lightbox-content img {
            max-width: 100%;
            max-height: 78vh;
            object-fit: contain;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.35);
        }

        .dept-lightbox-title {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            margin-top: 16px;
            line-height: 1.4;
        }

        .dept-lightbox-close {
            position: absolute;
            top: 22px;
            right: 24px;
            width: 46px;
            height: 46px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            cursor: pointer;
            font-size: 20px;
        }

        /* More Details (above sub-specialities) */
        .dept-more-section {
            margin-bottom: 40px;
        }

        .dept-more-title {
            font-size: 22px;
            font-weight: 800;
            color: #0065a5;
            margin: 0 0 14px;
        }

        .dept-more-content {
            font-size: 15px;
            line-height: 1.8;
            color: #555;
        }

        .dept-extra-block {
            margin-top: 30px;
        }

        .dept-extra-block h3 {
            color: #0065a5;
            font-size: 22px;
            font-weight: 800;
            margin: 0 0 18px;
        }

        .dept-extra-card-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .dept-extra-card {
            background: #fff;
            border: 1px solid #e4edf4;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(0, 101, 165, 0.06);
        }

        .dept-extra-card h4 {
            color: #123c5d;
            font-size: 17px;
            font-weight: 800;
            margin: 0 0 8px;
        }

        .dept-extra-card p,
        .dept-extra-why p {
            margin: 0;
        }

        .dept-extra-why {
            background: #eef7fc;
            border-left: 4px solid #0065a5;
            border-radius: 8px;
            padding: 24px;
        }

        /* ===== Doctors Carousel Section (Redesigned) ===== */
        .dept-doctors-section {
            background: #fff;
            padding: 100px 0;
            overflow-x: hidden;
        }

        .dept-doctors-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 60px;
        }

        .dept-doctors-title-box {
            background: #e3f2fd;
            padding: 20px 40px;
            border-radius: 12px;
            display: inline-block;
            position: relative;
            overflow: hidden;
            height: 300px;
            width: 670px;
            max-width: 90%;
            margin-bottom: -350px;
        }

        .dept-doctors-title-box::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3));
            transform: skewX(-20deg) translateX(50px);
        }

        .dept-doctors-title {
            font-size: 32px;
            font-weight: 800;
            color: #0065a5;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .dept-doctors-arrows button {
            background: none;
            border: none;
            font-size: 32px;
            color: #0065a5;
            cursor: pointer;
            padding: 10px;
            transition: 0.3s;
        }

        .dept-doctors-arrows button:hover {
            color: #ff9933;
            transform: scale(1.1);
        }

        /* Full-width slider, right-shifted bleed */
        .dept-doctors-slider-wrapper {
            position: relative;
            width: 100%;
        }

        .dept-doctors-mask-left {
            position: absolute;
            top: -20px;
            left: 0;
            width: calc((100vw - 1600px) / 2);
            height: calc(100% + 40px);
            background: #fff;
            z-index: 20;
        }

        @media (max-width: 1640px) {
            .dept-doctors-mask-left {
                width: 2.5%;
            }
        }

        .dept-doctors-slider {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px 0 40px;
            padding-left: calc((100vw - 1600px) / 2);
            position: relative;
            z-index: 10;
            scrollbar-width: none;
        }

        @media (max-width: 1640px) {
            .dept-doctors-slider {
                padding-left: 5.5%;
            }
        }

        .dept-doctors-slider::-webkit-scrollbar {
            display: none;
        }

        .dept-doctor-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            min-width: 580px;
            max-width: 580px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
            transition: 0.4s;
            border: 1px solid #eee;
        }

        .dept-doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 101, 165, 0.1);
        }

        .dept-doc-img {
            width: 240px;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dept-doc-img-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            background: #000;
        }

        .dept-doc-img-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dept-doc-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #fff;
        }

        .dept-doc-info {
            padding: 40px 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 12px;
        }

        .dept-doc-info h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #222;
            line-height: 1.2;
        }

        .doc-qual {
            font-size: 15px;
            color: #666;
            margin: 0;
            line-height: 1.4;
        }

        .doc-profile {
            font-size: 14px;
            font-weight: 500;
            color: #444;
            line-height: 1.6;
        }

        .dept-doc-btn {
            display: inline-block;
            margin-top: 10px;
            background: #0065a5;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 14px 24px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
            align-self: flex-start;
        }

        .dept-doc-btn:hover {
            background: #ff9933;
            color: #fff;
        }

        .dept-inner-wrap-bottom {
            padding-top: 60px;
        }

        /* Accordion Section (Replaces FAQs) */
        .dept-faq-section-new {
            margin-top: 60px;
        }

        .dept-accordion-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .dept-acc-item {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .dept-acc-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 35px;
            cursor: pointer;
            background: #f0f2f5;
            color: #0065a5;
            transition: background 0.3s, color 0.3s;
            box-sizing: border-box;
        }

        .dept-acc-item.active .dept-acc-header {
            background: #0065a5;
            color: #fff;
        }

        .dept-acc-title {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            flex: 1;
            padding-right: 20px;
        }

        .dept-acc-icon {
            font-size: 26px;
            width: 30px;
            text-align: center;
        }

        .dept-acc-icon i {
            font-weight: 900 !important;
            font-size: 28px;
            -webkit-text-stroke: 1px currentColor;
        }

        .dept-acc-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            border-top: 1px solid transparent;
            box-sizing: border-box;
            padding: 0 35px;
        }

        .dept-acc-item.active .dept-acc-content {
            max-height: 2000px; /* Safe large value for dynamics */
            padding: 40px 35px;
            border-top: 1px solid #f0f2f5;
        }

        .dept-acc-body {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
        }

        .dept-acc-body p {
            margin-bottom: 15px;
        }

        .dept-acc-body h4 {
            color: #0065a5;
            font-size: 18px;
            font-weight: 800;
            margin: 22px 0 10px;
        }

        .dept-acc-body ul {
            margin: 0 0 16px 20px;
            padding: 0;
        }

        .dept-faq-image {
            margin: 0 0 24px;
            max-width: 420px;
        }

        .dept-faq-image img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
        }

        .dept-faq-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .dept-faq-gallery figure {
            margin: 0;
            background: #f7fbfe;
            border: 1px solid #e2edf5;
            border-radius: 8px;
            overflow: hidden;
        }

        .dept-faq-gallery img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .dept-faq-gallery figcaption {
            padding: 12px 14px;
            color: #444;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dept-doctor-card {
                min-width: 500px;
                max-width: 500px;
            }

            .dept-doc-img {
                width: 180px;
            }

            .dept-doc-img-circle {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 900px) {
            .dept-hero-container {
                flex-direction: column;
                text-align: center;
            }

            .dept-hero-content {
                max-width: 100%;
            }

            .dept-hero-title {
                font-size: 40px;
            }

            .dept-hero-image {
                justify-content: center;
            }

            .dept-hero-img {
                max-height: 280px;
            }

            .dept-sub-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .dept-sub-carousel .dept-sub-card {
                flex-basis: calc((100% - 40px) / 3);
            }

            .dept-extra-card-grid {
                grid-template-columns: 1fr;
            }

            .dept-doctor-card {
                flex-direction: column;
                min-width: 340px;
            }

            .dept-doc-img {
                width: 100%;
                padding: 30px 0;
            }

            .dept-acc-title {
                font-size: 20px;
            }
        }

        @media (max-width: 600px) {
            .dept-hero-title {
                font-size: 32px;
            }

            .dept-sub-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dept-sub-carousel .dept-sub-card {
                flex-basis: calc((100% - 20px) / 2);
            }

            .dept-faq-gallery {
                grid-template-columns: 1fr;
            }

            .dept-sub-box {
                padding: 30px 20px;
            }

            .dept-sub-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
                margin-bottom: 28px;
            }

            .dept-doctor-card {
                min-width: 280px;
            }

            .dept-doctors-title {
                font-size: 24px;
            }

            .dept-doctors-title-box {
                padding: 15px 25px;
            }
        }
    </style>

    <script>
        function toggleAccordion(index) {
            const items = document.querySelectorAll('.dept-acc-item');
            const clickedItem = document.getElementById('acc-' + index);
            const isOpen = clickedItem.classList.contains('active');

            // Close all items
            items.forEach(item => {
                item.classList.remove('active');
                const icon = item.querySelector('.dept-acc-icon i');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            });

            // If it wasn't open, open it
            if (!isOpen) {
                clickedItem.classList.add('active');
                const icon = clickedItem.querySelector('.dept-acc-icon i');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var slider = document.getElementById('deptDoctorsSlider');
            var btnNext = document.querySelector('.dept-doc-next');
            var btnPrev = document.querySelector('.dept-doc-prev');

            if (slider && btnNext && btnPrev) {
                // Find visible card width
                btnNext.addEventListener('click', function () {
                    var card = slider.querySelector('.dept-doctor-card');
                    var cardWidth = 580 + 30; // card min-width + gap
                    if (window.innerWidth <= 1200) cardWidth = 500 + 30;
                    if (window.innerWidth <= 900) cardWidth = 340 + 30;
                    if (window.innerWidth <= 600) cardWidth = 280 + 30;
                    slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                });
                btnPrev.addEventListener('click', function () {
                    var card = slider.querySelector('.dept-doctor-card');
                    var cardWidth = 580 + 30; // card min-width + gap
                    if (window.innerWidth <= 1200) cardWidth = 500 + 30;
                    if (window.innerWidth <= 900) cardWidth = 340 + 30;
                    if (window.innerWidth <= 600) cardWidth = 280 + 30;
                    slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                });
            }

            document.querySelectorAll('.dept-sub-next, .dept-sub-prev').forEach(function (button) {
                button.addEventListener('click', function () {
                    var targetId = button.getAttribute('data-target');
                    var carousel = document.getElementById(targetId);
                    if (!carousel) return;

                    var card = carousel.querySelector('.dept-sub-card');
                    var gap = parseFloat(window.getComputedStyle(carousel).columnGap || window.getComputedStyle(carousel).gap) || 20;
                    var scrollAmount = card ? card.getBoundingClientRect().width + gap : carousel.clientWidth;
                    var direction = button.classList.contains('dept-sub-prev') ? -1 : 1;

                    carousel.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
                });
            });

            var lightbox = document.getElementById('deptImageLightbox');
            var lightboxImage = document.getElementById('deptLightboxImage');
            var lightboxTitle = document.getElementById('deptLightboxTitle');

            function openDeptImageLightbox(image) {
                if (!lightbox || !lightboxImage) return;

                var fullImage = image.getAttribute('data-full-image') || image.getAttribute('src');
                var title = image.getAttribute('data-image-title') || image.getAttribute('alt') || '';

                lightboxImage.setAttribute('src', fullImage);
                lightboxImage.setAttribute('alt', title);
                if (lightboxTitle) lightboxTitle.textContent = title;
                lightbox.classList.add('active');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeDeptImageLightbox() {
                if (!lightbox || !lightboxImage) return;

                lightbox.classList.remove('active');
                lightbox.setAttribute('aria-hidden', 'true');
                lightboxImage.setAttribute('src', '');
                document.body.style.overflow = '';
            }

            document.querySelectorAll('.sub-card-img[data-full-image]').forEach(function (image) {
                image.addEventListener('click', function () {
                    openDeptImageLightbox(image);
                });
                image.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        openDeptImageLightbox(image);
                    }
                });
            });

            if (lightbox) {
                lightbox.addEventListener('click', function (event) {
                    if (event.target === lightbox || event.target.closest('.dept-lightbox-close')) {
                        closeDeptImageLightbox();
                    }
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && lightbox && lightbox.classList.contains('active')) {
                    closeDeptImageLightbox();
                }
            });
        });
    </script>

<?php endwhile; ?>

<?php get_footer(); ?>
