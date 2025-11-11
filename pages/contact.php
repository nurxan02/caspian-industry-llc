<?php require_once '../includes/header.php'; ?>

<!-- Contact Section - Modern Arctiq Style -->
<section class="contact-section">
    <div class="contact-container">
        <!-- Left Side - Form -->
        <div class="contact-form-wrapper">
            <h1 class="contact-title">We're here to help</h1>
            
            <form id="contactForm" action="/includes/contact-handler.php" method="POST" class="modern-contact-form">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. John Smith" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="e.g. example@gmail.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="6" placeholder="Let us know how we can help" required></textarea>
                </div>
                
                <button type="submit" class="btn-send-message">
                    Send message
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
</section>

<style>
/* Contact Section - Modern Arctiq Style */
.contact-section {
    min-height: 100vh;
    background: #1a1a1a;
    padding: 120px 2rem 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-container {
    max-width: 1200px;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
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
    background: #252525;
    border: 1px solid #333;
    border-radius: 8px;
    color: #ffffff;
    font-size: 0.9375rem;
    transition: all 0.2s;
}

.modern-contact-form .form-control:focus {
    outline: none;
    border-color: #4a9eff;
    background: #2a2a2a;
}

.modern-contact-form .form-control::placeholder {
    color: #666;
}

.modern-contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.btn-send-message {
    background: #ffffff;
    color: #1a1a1a;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    font-size: 0.9375rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    width: auto;
    margin-top: 1rem;
}

.btn-send-message:hover {
    background: #f0f0f0;
    transform: translateY(-1px);
}

/* Right Side - Testimonial Card */
.testimonial-card-wrapper {
    position: sticky;
    top: 140px;
}

.testimonial-card {
    background: #252525;
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
    background: radial-gradient(circle, rgba(74, 158, 255, 0.15) 0%, transparent 70%);
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
}

@media (max-width: 640px) {
    .contact-section {
        padding: 100px 1.5rem 3rem;
    }
    
    .testimonial-card {
        padding: 2rem;
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
