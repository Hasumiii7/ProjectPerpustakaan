// Optimized JavaScript with modern features
'use strict';

// Utility functions
const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
};

// Main application
document.addEventListener('DOMContentLoaded', () => {
    // Initialize components
    initializeImageLazyLoading();
    initializeSearch();
    initializeNavigation();
});

// Image lazy loading with Intersection Observer
function initializeImageLazyLoading() {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.01
    });

    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        if ('loading' in HTMLImageElement.prototype) {
            img.src = img.dataset.src;
        } else {
            imageObserver.observe(img);
        }
    });
}

// Search functionality with debounce
function initializeSearch() {
    const searchInput = document.querySelector('input[name="query"]');
    if (searchInput) {
        const debouncedSearch = debounce(() => {
            searchInput.form.submit();
        }, 300);

        searchInput.addEventListener('input', debouncedSearch);
    }
}

// Navigation handling
function initializeNavigation() {
    // Logout confirmation
    window.confirmLogout = () => {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            window.location.href = 'logout.php';
        }
    };

    // History state management
    if (document.referrer.includes("detailbuku.php")) {
        history.replaceState(null, "", "landingsiswa.php");
        window.location.href = "books.php";
    }
}

// Add loading states
function addLoadingState() {
    document.querySelectorAll('.book-card').forEach(card => {
        card.classList.add('loading');
    });
}

function removeLoadingState() {
    document.querySelectorAll('.book-card').forEach(card => {
        card.classList.remove('loading');
    });
}

// Error handling
window.addEventListener('error', (event) => {
    console.error('Global error:', event.error);
    // Add your error reporting logic here
});

// Performance monitoring
if ('performance' in window) {
    window.addEventListener('load', () => {
        const timing = performance.getEntriesByType('navigation')[0];
        console.log('Page load time:', timing.loadEventEnd - timing.navigationStart);
    });
} 