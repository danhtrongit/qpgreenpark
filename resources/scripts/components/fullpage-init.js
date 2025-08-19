import fullpage from 'fullpage.js';
import 'fullpage.js/dist/fullpage.css';

/**
 * FullPage.js initializer
 * - Works on any template that contains a `#fullpage` container with `.section` children
 * - Desktop only (disabled on tablet and mobile)
 */
export default class FullPageInit {
  constructor() {
    this.fpInstance = null;
    // Support either #fullpage or any element with [data-fullpage]
    this.containerSelector = document.querySelector('[data-fullpage]') ? '[data-fullpage]' : '#fullpage';

    this.init();
    this.onResize = this.onResize.bind(this);
    window.addEventListener('resize', this.onResize);
  }

  hasContainer() {
    return !!document.querySelector(this.containerSelector);
  }

  shouldEnable() {
    // Desktop only; disable on widths < 1024px
    return window.innerWidth >= 1024;
  }

  init() {
    const container = document.querySelector(this.containerSelector);
    if (!container) return;

    if (this.shouldEnable()) {
      this.enable();
    } else {
      this.disable();
    }
  }

  enable() {
    if (this.fpInstance) return;

    const sections = document.querySelectorAll(`${this.containerSelector} .section`);
    if (!sections || sections.length === 0) return; // nothing to init

    this.fpInstance = new fullpage(this.containerSelector, {
      licenseKey: 'gplv3',
      autoScrolling: true,
      fitToSection: true,
      scrollingSpeed: 700,
      responsiveWidth: 1024, // auto disables fullPage below this width
      // Build anchors & tooltips dynamically from sections
      anchors: this.getAnchors(),
      navigation: true,
      navigationPosition: 'right',
      navigationTooltips: this.getTooltips(),
      showActiveTooltip: true, // show tooltip for active section
      // Allow normal scroll inside overlays and carousels
      normalScrollElements: '#off-canvas-menu, .fancybox__container, .owl-carousel, .owl-stage-outer',
      // Optional: disable on some touch devices nuances
      // bigSectionsDestination: 'top',
      // scrollOverflow: false,

      // Callbacks for AOS integration
      afterLoad: (origin, destination, direction) => {
        // Dispatch custom event for AOS
        const event = new CustomEvent('fullpage:afterLoad', {
          detail: { origin, destination, direction }
        });
        document.dispatchEvent(event);
      },

      onLeave: (origin, destination, direction) => {
        // Dispatch custom event for AOS
        const event = new CustomEvent('fullpage:onLeave', {
          detail: { origin, destination, direction }
        });
        document.dispatchEvent(event);
      }
    });
  }

  // Collect anchors from .section elements
  getAnchors() {
    const sections = Array.from(document.querySelectorAll(`${this.containerSelector} .section`));
    const anchors = sections.map((sec, idx) => {
      const a = sec.getAttribute('data-anchor') || sec.id;
      return a && a.trim() ? a.trim() : `section-${idx + 1}`;
    });
    return anchors;
  }

  // Collect tooltips from .section elements
  getTooltips() {
    const sections = Array.from(document.querySelectorAll(`${this.containerSelector} .section`));
    const tips = sections.map((sec, idx) => {
      const t = sec.getAttribute('data-tooltip') || sec.getAttribute('data-title') || sec.dataset?.title;
      return (t && String(t).trim()) ? String(t).trim() : `Section ${idx + 1}`;
    });
    return tips;
  }

  disable() {
    if (this.fpInstance && typeof this.fpInstance.destroy === 'function') {
      this.fpInstance.destroy('all'); // remove styles/events
      this.fpInstance = null;
    }
  }

  onResize() {
    const container = document.querySelector(this.containerSelector);
    if (!container) return;

    if (this.shouldEnable()) {
      this.enable();
    } else {
      this.disable();
    }
  }
}

