<?php require_once '../includes/header.php'; ?>

<!-- Contact Section - Modern Arctiq Style -->
<section class="contact-section">
    <div class="contact-container">
        <!-- Left Side - Form -->
        <div class="contact-form-wrapper">
            <h1 class="contact-title"><?php echo t('contact_title','We\'re here to help'); ?></h1>
            
            <form id="contactForm" action="<?php echo BASE_URL; ?>/includes/contact-handler.php" method="POST" class="modern-contact-form">
                <div class="form-group">
                    <label class="form-label"><?php echo t('contact_name','Name'); ?></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. John Smith" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo t('contact_email','Email address'); ?></label>
                    <input type="email" name="email" class="form-control" placeholder="e.g. example@gmail.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo t('contact_message','Message'); ?></label>
                    <textarea name="message" class="form-control" rows="6" placeholder="Let us know how we can help" required></textarea>
                </div>
                
                <button type="submit" class="btn-send-message">
                    <?php echo t('contact_send','Send message'); ?>
                </button>
            </form>
        </div>
        
        
        <!-- Right Side - Testimonial Card -->
        <div class="testimonial-card-wrapper">
            <div class="testimonial-card">
                <div class="testimonial-gradient"></div>
                <div class="testimonial-content">
                    <div class="testimonial-logo">
                        <img src="<?php echo BASE_URL; ?>/assets/images/logo.svg" alt="Logo">
                    </div>
                    
                    <div class="testimonial-navigation">
                        <button class="nav-arrow" onclick="prevTestimonial()">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button class="nav-arrow" onclick="nextTestimonial()">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    
                    <div class="testimonial-text" id="testimonialText">
                        <?php
                        $db = Database::getInstance()->getConnection();
                        $lang_suffix = Language::getSuffix();
                        $stmt = $db->query("SELECT * FROM projects WHERE is_published = 1 ORDER BY sort_order ASC LIMIT 1");
                        $project = $stmt->fetch();
                        
                        if ($project) {
                            $title = $project['title' . $lang_suffix];
                            $description = strip_tags($project['description' . $lang_suffix]);
                            $excerpt = mb_substr($description, 0, 200) . '...';
                            echo '<p>"' . htmlspecialchars($title) . ' - ' . htmlspecialchars($excerpt) . '"</p>';
                        } else {
                            echo '<p>"Caspian Industry <strong>cut project delays by 30%</strong> and transformed our global team communication, saving us hours every week."</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Contact Information Cards -->
    <div class="contact-info-wrapper" >
        <div class="container">
            <?php
            $db = Database::getInstance()->getConnection();
            // Get settings as key-value pairs
            $stmt = $db->query("SELECT setting_key, setting_value FROM site_settings");
            $settingsData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            
            $email = isset($settingsData['contact_email']) ? $settingsData['contact_email'] : (isset($settingsData['email']) ? $settingsData['email'] : '');
            $phone = isset($settingsData['contact_phone']) ? $settingsData['contact_phone'] : (isset($settingsData['phone']) ? $settingsData['phone'] : '');
            $address = isset($settingsData['address']) ? $settingsData['address'] : '';
            ?>
            
            <div class="contact-info-grid" style="margin-top:1rem;">
                <?php if (!empty($email)): ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-content">
                        <h4><?php echo t('contact_email','Email'); ?></h4>
                        <a href="mailto:<?php echo htmlspecialchars($email); ?>">
                            <?php echo htmlspecialchars($email); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($phone)): ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-info-content">
                        <h4><?php echo t('contact_phone','Phone'); ?></h4>
                        <a href="tel:<?php echo htmlspecialchars($phone); ?>">
                            <?php echo htmlspecialchars($phone); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($address)): ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-content">
                        <h4><?php echo t('contact_address','Address'); ?></h4>
                        <p><?php echo nl2br(htmlspecialchars($address)); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</section>

<style>
/* Contact Section - Modern Arctiq Style */
.contact-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #0d1117 0%, #161b22 50%, #0d1117 100%);
    position: relative;
    padding: 120px 2rem 4rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    overflow: hidden;
}

.contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(88, 166, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(14, 165, 233, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.03) 0%, transparent 70%);
    pointer-events: none;
}

.contact-section::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(88, 166, 255, 0.03) 2px,
        rgba(88, 166, 255, 0.03) 4px
    );
    animation: gridMove 20s linear infinite;
    pointer-events: none;
}

@keyframes gridMove {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(50px);
    }
}

.contact-container {
    max-width: 1200px;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
    position: relative;
    z-index: 1;
    margin-bottom: 4rem;
}

/* Left Side - Form */
.contact-form-wrapper {
    padding: 2rem 0;
}

.contact-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 2.5rem;
    line-height: 1.2;
}

.modern-contact-form {
    max-width: 500px;
}

.modern-contact-form .form-group {
    margin-bottom: 1.5rem;
}

.modern-contact-form .form-label {
    display: block;
    color: #ffffff;
    font-size: 0.9375rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.modern-contact-form .form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    background: rgba(22, 27, 34, 0.6);
    border: 1px solid rgba(48, 54, 61, 0.5);
    border-radius: 8px;
    color: #ffffff;
    font-size: 0.9375rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.modern-contact-form .form-control:hover {
    border-color: rgba(88, 166, 255, 0.4);
    background: rgba(22, 27, 34, 0.8);
}

.modern-contact-form .form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    background: rgba(22, 27, 34, 0.9);
    box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.1);
}

.modern-contact-form .form-control::placeholder {
    color: rgba(139, 148, 158, 0.6);
}

.modern-contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.btn-send-message {
    background: linear-gradient(135deg, var(--color-primary), #0ea5e9);
    color: #ffffff;
    border: none;
    padding: 0.875rem 2.5rem;
    border-radius: 8px;
    font-size: 0.9375rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: auto;
    margin-top: 1rem;
    box-shadow: 0 4px 12px rgba(88, 166, 255, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-send-message::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-send-message:hover::before {
    left: 100%;
}

.btn-send-message:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(88, 166, 255, 0.4);
}

.btn-send-message:active {
    transform: translateY(0);
}

/* Contact Information Wrapper - Below Main Container */
.contact-info-wrapper {
    position: relative;
    z-index: 1;
    padding: 0 2rem 4rem;
}

.contact-info-wrapper .container {
    max-width: 1200px;
    margin: 0 auto;
}

.contact-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    width: 100%;
}

.contact-info-item {
    background: rgba(22, 27, 34, 0.6);
    border: 1px solid rgba(48, 54, 61, 0.5);
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.contact-info-item:hover {
    background: rgba(22, 27, 34, 0.8);
    border-color: rgba(88, 166, 255, 0.4);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(88, 166, 255, 0.15);
}

.contact-info-icon {
    width: 48px;
    height: 48px;
    background: rgba(88, 166, 255, 0.1);
    border: 1px solid rgba(88, 166, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-info-item:hover .contact-info-icon {
    background: rgba(88, 166, 255, 0.15);
    border-color: rgba(88, 166, 255, 0.4);
}

.contact-info-icon i {
    font-size: 1.25rem;
    color: var(--color-primary);
}

.contact-info-content {
    flex: 1;
    min-width: 0;
}

.contact-info-content h4 {
    font-size: 0.6875rem;
    color: var(--text-muted);
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.contact-info-content a,
.contact-info-content p {
    color: var(--text-white);
    font-size: 0.9375rem;
    margin: 0;
    text-decoration: none;
    transition: color 0.2s;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
}

.contact-info-content a:hover {
    color: var(--color-primary);
}

.contact-info-content p {
    color: var(--text-secondary);
    white-space: normal;
}

@media (max-width: 968px) {
    .contact-info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Right Side - Testimonial Card */
.testimonial-card-wrapper {
    position: sticky;
    top: 140px;
}

.testimonial-card {
    background: #252d37d9;
    border-radius: 24px;
    padding: 3rem;
    position: relative;
    overflow: hidden;
    border: 1px solid #333;
}

.testimonial-gradient {
    position: absolute;
    bottom: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(74, 158, 255, 0.05) 0%, transparent 70%);
    pointer-events: none;
}

.testimonial-content {
    position: relative;
    z-index: 1;
}

.testimonial-logo {
    margin-bottom: 2rem;
}

.testimonial-logo img {
    height: 32px;
    width: auto;
    filter: brightness(0) invert(1);
}

.testimonial-navigation {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.nav-arrow {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #333;
    border: 1px solid #444;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-arrow:hover {
    background: #3a3a3a;
    border-color: #555;
}

.testimonial-text {
    margin-bottom: 2rem;
}

.testimonial-text p {
    font-size: 1.125rem;
    line-height: 1.7;
    color: #e0e0e0;
    margin: 0;
}

.testimonial-text strong {
    color: #ffffff;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 968px) {
    .contact-container {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .testimonial-card-wrapper {
        position: relative;
        top: 0;
    }
    
    .contact-info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

@media (max-width: 640px) {
    .contact-section {
        padding: 100px 1.5rem 3rem;
    }
    
    .testimonial-card {
        padding: 2rem;
    }
    
    .contact-info-wrapper {
        padding: 0 1.5rem 3rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    handleContactForm('contactForm');
});

// Load projects for testimonials
const testimonials = <?php
    $db = Database::getInstance()->getConnection();
    $lang_suffix = Language::getSuffix();
    $stmt = $db->query("SELECT * FROM projects WHERE is_published = 1 ORDER BY sort_order ASC LIMIT 5");
    $projects = $stmt->fetchAll();
    
    $testimonial_data = [];
    foreach ($projects as $project) {
        $title = $project['title' . $lang_suffix];
        $description = strip_tags($project['description' . $lang_suffix]);
        $excerpt = mb_substr($description, 0, 200) . '...';
        $testimonial_data[] = [
            'text' => htmlspecialchars($title) . ' - ' . htmlspecialchars($excerpt)
        ];
    }
    
    echo json_encode($testimonial_data);
?>;

let currentTestimonial = 0;

function nextTestimonial() {
    if (testimonials.length > 0) {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        updateTestimonial();
    }
}

function prevTestimonial() {
    if (testimonials.length > 0) {
        currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
        updateTestimonial();
    }
}

function updateTestimonial() {
    const textElement = document.getElementById('testimonialText');
    if (textElement && testimonials[currentTestimonial]) {
        textElement.innerHTML = '<p>"' + testimonials[currentTestimonial].text + '"</p>';
    }
}
</script>

<?php require_once '../includes/footer.php'; ?>
