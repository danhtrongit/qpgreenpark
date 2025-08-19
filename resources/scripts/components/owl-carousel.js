import $ from 'jquery';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

/**
 * Initialize Owl Carousel instances
 */
export default class OwlCarouselComponent {
  constructor() {
    this.carousels = new Map();
    this.init();
  }

  init() {
    // Auto-initialize all carousels on page load
    this.initAdvantageCarousels();
    this.initNewsCarousels();
    this.initPartnerCarousels();
    this.initUtilitiesCarousels();
    this.initPerspectiveCarousels();
    this.initDocumentCarousels();
    this.initFloorPlanCarousels();
  }

  /**
   * Advantage Carousel - Responsive advantage cards
   */
  initAdvantageCarousels() {
    const advantageCarousels = document.querySelectorAll('.owl-advantage');

    advantageCarousels.forEach((element, index) => {
      const $element = $(element);

      $element.owlCarousel({
        items: 5, // Desktop default
        margin: 24,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        dots: true,
        nav: false,
        responsive: {
          // Mobile: 1.8 items
          0: {
            items: 1.8,
            margin: 16,
          },
          // Tablet: 2.5 items
          768: {
            items: 2.5,
            margin: 20,
          },
          // Desktop: 5 items
          1024: {
            items: 5,
            margin: 24,
          },
        },
      });

      this.carousels.set(`advantage-${index}`, $element);
    });
  }

  /**
   * News Carousel - Cards carousel in news section
   */
  initNewsCarousels() {
    const newsCarousels = document.querySelectorAll('.owl-news');

    newsCarousels.forEach((element, index) => {
      const $element = $(element);

      $element.owlCarousel({
        items: 3.25, // Desktop default
        margin: 24,
        loop: false,
        autoplay: false,
        dots: true,
        nav: false,
        responsive: {
          // Mobile: 1.75 items
          320: {
            items: 1.75,
            margin: 16,
          },
          // Tablet: 2.5 items
          768: {
            items: 2.5,
            margin: 20,
          },
          // Desktop: 3.25 items
          1024: {
            items: 3.25,
            margin: 24,
          },
        },
      });

      this.carousels.set(`news-${index}`, $element);
    });
  }

  /**
   * Partner Carousel - Logos carousel in partner section
   */
  initPartnerCarousels() {
    const partnerCarousels = document.querySelectorAll('.owl-partner');

    partnerCarousels.forEach((element, index) => {
      const $element = $(element);
      const itemsCount = element.querySelectorAll('.item').length;

      $element.owlCarousel({
        items: 6, 
        margin: 24,
        loop: itemsCount > 4,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        dots: false,
        nav: false,
        stagePadding: 0,
        responsive: {
          0: {
            items: 3,
            margin: 8,
            stagePadding: 0,
          },
          480: {
            items: 4,
            margin: 12,
            stagePadding: 0,
          },
          768: {
            items: 5,
            margin: 20,
          },
          1024: {
            items: 6,
            margin: 24,
          },
        },
      });

      this.carousels.set(`partner-${index}`, $element);
    });
  }


  initUtilitiesCarousels() {
    const utilitiesCarousels = document.querySelectorAll('.owl-utilities');
    utilitiesCarousels.forEach((element, index) => {
      const $element = $(element);

      // Find wrapper and controls
      const wrapper = element.closest('.utilities-carousel-wrapper') || element.parentElement;
      const prevBtn = wrapper?.querySelector('.utilities-prev');
      const nextBtn = wrapper?.querySelector('.utilities-next');
      const currentEl = wrapper?.querySelector('.utilities-current');
      const totalEl = wrapper?.querySelector('.utilities-total');

      // Count actual items
      const itemsCount = element.querySelectorAll('.item').length;

      // Determine optimal configuration based on items count
      const getOptimalConfig = (screenSize) => {
        const configs = {
          mobile: { items: 1.25, margin: 16 },
          tablet: { items: 1.75, margin: 24 },
          desktop: { items: 2.25, margin: 32 }
        };

        // If we have fewer items than display count, adjust
        if (itemsCount <= 2) {
          configs.desktop.items = Math.min(itemsCount, 1.5);
          configs.tablet.items = Math.min(itemsCount, 1.25);
          configs.mobile.items = 1;
        } else if (itemsCount === 3) {
          // For 3 items, keep original settings for smoother navigation
          // configs.desktop.items = 2.25; // Keep original
          // configs.tablet.items = 1.75; // Keep original
          // configs.mobile.items = 1.25; // Keep original
        }

        return configs[screenSize];
      };

      // Determine if we should use loop based on items count
      const shouldLoop = true; // Set to true to enable loop, false to disable

      $element.owlCarousel({
        items: getOptimalConfig('desktop').items,
        margin: getOptimalConfig('desktop').margin,
        loop: shouldLoop,
        autoplay: itemsCount > 2, // Only autoplay if we have enough items
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false, // use custom counter instead
        nav: false,
        smartSpeed: 600,
        stagePadding: 0,
        responsive: {
          320: getOptimalConfig('mobile'),
          768: getOptimalConfig('tablet'),
          1024: getOptimalConfig('desktop'),
        },
      });

      // Set total slides
      if (totalEl) {
        totalEl.textContent = String(itemsCount).padStart(2, '0');
      }

      // Function to update navigation state
      const updateNavigationState = (carousel) => {
        if (!prevBtn || !nextBtn) return;

        const current = carousel.relative(carousel.current());
        const maximum = carousel.maximum();

        if (shouldLoop) {
          // When loop is enabled, never disable buttons
          prevBtn.disabled = false;
          nextBtn.disabled = false;
          prevBtn.classList.remove('opacity-50');
          nextBtn.classList.remove('opacity-50');

          // Calculate correct current index for looped carousel
          // Use modulo to get the actual item index within the original items
          const actualIndex = (current % itemsCount) + 1;
          if (currentEl) {
            currentEl.textContent = String(actualIndex).padStart(2, '0');
          }
        } else {
          // When loop is disabled, use original logic
          prevBtn.disabled = current <= 0;
          nextBtn.disabled = current >= maximum;

          // Add visual feedback
          prevBtn.classList.toggle('opacity-50', current <= 0);
          nextBtn.classList.toggle('opacity-50', current >= maximum);

          // Update current index display
          if (currentEl) {
            currentEl.textContent = String(current + 1).padStart(2, '0');
          }
        }
      };

      // Fix Fancybox gallery for looped carousel
      const fixFancyboxGallery = () => {
        const items = element.querySelectorAll('.item [data-fancybox]');
        items.forEach((item, index) => {
          // Ensure each item has unique data attributes for proper gallery indexing
          item.setAttribute('data-fancybox-index', index);
          item.setAttribute('data-fancybox-total', itemsCount);
        });
      };

      // Update current index and navigation state on events
      $element.on('initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel', (event) => {
        if (!event.namespace) return;
        const carousel = event.relatedTarget;
        updateNavigationState(carousel);

        // Fix Fancybox gallery after carousel initialization/change
        fixFancyboxGallery();
      });

      // Bind custom controls with improved logic
      if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!prevBtn.disabled) {
            $element.trigger('prev.owl.carousel');
          }
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!nextBtn.disabled) {
            $element.trigger('next.owl.carousel');
          }
        });
      }

      this.carousels.set(`utilities-${index}`, $element);
    });
  }


  /**
   * Perspective Carousel - Similar to utilities carousel
   */
  initPerspectiveCarousels() {
    const perspectiveCarousels = document.querySelectorAll('.owl-perspective');
    perspectiveCarousels.forEach((element, index) => {
      const $element = $(element);

      // Find wrapper and controls
      const wrapper = element.closest('.perspective-carousel-wrapper') || element.parentElement;
      const prevBtn = wrapper?.querySelector('.perspective-prev');
      const nextBtn = wrapper?.querySelector('.perspective-next');
      const currentEl = wrapper?.querySelector('.perspective-current');
      const totalEl = wrapper?.querySelector('.perspective-total');

      // Count actual items
      const itemsCount = element.querySelectorAll('.item').length;

      // Determine optimal configuration based on items count
      const getOptimalConfig = (screenSize) => {
        const configs = {
          mobile: { items: 1.25, margin: 16 },
          tablet: { items: 1.75, margin: 24 },
          desktop: { items: 2.25, margin: 32 }
        };

        // If we have fewer items than display count, adjust
        if (itemsCount <= 2) {
          configs.desktop.items = Math.min(itemsCount, 1.5);
          configs.tablet.items = Math.min(itemsCount, 1.25);
          configs.mobile.items = 1;
        } else if (itemsCount === 3) {
          // For 3 items, keep original settings for smoother navigation
          // configs.desktop.items = 2.25; // Keep original
          // configs.tablet.items = 1.75; // Keep original
          // configs.mobile.items = 1.25; // Keep original
        }

        return configs[screenSize];
      };

      // Determine if we should use loop based on items count
      const shouldLoop = true; // Set to true to enable loop, false to disable

      $element.owlCarousel({
        items: getOptimalConfig('desktop').items,
        margin: getOptimalConfig('desktop').margin,
        loop: shouldLoop,
        autoplay: itemsCount > 2, // Only autoplay if we have enough items
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false, // use custom counter instead
        nav: false,
        smartSpeed: 600,
        stagePadding: 0,
        responsive: {
          320: getOptimalConfig('mobile'),
          768: getOptimalConfig('tablet'),
          1024: getOptimalConfig('desktop'),
        },
      });

      // Set total slides
      if (totalEl) {
        totalEl.textContent = String(itemsCount).padStart(2, '0');
      }

      // Function to update navigation state
      const updateNavigationState = (carousel) => {
        if (!prevBtn || !nextBtn) return;

        const current = carousel.relative(carousel.current());
        const maximum = carousel.maximum();

        if (shouldLoop) {
          // When loop is enabled, never disable buttons
          prevBtn.disabled = false;
          nextBtn.disabled = false;
          prevBtn.classList.remove('opacity-50');
          nextBtn.classList.remove('opacity-50');

          // Calculate correct current index for looped carousel
          // Use modulo to get the actual item index within the original items
          const actualIndex = (current % itemsCount) + 1;
          if (currentEl) {
            currentEl.textContent = String(actualIndex).padStart(2, '0');
          }
        } else {
          // When loop is disabled, use original logic
          prevBtn.disabled = current <= 0;
          nextBtn.disabled = current >= maximum;

          // Add visual feedback
          prevBtn.classList.toggle('opacity-50', current <= 0);
          nextBtn.classList.toggle('opacity-50', current >= maximum);

          // Update current index display
          if (currentEl) {
            currentEl.textContent = String(current + 1).padStart(2, '0');
          }
        }
      };

      // Update current index and navigation state on events
      $element.on('initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel', (event) => {
        if (!event.namespace) return;
        const carousel = event.relatedTarget;
        updateNavigationState(carousel);
      });

      // Bind custom controls with improved logic
      if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!prevBtn.disabled) {
            $element.trigger('prev.owl.carousel');
          }
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!nextBtn.disabled) {
            $element.trigger('next.owl.carousel');
          }
        });
      }

      this.carousels.set(`perspective-${index}`, $element);
    });
  }

  /**
   * Document Carousel - Document files carousel
   */
  initDocumentCarousels() {
    const documentCarousels = document.querySelectorAll('.owl-document');

    documentCarousels.forEach((element, index) => {
      const $element = $(element);
      const itemsCount = element.querySelectorAll('.item').length;

      // Find navigation elements
      const wrapper = element.closest('.document-carousel-wrapper');
      const prevBtn = wrapper?.querySelector('.document-prev');
      const nextBtn = wrapper?.querySelector('.document-next');
      const currentEl = wrapper?.querySelector('.document-current');
      const totalEl = wrapper?.querySelector('.document-total');



      // Responsive configuration for document carousel
      const getOptimalConfig = (breakpoint) => {
        const configs = {
          mobile: { items: 1, margin: 16 },
          tablet: { items: 1.5, margin: 20 },
          desktop: { items: 2, margin: 24 },
        };
        return configs[breakpoint] || configs.desktop;
      };

      // Determine if we should use loop based on items count
      const shouldLoop = itemsCount > 2;

      $element.owlCarousel({
        items: getOptimalConfig('desktop').items,
        margin: getOptimalConfig('desktop').margin,
        loop: shouldLoop,
        autoplay: itemsCount > 2, // Only autoplay if we have enough items
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false, // use custom counter instead
        nav: false,
        smartSpeed: 600,
        stagePadding: 0,
        responsive: {
          320: getOptimalConfig('mobile'),
          768: getOptimalConfig('tablet'),
          1024: getOptimalConfig('desktop'),
        },
      });

      // Set total slides
      if (totalEl) {
        totalEl.textContent = String(itemsCount).padStart(2, '0');
      }

      // Update navigation state
      const updateNavigationState = (carousel) => {
        if (!prevBtn || !nextBtn) return;

        const current = carousel.relative(carousel.current());
        const maximum = carousel.maximum();

        if (shouldLoop) {
          // When loop is enabled, buttons are always enabled
          prevBtn.disabled = false;
          nextBtn.disabled = false;
          prevBtn.classList.remove('opacity-50');
          nextBtn.classList.remove('opacity-50');

          // Calculate real current index for looped carousel
          const realIndex = (current % itemsCount) + 1;
          if (currentEl) {
            currentEl.textContent = String(realIndex).padStart(2, '0');
          }
        } else {
          // When loop is disabled, use original logic
          prevBtn.disabled = current <= 0;
          nextBtn.disabled = current >= maximum;

          // Add visual feedback
          prevBtn.classList.toggle('opacity-50', current <= 0);
          nextBtn.classList.toggle('opacity-50', current >= maximum);

          // Update current index display
          if (currentEl) {
            currentEl.textContent = String(current + 1).padStart(2, '0');
          }
        }
      };

      // Update current index and navigation state on events
      $element.on('initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel', (event) => {
        if (!event.namespace) return;
        const carousel = event.relatedTarget;
        updateNavigationState(carousel);
      });

      // Bind custom controls with improved logic
      if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!prevBtn.disabled) {
            $element.trigger('prev.owl.carousel');
          }
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!nextBtn.disabled) {
            $element.trigger('next.owl.carousel');
          }
        });
      }

      this.carousels.set(`document-${index}`, $element);
    });
  }
  /**
   * Floor Plan Carousel - Similar to document/perspective carousels
   */
  initFloorPlanCarousels() {
    const floorCarousels = document.querySelectorAll('.owl-floorplan');

    floorCarousels.forEach((element, index) => {
      const $element = $(element);
      const itemsCount = element.querySelectorAll('.item').length;

      // Find navigation elements
      const wrapper = element.closest('.floorplan-carousel-wrapper') || element.parentElement;
      const prevBtn = wrapper?.querySelector('.floorplan-prev');
      const nextBtn = wrapper?.querySelector('.floorplan-next');
      const currentEl = wrapper?.querySelector('.floorplan-current');
      const totalEl = wrapper?.querySelector('.floorplan-total');

      const getOptimalConfig = (breakpoint) => {
        const configs = {
          mobile: { items: 1, margin: 16 },
          tablet: { items: 1.5, margin: 20 },
          desktop: { items: 2, margin: 24 },
        };
        return configs[breakpoint] || configs.desktop;
      };

      const shouldLoop = itemsCount > 2;

      $element.owlCarousel({
        items: getOptimalConfig('desktop').items,
        margin: getOptimalConfig('desktop').margin,
        loop: shouldLoop,
        autoplay: itemsCount > 2,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false,
        nav: false,
        smartSpeed: 600,
        stagePadding: 0,
        responsive: {
          320: getOptimalConfig('mobile'),
          768: getOptimalConfig('tablet'),
          1024: getOptimalConfig('desktop'),
        },
      });

      if (totalEl) {
        totalEl.textContent = String(itemsCount).padStart(2, '0');
      }

      const updateNavigationState = (carousel) => {
        if (!prevBtn || !nextBtn) return;

        const current = carousel.relative(carousel.current());
        const maximum = carousel.maximum();

        if (shouldLoop) {
          prevBtn.disabled = false;
          nextBtn.disabled = false;
          prevBtn.classList.remove('opacity-50');
          nextBtn.classList.remove('opacity-50');

          const realIndex = (current % itemsCount) + 1;
          if (currentEl) currentEl.textContent = String(realIndex).padStart(2, '0');
        } else {
          prevBtn.disabled = current <= 0;
          nextBtn.disabled = current >= maximum;
          prevBtn.classList.toggle('opacity-50', current <= 0);
          nextBtn.classList.toggle('opacity-50', current >= maximum);
          if (currentEl) currentEl.textContent = String(current + 1).padStart(2, '0');
        }
      };

      $element.on('initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel', (event) => {
        if (!event.namespace) return;
        const carousel = event.relatedTarget;
        updateNavigationState(carousel);
      });

      if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!prevBtn.disabled) $element.trigger('prev.owl.carousel');
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (!nextBtn.disabled) $element.trigger('next.owl.carousel');
        });
      }

      this.carousels.set(`floorplan-${index}`, $element);
    });
  }

  /**
   * Get carousel instance by key
   */
  getCarousel(key) {
    return this.carousels.get(key);
  }

  /**
   * Destroy all carousels
   */
  destroy() {
    this.carousels.forEach((carousel) => {
      carousel.trigger('destroy.owl.carousel');
    });
    this.carousels.clear();
  }

  /**
   * Refresh all carousels (useful for dynamic content)
   */
  refresh() {
    this.carousels.forEach((carousel) => {
      carousel.trigger('refresh.owl.carousel');
    });
  }
}

