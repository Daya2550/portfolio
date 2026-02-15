/**
 * Custom JavaScript for Portfolio Website
 * Additional functionality and component-specific interactions
 */

(function() {
    'use strict';

    /**
     * Initialize all custom functionality when DOM is loaded
     */
    document.addEventListener('DOMContentLoaded', function() {
        initializeCustomFeatures();
        initializeAnimations();
        initializeFormValidation();
        initializeScrollEffects();
    });

    /**
     * Initialize custom features
     */
    function initializeCustomFeatures() {
        // Add smooth scrolling to navigation links
        const navLinks = document.querySelectorAll('#navmenu a[href^="#"]');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add active class to current navigation item
        updateActiveNavigation();
        window.addEventListener('scroll', updateActiveNavigation);
    }

    /**
     * Update active navigation based on scroll position
     */
    function updateActiveNavigation() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('#navmenu a[href^="#"]');
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.offsetHeight;
            
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + currentSection) {
                link.classList.add('active');
            }
        });
    }

    /**
     * Initialize custom animations
     */
    function initializeAnimations() {
        // Add fade-in animation to project cards
        const projectCards = document.querySelectorAll('.portfolio__project-card');
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        projectCards.forEach(card => {
            observer.observe(card);
        });

        // Add hover effects to skill bars
        const skillBars = document.querySelectorAll('.progress-bar');
        skillBars.forEach(bar => {
            bar.addEventListener('mouseenter', function() {
                this.style.transform = 'scaleY(1.1)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            bar.addEventListener('mouseleave', function() {
                this.style.transform = 'scaleY(1)';
            });
        });
    }

    /**
     * Initialize form validation
     */
    function initializeFormValidation() {
        const contactForm = document.querySelector('.php-email-form');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const loadingDiv = this.querySelector('.loading');
                const errorDiv = this.querySelector('.error-message');
                const successDiv = this.querySelector('.sent-message');
                
                // Show loading
                loadingDiv.style.display = 'block';
                errorDiv.style.display = 'none';
                successDiv.style.display = 'none';
                
                // Send form data using Fetch API
                fetch(this.getAttribute('action'), {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    return response.text();
                })
                .then(data => {
                    loadingDiv.style.display = 'none';
                    if (data.trim() === 'OK') {
                        successDiv.style.display = 'block';
                        this.reset();
                        setTimeout(() => {
                            successDiv.style.display = 'none';
                        }, 5000);
                    } else {
                        throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action);
                    }
                })
                .catch((error) => {
                    loadingDiv.style.display = 'none';
                    errorDiv.innerHTML = 'An error occurred: ' + error.message;
                    errorDiv.style.display = 'block';
                });
            });
        }
    }

    /**
     * Initialize scroll effects
     */
    function initializeScrollEffects() {
        // Add scroll-to-top functionality
        const scrollTopBtn = document.querySelector('#scroll-top');
        
        if (scrollTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    scrollTopBtn.classList.add('active');
                } else {
                    scrollTopBtn.classList.remove('active');
                }
            });
            
            scrollTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Add parallax effect to hero section
        const heroSection = document.querySelector('#hero');
        if (heroSection) {
            window.addEventListener('scroll', function() {
                const scrolled = window.scrollY;
                const parallaxSpeed = 0.5;
                
                if (scrolled < heroSection.offsetHeight) {
                    heroSection.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
                }
            });
        }
    }

    /**
     * Utility function to debounce scroll events
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Add typing effect to hero section
     */
    function initializeTypingEffect() {
        const typedElement = document.querySelector('.typed');
        if (typedElement && typeof Typed !== 'undefined') {
            const typedItems = typedElement.getAttribute('data-typed-items').split(',');
            
            new Typed('.typed', {
                strings: typedItems,
                typeSpeed: 100,
                backSpeed: 50,
                backDelay: 2000,
                loop: true
            });
        }
    }

    // Initialize typing effect after a short delay to ensure Typed.js is loaded
    setTimeout(initializeTypingEffect, 500);

    /**
     * Initialize image loading effects
     */
    function initializeImageLoading() {
        const images = document.querySelectorAll('.my-project-image img, .certificate-image img');

        images.forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            } else {
                img.addEventListener('load', function() {
                    this.classList.add('loaded');
                });

                img.addEventListener('error', function() {
                    // Handle broken images
                    this.style.display = 'none';
                    const parent = this.closest('.my-project-image, .certificate-image');
                    if (parent) {
                        parent.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                        parent.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: white; font-size: 2rem;"><i class="bi bi-image"></i></div>';
                    }
                });
            }
        });
    }

    /**
     * Enhanced certificate hover effects
     */
    function initializeCertificateEffects() {
        const certificateCards = document.querySelectorAll('.certificate-card');

        certificateCards.forEach(card => {
            card.addEventListener('click', function() {
                const img = this.querySelector('img');
                if (img && img.src) {
                    // Create modal or lightbox effect
                    const modal = document.createElement('div');
                    modal.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.9);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 9999;
                        cursor: pointer;
                    `;

                    const modalImg = document.createElement('img');
                    modalImg.src = img.src;
                    modalImg.style.cssText = `
                        max-width: 90%;
                        max-height: 90%;
                        object-fit: contain;
                        border-radius: 10px;
                    `;

                    modal.appendChild(modalImg);
                    document.body.appendChild(modal);

                    modal.addEventListener('click', function() {
                        document.body.removeChild(modal);
                    });
                }
            });
        });
    }

    // Initialize all enhancements
    initializeImageLoading();
    initializeCertificateEffects();
    initializeSkillsSection();
    initializeSparklingEffects();
    initializeScrollReveal();
    initializeSparklingEffects();
    initializeScrollReveal();

})();

/**
 * Skills Section Functionality (Mohasin Portfolio Style)
 */
function showSkillSection(event, sectionId) {
    // Remove active class from all buttons
    const buttons = document.querySelectorAll('.skill-btn');
    buttons.forEach(btn => btn.classList.remove('active'));

    // Add active class to clicked button
    event.target.classList.add('active');

    // Hide all skill sections
    const sections = document.querySelectorAll('.skill-section');
    sections.forEach(section => section.style.display = 'none');

    // Show selected section
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.style.display = 'flex';
    }
}

function initializeSkillsSection() {
    // Ensure frontend section is visible by default
    const frontendSection = document.getElementById('frontend');
    if (frontendSection) {
        frontendSection.style.display = 'flex';
    }

    // Hide other sections by default
    const otherSections = ['backend', 'databases', 'languages', 'tools'];
    otherSections.forEach(sectionId => {
        const section = document.getElementById(sectionId);
        if (section) {
            section.style.display = 'none';
        }
    });
}

/**
 * Typewriter Effect for Hero Section
 */
class TypeWriter {
    constructor(txtElement, words, wait = 3000) {
        this.txtElement = txtElement;
        this.words = words;
        this.txt = '';
        this.wordIndex = 0;
        this.wait = parseInt(wait, 10);
        this.type();
        this.isDeleting = false;
    }

    type() {
        const current = this.wordIndex % this.words.length;
        const fullTxt = this.words[current];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

        let typeSpeed = 300;

        if (this.isDeleting) {
            typeSpeed /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            typeSpeed = this.wait;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.wordIndex++;
            typeSpeed = 500;
        }

        setTimeout(() => this.type(), typeSpeed);
    }
}

// Initialize typewriter effect
document.addEventListener('DOMContentLoaded', function() {
    const txtElement = document.querySelector('.typewrite .wrap');
    const typewriteElement = document.querySelector('.typewrite');

    if (txtElement && typewriteElement) {
        const words = JSON.parse(typewriteElement.getAttribute('data-type') || '["Developer", "Designer", "Freelancer"]');
        const wait = typewriteElement.getAttribute('data-period') || 2000;
        new TypeWriter(txtElement, words, wait);
    }
});

/**
 * Sparkling Effects System
 */
function initializeSparklingEffects() {
    createSparkleContainer();
    startSparkleAnimation();
    addGlowEffects();
    createFloatingParticles();
}

function createSparkleContainer() {
    const sparkleContainer = document.createElement('div');
    sparkleContainer.className = 'sparkle-container';
    document.body.appendChild(sparkleContainer);
}

function startSparkleAnimation() {
    const container = document.querySelector('.sparkle-container');
    if (!container) return;

    setInterval(() => {
        createSparkle(container);
    }, 300);
}

function createSparkle(container) {
    const sparkle = document.createElement('div');
    sparkle.className = 'sparkle';

    // Random position
    sparkle.style.left = Math.random() * 100 + '%';
    sparkle.style.animationDelay = Math.random() * 2 + 's';
    sparkle.style.animationDuration = (Math.random() * 3 + 2) + 's';

    container.appendChild(sparkle);

    // Remove sparkle after animation
    setTimeout(() => {
        if (sparkle.parentNode) {
            sparkle.parentNode.removeChild(sparkle);
        }
    }, 5000);
}

function createFloatingParticles() {
    const container = document.querySelector('.sparkle-container');
    if (!container) return;

    setInterval(() => {
        const particle = document.createElement('div');
        particle.className = 'particle';

        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 2 + 's';
        particle.style.animationDuration = (Math.random() * 4 + 4) + 's';

        container.appendChild(particle);

        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, 8000);
    }, 800);
}

function addGlowEffects() {
    // Add glow effects to cards
    const cards = document.querySelectorAll('.my-project-card, .certificate-card, .skills .card');
    cards.forEach(card => {
        card.classList.add('glow-effect', 'enhanced-hover');
    });

    // Add pulse effect to buttons
    const buttons = document.querySelectorAll('.btn-primary, .cta-buttons .btn');
    buttons.forEach(btn => {
        btn.classList.add('pulse-btn');
    });
}

/**
 * Scroll Reveal Animation System
 */
function initializeScrollReveal() {
    const elements = document.querySelectorAll('.my-project-card, .certificate-card, .skills .card, .timeline-item');

    elements.forEach(el => {
        el.classList.add('scroll-reveal');
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');

                // Add staggered animation delay
                const delay = Math.random() * 300;
                setTimeout(() => {
                    entry.target.style.transitionDelay = delay + 'ms';
                }, 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));
}

/**
 * Enhanced Mouse Trail Effect
 */
function initializeMouseTrail() {
    let mouseX = 0, mouseY = 0;
    let trail = [];

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        // Create trail dot
        const dot = document.createElement('div');
        dot.className = 'mouse-trail-dot';
        dot.style.cssText = `
            position: fixed;
            left: ${mouseX}px;
            top: ${mouseY}px;
            width: 4px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.7;
            transition: all 0.3s ease;
        `;

        document.body.appendChild(dot);
        trail.push(dot);

        // Fade out and remove
        setTimeout(() => {
            dot.style.opacity = '0';
            dot.style.transform = 'scale(0)';
        }, 100);

        setTimeout(() => {
            if (dot.parentNode) {
                dot.parentNode.removeChild(dot);
            }
        }, 400);

        // Limit trail length
        if (trail.length > 10) {
            const oldDot = trail.shift();
            if (oldDot && oldDot.parentNode) {
                oldDot.parentNode.removeChild(oldDot);
            }
        }
    });
}
