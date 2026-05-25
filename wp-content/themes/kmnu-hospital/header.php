<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Meta Description Check -->
    <?php if ( is_singular() && has_excerpt() ) : ?>
        <meta name="description" content="<?php echo wp_strip_all_tags( get_the_excerpt() ); ?>">
    <?php elseif ( get_bloginfo( 'description' ) ) : ?>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* Language Toggle Styles */
        .lang-toggle-fixed {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 9999;
            background: #fff;
            padding: 8px;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            box-shadow: -5px 0 20px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 5px;
            border: 1px solid #eee;
            border-right: none;
        }
        .lang-btn {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            border: 1px solid transparent;
        }
        .lang-btn.active {
            background: #0065a5;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,101,165,0.3);
        }
        .lang-btn:hover:not(.active) {
            background: #f0f7ff;
            color: #0065a5;
        }
        @media (max-width: 768px) {
            .lang-toggle-fixed {
                top: auto;
                bottom: 18px;
                right: 86px;
                transform: none;
                padding: 5px;
                border-radius: 12px;
                border-right: 1px solid #eee;
                flex-direction: row;
            }
            .lang-btn {
                width: 36px;
                height: 36px;
                font-size: 12px;
            }
        }
        .goog-te-banner-frame, .skiptranslate, #google_translate_element {
            display: none !important;
        }
        body {
            top: 0 !important;
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="google_translate_element"></div>

<!-- Language Toggle UI -->
<div class="lang-toggle-fixed notranslate">
    <div class="lang-btn active" id="lang-en" onclick="translatePage('en', this)">EN</div>
    <div class="lang-btn" id="lang-ta" onclick="translatePage('ta', this)">தமிழ்</div>
</div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,ta',
            autoDisplay: false
        }, 'google_translate_element');
    }

    function translatePage(lang, btn) {
        // Update UI
        document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Trigger Google Translate
        var select = document.querySelector('.goog-te-combo');
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event('change'));
        }
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- Upper Section: Logo and Action Buttons -->
<div class="header-upper">
    <div class="container">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/KM-NU-Logo-scaled.jpg' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
            </a>
        </div>
        
        <div class="header-actions">
            <a href="tel:+918431314141" class="btn btn-call"><i class="fa-solid fa-phone-volume"></i></a>
            <a href="<?php echo esc_url( home_url( '/book-appointment/' ) ); ?>" class="btn btn-appointment">BOOK AN APPOINTMENT</a>
            <a href="tel:+918431314141" class="btn btn-emergency">EMERGENCY</a>
        </div>
    </div>
</div>

<!-- Bottom Section: Navigation Menu -->
<header id="masthead" class="site-header">
    <div class="container">
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container'      => false,
            ) );
            ?>
        </nav>
        <div class="menu-dropdown-wrap">
            <div class="mobile-menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="header-flyout-menu">
                <ul class="flyout-list">
                    <li><a href="<?php echo home_url('/blogs'); ?>" class="btn-outline">Blogs</a></li>
                    <li><a href="<?php echo home_url('/careers'); ?>" class="btn-outline">Careers</a></li>
                    <li><a href="<?php echo home_url('/awards'); ?>" class="btn-outline">Awards</a></li>
                    <li><a href="<?php echo home_url('/gallery'); ?>" class="btn-outline">Gallery</a></li>
                    <li><a href="<?php echo home_url('/news'); ?>" class="btn-outline">News</a></li>
                    <li><a href="<?php echo home_url('/bmw-reports'); ?>" class="btn-outline">BMW Reports</a></li>
                    <li><a href="https://access.nuhospitals.com/PatientPortal" class="btn-solid-orange">Online Report</a></li>
                </ul>
            </div>
        </div>
        <div class="mob-res-hamburger">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
</header>

<div id="content" class="site-content">
