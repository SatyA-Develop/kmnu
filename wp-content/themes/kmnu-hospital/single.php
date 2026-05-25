<?php
get_header();

// Start the Loop.
while ( have_posts() ) : the_post();
?>

<!-- Blog Header/Hero -->
<?php
$post_meta = '<span class="blog-cat-badge">' . get_the_category_list(', ') . '</span>';
$post_meta .= '<span class="blog-date-line"> | ' . esc_html(get_the_date('F d, Y')) . '</span>';
kmnu_page_banner(array(
    'class' => 'blog-detail-hero',
    'title' => get_the_title(),
    'meta' => $post_meta,
    'wave_fill' => '#ffffff',
));
?>

<div class="blog-main-layout container">
    <div class="blog-post-column">
        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="blog-featured-media">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <article class="blog-entry-content">
            <?php the_content(); ?>
            
            <!-- Fallback content for posts that are still being prepared -->
            <?php 
            $clean_content = trim(wp_strip_all_tags(preg_replace('/<!--\[if[^\]]*]>.*?<!\[endif\]-->/is', '', get_the_content())));
            if ( empty( $clean_content ) ) : ?>

                <p>Our care team is preparing detailed information for this article. For immediate medical guidance, please book an appointment with a KM NU Hospitals specialist.</p>
                <h3>Why timely medical guidance matters</h3>
                <p>Early evaluation helps identify concerns sooner, choose the right treatment plan and avoid unnecessary delays in care.</p>
                <ul>
                    <li>Specialist-led medical guidance</li>
                    <li>Patient-centred evaluation and treatment planning</li>
                    <li>Modern diagnostics and clinical support</li>
                </ul>
                <p>KM NU Hospitals combines experienced doctors, coordinated departments and compassionate support to help patients make informed healthcare decisions.</p>
            <?php endif; ?>
        </article>

        <!-- Social Share / Navigation -->
        <?php
            $share_url = urlencode(get_permalink());
            $share_title = urlencode(get_the_title());
        ?>
        <div class="blog-bottom-action">
            <div class="share-title">Share this post:</div>
            <div class="share-icons">
                <a rel="nofollow" target="_blank" href="https://www.facebook.com/share.php?u=<?php echo $share_url; ?>" title="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a rel="nofollow" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_url; ?>" title="Share on Twitter"><i class="fa-brands fa-twitter"></i></a>
                <a rel="nofollow" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" title="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <aside class="blog-sidebar">
        <!-- Search Box -->
        <div class="sidebar-widget widget-search">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                <input type="text" name="s" placeholder="Search the Blog..." required>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <!-- Recent Posts -->
        <div class="sidebar-widget widget-recent">
            <h3 class="widget-title">Recent Posts</h3>
            <div class="recent-posts-list">
                <?php
                $recent = new WP_Query(['post_type'=>'post', 'posts_per_page'=>4, 'post__not_in'=>[get_the_ID()]]);
                if($recent->have_posts()):
                    while($recent->have_posts()): $recent->the_post();
                        ?>
                        <div class="recent-post-item" onclick="window.location.href='<?php the_permalink(); ?>'">
                            <div class="rp-thumb">
                                <?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail'); else: ?>
                                    <div class="rp-thumb-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="rp-info">
                                <h5><?php the_title(); ?></h5>
                                <span class="rp-date"><?php echo get_the_date('M d, Y'); ?></span>
                            </div>
                        </div>
                        <?php
                    endwhile; wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <!-- Categories -->
        <div class="sidebar-widget widget-categories">
            <h3 class="widget-title">Categories</h3>
            <ul>
                <?php wp_list_categories(['title_li'=>'']); ?>
            </ul>
        </div>

        <!-- Expert Advice CTA -->
        <div class="sidebar-widget widget-cta">
            <div class="cta-sidebar-box">
                <h4>Need Expert <br> Medical Advice?</h4>
                <p>Consult with our top specialists today.</p>
                <a href="<?php echo esc_url(home_url('/book-appointment/')); ?>" class="btn-sidebar-cta">Book Now <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </aside>
</div>

<?php
endwhile;
get_footer();
?>
