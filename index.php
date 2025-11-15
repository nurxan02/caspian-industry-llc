<?php require_once 'includes/header.php'; ?>

<!-- Hero Section - GitHub Style -->
<section class="hero section" id="hero-section">
    <div class="hero-background" id="vanta-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-br">
                    <br>
                </span>
                <h1 class="hero-title"><?php echo t('home_hero_title','Building the future of <span class="gradient-text">industrial excellence</span>'); ?></h1>
                <p class="hero-subtitle"><?php echo t('home_hero_subtitle','Leading provider of comprehensive industrial solutions, combining cutting-edge technology with decades of expertise to deliver exceptional results worldwide.'); ?></p>
                
                <div class="hero-buttons">
                    <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket"></i>
                        <?php echo t('home_cta_projects','Our Projects'); ?>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/pages/contact.php" class="btn btn-outline btn-lg">
                        <i class="fas fa-phone"></i>
                        <?php echo t('home_cta_contact','Contact Sales'); ?>
                    </a>
                </div>
                
                <!-- Stats with Glow Effect -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-value glow-text">15+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value glow-text">500+</div>
                        <div class="stat-label">Projects Delivered</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value glow-text">200+</div>
                        <div class="stat-label">Global <br> Clients</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-gradient-overlay"></div>
</section>

<!-- Features Section - GitHub Style -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
                <span class="section-tag">
                    <span class="glow-dot"></span>
                    <?php echo t('home_why_tag','Why Choose Us'); ?>
                </span>
                <h2 class="section-title"><?php echo t('home_why_title','Built for <span class="gradient-text">industrial leaders</span>'); ?></h2>
                <p class="section-description"><?php echo t('home_why_desc','Comprehensive solutions backed by decades of experience and cutting-edge technology'); ?></p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_quality_title','Quality & Safety First'); ?></h3>
                <p class="feature-description"><?php echo t('feature_quality_desc','ISO certified processes ensuring the highest standards in every project we deliver'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_tech_title','Advanced Technology'); ?></h3>
                <p class="feature-description"><?php echo t('feature_tech_desc','Cutting-edge solutions leveraging the latest innovations in industrial automation'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_global_title','Global Network'); ?></h3>
                <p class="feature-description"><?php echo t('feature_global_desc','Worldwide presence with local expertise serving clients across multiple continents'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_fast_title','Fast Deployment'); ?></h3>
                <p class="feature-description"><?php echo t('feature_fast_desc','Rapid implementation with minimal downtime ensuring quick ROI for your business'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_support_title','24/7 Support'); ?></h3>
                <p class="feature-description"><?php echo t('feature_support_desc','Round-the-clock technical support keeping your operations running smoothly'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title"><?php echo t('feature_results_title','Proven Results'); ?></h3>
                <p class="feature-description"><?php echo t('feature_results_desc','Track record of successful projects delivering measurable business outcomes'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section - Modern Azerbaijan Style -->
<section class="section about-section-modern">
    <div class="container">
        <div class="about-wrapper">
            <div class="about-left">
                <div class="about-content-modern">
                    <div class="about-title-stack">
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line1','We, Azerbaijan'); ?></span>
                        </div>
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line2','ensure the sustainable'); ?></span>
                        </div>
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line3','development of the economy'); ?></span>
                        </div>
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line4','through innovative solutions'); ?></span>
                        </div>
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line5','and high-quality'); ?></span>
                        </div>
                        <div class="title-line title-desktop">
                            <span class="title-highlight"><?php echo t('home_about_line6','services'); ?></span>
                        </div>
                        
                        <div class="title-line title-mobile">
                            <span class="title-highlight"><?php echo t('home_about_mline1','We, Azerbaijan\'s economy'); ?></span>
                        </div>
                        <div class="title-line title-mobile">
                            <span class="title-highlight"><?php echo t('home_about_mline2','aim for sustainable development'); ?></span>
                        </div>
                        <div class="title-line title-mobile">
                            <span class="title-highlight"><?php echo t('home_about_mline3','with innovative solutions and'); ?></span>
                        </div>
                        <div class="title-line title-mobile">
                            <span class="title-highlight"><?php echo t('home_about_mline4','high‑quality services'); ?></span>
                        </div>
                        <div class="title-line title-mobile">
                            <span class="title-highlight"><?php echo t('home_about_mline5','we deliver.'); ?></span>
                        </div>
                    </div>
                    
                    <p class="about-desc-modern">
                        <?php echo t('home_about_paragraph','The world‑renowned manufacturers we partner with confirm the high quality and efficiency of Caspian Industry\'s supply chain. Our clients include many reputable companies operating regionally and internationally.'); ?>
                    </p>
                    
                    <a href="<?php echo BASE_URL; ?>/pages/about.php" class="btn-modern">
                        <?php echo t('home_about_button','Learn More'); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="about-right">
                <div class="about-visual-card">
                    <div class="visual-image-wrapper">
                        <img src="<?php echo BASE_URL; ?>/assets/images/1.jpeg" alt="Caspian Industry Warehouse" class="visual-image">
                        <div class="image-overlay"></div>
                    </div>
                    
                    <div class="stats-card-modern">
                        <div class="stats-header">
                            <div class="stats-number">169</div>
                            <div class="stats-title"><?php echo t('home_stats_title','Satisfied customers'); ?></div>
                        </div>
                        
                        <p class="stats-description">
                            <?php echo t('home_stats_desc','Customer satisfaction is our priority. With high‑quality services and products, we have earned the trust of our clients. Their feedback is valuable to us.'); ?>
                        </p>
                        
                        <ul class="features-list-modern">
                            <li>
                                <div class="feature-icon-check">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span><?php echo t('home_stats_item1','Products meeting international standards'); ?></span>
                            </li>
                            <li>
                                <div class="feature-icon-check">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span><?php echo t('home_stats_item2','Reliable business partner'); ?></span>
                            </li>
                            <li>
                                <div class="feature-icon-check">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span><?php echo t('home_stats_item3','Professional team'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section - GitHub Style -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header text-center">
                <span class="section-tag"><span class="glow-dot"></span><?php echo t('home_news_tag','Latest Updates'); ?></span>
                <h2 class="section-title"><?php echo t('home_news_title','Stay informed with our <span class="gradient-text">latest news</span>'); ?></h2>
                <p class="section-description"><?php echo t('home_news_desc','Industry insights, company updates, and project announcements'); ?></p>
        </div>
        
        <div class="news-grid">
            <?php
            $db = Database::getInstance()->getConnection();
            $lang_suffix = Language::getSuffix();
            $stmt = $db->query("SELECT * FROM news WHERE is_published = 1 ORDER BY published_date DESC LIMIT 3");
            $news = $stmt->fetchAll();
            
            if (count($news) > 0) {
                foreach ($news as $item) {
                    $title = $item['title' . $lang_suffix];
                    $excerpt = $item['excerpt' . $lang_suffix] ?: substr(strip_tags($item['content' . $lang_suffix]), 0, 120) . '...';
                    $image = $item['image'] ? '/assets/uploads/' . $item['image'] : '/assets/images/placeholder.jpg';
                    $date = date('M j, Y', strtotime($item['published_date']));
                    ?>
                    <article class="news-card">
                        <div class="news-image">
                            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>">
                            <div class="news-overlay"></div>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span class="badge badge-primary">
                                    <i class="far fa-calendar"></i> <?php echo $date; ?>
                                </span>
                            </div>
                            <h3 class="news-title"><?php echo htmlspecialchars($title); ?></h3>
                            <p class="news-excerpt"><?php echo htmlspecialchars($excerpt); ?></p>
                            <a href="<?php echo BASE_URL; ?>/pages/news-detail.php?id=<?php echo $item['id']; ?>" class="news-link">
                                <?php echo t('read_article','Read Article'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<p class="text-center" style="grid-column: 1/-1; color: var(--text-muted);">No news available</p>';
            }
            ?>
        </div>
        
        <div class="text-center" style="margin: 3rem 0rem 3rem 0rem;">
            <a href="<?php echo BASE_URL; ?>/pages/news.php" class="btn btn-primary btn-lg">
                <i class="fas fa-newspaper"></i>
                <?php echo t('view_all_news','View All News'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Featured Projects Section - GitHub Style -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
                <span class="section-tag"><span class="glow-dot"></span><?php echo t('home_portfolio_tag','Portfolio'); ?></span>
                <h2 class="section-title"><?php echo t('home_projects_title','Explore our <span class="gradient-text">successful projects</span>'); ?></h2>
                <p class="section-description"><?php echo t('home_projects_desc','Delivering excellence across diverse industrial sectors worldwide'); ?></p>
        </div>
        
        <div class="projects-grid">
            <?php
            $stmt = $db->query("SELECT * FROM projects WHERE is_published = 1 ORDER BY sort_order ASC LIMIT 4");
            $projects = $stmt->fetchAll();
            
            if (count($projects) > 0) {
                foreach ($projects as $project) {
                    $title = $project['title' . $lang_suffix];
                    $description = substr(strip_tags($project['description' . $lang_suffix]), 0, 150) . '...';
                    $images = $project['images'] ? json_decode($project['images'], true) : [];
                    $image = !empty($images) ? '/assets/uploads/' . $images[0] : '/assets/images/placeholder.jpg';
                    ?>
                    <article class="project-card">
                        <div class="project-image">
                            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($title); ?>">
                            <div class="project-overlay">
                                <a href="<?php echo BASE_URL; ?>/pages/project-detail.php?id=<?php echo $project['id']; ?>" class="project-view">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title"><?php echo htmlspecialchars($title); ?></h3>
                            <p class="project-description"><?php echo htmlspecialchars($description); ?></p>
                            
                            <div class="project-meta">
                                <?php if ($project['client']): ?>
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-building"></i> 
                                        <?php echo htmlspecialchars($project['client']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($project['location']): ?>
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-map-marker-alt"></i> 
                                        <?php echo htmlspecialchars($project['location']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <a href="<?php echo BASE_URL; ?>/pages/project-detail.php?id=<?php echo $project['id']; ?>" class="project-link">
                                <?php echo t('projects_view'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<p class="text-center" style="grid-column: 1/-1; color: var(--text-muted);">' . t('projects_no_items','No projects available') . '</p>';
            }
            ?>
        </div>
        
        <div class="text-center" style="margin:3rem 0rem 3rem 0rem;">
            <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-primary btn-lg">
                <i class="fas fa-briefcase"></i>
                <?php echo t('view_all_projects','View All Projects'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Partners Section - GitHub Style -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header text-center">
                <span class="section-tag"><span class="glow-dot"></span><?php echo t('home_partners_tag','Trusted Partners'); ?></span>
                <h2 class="section-title"><?php echo t('home_partners_title','Trusted by <span class="gradient-text">industry leaders</span>'); ?></h2>
                <p class="section-description"><?php echo t('home_partners_desc','Collaborating with world-class companies to deliver exceptional results'); ?></p>
        </div>
        
        <div class="partners-grid">
            <?php
            $stmt = $db->query("SELECT * FROM partners ORDER BY sort_order ASC LIMIT 8");
            $partners = $stmt->fetchAll();
            
            if (count($partners) > 0) {
                foreach ($partners as $partner) {
                    $logo = '/assets/uploads/' . $partner['logo'];
                    ?>
                    <div class="partner-card">
                        <img src="<?php echo $logo; ?>" 
                             alt="<?php echo htmlspecialchars($partner['name']); ?>" 
                             class="partner-logo">
                        <div class="partner-name"><?php echo htmlspecialchars($partner['name']); ?></div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="text-center" style="grid-column: 1/-1; color: var(--text-muted);">' . t('partners_no_items','No partners available') . '</p>';
            }
            ?>
        </div>
        
        <div class="text-center" style="margin: 3rem 0rem 3rem 0rem;">
            <a href="<?php echo BASE_URL; ?>/pages/partners.php" class="btn btn-outline btn-lg">
                <i class="fas fa-handshake"></i>
                <?php echo t('view_all_partners','View All Partners'); ?>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section - GitHub Style -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2 class="cta-title"><?php echo t('home_cta_title','Ready to start your <span class="gradient-text">next project?</span>'); ?></h2>
                <p class="cta-description"><?php echo t('home_cta_desc','Let\'s discuss how we can help you achieve your industrial goals with our comprehensive solutions.'); ?></p>
            </div>
            <div class="cta-buttons">
                <a href="<?php echo BASE_URL; ?>/pages/contact.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane"></i>
                    <?php echo t('get_in_touch','Get in Touch'); ?>
                </a>
                <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-folder-open"></i>
                    <?php echo t('view_portfolio','View Portfolio'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Initialize Vanta.js NET effect
let vantaEffect = null;

if (window.VANTA && window.THREE) {
    vantaEffect = VANTA.NET({
        el: "#vanta-bg",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00,
  color: 0x4c8dff,
  backgroundColor: 0x161b34,
  points: 5.00,
  maxDistance: 20.00,
  spacing: 16.00,
        backgroundAlpha: 0
    });
}

// Clean up on page unload
window.addEventListener('beforeunload', function() {
    if (vantaEffect) vantaEffect.destroy();
});
</script>

<?php require_once 'includes/footer.php'; ?>
