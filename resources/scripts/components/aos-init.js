import AOS from 'aos';
import 'aos/dist/aos.css';

/**
 * Initialize AOS (Animate On Scroll) library
 */
export default class AOSInit {
  constructor() {
    this.init();
  }

  init() {
    // Check if FullPage.js is being used
    const isFullPageActive = document.getElementById('fullpage') || document.querySelector('[data-fullpage]');

    console.log('AOS Init: FullPage detected:', !!isFullPageActive);

    // Initialize AOS with custom settings
    AOS.init({
      // Global settings:
      disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
      startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
      initClassName: 'aos-init', // class applied after initialization
      animatedClassName: 'aos-animate', // class applied on animation
      useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
      disableMutationObserver: isFullPageActive, // disable for fullpage to prevent conflicts
      debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
      throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

      // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
      offset: isFullPageActive ? 0 : 120, // no offset for fullpage since we manually trigger
      delay: 0, // values from 0 to 3000, with step 50ms
      duration: 600, // values from 0 to 3000, with step 50ms
      easing: 'ease-out-cubic', // default easing for AOS animations
      once: false, // always allow re-animation for fullpage
      mirror: false, // disable mirror for fullpage since we control it manually
      anchorPlacement: isFullPageActive ? 'center-center' : 'top-bottom', // better for fullpage sections
    });

    console.log('AOS initialized with settings:', { isFullPageActive });

    // Setup FullPage.js integration if needed
    if (isFullPageActive) {
      this.setupFullPageIntegration();
    }

    // Refresh AOS when dynamic content is loaded
    this.setupDynamicRefresh();
  }

  /**
   * Setup FullPage.js integration
   */
  setupFullPageIntegration() {
    console.log('Setting up FullPage.js integration for AOS');

    // Listen for FullPage.js events
    document.addEventListener('fullpage:afterLoad', (event) => {
      console.log('FullPage afterLoad event:', event.detail);

      // Refresh AOS when section changes
      setTimeout(() => {
        AOS.refresh();
        // Trigger animations for the current section
        this.animateCurrentSection(event.detail?.destination?.index);
      }, 100);
    });

    document.addEventListener('fullpage:onLeave', (event) => {
      console.log('FullPage onLeave event:', event.detail);

      // Reset animations when leaving section
      const currentSection = event.detail?.origin?.item;
      if (currentSection) {
        const elementsToReset = currentSection.querySelectorAll('[data-aos]');
        console.log('Resetting animations for', elementsToReset.length, 'elements');
        elementsToReset.forEach(element => {
          element.classList.remove('aos-animate');
        });
      }
    });

    // Initial animation for the first section
    setTimeout(() => {
      console.log('Triggering initial animation for first section');
      this.animateCurrentSection(0);
    }, 1000);
  }

  /**
   * Animate elements in the current section
   */
  animateCurrentSection(sectionIndex) {
    if (typeof sectionIndex === 'undefined') return;

    // Try multiple selectors for sections
    let sections = document.querySelectorAll('.section');
    if (sections.length === 0) {
      sections = document.querySelectorAll('[data-fullpage] > div, #fullpage > div');
    }

    if (sections[sectionIndex]) {
      const elementsToAnimate = sections[sectionIndex].querySelectorAll('[data-aos]');

      // Reset all elements first
      elementsToAnimate.forEach(element => {
        element.classList.remove('aos-animate');
      });

      // Animate elements with staggered delay
      elementsToAnimate.forEach((element, index) => {
        setTimeout(() => {
          element.classList.add('aos-animate');
        }, index * 150);
      });
    }
  }

  /**
   * Setup automatic refresh for dynamic content
   */
  setupDynamicRefresh() {
    // Refresh AOS when Owl Carousel is initialized or changed
    document.addEventListener('initialized.owl.carousel', () => {
      setTimeout(() => {
        AOS.refresh();
      }, 100);
    });

    document.addEventListener('changed.owl.carousel', () => {
      setTimeout(() => {
        AOS.refresh();
      }, 100);
    });

    // Refresh AOS when window is resized
    window.addEventListener('resize', () => {
      setTimeout(() => {
        AOS.refresh();
      }, 100);
    });
  }

  /**
   * Manually refresh AOS
   */
  refresh() {
    AOS.refresh();
  }

  /**
   * Manually refresh AOS with delay
   */
  refreshWithDelay(delay = 100) {
    setTimeout(() => {
      AOS.refresh();
    }, delay);
  }

  /**
   * Force animate all elements in a specific section
   */
  forceAnimateSection(sectionElement) {
    if (!sectionElement) return;

    const elementsToAnimate = sectionElement.querySelectorAll('[data-aos]');
    elementsToAnimate.forEach((element, index) => {
      // Reset first
      element.classList.remove('aos-animate');

      // Then animate with delay
      setTimeout(() => {
        element.classList.add('aos-animate');
      }, index * 100);
    });
  }

  /**
   * Reset all animations in a section
   */
  resetSectionAnimations(sectionElement) {
    if (!sectionElement) return;

    const elementsToReset = sectionElement.querySelectorAll('[data-aos]');
    elementsToReset.forEach(element => {
      element.classList.remove('aos-animate');
    });
  }
}
