import 'aos/dist/aos.css';

/**
 * Modern AOS + FullPage.js Integration
 * Based on StackOverflow solution: https://stackoverflow.com/questions/48474761/fullpagejs-and-aos-not-working-together
 * 
 * This approach uses only the CSS part of AOS and manually controls the aos-animate class
 * through FullPage.js callbacks for better performance and reliability.
 */
export default class AOSFullPageModern {
  constructor() {
    this.isFullPageActive = false;
    this.fullPageContainer = null;
    this.currentMode = null; // 'fullpage' or 'normal'

    this.init();
    this.setupResizeListener();
  }

  /**
   * Initialize the modern AOS integration
   */
  init() {
    // Detect FullPage container
    this.detectFullPageContainer();

    if (this.isFullPageActive) {
      this.setupFullPageMode();
      this.currentMode = 'fullpage';
    } else {
      this.setupNormalMode();
      this.currentMode = 'normal';
    }
  }

  /**
   * Detect FullPage container and check if FullPage.js should be active
   */
  detectFullPageContainer() {
    this.fullPageContainer = document.getElementById('fullpage') ||
                            document.querySelector('[data-fullpage]');

    // Check if FullPage.js should be active based on screen size
    // FullPage.js is only enabled on desktop (width >= 1024px)
    const shouldFullPageBeActive = window.innerWidth >= 1024;

    this.isFullPageActive = !!this.fullPageContainer && shouldFullPageBeActive;
  }

  /**
   * Setup FullPage mode - use manual AOS control
   */
  setupFullPageMode() {
    // Add AOS body attributes manually for CSS to work
    this.addAOSBodyAttributes();
    
    // Add aos-init class to all AOS elements
    this.initializeAOSElements();
    
    // Setup FullPage.js with AOS callbacks
    this.setupFullPageWithAOS();
    
    // Trigger initial animation for first section
    this.animateInitialSection();
  }

  /**
   * Setup normal scroll mode - use regular AOS
   */
  setupNormalMode() {
    // Import and initialize regular AOS for normal scroll
    import('aos').then(AOS => {
      // Store AOS globally for cleanup
      window.AOS = AOS.default;

      // Configure AOS with mobile-optimized settings
      const isMobile = window.innerWidth < 768;

      AOS.default.init({
        duration: isMobile ? 400 : 600, // Faster animations on mobile
        easing: 'ease-out-cubic',
        once: false,
        mirror: true,
        offset: isMobile ? 80 : 120, // Lower offset on mobile
        delay: 0,
        anchorPlacement: 'top-bottom',
        disable: false, // Ensure AOS is enabled on all devices
        startEvent: 'DOMContentLoaded',
        initClassName: 'aos-init',
        animatedClassName: 'aos-animate',
        useClassNames: false,
        disableMutationObserver: false,
        debounceDelay: 50,
        throttleDelay: 99
      });
    });
  }

  /**
   * Add AOS body data attributes manually
   */
  addAOSBodyAttributes() {
    const body = document.body;
    body.setAttribute('data-aos-easing', 'ease-out-cubic');
    body.setAttribute('data-aos-duration', '600');
    body.setAttribute('data-aos-delay', '0');
  }

  /**
   * Add aos-init class to all AOS elements
   */
  initializeAOSElements() {
    const aosElements = document.querySelectorAll('[data-aos]');
    aosElements.forEach(element => {
      element.classList.add('aos-init');
    });
  }

  /**
   * Setup FullPage.js with AOS integration
   */
  setupFullPageWithAOS() {
    // Wait for FullPage.js to be available
    if (typeof window.fullpage_api !== 'undefined') {
      // FullPage.js is already initialized, add our callbacks
      this.addCallbacksToExistingFullPage();
    } else {
      // Listen for FullPage.js initialization
      this.waitForFullPageInitialization();
    }
  }

  /**
   * Wait for FullPage.js to be initialized
   */
  waitForFullPageInitialization() {
    const checkFullPage = () => {
      if (typeof window.fullpage_api !== 'undefined') {
        this.addCallbacksToExistingFullPage();
      } else {
        setTimeout(checkFullPage, 100);
      }
    };
    
    setTimeout(checkFullPage, 100);
  }

  /**
   * Add callbacks to existing FullPage instance
   */
  addCallbacksToExistingFullPage() {
    // Listen for FullPage events
    document.addEventListener('fullpage:afterLoad', (event) => {
      this.handleAfterLoad(event.detail);
    });

    document.addEventListener('fullpage:onLeave', (event) => {
      this.handleOnLeave(event.detail);
    });

    document.addEventListener('fullpage:afterSlideLoad', (event) => {
      this.handleAfterSlideLoad(event.detail);
    });

    document.addEventListener('fullpage:onSlideLeave', (event) => {
      this.handleOnSlideLeave(event.detail);
    });
  }

  /**
   * Handle section load - animate elements in the active section
   */
  handleAfterLoad(data) {
    // Remove animations from all sections first
    this.resetAllSectionAnimations();
    
    // Animate current section
    setTimeout(() => {
      this.animateActiveSection();
    }, 50);
  }

  /**
   * Handle section leave - reset animations
   */
  handleOnLeave(data) {
    // Animations will be reset in afterLoad
  }

  /**
   * Handle slide load - animate elements in the active slide
   */
  handleAfterSlideLoad(data) {
    // Remove animations from all slides first
    this.resetAllSlideAnimations();
    
    // Animate current slide
    setTimeout(() => {
      this.animateActiveSlide();
    }, 50);
  }

  /**
   * Handle slide leave - reset animations
   */
  handleOnSlideLeave(data) {
    // Animations will be reset in afterSlideLoad
  }

  /**
   * Reset animations for all sections
   */
  resetAllSectionAnimations() {
    const sectionElements = document.querySelectorAll('.section [data-aos]');
    sectionElements.forEach(element => {
      element.classList.remove('aos-animate');
    });
  }

  /**
   * Reset animations for all slides
   */
  resetAllSlideAnimations() {
    const slideElements = document.querySelectorAll('.slide [data-aos]');
    slideElements.forEach(element => {
      element.classList.remove('aos-animate');
    });
  }

  /**
   * Animate elements in the active section
   */
  animateActiveSection() {
    const activeSection = document.querySelector('.section.active');
    if (activeSection) {
      const elements = activeSection.querySelectorAll('[data-aos]');
      this.staggerAnimateElements(elements);
    }
  }

  /**
   * Animate elements in the active slide
   */
  animateActiveSlide() {
    const activeSlide = document.querySelector('.slide.active');
    if (activeSlide) {
      const elements = activeSlide.querySelectorAll('[data-aos]');
      this.staggerAnimateElements(elements);
    }
  }

  /**
   * Animate elements with staggered timing
   */
  staggerAnimateElements(elements) {
    elements.forEach((element, index) => {
      setTimeout(() => {
        element.classList.add('aos-animate');
      }, index * 100); // 100ms stagger between elements
    });
  }

  /**
   * Animate initial section on page load
   */
  animateInitialSection() {
    // Wait a bit for FullPage.js to be fully ready
    setTimeout(() => {
      this.animateActiveSection();
      this.animateActiveSlide();
    }, 300);
  }

  /**
   * Refresh animations - useful for dynamic content
   */
  refresh() {
    // Re-initialize AOS elements
    this.initializeAOSElements();
    
    // Re-animate current active elements
    setTimeout(() => {
      this.animateActiveSection();
      this.animateActiveSlide();
    }, 50);
  }

  /**
   * Get diagnostic information
   */
  getDiagnostics() {
    const sections = document.querySelectorAll('.section');
    const slides = document.querySelectorAll('.slide');
    const aosElements = document.querySelectorAll('[data-aos]');
    const animatedElements = document.querySelectorAll('[data-aos].aos-animate');

    return {
      fullPageActive: this.isFullPageActive,
      containerFound: !!this.fullPageContainer,
      sectionsCount: sections.length,
      slidesCount: slides.length,
      totalAOSElements: aosElements.length,
      animatedElements: animatedElements.length,
      fullPageAPIAvailable: typeof window.fullpage_api !== 'undefined'
    };
  }

  /**
   * Setup resize listener to handle screen size changes
   */
  setupResizeListener() {
    let resizeTimeout;

    window.addEventListener('resize', () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        this.handleResize();
      }, 250); // Debounce resize events
    });
  }

  /**
   * Handle resize events - switch between FullPage and normal mode
   */
  handleResize() {
    const previousMode = this.currentMode;

    // Re-detect FullPage status
    this.detectFullPageContainer();

    const newMode = this.isFullPageActive ? 'fullpage' : 'normal';

    // Only reinitialize if mode changed
    if (previousMode !== newMode) {
      // Clean up previous mode
      if (previousMode === 'normal') {
        this.cleanupNormalMode();
      }

      // Initialize new mode
      if (newMode === 'fullpage') {
        this.setupFullPageMode();
      } else {
        this.setupNormalMode();
      }

      this.currentMode = newMode;
    } else {
      // Same mode, but force refresh for mobile orientation changes
      this.forceRefresh();
    }
  }

  /**
   * Cleanup normal AOS mode
   */
  cleanupNormalMode() {
    // If AOS was initialized, refresh it
    if (window.AOS && typeof window.AOS.refresh === 'function') {
      window.AOS.refresh();
    }
  }

  /**
   * Force refresh AOS - useful for mobile when switching orientations
   */
  forceRefresh() {
    if (this.currentMode === 'normal' && window.AOS) {
      // Reset all AOS elements
      const aosElements = document.querySelectorAll('[data-aos]');
      aosElements.forEach(element => {
        element.classList.remove('aos-animate');
      });

      // Refresh AOS
      setTimeout(() => {
        if (window.AOS && typeof window.AOS.refresh === 'function') {
          window.AOS.refresh();
        }
      }, 100);
    } else if (this.currentMode === 'fullpage') {
      // Refresh FullPage mode animations
      this.refresh();
    }
  }

  /**
   * Destroy and cleanup
   */
  destroy() {
    // Remove event listeners
    document.removeEventListener('fullpage:afterLoad', this.handleAfterLoad);
    document.removeEventListener('fullpage:onLeave', this.handleOnLeave);
    document.removeEventListener('fullpage:afterSlideLoad', this.handleAfterSlideLoad);
    document.removeEventListener('fullpage:onSlideLeave', this.handleOnSlideLeave);

    // Reset all animations
    const allAOSElements = document.querySelectorAll('[data-aos]');
    allAOSElements.forEach(element => {
      element.classList.remove('aos-init', 'aos-animate');
    });
  }
}
