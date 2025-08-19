import { Fancybox } from '@fancyapps/ui';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

/**
 * Initialize Fancybox instances
 */
export default class FancyboxComponent {
  constructor() {
    this.init();
  }

  init() {
    // Initialize Fancybox with custom options
    Fancybox.bind('[data-fancybox]', {
      // UI options
      Toolbar: {
        display: {
          left: ['infobar'],
          middle: [
            'zoomIn',
            'zoomOut',
            'toggle1to1',
            'rotateCCW',
            'rotateCW',
            'flipX',
            'flipY',
          ],
          right: ['slideshow', 'thumbs', 'close'],
        },
      },

      // Slideshow options
      Slideshow: {
        autoStart: false,
        timeout: 3000,
      },

      // Thumbnails
      Thumbs: {
        autoStart: false,
      },

      // Animation options
      showClass: 'f-fadeIn',
      hideClass: 'f-fadeOut',

      // Ensure close button works
      closeButton: 'auto',
      keyboard: {
        Escape: 'close',
      },

      // Custom options for different galleries
      on: {
        // Add any global event handlers here if needed
      },
    });

    // Initialize perspective gallery with specific options
    Fancybox.bind('[data-fancybox="perspective-gallery"]', {
      // Custom options for perspective gallery
      Toolbar: {
        display: {
          left: ['infobar'],
          middle: ['zoomIn', 'zoomOut', 'rotateCCW', 'rotateCW'],
          right: ['slideshow', 'close'],
        },
      },

      // Custom styling
      template: {
        closeButton: '<button data-fancybox-close class="f-button is-close-btn" title="{{CLOSE}}"><svg><path d="m19.5 4.5-15 15m0-15 15 15"/></svg></button>',
        spinner: '<svg class="f-spinner" viewBox="0 0 50 50"><circle cx="25" cy="25" r="20"/></svg>',
        main: null,
      },

      // Animation
      showClass: 'f-fadeIn',
      hideClass: 'f-fadeOut',

      // Image options
      Images: {
        zoom: true,
        protected: true,
      },

      // Ensure close button works
      closeButton: 'auto',
      keyboard: {
        Escape: 'close',
      },

      // Handle gallery properly for looped carousels
      groupAll: true, // Group all items with same data-fancybox value

      // Custom callbacks
      on: {
        init: (fancybox) => {
          // Fix gallery count for looped carousels
          const items = document.querySelectorAll('[data-fancybox="perspective-gallery"]');
          const uniqueItems = [];
          const seenUrls = new Set();

          items.forEach(item => {
            const href = item.getAttribute('href');
            if (!seenUrls.has(href)) {
              seenUrls.add(href);
              uniqueItems.push(item);
            }
          });

          // Update fancybox with unique items only
          if (uniqueItems.length !== items.length) {
            fancybox.items = uniqueItems.map(item => ({
              src: item.getAttribute('href'),
              caption: item.getAttribute('data-caption') || '',
              type: 'image'
            }));
          }
        },

        reveal: (fancybox) => {
          // Add custom class to perspective gallery
          const container = fancybox.getContainer();
          if (container) {
            container.classList.add('perspective-gallery-active');
          }
        },

        close: (fancybox) => {
          // Remove custom class
          const container = fancybox.getContainer();
          if (container) {
            container.classList.remove('perspective-gallery-active');
          }
        },
      },
    });

    // Initialize utilities gallery if exists
    Fancybox.bind('[data-fancybox="utilities-gallery"]', {
      Toolbar: {
        display: {
          left: ['infobar'],
          middle: ['zoomIn', 'zoomOut'],
          right: ['slideshow', 'close'],
        },
      },
    });
  }

  /**
   * Destroy all Fancybox instances
   */
  destroy() {
    Fancybox.destroy();
  }

  /**
   * Open Fancybox programmatically
   */
  open(items, options = {}) {
    Fancybox.show(items, options);
  }

  /**
   * Close current Fancybox
   */
  close() {
    Fancybox.close();
  }
}
