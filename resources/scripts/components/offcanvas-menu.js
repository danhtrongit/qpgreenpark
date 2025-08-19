/**
 * Off-canvas Menu Component
 * Handles the mobile navigation menu functionality
 */

class OffCanvasMenu {
  constructor() {
    this.menu = document.getElementById('off-canvas-menu');
    this.openButton = document.getElementById('open-off-canvas-menu');
    this.closeButton = document.getElementById('close-off-canvas-menu');
    this.overlay = null;
    this.isOpen = false;
    this.focusableElements = [];
    this.lastFocusedElement = null;

    this.init();
  }

  init() {
    if (!this.menu) {
      console.warn('Off-canvas menu element not found');
      return;
    }

    this.setupElements();
    this.bindEvents();
    this.setupAccessibility();
  }

  setupElements() {
    // Initially hide the menu
    this.menu.style.transform = 'translateX(-100%)';
    this.menu.style.transition = 'transform 0.3s ease-in-out';
    this.menu.setAttribute('aria-hidden', 'true');

    // Create overlay
    this.overlay = document.createElement('div');
    this.overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 pointer-events-none transition-opacity duration-300';
    this.overlay.setAttribute('aria-hidden', 'true');
    document.body.appendChild(this.overlay);

    // Get focusable elements
    this.updateFocusableElements();
  }

  updateFocusableElements() {
    const focusableSelectors = [
      'a[href]',
      'button:not([disabled])',
      'input:not([disabled])',
      'select:not([disabled])',
      'textarea:not([disabled])',
      '[tabindex]:not([tabindex="-1"])'
    ];

    this.focusableElements = this.menu.querySelectorAll(focusableSelectors.join(', '));
  }

  bindEvents() {
    // Open menu button
    if (this.openButton) {
      this.openButton.addEventListener('click', (e) => {
        e.preventDefault();
        this.open();
      });
    }

    // Close menu button
    if (this.closeButton) {
      this.closeButton.addEventListener('click', (e) => {
        e.preventDefault();
        this.close();
      });
    }

    // Close on overlay click
    this.overlay.addEventListener('click', () => {
      this.close();
    });

    // Close on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen) {
        this.close();
      }
    });

    // Handle tab navigation
    this.menu.addEventListener('keydown', (e) => {
      this.handleTabNavigation(e);
    });

    // Close on window resize (optional)
    window.addEventListener('resize', () => {
      if (window.innerWidth > 1024 && this.isOpen) {
        this.close();
      }
    });

    // Handle submenu toggles
    this.setupSubmenuToggles();
  }

  setupSubmenuToggles() {
    const parentItems = this.menu.querySelectorAll('.has-children > a');

    parentItems.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();

        const parentLi = link.parentElement;
        const submenu = parentLi.querySelector('.submenu');
        const icon = link.querySelector('i');

        if (submenu) {
          const isOpen = submenu.style.display === 'block';

          // Close all other submenus
          this.menu.querySelectorAll('.submenu').forEach(sub => {
            sub.style.display = 'none';
          });
          this.menu.querySelectorAll('.has-children i').forEach(i => {
            i.style.transform = 'rotate(0deg)';
          });

          // Toggle current submenu
          if (!isOpen) {
            submenu.style.display = 'block';
            if (icon) {
              icon.style.transform = 'rotate(180deg)';
            }
          }
        }
      });
    });
  }

  setupAccessibility() {
    // Set initial ARIA attributes
    if (this.openButton) {
      this.openButton.setAttribute('aria-expanded', 'false');
      this.openButton.setAttribute('aria-controls', 'off-canvas-menu');
    }
  }

  open() {
    if (this.isOpen) return;

    this.isOpen = true;
    this.lastFocusedElement = document.activeElement;

    // Prevent body scroll
    document.body.style.overflow = 'hidden';

    // Show overlay
    this.overlay.style.pointerEvents = 'auto';
    this.overlay.style.opacity = '1';
    this.overlay.setAttribute('aria-hidden', 'false');

    // Show menu with animation
    this.menu.style.transform = 'translateX(0)';
    this.menu.setAttribute('aria-hidden', 'false');
    this.menu.classList.add('open');

    // Update button state
    if (this.openButton) {
      this.openButton.setAttribute('aria-expanded', 'true');
    }

    // Trigger menu item animations
    this.animateMenuItems();

    // Focus first focusable element
    setTimeout(() => {
      this.updateFocusableElements();
      if (this.focusableElements.length > 0) {
        this.focusableElements[0].focus();
      }
    }, 100);

    // Dispatch custom event
    this.menu.dispatchEvent(new CustomEvent('offcanvas:opened'));
  }

  animateMenuItems() {
    // Animate menu items
    const menuItems = this.menu.querySelectorAll('nav ul li');
    menuItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(20px)';

      setTimeout(() => {
        item.style.transition = 'opacity 0.4s ease-out, transform 0.4s ease-out';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
      }, 100 + (index * 50));
    });

    // Animate logo
    const logo = this.menu.querySelector('.company-logo');
    if (logo) {
      logo.style.opacity = '0';
      logo.style.transform = 'translateY(-30px)';
      setTimeout(() => {
        logo.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        logo.style.opacity = '1';
        logo.style.transform = 'translateY(0)';
      }, 200);
    }

    // Animate contact items
    const contactItems = this.menu.querySelectorAll('.contact-item');
    contactItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateX(-30px)';

      setTimeout(() => {
        item.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        item.style.opacity = '1';
        item.style.transform = 'translateX(0)';
      }, 600 + (index * 100));
    });

    // Animate social links
    const socialLinks = this.menu.querySelectorAll('.social-links a');
    socialLinks.forEach((link, index) => {
      link.style.opacity = '0';
      link.style.transform = 'scale(0.8)';

      setTimeout(() => {
        link.style.transition = 'opacity 0.4s ease-out, transform 0.4s ease-out';
        link.style.opacity = '1';
        link.style.transform = 'scale(1)';
      }, 800 + (index * 50));
    });
  }

  close() {
    if (!this.isOpen) return;

    this.isOpen = false;

    // Restore body scroll
    document.body.style.overflow = '';

    // Hide overlay
    this.overlay.style.opacity = '0';
    this.overlay.setAttribute('aria-hidden', 'true');
    setTimeout(() => {
      this.overlay.style.pointerEvents = 'none';
    }, 300);

    // Hide menu
    this.menu.style.transform = 'translateX(-100%)';
    this.menu.setAttribute('aria-hidden', 'true');
    this.menu.classList.remove('open');

    // Close all submenus
    this.menu.querySelectorAll('.submenu').forEach(submenu => {
      submenu.style.display = 'none';
    });
    this.menu.querySelectorAll('.has-children i').forEach(icon => {
      icon.style.transform = 'rotate(0deg)';
    });

    // Update button state
    if (this.openButton) {
      this.openButton.setAttribute('aria-expanded', 'false');
    }

    // Restore focus
    if (this.lastFocusedElement) {
      this.lastFocusedElement.focus();
    }

    // Dispatch custom event
    this.menu.dispatchEvent(new CustomEvent('offcanvas:closed'));
  }

  toggle() {
    if (this.isOpen) {
      this.close();
    } else {
      this.open();
    }
  }

  handleTabNavigation(e) {
    if (e.key !== 'Tab') return;

    const firstFocusable = this.focusableElements[0];
    const lastFocusable = this.focusableElements[this.focusableElements.length - 1];

    if (e.shiftKey) {
      // Shift + Tab
      if (document.activeElement === firstFocusable) {
        e.preventDefault();
        lastFocusable.focus();
      }
    } else {
      // Tab
      if (document.activeElement === lastFocusable) {
        e.preventDefault();
        firstFocusable.focus();
      }
    }
  }

  // Public methods
  destroy() {
    // Remove event listeners and clean up
    if (this.overlay && this.overlay.parentNode) {
      this.overlay.parentNode.removeChild(this.overlay);
    }
    
    document.body.style.overflow = '';
    
    // Remove custom events
    this.menu.removeEventListener('keydown', this.handleTabNavigation);
  }
}

// Initialize when DOM is ready
export default OffCanvasMenu;
