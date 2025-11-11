<?php require_once '../includes/header.php'; ?>

<!-- Hero Section - About -->
<section class="hero" style="min-height: 60vh;">
    <div class="hero-background"></div>
    <div class="container">
        <div class="hero-content" style="grid-template-columns: 1fr;">
            <div class="hero-text" style="max-width: 100%; text-align: center;">
                <span class="hero-tag"> <?php echo t('nav_about'); ?></span>
                <h1 class="hero-title"><?php echo t('about_title'); ?></h1>
                <p class="hero-subtitle" style="max-width: 800px; margin: 0 auto;">
                    We are a leading industrial supplier providing comprehensive solutions across the Caspian region
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Content - Modern Two Column -->
<section class="section">
    <div class="container">
        <div class="about-content-grid">
            <div class="about-text">
                <h2 style="font-size: 2.5rem; margin-bottom: var(--spacing-lg); color: var(--text-white); font-weight: 700;">
                    Leading the Industry with Excellence
                </h2>
                <p style="font-size: 1.125rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: var(--spacing-lg);">
                    <?php echo t('about_description'); ?>
                </p>
                <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: var(--spacing-lg);">
                    With years of experience in the industry, we prioritize innovation, quality, and customer satisfaction 
                    in everything we do. Our team of experts works tirelessly to deliver exceptional products and services 
                    that meet the evolving needs of our clients.
                </p>
                <p style="color: var(--text-secondary); line-height: 1.8;">
                    Our commitment to excellence drives us to continuously improve our processes and expand our capabilities. 
                    We believe in building long-term partnerships based on trust, reliability, and mutual success.
                </p>
            </div>
            <div class="about-globe-wrapper">
                <div id="aboutGlobe" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
    </div>
</section>

<style>
.about-content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-4xl);
    align-items: center;
}

.about-globe-wrapper {
    position: relative;
    height: 800px;
    background: rgba(22, 27, 34, 0);
    border: 1px solid rgba(48, 54, 61, 0);
    border-radius: var(--radius-xl);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-globe-wrapper #aboutGlobe {
    width: 100%;
    height: 100%;
}

@media (max-width: 968px) {
    .about-content-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-3xl);
    }
    
    .about-globe-wrapper {
        height: 500px;
        order: -1;
    }
}

@media (max-width: 640px) {
    .about-globe-wrapper {
        height: 400px;
    }
}
</style>

<!-- Stats Section - Modern Cards -->
<section class="section section-alt">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--spacing-lg);">
            <div class="stat-card-modern">
                <div class="stat-value-modern">15+</div>
                <div class="stat-label-modern">Years of Experience</div>
            </div>
            <div class="stat-card-modern">
                <div class="stat-value-modern">500+</div>
                <div class="stat-label-modern">Projects Completed</div>
            </div>
            <div class="stat-card-modern">
                <div class="stat-value-modern">200+</div>
                <div class="stat-label-modern">Happy Clients</div>
            </div>
            <div class="stat-card-modern">
                <div class="stat-value-modern">50+</div>
                <div class="stat-label-modern">Team Members</div>
            </div>
        </div>
    </div>
</section>

<style>
.stat-card-modern {
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--spacing-3xl) var(--spacing-xl);
    text-align: center;
    transition: all var(--transition-normal);
}

.stat-card-modern:hover {
    border-color: var(--color-primary);
    box-shadow: 0 0 20px rgba(88, 166, 255, 0.2);
    transform: translateY(-4px);
}

.stat-value-modern {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--text-white);
    margin-bottom: var(--spacing-md);
    background: linear-gradient(135deg, var(--color-primary), #0ea5e9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label-modern {
    font-size: 0.875rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

@media (max-width: 968px) {
    .stat-card-modern:first-child {
        grid-column: 1 / -1;
    }
}

@media (max-width: 768px) {
    .container > div[style*="grid-template-columns: repeat(4"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 480px) {
    .container > div[style*="grid-template-columns: repeat(4"] {
        grid-template-columns: 1fr !important;
    }
    
    .stat-value-modern {
        font-size: 2.5rem;
    }
}
</style>

<!-- Values Section - Modern Icon Grid -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Our Values</span>
            <h2 class="section-title">What Drives Us</h2>
            <p class="section-description">The core principles that guide our business</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Quality</h4>
                    <p style="color: var(--text-secondary);">We never compromise on quality and deliver only the best products and services to our clients.</p>
                </div>
            </div>
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-handshake" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Integrity</h4>
                    <p style="color: var(--text-secondary);">We conduct business with honesty, transparency, and ethical practices in all our dealings.</p>
                </div>
            </div>
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-lightbulb" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Innovation</h4>
                    <p style="color: var(--text-secondary);">We embrace innovation and continuously seek better ways to serve our customers.</p>
                </div>
            </div>
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-users" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Teamwork</h4>
                    <p style="color: var(--text-secondary);">We believe in the power of collaboration and work together to achieve common goals.</p>
                </div>
            </div>
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-leaf" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Sustainability</h4>
                    <p style="color: var(--text-secondary);">We are committed to sustainable practices that benefit our environment and communities.</p>
                </div>
            </div>
            <div class="card text-center">
                <div style="padding: var(--spacing-2xl);">
                    <div style="width: 64px; height: 64px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <i class="fas fa-star" style="font-size: 2rem; color: var(--color-primary);"></i>
                    </div>
                    <h4 style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">Excellence</h4>
                    <p style="color: var(--text-secondary);">We strive for excellence in everything we do, from products to customer service.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="https://unpkg.com/three"></script>
    <script src="https://unpkg.com/globe.gl"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const locations = [
        // Ana merkez
        { lat: 40.4093, lng: 49.8671, name: 'BAKU' },
        
        // Avrupa
        { lat: 51.5074, lng: -0.1278, name: 'LONDON' },
        { lat: 48.8566, lng: 2.3522, name: 'PARIS' },
        { lat: 52.5200, lng: 13.4050, name: 'BERLIN' },
        { lat: 41.9028, lng: 12.4964, name: 'ROME' },
        { lat: 40.4168, lng: -3.7038, name: 'MADRID' },
        
        // Asya
        { lat: 35.6762, lng: 139.6503, name: 'TOKYO' },
        { lat: 39.9042, lng: 116.4074, name: 'BEIJING' },
        { lat: 1.3521, lng: 103.8198, name: 'SINGAPORE' },
        { lat: 19.0760, lng: 72.8777, name: 'MUMBAI' },
        { lat: 37.5665, lng: 126.9780, name: 'SEOUL' },
        
        // Orta Doğu & Körfez
        { lat: 25.2048, lng: 55.2708, name: 'DUBAI' },
        { lat: 29.3759, lng: 47.9774, name: 'KUWAIT' },

        
        // Kuzey Amerika
        { lat: 40.7128, lng: -74.0060, name: 'NEW YORK' },
        { lat: 29.7604, lng: -95.3698, name: 'HOUSTON' },
        { lat: 34.0522, lng: -118.2437, name: 'LOS ANGELES' },
        
        // Rusya & CIS
        { lat: 55.7558, lng: 37.6173, name: 'MOSCOW' },
        { lat: 51.1694, lng: 71.4491, name: 'ASTANA' },
        { lat: 41.2995, lng: 69.2401, name: 'TASHKENT' }
    ];
    
    const arcs = [
        // Baku'dan Avrupa'ya
        { startLat: 40.4093, startLng: 49.8671, endLat: 51.5074, endLng: -0.1278 }, // London
        { startLat: 40.4093, startLng: 49.8671, endLat: 48.8566, endLng: 2.3522 },   // Paris
        { startLat: 40.4093, startLng: 49.8671, endLat: 52.5200, endLng: 13.4050 },  // Berlin
        { startLat: 40.4093, startLng: 49.8671, endLat: 41.9028, endLng: 12.4964 },  // Rome
        
        // Baku'dan Asya'ya
        { startLat: 40.4093, startLng: 49.8671, endLat: 35.6762, endLng: 139.6503 }, // Tokyo
        { startLat: 40.4093, startLng: 49.8671, endLat: 39.9042, endLng: 116.4074 }, // Beijing
        { startLat: 40.4093, startLng: 49.8671, endLat: 1.3521, endLng: 103.8198 },  // Singapore
        
        // Baku'dan Körfez'e
        { startLat: 40.4093, startLng: 49.8671, endLat: 25.2048, endLng: 55.2708 },  // Dubai
        { startLat: 40.4093, startLng: 49.8671, endLat: 29.3759, endLng: 47.9774 },  // Kuwait

        
        // Baku'dan Amerika'ya
        { startLat: 40.4093, startLng: 49.8671, endLat: 40.7128, endLng: -74.0060 }, // New York
        { startLat: 40.4093, startLng: 49.8671, endLat: 29.7604, endLng: -95.3698 }, // Houston
        
        // Baku'dan CIS'e
        { startLat: 40.4093, startLng: 49.8671, endLat: 55.7558, endLng: 37.6173 },  // Moscow
        { startLat: 40.4093, startLng: 49.8671, endLat: 51.1694, endLng: 71.4491 },  // Astana
        { startLat: 40.4093, startLng: 49.8671, endLat: 41.2995, endLng: 69.2401 }   // Tashkent
    ];
    
    initGlobe('aboutGlobe', locations, arcs);
});
</script>

<?php require_once '../includes/footer.php'; ?>
