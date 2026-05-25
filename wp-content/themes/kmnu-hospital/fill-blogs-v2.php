<?php
require_once( dirname(__FILE__) . '/../../../wp-load.php' );

$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1]);

$dummy_content = '<h3>Understanding the Importance of Modern Healthcare</h3>
<p>Modern healthcare depends on timely diagnosis, specialist consultation and treatment plans that are tailored to each patient. At KM NU Hospitals, our departments work together so patients can move from evaluation to treatment with confidence.</p>

<blockquote>"Quality healthcare is a basic human right, and we are committed to providing expert medical guidance for every patient."</blockquote>

<h3>Our Specialized Approach to Treatment</h3>
<p>Regular checkups, clear medical advice and access to diagnostics help families identify health concerns early. Our clinical team focuses on evidence-based care, patient safety and practical guidance that supports recovery.</p>

<ul>
    <li><strong>Expert Medical Guidance:</strong> Our doctors share valuable insights and expertise.</li>
    <li><strong>Holistic Care:</strong> We treat the whole person, not just the symptoms.</li>
    <li><strong>State-of-the-Art Facilities:</strong> Access to the latest medical technology.</li>
    <li><strong>Compassionate Support:</strong> A team dedicated to your recovery journey.</li>
</ul>

<p>At KMNU Hospitals, we believe in transparency and patient empowerment. Every procedure is explained in detail, ensuring you and your family can make informed decisions about your health. From advanced trauma surgery to routine appendicectomy, our surgeons maintain the highest standards of safety and care.</p>

<h3>What to Expect During Your Visit</h3>
<p>If you have persistent symptoms or need a second opinion, consult a qualified specialist. Early action can reduce complications and help your doctor recommend the most appropriate next step.</p>';

foreach ($posts as $p) {
    wp_update_post([
        'ID'           => $p->ID,
        'post_content' => $dummy_content
    ]);
    echo "Updated post: " . $p->post_title . "\n";
}

echo "All blogs updated with healthcare content.\n";
