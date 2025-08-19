import domReady from '@roots/sage/client/dom-ready';
import OffCanvasMenu from './components/offcanvas-menu';
import OwlCarouselComponent from './components/owl-carousel';
import FancyboxComponent from './components/fancybox';
import FullPageInit from './components/fullpage-init';
import AOSInit from './components/aos-init';

/**
 * Application entrypoint
 */
domReady(async () => {
  // Initialize Off-canvas Menu
  const offCanvasMenu = new OffCanvasMenu();

  // Initialize Owl Carousel Component
  const owlCarouselComponent = new OwlCarouselComponent();

  // Initialize Fancybox Component
  const fancyboxComponent = new FancyboxComponent();

  // Initialize FullPage.js first (desktop/tablet only, front page only)
  const fullPageInit = new FullPageInit();

  // Initialize AOS after FullPage.js with a small delay to ensure FullPage is ready
  setTimeout(() => {
    const aosInit = new AOSInit();
    window.aosInit = aosInit;
  }, 100);

  // Make them globally available for debugging
  window.offCanvasMenu = offCanvasMenu;
  window.owlCarouselComponent = owlCarouselComponent;
  window.fancyboxComponent = fancyboxComponent;
  window.fullPageInit = fullPageInit;
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
