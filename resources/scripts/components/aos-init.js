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

    // Initialize AOS with custom settings
    AOS.init({
      // Global settings:
      disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
      startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
      initClassName: 'aos-init', // class applied after initialization
      animatedClassName: 'aos-animate', // class applied on animation
      useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
      disableMutationObserver: false, // disables automatic mutations' detections (advanced)
      debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
      throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

      // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
      offset: isFullPageActive ? 50 : 120, // smaller offset for fullpage
      delay: 0, // values from 0 to 3000, with step 50ms
      duration: 600, // values from 0 to 3000, with step 50ms
      easing: 'ease-out-cubic', // default easing for AOS animations
      once: isFullPageActive ? false : true, // don't animate once for fullpage to allow re-animation
      mirror: isFullPageActive ? true : false, // enable mirror for fullpage
      anchorPlacement: isFullPageActive ? 'center-bottom' : 'top-bottom', // better for fullpage sections
    });

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
    // Listen for FullPage.js events
    document.addEventListener('fullpage:afterLoad', (event) => {
      // Refresh AOS when section changes
      setTimeout(() => {
        AOS.refresh();
        // Trigger animations for the current section
        this.animateCurrentSection(event.detail?.destination?.index);
      }, 300);
    });

    document.addEventListener('fullpage:onLeave', (event) => {
      // Optional: Reset animations when leaving section
      setTimeout(() => {
        AOS.refresh();
      }, 100);
    });
  }

  /**
   * Animate elements in the current section
   */
  animateCurrentSection(sectionIndex) {
    if (typeof sectionIndex === 'undefined') return;

    const sections = document.querySelectorAll('.section');
    if (sections[sectionIndex]) {
      const elementsToAnimate = sections[sectionIndex].querySelectorAll('[data-aos]');
      elementsToAnimate.forEach((element, index) => {
        // Add a small delay between elements
        setTimeout(() => {
          element.classList.add('aos-animate');
        }, index * 100);
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
}
