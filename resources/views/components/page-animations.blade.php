{{-- 
    Hi Venus PAGE ANIMATIONS
    Include this component in pages that need entrance animations
    Usage: @include('components.page-animations')
--}}

<style>
    /* =============================================
       SHARED PAGE ANIMATIONS
       ============================================= */
    
    /* Entrance Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Pulse & Float */
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes glow {
        0%, 100% { box-shadow: 0 0 5px rgba(255, 183, 0, 0.5); }
        50% { box-shadow: 0 0 20px rgba(255, 183, 0, 0.8), 0 0 40px rgba(255, 183, 0, 0.4); }
    }
    
    /* Page Entrance Classes */
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .animate-fade-in-down {
        animation: fadeInDown 0.6s ease-out;
    }
    
    .animate-fade-in-left {
        animation: fadeInLeft 0.6s ease-out;
    }
    
    .animate-fade-in-right {
        animation: fadeInRight 0.6s ease-out;
    }
    
    .animate-scale-in {
        animation: scaleIn 0.5s ease-out;
    }
    
    .animate-slide-in-up {
        animation: slideInUp 0.7s ease-out;
    }
    
    /* Delay Classes */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-600 { animation-delay: 0.6s; }
    .delay-700 { animation-delay: 0.7s; }
    .delay-800 { animation-delay: 0.8s; }
    
    /* Fill Mode */
    .fill-backwards {
        animation-fill-mode: backwards;
    }
    
    .fill-forwards {
        animation-fill-mode: forwards;
    }
    
    .fill-both {
        animation-fill-mode: both;
    }
    
    /* Infinite Animations */
    .animate-pulse {
        animation: pulse 2s ease-in-out infinite;
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    .animate-bounce {
        animation: bounce 2s ease-in-out infinite;
    }
    
    .animate-glow {
        animation: glow 2s ease-in-out infinite;
    }
    
    .animate-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    /* Hover Effects */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
    }
    
    .hover-scale {
        transition: transform 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: scale(1.05);
    }
    
    .hover-rotate {
        transition: transform 0.3s ease;
    }
    
    .hover-rotate:hover {
        transform: rotate(5deg);
    }
    
    /* Button Animations */
    .btn-animate {
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn-animate::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }
    
    .btn-animate:active::after {
        width: 300px;
        height: 300px;
    }
    
    .btn-animate:active {
        transform: scale(0.95);
    }
    
    /* Card Animations */
    .card-animate {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-animate:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
    }
    
    /* Stagger Children */
    .stagger-container > * {
        opacity: 0;
        animation: fadeInUp 0.5s ease-out forwards;
    }
    
    .stagger-container > *:nth-child(1) { animation-delay: 0.05s; }
    .stagger-container > *:nth-child(2) { animation-delay: 0.1s; }
    .stagger-container > *:nth-child(3) { animation-delay: 0.15s; }
    .stagger-container > *:nth-child(4) { animation-delay: 0.2s; }
    .stagger-container > *:nth-child(5) { animation-delay: 0.25s; }
    .stagger-container > *:nth-child(6) { animation-delay: 0.3s; }
    .stagger-container > *:nth-child(7) { animation-delay: 0.35s; }
    .stagger-container > *:nth-child(8) { animation-delay: 0.4s; }
    .stagger-container > *:nth-child(9) { animation-delay: 0.45s; }
    .stagger-container > *:nth-child(10) { animation-delay: 0.5s; }
    
    /* Table Row Animation */
    .table-animate tr {
        opacity: 0;
        animation: fadeInRight 0.4s ease-out forwards;
    }
    
    .table-animate tr:nth-child(1) { animation-delay: 0.05s; }
    .table-animate tr:nth-child(2) { animation-delay: 0.1s; }
    .table-animate tr:nth-child(3) { animation-delay: 0.15s; }
    .table-animate tr:nth-child(4) { animation-delay: 0.2s; }
    .table-animate tr:nth-child(5) { animation-delay: 0.25s; }
    .table-animate tr:nth-child(6) { animation-delay: 0.3s; }
    .table-animate tr:nth-child(7) { animation-delay: 0.35s; }
    .table-animate tr:nth-child(8) { animation-delay: 0.4s; }
    .table-animate tr:nth-child(9) { animation-delay: 0.45s; }
    .table-animate tr:nth-child(10) { animation-delay: 0.5s; }
    
    /* Focus Animations */
    .input-animate {
        transition: all 0.3s ease;
    }
    
    .input-animate:focus {
        transform: translateY(-2px);
        box-shadow: 0 0 0 3px rgba(59, 104, 72, 0.15);
    }
    
    /* Icon Animations */
    .icon-animate {
        transition: transform 0.3s ease;
    }
    
    .icon-animate:hover {
        transform: scale(1.2) rotate(10deg);
    }
    
    /* Page Content Wrapper */
    .page-content {
        animation: fadeInUp 0.5s ease-out 0.2s backwards;
    }
    
    /* Page Transition Overlay */
    .page-transition {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #003016 0%, #1a472a 50%, #003016 100%);
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .page-transition.active {
        opacity: 1;
        pointer-events: all;
    }
    
    /* =============================================
       MOBILE RESPONSIVE ANIMATIONS
       ============================================= */
    
    /* Touch Device Optimizations */
    @media (pointer: coarse) {
        /* Shorter animation durations for better responsiveness */
        .animate-fade-in,
        .animate-fade-in-up,
        .animate-fade-in-down,
        .animate-fade-in-left,
        .animate-fade-in-right {
            animation-duration: 0.4s !important;
        }
        
        .delay-100 { animation-delay: 0.05s !important; }
        .delay-200 { animation-delay: 0.1s !important; }
        .delay-300 { animation-delay: 0.15s !important; }
        .delay-400 { animation-delay: 0.2s !important; }
        .delay-500 { animation-delay: 0.25s !important; }
        
        /* Simpler hover effects for touch */
        .hover-lift:hover,
        .card-animate:hover {
            transform: translateY(-3px) !important;
        }
        
        /* Touch feedback for buttons */
        .btn-animate:active {
            transform: scale(0.97) !important;
        }
        
        /* Disable float animation on mobile to save battery */
        .animate-float {
            animation-duration: 5s !important;
        }
        
        /* Reduce continuous animations */
        .animate-spin {
            animation-duration: 3s !important;
        }
    }
    
    /* Small Screen Optimizations */
    @media (max-width: 768px) {
        /* Reduced movement for mobile screens */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Simpler card hover on mobile */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card-hover:active {
            transform: scale(0.98);
        }
        
        /* Touch-friendly tap feedback */
        .touch-feedback {
            position: relative;
            overflow: hidden;
        }
        
        .touch-feedback::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }
        
        .touch-feedback:active::after {
            width: 200%;
            height: 200%;
        }
        
        /* Reduced stagger delays on mobile */
        .stagger-container > *:nth-child(1) { animation-delay: 0.03s; }
        .stagger-container > *:nth-child(2) { animation-delay: 0.06s; }
        .stagger-container > *:nth-child(3) { animation-delay: 0.09s; }
        .stagger-container > *:nth-child(4) { animation-delay: 0.12s; }
        .stagger-container > *:nth-child(5) { animation-delay: 0.15s; }
        .stagger-container > *:nth-child(6) { animation-delay: 0.18s; }
    }
    
    /* =============================================
       REDUCED MOTION SUPPORT
       ============================================= */
    
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
        
        .animate-pulse,
        .animate-float,
        .animate-spin,
        .animate-bounce,
        .animate-glow,
        .animate-shimmer {
            animation: none !important;
        }
        
        .hover-lift,
        .card-animate,
        .hover-scale,
        .hover-rotate {
            transition: none !important;
        }
    }
    
    /* Reduced motion class (set via JS) */
    .reduced-motion *,
    .reduced-motion *::before,
    .reduced-motion *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
</style>

{{-- Page Transition Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add loaded class to body for entrance animations
        document.body.classList.add('page-loaded');
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add hover effect to all buttons without explicit classes
        document.querySelectorAll('button:not(.no-animate)').forEach(btn => {
            btn.classList.add('btn-animate');
        });
        
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);
        
        // Observe elements with data-animate attribute
        document.querySelectorAll('[data-animate]').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });
    });
    // Handle reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (prefersReducedMotion.matches) {
        document.documentElement.classList.add('reduced-motion');
    }
    
    // Add touch feedback to interactive elements
    document.querySelectorAll('a, button, .card-hover, [role="button"]').forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.97)';
            this.style.transition = 'transform 0.1s ease';
        }, {passive: true});
        
        el.addEventListener('touchend', function() {
            this.style.transform = '';
        }, {passive: true});
        
        el.addEventListener('touchcancel', function() {
            this.style.transform = '';
        }, {passive: true});
    });
    
    // Mobile-specific: Pause heavy animations when not visible
    const animatedElements = document.querySelectorAll('.animate-float, .animate-pulse, .animate-spin, .animate-bounce');
    const mobileObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            } else {
                entry.target.style.animationPlayState = 'paused';
            }
        });
    }, { threshold: 0.1 });
    
    if (window.matchMedia('(pointer: coarse)').matches) {
        animatedElements.forEach(el => mobileObserver.observe(el));
    }
        // Handle reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        if (prefersReducedMotion.matches) {
            document.documentElement.classList.add('reduced-motion');
        }
        
        // Add touch feedback to interactive elements
        document.querySelectorAll('a, button, .card-hover, [role="button"]').forEach(el => {
            el.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.97)';
                this.style.transition = 'transform 0.1s ease';
            }, {passive: true});
            
            el.addEventListener('touchend', function() {
                this.style.transform = '';
            }, {passive: true});
            
            el.addEventListener('touchcancel', function() {
                this.style.transform = '';
            }, {passive: true});
        });
        
        // Mobile-specific: Pause heavy animations when not visible
        const animatedElements = document.querySelectorAll('.animate-float, .animate-pulse, .animate-spin, .animate-bounce');
        const mobileObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                } else {
                    entry.target.style.animationPlayState = 'paused';
                }
            });
        }, { threshold: 0.1 });
        
        if (window.matchMedia('(pointer: coarse)').matches) {
            animatedElements.forEach(el => mobileObserver.observe(el));
        }
    </script>


