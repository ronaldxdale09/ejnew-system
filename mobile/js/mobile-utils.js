// Mobile Admin Utilities
class MobileAdmin {
    constructor() {
        this.init();
    }

    init() {
        this.setupPullToRefresh();
        this.setupOfflineDetection();
        this.setupTouchGestures();
        this.setupProgressiveWebApp();
    }

    // Pull to refresh functionality
    setupPullToRefresh() {
        let startY = 0;
        let currentY = 0;
        let pullThreshold = 100;
        let isRefreshing = false;

        document.addEventListener('touchstart', (e) => {
            if (window.scrollY === 0) {
                startY = e.touches[0].clientY;
            }
        });

        document.addEventListener('touchmove', (e) => {
            if (window.scrollY === 0 && !isRefreshing) {
                currentY = e.touches[0].clientY;
                let pullDistance = currentY - startY;

                if (pullDistance > 0) {
                    e.preventDefault();
                    
                    if (pullDistance > pullThreshold) {
                        this.showRefreshIndicator();
                    }
                }
            }
        });

        document.addEventListener('touchend', (e) => {
            if (window.scrollY === 0 && !isRefreshing) {
                let pullDistance = currentY - startY;
                
                if (pullDistance > pullThreshold) {
                    this.refreshPage();
                }
                
                this.hideRefreshIndicator();
            }
        });
    }

    showRefreshIndicator() {
        if (!document.getElementById('refresh-indicator')) {
            const indicator = document.createElement('div');
            indicator.id = 'refresh-indicator';
            indicator.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> Release to refresh';
            indicator.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: var(--primary-color);
                color: white;
                padding: 10px 20px;
                border-radius: 25px;
                z-index: 9999;
                font-size: 14px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            `;
            document.body.appendChild(indicator);
        }
    }

    hideRefreshIndicator() {
        const indicator = document.getElementById('refresh-indicator');
        if (indicator) {
            indicator.remove();
        }
    }

    refreshPage() {
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }

    // Offline detection
    setupOfflineDetection() {
        window.addEventListener('online', () => {
            this.showToast('Connection restored', 'success');
        });

        window.addEventListener('offline', () => {
            this.showToast('You are offline', 'warning');
        });
    }

    // Enhanced touch gestures
    setupTouchGestures() {
        let touchStartX = 0;
        let touchStartY = 0;

        document.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        });

        document.addEventListener('touchend', (e) => {
            const touchEndX = e.changedTouches[0].clientX;
            const touchEndY = e.changedTouches[0].clientY;
            
            const deltaX = touchEndX - touchStartX;
            const deltaY = touchEndY - touchStartY;

            // Swipe detection
            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                if (Math.abs(deltaX) > 50) {
                    if (deltaX > 0) {
                        this.onSwipeRight();
                    } else {
                        this.onSwipeLeft();
                    }
                }
            }
        });
    }

    onSwipeRight() {
        // Open side menu
        const sideMenu = document.getElementById('sideMenu');
        const overlay = document.getElementById('overlay');
        
        if (sideMenu && !sideMenu.classList.contains('active')) {
            sideMenu.classList.add('active');
            overlay.classList.add('active');
        }
    }

    onSwipeLeft() {
        // Close side menu
        const sideMenu = document.getElementById('sideMenu');
        const overlay = document.getElementById('overlay');
        
        if (sideMenu && sideMenu.classList.contains('active')) {
            sideMenu.classList.remove('active');
            overlay.classList.remove('active');
        }
    }

    // Progressive Web App setup
    setupProgressiveWebApp() {
        // Service worker registration
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/mobile/sw.js')
                .then((registration) => {
                    console.log('SW registered: ', registration);
                })
                .catch((registrationError) => {
                    console.log('SW registration failed: ', registrationError);
                });
        }

        // Install prompt
        let deferredPrompt;
        
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            this.showInstallButton();
        });
    }

    showInstallButton() {
        const installBtn = document.createElement('button');
        installBtn.innerHTML = '<i class="fas fa-download"></i> Install App';
        installBtn.className = 'btn btn-primary btn-sm position-fixed';
        installBtn.style.cssText = 'bottom: 100px; right: 20px; z-index: 999;';
        
        installBtn.addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User accepted the install prompt');
                    }
                    deferredPrompt = null;
                    installBtn.remove();
                });
            }
        });
        
        document.body.appendChild(installBtn);
    }

    // Utility functions
    showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed`;
        toast.style.cssText = `
            top: 100px;
            right: 20px;
            z-index: 9999;
            min-width: 250px;
            animation: slideInRight 0.3s ease;
        `;
        toast.innerHTML = `
            <i class="fas fa-${this.getIconForType(type)}"></i>
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 3000);
    }

    getIconForType(type) {
        const icons = {
            'success': 'check-circle',
            'warning': 'exclamation-triangle',
            'danger': 'exclamation-circle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    // Chart utilities for mobile
    static createResponsiveChart(ctx, config) {
        config.options = config.options || {};
        config.options.responsive = true;
        config.options.maintainAspectRatio = false;
        
        // Mobile-specific chart options
        if (window.innerWidth < 768) {
            config.options.plugins = config.options.plugins || {};
            config.options.plugins.legend = config.options.plugins.legend || {};
            config.options.plugins.legend.position = 'bottom';
            
            if (config.options.scales) {
                Object.keys(config.options.scales).forEach(scaleKey => {
                    config.options.scales[scaleKey].ticks = config.options.scales[scaleKey].ticks || {};
                    config.options.scales[scaleKey].ticks.maxTicksLimit = 6;
                });
            }
        }
        
        return new Chart(ctx, config);
    }

    // Data refresh utilities
    static async refreshData(endpoint) {
        try {
            const response = await fetch(endpoint);
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Error refreshing data:', error);
            return null;
        }
    }

    // Local storage utilities
    static saveToStorage(key, data) {
        try {
            localStorage.setItem(key, JSON.stringify(data));
        } catch (error) {
            console.error('Error saving to storage:', error);
        }
    }

    static getFromStorage(key) {
        try {
            const data = localStorage.getItem(key);
            return data ? JSON.parse(data) : null;
        } catch (error) {
            console.error('Error getting from storage:', error);
            return null;
        }
    }
}

// Initialize mobile admin when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new MobileAdmin();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease;
    }
`;
document.head.appendChild(style);
