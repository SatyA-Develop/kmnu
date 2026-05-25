</div><!-- #content -->

<!-- Footer Subscription Section -->
<section class="footer-subscription">
    <div class="container">
        <h2>Be Our Subscribers</h2>
        <p>To get the latest news about health from our experts</p>
        <?php if (isset($_GET['subscription']) && $_GET['subscription'] === 'error') : ?>
            <p class="subscription-message subscription-message-error">Please enter a valid email address.</p>
        <?php endif; ?>
        <form class="subscription-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="submit_kmnu_subscription">
            <?php wp_nonce_field('kmnu_subscription_nonce', 'kmnu_subscription_nonce_field'); ?>
            <?php kmnu_render_spam_protection_fields('subscription'); ?>
            <div class="input-wrap">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="subscriber_email" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="btn-subscribe">Subscribe</button>
        </form>
    </div>
</section>

<footer id="colophon" class="site-footer">
    <div class="container footer-main">
        <!-- Footer Branding & Address -->
        <div class="footer-col footer-branding">
            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/KM-NU-Logo-scaled.jpg')); ?>"
                alt="NU Hospitals" class="footer-logo">
            <div class="footer-address">
                <h3>Address</h3>
                <p>75/2F2, NH 48, MC Road, Solur, Ambur - 635 814, Tirupattur (Dt.), Tamilnadu.</p>
                <p>Phone No: +91 8431314141</p>
                <p>Email: care.ambur@nuhospitals.com</p>
            </div>
        </div>

        <!-- Our Locations -->
        <div class="footer-col">
            <h3>Our Locations</h3>
            <ul>
                <li><a
                        href="<?php echo esc_url(home_url('/locations/nu-hospitals-padmanabhanagar/')); ?>">Padmanabhanagar</a>
                </li>
                <li><a
                        href="<?php echo esc_url(home_url('/locations/nu-hospitals-rajajinagar/')); ?>">Rajajinagar</a>
                </li>
                <li><a href="<?php echo esc_url(home_url('/locations/nu-hospitals-shivamogga/')); ?>">Shivamogga</a>
                </li>
                <li><a href="<?php echo esc_url(home_url('/locations/km-nu-hospitals-ambur/')); ?>">Ambur</a></li>
                <li><a href="<?php echo esc_url(home_url('/locations/nu-hospitals-maldives/')); ?>">Maldives</a>
                </li>
            </ul>
        </div>

        <!-- Centres Of Excellence -->
        <div class="footer-col">
            <h3>Centres Of Excellence</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/specialities/nephrology/')); ?>">Nephrology</a></li>
                <li><a href="<?php echo esc_url(home_url('/specialities/urology/')); ?>">Urology</a></li>
                <li><a href="<?php echo esc_url(home_url('/specialities/andrology/')); ?>">Andrology</a></li>
                <li><a href="<?php echo esc_url(home_url('/specialities/reproductivemedicine-ivf/')); ?>">Fertility (IVF)</a></li>
                <li><a href="<?php echo esc_url(home_url('/specialities/radiodignosis/')); ?>">Radiodiagnosis</a></li>
            </ul>
        </div>

        <!-- Quick Links -->
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About us</a></li>
                <li><a href="<?php echo esc_url(home_url('/specialities/')); ?>">Specialities</a></li>
                <li><a href="<?php echo esc_url(home_url('/doctors/')); ?>">Our doctors</a></li>
                <li><a href="<?php echo esc_url(home_url('/preventive-health-checkup/')); ?>">Health check</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact us</a></li>
            </ul>
        </div>

        <!-- Information & Legal -->
        <div class="footer-col">
            <div class="footer-sub-col">
                <h3>Information</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/blogs/')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/testimonials/')); ?>">Testimonials</a></li>
                    <li><a href="<?php echo esc_url(home_url('/videos/')); ?>">Videos</a></li>
                </ul>
            </div>
            <div class="footer-sub-col" style="margin-top: 30px;">
                <h3>Legal</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms-conditions/')); ?>">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Public Notice Section -->
    <div class="footer-notice">
        <div class="container">
            <p>Public Notice: NU Hospitals would like to inform the general public that NU Hospitals practices all organ
                transplants in accordance with The Transplantation of Human Organs Act 1994. NU Hospitals does not buy
                or sell any organ and seriously condemn this act. NU Hospitals do not by any nature seek your personal
                information such as name, telephone, address or banking details for any purpose.</p>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> NU Hospitals. All Rights Reserved.
            </div>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(home_url('/news/')); ?>">News & Events</a> | <a
                    href="<?php echo esc_url(home_url('/careers/')); ?>">Careers</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Appointment Button -->
<a href="<?php echo esc_url(home_url('/book-appointment/')); ?>" class="floating-appoint-btn">
    <i class="fa-solid fa-calendar-check"></i> Book Appointment
</a>

<?php
// Output the mobile responsive menu
$mob_menu_data = kmnu_get_mob_res_menu_data();
?>
<div class="mob-res-overlay" id="mobResOverlay"></div>
<div class="mob-res-menu-container" id="mobResMenuContainer">
    <div class="mob-res-menu-header">
        <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/KM-NU-Logo-scaled.jpg')); ?>" alt="Logo"
            class="mob-res-logo">
        <button class="mob-res-close" id="mobResClose"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="mob-res-menu-body">
        <ul class="mob-res-primary-list">
            <?php foreach ($mob_menu_data['primary_menu'] as $item): ?>
                <li class="mob-res-item">
                    <?php if (isset($item['submenu']) || isset($item['mega_menu'])): ?>
                        <div class="mob-res-link-wrap">
                            <a href="<?php echo esc_url($item['link']); ?>"><?php echo esc_html($item['name']); ?></a>
                            <button class="mob-res-toggle-btn"><i class="fa-solid fa-chevron-down"></i></button>
                        </div>
                        <ul class="mob-res-submenu">
                            <?php if (isset($item['submenu'])): ?>
                                <?php foreach ($item['submenu'] as $sub): ?>
                                    <li><a href="<?php echo esc_url($sub['link']); ?>"><?php echo esc_html($sub['name']); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (isset($item['mega_menu'])): ?>
                                <?php foreach ($item['mega_menu']['departments'] as $dept): ?>
                                    <li><a href="<?php echo esc_url($dept['link']); ?>"><?php echo esc_html($dept['name']); ?></a></li>
                                <?php endforeach; ?>
                                <li><a href="<?php echo esc_url($item['mega_menu']['footer_button']['link']); ?>"
                                        class="mob-res-view-all"><?php echo esc_html($item['mega_menu']['footer_button']['name']); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <a href="<?php echo esc_url($item['link']); ?>"
                            class="mob-res-single-link"><?php echo esc_html($item['name']); ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mob-res-divider"></div>

        <ul class="mob-res-flyout-list">
            <?php foreach ($mob_menu_data['header_flyout_menu'] as $flyout): ?>
                <li><a href="<?php echo esc_url($flyout['link']); ?>"
                        class="<?php echo ($flyout['name'] == 'Online Report') ? 'btn-solid-orange' : 'btn-outline'; ?>"><?php echo esc_html($flyout['name']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(function (form) {
            var ts = form.querySelector('input[name="kmnu_form_ts"]');
            var key = form.querySelector('input[name="kmnu_form_key"]');
            var token = form.querySelector('input[name="kmnu_js_token"]');
            if (ts && key && token) {
                token.value = 'kmnu-js-' + key.value + '-' + ts.value;
            }

            form.addEventListener('submit', function () {
                var submitter = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitter) {
                    submitter.disabled = true;
                    submitter.classList.add('is-submitting');
                }
            });
        });

        var hamburger = document.querySelector('.mob-res-hamburger');
        var closeBtn = document.getElementById('mobResClose');
        var overlay = document.getElementById('mobResOverlay');
        var menuContainer = document.getElementById('mobResMenuContainer');

        if (hamburger && closeBtn && overlay && menuContainer) {
            function openMenu() {
                overlay.classList.add('active');
                menuContainer.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeMenu() {
                overlay.classList.remove('active');
                menuContainer.classList.remove('active');
                document.body.style.overflow = '';
            }

            hamburger.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);

            var toggleBtns = document.querySelectorAll('.mob-res-toggle-btn');
            toggleBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var li = this.closest('.mob-res-item');
                    li.classList.toggle('active');

                    toggleBtns.forEach(function (otherBtn) {
                        if (otherBtn !== btn) {
                            otherBtn.closest('.mob-res-item').classList.remove('active');
                        }
                    });
                });
            });
        }
    });
</script>

<?php wp_footer(); ?>
</body>

</html>
