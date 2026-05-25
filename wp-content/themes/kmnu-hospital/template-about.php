<?php
/**
 * Template Name: About Us Template
 */
get_header();
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

.site-header a,
.site-header i {
    color: #fff !important;
}

.about-hero {
    padding-top: 180px !important;
}
</style>

<main id="primary" class="site-main about-page">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container relative">
            <div class="hero-flex">
                <div class="about-hero-content">
                    <span class="sub-title">Know More About Us</span>
                    <h1>Compassionate Care, <br><span>Comprehensive Expertise.</span></h1>
                    <p>At KMNU Hospital, we are dedicated to providing world-class healthcare with a human touch. Our mission is to enhance the health and well-being of our community through excellence in clinical care, education, and research.</p>
                    <div class="hero-cta">
                        <a href="#mission-vision" class="btn btn-primary">Our Mission</a>
                        <a href="/contact-us" class="btn btn-outline">Connect With Us</a>
                    </div>
                </div>
                <div class="about-hero-image">
                    <div class="image-wrapper">
                        <img src="https://images.pexels.com/photos/3844581/pexels-photo-3844581.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="KMNU Medical Team">
                        <div class="stat-card">
                            <div class="stat-number">20+</div>
                            <div class="stat-text">Years of Excellence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Vision & Philosophy Section -->
    <section id="mission-vision" class="about-philosophy section-padding">
        <div class="container">
            <div class="philosophy-header text-center">
                <span class="sub-title">Our Foundations</span>
                <h2>Our Mission & <span>Vision</span></h2>
                <div class="header-line"></div>
            </div>

            <div class="vision-grid">
                <div class="vision-content">
                    <div class="vision-box card-shadow">
                        <div class="icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#0065a5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                        <h3>Our Vision</h3>
                        <p>Our Vision is to deliver comprehensive medical services, which showcase the highest standards of both care and medical excellence, sufficiently innovative to be appropriate to our society.</p>
                        <p>There shall be an atmosphere of continuous learning and research, conscious of the rights and dignity of our patients.</p>
                        <p>We will also give our employees and consultants, unfettered opportunity to develop professionally, and our shareholders, good returns on investment.</p>
                    </div>
                </div>
                <div class="philosophy-image">
                    <div class="img-frame">
                        <img src="https://images.pexels.com/photos/4021775/pexels-photo-4021775.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Modern Medical Facility">
                        <div class="experience-block">
                            <h4>Modern & Reliable</h4>
                            <span>Healthcare Solutions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section id="core-values" class="core-values section-padding bg-light">
        <div class="container">
            <div class="values-header text-center">
                <h2>Strategic <span>Objectives</span></h2>
                <p>We will achieve this by working to implement practices and processes that are standard and constantly monitored.</p>
            </div>

            <div class="objectives-grid">
                <div class="objective-item">
                    <div class="obj-icon">01</div>
                    <p>Implementing practices and processes that are standard, measurable in quality and constantly monitored.</p>
                </div>
                <div class="objective-item">
                    <div class="obj-icon">02</div>
                    <p>Ensuring that our facilities and services exceed the standards of our healthcare regulators.</p>
                </div>
                <div class="objective-item">
                    <div class="obj-icon">03</div>
                    <p>Promoting effective communication for a seamless and enhanced teamwork.</p>
                </div>
                <div class="objective-item">
                    <div class="obj-icon">04</div>
                    <p>Establishing successful partnerships with integrity and transparency.</p>
                </div>
            </div>

            <div class="values-visual">
                <h3>Our Core Values</h3>
                <div class="values-wheel">
                    <div class="value-node main-node">
                        <span>Core Values</span>
                    </div>
                    <div class="value-node node-1" title="Compassion">
                        <span class="v-icon">❤️</span>
                        <span class="v-label">Compassion</span>
                    </div>
                    <div class="value-node node-2" title="Integrity">
                        <span class="v-icon">⚖️</span>
                        <span class="v-label">Integrity</span>
                    </div>
                    <div class="value-node node-3" title="Professionalism">
                        <span class="v-icon">👨‍⚕️</span>
                        <span class="v-label">Professionalism</span>
                    </div>
                    <div class="value-node node-4" title="Team Work">
                        <span class="v-icon">🤝</span>
                        <span class="v-label">Team Work</span>
                    </div>
                    <div class="value-node node-5" title="Social Responsibility">
                        <span class="v-icon">🌍</span>
                        <span class="v-label">Social Responsibility</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section id="leadership" class="leadership-section section-padding">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title">The People Behind KMNU</span>
                <h2>Our <span>Leadership</span></h2>
                <div class="header-line"></div>
            </div>

            <div class="leadership-grid">
                <!-- Leader 1 -->
                <div class="leader-card">
                    <div class="leader-image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/DrVenkateshKrishnamoorthy-1-1.png" alt="Dr. Venkatesh Krishnamoorthy">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. Venkatesh Krishnamoorthy</h3>
                        <span class="designation">Chairman and Founder</span>
                        <div class="leader-bio">
                            <p>Dr. Venkatesh Krishnamoorthy has over 27 years of experience in the field of Urology. He has received many awards including the prestigious Dr. B.C Roy Award. He is very passionate about patient care and delivery systems.</p>
                        </div>
                    </div>
                </div>

                <!-- Leader 2 -->
                <div class="leader-card">
                    <div class="leader-image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/DrPrasannaVenkatesh-1-1.png" alt="Dr. Prasanna Venkatesh M. K.">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. Prasanna Venkatesh M. K.</h3>
                        <span class="designation">Managing Director & Sr. Urology Consultant</span>
                        <div class="leader-bio">
                            <p>Specialized in Pediatric Urology with over 13 years of experience. He has completed stints at Cleveland Clinic & Boston Children’s Hospital. His passion is high-quality Nephro Uro care at an affordable cost.</p>
                        </div>
                    </div>
                </div>

                <!-- Leader 3 -->
                <div class="leader-card">
                    <div class="leader-image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/ramachandra-1.jpg" alt="Mr. Ramachandra M">
                    </div>
                    <div class="leader-info">
                        <h3>Mr. Ramachandra M</h3>
                        <span class="designation">Member of the Board of Directors</span>
                        <div class="leader-bio">
                            <p>MD & CEO of Scrips N Scrolls India and Co-Founder of Cloud Nine. He brings vast experience in property development and infrastructure to catalyze KM NU Hospitals' growth.</p>
                        </div>
                    </div>
                </div>

                <!-- Leader 4 -->
                <div class="leader-card">
                    <div class="leader-image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/Kanthiarajj.jpg" alt="Dr. Kanthiraj M. R.">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. Kanthiraj M. R.</h3>
                        <span class="designation">Member of the Board of Directors</span>
                        <div class="leader-bio">
                            <p>A valued member of the Board of Directors, contributing to the strategic vision and medical excellence of the hospital.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy & About Section -->
    <section id="philosophy" class="hospital-philosophy section-padding">
        <div class="container">
            <div class="grid-wrap">
                <div class="philosophy-card card-shadow">
                    <h2>Our <span>Philosophy</span></h2>
                    <div class="philosophy-content">
                        <h3>About KM NU Hospitals</h3>
                        <p>KM NU Hospitals – a Multi-speciality services with 60 bedded facility, with State of the Art at Solur has brought the future of healthcare with most cutting-edge services to Ambur citizens in Tamil Nadu by making a difference in Healthcare with advanced medicine and compassionate care for rural population.</p>
                        <p>We provide a Multi-speciality services such as Emergency Medicine, Internal Medicines, Obstetrics & Gynaecology, Fertility, Orthopaedics & Joint Replacement, Anaesthesiology, General Surgery, Cardiology, ENT, Andrology, Nephrology, Urology, Intensive Care Unit (ICU), Neonatal Intensive Care Unit (NICU) and Radiology Services.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Milestones Section -->
    <section id="milestones" class="milestones-section section-padding bg-light">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title">Our Journey</span>
                <h2>Key <span>Milestones</span></h2>
                <div class="header-line"></div>
                <p>A timeline of our commitment to excellence in healthcare.</p>
            </div>

            <div class="timeline-container">
                <div class="timeline">
                    <!-- 2025 -->
                    <div class="timeline-item left">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2025</div>
                            <h3>Second NABL MELT Accreditation</h3>
                        </div>
                    </div>
                    
                    <!-- 2024 -->
                    <div class="timeline-item right">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2024</div>
                            <h3>1st Total Hip Replacement (THR)</h3>
                            <p>KM NU Hospitals successfully performed the 1st Total Hip Replacement (THR) in Tirupattur District.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item left">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2024</div>
                            <h3>500th Delivery of babies</h3>
                        </div>
                    </div>

                    <!-- 2023 -->
                    <div class="timeline-item right">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2023</div>
                            <h3>NK 48 Scheme Empanelment Inauguration</h3>
                        </div>
                    </div>
                    
                    <div class="timeline-item left">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2023</div>
                            <h3>Second NABH Re-accreditation</h3>
                        </div>
                    </div>

                    <!-- 2021 -->
                    <div class="timeline-item right">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2021</div>
                            <h3>First NABL MELT Accreditation</h3>
                        </div>
                    </div>
                    
                    <div class="timeline-item left">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2021</div>
                            <h3>First NABH Entry Level Accreditation</h3>
                        </div>
                    </div>

                    <!-- 2020 -->
                    <div class="timeline-item right">
                        <div class="timeline-content card-shadow">
                            <div class="timeline-date">2020</div>
                            <h3>Blood Storage Inauguration</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Accreditations Section -->
    <section id="accreditations" class="accreditations-section section-padding">
        <div class="container">
            <div class="accreditation-header">
                <h2>Our <span>Accreditations</span></h2>
                <div class="header-line" style="margin-left: 0;"></div>
            </div>

            <div class="accreditations-list">
                <!-- NABL Accreditation -->
                <div class="accreditation-card card-shadow">
                    <div class="acc-logo">
                        <!-- Placeholder for NABL Logo, user can replace with actual image using img src -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4d4d4d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span style="display:block; font-size:12px; font-weight:800; margin-top:5px; color:#4d4d4d;">NABL MELT</span>
                    </div>
                    <div class="acc-content">
                        <p>KM NU Hospitals, Ambur laboratory is recognised by NABL under its quality assurance program - NABL Medical Entry Level Testing (MELT) Labs Program. Both the hospitals follow stringent quality procedures to ensure accurate, precise and timely reports to patients.</p>
                    </div>
                </div>

                <!-- NABH Accreditation -->
                <div class="accreditation-card card-shadow">
                    <div class="acc-logo">
                        <!-- Placeholder for NABH Logo -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#228b22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 22h20L12 2z"></path><path d="M12 18h.01"></path><path d="M12 9v6"></path></svg>
                        <span style="display:block; font-size:12px; font-weight:800; margin-top:5px; color:#228b22;">NABH CERTIFIED</span>
                    </div>
                    <div class="acc-content">
                        <p>KM NU Hospitals, Ambur laboratory is recognised by NABH Entry Level, which ensures high quality of care and patient safety,both hospitals provide quality culture at all levels and across all the functions of the organizations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="facilities-section section-padding">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title">State-of-the-Art Care</span>
                <h2>Our <span>Facilities</span></h2>
                <div class="header-line"></div>
                <p>Comprehensive infrastructure equipped with advanced medical technology.</p>
            </div>

            <div class="facilities-grid">
                <!-- Facility 1 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                    </div>
                    <h3>Dialysis Services</h3>
                </div>
                <!-- Facility 2 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </div>
                    <h3>Operation Theatre</h3>
                </div>
                <!-- Facility 3 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"></path><path d="M14 9.3V1.99"></path><path d="M8.5 2h7"></path><path d="M14 9.3a6.5 6.5 0 1 1-4 0"></path><path d="M5.52 16h12.96"></path></svg>
                    </div>
                    <h3>Laboratory Services</h3>
                </div>
                <!-- Facility 4 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                    </div>
                    <h3>Nursing Care</h3>
                </div>
                <!-- Facility 5 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3>Urodynamics</h3>
                </div>
                <!-- Facility 6 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 2v6h13V2z"></path><path d="M2.5 16v6h13v-6z"></path><path d="M15.5 5H21v14h-5.5"></path></svg>
                    </div>
                    <h3>Wards</h3>
                </div>
                <!-- Facility 7 -->
                <div class="facility-card card-shadow">
                    <div class="fac-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    </div>
                    <h3>ICU</h3>
                </div>
            </div>

            <!-- Detailed Dialysis Content -->
            <div class="facilities-detail mt-5">
                <div class="detail-box card-shadow">
                    <h3>Focus on: <span>Dialysis</span></h3>
                    <p>When an end-stage renal failure occurs (that is, when the kidney function is irreversibly reduced to below 15% of normal), there are two treatment options: dialysis or a kidney transplant (also known as a renal transplant).</p>
                    
                    <p><strong>There are two types of dialysis:</strong></p>
                    <ul>
                        <li>Haemodialysis.</li>
                        <li>Peritoneal dialysis.</li>
                    </ul>
                    <p>The word ‘haemo’ refers to blood. Haemodialysis is a process that balances blood chemistry and filters waste and fluid from the blood.</p>

                    <h4 class="mt-4">Haemodialysis Process</h4>
                    <p>For Haemodialysis, two needles are inserted into the patient’s arm. One needle withdraws the blood and the other returns the filtered blood to the patient’s body.</p>
                    <p>The blood, which is withdrawn by the first needle, travels outside the body through the tubing and the dialysis machine then pumps this blood through a filter called a dialyzer, which is attached to the dialysis machine. The dialyzer cleans the blood and it is returned to the patient’s body through the other needle.</p>
                    <p>The dialyzer is also called an artificial kidney because it is an artificial replacement for the patient’s damaged kidneys. During the process of haemodialysis, the haemodialysis machine circulates the dialysate (fluid with chemicals that helps to remove wastes from the body) to the artificial kidney. Haemodialysis is typically performed at a dialysis center.</p>

                    <h4 class="mt-4">Dialysis Equipment & Quality</h4>
                    <p>Haemodialysis is performed at KM NU Hospitals with sophisticated equipment (volumetric, bicarbonate machines). We have 14 state-of-the-art machines [13 of them in the Haemodialysis unit and 1 in the intensive care unit (ICU)]. A state-of-the-art reverse osmosis plant purifies the water used for haemodialysis. Periodic cultures of the reverse osmosis water are performed to ensure good quality of water.</p>

                    <h4 class="mt-4">Dialysis Centre Statistics & Standards</h4>
                    <p>We perform around 13,000 to 14,000 dialysis per year.</p>
                    <div class="statistics-list">
                        <ul>
                            <li>State-of-the-art Fresenius Haemodialysis.</li>
                            <li>Single-use dialyzer and tubing for every patient. This helps to minimize and prevent infections. We do not reuse the dialyzer.</li>
                            <li>Special dialysis couches at each individual station.</li>
                            <li>Advanced dialysis includes high flux hemodialysis & online Hemodiafiltration which helps in removal of waste products from the blood contributing to improved survival in patients.</li>
                            <li>Individual tablets provided for entertainment.</li>
                            <li>Daily monitoring and audit of patients and machines.</li>
                            <li>Personal & Individual attention from senior doctors.</li>
                            <li>Specialized training & practice for the dialysis team member to carry out cannulations in OT and on mannequins.</li>
                            <li>Hand hygiene surveillance monitored by CCTV and standardized active infection control practices.</li>
                            <li>Strict adherence to medical protocol and hospital best practices.</li>
                            <li>Dedicated machines and space for HBsAg and HCV positive patients.</li>
                            <li>Specialized Plex RO (Reverse Osmosis) pipeline imported from Germany.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <?php
    $kmnu_team_members = array(
        array('name' => 'Dr Prasanna Venkatesh M K', 'designation' => 'Managing Director & Sr. Consultant Urologist', 'assistant' => array('name' => 'Mr. Gokul S Patil', 'designation' => 'Executive Assistant', 'email' => 'gokul@nuhospitals.com'), 'group' => 'leadership'),
        array('name' => 'Dr Dilip Rangarajan', 'designation' => 'Group Medical Director & Sr. Consultant Nephrologist', 'email' => 'dr.dilip@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Mr. Radha Madhav Potharaju', 'designation' => 'Chief Finance Officer', 'email' => 'radha.madhav@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Mr. Narayanamurthy V', 'designation' => 'Chief Administration Officer & Grievance Officer', 'email' => 'narayanamurthy@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Ms. Sahana Pai', 'designation' => 'Chief People Officer', 'email' => 'sahana.pai@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Mr. Abdul Wajid', 'designation' => 'Chief Procurement Officer', 'email' => 'wajid@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Mr. Ashok R', 'designation' => 'Chief Marketing Officer', 'email' => 'ashok@nuhospitals.com', 'group' => 'leadership'),
        array('name' => 'Ms. Avith Sahana Paul', 'designation' => 'Cluster Head - Growth & Strategy - NU Hospitals, Padmanabhangar and KM NU Hospitals, Ambur', 'email' => 'sahana@nuhospitals.com', 'group' => 'operations'),
        array('name' => 'Mr. Mahammad Rafi', 'designation' => 'Cluster Head - Growth & Strategy - NU Hospitals, Rajajinagar and NU Hospitals, Shivamogga', 'email' => 'rafi@nuhospitals.com', 'group' => 'operations'),
        array('name' => 'Ms. Anurupa S', 'designation' => 'Unit Head - NU Hospitals, Padmanabhanagar', 'email' => 'anurupa@nuhospitals.com', 'group' => 'operations'),
        array('name' => 'Mr. Robin Immanuel Jathanna', 'designation' => 'Unit Head - NU Hospitals, Shivamogga', 'email' => 'robin@nuhospitals.com', 'group' => 'operations'),
        array('name' => 'Mr. Sreejith J', 'designation' => 'Unit Head - NU Hospitals, Mission Road', 'email' => 'sreejith@nuhospitals.com', 'group' => 'operations'),
        array('name' => 'Mr. Chokkalingam S', 'designation' => 'Manager - Operations & Administration, KM NU Hospitals, Ambur', 'email' => 'chokkalingam@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Ms. Asma Banu', 'designation' => 'Manager - Compliances & Administration', 'email' => 'admin@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Mr. Srujith S', 'designation' => 'Manager - Admin & Ops - NU Hospitals, Male, Maldives', 'email' => 'igmh@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Ms. Bhargavi V A', 'designation' => 'Manager - Nursing (Quality & Training) & Urodynamics', 'email' => 'bhargavi@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Ms. Pavithra S', 'designation' => 'Manager - Quality', 'email' => 'qc@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Mr. Sanjeeth Mohan', 'designation' => 'Manager - Digital Marketing', 'email' => 'digital@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Ms. Sharada P S', 'designation' => 'Manager - Customer Relationship Management', 'email' => 'coordinator@nuhospitals.com', 'group' => 'managers'),
        array('name' => 'Mr. Kartikeya C Sarangamath', 'designation' => 'Manager - ESG', 'email' => 'kartikeya@nuhospitals.com', 'group' => 'managers'),
    );
    ?>
    <section id="our-team" class="our-team-section section-padding bg-light">
        <div class="container">
            <div class="section-title text-center">
                <span class="sub-title">Dedicated Professionals</span>
                <h2>Our <span>Team</span></h2>
                <div class="header-line"></div>
                <p>Meet the leadership, operations and management team guiding NU Hospitals and KM NU Hospitals.</p>
            </div>

            <div class="team-tools" aria-label="Team search and filters">
                <label class="team-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" id="teamSearch" placeholder="Search by name, role or email" autocomplete="off">
                </label>
                <div class="team-filters" role="group" aria-label="Filter team members">
                    <button type="button" class="team-filter active" data-filter="all">All</button>
                    <button type="button" class="team-filter" data-filter="leadership">Leadership</button>
                    <button type="button" class="team-filter" data-filter="operations">Operations</button>
                    <button type="button" class="team-filter" data-filter="managers">Managers</button>
                </div>
            </div>

            <div class="team-grid" id="teamGrid">
                <?php foreach ($kmnu_team_members as $member) :
                    $search_text = strtolower($member['name'] . ' ' . $member['designation'] . ' ' . ($member['email'] ?? '') . ' ' . ($member['assistant']['name'] ?? '') . ' ' . ($member['assistant']['email'] ?? ''));
                    $initials = '';
                    foreach (preg_split('/\s+/', preg_replace('/^(Dr|Mr|Ms|Mrs)\.?\s+/i', '', $member['name'])) as $part) {
                        if ($part !== '') {
                            $initials .= strtoupper(substr($part, 0, 1));
                        }
                        if (strlen($initials) >= 2) {
                            break;
                        }
                    }
                ?>
                    <article class="team-card card-shadow" data-group="<?php echo esc_attr($member['group']); ?>" data-search="<?php echo esc_attr($search_text); ?>">
                        <div class="team-card-top">
                            <div class="team-avatar" aria-hidden="true"><?php echo esc_html($initials); ?></div>
                            <span class="team-chip"><?php echo esc_html(ucfirst($member['group'])); ?></span>
                        </div>
                        <h3><?php echo esc_html($member['name']); ?></h3>
                        <span class="team-designation"><?php echo esc_html($member['designation']); ?></span>
                        <?php if (!empty($member['email'])) : ?>
                            <a href="mailto:<?php echo esc_attr($member['email']); ?>" class="team-email"><i class="fa-solid fa-envelope"></i><?php echo esc_html($member['email']); ?></a>
                        <?php endif; ?>
                        <?php if (!empty($member['assistant'])) : ?>
                            <div class="team-assistant">
                                <span class="assistant-label">Assistant</span>
                                <strong><?php echo esc_html($member['assistant']['name']); ?></strong>
                                <span><?php echo esc_html($member['assistant']['designation']); ?></span>
                                <a href="mailto:<?php echo esc_attr($member['assistant']['email']); ?>"><?php echo esc_html($member['assistant']['email']); ?></a>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="team-empty" id="teamEmpty" hidden>
                <i class="fa-solid fa-user-magnifying-glass"></i>
                <p>No team members match your search.</p>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const teamSearch = document.getElementById('teamSearch');
        const teamCards = Array.from(document.querySelectorAll('#teamGrid .team-card'));
        const filterButtons = Array.from(document.querySelectorAll('.team-filter'));
        const emptyState = document.getElementById('teamEmpty');
        let activeFilter = 'all';

        function updateTeamCards() {
            const term = teamSearch ? teamSearch.value.trim().toLowerCase() : '';
            let visibleCount = 0;

            teamCards.forEach(function (card) {
                const matchesFilter = activeFilter === 'all' || card.dataset.group === activeFilter;
                const matchesSearch = !term || card.dataset.search.includes(term);
                const shouldShow = matchesFilter && matchesSearch;
                card.hidden = !shouldShow;
                if (shouldShow) {
                    visibleCount++;
                }
            });

            if (emptyState) {
                emptyState.hidden = visibleCount !== 0;
            }
        }

        if (teamSearch) {
            teamSearch.addEventListener('input', updateTeamCards);
        }

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                activeFilter = button.dataset.filter || 'all';
                filterButtons.forEach(function (btn) {
                    btn.classList.toggle('active', btn === button);
                });
                updateTeamCards();
            });
        });
    });
    </script>

    <!-- Organizational Structure Section -->
    <section id="structure" class="structure-section section-padding">
        <div class="container">
            <div class="structure-grid">
                <!-- Org Structure 1 -->
                <div class="structure-wrap">
                    <div class="section-title">
                        <h2>Organizational <span>Structure</span></h2>
                        <div class="header-line" style="margin-left: 0;"></div>
                    </div>
                    <div class="structure-image card-shadow">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/Organogram.jpg" alt="NU Hospitals Organizational Structure">
                    </div>
                </div>

                <!-- Org Structure 2 -->
                <div class="structure-wrap">
                    <div class="section-title">
                        <h2>Medical <span>Organizational Structure</span></h2>
                        <div class="header-line" style="margin-left: 0;"></div>
                    </div>
                    <div class="structure-image card-shadow">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2026/04/Medical.png" alt="KM NU Hospitals Medical Organizational Structure">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="about-content-section section-padding">        <div class="container">
            <div class="grid-wrap">
                <div class="content-left">
                     <?php
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                     ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
