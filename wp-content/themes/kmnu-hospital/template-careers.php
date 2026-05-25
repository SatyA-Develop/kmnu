<?php
/**
 * Template Name: Careers
 */
get_header();
?>

<style>
/* KMNU Transparent Header Setup */
.site-header {
    margin-bottom: -100px;
    background: transparent !important;
    box-shadow: none !important;
    position: relative;
    z-index: 1000;
}

.site-header a,
.site-header i {
    color: #fff !important;
}

/* Page Hero */
.page-hero {
    position: relative;
    padding: 160px 0 100px;
    background: linear-gradient(135deg, rgba(0, 70, 139, 0.95), rgba(0, 180, 216, 0.85)), url('https://images.unsplash.com/photo-1576089112952-b18423f03b53?auto=format&fit=crop&q=80&w=1920');
    background-size: cover;
    background-position: center;
    color: #fff;
    text-align: center;
    overflow: hidden;
}

.page-hero h1 {
    font-size: 56px;
    font-weight: 800;
    margin-bottom: 20px;
    animation: fadeInDown 0.8s ease-out;
}

.page-hero p {
    font-size: 20px;
    max-width: 800px;
    margin: 0 auto;
    opacity: 0.9;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.hero-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

.hero-shape svg {
    width: 100%;
    height: 100px;
}

/* Careers Introduction */
.careers-intro {
    padding: 60px 0;
    background: #f8fafc;
}

.careers-intro .intro-card {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    text-align: center;
}

.careers-intro h2 {
    color: var(--brand-blue);
    margin-bottom: 20px;
}

.careers-intro p {
    color: #555;
    line-height: 1.8;
    margin-bottom: 15px;
    font-size: 16px;
}

/* Split Section */
.careers-split {
    padding: 80px 0 120px;
}

.careers-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

/* Left Form Box */
.career-form-box {
    background: #ffffff;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

.career-form-box h3 {
    color: var(--brand-blue);
    font-size: 28px;
    margin-bottom: 30px;
    border-left: 4px solid var(--brand-orange);
    padding-left: 15px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.form-grid .full-width {
    grid-column: span 2;
}

.careers-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #444;
}

.careers-form input[type="text"],
.careers-form input[type="email"],
.careers-form textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #eef2f6;
    border-radius: 8px;
    background: #fcfcfc;
    transition: 0.3s;
    font-family: inherit;
    box-sizing: border-box;
}

.careers-form input:focus,
.careers-form textarea:focus {
    border-color: var(--brand-blue);
    background: #fff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 70, 139, 0.1);
}

.careers-form .gender-opts {
    display: flex;
    gap: 20px;
    margin-top: 5px;
}

.gender-opts label {
    font-weight: 400;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.custom-file-upload {
    border: 2px dashed #cfd9e5;
    padding: 20px;
    text-align: center;
    border-radius: 12px;
    background: #f8fafc;
    transition: 0.3s;
    cursor: pointer;
    display: block;
}

.custom-file-upload:hover {
    border-color: var(--brand-blue);
    background: #f1f7fe;
}

.careers-form .btn-submit {
    background: var(--brand-blue);
    color: #fff;
    padding: 15px 30px;
    border: none;
    border-radius: 30px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    margin-top: 20px;
    transition: 0.3s;
}

.careers-form .btn-submit:hover {
    background: var(--brand-orange);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

/* Right Jobs Column - Inherits user provided styles naturally but adds local constraints */
.jobs-widget-box {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    overflow: hidden;
    height: auto;
}

/* Custom styling to ensure the pasted #khembedjobs looks decent regardless of missing external CSS */
#khembedjobs {
    max-height: 800px;
    overflow-y: auto;
    padding: 20px;
    background: #fafcff;
}

#khembedjobs::-webkit-scrollbar {
    width: 8px;
}
#khembedjobs::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
#khembedjobs::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.kh-form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.kh-job-card {
    display: block;
    background: #fff;
    border: 1px solid #eef2f6;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    text-decoration: none !important;
    transition: 0.3s;
    color: inherit;
}

.kh-job-card:hover {
    border-color: var(--brand-blue);
    box-shadow: 0 10px 30px rgba(0, 70, 139, 0.1);
    transform: translateY(-2px);
}

.kh-job-title {
    color: var(--brand-blue);
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 700;
}

.kh-dot {
    display: inline-block;
    width: 4px;
    height: 4px;
    background: #888;
    border-radius: 50%;
    margin: 0 10px;
    vertical-align: middle;
}

.kh-text-secondary {
    color: #64748b;
    font-size: 14px;
}

.kh-accordion-item {
    margin-bottom: 10px;
}
.kh-accordion-content {
    padding-left: 10px;
}

/* Success/Error message */
.form-msg {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    text-align: center;
}
.form-msg.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.form-msg.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 991px) {
    .careers-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 767px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-grid .full-width {
        grid-column: 1;
    }
}
</style>

<main class="page-main">
    
    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container hero-inner">
            <h1 class="hero-title">Join KMNU Hospitals</h1>
            <p>Empowering healthcare professionals to deliver world-class care.</p>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Intro Text -->
    <section class="careers-intro">
        <div class="container">
            <div class="intro-card">
                <h2>Careers</h2>
                <p>NU Hospitals is an equal opportunity employer. Our employees are our assets. There is a tremendous opportunity for growth with career assessments wherein employees identify and better articulate their unique interests, knowledge, values and skills. The organization takes pride in providing complete freedom for an individual to open up and explore his career growth, planning, learning strategies and development.</p>
                <p>Our Students have the opportunity to explore much beyond what they learn from classes by the extensive practical classes that are provided to each student. At the end of the course, students leaving us will be completely fit enough to practice with tact and confidence.</p>
            </div>
        </div>
    </section>

    <!-- Form and Jobs Split -->
    <section class="careers-split">
        <div class="container careers-grid">
            
            <!-- Left: Contact Form -->
            <div class="career-form-box" id="careers-form">
                <h3>Resume/Cover Letter Submission</h3>
                
                <?php if (isset($_GET['status'])) : ?>
                    <?php if ($_GET['status'] == 'success') : ?>
                        <div class="form-msg success">Your application has been submitted successfully! Our HR team will contact you soon.</div>
                    <?php elseif ($_GET['status'] == 'error') : ?>
                        <div class="form-msg error">There was an error sending your application. Please try again or ensure your file size is not too large.</div>
                    <?php endif; ?>
                <?php endif; ?>

                <form class="careers-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="submit_kmnu_career">
                    <?php wp_nonce_field('kmnu_career_nonce', 'kmnu_nonce_field'); ?>
                    
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" placeholder="Enter full name" name="fullName" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Your Email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" placeholder="Your Contact Number" name="phone" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label>Gender</label>
                            <div class="gender-opts">
                                <label><input type="radio" name="gender" value="Male" checked> Male</label>
                                <label><input type="radio" name="gender" value="Female"> Female</label>
                                <label><input type="radio" name="gender" value="Other"> Other</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience (In Years)</label>
                            <input type="text" id="experience" placeholder="e.g. 5" name="experience" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="city">Your City</label>
                            <input type="text" id="city" placeholder="Your City" name="city" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label>Upload Resume</label>
                            <label class="custom-file-upload">
                                <input type="file" id="resumeFile" accept=".pdf,.doc,.docx" name="resumeFile" style="display:none;" onchange="updateFileName(this)" required>
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: var(--brand-blue); margin-bottom: 10px;"></i>
                                <br/>
                                <span id="file-name-display">Click to upload (.pdf, .doc, .docx only)</span>
                            </label>
                        </div>

                        <div class="form-group full-width">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="5" placeholder="Your cover letter or message..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Submit Application <i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>

            <!-- Right: Dynamic Careers List (Pulled from WordPress Dashboard) -->
            <div class="jobs-widget-box">
                <style>
                    .dynamic-jobs-header {
                        padding: 20px 25px;
                        background: #f8fafc;
                        border-bottom: 1px solid #eef2f6;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }
                    .dynamic-jobs-header h4 {
                        margin: 0;
                        color: var(--brand-blue);
                        font-weight: 700;
                    }
                    .job-search-wrap input {
                        padding: 10px 15px;
                        border: 1px solid #ddd;
                        border-radius: 20px;
                        outline: none;
                        width: 250px;
                    }
                    #khembedjobs {
                        max-height: 800px;
                        overflow-y: auto;
                        padding: 20px 25px;
                        background: #fafcff;
                    }
                    .kmnu-job-card {
                        display: block;
                        background: #fff;
                        border: 1px solid #eef2f6;
                        padding: 20px;
                        border-radius: 12px;
                        margin-bottom: 15px;
                        text-decoration: none !important;
                        transition: 0.3s;
                        color: inherit;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
                    }
                    .kmnu-job-card:hover {
                        border-color: var(--brand-blue);
                        box-shadow: 0 10px 25px rgba(0, 70, 139, 0.1);
                        transform: translateY(-3px);
                    }
                    .kmnu-job-title {
                        color: var(--brand-blue);
                        margin-bottom: 12px;
                        font-size: 18px;
                        font-weight: 700;
                        margin-top: 0;
                    }
                    .kmnu-job-meta {
                        display: flex;
                        gap: 15px;
                        color: #64748b;
                        font-size: 14px;
                        flex-wrap: wrap;
                    }
                    .kmnu-job-meta span i {
                        margin-right: 6px;
                        color: var(--brand-orange);
                    }
                </style>
                
                <div class="dynamic-jobs-header">
                    <h4>Open Positions</h4>
                    <div class="job-search-wrap">
                        <input type="text" id="job-search-input" placeholder="Search jobs by title..." onkeyup="filterNativeJobs()">
                    </div>
                </div>

                <div id="khembedjobs">
                    <?php
                    $jobs_query = new WP_Query(array(
                        'post_type'      => 'careers',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ));

                    if ($jobs_query->have_posts()) :
                        while ($jobs_query->have_posts()) : $jobs_query->the_post();
                            $loc          = get_post_meta(get_the_ID(), 'career_locations', true);
                            $exp          = get_post_meta(get_the_ID(), 'career_experience', true);
                            $type         = get_post_meta(get_the_ID(), 'career_job_type', true);
                            $details_link = get_post_meta(get_the_ID(), 'career_details_link', true);

                            // Compute days ago
                            $post_date    = get_the_date('U');
                            $now          = current_time('timestamp');
                            $days_ago     = floor(($now - $post_date) / DAY_IN_SECONDS);
                            $days_label   = $days_ago === 0 ? 'Today' : ($days_ago === 1 ? '1 day ago' : $days_ago . ' days ago');

                            // Use external link if set, otherwise fallback to permalink
                            $card_href    = !empty($details_link) ? $details_link : get_permalink();
                            $target       = !empty($details_link) ? ' target="_blank" rel="noopener noreferrer"' : '';
                            ?>
                            <a href="<?php echo esc_url($card_href); ?>"<?php echo $target; ?> class="kmnu-job-card">
                                <div class="kh-card-body">
                                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:8px; margin-bottom:10px;">
                                        <h4 class="kmnu-job-title" style="margin:0;"><?php the_title(); ?></h4>
                                        <small style="color:#94a3b8; white-space:nowrap; font-size:13px;">
                                            <i class="fa-regular fa-clock" style="margin-right:4px;"></i><?php echo esc_html($days_label); ?>
                                        </small>
                                    </div>
                                    <div class="kmnu-job-meta">
                                        <?php if($loc): ?><span><i class="fa-solid fa-location-dot"></i> <?php echo esc_html($loc); ?></span><?php endif; ?>
                                        <?php if($exp): ?><span><i class="fa-solid fa-briefcase"></i> <?php echo esc_html($exp); ?></span><?php endif; ?>
                                        <?php if($type): ?><span><i class="fa-solid fa-clock"></i> <?php echo esc_html($type); ?></span><?php endif; ?>
                                    </div>
                                    <div style="margin-top:14px; text-align:right;">
                                        <span style="color:var(--brand-blue); font-weight:700; font-size:13px;">View Details <i class="fa-solid fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        ?>
                        <div style="text-align: center; padding: 40px 20px;">
                            <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #cbd5e1; margin-bottom: 15px;"></i>
                            <p style="color: #64748b;">No open positions at the moment. Please check back later!</p>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </section>

</main>

<script>
// Logic to update File Name on selector
function updateFileName(input) {
    const display = document.getElementById('file-name-display');
    if (input.files && input.files.length > 0) {
        display.textContent = input.files[0].name;
        display.style.color = '#00468b';
        display.style.fontWeight = 'bold';
    } else {
        display.textContent = 'Click to upload (.pdf, .doc, .docx only)';
        display.style.color = 'inherit';
        display.style.fontWeight = 'normal';
    }
}

// Logic to filter natively fetched jobs
function filterNativeJobs() {
    const searchVal = document.getElementById('job-search-input').value.toLowerCase();
    const jobCards = document.querySelectorAll('.kmnu-job-card');
    
    jobCards.forEach(card => {
        const titleEl = card.querySelector('.kmnu-job-title');
        if (titleEl) {
            const title = titleEl.textContent.toLowerCase();
            if (title.includes(searchVal)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });
}
</script>

<?php get_footer(); ?>
