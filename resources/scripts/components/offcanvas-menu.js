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
    // Initially hide the menu with enhanced transition
    this.menu.style.transform = 'translateX(-100%)';
    this.menu.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    this.menu.setAttribute('aria-hidden', 'true');

    // Create enhanced overlay with gradient and blur
    this.overlay = document.createElement('div');
    this.overlay.className = 'fixed inset-0 z-40 opacity-0 pointer-events-none backdrop-blur-sm';
    this.overlay.style.background = 'linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.4) 100%)';
    this.overlay.style.transition = 'opacity 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94), backdrop-filter 0.5s ease';
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

    // Show overlay with smooth transition
    this.overlay.style.pointerEvents = 'auto';
    this.overlay.style.transition = 'opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    this.overlay.style.opacity = '1';
    this.overlay.setAttribute('aria-hidden', 'false');

    // Show menu with enhanced animation
    this.menu.style.transform = 'translateX(0)';
    this.menu.setAttribute('aria-hidden', 'false');
    this.menu.classList.add('open');

    // Update button state
    if (this.openButton) {
      this.openButton.setAttribute('aria-expanded', 'true');
    }

    // Trigger menu item animations
    this.animateMenuItems();

    // Animate decorative shapes
    this.animateShapes();

    // Focus first focusable element
    setTimeout(() => {
      this.updateFocusableElements();
      if (this.focusableElements.length > 0) {
        this.focusableElements[0].focus();
      }
    }, 200);

    // Dispatch custom event
    this.menu.dispatchEvent(new CustomEvent('offcanvas:opened'));
  }

  animateMenuItems() {
    // Reset all animations first
    this.resetAnimations();

    // Animate menu items with enhanced easing
    const menuItems = this.menu.querySelectorAll('nav ul li');
    menuItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(30px) scale(0.95)';

      setTimeout(() => {
        item.style.transition = 'opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0) scale(1)';
      }, 150 + (index * 80));
    });

    // Animate logo with bounce effect
    const logo = this.menu.querySelector('.company-logo');
    if (logo) {
      logo.style.opacity = '0';
      logo.style.transform = 'translateY(-40px) scale(0.8)';
      setTimeout(() => {
        logo.style.transition = 'opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        logo.style.opacity = '1';
        logo.style.transform = 'translateY(0) scale(1)';
      }, 300);
    }

    // Animate contact items with slide and scale
    const contactItems = this.menu.querySelectorAll('.contact-item');
    contactItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateX(-40px) scale(0.9)';

      setTimeout(() => {
        item.style.transition = 'opacity 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        item.style.opacity = '1';
        item.style.transform = 'translateX(0) scale(1)';
      }, 600 + (index * 150));
    });

    // Animate social links with rotation and scale
    const socialLinks = this.menu.querySelectorAll('.social-links a');
    socialLinks.forEach((link, index) => {
      link.style.opacity = '0';
      link.style.transform = 'scale(0.6) rotate(-10deg)';

      setTimeout(() => {
        link.style.transition = 'opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        link.style.opacity = '1';
        link.style.transform = 'scale(1) rotate(0deg)';
      }, 900 + (index * 100));
    });
  }

  animateShapes() {
    // Add entrance animation to decorative shapes
    const shapes = this.menu.querySelectorAll('.menu-shape-1, .menu-shape-2, .menu-shape-3');
    shapes.forEach((shape, index) => {
      shape.style.opacity = '0';
      shape.style.transform = 'scale(0) rotate(45deg)';

      setTimeout(() => {
        shape.style.transition = 'opacity 1s ease-out, transform 1s ease-out';
        shape.style.opacity = '1';
        shape.style.transform = 'scale(1) rotate(0deg)';
      }, 200 + (index * 300));
    });
  }

  resetAnimations() {
    // Reset all element styles to initial state
    const allAnimatedElements = this.menu.querySelectorAll('nav ul li, .company-logo, .contact-item, .social-links a, .menu-shape-1, .menu-shape-2, .menu-shape-3');
    allAnimatedElements.forEach(element => {
      element.style.transition = 'none';
      element.style.opacity = '0';
      element.style.transform = '';
    });
  }

  animateElementsOut() {
    // Animate social links out first
    const socialLinks = this.menu.querySelectorAll('.social-links a');
    socialLinks.forEach((link, index) => {
      setTimeout(() => {
        link.style.transition = 'opacity 0.3s ease-in, transform 0.3s ease-in';
        link.style.opacity = '0';
        link.style.transform = 'scale(0.6) rotate(10deg)';
      }, index * 30);
    });

    // Animate contact items out
    const contactItems = this.menu.querySelectorAll('.contact-item');
    contactItems.forEach((item, index) => {
      setTimeout(() => {
        item.style.transition = 'opacity 0.3s ease-in, transform 0.3s ease-in';
        item.style.opacity = '0';
        item.style.transform = 'translateX(-30px) scale(0.9)';
      }, 100 + (index * 50));
    });

    // Animate menu items out
    const menuItems = this.menu.querySelectorAll('nav ul li');
    menuItems.forEach((item, index) => {
      setTimeout(() => {
        item.style.transition = 'opacity 0.2s ease-in, transform 0.2s ease-in';
        item.style.opacity = '0';
        item.style.transform = 'translateY(-20px) scale(0.95)';
      }, 150 + (index * 30));
    });

    // Animate logo out
    const logo = this.menu.querySelector('.company-logo');
    if (logo) {
      setTimeout(() => {
        logo.style.transition = 'opacity 0.3s ease-in, transform 0.3s ease-in';
        logo.style.opacity = '0';
        logo.style.transform = 'translateY(-30px) scale(0.8)';
      }, 50);
    }

    // Animate shapes out
    const shapes = this.menu.querySelectorAll('.menu-shape-1, .menu-shape-2, .menu-shape-3');
    shapes.forEach((shape, index) => {
      setTimeout(() => {
        shape.style.transition = 'opacity 0.4s ease-in, transform 0.4s ease-in';
        shape.style.opacity = '0';
        shape.style.transform = 'scale(0) rotate(-45deg)';
      }, index * 50);
    });
  }

  close() {
    if (!this.isOpen) return;

    this.isOpen = false;

    // Animate elements out before closing
    this.animateElementsOut();

    // Restore body scroll
    document.body.style.overflow = '';

    // Hide overlay with smooth transition
    this.overlay.style.transition = 'opacity 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    this.overlay.style.opacity = '0';
    this.overlay.setAttribute('aria-hidden', 'true');
    setTimeout(() => {
      this.overlay.style.pointerEvents = 'none';
    }, 500);

    // Hide menu with enhanced timing
    setTimeout(() => {
      this.menu.style.transform = 'translateX(-100%)';
      this.menu.setAttribute('aria-hidden', 'true');
      this.menu.classList.remove('open');
    }, 200);

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
