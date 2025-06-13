document.addEventListener('DOMContentLoaded', function() {
    let lastScrollTop = 0;
    let isScrollingUp = false;
    let scrollThreshold = 10; // Minimum scroll distance before triggering hide/show
    const navbar = document.getElementById('navbar');

    // Add shadow and backdrop blur when scrolled
    function updateNavbarStyle() {
        if (window.scrollY > 0) {
            navbar.classList.add('shadow-lg', 'backdrop-blur-sm', 'bg-white/95', 'dark:bg-gray-900/95');
            navbar.classList.remove('bg-white', 'dark:bg-gray-900');
        } else {
            navbar.classList.remove('shadow-lg', 'backdrop-blur-sm', 'bg-white/95', 'dark:bg-gray-900/95');
            navbar.classList.add('bg-white', 'dark:bg-gray-900');
        }
    }

    function handleScroll() {
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Update navbar styling
        updateNavbarStyle();

        // Only proceed if we've scrolled enough to avoid jitter
        if (Math.abs(currentScrollTop - lastScrollTop) < scrollThreshold) {
            return;
        }

        // Don't hide navbar when at the very top
        if (currentScrollTop <= 0) {
            navbar.style.transform = 'translateY(0)';
            lastScrollTop = currentScrollTop;
            return;
        }

        // Determine scroll direction
        if (currentScrollTop > lastScrollTop) {
            // Scrolling down - hide navbar
            if (isScrollingUp) {
                isScrollingUp = false;
            }
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up - show navbar
            if (!isScrollingUp) {
                isScrollingUp = true;
            }
            navbar.style.transform = 'translateY(0)';
        }

        lastScrollTop = currentScrollTop;
    }

    // Throttle scroll events for better performance
    let ticking = false;
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(handleScroll);
            ticking = true;
            setTimeout(() => { ticking = false; }, 16); // ~60fps
        }
    }

    window.addEventListener('scroll', requestTick);

    // Initialize navbar style on page load
    updateNavbarStyle();
});
