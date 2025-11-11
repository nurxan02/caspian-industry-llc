<?php require_once 'includes/header.php'; ?>

<!-- Hero Section - GitHub Style -->
<section class="hero section">
    <div class="hero-background"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-br">
                    <br>
                </span>
                <h1 class="hero-title">
                    Building the future of
                    <span class="gradient-text">industrial excellence</span>
                </h1>
                <p class="hero-subtitle">
                    Leading provider of comprehensive industrial solutions, combining cutting-edge 
                    technology with decades of expertise to deliver exceptional results worldwide.
                </p>
                
                <div class="hero-buttons">
                    <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket"></i>
                        Our Projects
                    </a>
                    <a href="<?php echo BASE_URL; ?>/pages/contact.php" class="btn btn-outline btn-lg">
                        <i class="fas fa-phone"></i>
                        Contact Sales
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
            <div class="hero-globe">
                <div class="globe-glow"></div>
                <div id="globeViz"></div>
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
                Why Choose Us
            </span>
            <h2 class="section-title">
                Built for <span class="gradient-text">industrial leaders</span>
            </h2>
            <p class="section-description">
                Comprehensive solutions backed by decades of experience and cutting-edge technology
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Quality & Safety First</h3>
                <p class="feature-description">
                    ISO certified processes ensuring the highest standards in every project we deliver
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3 class="feature-title">Advanced Technology</h3>
                <p class="feature-description">
                    Cutting-edge solutions leveraging the latest innovations in industrial automation
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="feature-title">Global Network</h3>
                <p class="feature-description">
                    Worldwide presence with local expertise serving clients across multiple continents
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="feature-title">Fast Deployment</h3>
                <p class="feature-description">
                    Rapid implementation with minimal downtime ensuring quick ROI for your business
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">24/7 Support</h3>
                <p class="feature-description">
                    Round-the-clock technical support keeping your operations running smoothly
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Proven Results</h3>
                <p class="feature-description">
                    Track record of successful projects delivering measurable business outcomes
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section - GitHub Style -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">
                <span class="glow-dot"></span>
                Latest Updates
            </span>
            <h2 class="section-title">
                Stay informed with our <span class="gradient-text">latest news</span>
            </h2>
            <p class="section-description">
                Industry insights, company updates, and project announcements
            </p>
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
                                Read Article <i class="fas fa-arrow-right"></i>
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
        
        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo BASE_URL; ?>/pages/news.php" class="btn btn-primary btn-lg">
                <i class="fas fa-newspaper"></i>
                View All News
            </a>
        </div>
    </div>
</section>

<!-- Featured Projects Section - GitHub Style -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">
                <span class="glow-dot"></span>
                Portfolio
            </span>
            <h2 class="section-title">
                Explore our <span class="gradient-text">successful projects</span>
            </h2>
            <p class="section-description">
                Delivering excellence across diverse industrial sectors worldwide
            </p>
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
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<p class="text-center" style="grid-column: 1/-1; color: var(--text-muted);">No projects available</p>';
            }
            ?>
        </div>
        
        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-primary btn-lg">
                <i class="fas fa-briefcase"></i>
                View All Projects
            </a>
        </div>
    </div>
</section>

<!-- Partners Section - GitHub Style -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">
                <span class="glow-dot"></span>
                Trusted Partners
            </span>
            <h2 class="section-title">
                Trusted by <span class="gradient-text">industry leaders</span>
            </h2>
            <p class="section-description">
                Collaborating with world-class companies to deliver exceptional results
            </p>
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
                echo '<p class="text-center" style="grid-column: 1/-1; color: var(--text-muted);">No partners available</p>';
            }
            ?>
        </div>
        
        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo BASE_URL; ?>/pages/partners.php" class="btn btn-outline btn-lg">
                <i class="fas fa-handshake"></i>
                View All Partners
            </a>
        </div>
    </div>
</section>

<!-- CTA Section - GitHub Style -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2 class="cta-title">
                    Ready to start your <span class="gradient-text">next project?</span>
                </h2>
                <p class="cta-description">
                    Let's discuss how we can help you achieve your industrial goals with our comprehensive solutions.
                </p>
            </div>
            <div class="cta-buttons">
                <a href="<?php echo BASE_URL; ?>/pages/contact.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane"></i>
                    Get in Touch
                </a>
                <a href="<?php echo BASE_URL; ?>/pages/projects.php" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-folder-open"></i>
                    View Portfolio
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Initialize globe with default locations
document.addEventListener('DOMContentLoaded', function() {
    const locations = [
        { lat: 40.4093, lng: 49.8671, name: 'BAKU' },
        { lat: 51.5074, lng: -0.1278, name: 'LONDON' },
        { lat: 40.7128, lng: -74.0060, name: 'NEW YORK' }
    ];
    
    const arcs = [
        { startLat: 40.4093, startLng: 49.8671, endLat: 51.5074, endLng: -0.1278 },
        { startLat: 40.4093, startLng: 49.8671, endLat: 40.7128, endLng: -74.0060 }
    ];
    
    initGlobe('globeViz', locations, arcs);
});
</script>

<?php require_once 'includes/footer.php'; ?>
